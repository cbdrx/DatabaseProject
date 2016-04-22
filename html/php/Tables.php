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

function BuildCategoryTable($query_result)
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
        $table .= "<td><a href=editCategory.php?id=" . $currentTuple[0] . ">Edit</a></td>\n";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    
    return $table;
}

?>