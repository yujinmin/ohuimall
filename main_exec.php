<?php
include_once "config.php";

switch ($_REQUEST['exec'])
{
	case "winner_draw" :
		$goods_idx = $_REQUEST['idx'];
		$update_rs = InsertBuyerInfo($goods_idx);
		$winner_chk = "N";
		if ($update_rs)
		{
			$winner_chk = OM_WinCheck($goods_idx);
		}

		echo $winner_chk;
	break;

	case "insert_winner" :
		print_r($_POST);
		$mb_name		= $_REQUEST['mb_name'];
		$mb_phone		= $_REQUEST['mb_phone'];
		$mb_zipcode1	= $_REQUEST['zipcode1'];
		$mb_zipcode2	= $_REQUEST['zipcode2'];
		$mb_addr1		= $_REQUEST['addr1'];
		$mb_addr2		= $_REQUEST['addr2'];
		$goods_idx		= $_REQUEST['goods_idx'];

		$query		= "INSERT INTO ".$_gl['winner_info_table']."(winner_name, winner_phone, winner_zipcode1, winner_zipcode2, winner_address1, winner_address2, winner_ipaddr, winner_goods, winner_date) values('".$mb_name."','".$mb_phone."','".$mb_zipcode1."','".$mb_zipcode2."','".$mb_addr1."','".$mb_addr2."','".$_SERVER['REMOTE_ADDR']."','".$goods_idx."',now())";
		$result		= mysqli_query($my_db, $query);

		if ($result)
		{
			echo "<script>location.href='complete.php?goods_idx=".$goods_idx."';</script>";
		}else{
			echo "<script>alert('정보 입력에 실패하였습니다.');</script>";
		}
	break;
}

?>