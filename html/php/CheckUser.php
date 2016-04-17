<?php

function isUserLoggedIn()
{
   if($_SESSION["loggedInUser"]) return;
   else
   {
       header("Location: Login.php");
       return;
   };
}

[4:28] 
?>