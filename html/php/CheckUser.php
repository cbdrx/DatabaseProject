<?php

function isUserLoggedIn()
{
   if($_SESSION["loggedInUser"]) return;
   else
   {
       header("Location: login.php");
       return;
   };
}

[4:28] 
?>