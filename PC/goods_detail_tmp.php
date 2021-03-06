<?
	// 설정파일
	include_once "../config.php";
  	include_once "header.php";
	$goods_idx	= $_REQUEST['goods_idx'];

	$goods_info = OM_GetGoodsInfo($goods_idx);
?>
	<style>
/* Styles for dialog window */
#input_1 {
	background: white;
	position: relative;
}


/**
 * Fade-zoom animation for first dialog
 */

/* start state */
.my-mfp-zoom-in .zoom-anim-dialog {
	opacity: 0;

	-webkit-transition: all 0.2s ease-in-out; 
	-moz-transition: all 0.2s ease-in-out; 
	-o-transition: all 0.2s ease-in-out; 
	transition: all 0.2s ease-in-out; 



	-webkit-transform: scale(0.8); 
	-moz-transform: scale(0.8); 
	-ms-transform: scale(0.8); 
	-o-transform: scale(0.8); 
	transform: scale(0.8); 
}

/* animate in */
.my-mfp-zoom-in.mfp-ready .zoom-anim-dialog {
	opacity: 1;

	-webkit-transform: scale(1); 
	-moz-transform: scale(1); 
	-ms-transform: scale(1); 
	-o-transform: scale(1); 
	transform: scale(1); 
}

/* animate out */
.my-mfp-zoom-in.mfp-removing .zoom-anim-dialog {
	-webkit-transform: scale(0.8); 
	-moz-transform: scale(0.8); 
	-ms-transform: scale(0.8); 
	-o-transform: scale(0.8); 
	transform: scale(0.8); 

	opacity: 0;
}

/* Dark overlay, start state */
.my-mfp-zoom-in.mfp-bg {
	opacity: 0.001; /* Chrome opacity transition bug */
	-webkit-transition: opacity 0.3s ease-out; 
	-moz-transition: opacity 0.3s ease-out; 
	-o-transition: opacity 0.3s ease-out; 
	transition: opacity 0.3s ease-out;
}
/* animate in */
.my-mfp-zoom-in.mfp-ready.mfp-bg {
	opacity: 0.8;
}
/* animate out */
.my-mfp-zoom-in.mfp-removing.mfp-bg {
	opacity: 0;
}



/**
 * Fade-move animation for second dialog
 */

/* at start */
.my-mfp-slide-bottom .zoom-anim-dialog {
	opacity: 0;
	-webkit-transition: all 0.2s ease-out;
	-moz-transition: all 0.2s ease-out;
	-o-transition: all 0.2s ease-out;
	transition: all 0.2s ease-out;

	-webkit-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
	-moz-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
	-ms-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
	-o-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
	transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );

}

/* animate in */
.my-mfp-slide-bottom.mfp-ready .zoom-anim-dialog {
	opacity: 1;
	-webkit-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
	-moz-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
	-ms-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
	-o-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
	transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
}

/* animate out */
.my-mfp-slide-bottom.mfp-removing .zoom-anim-dialog {
	opacity: 0;

	-webkit-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
	-moz-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
	-ms-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
	-o-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
	transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
}

/* Dark overlay, start state */
.my-mfp-slide-bottom.mfp-bg {
	opacity: 0.01;

	-webkit-transition: opacity 0.3s ease-out; 
	-moz-transition: opacity 0.3s ease-out; 
	-o-transition: opacity 0.3s ease-out; 
	transition: opacity 0.3s ease-out;
}
/* animate in */
.my-mfp-slide-bottom.mfp-ready.mfp-bg {
	opacity: 0.8;
}
/* animate out */
.my-mfp-slide-bottom.mfp-removing.mfp-bg {
	opacity: 0;
}
	</style>
    <input type="hidden" name="goods_idx" id="goods_idx" value="<?=$goods_idx?>">

    <div class="content g_960">
      <div class="product_img">
<?php
	$soldout_query 		= "SELECT goods_selcount FROM ".$_gl['goods_info_table']." WHERE idx = ".$goods_idx." ";
	$soldout_result 	= mysqli_query($my_db, $soldout_query);
	$soldout_cnt = mysqli_fetch_array($soldout_result);
	if($soldout_cnt[goods_selcount] >= 10)	
	{
?>

      <!--품절시-->
        <div class="t_soldout"><img src="images/txt_soldout.png" width="60" alt=""/></div>
<?php
	}
?>
        <div class="img"><img src="images/big_product_<?=$goods_idx?>.jpg" alt="" border="0"/></div>
      </div>
      <div class="product_detail">
        <div class="product_txt">
          <img src="images/big_product_<?=$goods_idx?>_txt.jpg" alt=""/> 
        </div>
        <div class="img add"><img src="images/big_product_<?=$goods_idx?>_gift.jpg" alt=""/></div>
        <div class="btn_getit">
          <a href="#input_1" class="popup-with-zoom-anim"><img src="images/btn_buy.jpg"/></a>
        </div> 
        <div class="btn_share_inview clearfix">
          <div class="txt">
            <img src="images/share_txt.jpg" alt=""/>
          </div>
          <div class="btn_fb">
            <a href="#" onclick="fb_share('<?=$goods_info['goods_name']?>','<?=$goods_info['goods_detail']?>','<?=$goods_info['goods_imgurl']?>','<?=$gubun?>');"><img src="images/btn_fb.jpg" alt=""/></a>
          </div>
          <div class="btn_kt">
            <a href="#" onclick="kt_share('<?=$goods_info['goods_name']?>','<?=$goods_info['goods_detail']?>','<?=$goods_info['goods_imgurl']?>','<?=$gubun?>');"><img src="images/btn_kt.jpg" alt=""/></a>
          </div>
        </div> 
      </div> 
      <div class="product_detail_img">
        <img src="images/big_product_<?=$goods_idx?>_detail.jpg" width="960" height="608" alt=""/>
      </div>
    </div>

<!--  이름, 전화번호 입력 받는 DIV 시작  -->
    <div class="wrap_pop zoom-anim-dialog mfp-hide" id="input_1">
      <div class="header">
        <div class="btn_close"><a onclick="javascript:close_div('input_1');" style="cursor:pointer"><img src="images/btn_close.jpg" width="70" height="70" alt=""/></a></div>
      </div>
      <div class="inner">
        <div class="content info">
          <div class="title">
            <img src="images/title_info.jpg" width="382" height="66" alt=""/>
          </div>
          <div class="info_block">
            <ul>
              <li class="clearfix">
                <div class="label"><img src="images/txt_name.jpg" width="38" height="21" alt=""/></div>
                <div class="input"><input type="text" name="mb_name" id="mb_name" onblur="only_kor(this)"></div>
              </li>
              <li class="clearfix">
                <div class="label"><img src="images/txt_phonenum.jpg" width="99" height="21" alt=""/></div>
                <div class="input"><input type="text" name="mb_phone" id="mb_phone" onkeyup="only_num(this)"></div>
              </li>
            </ul>
          </div>
          <div class="check_block">
            <ul>
              <li class="clearfix">
                <div class="input"><input type="checkbox" name="agree1" id="agree1"></div>
                <div class="label"><a href="#agree1_div" class="popup-with-zoom-anim"><img src="images/txt_notice_1.jpg" alt=""/></a></div>
              </li>
              <li class="clearfix">
                <div class="input"><input type="checkbox" name="agree2" id="agree2"></div>
                <div class="label"><a href="#agree2_div" class="popup-with-zoom-anim"><img src="images/txt_notice_2.jpg" alt=""/></a></div>
              </li>
            </ul>
          </div>
          <div class="btn_block">
            <a href="#" onclick="input_name('<?=$gubun?>');return false;"><img src="images/btn_input_01.jpg" width="250" height="59" alt=""/></a>
          </div>
        </div>
      </div>
    </div><!--end wrap_pop-->

<!--  이름, 전화번호 입력 받는 DIV 끝  -->

<!--  미당첨 DIV 시작  -->
    <div class="wrap_pop zoom-anim-dialog mfp-hide" id="sorry_div">
      <div class="header">
        <div class="btn_close"><a href="javascript:magnificPopup.close();"><img src="images/btn_close.jpg" width="70" height="70" alt=""/></a></div>
      </div>
      <div class="inner">
        <div class="content info">
          <div class="title">
            <img src="images/title_fail.jpg" width="469" height="170" alt=""/>
          </div>
          <div class="img_one">
            <img src="images/fail_product_<?=$goods_idx?>.jpg" width="458" height="542" alt=""/>
          </div>
          <div class="share_txt">
            <img src="images/txt_share.jpg" width="324" height="105" alt=""/>
          </div>
          <div class="btn_share_block clearfix">
            <div><a href="#" onclick="javascript:fb_share('<?=$goods_info['goods_name']?>','<?=$goods_info['goods_detail']?>','<?=$goods_info['goods_imgurl']?>','<?=$gubun?>');"><img src="images/btn_fb.jpg" alt=""/></a></div>
            <div><a href="#" onclick="javascript:kt_share('<?=$goods_info['goods_name']?>','<?=$goods_info['goods_detail']?>','<?=$goods_info['goods_imgurl']?>','<?=$gubun?>');"><img src="images/btn_kt.jpg" alt=""/></a></div>
          </div>
        </div>
      </div>
    </div>
<!--  미당첨 DIV 끝  -->

<!--  개인정보 활용동의 DIV 시작  -->
    <div class="wrap_pop zoom-anim-dialog mfp-hide" id="agree1_div">
      <div class="header">
        <div class="btn_close"><a href="#input_1" class="first-popup-link"><img src="images/btn_close.jpg" width="70" height="70" alt=""/></a></div>
      </div>
      <div class="inner">
        <div class="content notice">
          <div class="title">
            <img src="images/title_notice_01.jpg" alt=""/>
          </div>
          <div class="txt_block">
          개인정보동의
          </div>
        </div>
      </div>
    </div>
<!--  개인정보 활용동의 DIV 끝  -->

<!--  개인정보 취급위탁동의 DIV 시작  -->
    <div class="wrap_pop zoom-anim-dialog mfp-hide" id="agree2_div">
      <div class="header">
        <div class="btn_close"><a href="#input_1" class="first-popup-link"><img src="images/btn_close.jpg" width="70" height="70" alt=""/></a></div>
      </div>
      <div class="inner">
        <div class="content notice">
          <div class="title">
            <img src="images/title_notice_02.jpg" alt=""/>
          </div>
          <div class="txt_block">
          개인정보취급위탁
          </div>
        </div>
      </div>
    </div>
<!--  개인정보 취급위탁동의 DIV 끝  -->

<!--  당첨자 추가 정보 받는 DIV 시작  -->
    <div class="wrap_pop zoom-anim-dialog mfp-hide" id="input_2">
      <div class="header">
        <div class="btn_close"><a onclick="javascript:close_div('input_2');" style="cursor:pointer"><img src="images/btn_close.jpg" width="70" height="70" alt=""/></a></div>
      </div>
      <div class="inner">
        <div class="content info">
          <div class="title">
            <img src="images/title_info.jpg" width="382" height="66" alt=""/>
          </div>
          <div class="info_block">
            <ul>
              <li class="clearfix">
                <div class="label"><img src="images/txt_name.jpg" width="38" height="21" alt=""/></div>
                <div class="input">
                  <input type="text" name="postcode1" id="postcode1" readonly> - 
                  <input type="text" name="postcode2" id="postcode2" readonly>
                  <input type="button" value="우편번호 찾기" onclick="show_post();return false;"></div>
              </li>
              <li class="clearfix">
                <div class="label"><img src="images/txt_phonenum.jpg" width="99" height="21" alt=""/></div>
                <div class="input">
                  <input type="text" name="addr1" id="addr1">
                  <input type="text" name="addr2" id="addr2">
                </div>
              </li>
            </ul>
          </div>
          <div class="btn_block">
            <a href="#" onclick="input_address();return false;"><img src="images/btn_input_01.jpg" width="250" height="59" alt=""/></a>
          </div>
        </div>
      </div>
    </div><!--end wrap_pop-->

<!--  당첨자 추가 정보 받는 DIV 끝  -->

<!--  주소검색 DIV 시작  -->
    <div id="post_div" style="display:none;border:5px solid;position:fixed;width:95%;height:500px;margin-left:1%;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:999999999999">
      <img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px" onclick="closeDaumPostcode()" alt="닫기 버튼">
    </div>
<!--  주소검색 DIV 끝  -->



    <div id="fb-root"></div>
	<script src="http://dmaps.daum.net/map_js_init/postcode.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'hidden',
				closeBtnInside: true,
				//preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in',
				showCloseBtn : false,
				callbacks: {
					close: function() {
						$("#mb_name").val("");
						$("#mb_phone").val("");
						$('input').iCheck('uncheck');
						$("#postcode1").val("");
						$("#postcode2").val("");
						$("#addr1").val("");
						$("#addr2").val("");
					}
				}

			});

			$('.first-popup-link').magnificPopup({
				closeBtnInside:true
			});

			// 체크박스 스타일 설정
			$('.wrap_pop input').on('ifChecked ifUnchecked', function(event){
				//alert(this.id);
			}).iCheck({
				checkboxClass: 'icheckbox_flat-red',
				increaseArea: '0%'
			});


		});
		var magnificPopup = $.magnificPopup.instance;

		function closeDaumPostcode() {
			// iframe을 넣은 element를 안보이게 한다.
			element.style.display = 'none';
		}

			// 우편번호 찾기 iframe을 넣을 element
			var element = document.getElementById('post_div');

			function showDaumPostcode() {
				new daum.Postcode({
					oncomplete: function(data) {
						// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
						// 우편번호와 주소 및 영문주소 정보를 해당 필드에 넣는다.
						document.getElementById('postcode1').value = data.postcode1;
						document.getElementById('postcode2').value = data.postcode2;
						document.getElementById('addr1').value = data.address;
						document.getElementById('addr2').focus();
						// iframe을 넣은 element를 안보이게 한다.
						element.style.display = 'none';
					},
					width : '100%',
					height : '100%'
				}).embed(element);

				// iframe을 넣은 element를 보이게 한다.
				//element.style.display = 'block';
			}


		function show_post()
		{
			$("#post_div").show();
			showDaumPostcode();
		}

	</script>
<?
	include_once "footer.php";

?>


