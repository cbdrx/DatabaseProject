<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>
<?php require 'php/Tables.php'; ?>
<?php require 'php/Queries.php'; ConnectToDB(); ?>

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
        <div class="row" id="incomeTransactions">
            <div class="row"> 
                <div class="col-sm-1"> </div> 
                <div class="col-sm-6"> 
                    <h2> Checks </h2> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-10 tableWrapper" id="allIncome">
                    <table id="allCheckTable" class="table table-striped">  
                    <?php
                        echo BuildTable(AllChecksForUser($_SESSION["loggedInUser"]));
                    ?>
                    </table>  
                </div>
                <div class="col-sm-1"> </div>
            </div>
        </div>
      </div>
      
    </body>
    
    <script>
        $(document).ready(function () {
            $('#allCheckTable').dataTable();
        });
    </script>
</html>
