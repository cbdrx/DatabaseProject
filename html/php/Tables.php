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

function BuildBusinessTable($username)
{
    $conn = ConnectToDB();
        $query = ("select ucb.FK_business Business, ucb.FK_category CategoryID, category.name Category" .
            " from userBusinessCategory ucb, category " .
            " where FK_user = '$username' " .
            " and FK_category = category.id" .
            " order by FK_business, FK_category;");
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
        $bisID = $currentTuple[0];
        $catID = $currentTuple[1];
        $table .= "<td><a href=\"editBusiness.php?bisID=$bidID&catID=$catID\">Edit</a></td>";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

?>