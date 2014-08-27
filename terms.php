<?php include_once('includes/prevent.php'); ?>
<?php
   
if (isset($_POST['accept'])) {
   # Build string to be emailed to sales
   $message = "Dear sales,\r\nA customer has expressed interest in our product. Please find details below.\r\n\r\n";
   $message .= "Name: ".$_SESSION["firstname"]." ".$_SESSION["lastname"]."\r\n";
   $message .= "Email: ".$_SESSION["email"]."\r\n";
   $message .= "Address: ".$_SESSION["street1"]."/".$_SESSION["street2"].", ".$_SESSION["city"].", ".$_SESSION["state"]." ".$_SESSION["postcode"]."\r\n";
   $message .= "Phone: ".$_SESSION["phone"]."\r\n";
   $message .= "NBN Plan: ".$_SESSION["plan"]."\r\n";
   $message .= "\r\nThis is an automatically generated email.\r\n";
   
   $from = "support@yamo.com.au";
   $to = "mark@yamo.com.au";
   $subject = "Zenquarter cutomer: ".$_SESSION['firstname'].' '.$_SESSION['lastname'];
   $headers = "From:" . $from;
   mail($to,$subject,$message, $headers);
   echo "Test email sent";
   
   # Redirect user to form download page
   header('Location: downloads.php');
}
   
?>

<!doctype html>
<html lang="en">
<head>
   <title>Agreement | Yamo</title>
   <?php include_once('includes/links.php') ?>
</head>
<body>
<?php include_once('includes/js-hide.php'); ?>
<div class="wrapper">
   <?php include_once('includes/top.php'); ?>
   <div class="content">
      <h3 style="margin-bottom: -22px;">Please review the terms and conditions, and click accept to download your form.</h3>
      <?php include_once('includes/show-terms.php') ?>
      <div class="button-area" style="margin-top:10px;">
            <form method="post" action="">
               <button class="button" id="accept" name="accept">Accept and download form</button>
            </form>
            <div>By clicking 'Accept', you agree to the terms and conditions outlined in the above document.</div>
      </div>
   </div> 
   <?php include_once('includes/footer.php'); ?>
</div>
</body>
</html>