<?php
    function ConnectToDB()
    {
        $servername = "localhost";
        $username = "student";
        $password = "student";

        // Create connection
        $conn = new mysql($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        echo "Connected successfully";
        return $conn;
    }
    
    
?>