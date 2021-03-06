<?
	// 상품정보 (idx)
	function OM_GetGoodsInfo($idx)
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE idx='".$idx."'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_fetch_array($result);

		return $info;
	}

	// 당첨자정보 (phone)
	function OM_GetWinnerInfo($phone)
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['winner_info_table']." WHERE winner_phone='".$phone."'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_fetch_array($result);

		return $info;
	}

	// 회원정보 (phone) - 현재 날짜에 참여 했는지 확인
	function OM_GetBuyerInfoByPhone($phone)
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['buyer_info_table']." WHERE buyer_phone='".$phone."' AND buyer_date like '%".date('Y-m-d')."%'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_num_rows($result);

		return $info;
	}

	// 구매자 정보 입력
	function InsertBuyerInfo($mb_name, $mb_phone, $goods_idx, $buyer_gubun)
	{
		global $_gl;
		global $my_db;

		$query 		= "INSERT INTO ".$_gl['buyer_info_table']."(buyer_ipaddr,buyer_name,buyer_phone,buyer_goods,buyer_date,buyer_gubun) values ('".$_SERVER['REMOTE_ADDR']."','".$mb_name."','".$mb_phone."','".$goods_idx."',now(),'".$buyer_gubun."')";
		$result 	= mysqli_query($my_db, $query);

		return $result;
	}

	// 유입매체 정보 입력
	function OM_InsertTrackingInfo($media, $gubun)
	{
		global $_gl;
		global $my_db;

		$query		= "INSERT INTO ".$_gl['tracking_info_table']."(tracking_media, tracking_ipaddr, tracking_date, tracking_gubun) values('".$media."','".$_SERVER['REMOTE_ADDR']."',now(),'".$gubun."')";
		$result		= mysqli_query($my_db, $query);
	}

	// 오늘 구매 인원 
	function OM_TodayBuyCnt()
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['buyer_info_table']." WHERE buyer_date like '%".date('Y-m-d')."%'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_num_rows($result);

		return $info;
	}

	function OM_TodayWinnerYN()
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['winner_info_table']." WHERE winner_date like '%".date('Y-m-d')."%'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_num_rows($result);

		return $info;
	}
	function OM_WinnerByPhone($phone)
	{
		global $_gl;
		global $my_db;

		$query 		= "SELECT * FROM ".$_gl['winner_info_table']." WHERE winner_phone = '".$phone."'";
		$result 	= mysqli_query($my_db, $query);
		$info		= mysqli_num_rows($result);

		return $info;
	}

	function OM_GoodsWinUpdate($idx)
	{
		global $_gl;
		global $my_db;

		$query 		= "UPDATE ".$_gl['goods_info_table']." SET goods_selcount = goods_selcount + 1 WHERE idx = '".$idx."'";
		$result 	= mysqli_query($my_db, $query);
	}
	// 당첨자 체크 로직 - 기존 당첨자도 체크
	function OM_WinCheck($idx)
	{
		global $_gl;
		global $my_db;

		$chkwin = "N";
		// 하루에 10명 당첨


		// 당일 구매자 수 조회
		$today_cnt = OM_TodayBuyCnt();
		if (date("Y-m-d") <= "2014-12-07")
		{
			$winner_array = array(2,35,112,230);
			$max_winner_cnt = 4;
		}else if(date("Y-m-d") <= "2014-12-09" && date("Y-m-d") > "2014-12-07"){
			$winner_array = array(2,10,35,80,112,145,175,200,230,280,300);
			$max_winner_cnt = 11;
		}else{
			$winner_array = array(2,10,35,80,112,145,175,200,230,280);
			$max_winner_cnt = 10;
		}

		foreach ($winner_array as $key => $val)
		{
			if ($today_cnt == $val)
			{
				$chkwin = "Y";
				OM_GoodsWinUpdate($idx);
			}
		}

		$winner_add_array = array(320,350,380,410,440,470,500,530,560,590,620,650,680);
		if ($today_cnt > 280)
		{
			$today_winner = OM_TodayWinnerYN();
			if ($today_winner < $max_winner_cnt)
			{
				foreach ($winner_add_array as $key2 => $val2)
				{
					if ($today_cnt == $val2)
					{
						$chkwin = "Y";
						OM_GoodsWinUpdate($idx);
					}
				}
			}
		}
		return $chkwin;

	}

?>