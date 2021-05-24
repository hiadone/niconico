<?php
include_once('/home/devniconicomall/www/common.php');
include_once(G5_PATH.'/adm/shop_admin/admin.shop.lib.php');
include_once(G5_LIB_PATH.'/etc.lib.php');






$receive_number = '';
$receive_number = '01075060206';   

if ($receive_number) {

    $content = getTemplate('ship_done_6');
    $content = replaceStrPPurio($content);

    $content = str_replace("#{order_name}", $row['od_name'], $content);

    sendPPurio(str_replace("-", "", $receive_number), $content, 'ship_done_6', 6);
    // sendPPurio(str_replace("-", "", $receive_number), $content, 'ship_done_2', 4);
}

exit;
$sql = " SELECT * FROM {$g5['g5_shop_default_table']} ";
$default = sql_fetch($sql);

// if ($default['de_autoCompleteShipDay'] > 0) {
	$sql = " SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_status = '배송' and od_invoice !='' ";

	$result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        
        if (date("YmdHi", strtotime($row['od_invoice_time'])) < date("YmdHi", time() - (3 * 24 * 60 * 60))) {
            $url = 'https://apis.tracker.delivery/carriers/kr.cjlogistics/tracks/'.$row['od_invoice'];

            // $url = 'https://apis.tracker.delivery/carriers/kr.cjlogistics/tracks/381546375843';
            echo $row['od_invoice'];
            echo "\n";
             
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($res);


            echo trim($obj->state->text);
            echo "\n";
            echo "\n";
            if(trim($obj->state->text) === '배달완료'){
                change_status($row['od_id'], '배송', '완료');
                $it_list='';
                $receive_number = '';
                $receive_number = preg_replace("/[^0-9]/", "", $row['od_hp']);   

                $sql = " select * from {$g5['g5_shop_cart_table']} where od_id = '$row['od_id']' ";
                $res2 = sql_query($sql);

                for ($i=0; $row2=sql_fetch_array($res2); $i++)
                {
                    $it_list .= $row2['it_name'] . " : ". $row2['ct_qty']. "개\n";
                }

                if ($receive_number) {
                    $content = getTemplate('ship_done_6');
                    $content = replaceStrPPurio($content);

                    $content = str_replace("#{order_name}", $row['od_name'], $content);
                    $content = str_replace("#{it_list}", $it_list, $content);

                    sendPPurio(str_replace("-", "", $receive_number), $content, 'ship_done_6', 6,$row['od_invoice']);
                }
            }
        
        }
       

        


        
		// if (date("YmdHi", strtotime($row['od_invoice_time'])) == date("YmdHi", time() - ($default['de_autoCompleteShipDay'] * 24 * 60 * 60))) {


		// 	$uSql = " UPDATE {$g5['g5_shop_order_table']} SET od_status = '완료' WHERE od_id = '". $row['od_id'] ."' ";


  //           echo "<br>";
  //           echo $uSql;
  //           echo "<br>";
  //           echo "<br>";
		// 	sql_query($uSql);
		// }
	}
// }



?>
