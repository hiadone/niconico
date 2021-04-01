<?php
include_once('../common.php');

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
		<rss xmlns:g=\"http://base.google.com/ns/1.0\" version=\"2.0\">
		   <channel>
				<title>니코니코몰</title>
				<link>https://www.niconicomall.com/shop/</link>
				<description>일본 직구 구매대행 쇼핑몰</description>";

$query = " SELECT * FROM {$g5['g5_shop_item_table']} WHERE it_use = '1' AND it_isOnlyAdmin = 0 ORDER BY it_order, it_id DESC ";
$result = sql_query($query);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	if ($row['it_use'] == 1) {
		$availability = 'in stock';
	} else {
		$availability = 'out of stock';

	}

	$imgUrl = get_it_imageurl($row['it_id']);
	$itemInfo = get_shop_item_with_category($row['it_id']);

	$xml .= "<item>
				<g:id>". $row['it_id'] ."</g:id>
				<g:title>". str_replace("&", "&amp;", $row['it_name']) ."</g:title>
				<g:google_product_category>". $itemInfo['ca_name'] ."</g:google_product_category>
				<g:link>https://www.niconicomall.com/shop/item.php?it_id=". $row['it_id'] ."</g:link>
				<g:image_link>". $imgUrl ."</g:image_link>
				<g:availability>". $availability ."</g:availability>
				<g:price>". $row['it_cust_price'] ."</g:price>
				<g:sale_price>". $row['it_price'] ."</g:sale_price>
				<g:product_type>". $itemInfo['ca_name'] ."</g:product_type>
				<g:mobile_link>https://www.niconicomall.com/shop/item.php?it_id=". $row['it_id'] ."&amp;device=mobile</g:mobile_link>
				<g:condition>". $itemInfo['ca_name'] ."</g:condition>
				<g:availability_date>". $row['it_update_time'] ."</g:availability_date>
				<g:shipping_weight>". $row['it_weight'] ."g</g:shipping_weight>
			</item>";

}

$xml .= "</channel>
		</rss>";

header('Content-type: text/xml');
echo $xml;
exit;

/*
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
   <channel>
        <title>니코니코몰</title>
        <link>https://www.niconicomall.com/shop/</link>
        <description>일본 직구 구매대행 쇼핑몰</description>
        <item>
            <g:id><?php $ca['ca_id'];</g:id>
            <g:title>Working Boots Size 7.5</g:title>
            <g:description>Excellent for daily use</g:description>
            <g:google_product_category>Women’s > Shoes > Working Boots</g:google_product_category>
            <g:link>http://www.example.com/product/working-boots</g:link>
            <g:image_link>http://www.example.com/product/image/working-boots.png</g:image_link>
            <g:additional_image_link>http://www.example.com/product/image/working-boots-side.png</g:additional_image_link>
            <g:additional_image_link>http://www.example.com/product/image/working-boots-side_2.png</g:additional_image_link>
            <g:availability>in stock</g:availability>
            <g:price>1299.99 EUR</g:price>
            <g:sale_price>1199.99</g:sale_price>
            <g:gtin>0001234560012</g:gtin>
            <g:brand>Criteo</g:brand>
            <g:adult>TRUE</g:adult>
            <g:product_type>Women’s > Shoes > Working Boots</g:product_type>
            <g:mobile_link>http://m.example.com/product/working-boots</g:mobile_link>
            <g:condition>new</g:condition>
            <g:availability>in stock</g:availability>
            <g:availability_date>2016-06-25T13:00-0800</g:availability_date>
            <g:sale_price_effective_date>2016-03-01T13:00-0800/2016-03-11T15:30-0800</g:sale_price_effective_date>
            <g:item_group_id>abc123</g:item_group_id>
            <g:color>Black</g:color>
            <g:gender>male</g:gender>
            <g:age_group>adult</g:age_group>
            <g:material>leather</g:material>
            <g:pattern>Striped</g:pattern>
            <g:size>L</g:size>
            <g:size_type>regular</g:size_type>
            <g:size_system>US</g:size_system>
            <g:shipping>
                <g:country>US</g:country>
                <g:service>Standard</g:service>
                <g:price>5.5 USD</g:price>
            </g:shipping>
            <g:shipping_weight>1 kg</g:shipping_weight>
            <g:shipping_label>promotion</g:shipping_label>
            <g:multipack>2</g:multipack>
            <g:is_bundle>FALSE</g:is_bundle>
            <g:custom_label_0>custom data 0</g:custom_label_0>
            <g:custom_label_1>custom data 1</g:custom_label_1>
            <g:custom_label_2>custom data 2</g:custom_label_2>
            <g:custom_label_3>custom data 3</g:custom_label_3>
            <g:custom_label_4>custom data 4</g:custom_label_4>
            <g:sale_price_effective_date>2016-03-01T13:00-0800/2016-03-11T15:30-0800</g:sale_price_effective_date>
            <g:adwords_redirect>http://www.mywebsite.com/productpage.html</g:adwords_redirect>
            <g:excluded_destination>Shopping</g:excluded_destination>
            <g:expiration_date>2016-07-24</g:expiration_date>
            <g:unit_pricing_measure>15oz</g:unit_pricing_measure>
            <g:unit_pricing_base_measure>50oz</g:unit_pricing_base_measure>
        </item>



    </channel>
</rss>
*/
?>