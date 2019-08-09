<?php

function printMenu($products)
{
    $menu = "";
    foreach ($products as $row) {
        foreach ($row as $field => $value) {
            if (strpos($field, "Photo") || strpos($field, "tion")) {
                continue;
            }
            $menu .= "<td>$value</td>";
        }
        
        // 按鈕
        $menu .= '
            <td> 
                <input type="text" value="1">
                <button id="' . $row["productID"] . '" onclick="addItem(this)">add</button>
                <button id="' . $row["productID"] . '" onclick="delItem(this)">del</button>
            </td>
        ';
        $menu .= "</tr>";
    }
    echo $menu;
}

?>

   
<table class="menu table-bordered table-hover container-fluid text-center">
        <?php printMenu($data)?>
</table>

<script>

       function addItem(btn){
           console.log(btn.id);
       }

       function delItem(btn){
           // delete
       }

</script>