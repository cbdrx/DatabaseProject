<?php
    // ConnectToDB
    // Returns a mysqli connection object, or causes an error page if it fails
    function ConnectToDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "student";
        $dbname = "KachingDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
           throw new Exception("Connection to Database failed: " . $conn->connect_error);
        } 
        return $conn;
    }
    
    function ValidLogin($username, $password)
    {
        
        $conn = ConnectToDB(); //this will throw an exception if it fails
        
        $results = $conn->query("select clid from user where clid = ' $username' and password = '$password';");
        if($results->num_rows > 0) //if there was a match
        {
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }
    
    function IncomeTransactionsForUser($username)
    {
        $conn = ConnectToDB();
        
        $query = "select * from incomeTransaction where FK_user = '$username' order by date desc;";
        
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function ExpenseTransactionsForUser($username)
    {
        $conn = ConnectToDB();
        $query = "select * from expenseTransaction where FK_user = '$username' order by date desc;";
        
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function CategoryTableRowsForUser($username)
    {
        $conn = ConnectToDB();
        $query = ("select c.FK_parentName, c.name, c.goal, SUM(e.amount)" . 
            " from category as c, expenseTransaction as e " .
            " where c.FK_createdBy = '$username'" .
            " and  e.FK_user = '$username'" .
            " and e.FK_category = c.name" .
            " group by c.FK_parentName, c.name, c.goal");
        
        $results = $conn->query($query);
        $conn->close();
        return $results;
        
    }
    
    
    
    
?>
