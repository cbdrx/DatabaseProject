<?php
    // session_start();
    //         include 'php/Queries.php'; 
    //         $conn = ConnectToDB();
    //         $user = $_SESSION["loggedInUser"];
    //         $query = "select * from savingsAccount where FK_user = '$user';";
    //         $result = $conn->query($query);
    //         // $tup = $result->fetch_row();
    //         if ($result->num_rows > 0)
    //         {
    //             $savingsString =           
    //             '<li>
    //                 <a href="transfer.php"> Transfers </a>
    //             </li>';
    //         }
    //         else
    //         {
    //             $savingsString =           
    //             '<li>
    //                 <a href="createSavings.php"> Create Savings </a>
    //             </li>';
    //         }  
    //         $conn->close();

    echo
    '<head>
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
                <a href="recordIncome.php"> New Income </a>
            </li>
            <li>
                <a href="recordExpense.php"> New Expense </a>
            </li> 
			<li>
				<a href=#>Trans/Savings Goes Here</a>
			</li>
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
             <li>
                <a href="Login.php"> Logout </a>
            </li>  
        </div>
        </ul>
    </div>'
;?>
