<?php

   $NBN_ACTIVATION_FEE = 100;
   $PHONE_PLAN_COST = 45;
   
   $DISCOUNT_FACTOR = 0.9;
   
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
      
         $internetCost = 0;
         $internetName = '';
         
         if (strcmp($internetInput, 'none') != 0) $internetRequired = true;
         else $internetRequired = false;
         
         # Determine the price of seleced nbn plan
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
         echo '<h3>Phone</h3>';
         echo '<table class="quote-table">';
         echo '<tr><td>Type:</td><td>Unlimited</td></tr>';
         echo '<tr><td>Cost:</td><td>$'.$PHONE_PLAN_COST.' / month</td></tr>';
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
         $upfront = 0;
         if ($internetRequired) $upfront = $NBN_ACTIVATION_FEE;
         
         $monthly = $PHONE_PLAN_COST;
         if ($internetRequired) $monthly += $internetCost;
         
         if ($internetRequired) {
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