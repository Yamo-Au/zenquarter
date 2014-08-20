<?php

   $NBN_MONTHLY_FEE = 100;
   $NBN_ACTIVATION_FEE = 150;
   
   $DISCOUNT_FACTOR = 0.9;
   
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
      <title>Zen Quarter Plans | Yamo</title>
      <link rel="stylesheet" type="text/css" href="styles/style.css" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="scripts/jquery-1.11.1.js"></script>
      <script type="text/javascript" src="scripts/validation.js"></script>
   </head>
   <body>
      <div class="wrapper">
         <div class="header">
            <img class="logo" alt="Yamo logo" src="images/logo.png" />
         </div>
         <div class="banner-area">
            <img class="banner" src="images/banner.png" />
         </div>
         <div class="content">
         
            <?php
                  if (isset($_POST['submit'])) {
                     $planInput = $_POST['plan'];
                     $handsetInput = $_POST['handset'];
                     $internetInput = $_POST['internet'];
                     
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
                     
                     echo '<div class="quote">';
                     echo '<script>$(".quote").hide();</script>';
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
                     echo '<button class="quote-button">Confirm quote and continue &#187;</button> ';
                     echo '</div>';
                     echo '<script>$(".quote").show(1000);</script>';
                  }
                  
                  
                  
               ?>
         
         
            <div class="user-area">
            <h1 class="main-heading">Phone and NBN</h1>
            <div class="form-wrap">
            <form class="form" action="" method="post">
               <div class="form-container">
                  <p>
                    <label class="desc">Name</label><br />
                    <input type="text" class="half" name="first" value="First name"/><input type="text" class="half" name="last" value="Last name"/>
                  </p>
                  <p>
                    <label class="desc">Email</label><br />
                    <input type="text" class="full" name="email" value="Email address"/>
                  </p>
                  <p>
                    <label class="desc">Address</label><br />
                    <input type="text" class="full" name="street1" value="Street address"/><br />
                    <input type="text" class="full" name="street2" value="Street address line 2"/><br />
                    <input type="text" class="half" name="city" value="City / suburb"/>
                    <select class="half" name="state">
                      <option value="none">State</option>
                      <option value="nt">NT</option>
                      <option value="wa">WA</option>
                      <option value="nsw">NSW</option>
                      <option value="act">ACT</option>
                      <option value="qld">QLD</option>
                      <option value="sa">SA</option>
                      <option value="tas">TAS</option>
                    </select>
                  </p>
                  <p>
                    <label class="desc">Phone</label><br />
                    <input type="text" class="full" name="phone" value="Phone number"/>
                  </p>
                  <p>
                    <label class="desc" for="plan">Desired Plan</label><br />
                    <select class="full" id="plan" name="plan">
                      <option value="none">-- Select one --</option>
                      <option value="lite">Lite - $20/month</option>
                      <option value="max">Max - $35/month</option>
                      <option value="complete">Complete - $45/month</option>
                      <option value="none">Not required</option>
                    </select>
                  </p>
                  <p>
                    <label class="desc" for="handset">Desired Handset</label><br />
                    <select class="full" id="handset" name="handset">
                       <option value="none">-- Select one --</option>
                       <option value="504">Cisco 504 - $200</option>
                       <option value="514">Cisco 514 - $275</option>
                       <option value="525G2">Cisco 525G2 - $350</option>
                       <option value="302D">Cisco 302D - $375</option>
                       <option value="none">Not required</option>
                    </select>
                  </p>
                  <p>
                    <label class="desc" for="internet">NBN Internet Plan</label><br />
                    <select class="full" id="internet" name="internet">
                       <option value="none">-- Select one --</option>
                       <option value="25/1Mbps">25/1Mbps - $100/month</option>
                       <option value="25/5Mbps">25/5Mbps - $110/month</option>
                       <option value="25/10Mbps">25/10Mbps - $120/month</option>
                       <option value="50/20Mbps">50/20Mbps - $130/month</option>
                       <option value="100/40Mbps">100/40Mbps - $140/month</option>
                       <option value="none">Not required</option>
                    </select>
                  </p>
                  <input class="button" type="submit" name="submit" value="Get Quote" />
                     <input class="button" type="reset" name="reset" value="Start over" onclick="$('.quote').hide(1000);" />
                </div>
                     
            </form>
            </div>
            
            </div>
            <img class="business-voice" alt="Yamo Business Voice" src="images/business-voice.png" />
            <img class="handsets" alt="Yamo cisco handsets" src="images/phones.png" />
            
         </div>
         <div class="footer">
            <span>Copyright &copy; 2014 Yamo Pty. Ltd. All Rights Reserved.</span>
         </div>
      </div>
   </body>
</html>