<?php include_once('includes/prevent.php'); ?>
<?php
   
if (isset($_POST['accept'])) {
   # Build string to be emailed to sales
   $message = 'Dear sales,\nA customer has expressed interest in our product. Please find details below.\n\n';
   $message .= 'Name:\t'.$_SESSION['firstname'].' '.$_SESSION['lastname'].'\n';
   $message .= 'Email:\t'.$_SESSION['email'].'\n';
   $message .= 'Address:\t'.$_SESSION['street1'].' '.$_SESSION['street2'].', '.$_SESSION['city'].', '.$_SESSION['state'].' '.$_SESSION['postcode'].'\n';
   $message .= 'Phone:\t'.$_SESSION['phone'];
   $message .= 'NBN Plan:\t'.$_SESSION['plan'];
   $message .= '\n\nThis is an automatically generated email.\n';
   
   # Email to sales
   $to = 'test@test.com.au';                             # change as desired
   mail($to, 'Customer interest - '.$email, $message);
   
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