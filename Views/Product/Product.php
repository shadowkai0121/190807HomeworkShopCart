<?php

function printMenu($products)
{
    $menu = "";
    foreach ($products as $row) {
        $menu .= "<tr>";
        foreach ($row as $field => $value) {
            if (strpos($field, "Photo") || strpos($field, "tion")) {
                continue;
            }
            $menu .= "<td>$value</td>";
        }
        
        // 按鈕
        $menu .= '
            <td> 
                <input id="quantity' . $row["productID"] . '" type="text" value="1">
                <button onclick="addItem(' . $row["productID"] . ')">add</button>
                <button onclick="delItem(' . $row["productID"] . ')">del</button>
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

<script>

        let url = 
            window.location.protocol + "//" +
            window.location.hostname + "/" +
            "190807HomeworkShopCart/";

        function addItem(product){
            let qnt = document.getElementById("quantity" + product).value;
            let uri = 
                "User/addItem/" +
                product + "/" + qnt;

            $.post(uri)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    if(err.status == 401){
                        window.location.href = url + "User";
                    }
                });
       }

       function delItem(btn){
           // delete
       }

</script>