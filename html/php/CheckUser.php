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
   }
}

function userIsSU()
{
   if($_SESSION["su"] == true) return true;
   else
   {
       return false;
   }
}
?>
