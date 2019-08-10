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
            if (strpos($field, "ID")) {
                continue;
            }
            $list .= "<td>$value</td>";
        }
        $list .= '
            <td> 
                <input id="quantity' . $row["productID"] . '" type="text" value="1">
                <button onclick="addItem(' . $row["productID"] . ')"><span class="glyphicon glyphicon-heart"></span></button>
                <button onclick="delItem(' . $row["productID"] . ')"><span class="glyphicon glyphicon-trash"</span></button>
            </td>
        ';
        $list .= "</tr>";
    }

    echo $list;
}

?>
<?php if ($data["total"] == 0):?>
<h1>購物車內目前沒有產品</h1>
<?php else:?>
<table class="menu table-bordered table-hover container-fluid text-center bg-white">
    <tr>
        <td>產品名稱</td>
        <td>單價</td>
        <td>數量</td>
        <td>小計</td>
        <td></td>
    </tr>
        <?php printShopCart($data)?>
    <tr>
        <td colspan="4">&nbsp;</td>
        <td>
            <div class="row">
                <div class="col-md-6">
                    <span class="">總價：<?=$data["total"]?></span>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-danger" href="#">結帳</a>
                </div>
            </div>
        </td>
    </tr>
</table>
<?php endif?>