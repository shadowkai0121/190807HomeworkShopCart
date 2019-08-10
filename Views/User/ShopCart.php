<?php
function printShopCart($shopcart)
{
    $list = "";
    foreach ($shopcart as $index => $row) {
        if ($index === "total") {
            continue;
        }
        $list .= "<tr>";
        foreach ($row as $field => $value) {
            if (strpos($field, "Photo")) {
                continue;
            }
            $list .= "<td>$value</td>";
        }
        $list .= '
            <td> 
                <input id="quantity' . $row["productID"] . '" type="text" value="1">
                <button onclick="addItem(' . $row["productID"] . ')">add</button>
                <button onclick="delItem(' . $row["productID"] . ')">del</button>
            </td>
        ';
        $list .= "</tr>";
    }

    echo $list;
}

?>

<table class="menu table-bordered table-hover container-fluid text-center bg-white">
        <?php printShopCart($data)?>
</table>