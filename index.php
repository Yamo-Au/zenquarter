<?php
   
?>
<!doctype html>
<html lang="en">
   <head>
      <title>Zen Quarter Plans | Yamo</title>
      <?php include_once('includes/links.php'); ?>
   </head>
   <body>
      <?php include_once('includes/js-hide.php'); ?>
      <div class="wrapper">
         <?php include_once('includes/top.php'); ?>
         <div class="content">
            <div class="user-area">
            <h1 class="main-heading">Customer Details</h1>
            <div class="form-wrap">
            <form id="zenform" class="form" action="confirm.php" method="post" onsubmit="return checkForm();">
               <div class="form-container">
                  <p>
                    <label class="desc">Name *</label><br />
                    <input type="text" class="half required" name="first" value="First name"/><input type="text" class="half required" name="last" value="Last name"/>
                  </p>
                  <p>
                    <label class="desc">Email *</label><br />
                    <input type="text" class="full required" name="email" value="Email address"/>
                  </p>
                  <p>
                    <label class="desc">Address *</label><br />
                    <input type="text" class="full required" name="street1" value="Street address"/><br />
                    <input type="text" class="full" name="street2" value="Street address line 2"/><br />
                    <input type="text" class="half required" name="city" value="City / suburb"/>
                    <select class="half required" name="state" id="state">
                      <option value="none">State</option>
                      <option value="nt">NT</option>
                      <option value="wa">WA</option>
                      <option value="nsw">NSW</option>
                      <option value="act">ACT</option>
                      <option value="qld">QLD</option>
                      <option value="sa">SA</option>
                      <option value="tas">TAS</option>
                    </select>
                    <input type="text" class="half required" name="postcode" value="Postcode"/>
                  </p>
                  <p>
                    <label class="desc">Phone</label><br />
                    <input type="text" class="full required" name="phone" value="Phone number"/>
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
                  <script type="text/javascript" src="scripts/validation.js"></script>
                  <input class="button" type="submit" name="submit" id="submit" value="Get Quote" />
                  <input class="button" type="reset" name="reset" value="Start over" onclick="$('#quote').hide(1000);$('input:text').css('color','lightgray');" />
                </div>
            </form>
            </div>
            </div>
            <img class="voice" alt="Yamo Phone Plans" src="images/voice.png" />
            <img class="nbn" alt="Yamo NBN plans" src="images/nbn.png" />
         </div>
         <?php include_once('includes/footer.php'); ?>
      </div>
   </body>
</html>