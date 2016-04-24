<?php
    session_start();
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
        
    $user = $_SESSION["loggedInUser"];
    $query = "select * from savingsAccount where FK_user = '$user';";
    $savings = $conn->query($query);
    
    
    
    
    
    
    
    
    // $tup = $result->fetch_row();
    if ($savings->num_rows > 0)
    {
        $savingsString =           
        '<li>
            <a href="transfer.php"> Transfers </a>
        </li>';
    }
    else
    {
        $savingsString =           
        '<li>
            <a href="createSavings.php"> Create Savings </a>
        </li>';
    }  
    
    
    
    
    $normalUserBar = '<head>
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="css/base.css" type="text/css" rel="stylesheet">
        <script src="js/jquery-1.12.2.min.js"></script>
    </head>
    
    <div class="navbar navbar-inverse affix-top" data-spy="affix" data-offset-top="0">
        <a class="navbar-header" href="index.php"> 
            <div class="navbar-brand">$Kaching</div> 
        </a>
        <div class="nav navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li>
                <a href="incomes.php"> Incomes </a>
            </li> 
            <li> 
                <a href="recordIncome.php"> New Income </a>
            </li>
            <li>
                <a href="expenses.php"> Expenses </a>
            </li> 
            <li>
                <a href="recordExpense.php"> New Expense </a>
            </li> '.
                $savingsString
            .'
            <li>
                <a href="Checks.php"> Checks </a>
            </li>  
            <li>
                <a href="deleteAccount.php"> Delete Account </a>
            </li>
            <li>
                <a href="createCategory.php"> Create Category </a>
            </li> 
            <li>
                <a href="categories.php"> Modify Categories / Goals </a>
            </li>    
            <li>
                <a href="createUserBusinessCategory.php"> Create Business </a>
            </li> 
            <li>
                <a href="businesses.php"> Modify Businesses </a>
            </li>   
             ';
     
     $suBar = '<head>
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="css/base.css" type="text/css" rel="stylesheet">
        <script src="js/jquery-1.12.2.min.js"></script>
    </head>
    
    <div class="navbar navbar-inverse affix-top" data-spy="affix" data-offset-top="0">
        <a class="navbar-header" href="index.php"> 
            <div class="navbar-brand">$Kaching</div> 
        </a>
        <div class="nav navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li>
                <a href="#"> All Businesses </a>
            </li>
            <li>
                <a href="#"> All Categories </a>
            </li>
            <li>
                <a href="#"> All Expenses </a>
            </li>
            <li>
                <a href="#"> All Incomes </a>
            </li>
            <li>
                <a href="#"> All Checking Accounts </a>
            </li>
            <li>
                <a href="#"> All Savings Accounts </a>
            </li>
            <li>
                <a href="suCreateNewUser.php"> Create New Account </a>
            </li>
             ';
    
    
    $LogOutString;
    $chosenBar;
    if(isset($_SESSION["su"]) && $_SESSION["su"] == true && !isset($_SESSION["loggedInUser"]))
    {
        $chosenBar = $suBar;
        $LogOutString = 
        '<li>
            <a href="superHome.php"> Back To SU Page</a>
        </li>';
    }
    else if(isset($_SESSION["su"]) && $_SESSION["su"] == true)
    {
        $chosenBar = $normalUserBar;
        $LogOutString = 
        '<li>
            <a href="superHome.php"> Back To SU Page</a>
        </li>';
        
    }
    else
    {
        $chosenBar = $normalUserBar;
    }
    $LogOutString .= 
    '<li>
        <a href="Login.php"> Logout</a>
    </li>';
    $conn->close();
    
    echo $chosenBar . $LogOutString
             .'
        </div>
        </ul>
    </div>'
;?>
