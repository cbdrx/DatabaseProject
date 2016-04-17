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
        $query = ("select * from expenseTransaction " .
                    "where FK_user = '$username' and checkNumber is not null;");
        $results = $conn->query($query);
        $conn->close();
        return $results;
    }
    
    function DeleteAccount($username)
    {
        $conn = ConnectToDB();
        $query = ("delete from userBusinessCategory where FK_user = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from expenseTransaction where FK_user = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from incomeTransaction where FK_user = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from category where FK_createdBy = '".$username."' and FK_parentID is not null;");
        $results = $conn->query($query);
        $query = ("delete from category where FK_createdBy = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from savingsAccount where FK_user = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from checkingAccount where FK_user = '".$username."';");
        $results = $conn->query($query);
        $query = ("delete from user where CLID = '".$username."';");
        $results = $conn->query($query);
        
        $conn->close();
        return true;
    }
    
    function GetNextCategoryID()
    {
        $conn = ConnectToDB();
        $query = "select Max(id) from category";
        $result = $conn->query($query);
        $currentMax = $result->fetch_row();
        $conn->close();
        return ($currentMax[0] + 1);
    }
    
    function AddDefaultCategoriesForUser($username)
    {
        $conn = ConnectToDB();
        $startAt = GetNextCategoryID();
        $query = ("
        insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
        values('" . ($startAt + 0) . "','Paycheck',  '1', '$username', null,  '1'),
        ('" . ($startAt + 1) . "','Miscellaneous Income',  '1', '$username', null,  '1'),
        ('" . ($startAt + 2) . "','Automobile', '1', '$username', null, '0'),
        ('" . ($startAt + 6) . "','Charity',  '1', '$username', null,  '0'),
        ('" . ($startAt + 7) . "','Clothing',  '1', '$username', null,  '0'),
        ('" . ($startAt + 8) . "','Education', '1', '$username', null, '0'),
        ('" . ($startAt + 12) . "','Food', '1', '$username', null, '0'),
        ('" . ($startAt + 15) . "','Healthcare',  '1', '$username', null,  '0'),
        ('" . ($startAt + 19) . "','Household','1', '$username', null,  '0'),
        ('" . ($startAt + 22) . "','Insurance', '1', '$username',null,'0'),
        ('" . ($startAt + 25) . "','Entertainment',  '1', '$username', null, '0'),
        ('" . ($startAt + 30) . "','Transfer to Savings', '1', '$username', null, '0'),
        ('" . ($startAt + 31) . "','Miscellaneous Expense', '1', '$username', null, '0'); ");
        if($conn->query($query))
        {

            $query = ("
            insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
            values('" . ($startAt + 3) . "','Gasoline', '1', '$username', '" . ($startAt + 2) . "', '0'),
            ('" . ($startAt + 4) . "','Maintenance', '1', '$username', '" . ($startAt + 2) . "', '0'),
            ('" . ($startAt + 5) . "','Auto loan payment', '1', '$username', '" . ($startAt + 2) . "',  '0'),
            ('" . ($startAt + 9) . "','Tuition',  '1', '$username', '" . ($startAt + 8) . "', '0'),
            ('" . ($startAt + 10) . "','Books', '1', '$username', '" . ($startAt + 8) . "', '0'),
            ('" . ($startAt + 11) . "','Student Loan Payment',  '1', '$username', '" . ($startAt + 8) . "',  '0'),
            ('" . ($startAt + 13) . "','Groceries', '1', '$username', '" . ($startAt + 12) . "', '0'),
            ('" . ($startAt + 14) . "','Dining Out',  '1', '$username', '" . ($startAt + 12) . "', '0'),
            ('" . ($startAt + 16) . "','Dental',  '1', '$username', '" . ($startAt + 15) . "', '0'),
            ('" . ($startAt + 17) . "','Vision', '1', '$username', '" . ($startAt + 15) . "', '0'),
            ('" . ($startAt + 18) . "','Medical', '1', '$username', '" . ($startAt + 15) . "',  '0'),
            ('" . ($startAt + 20) . "','Rent / Mortgage Payment','1', '$username', '" . ($startAt + 19) . "',  '0'),
            ('" . ($startAt + 21) . "','Utilities', '1', '$username', '" . ($startAt + 19) . "', '0'),
            ('" . ($startAt + 23) . "','Automobile', '1', '$username', '" . ($startAt + 22) . "',  '0'),
            ('" . ($startAt + 24) . "','Health', '1', '$username', '" . ($startAt + 22) . "',  '0'),
            ('" . ($startAt + 26) . "','Reading Material', '1', '$username', '" . ($startAt + 25) . "', '0'),
            ('" . ($startAt + 27) . "','Movies', '1', '$username', '" . ($startAt + 25) . "',  '0'),
            ('" . ($startAt + 28) . "','Sporting Events',  '1', '$username', '" . ($startAt + 25) . "',  '0'),
            ('" . ($startAt + 29) . "','Sporting Goods', '1', '$username', '" . ($startAt + 25) . "',  '0');");
            if($conn->query($query))
            {
                $conn->close();
                return true;
            }
            else
            {
                $conn->close();
                return false;
            }
        }
        else 
        {
            $conn->close();
            return false;
        }
    }
    
    function AllUsers()
    {
        $conn = ConnectToDB();
        $result = $conn->query("select * from user order by CLID desc;");
        $conn->close();
        return $result;
    }
	
	function AllIncomeCategoriesAndParentForUser($user)
	{
		$conn = ConnectToDB();
		$query = "
			select c2.name Parent, c1.id CatID, c1.name CatName 
				from category c1, category c2 
				where c1.income = '1' and c2.id = c1.FK_parentID and 
				c1.FK_CreatedBy = '$user' and c2.FK_createdBy = '$user'
			union
			select 'No Parent', c1.id CatID, c1.name CatName 
				from category c1 
				where c1.income = '1' and c1.FK_createdBy = '$user'
				and c1.FK_parentID is null;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function AllExpenseCategoriesAndParentForUser($user)
	{
		$conn = ConnectToDB();
		$query = "
			select c2.name Parent, c1.id CatID, c1.name CatName 
				from category c1, category c2 
				where c1.income = '0' and c2.id = c1.FK_parentID and 
				c1.FK_CreatedBy = '$user' and c2.FK_createdBy = '$user'
			union
			select 'No Parent', c1.id CatID, c1.name CatName 
				from category c1 
				where c1.income = '0' and c1.FK_createdBy = '$user'
				and c1.FK_parentID is null;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
    
    function SuBusinessPage()
	{
		$conn = ConnectToDB();
		$query = "
				select ubc.FK_business Business, c.name Category, count(ubc.FK_user) 'Num Users'
				from userBusinessCategory ubc
				inner join category c on c.id = ubc.FK_category
				group by ubc.FK_business, c.name
				order by Business, Category, 'Num Users';
		";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function SuCategories()
	{
		$conn = ConnectToDB();
		$query = "(select c1.FK_createdBy User, c1.id ID, c2.name MetaCategory, c1.name Name, c1.income 'Is Income', c1.goal Goal " .
            " from category as c1, category as c2" .
			" where c1.FK_createdBy = c2.FK_createdBy " .
            " and c1.FK_parentID = c2.id " .
            " order by c2.name, c1.name)
            UNION
            (select c1.FK_createdBy User, c1.id ID, 'Top-Level Category', c1.name Name, c1.income 'Is Income', c1.goal Goal 
                from category as c1
            where c1.FK_parentID is null
             order by c1.name)
            ;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function SuExpenses()
	{
		$conn = ConnectToDB();
		$query = "select * from expenseTransaction
				order by FK_user, date;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function SuIncomes()
	{
		$conn = ConnectToDB();
		$query = "select * from incomeTransaction
				order by FK_user, date;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function SuCheckingAccounts()
	{
		$conn = ConnectToDB();
		$query = "select * from checkingAccount
				order by FK_user;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
	
	function SuSavingsAccounts()
	{
		$conn = ConnectToDB();
		$query = "select * from savingsAccount
				order by FK_user;";
		$result = $conn->query($query);
		$conn->close();
		return $result;
	}
?>
