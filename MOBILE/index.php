<?php
  	include_once "../config.php";
  	include_once "header.php";

	$view_arr = explode(",",$_COOKIE['goods_view']); 

?>
    <div class="content">
      <div class="slide_block">
        <div class="youtubebox">
          <ul class="bxslider">
<?php
	$query 		= "SELECT * FROM ".$_gl['banner_info_table']." ";
	$result 	= mysqli_query($my_db, $query);
	while($data = mysqli_fetch_array($result))
	{
?>
            <li style="top:-20px">
              <img src="http://www.tomorrowkids.or.kr/images/fb/jobimg_1.jpg">
            </li>
<?php
	}
?>
          </ul>
        </div>
      </div>
      <div class="list_block">
        <ul>
<?php
	$query 		= "SELECT * FROM ".$_gl['goods_info_table']." ";
	$result 	= mysqli_query($my_db, $query);
	while($goods_data = mysqli_fetch_array($result))
	{
?>

          <li>
<?php
		$soldout_query 		= "SELECT goods_selcount FROM ".$_gl['goods_info_table']." WHERE idx = ".$goods_data['idx']." ";
		$soldout_result 	= mysqli_query($my_db, $soldout_query);
		$soldout_cnt = mysqli_fetch_array($soldout_result);
		if($soldout_cnt[goods_selcount] >= 10)	
		{
?>			  
            <div class="t_soldout"><img src="images/txt_soldout.png" width="60" alt=""/></div>
<?php
		}
?>
            <div class="list">
              <a href="goods_detail.php?goods_idx=<?=$goods_data['idx']?>"><img src="images/thumb_product_1.jpg" alt=""/></a>
            </div>
          </li>
<?
	}
?>
        </ul>
      </div>
    </div>




<?
	include_once "footer.php";

?>

	<script type='text/javascript'>
	// 메인 배너 slider
	$('.bxslider').bxSlider({
		video: true,
		useCSS: false,
		reponsive: false,
		auto: true,
		speed: 300
	});

    // 유튜브 반복 재생
    var controllable_player,start, 
    statechange = function(e){
    	if(e.data === 0){controllable_player.seekTo(0); controllable_player.playVideo()}

    };
    function onYouTubeIframeAPIReady() {
    controllable_player = new YT.Player('ytplayer', {events: {'onStateChange': statechange}}); 
    }

    if(window.opera){
    addEventListener('load', onYouTubeIframeAPIReady, false);
    }
    setTimeout(function(){
    	if (typeof(controllable_player) == 'undefined'){
    		onYouTubeIframeAPIReady();
    	}
    }, 3000)

    $(window).resize(function(){
    	var width = $(window).width();
    	//var height = $(window).height();

    	var youtube_height = (width / 16) * 9;
    	$("#ytplayer").height(youtube_height);
    });

	$(document).ready(function() {
		$(".clone").css("margin-top","-15px");
	});
    </script>
