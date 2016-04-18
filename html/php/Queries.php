<?php

    // ConnectToDB
    // Returns a mysqli connection object, or causes an error page if it fails
    function ConnectToDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "student";
        $dbName = "KachingDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbName);

        // Check connection
        if ($conn->connect_error) {
           throw new Exception("Connection to Database failed: " . $conn->connect_error);
        } 
        return $conn;
    }
    
    function ValidLogin($username, $password)
    {
        
        $conn = ConnectToDB(); //this will throw an exception if it fails
        
        $results = $conn->query("select clid from user where clid = " . $username . " and password = " . $password . ";");
        if($results->num_rows > 0) //if there was a match
        {
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }
    
    
?>
