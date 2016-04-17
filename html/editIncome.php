<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php    
    
    session_start();

    include 'php/Queries.php';
    function edit()
    {
        $conn =  ConnectToDB();
        $id = $_POST["id"];
        $amount = $_POST["amount"];
        $date = $_POST["date"];
        $user = $_SESSION["loggedInUser"];
        $category = $_POST["catID"];
        
        
        $query = "select amount from incomeTransaction where id = '$id';";
        $res = $conn->query($query) or die($conn->error);
        $tup = $res->fetch_row();
        $oldAmount = $tup[0];
        if($oldAmount != $amount)
        {
            
            if($amount < $oldAmount)
            {
                $difference = $oldAmount - $amount;
                $query = "select balance from checkingAccount where FK_user = '$user';";
                $res = $conn->query($query)  or die($conn->error) ;
                $tup = $res->fetch_row();
                $balance = $tup[0];
                if( $balance < $difference)
                {
                    $_SESSION["errorMessage"] = "Removing too much money -- Remove an expense first";
                    header("Location: editIncome.php?id=$id");
                    exit();
                }
                $query = "update checkingAccount set balance = balance - '$difference' where FK_user = '$user';";
                $res = $conn->query($query)  or die($conn->error) ;
                
            }
            else
            {
                $difference = $amount - $oldAmount;
                $query = "update checkingAccount set balance = balance + '$difference' where FK_user = '$user';";
                $res = $conn->query($query)  or die($conn->error) ;
            }
        }
        
        $querystring = "update incomeTransaction set amount = '$amount',
            date = '$date', FK_category = '$category' where id = '$id';";
        

        $result = $conn->query($querystring) or die($conn->error());
        
        if ($result) {
            header("Location: incomes.php");
        }
        else {
            $_SESSION["errorMessage"] = "Failed updating Income";
            header("Location: editIncome.php?id=$id");
        }
    }
    function delete()
    {
        $conn =  ConnectToDB();
        $id = $_POST["id"];
        $user = $_SESSION["loggedInUser"];
        $query = "select * from incomeTransaction where id = '$id';";
        $result = $conn->query($query)->fetch_row();
        $amount = $result[1];
        $query = "select balance from checkingAccount where FK_user = '$user';";
        $result = $conn->query($query)->fetch_row();
        $balance = $result[0];
        if($balance > $amount)
        {
            $query = "update checkingAccount set balance = balance - '$amount' where FK_user = '$user';";
            $conn->query($query); //now the money amount is correct
            $query = "delete from incomeTransaction where id = '$id';";
            
            if ($conn->query($query)) {
                header("Location: incomes.php");
            }
            else {
                $_SESSION["errorMessage"] = "Failed deleting income";
                $query = "update checkingAccount set balance = balance + '$amount' where FK_user = '$user';";
                $conn->query($query); //now the money amount is correct
                header("Location: editIncome.php?id=$id");
            }
        }
        else
        {
            $_SESSION["errorMessage"] = "Not enough money to delete income -- cut back on expenses first";
            header("Location: editIncome.php?id=$id");
        }
    }
    if (isset($_POST['submit']))
    {
        edit();
    }
    if(isset($_POST['delete']))
    {
        delete();
    }
  ?>

<title> Modfying Income </title>

    <?php include 'navbar.php';?>

        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Edit Income </h2> </div>
                        </div>
                        <form action="editIncome.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                
                                    <?php echo $_SESSION["errorMessage"] ?>
                                    <?php 
                                         $userName = $_SESSION["loggedInUser"];
                                         $incomeID = $_GET['id'];
                                         $conn =  ConnectToDB();
                                         //$querystring = "select FK_business, FK_category, from userBusinessCategory where FK_business = '$bisID' and FK_user = '$userName';";
                                         //$result = $conn->query($querystring);
                                         //$currentTuple = $result->fetch_row();
                                         
                                         $query = "select * from incomeTransaction where id = '$incomeID'";
                                         $res = $conn->query($query);
                                         $tuple = $res->fetch_row();
                                         
                                         $initAmount = $tuple[1];
                                         $date = $tuple[2];
                                         $catID = $tuple[4];
                                          echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">ID:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"id\" value=\"$incomeID\"readonly=\"readonly\">";
                                         echo        "</div>" . 
                                                "</div>";                                         
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Amount:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"amount\" value=\"$initAmount\">";
                                         echo        "</div>" . 
                                                "</div>"; 
                                         echo  "<div class=\"row\"> \n" . 
                                            "<div class=\"col-sm-6\">Date:</div>" .
                                            "<div class=\"col-sm-6\">";
                                                echo "<input type=\"date\" name=\"date\" value=\"$date\">";
                                         echo        "</div>" . 
                                                "</div>"; 
                                         echo "<div class=\"row\">" .
                                                    "<div class=\"col-sm-6\">Category:</div>" .
                                                    "<div class=\"col-sm-6\">" .
                                                        "<select name=\"catID\">"; 
                                                    $query_result = AllIncomeCategoriesAndParentForUser($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        if ($currentTuple[0] == $catID)
                                                            echo '<option value="' . $currentTuple[1] . '" selected>' . $currentTuple[0] . ' - ' . $currentTuple[2] . '</option>';
                                                        else
                                                            echo '<option value="' . $currentTuple[1] . '">' . $currentTuple[0] . ' - ' . $currentTuple[2] . '</option>';
                                                    }
                                                echo   "</select>" .
                                                    "</div>" .
                                            "</div>"; 
                                    $conn->close();                  
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="submit" value="submit" name="submit"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="submit" value="delete" name="delete"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>

</html>
