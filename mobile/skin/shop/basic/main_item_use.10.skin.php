<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);

// 장바구니 또는 위시리스트 ajax 스크립트
add_javascript('<script src="'.G5_JS_URL.'/shop.list.action.js"></script>', 10);
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>
<div class="st_30_wr">
<!-- 메인상품진열 30 시작 { -->
<?php
$li_width = intval(100 / $this->list_mod);
$li_width_style = ' style="width:'.$li_width.'%;"';
$i=0;

foreach((array) $list as $row){

    if( empty($row) ) continue;

    $item_link_href = shop_item_url($row['it_id']);
    $star_score = $row['it_use_avg'] ? (int) get_star($row['it_use_avg']) : '';

    if ($i == 0) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_30\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"sct_li{$li_clear}\">\n";
    echo "<div class=\"li_wr\">\n";

    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$item_link_href}&tab_tit=sit_use&is_id=".$row['is_id']."#sit_use\" >\n";
    }

    // if($row['is_type'] === 'photo'){

    //     $thumb = get_list_thumbnail('review',$row['is_id'], $this->img_width, $this->img_height, false, false);

    //     if($thumb['src']) {
    //         echo  '<img  src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
    //     } else {
    //         echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    //     }
    // } else {
        if ($this->view_it_img) {
            echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
        }           
    // }
    

    if ($this->href) {
        echo "</a></div>\n";
    }

    echo "<div class=\"sct_txt_wr\">\n";

    // 사용후기 평점표시
    if ($this->view_star && $star_score) {

        echo "<div class=\"sct_star\">\n";

        if ($this->view_it_name) {
            echo "<div class=\"sct_txt\" style=\"font-size: 1.083em;\">".stripslashes($row['it_name'])."</div>\n";
        }
        echo "<img src=\"".G5_SHOP_URL."/img/s_star".$star_score.".png\" alt=\"별점 ".$star_score."점\" class=\"sit_star\" style=\"width:25%\"></div>\n";
    }

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    
    

    if ($this->view_is_subject) {        
        echo "<div class=\"\" style='text-align:left;
    margin: 0 0 10px;
    padding: 5px 0 10px;
    line-height: 1.3em;
    border-bottom: 1px solid #e3e6e9;'>".stripslashes($row['is_subject'])."</div>\n";
        echo "<div style='text-align:left;'>".conv_subject(strip_tags($row['is_content']),24,'...')."</div>\n";
        echo "<div style='text-align:right;'>".replaceNameFunc(get_text($row['is_name']))."</div>\n";
    }



    if ($this->href) {
        echo "</a></div>\n";
    }

     if ($this->view_it_cust_price || $this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";
        if ($this->view_it_cust_price && $row['it_cust_price']) {
                echo "<span class=\"sct_dict\" style=\"display:inline-block;text-decoration: line-through;color:#aaa;font-weight:400;\">".display_price($row['it_cust_price'])."</span>\n";
            }
         if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

//        echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        echo "</div>\n";
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = $item_link_href;
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
        echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
        echo "</div>\n";
    }
    echo "</div>\n";

    echo "</div>\n";

    echo "</li>\n";

    $i++;
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";


function replaceNameFunc($str) {
    $name_x ='*';
    $name_a = mb_substr($str,0,1,"UTF-8");
    $name_b = mb_substr($str,2,10,"UTF-8");
    $str = $name_a.$name_x.$name_b;
    return $str;
}
?>
<!-- } 상품진열 30 끝 -->
</div>

<script>
$('.sct_30').bxSlider({
    minSlides: 1,
    maxSlides: 1,
    
    controls: false,
    infiniteLoop: true

});
</script>

