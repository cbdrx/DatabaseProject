<?php
    session_start();
function isUserLoggedIn()
{
   if($_SESSION["loggedInUser"] != '') return;
   else
   {
       header("Location: Login.php");
       exit();
       return;
   };
}
?>
