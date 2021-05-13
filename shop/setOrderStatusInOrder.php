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

        

        $url = 'https://apis.tracker.delivery/carriers/kr.cjlogistics/tracks/'.$row['od_invoice'];

        // $url = 'https://apis.tracker.delivery/carriers/kr.cjlogistics/tracks/381546375843';
        echo $row['od_invoice'];
        echo "<br>";
         
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($res);


        echo trim($obj->state->text);
        echo "<br>";

        if(trim($obj->state->text) === '배달완료'){
            change_status($row['od_id'], '배송', '완료');

            $receive_number = '';
            $receive_number = preg_replace("/[^0-9]/", "", $row['od_hp']);   

            if ($receive_number) {
                $content = getTemplate('ship_done_3');
                $content = replaceStrPPurio($content);

                $content = str_replace("#{order_name}", $row['od_name'], $content);

                sendPPurio(str_replace("-", "", $receive_number), $content, 'ship_done_3', 4);
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

