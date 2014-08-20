<?php

   $NBN_MONTHLY_FEE = 100;
   $NBN_ACTIVATION_FEE = 150;
   
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
   
?>

<!doctype html>
<html lang="en">
   <head>
      <title>Zen Quarter Plans | Yamo</title>
      <link rel="stylesheet" type="text/css" href="styles/style.css" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="scripts/jquery-1.11.1.js"></script>
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
            <div class="user-area">
            <h1 class="main-heading">Phone and NBN</h1>
            <div class="form-wrap">
            <form class="form" action="" method="post">
               <table>
               <tr>
               <td><label for="plan">Plan:</label></td>
               <td><select id="plan" name="plan">
                  <option value="none">-- Select one --</option>
                  <option value="lite">Lite</option>
                  <option value="max">Max</option>
                  <option value="complete">Complete</option>
                  <option value="none">No plan</option>
               </select></td>
               </tr>
               <tr>
               <td><label for="handset">Handset:</label></td>
               <td><select id="handset" name="handset">
                  <option value="none">-- Select one --</option>
                  <option value="504">Cisco 504 - $200</option>
                  <option value="514">Cisco 514 - $275</option>
                  <option value="525G2">Cisco 525G2 - $350</option>
                  <option value="302D">Cisco 302D - $375</option>
                  <option value="none">No phone</option>
               </select></td>
               </tr>
               <tr>
                  <td>I require internet:</td>
                  <td><input type="radio" name="internet" value="yes" checked>Yes</input><input type="radio" name="internet" value="no">No</input></td>
               </tr>
               <tr>
               <td colspan="2" style="text-align:center;">
                  <input class="button" type="submit" name="submit" value="Get Quote" />
                  <input class="button" type="reset" name="reset" value="Start over" onclick="$('.quote').hide(1000);" />
               </td>
               </tr>
               </table>
            </form>
            </div>
            
               <?php
                  if (isset($_POST['submit'])) {
                     $planInput = $_POST['plan'];
                     $handsetInput = $_POST['handset'];
                     $internetInput = $_POST['internet'];
                     
                     $handsetCost = 0;
                     $planCost = 0;
                     $planName = '';
                     
                     if (strcmp($planInput, 'none') != 0) $planRequired = true;
                     else $planRequired = false;
                     if (strcmp($handsetInput, 'none') != 0) $handsetRequired = true;
                     else $handsetRequired = false;
                     if (strcmp($internetInput, 'yes') == 0) $internetRequired = true;
                     else $internetRequired = false;
                     
                     if ($planRequired) {
                        foreach ($plans as $key=>$value) {
                           if(strcmp($key, $planInput) == 0) {
                              $planCost = $value;
                              $planName = $key;
                              $planName = ucfirst($planName);
                           }
                        }
                     }
                     
                     if ($handsetRequired) {
                        foreach ($handsets as $handset) {
                           if (strcmp($handset['id'], $handsetInput) == 0) {
                              $handsetCost = $handset['cost'];
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
                     if ($internetRequired) {
                        echo '<h3>Internet</h3>';
                        echo '<table class="quote-table">';
                        
                        echo '<tr><td>Cost:</td><td>$'.$NBN_MONTHLY_FEE.' / month</td></tr>';
                        echo '<tr><td>Activation:</td><td>$150</td></tr>';
                        echo '</table>';
                     } else {
                        echo '<h3>Internet</h3>';
                        echo '<table class="quote-table">';
                        echo '<tr><td>Cost:</td><td>$'. 0 .' / month</td></tr>';
                        echo '<tr><td>Activation:</td><td>$0</td></tr>';
                        echo '</table>';
                     }
                     echo '</div> ';
                     
                     # Calculate total
                     $upfront = $handsetCost;
                     if ($internetRequired) $upfront += $NBN_ACTIVATION_FEE;
                     
                     $monthly = $planCost;
                     if ($internetRequired) $monthly += $NBN_MONTHLY_FEE;
                     
                     echo '<div class="quote-box">';
                     echo '<h3>Total</h3>';
                     echo '<table class="quote-table">';
                     echo '<tr><td>Upfront:</td><td>$'.$upfront.'</td></tr>';
                     echo '<tr><td>Monthly:</td><td>$'.$monthly.'</td></tr>';
                     echo '</table>';
                     echo '</div> ';

                     echo '<span class="stretch"></span>';
                     echo '<button class="quote-button">Confrim quote and continue &#187;</button> ';
                     echo '</div>';
                     echo '<script>$(".quote").show(1000);</script>';
                  }
                  
                  
                  
               ?>
            
            </div>
            <img class="business-voice" alt="Yamo Business Voice" src="images/business-voice.png" />
            <img class="handsets" alt="Yamo cisco handsets" src="images/phones.png" />
            
         </div>
         <div class="footer">
         </div>
      </div>
   </body>
</html>