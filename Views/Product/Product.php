<?php

function printMenu($products)
{
    $menu = "";
    foreach ($products as $row) {
        $menu .= "<tr>";
        foreach ($row as $field => $value) {
            if (strpos($field, "ID")) {
                continue;
            }
            $menu .= "<td>$value</td>";
        }
        
        // 按鈕
        $menu .= '
            <td> 
                <input id="quantity' . $row["productID"] . '" type="text" value="1">
                <button onclick="addItem(' . $row["productID"] . ')"><span class="glyphicon glyphicon-heart"></span></button>
                <button onclick="delItem(' . $row["productID"] . ')"><span class="glyphicon glyphicon-trash"</span></button>
            </td>
        ';
        $menu .= "</tr>";
    }
    echo $menu;
}

?>
   
<table class="menu container-fluid table-bordered text-center bg-white">
        <?php printMenu($data)?>
</table>
