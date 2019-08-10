<?php

function printMenu($products)
{
    $menu = "";
    foreach ($products as $row) {
        $menu .= "<tr>";
        foreach ($row as $field => $value) {
            if (strpos($field, "ID")||strpos($field, "Photo") || strpos($field, "tion")) {
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

<script>

        let url = 
            window.location.protocol + "//" +
            window.location.hostname + "/" +
            "190807HomeworkShopCart/";

        function addItem(product){
            let qnt = document.getElementById("quantity" + product).value;
            let uri = 
                url +
                "User/addItem/" +
                product + "/" + qnt;

            $.post(uri)
                .then(res => {
                    console.log(res.data);
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