<?php
   
   $NBN_MONTHLY_FEE = 100;
   $NBN_ACTIVATION_FEE = 150;
   
   $DISCOUNT_FACTOR = 0.9;
   
   $planInput = $_POST['plan'];
   $handsetInput = $_POST['handset'];
   $internetInput = $_POST['internet'];
   
   $firstName = $_POST['first'];
   $lastName = $_POST['last'];
   $email = $_POST['email'];
   $street1 = $_POST['street1'];
   $street2 = $_POST['street2'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $postcode = $_POST['postcode'];
   $phone = $_POST['phone'];
   
   # Build string to be emailed to sales
   $message = 'Dear sales,\nA customer has expressed interest in our product. Please find details below.\n';
   $message .= 'Name:\t'.$firstName.' '.$lastName.'\n';
   $message .= 'Email:\t'.$email.'\n';
   $message .= 'Address:\t'.$street1.' '.$street2.' '.$city.' '.$state.' '.$postcode.'\n';
   $message .= 'Phone:\t'.$phone;
   
   # Email to sales
   $to = 'test@test.com.au';                             # change as desired
   mail($to, 'Customer interest - '.$email, $message);
   
   $c504 = [
      'id'=>'504',
      'cost'=>200
   ];
   $c514 = [
      'id'=>'514',
      'cost'=>275
   ];
   $c525G2 = [
      'id'=>'525G2',
      'cost'=>350
   ];
   $c302D = [
      'id'=>'302D',
      'cost'=>375
   ];
   
   $handsets = [ $c504, $c514, $c525G2, $c302D ];
   
   $plans = [
      'lite'=>20,
      'max'=>35,
      'complete'=>45
   ];
   
   $internets = [
      '25/1Mbps'=>100,
      '25/5Mbps'=>110,
      '25/10Mbps'=>120,
      '50/20Mbps'=>130,
      '100/40Mbps'=>140
   ];
   
?>

<!doctype html>
<html lang="en">
<head>
   <title>Confirm Details | Yamo</title>
   <?php include_once('includes/links.php') ?>
</head>
<body>
<div class="wrapper">
   <?php include_once('includes/top.php'); ?>
   <div class="content">
      <h1>Review your details</h1>
      <p>Thank you, <?php echo $firstName; ?>, please review your information and click 'continue'.</p>
      <div class="customer-details">
         <table>
            <tr><td>Name:</td><td><?php echo $firstName.' '.$lastName ?></td></tr>
            <tr><td>Email:</td><td><?php echo $email ?></td></tr>
            <tr><td>Street address line 1:</td><td><?php echo $street1 ?></td></tr>
            <tr><td>Street address line 2:</td><td><?php echo $street2 ?></td></tr>
            <tr><td>City:</td><td><?php echo $city ?></td></tr>
            <tr><td>State:</td><td><?php echo $state ?></td></tr>
            <tr><td>Postcode:</td><td><?php echo $postcode ?></td></tr>
            <tr><td>Phone number:</td><td><?php echo $phone ?></td></tr>
         </table>
      </div>
      <div id="quote">
      <?php
      
         $handsetCost = 0;
         $planCost = 0;
         $internetCost = 0;
         $planName = '';
         $internetName = '';
         
         if (strcmp($planInput, 'none') != 0) $planRequired = true;
         else $planRequired = false;
         if (strcmp($handsetInput, 'none') != 0) $handsetRequired = true;
         else $handsetRequired = false;
         if (strcmp($internetInput, 'none') != 0) $internetRequired = true;
         else $internetRequired = false;
         
         # Determine the price of selected plan
         if ($planRequired) {
            foreach ($plans as $key=>$value) {
               if(strcmp($key, $planInput) == 0) {
                  $planCost = $value;
                  $planName = $key;
                  $planName = ucfirst($planName);
               }
            }
         }
         
         # Determine the price of selected handset
         if ($handsetRequired) {
            foreach ($handsets as $handset) {
               if (strcmp($handset['id'], $handsetInput) == 0) {
                  $handsetCost = $handset['cost'];
               }
            }
         }
         
         # Determine the price of seleced internet
         if ($internetRequired) {
            foreach ($internets as $key=>$value) {
               if(strcmp($key, $internetInput) == 0) {
                  $internetCost = $value;
                  $internetName = $key;
                  $internetName = ucfirst($internetName);
               }
            }
         }
         
         echo '<div class="quote-box">';
         echo '<h3>Plan</h3>';
         echo '<table class="quote-table">';
         if ($planRequired) echo '<tr><td>Type:</td><td>'.$planName.'</td></tr>';
         else echo '<tr><td>Plan:</td><td>None selected</td></tr>';
         echo '<tr><td>Cost:</td><td>$'.$planCost.' / month</td></tr>';
         echo '</table>';
         echo '</div> ';
         
         echo '<div class="quote-box">';
         echo '<h3>Handset</h3>';
         echo '<table class="quote-table">';
         if ($handsetRequired) echo '<tr><td>Model:</td><td>Cisco'.$handsetInput.'</td></tr>';
         else echo '<tr><td>Model:</td><td>None selected</td></tr>';
         echo '<tr><td>Cost:</td><td>$'.$handsetCost.'</td></tr>';
         echo '</table>';
         echo '</div> ';
         
         echo '<div class="quote-box">';
            echo '<h3>Internet</h3>';
            echo '<table class="quote-table">';
            if ($internetRequired) {
               echo '<tr><td>Plan:</td><td>'.$internetName.'</td></tr>';
               echo '<tr><td>Cost:</td><td>$'.$internetCost.' / month</td></tr>';
               echo '<tr><td>Activation:</td><td>$'.$NBN_ACTIVATION_FEE.'</td></tr>';
            } else {
               echo '<tr><td>Plan:</td><td>Not required</td></tr>';
               echo '<tr><td>Cost:</td><td>$'.$internetCost.' / month</td></tr>';
               echo '<tr><td>Activation:</td><td>$0</td></tr>';
            }
            echo '</table>';
         
         echo '</div> ';
         
         # Calculate total
         $upfront = $handsetCost;
         if ($internetRequired) $upfront += $NBN_ACTIVATION_FEE;
         
         $monthly = $planCost + $internetCost;
         if ($internetRequired) $monthly += $NBN_MONTHLY_FEE;
         
         if ($planRequired && $internetRequired) {
            $discount = true;
         } else {
            $discount = false;
         }
         
         if ($discount) {
            $monthly = $monthly * $DISCOUNT_FACTOR;
         }
         
         echo '<div class="quote-box">';
         echo '<h3>Total</h3>';
         echo '<table class="quote-table">';
         echo '<tr><td>Upfront:</td><td>$'.$upfront.'</td></tr>';
         echo '<tr><td>Monthly:</td><td>$'.$monthly.'</td>';
         echo '</tr>';
         echo '</table>';
         echo '</div> ';

         echo '<span class="stretch"></span>';
         echo '<button class="quote-button" id="continue">Continue &#187;</button> ';
         echo '<script>$(".quote").show(1000);</script>';
         
      ?>
      </div>
      <script type="text/javascript">
         $('#continue').click(function() {
            location.href = 'terms.php';
         });
      </script>
      
   </div>
   <?php include_once('includes/footer.php'); ?>
</div>
</body>
</html>