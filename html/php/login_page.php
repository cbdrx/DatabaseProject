<?php
  function login()
  {
    session_start();
    $username = $_POST["name"];
    $password = $_POST["password"];
    
    include 'php/Queries.php'; 
    $conn = ConnectToDB();
    $querystring = "select * from user where CLID = " . $username . "and password = " . $password . ";";
    
    $result = $conn->query($querystring);
    if ($result->num_rows() > 0) {
        $_SESSION["loggedInUser"] = $username;
        $_SESSION["errorMessage"] = "";
        header("Location: localhost://home.php");
    }
    else {
        $_SESSION["errorMessage"] = "Incorrect CLID and password combination.";
        session_destroy();
        header("Location: Login.php");
    }
  }
  if (isset($_POST['submit']))
  {
      login();
  }
  ?>
