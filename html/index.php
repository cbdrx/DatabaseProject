<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>
<?php require 'php/Tables.php'; ?>
<?php require 'php/Queries.php'; ?>

<!DOCTYPE html>
    
<html>

    <!--<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/base.css" type="text/css" rel="stylesheet">
    <script src="js/jquery-1.12.2.min.js"></script>-->
        
    <title> Home </title>

    <?php include 'navbar.php';?>
    
    
    <link href="css/datatables.min.css" type="text/css" rel="stylesheet">
    <script src="js/datatables.min.js"></script>

    <body>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-6">
                <h2> Accounts Balances </h2> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-1">
                <h5>Checking :</h5>
            </div>
            <div class="col-sm-1">
                <?php
                    $conn = ConnectToDB();
                    $user = $_SESSION["loggedInUser"];
                    $query = "select balance from checkingAccount where FK_user = '$user';";
                    $result = $conn->query($query)->fetch_row()[0];
                    echo "<h5>$ $result </h5>";
                    $conn->close();
                ?>
            </div>
            <div class="col-sm-3"> </div>
                <?php
                    $conn = ConnectToDB();
                    $user = $_SESSION["loggedInUser"];
                    $query = "select balance from savingsAccount where FK_user = '$user';";
                    $result = $conn->query($query);
                    if($result->num_rows > 0)
                    {
                        $savBal = $result->fetch_row()[0];
                        echo "
                            <div class=\"col-sm-1\">
                                <h5> Savings :</h5>
                            </div>
                            <div class=\"col-sm-1\"> <h5>$ $savBal </h5></div>";
                        $conn->close();
                    }
                ?>
            <div class="col-sm-4"> </div>
        </div>
        <div class="row" id="incomeTransactions">
            <div class="row"> 
                <div class="col-sm-1"> </div> 
                <div class="col-sm-6"> 
                    <h2> Income Transactions </h2> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-10 tableWrapper" id="allIncome">
                    <table id="allIncomeTable" class="table table-striped">  
                    <?php
                        echo BuildTable(IncomeTransactionsForUser($_SESSION["loggedInUser"]));
                    ?>
                    </table>  
                </div>
                <div class="col-sm-1"> </div>
            </div>
      </div>
      <div class="row" id="expenseTransactions">
            <div class="row"> 
                <div class="col-sm-1"> </div> 
                <div class="col-sm-6"> 
                    <h2> Expense Transaction </h2> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-10 tableWrapper" id="allExpenses">
                    <table id="allExpensesTable" class="table table-striped">  
                    <?php
                        echo BuildTable(ExpenseTransactionsForUser($_SESSION["loggedInUser"]));
                    ?>
                    </table>  
                </div>
                <div class="col-sm-1"> </div>
            </div>
      </div>
      <div class="row" id="categories">
            <div class="row"> 
                <div class="col-sm-1"> </div> 
                <div class="col-sm-6"> 
                    <h2> Category Goals </h2> 
                </div>
            </div>
            <div class="row">
                    <div class="col-sm-1"> </div>
                    <div class="col-sm-10 tableWrapper">
                        <table id="categoriesTable" class="table table-striped">  
                        <?php
                            echo CategoryGoalsTable($_SESSION["loggedInUser"]);
                        ?>
                        </table>  
                    </div>
                    <div class="col-sm-1"> </div>
        </div>
      </div>
      
    </body>
    
    <script>
        $(document).ready(function () {
            $('#allIncomeTable').dataTable();
            $('#allExpensesTable').dataTable();
            $('#categoriesTable').dataTable();
        });
    </script>
</html>
