<?php
$sub_menu = '500120';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '주문내역출력(注文情報の閲覧)';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>


<div class="local_sch03 local_sch">

    <div>
        <form name="forderprint" action="./orderprintresult.php" onsubmit="return forderprintcheck(this);" autocomplete="off">
        <input type="hidden" name="case" value="1">

        <strong class="sch_long">기간별 출력<br>エクセル・エクスポート<br>(期間)</strong>
        <input type="radio" name="csv" value="xls" id="xls1">
        <label for="xls1">MS엑셀 XLS 데이터<br>(エクセルXLSファイル）</label>
       <!--  <input type="radio" name="csv" value="csv" id="csv1">
        <label for="csv1">MS엑셀 CSV 데이터<br>(エクセルCSVファイル)</label> -->
        <label for="ct_status_p" class="sound_only">출력대상</label>
        <select name="ct_status" id="ct_status_p">
            <option value="주문">주문(注文)</option>
            <option value="입금">입금(入金確認)</option>
            <option value="준비">준비(準備中)</option>
            <option value="배송">배송(配送中)</option>
            <option value="완료">완료(配送完了)</option>
            <option value="취소">취소(取り消し)</option>
            <option value="반품">반품(返品)</option>
            <option value="품절">품절(品切れ)</option>
            <option value="">전체(全体)</option>
        </select>
        <label for="fr_date" class="sound_only">기간 시작일</label>
        <input type="text" name="fr_date" value="<?php echo date("Ymd"); ?>" id="fr_date" required class="required frm_input" size="10" maxlength="8">
        ~
        <label for="to_date" class="sound_only">기간 종료일</label>
        <input type="text" name="to_date" value="<?php echo date("Ymd"); ?>" id="to_date" required class="required frm_input" size="10" maxlength="8">
        <input type="submit" value="submit" class="btn_submit">

        </form>
    </div>

    <div class="sch_last">

        <form name="forderprint" action="./orderprintresult.php" onsubmit="return forderprintcheck(this);" autocomplete="off" >
        <input type="hidden" name="case" value="2">
        <strong class="sch_long">주문번호구간별 출력<br>エクセル・エクスポート<br>(注文番号)</strong>

        <input type="radio" name="csv" value="xls" id="xls2">
        <label for="xls2">MS엑셀 XLS 데이터<br>(エクセルXLSファイル）</label>
       <!--  <input type="radio" name="csv" value="csv" id="csv2">
        <label for="csv2">MS엑셀 CSV 데이터<br>(エクセルCSVファイル）</label> -->
        <label for="ct_status_n" class="sound_only">출력대상</label>
        <select name="ct_status" id="ct_status_n">
            <option value="주문">주문(注文)</option>
            <option value="입금">입금(入金確認)</option>
            <option value="준비">준비(準備中)</option>
            <option value="배송">배송(配送中)</option>
            <option value="완료">완료(配送完了)</option>
            <option value="취소">취소(取り消し)</option>
            <option value="반품">반품(返品)</option>
            <option value="품절">품절(品切れ)</option>
            <option value="">전체(全体)</option>
        </select>
        <label for="fr_od_id" class="sound_only">주문번호 구간 시작</label>
        <input type="text" name="fr_od_id" id="fr_od_id" required class="required frm_input" size="10" maxlength="20">
        ~
        <label for="fr_od_id" class="sound_only">주문번호 구간 종료</label>
        <input type="text" name="to_od_id" id="to_od_id" required class="required frm_input" size="10" maxlength="20">
        <input type="submit" value="submit" class="btn_submit">

        </form>
    </div>

</div>

<div class="btn_fixed_top">
    <a href="./orderlist.php" class="btn_01 btn ">주문내역(詳細を見る)</a>
</div>

<div class="local_desc01 local_desc">
    <p>※ 기간별 혹은 주문번호구간별 주문내역을 새창으로 출력할 수 있습니다.</p>
	<p style="color:red;">※ 저장 방식을 선택하지 않을 경우 새창에서 확인 가능합니다.</p>

</div>

<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});

function forderprintcheck(f)
{
    if (f.csv[0].checked || f.csv[1].checked)
    {
        f.target = "_top";
    }
    else
    {
        var win = window.open("", "winprint", "left=10,top=10,width=670,height=800,menubar=yes,toolbar=yes,scrollbars=yes");
        f.target = "winprint";
    }

    f.submit();
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
