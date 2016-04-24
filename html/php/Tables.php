<?php

function BuildTable($query_result)
{
    $numFields = $query_result->field_count;
    $table = "<thead>\n\t<tr>";
    
    for($i = 0; $i < $numFields; $i++)
    {
        $table .= ("<th> ". ($query_result->fetch_field_direct($i)->name) . " </th>\n");
    }
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < $query_result->num_rows; $i++)
    {
        $table .= "<tr>";
        $currentTuple = $query_result->fetch_row();
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $currentTuple[$j];
            $table .= "</td>\n";
        }
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function BuildCategoryTable($username)
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
    $query_result = $conn->query($query);
    $conn->close();
        
    $numFields = $query_result->field_count;
    $table = "<thead>\n\t<tr>";
    
    for($i = 0; $i < $numFields; $i++)
    {
        $table .= ("<th> ". ($query_result->fetch_field_direct($i)->name) . " </th>\n");
    }
    
    $table .= "<th>Edit</th>";
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < $query_result->num_rows; $i++)
    {
        $table .= "<tr>";
        $currentTuple = $query_result->fetch_row();
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $currentTuple[$j];
            $table .= "</td>\n";
        }
        $table .= "<td><a href=editCategory.php?id=" . $currentTuple[0] . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function BuildExpensesTable($username)
{
    $conn = ConnectToDB();
        $query = ("select id ID, amount Amount, date Date, FK_category Category, FK_Business Business, FK_accountNumber 'Account #', checkNumber 'Check #'" .
            " from expenseTransaction " .
            " where FK_user = '$username' " .
            " order by date DESC;");
    $query_result = $conn->query($query) or die( $conn->error );
    $conn->close();
        
    $numFields = $query_result->field_count;
    $table = "<thead>\n\t<tr>";
    
    for($i = 0; $i < $numFields; $i++)
    {
        $table .= ("<th> ". ($query_result->fetch_field_direct($i)->name) . " </th>\n");
    }
    
    $table .= "<th>Edit</th>";
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < $query_result->num_rows; $i++)
    {
        $table .= "<tr>";
        $currentTuple = $query_result->fetch_row();
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $currentTuple[$j];
            $table .= "</td>\n";
        }
        $table .= "<td><a href=editExpense.php?id=" . $currentTuple[0] . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function BuildSUHomeTable()
{
    $query_result = AllUsers();
        
    $numFields = $query_result->field_count;
    $table = "<thead>\n\t<tr>";
    
    for($i = 0; $i < $numFields; $i++)
    {
        $table .= ("<th> ". ($query_result->fetch_field_direct($i)->name) . " </th>\n");
    }
    
    $table .= "<th>Log In As</th>";
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < $query_result->num_rows; $i++)
    {
        $table .= "<tr>";
        $currentTuple = $query_result->fetch_row();
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $currentTuple[$j];
            $table .= "</td>\n";
        }
        $table .= "<td><a href=\"php/sufakeidentity.php?user=" . $currentTuple[0] . "\">Log In As</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function BuildIncomesTable($username)
{
    $conn = ConnectToDB();
        $query = ("select id ID, amount Amount, date Date, FK_category Category " .
            " from incomeTransaction " .
            " where FK_user = '$username' " .
            " order by date DESC;");
    $query_result = $conn->query($query) or die( $conn->error );
    $conn->close();
        
    $numFields = $query_result->field_count;
    $table = "<thead>\n\t<tr>";
    
    for($i = 0; $i < $numFields; $i++)
    {
        $table .= ("<th> ". ($query_result->fetch_field_direct($i)->name) . " </th>\n");
    }
    
    $table .= "<th>Edit</th>";
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < $query_result->num_rows; $i++)
    {
        $table .= "<tr>";
        $currentTuple = $query_result->fetch_row();
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $currentTuple[$j];
            $table .= "</td>\n";
        }
        $table .= "<td><a href=editIncome.php?id=" . $currentTuple[0] . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function CategoryGoalsTable($username)
{
    $conn = ConnectToDB();
    $query = ("select cc.id, pc.name, cc.name, cc.goal, cc.income
        from category as cc, category as pc
        where cc.FK_createdBy = '$username' 
        and pc.id = cc.FK_parentID
        and cc.goal is not null
        UNION
        select cc.id, 'Top Level Category', cc.name, cc.goal, cc.income
        from category as cc
        where cc.FK_createdBy = '$username' 
        and cc.FK_parentID is null
        and cc.goal is not null;");
    $userCategories = $conn->query($query) or die( $conn->error );
    $categoryArray = [];
    $sumsArray = [];
    for($i = 0; $i < $userCategories->num_rows; $i++)
    {
        array_push($categoryArray, $userCategories->fetch_row());
    }
    for($i = 0; $i < count($categoryArray); $i++)
    {
        $id = $categoryArray[$i][0];
        $total = 0;
        $value;
        if($categoryArray[$i][4] == 0)
        {
            $query = "select SUM(e.amount) 
                from category as cc, expenseTransaction as e
                where cc.id = e.FK_category
                and 
                (
                    cc.id = '$id' or
                    cc.FK_parentID = '$id'
                );";
        }
        else
        {
            $query = "select SUM(i.amount) 
                from category as cc, incomeTransaction as i
                where cc.id = i.FK_category
                and 
                (
                    cc.id = '$id' or
                    cc.FK_parentID = '$id'
                );";
        }
        
        $value = $conn->query($query)->fetch_row()[0];
        if($value == NULL)
        {
            $value = 0;
        }
        array_push($sumsArray, $value);
    } //now we should have two arrays : One of categories, one of the value spent in it
    
    
        
    $numFields = 4; //the "Income" field and others will be manually set to strings
    $table = "<thead>\n\t<tr>";
    
    $table .= ("<th> Category ID </th>\n");
    $table .= ("<th> MetaCategory </th>\n");
    $table .= ("<th> Category </th>\n");
    $table .= ("<th> Goal </th>\n");
    $table .= ("<th> Type </th>\n");
    $table .= ("<th> Total </th>\n");
    $table .= ("<th> Goal Met? </th>\n");
       
    $table .= "</tr></thead>";
    
    $table .= "<tbody>";
    for($i = 0; $i < count($categoryArray); $i++)
    {
        $table .= "<tr>";
        for($j = 0; $j < $numFields; $j++)
        {
            $table .= "<td>";
            $table .= $categoryArray[$i][$j];
            $table .= "</td>\n";
        }
        if($categoryArray[$i][4] == 0) //if expense category
        {
            $table .= "<td>Expense</td>\n";
            $table .= "<td>" . $sumsArray[$i] . "</td>";//now output the amount spent
            if($sumsArray[$i] < $categoryArray[$i][3]) //we want to spend less than our goal
            {
                $table .= "<td>MET</td>\n";
            }
            else
            {
                $table .= "<td>UNMET</td>\n";
            }
        }
        else //if income category
        {
            $table .= "<td>Income</td>\n";
            $table .= "<td>" . $sumsArray[$i] . "</td>";//now output the amount earned
            if($sumsArray[$i] > $categoryArray[$i][3]) //we want to make more income than our goal
            {
                $table .= "<td>MET</td>\n";
            }
            else
            {
                $table .= "<td>UNMET</td>\n";
            }
        }
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}
?>