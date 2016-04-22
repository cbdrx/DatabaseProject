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
        $query = ("select c2.name, c1.name, c1.goal, SUM(e.amount)" . 
            " from category as c1, category as c2, expenseTransaction as e " .
            " where c1.FK_createdBy = '$username'" .
            " and c2.FK_createdBy = '$username'" .
            " and  e.FK_user = '$username'" .
            " and e.FK_category = c1.id" .
            " and c2.id = c1.FK_parentID ".
            " group by c2.name, c1.name, c1.goal;");
        
        $results = $conn->query($query);
        $conn->close();
        return $results;
        
    }
    
    function AllCategoriesForUser($username)
    {
        $conn = ConnectToDB();
        $query = ("(select c1.id, c2.name MetaCategory, c1.name Name, c1.income 'Is Income', c1.goal Goal " .
            " from category as c1, category as c2" .
            " where c1.FK_createdBy = '$username' " .
            " and c2.FK_createdBy = '$username' ".
            " and c1.FK_parentID = c2.id " .
            " order by c2.name, c1.name)
            UNION
            (select c1.id, 'Top-Level Category', c1.name Name, c1.income 'Is Income', c1.goal Goal 
                from category as c1
            where c1.FK_createdBy = '$username' 
             and c1.FK_parentID is null
             order by c1.name)
            ;");
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function PossibleParentCategories($username)
    {
        $conn = ConnectToDB();
        $query = ("select FK_parentName MetaCategory, name Name " .
            " from category " .
            " where FK_createdBy = '$username' " .
            " and  FK_parentName = 'Default' " .
            " order by FK_parentName, name;");
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function AllBusinessesForUser($username)
    {
        $conn = ConnectToDB();
        $query = ("select ucb.FK_business Business, ucb.FK_category CategoryID, category.name Category" .
            " from userBusinessCategory ucb, category " .
            " where FK_user = '$username' " .
            " and FK_category = category.id" .
            " order by FK_business, FK_category;");
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function AllChecksForUser($username)
    {
        $conn = ConnectToDB();
        $query = ("select * from ExpenseTransaction E " .
                    "where E.FK_user = '$username' and E.checkNumber != NULL;");
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function DeleteAccount($username)
    {
        $conn = ConnectToDB();
        $query = ("delete from userBusinessCategory where FK_user = '$username';");
        $results = $conn->query($query);
        
        $query = ("delete from expenseTransaction where FK_user = '$username';");
        $results = $conn->query($query);
        $query = ("delete from incomeTransaction where FK_user = '$username';");
        $results = $conn->query($query);
        $query = ("delete from category where FK_createdBy = '$username';");
        $results = $conn->query($query);
        $query = ("delete from savingsAccount where FK_user = '$username';");
        $results = $conn->query($query);
        $query = ("delete from checkingAccount where FK_user = '$username';");
        $results = $conn->query($query);
        $query = ("delete from user where CLID = '$username';");
        $results = $conn->query($query);
        
        $conn->close();
        return $results;
    }
    
?>
