<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/item.php');
    return;
}

$it_id = get_search_string(trim($_GET['it_id']));
$it_seo_title = isset($it_seo_title) ? $it_seo_title : '';

$it = get_shop_item_with_category($it_id, $it_seo_title);
$it_id = $it['it_id'];

if( isset($row['it_seo_title']) && ! $row['it_seo_title'] ){
    shop_seo_title_update($row['it_id']);
}

if (!$it['it_id'])
    alert('자료가 없습니다.');
if (!($it['ca_use'] && $it['it_use'])) {
    if (!$is_admin)
        alert('현재 판매가능한 상품이 아닙니다.');
}

if ($it['it_isOnlyAdmin'] == 10 && !$is_admin) {
	alert('관리자만 열람이 가능한 상품입니다.');
}

include_once(G5_LIB_PATH.'/iteminfo.lib.php');

// 분류 테이블에서 분류 상단, 하단 코드를 얻음
$sql = " select ca_skin_dir, ca_include_head, ca_include_tail, ca_cert_use, ca_adult_use from {$g5['g5_shop_category_table']} where ca_id = '{$it['ca_id']}' ";
$ca = sql_fetch($sql);

// 본인인증, 성인인증체크
if(!$is_admin) {
    $msg = shop_member_cert_check($it_id, 'item');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

// 오늘 본 상품 저장 시작
// tv 는 today view 약자
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $it_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx);
    set_session("ss_tv[$tv_idx]", $it_id);
}
// 오늘 본 상품 저장 끝

// 조회수 증가
if (get_cookie('ck_it_id') != $it_id) {
    sql_query(" update {$g5['g5_shop_item_table']} set it_hit = it_hit + 1 where it_id = '$it_id' "); // 1증가
    set_cookie("ck_it_id", $it_id, 3600); // 1시간동안 저장
}

// 스킨경로
$skin_dir = G5_SHOP_SKIN_PATH;
$ca_dir_check = true;

if($it['it_skin']) {
    if(preg_match('#^theme/(.+)$#', $it['it_skin'], $match))
        $skin_dir = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $skin_dir = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$it['it_skin'];

    if(is_dir($skin_dir)) {
        $form_skin_file = $skin_dir.'/item.form.skin.php';

        if(is_file($form_skin_file))
            $ca_dir_check = false;
    }
}

if($ca_dir_check) {
    if($ca['ca_skin_dir']) {
        if(preg_match('#^theme/(.+)$#', $ca['ca_skin_dir'], $match))
            $skin_dir = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
        else
            $skin_dir = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_skin_dir'];

        if(is_dir($skin_dir)) {
            $form_skin_file = $skin_dir.'/item.form.skin.php';

            if(!is_file($form_skin_file))
                $skin_dir = G5_SHOP_SKIN_PATH;
        } else {
            $skin_dir = G5_SHOP_SKIN_PATH;
        }
    }
}

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));

$g5['title'] = $it['it_name'].' &gt; '.$it['ca_name'];

// 분류 상단 코드가 있으면 출력하고 없으면 기본 상단 코드 출력
if ($ca['ca_include_head'] && is_include_path_check($ca['ca_include_head']))
    @include_once($ca['ca_include_head']);
else
    include_once(G5_SHOP_PATH.'/_head.php');

// 분류 위치
// HOME > 1단계 > 2단계 ... > 6단계 분류
$ca_id = $it['ca_id'];
$nav_skin = $skin_dir.'/navigation.skin.php';
if(!is_file($nav_skin))
    $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';
include $nav_skin;

if(defined('G5_THEME_USE_ITEM_CATEGORY') && G5_THEME_USE_ITEM_CATEGORY){
    // 이 분류에 속한 하위분류 출력
    $cate_skin = $skin_dir.'/listcategory.skin.php';
    if(!is_file($cate_skin))
        $cate_skin = G5_SHOP_SKIN_PATH.'/listcategory.skin.php';
    include $cate_skin;
}

if ($is_admin) {
    echo '<div class="sit_admin"><a href="'.G5_ADMIN_URL.'/shop_admin/itemform.php?w=u&amp;it_id='.$it_id.'" class="btn_admin btn" title="상품 관리"><span class="sound_only">상품 관리</span><i class="fa fa-cog fa-spin fa-fw"></i></a></div>';
}
?>

<!-- 상품 상세보기 시작 { -->
<?php
// 상단 HTML
echo '<div id="sit_hhtml">'.conv_content($it['it_head_html'], 1).'</div>';

// 보안서버경로
if (G5_HTTPS_DOMAIN)
    $action_url = G5_HTTPS_DOMAIN.'/'.G5_SHOP_DIR.'/cartupdate.php';
else
    $action_url = G5_SHOP_URL.'/cartupdate.php';


// 이전 상품보기
$sql = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id > '$it_id' and SUBSTRING(ca_id,1,4) = '".substr($it['ca_id'],0,4)."' and it_use = '1' order by it_id asc limit 1 ";
$row = sql_fetch($sql);
if ($row['it_id']) {
    $prev_title = '이전상품<span class="sound_only"> '.$row['it_name'].'</span>';
    $prev_href = '<a href="'.get_pretty_url('shop', $row['it_id']).'" id="siblings_prev">';
    $prev_href2 = '</a>'.PHP_EOL;
} else {
    $prev_title = '';
    $prev_href = '';
    $prev_href2 = '';
}

// 다음 상품보기
$sql = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id < '$it_id' and SUBSTRING(ca_id,1,4) = '".substr($it['ca_id'],0,4)."' and it_use = '1' order by it_id desc limit 1 ";
$row = sql_fetch($sql);
if ($row['it_id']) {
    $next_title = '다음 상품<span class="sound_only"> '.$row['it_name'].'</span>';
    $next_href = '<a href="'.get_pretty_url('shop', $row['it_id']).'" id="siblings_next">';
    $next_href2 = '</a>'.PHP_EOL;
} else {
    $next_title = '';
    $next_href = '';
    $next_href2 = '';
}

// 고객선호도 별점수
$star_score = get_star_image($it['it_id']);

// 관리자가 확인한 사용후기의 개수를 얻음
$sql = " select count(*) as cnt from `{$g5['g5_shop_item_use_table']}` where it_id = '{$it_id}' and is_confirm = '1' ";
$row = sql_fetch($sql);
$item_use_count = $row['cnt'];

// 상품문의의 개수를 얻음
$sql = " select count(*) as cnt from `{$g5['g5_shop_item_qa_table']}` where it_id = '{$it_id}' ";
$row = sql_fetch($sql);
$item_qa_count = $row['cnt'];

// 관련상품의 개수를 얻음
if($default['de_rel_list_use']) {
    $sql = " select count(*) as cnt from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '{$it['it_id']}' and  b.it_use='1' ";
    $row = sql_fetch($sql);
    $item_relation_count = $row['cnt'];
}

// 소셜 관련
$sns_title = get_text($it['it_name']).' | '.get_text($config['cf_title']);
$sns_url  = shop_item_url($it['it_id']);
$sns_share_links .= get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png').' ';
$sns_share_links .= get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png').' ';
// 구글플러스 서비스 하지 않음 $sns_share_links .= get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/gplus.png');

// 상품품절체크
if(G5_SOLDOUT_CHECK)
    $is_soldout = is_soldout($it['it_id']);

// 주문가능체크
$is_orderable = true;
if(!$it['it_use'] || $it['it_tel_inq'] || $is_soldout)
    $is_orderable = false;

if($is_orderable) {
    if(defined('G5_THEME_USE_OPTIONS_TRTD') && G5_THEME_USE_OPTIONS_TRTD){
        $option_item = get_item_options($it['it_id'], $it['it_option_subject'], '');
        $supply_item = get_item_supply($it['it_id'], $it['it_supply_subject'], '');
    } else {
        // 선택 옵션 ( 기존의 tr td 태그로 가져오려면 'div' 를 '' 로 바꾸거나 또는 지워주세요 )
        $option_item = get_item_options($it['it_id'], $it['it_option_subject'], 'div', 1);

        // 추가 옵션 ( 기존의 tr td 태그로 가져오려면 'div' 를 '' 로 바꾸거나 또는 지워주세요 )
        $supply_item = get_item_supply($it['it_id'], $it['it_supply_subject'], 'div', 1);
    }

    // 상품 선택옵션 수
    $option_count = 0;
    if($it['it_option_subject']) {
        $temp = explode(',', $it['it_option_subject']);
        $option_count = count($temp);
    }

    // 상품 추가옵션 수
    $supply_count = 0;
    if($it['it_supply_subject']) {
        $temp = explode(',', $it['it_supply_subject']);
        $supply_count = count($temp);
    }
}

function pg_anchor($anc_id) {
    global $default;
    global $item_use_count, $item_qa_count, $item_relation_count;
?>
    <ul class="sanchor">
        <li><a href="#sit_inf" <?php if ($anc_id == 'inf') echo 'class="sanchor_on"'; ?>>상품정보</a></li>
        <li><a href="#sit_use" <?php if ($anc_id == 'use') echo 'class="sanchor_on"'; ?>>사용후기 <span class="item_use_count"><?php echo $item_use_count; ?></span></a></li>
        <li><a href="#sit_qa" <?php if ($anc_id == 'qa') echo 'class="sanchor_on"'; ?>>상품문의 <span class="item_qa_count"><?php echo $item_qa_count; ?></span></a></li>
        <?php if ($default['de_baesong_content']) { ?><li><a href="#sit_dvr" <?php if ($anc_id == 'dvr') echo 'class="sanchor_on"'; ?>>배송정보</a></li><?php } ?>
        <?php if ($default['de_change_content']) { ?><li><a href="#sit_ex" <?php if ($anc_id == 'ex') echo 'class="sanchor_on"'; ?>>교환정보</a></li><?php } ?>
    </ul>
<?php
}

include_once(G5_SHOP_PATH.'/settle_naverpay.inc.php');
?>

<?php if($is_orderable) { ?>
<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<?php } ?>
<script>
    try
    {
        var evt_data = {};
        evt_data.evt = 'view'; // 이벤트코드 'view' 고정.
        evt_data.p_no = '<?php echo $it['it_id'] ?>'; // url상에서 쓰이는 상품코드
        evt_data.p_name = '<?php echo $it['it_name'] ?>'; // 상품명
        evt_data.price = '<?php echo $it['it_price']?>'; // 상품판매가격(숫자만 포함한 문자열)
        evt_data.regular_price = '<?php echo $it['it_price']?>'; // 상품정가(숫자만 포함한 문자열)
        evt_data.thumb = '<?php echo get_it_imageurl($it['it_id'])?>'; // 상품이미지 url
        evt_data.p_url = '<?php echo shop_item_url($it['it_id'])?>'; // 해당 상품페이지 url(트래킹 코드 등이 포함되지 않은        순수 url)
        evt_data.p_url_m = '<?php echo shop_item_url($it['it_id'])?>'; // 해당 상품페이지 모바일 url (optional)
        evt_data.cate1 = '<?php echo $it['ca_name']?>'; // 카테고리 대분류. 존재하지 않으면 ''
        evt_data.cate2 = ''; // 카테고리 중분류. 존재하지 않으면 ''
        evt_data.cate3 = ''; // 카테고리 소분류. 존재하지 않으면 ''
        evt_data.soldout = '<?php echo $it['it_soldout']?>'; // 품절여부. (품절이 아닐경우 '0', 품절일 경우 '1')
        mcroPushEvent(evt_data);
    }catch(e){

    }
</script>
<!-- more 패널, 티커 노출 스크립트 -->
<script>
var meta = document.createElement('meta');
meta.setAttribute('name', 'more_page_type');
meta.setAttribute('content', 'detail');
document.getElementsByTagName('head')[0].appendChild(meta);
var meta2 = document.createElement('meta');
meta2.setAttribute('name', 'more_detail_pid');
meta2.setAttribute('content', '<?php echo $it['it_id'] ?>'); // 현재 페이지의 상품코드
document.getElementsByTagName('head')[0].appendChild(meta2);
</script>
<div id="sit">

    <?php
    // 상품 구입폼
    include_once($skin_dir.'/item.form.skin.php');
    ?>

    <?php
    // 상품 상세정보
    $info_skin = $skin_dir.'/item.info.skin.php';
    if(!is_file($info_skin))
        $info_skin = G5_SHOP_SKIN_PATH.'/item.info.skin.php';
    include $info_skin;
    ?>

</div>

<?php
// 하단 HTML
echo conv_content($it['it_tail_html'], 1);
?>

<?php
if ($ca['ca_include_tail'] && is_include_path_check($ca['ca_include_tail']))
    @include_once($ca['ca_include_tail']);
else
    include_once(G5_SHOP_PATH.'/_tail.php');
?>
