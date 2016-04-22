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
        $query = ("select id, FK_parentName MetaCategory, name Name, income 'Is Income', goal Goal " .
            " from category " .
            " where FK_createdBy = '$username' " .
            " order by FK_parentName, name;");
    $query_results = $conn->query($query);
    $conn->close();
        
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
        $table .= "<td><a href=editCategory.php?id=" . $currentTuple[0] . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

function BuildBusinessTable($username)
{
    $conn = ConnectToDB();
        $query = ("select FK_business Business, FK_category Category " .
            " from userBusinessCategory " .
            " where FK_user = '$username' " .
            " order by FK_business, FK_category;");
    $query_results = $conn->query($query);
    $conn->close();
        
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
        
        $conn = ConnectToDB();
        $catName = $currentTuple[1];
        $query = ("select id from category where name = '$catname' and FK_user = '$username'");
        $newResults = $conn->query($query);
        $newRow = $newResults->fetch_row();
        $catID = $newRow[0];
        $conn->close();
        
        $table .= "<td><a href=editCategory.php?business=" . $currentTuple[0] . "&category='$catID'" . "&user='$username'" . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

?>