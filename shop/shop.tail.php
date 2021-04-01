<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
        </div>  <!-- } .shop-content 끝 -->
	</div>      <!-- } #container 끝 -->
</div>
<!-- } 전체 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<div id="ft">
	<div id="ft_link" class="ft_cnt">
		<div>
			<ul>
				<li><a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a></li>
				<li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a></li>
				<li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li>
			</ul>
			<!--ul class="sns">
				<li><a href="http://pf.kakao.com/_bqbCT" target="_blank"><img src="/img/main/btnSNS01.png" alt="카카오톡"></a></li>
				<li><a href="https://blog.naver.com/japandaysw" target="_blank"><img src="/img/main/btnSNS02.png" alt="블로그"></a></li>
				<li><a href="https://www.instagram.com/japandaysw/" target="_blank"><img src="/img/main/btnSNS03.png" alt="인스타그램"></a></li>
				<li><a href="" target="_blank"><img src="/img/main/btnSNS04.png" alt="유튜브"></a></li>
				<li><a href="https://www.facebook.com/Japan-day-104997247575286/?modal=admin_todo_tour" target="_blank"><img src="/img/main/btnSNS05.png" alt="페이스북"></a></li>
			</ul-->
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
					<!-- <h4>ACCOUNT INFO</h4>
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
<style>
#ft_company { position:relative; }	
#ft_company .ft_customer {
	position:absolute;
	top:0;
	right:0;
	width:auto;
}
#ft_company .ft_customer small { display:block; }
#ft_company .ft_customer  h2 { font-size:18px; }
#ft_company .ft_customer p { line-height:1.5768954; }
</style>
	<div id="ft_company" class="ft_cnt" style="padding-top:10px;padding-bottom:30px;">
		<script>
			var url ="http://www.ftc.go.kr/bizCommPop.do?wrkr_no=1198671763"
			$(document).ready(function(){
				$('.ftc_btn').click(function(){
					window.open(url, "bizCommPop", "width=750, height=700;");
					return false;
				});
			});
		</script>

		<div style="position:relative;width:1200px;margin:0 auto;overflow: visible;">
			<div class="ft_customer">
				<h2>
					<small>고객센터</small>
					070-4283-6537
				</h2>
				<p>빠른 상담은 카카오톡을 이용해주세요.</p>
				<p>운영시간<br/>
				AM 10:00 ~ PM 5:00<br/>
				점심시간 : 12:00 ~ 13:30<br/>
				토/일/공휴일 휴무
				</p>
			</div>
		</div>

		<p class="ft_info" style="margin-top:20px;">
			<span>サイト名 : ニコニコモール</span><span>会社法人等番号 : 0104-01-135167</span><span>会社名 :  株式会社 IT&BASIC Japan</span><span>アドレス : 株式会社アイビジェイ 144-0047 東京都大田区萩中 3-17-16 </span><br>
			本サイトは、韓国の個人購買顧客を対象にサービス、顧客様の注文に応じて韓国に輸出を行います。日本内での販売、配達は行いません。<br/>
			본 사이트는 한국의 개인 구매 고객을 대상으로 서비스, 고객의 주문에 따라 한국으로 수출합니다. 일본 내 판매, 배달은 하지 않습니다.
		</p>
		<p style="padding-bottom:0">
			
		</p>
		<!-- <p style="padding:0">	
			<span><?php echo $default['de_admin_company_owner']; ?> &nbsp; <?php echo $default['de_admin_company_addr']; ?></span>
		</p> -->
		<p style="padding:0">
			<span><?php echo $default['de_admin_company_name']; ?></span>
			<!-- <span>사업자 등록번호 : <?php echo $default['de_admin_company_saupja_no']; ?>  -->
				<!-- <a href="javascript:;" class="ftc_btn">사업자확인</a> -->
			<!-- </span> -->
			<!-- <span>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></span>
			<span>개인정보 보호책임자 : <?php echo $default['de_admin_info_name']; ?></span>	 -->
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

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
