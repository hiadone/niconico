<?php
include_once('./_common.php');
include_once(G5_PATH.'/adm/shop_admin/admin.shop.lib.php');
include_once(G5_LIB_PATH.'/etc.lib.php');

$sql = " SELECT * FROM {$g5['g5_shop_default_table']} ";
$default = sql_fetch($sql);

// if ($default['de_autoCompleteShipDay'] > 0) {
    $sql = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_status = '배송' and od_invoice !='' ";

    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        
        if (date("YmdHi", strtotime($row['od_invoice_time'])) == date("YmdHi", time() - ($default['de_autoCompleteShipDay'] * 24 * 60 * 60))) {


         $uSql = " UPDATE {$g5['g5_shop_order_table']} SET od_status = '완료' WHERE od_id = '". $row['od_id'] ."' ";


            echo "<br>";
            echo $uSql;
            echo "<br>";
            echo "<br>";
         sql_query($uSql);
        }
       

        


        
        
    }
// }



?>
