<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>
    
<html>

    <!--<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/base.css" type="text/css" rel="stylesheet">
    <script src="js/jquery-1.12.2.min.js"></script>-->
        
    <title> Home </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>
    
    <link href="css/datatables.min.css" type="text/css" rel="stylesheet">
    <script src="js/datatables.min.js"></script>

    <body>
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
                    <thead>  
                    <tr>  
                        /* For each header do this */ <th> /* Header */ </th>  
                    </tr>  
                    </thead>  
                    <tbody> 
                    /* For each row in the result */   
                    <tr>  
                        /* For each column in this row */<td> /* Data */ </td>  
                    </tr>  
                    </tbody>  
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
                    <thead>  
                    <tr>  
                        /* For each header do this */ <th> /* Header */ </th>  
                    </tr>  
                    </thead>  
                    <tbody> 
                    /* For each row in the result */   
                    <tr>  
                        /* For each column in this row */<td> /* Data */ </td>  
                    </tr>  
                    </tbody>  
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
                        <thead>  
                        <tr>  
                            /* For each header do this */ <th> /* Header */ </th>  
                        </tr>  
                        </thead>  
                        <tbody> 
                        /* For each row in the result */   
                        <tr>  
                            /* For each column in this row */<td> /* Data */ </td>  
                        </tr>  
                        </tbody>  
                        </table>  
                    </div>
                    <div class="col-sm-1"> </div>
        </div>
      </div>
      
    </body>
    
    <script>
        $(document).ready(function () {
            $('#allIncomeTable').dataTable();
            $('#allExpenseTable').dataTable();
            $('#categoriesTable').dataTable();
        });
    </script>
</html>
