<?php
include_once('./_common.php');

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL."/mypage.php"));

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/mypage.php');
    return;
}

// 테마에 mypage.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_mypage_file = G5_THEME_SHOP_PATH.'/mypage.php';
    if(is_file($theme_mypage_file)) {
        include_once($theme_mypage_file);
        return;
        unset($theme_mypage_file);
    }
}

$g5['title'] = '마이페이지';
include_once('./_head.php');

// 쿠폰
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
			  and cp_method != 10 ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
}
?>

<!-- 마이페이지 시작 { -->
<style>
button.btn01 {
	display: inline-block;
    padding: 7px;
    border: 1px solid #ff7e00;
    border-radius: 3px;
    background: #ff7e00;
    color: #fff;
    text-decoration: none;
    vertical-align: middle;
	line-height:25px;
	padding:0 5px;
}
</style>
<div id="smb_my">

    <!-- 회원정보 개요 시작 { -->
    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <div>
			<strong class="my_ov_name"><img src="<?php echo G5_IMG_URL ;?>/no_profile.gif" alt="프로필이미지"> <span><?php echo $member['mb_name']; ?></span> <span class="m-rat-label <?php echo $memberLevel[$member['mb_level']]; ?>"><?php echo $memberLevel[$member['mb_level']]; ?></span></strong>
		</div>

        <dl class="cou_pt">
            <dt>보유포인트</dt>
            <dd>
				<?php
					if ($member['mb_point'] > 0) {
				?>
				<a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point">
				<?php
					}
				?><?php echo number_format($member['mb_point']); ?></a> 점</dd>
            <dt>보유쿠폰</dt>
			<?php if($cp_count > 0) {?>
            <dd>
				<a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?></a></dd>
			<?php }else{ ?>
			<dd><?php /*<a href="javascript:alert('보유중인 쿠폰이 없습니다');">*/?>
			<?php echo number_format($cp_count); ?></a></dd>
			<?php } ?>
        </dl>
        <div id="smb_my_act">
            <ul>
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
                <li><button class="win_add_coupon btn01">쿠폰 등록하기</button></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank" class="win_memo btn01">쪽지함</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn01">회원정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn01">회원탈퇴</a></li>
            </ul>
        </div>

        <dl class="op_area">
            <dt>연락처</dt>
            <dd><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></dd>
            <dt>E-Mail</dt>
            <dd><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></dd>
            <dt>최종접속일시</dt>
            <dd><?php echo $member['mb_today_login']; ?></dd>
            <dt>회원가입일시</dt>
            <dd><?php echo $member['mb_datetime']; ?></dd>
            <dt id="smb_my_ovaddt">주소</dt>
            <dd id="smb_my_ovaddd"><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></dd>
        </dl>
        <div class="my_ov_btn"><button type="button" class="btn_op_area"><i class="fa fa-caret-up" aria-hidden="true"></i><span class="sound_only">상세정보 보기</span></button></div>

    </section>
    <script>
    
        $(".btn_op_area").on("click", function() {
            $(".op_area").toggle();
            $(".fa-caret-up").toggleClass("fa-caret-down")
        });

    </script>
    <!-- } 회원정보 개요 끝 -->

    <!-- 최근 주문내역 시작 { -->
    <section id="smb_my_od">
        <h2>최근 주문내역</h2>
        <?php
        // 최근 주문내역
        define("_ORDERINQUIRY_", true);

        $limit = " limit 0, 5 ";
        include G5_SHOP_PATH.'/orderinquiry.sub.php';
        ?>

        <div class="smb_my_more">
            <a href="./orderinquiry.php">더보기</a>
        </div>
    </section>
    <!-- } 최근 주문내역 끝 -->

    <!-- 최근 위시리스트 시작 { -->
    <section id="smb_my_wish">
        <h2>최근 위시리스트</h2>

        <div class="list_02">
            <ul>

            <?php
            $sql = " select *
                       from {$g5['g5_shop_wish_table']} a,
                            {$g5['g5_shop_item_table']} b
                      where a.mb_id = '{$member['mb_id']}'
                        and a.it_id  = b.it_id
                      order by a.wi_id desc
                      limit 0, 8 ";
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++)
            {
                $image = get_it_image($row['it_id'], 230, 230, true);
            ?>

            <li>
                <div class="smb_my_img"><?php echo $image; ?></div>
                <div class="smb_my_tit"><a href="<?php echo shop_item_url($row['it_id']); ?>"><?php echo stripslashes($row['it_name']); ?></a></div>
                <div class="smb_my_date"><?php echo $row['wi_time']; ?></div>
            </li>

            <?php
            }

            if ($i == 0)
                echo '<li class="empty_li">보관 내역이 없습니다.</li>';
            ?>
            </ul>
        </div>

        <div class="smb_my_more">
            <a href="./wishlist.php">더보기</a>
        </div>
    </section>
    <!-- } 최근 위시리스트 끝 -->

</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });

	$(".win_add_coupon").click(function() {
        goDetail();
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>
<!-- } 마이페이지 끝 -->


<!-- 팝업뜰때 배경 -->
<div id="mask"></div>

<!--Popup Start -->
<div id="layerbox" class="layerpop"
	style="width: 500px; ">
	<article class="layerpop_area">
	<div class="title">쿠폰등록</div>
	<a href="javascript:popupClose();" class="layerpop_close"
		id="layerbox_close">X</a> <br>
	<div class="content">
		오프라인 쿠폰번호를 등록하시면 사용하실 수 있습니다.
		<br>받으신 쿠폰의 일련번호를 입력하신 후 내 쿠폰 내역에서 확인해 주세요.
		<br/>
		<br/>
		<input type="text" id="coupon1" style="width:350px; text-align:center;" maxlength="50"> 
		<br/>
		<br/>
		<button id="goAddCouponBtn" class="sec1">확인</button>
	</div>
	</article>
</div>
<!--Popup End -->

<style>
/*-- POPUP common style S ======================================================================================================================== --*/
#mask {
    position: fixed;
    left: 0;
    top: 0;
	right:0;
	bottom:0;
	width:100%;
	height:100%;
    z-index: 999;
    background-color: #000000;
    display: none; }

.layerpop {
    display: none;

    z-index: 1000;
	position:absolute;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; 
	top:20%;
	left:20%;
	-webkit-transform:  translateY(-50%)  translateX(-50%) !important;
    -moz-transform:  translateY(-50%)  translateX(-50%) !important;
    -ms-transform:  translateY(-50%)  translateX(-50%) !important;
    -o-transform:  translateY(-50%)  translateX(-50%) !important;
	transform:  translateY(-50%)  translateX(-50%) !important;
}

.layerpop_area .title {
    padding: 10px 10px 10px 10px;
    border: 0px solid #aaaaaa;
    background: #f1f1f1;
    color: #2954cf;
    font-size: 1.3em;
    font-weight: bold;
    line-height: 24px; }

.layerpop_area .layerpop_close {
    width: 25px;
    height: 25px;
    display: block;
    position: absolute;
    top: 10px;
    right: 10px;
    /*background: transparent url('btn_exit_off.png') no-repeat;*/ }

.layerpop_area .layerpop_close:hover {
    /*background: transparent url('btn_exit_on.png') no-repeat;*/
    cursor: pointer; }

.layerpop_area .content {
    width: 96%;    
    margin: 2%;
    color: #000; 
	font-size:16px;
	text-align:center;
	padding-bottom:20px;
}
.layerpop_area .content .sec1 {
	width:160px;
	border: 1px solid #06961e;
    background: #06961e;
    color: #fff;
    cursor: pointer;
    border-radius: 3px;
	padding: 7px;
}
/*-- POPUP common style E --*/
.layerpop #coupon1 {
	height:40px;
	border:1px solid #959595;
	border-radius: 6px;
}

</style>
<script>
function wrapWindowByMask() {
	//화면의 높이와 너비를 구한다.
	var maskHeight = $(document).height(); 
	var maskWidth = $(window).width();

	//문서영역의 크기 
	//console.log( "document 사이즈:"+ $(document).width() + "*" + $(document).height()); 
	//브라우저에서 문서가 보여지는 영역의 크기
	//console.log( "window 사이즈:"+ $(window).width() + "*" + $(window).height());        

	//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
	$('#mask').css({
		'width' : maskWidth,
		'height' : maskHeight
	});

	//애니메이션 효과
	//$('#mask').fadeIn(1000);      
	$('#mask').fadeTo("slow", 0.5);
}

function popupOpen() {
	//$('.layerpop').css("position", "absolute");
	//영역 가운에데 레이어를 뛰우기 위해 위치 계산 

	$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2));
	$('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $("#container").scrollLeft());
	//$('.layerpop').draggable();
	$('#layerbox').show();
}

function popupClose() {
	$('#layerbox').hide();
	$('#mask').hide();
}

function goDetail() {

	/*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

	popupOpen(); //레이어 팝업창 오픈 
	wrapWindowByMask(); //화면 마스크 효과 
}

$(function(){
	$("#goAddCouponBtn").click(function(){
		if ($("#coupon1").val() == '' || $("#coupon2").val() == '' || $("#coupon3").val() == '' || $("#coupon4").val() == '')
		{
			alert("쿠폰번호를 정확히 입력하여 주세요.");
			return;
		}
		var conf = confirm("쿠폰을 등록하시겠습니까?");
		if (conf)
		{
			$.ajax({
				url			: '/shop/addCouponProc.php',
				type		: 'POST',
				dataType	: 'json',
				contentType	: 'application/x-www-form-urlencoded; charset=utf-8',
				data : {
					couponNumber: $("#coupon1").val()
					//couponNumber: $("#coupon1").val() +"-"+ $("#coupon2").val() +"-"+ $("#coupon3").val() +"-"+ $("#coupon4").val()
				},
				success: function (response) {
					if (response.code == 1)
					{
						alert("쿠폰 등록이 성공하였습니다.");
						location.reload();
					}
					else {
						alert(response.msg);
					}
					
				},
				failure: function(msg) {
					alert(msg);
				}
			});
		}
	});
});
</script>


<?php
include_once("./_tail.php");
?>