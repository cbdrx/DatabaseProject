<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>
<?php require 'php/Tables.php'; ?>
<?php require 'php/Queries.php'; ConnectToDB(); ?>

<!DOCTYPE html>
    
<html>

    <!--<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/base.css" type="text/css" rel="stylesheet">
    <script src="js/jquery-1.12.2.min.js"></script>-->
        
    <title> Incomes </title>

    <?php include 'navbar.php';
        unset($_SESSION["errorMessage"]);?>
    
    
    <link href="css/datatables.min.css" type="text/css" rel="stylesheet">
    <script src="js/datatables.min.js"></script>

    <body>
        <div class="row" id="incomes">
            <div class="row"> 
                <div class="col-sm-1"> </div> 
                <div class="col-sm-6"> 
                    <h2> Incomes </h2> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-10 tableWrapper" id="allIncomes">
                    <table id="allIncomesTable" class="table table-striped">  
                    <?php
                        echo BuildIncomesTable($_SESSION["loggedInUser"]);
                    ?>
                    </table>  
                </div>
                <div class="col-sm-1"> </div>
            </div>
      </div>      
    </body>
    
    <script>
        $(document).ready(function () {
            $('#allIncomesTable').dataTable();
        });
    </script>
</html>
