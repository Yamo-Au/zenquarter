<?php

   session_start();
   
   # Redirects new user if they attempt to access directly before filling form.
   if (!isset($_SESSION['id']))
      header('Location: index.php');
   
?>