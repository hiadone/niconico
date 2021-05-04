<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>




<!-- 사용후기 쓰기 시작 { -->
<div id="sit_use_write" class="new_win">
    <h1 id="win_title">사용후기 쓰기</h1>

    <form name="fitemuse" id="fitemuse" method="post" action="<?php echo G5_SHOP_URL;?>/itemuseformupdate.php" onsubmit=" return false;" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
	<input type="hidden" name="od_id" value="<?php echo $od_id; ?>">

    <div class="new_win_con form_01">
        <ul>
            <li>
                <span class="sound_only">평점</span>
                <ul id="sit_use_write_star" class="chk_box">
                    <li>
                        <input type="radio" name="is_score" value="5" id="is_score5" <?php echo ($is_score==5)?'checked="checked"':''; ?>>
                        <label for="is_score5"><span></span>매우만족</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star5.png" alt="매우만족">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="4" id="is_score4" <?php echo ($is_score==4)?'checked="checked"':''; ?>>
                        <label for="is_score4"><span></span>만족</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star4.png" alt="만족">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="3" id="is_score3" <?php echo ($is_score==3)?'checked="checked"':''; ?>>
                        <label for="is_score3"><span></span>보통</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star3.png" alt="보통">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="2" id="is_score2" <?php echo ($is_score==2)?'checked="checked"':''; ?>>
                        <label for="is_score2"><span></span>불만</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star2.png" alt="불만">
                    </li>
                    <li>
                        <input type="radio" name="is_score" value="1" id="is_score1" <?php echo ($is_score==1)?'checked="checked"':''; ?>>
                        <label for="is_score1"><span></span>매우불만</label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star1.png" alt="매우불만">
                    </li>
                </ul>
            </li>
            <li>
                <label for="is_subject" class="sound_only">제목<strong> 필수</strong></label>
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required class="required frm_input full_input"  maxlength="20" placeholder="제목">
            </li>
            <li>
                <strong  class="sound_only">내용</strong>
				<p><strong>* 리뷰 및 후기글은 30자 이상이 되어야 등록 가능 합니다.</strong></p>
                <?php echo $editor_html; ?>
				<span style="float:right; text-align:right;"><span id="inputCntSpan">0</span>자</span>
            </li>
           

             <li>
                
                <div class="inp_review_img_contianer">
                <div class="btn_box">
                  <label
                    class="btn btn_main_line btn_full"
                    type="button"
                    for="reviewFile"
                  >
                    <input
                      type="file"
                      id="reviewFile"
                      hidden
                      multiple
                    />
                    <img
                      src="<?php echo G5_URL; ?>/shop/img/icon-camera-main.svg"
                      alt=""
                      class="icon"
                    />
                    사진 첨부하기
                  </label>
                </div>
                <span class="">
                    * gif, jpg, png 파일만 가능하며 상품과 상관없는 사진을 첨부한 리뷰는 통보없이 삭제될 수 있습니다.
                    <br>이미지는 다중 선택이 가능하며 최대 10개 까지 업로드 가능합니다. <span style="color:red">파일업로드 용량 총 (<?php echo ini_get('upload_max_filesize') ?>)</span>
                </span>

                

                <div id="imagePreview" class="has_review_img_container">
                    <?php for ($i=0;  $i<$file['count']; $i++) { ?>
                        <?php 
                        
                        if($w == 'u' && $file[$i]['file']) { 
                            


                        ?>
                        <input type="checkbox" hidden="hidden" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" >
                        <input type="file" hidden="hidden" id="bf_file<?php echo $i ?>" name="bf_file[<?php echo $i;  ?>]" >
                        <div class="review_img_thum img_box">
                            <img src="<?php echo $file[$i]['path'].'/'.$file[$i]['file'] ?>" data-file="<?php echo $file[$i]['source'] ?>"  alt="<?php echo $file[$i]['content'] ?>" class="img" />
                            <button
                              class="btn_del_img btn_linkstyle"
                              onClick="$('#bf_file_del<?php echo $i ?>').attr('checked', true);$(this).parent().remove();"
                            >
                              <img
                                src="<?php echo G5_URL; ?>/shop/img/icon-del.svg"
                                alt="이미지 파일명 빼기"
                                class="icon"
                              />
                            </button>
                        </div>
                        
                        <?php } ?>
                    <?php } ?>
                </div>
                
              </div>

            </li>


            

            
            
        </ul>
    </div>
    </form>
    <div class="win_btn">
        <button type="button" onClick="fitemuse_submit()" class="btn_submit">작성완료</button>
        <button type="button" onclick="self.close();" class="btn_close">닫기</button>
    </div>
    
    
</div>
<script type="text/javascript">

const sel_files = [];

function fitemuse_submit(f)
{   
    
    
    
    <?php echo $editor_js; ?>
    if(!$("#is_subject").val()){
        alert('제목을 입력해 주세요');
        return false;
    }
    var text = $("#is_content").val().replace(/<br>/ig, "");
    text = text.replace(/\n/ig, "");
    text = text.replace(/&nbsp;/ig, "");
    text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
    
    if (text.length < 30)
    {
        alert('[사용후기 등록 안내]\n30자 이상 리뷰만 등록할 수 있습니다. 상세하게 적어주세요.');
        return false;
    }

    
    console.log(sel_files);



    var fitemuse = document.getElementById("fitemuse");
    const frm = new FormData(fitemuse);
    const w = '<?php echo $w; ?>';
    // sel_files.map((val,index) => frm.append("bf_file[(${index}+<?php echo $file['count'] ?>)]", val));
    sel_files.map((val,index) => frm.append("bf_file[]", val));

    frm.append("img_length", $('.review_img_thum').length);
    
    
    $.ajax({
        url : "<?php echo G5_SHOP_URL;?>/itemuseformupdate.php",
        type : 'POST',
        data : frm,           
        processData : false,
        contentType : false,
        dataType : 'json',
        success : function(data) {                
            if (data.error) {
                alert(data.error);
                return false;
            } else if (data.success) {
                alert(data.success);
                if(data.url){
                    // if(w)
                    //     location.href=data.url;
                    // else
                    opener.location.href=data.url; 
                    self.close();
                }
                return false;
                // $('.' + class).text(number_format(String(data.count)));
                // $('#btn-' + class).effect('highlight', {color : '#f37f60'}, 500);
            }
        }
    });

    return false;

    
}

$(function(){
    $("#is_content").attr("placeholder", "텍스트 리뷰 30자 이상");
    var uploadFile = $('.filebox .uploadBtn');
    uploadFile.on('change', function(){
        if(window.FileReader){
            var filename = $(this)[0].files[0].name;
        } else {
            var filename = $(this).val().split('/').pop().split('\\').pop();
        }
        
        if(!/\.(gif|jpg|jpeg|png)$/i.test(filename)) {
            alert('gif, jpg, png 파일만 선택해 주세요.\n\n현재 파일 : ' + filename);
            return false;
        } 

        $(this).siblings('.fileName').val(filename);
    });

    $("#is_content").keyup(function(){
        var text = $(this).val().replace(/<br>/ig, "");
        text = text.replace(/\n/ig, "");
        text = text.replace(/&nbsp;/ig, "");
        text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
        $("#inputCntSpan").html(text.length);
    });
});





    

function readInputFile(e){
    
    // $('#imagePreview').empty();
    
    var files = e.target.files;    
    var fileArr = Array.prototype.slice.call(files);
    var index = 0;
    const G5_URL = "<?php echo G5_URL; ?>";
    fileArr.forEach(function(f){
        if(!f.type.match("image/.*")){
            alert("이미지 확장자만 업로드 가능합니다.");
            return;
        };
        if(files.length < 11){
            sel_files.push(f);
            
            var reader = new FileReader();
            reader.onload = function(e){


                // var html = `<a id=img_id_${index}><img src=${e.target.result} data-file=${f.name} /></a>`;

                let html = `
                            <div class="review_img_thum img_box">
                                <img src=${e.target.result} data-file=${f.name}  alt="이미지" class="img" />
                                <button
                                  class="btn_del_img btn_linkstyle"
                                  onClick="$(this).parent().remove();sel_files.splice(sel_files.findIndex(v => v.name == '${f.name}'),1);"
                                >
                                  <img
                                    src="${G5_URL}/shop/img/icon-del.svg"
                                    alt="이미지 파일명 빼기"
                                    class="icon"
                                  />
                                </button>
                            </div>
                            `;
                
                $('#imagePreview').append(html);
                index++;
            };
            reader.readAsDataURL(f);
        }
    })
    if(files.length > 11){
        alert("최대 10장까지 업로드 할 수 있습니다.");
    }
}

$('#reviewFile').on('change',readInputFile);
</script>

<!-- <script type="text/javascript">
function fitemuse_submit(f)
{
    <?php echo $editor_js; ?>

	var text = is_content_editor_data.replace(/<br>/ig, "");
	text = text.replace(/&nbsp;/ig, "");
	text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
	
	if (text.length < 30)
	{
		alert('[사용후기 등록 안내]\n30자 이상 리뷰만 등록할 수 있습니다. 상세하게 적어주세요.');
		return false;
	}

    return true;
}

function getTextLength() {
	if ($("#se2_iframe").context.readyState == "complete")
	{
		var is_content_editor_data = oEditors.getById['is_content'].getIR();
		oEditors.getById['is_content'].exec('UPDATE_CONTENTS_FIELD', []);

		var text = is_content_editor_data.replace(/<br>/ig, "");
		text = text.replace(/&nbsp;/ig, "");
		text = text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");
		return text.length;
	} else {
		return 0;
	}
}

var timerId = setInterval(function() {
	$("#inputCntSpan").html(getTextLength());
}, 300);

$(function(){
	$("#is_content").attr("placeholder", "텍스트 리뷰 30자 이상");
});
</script> -->
<!-- } 사용후기 쓰기 끝 -->