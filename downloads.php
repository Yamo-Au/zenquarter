<?php include_once('includes/prevent.php'); ?>
<!doctype html>
<html lang="en">
<head>
   <title>Agreement | Yamo</title>
   <?php include_once('includes/links.php') ?>
   <script type="text/javascript">
      function downloadPDF() {
         var win = window.open('forms/yamo-dd.pdf', '_blank');
         win.focus();
      }
   </script>
</head>
<body onload="$('#download-link').trigger('click');">
<?php include_once('includes/js-hide.php'); ?>
<div class="wrapper">
   <?php include_once('includes/top.php'); ?>
   <div class="content">
      <h1>Almost there!</h1>
      <p>Your form should download automatically. Please <a id="download-link" href="" onclick="downloadPDF();">click here</a> if you want to download manually.</p>
      <p>Please print, complete, sign, scan and email to <a href="">sales@yamo.com.au.</a></p>
   </div>
   <?php include_once('includes/footer.php'); ?>
</div>
</body>
</html>