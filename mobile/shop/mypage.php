<?php
include_once('./_common.php');

// 테마에 mypage.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_mypage_file = G5_THEME_MSHOP_PATH.'/mypage.php';
    if(is_file($theme_mypage_file)) {
        include_once($theme_mypage_file);
        return;
        unset($theme_mypage_file);
    }
}

$g5['title'] = '마이페이지';
include_once(G5_MSHOP_PATH.'/_head.php');

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
	line-height: 28px;
	height:30px;
	padding:0 5px;
}
</style>
<div id="smb_my">

    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <div class="my_name">
            <img src="<?php echo G5_IMG_URL ;?>/no_profile.gif" alt="프로필이미지" width="20"> <strong><?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?></strong>님
            <ul class="smb_my_act">
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
				<li><button class="win_add_coupon btn01">쿠폰 등록하기</button></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn01">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn01">회원탈퇴</a></li>
            </ul>
        </div>
        <ul class="my_pocou">
            <li  class="my_cou">보유쿠폰
				<?php if($cp_count > 0) {?>
				<a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?></a>
				<?php }else{ ?>
				<a href="javascript:alert('보유중인 쿠폰이 없습니다');"><?php echo number_format($cp_count); ?></a>
				<?php } ?>
			</li>
            <li class="my_point">보유포인트
            <a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><?php echo number_format($member['mb_point']); ?>점</a></li>

        </ul>
        <div class="my_info">
            <div class="my_info_wr">
                <strong>연락처</strong>
                <span><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></span>
            </div>
            <div class="my_info_wr">
                <strong>E-Mail</strong>
                <span><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></span>
            </div>
            <div class="my_info_wr">
                <strong>최종접속일시</strong>
                <span><?php echo $member['mb_today_login']; ?></span>
             </div>
            <div class="my_info_wr">
            <strong>회원가입일시</strong>
                <span><?php echo $member['mb_datetime']; ?></span>
            </div>
            <div class="my_info_wr ov_addr">
                <strong>주소</strong>
                <span><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></span>
            </div>
        </div>
        <div class="my_ov_btn"><button type="button" class="btn_op_area"><i class="fa fa-caret-down" aria-hidden="true"></i><span class="sound_only">상세정보 보기</span></button></div>

    </section>

    <script>
    
        $(".btn_op_area").on("click", function() {
            $(".my_info").toggle();
            $(".fa-caret-down").toggleClass("fa-caret-up")
        });

    </script>

    <section id="smb_my_od">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">최근 주문내역</a></h2>
        <?php
        // 최근 주문내역
        define("_ORDERINQUIRY_", true);

        $limit = " limit 0, 5 ";
        include G5_MSHOP_PATH.'/orderinquiry.sub.php';
        ?>
        <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="btn_more">더보기</a>
    </section>

    <section id="smb_my_wish" class="wishlist">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">최근 위시리스트</a></h2>

        <ul>
            <?php
            $sql = " select *
                       from {$g5['g5_shop_wish_table']} a,
                            {$g5['g5_shop_item_table']} b
                      where a.mb_id = '{$member['mb_id']}'
                        and a.it_id  = b.it_id
                      order by a.wi_id desc
                      limit 0, 6 ";
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++)
            {
                $image_w = 250;
                $image_h = 250;
                $image = get_it_image($row['it_id'], $image_w, $image_h, true);
                $list_left_pad = $image_w + 10;
            ?>

            <li>
                <div class="wish_img"><?php echo $image; ?></div>
                <div class="wish_info">
                    <a href="<?php echo get_shop_item($row['it_id'], true); ?>" class="info_link"><?php echo stripslashes($row['it_name']); ?></a>
                     <span class="info_date"><?php echo substr($row['wi_time'], 2, 8); ?></span>
                </div>
            </li>

            <?php
            }

            if ($i == 0)
                echo '<li class="empty_list">보관 내역이 없습니다.</li>';
            ?>
        </ul>
         <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="btn_more">더보기</a>
    </section>

</div>


<!-- 팝업뜰때 배경 -->
<div id="mask"></div>

<!--Popup Start -->
<div id="layerbox" class="layerpop"
	style="width: 100%; ">
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
    display: none;
}

.layerpop {
    display: none;
    z-index: 1000;
	max-width:500px;
	position:absolute;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; 
	top:50%;
	left:50%;
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

	//$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2));
	//$('.layerpop').css("left",(0));
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

	$(".win_add_coupon").click(function() {
        goDetail();
    });
});
</script>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>