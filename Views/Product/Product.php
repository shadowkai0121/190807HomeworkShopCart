
   <style>
       .menu{
           font-size: 1.5em;
       }

       .menu td {
           padding: 0.5em;
       }

       .menu input{
           text-align: center;
           width: 20%;
       }

       .menu tr td:last-child{
           color: "red";
       }
   </style>
   
   <table class="menu table-bordered table-hover container-fluid text-center">
        <?php
        $menu = "";
            foreach ($data as $row) {
                foreach ($row as $field => $value) {
                    if (strpos($field, "Photo") || strpos($field, "tion")) {
                        continue;
                    }
                    $menu .= "<td>$value</td>";
                }
                $menu .= '
                <td> 
                    <input type="text" value="1">
                    <button>add</button>
                    <button>del</button>
                </td>
                ';
                $menu .= "</tr>";
            }
        echo $menu;
        ?>
    </table>


<script>

    add.onclick = ()=>{
        axios.get("Product/test")
            .then(res=>{
                console.log(res);
            });
    }

</script>