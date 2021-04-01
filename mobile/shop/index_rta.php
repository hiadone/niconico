	<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_MSHOP_PATH.'/_head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js?v=1"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.12/handlebars.js?V=1" charset="UTF-8"></script>

<style>
	.sct_wrap { margin-bottom:0px; }
	.sct_10 .sct_imgs { text-align:center; }
	.sct_10 .sct_imgs img {
		max-width: 100%;
		height: auto;
		max-height:280px;
	}
	.sct_10 .sct_txt > a {
		display:block;
		line-height: 1.2;
		height: 17px;
		text-align: left;
		white-space: normal;
		overflow: hidden;
		text-overflow: ellipsis;
		word-wrap: break-word;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
	}
	li.li_cnt:nth-child(even):after {
		content:"";
		display:table;
		clear:both;
		height:20px;
	}
	.sct_icon > .sit_icon { height:20px !important; }
</style>
<script id="entry-template" type="text/x-handlebars-template">
	<div class="sct_wrap">
		<header>
			<h2>{{data_module_header}}</h2>
		</header>
		<ul id="{{table_id}}" class="sct sct_10">
		</ul>
	</div>
</script>

<script id="entry-template2" type="text/x-handlebars-template">
	<li class="sct_li li_cnt" style="width:50%;">
		<div class="li_wr is_view_type_list">
			<div class="sct_imgs">
				<a href="{{data_path}}">
					<img src="{{mobile_image}}" alt="{{content_name}}">
				</a>
			</div>
			<div class="sct_txt">
				<a href="{{data_path}}" class="sct_a">
					{{content_name}}
				</a>
			</div>
			<div class="sct_cost">
				{{numberFormat product_price_mobile}} 원
			</div>      
		</div>
		<div class="sct_icon">
			<span class="sit_icon">
				{{{icon_tag}}}
			</span>
		</div>
	</li>
</script>

<script type="text/javascript">
Handlebars.registerHelper('ifCond',function(v1,v2,options){if(v1===v2){return options.fn(this);}return options.inverse(this);});
Number.prototype.format = function(){if(this==0)return 0;var reg=/(^[+-]?\d+)(\d{3})/;var n=(this+'');while(reg.test(n)){n=n.replace(reg,'\$1'+','+'\$2');};return n;};
Handlebars.registerHelper('rtkNumberFormat',function(num,options){return Number(num).format();});
</script>

<div id="contents">
	<!--/ 모바일영역 /-->
    <main class="main" id="rtk_main">
    </main>
</div>


<script type="text/javascript" src="//pxl.retaku.net/js/retaku_catchback.min.js?v=1" charset="UTF-8"></script>
<script type="text/javascript">
   rtq("pixel","rtk_catchback",{
	"item_id":window.rtk_item_id
	});
</script>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>