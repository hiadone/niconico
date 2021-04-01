<?php
include_once('./_common.php');

$action = $_POST['action'];

if ($action == 'saveDefaultItemUselist') {
	$de_filterUselist = isset($_POST['de_filterUselist']) ? $_POST['de_filterUselist'] : '';

	$sql = " update {$g5['g5_shop_default_table']}
				set de_filterUselist        = '{$de_filterUselist}'
			";
	sql_query($sql);

	$res = [
		'code'	=> '1',
		'msg'	=> 'success'
	];
	die(json_encode($res));
}

elseif ($action == 'saveCampaignId') {
	$de_campaignId = isset($_POST['de_campaignId']) ? $_POST['de_campaignId'] : '';

	$sql = " update {$g5['g5_shop_default_table']}
				set de_campaignId			= '{$de_campaignId}'
			";
	sql_query($sql);

	$res = [
		'code'	=> '1',
		'msg'	=> 'success'
	];
	die(json_encode($res));
}
?>