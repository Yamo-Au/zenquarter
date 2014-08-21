<!doctype html>
<html lang="en">
<head>
   <title>Agreement | Yamo</title>
   <?php include_once('includes/links.php') ?>
</head>
<body>
<div class="wrapper">
   <?php include_once('includes/top.php'); ?>
   <div class="content">
      <?php include_once('includes/show-terms.php') ?>
      <div class="button-area" style="margin-top:10px;">
            <button class="button" id="accept">Accept and download form</button>
            <div>By clicking 'Accept', you agree to the terms and conditions outlined in the above document.</div>
            <script type="text/javascript">
               $('#accept').click(function() {
                  location.href = 'downloads.php';
               });
            </script>
      </div>
   </div> 
   <?php include_once('includes/footer.php'); ?>
</div>
</body>
</html>