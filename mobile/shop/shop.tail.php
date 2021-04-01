<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
</div><!-- container End -->

<div id="ft">
	<div style="padding:10px;background-color:#302e2e;margin-bottom:5px;"><a href="tel:<?php echo $default['de_admin_company_tel']; ?>" style="display:block;font-size:12px;border-radius:0;color:#fff;">고객센터</a></div>
	<div class="ft_pc"><a href="<?php echo get_device_change_url(); ?>" id="device_change" style="border-radius:0;">PC화면</a></div>
	<div id="ft_link" class="ft_cnt">
		<div>
			<ul>
				<li><a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a></li>
				<!--li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li-->
			</ul>
		</div>
	</div>

<!--//
	<div id="ft_wr" class="ft_cnt">
		<div>
			<ul>
				<li>
					<h4>CUSTOMER CENTER</h4>
					<p class="phone">070-7772-4500</p>
					<p class="time">
						평일 오전 10:00 ~ 오후 5:00  /  점심시간 : 13:00 ~ 14:00</br>
						토 / 일 / 공휴일 휴무
					</p>
				</li>
			</ul>
			<ul>
				<li>
				<!-- 	<h4>ACCOUNT INFO</h4>
					<p class="bank">신한은행 140-012-668442<span>예금주 : 주식회사 유엠씨코리아</span></p>

					<div class="number">
						<select name="number" onchange="window.open(this.value)">
							<option value="">인터넷뱅킹바로가기</option>
							<option value="https://www.kbstar.com/">국민은행</option>
							<option value="https://www.wooribank.com/">우리은행</option>
							<option value="http://www.shinhan.com/">신한은행</option>
							<option value="https://www.kebhana.com/">하나은행</option>
							<option value="https://www.kebhana.com/">외환은행</option>
							<option value="https://www.ibk.co.kr/index.html">기업은행</option>
							<option value="https://www.kdb.co.kr/ih/simpleJsp.do">산업은행</option>
							<option value="http://www.nonghyup.com/Main/main.aspx">농협</option>
							<option value="https://www.suhyup.co.kr/">수협</option>
							<option value="http://www.cu.co.kr/CPSI020000.do">신협</option>
							<option value="https://www.epostbank.kr/">우체국은행</option>
							<option value="http://www.citibank.co.kr/">한국씨티은행</option>
							<option value="http://www.standardchartered.co.kr/np/kr/Intro.jsp">스탠다드차타드은행</option>
						</select>
						<a href="/bbs/board.php?bo_table=unidentified" class="inter">미확인 입금자 찾기</a>
					</div>
				</li>
			</ul>
		</div>
    </div>
//-->

	<div id="ft_company" class="ft_cnt">
		<script>
			var url ="http://www.ftc.go.kr/bizCommPop.do?wrkr_no=1198671763"
			$(document).ready(function(){
				$('.ftc_btn').click(function(){
					window.open(url, "bizCommPop", "width=500, height=700;");
					return false;
				});
			});
		</script>

		<p class="ft_info">
			<span>サイト名 : ニコニコモール</span><span>会社法人等番号 : 0104-01-135167</span><span>会社名 : 株式会社 IBJ</span><span>アドレス : 株式会社アイビジェイ 144-0047 東京都大田区萩中 3-17-16 </span><br>
			本サイトは、韓国の個人購買顧客を対象にサービス、顧客様の注文に応じて韓国に輸出を行います。日本内での販売、配達は行いません。<br/>
			본 사이트는 한국의 개인 구매 고객을 대상으로 서비스, 고객의 주문에 따라 한국으로 수출합니다. 일본 내 판매, 배달은 하지 않습니다.
		</p>
		<p style="padding-bottom:0">
		</p>
		<p style="padding:0">	
			<span><?php echo $default['de_admin_company_name']; ?><!--  &nbsp; <?php// echo $default['de_admin_company_addr']; ?> --></span>
		</p>
		<!-- <p style="padding:0">
			<span>대표 : <?php echo $default['de_admin_company_owner']; ?></span>
			<span>사업자 등록번호 : <?php echo $default['de_admin_company_saupja_no']; ?> 
				<a href="javascript:;" class="ftc_btn">사업자확인</a>
			</span>
			<span>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></span>
			<span>개인정보 보호책임자 : <?php echo $default['de_admin_info_name']; ?></span>
		</p> -->
		<p style="padding:0">			
			<span>대표번호 : <?php echo $default['de_admin_company_tel']; ?></span>
			<span>메일 :  <?php echo $default['de_admin_info_email']; ?></span>
		</p>
		<p style="padding:0">	
			<!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
			
			<?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?>
		</p>	
	</div>    

    <div id="ft_copy">ⓒcopyright  일본직구쇼핑몰 사이트, 니코니코몰 All rights reserved.</div>	
</div>


<div id="side_menu">
	<ul id="quick">
		<li>
			<a href="javascript:void(0)"><img src="/img/common/btnQuick05.png" alt="" width="52px"/>
			<ul>
				<li><a href="https://pf.kakao.com/_xkWxkxoxb" target="_blank"><img src="/img/common/ic-kakaoch.png" alt=""><span>카카오톡 채널</span></a></li>
				<li><a href="https://unipass.customs.go.kr/csp/persIndex.do" target="_blank"><img src="/img/common/btnQuick02.png" alt=""><span>개인통관부호 발급</span></a></li>
				<!-- <li><a href="https://pf.kakao.com/_bqbCT" target="_blank"><img src="/img/common/btnQuick03.png" alt=""><span>네이버 톡톡 상담</span></a></li> -->
				<li><button class="btn_sm_cl2 btn_sm"><img src="/img/common/btnQuick06.png" alt=""><span>최근 본 상품</span></button></li>
			</ul>
		</li>
    </ul>
	<button type="button" id="top_btn"><img src="/img/common/btnTop.png" alt=""><span class="sound_only">상단으로</span></button>
</div>



<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>



<script>
jQuery(function($) {

    $( document ).ready( function() {

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));   


        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

		// 오늘본상품
		var active_class = "btn_sm_on",
			side_btn_el = "#quick .btn_sm",
			quick_container = ".qk_con";

		$(document).on("click", side_btn_el, function(e){
			e.preventDefault();

			var $this = $(this);
			
			if (!$this.hasClass(active_class)) {
				$(side_btn_el).removeClass(active_class);
				$this.addClass(active_class);
			}

			if( $this.hasClass("btn_sm_cl1") ){
				$(".side_mn_wr1").show();
			} else if( $this.hasClass("btn_sm_cl2") ){
				$(".menu").show();
			} else if( $this.hasClass("btn_sm_cl3") ){
				$(".side_mn_wr3").show();
			} else if( $this.hasClass("btn_sm_cl4") ){
				$(".side_mn_wr4").show();
			}
		}).on("click", ".con_close", function(e){
			$(quick_container).hide();
			$(side_btn_el).removeClass(active_class);
		});


		// QUICK
		$("#quick > li > a").on("click", function() {
			$("#quick > li > ul").toggleClass("active");
			return false;
		});

    });


	//상단고정
	/*
	var jbOffset = $( '.jbMenu' ).offset();
	$( window ).scroll( function() {
		if ( $( document ).scrollTop() > jbOffset.top ) {
			$( '.jbMenu' ).addClass( 'jbFixed' );
		}
		else {
			$( '.jbMenu' ).removeClass( 'jbFixed' );
		}
	});
	*/
});
</script>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>
