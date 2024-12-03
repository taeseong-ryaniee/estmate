<?php
	$basic_link = $PHP_SELF.'?olym='.$olym;
	$param_info = 'search='.$search.'&amp;keyword='.$keyword.'&amp;limitno='.$limitno;
	$param_link = $param_info.'&amp;item='.$item.'&amp;sort='.$sort;
	$page_link = $basic_link.'&amp;mode='.$mode.'&amp;'.$param_info;
	//생성링크
	$create_link = $basic_link.'&amp;mode=create';
	// 정렬링크
	$sort_link = $PHP_SELF.'?olym='.$olym.'&amp;'.$param_info;

	$table_name = 'olym_esti';

	if($mode == 'update' || $mode == 'view'){
		$row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table_name." where no='".$no."'"));

		if(!$row['no']){
		  get_alert("존재하지 않는 글입니다.", "-1", "");
		}
		foreach($row as $key => $value){
		  $key = 'DB_'.$key;
		  $$key = $value;
		  unset($key);
		  unset($value);
		}

		if($mode == 'view'){
		  $update_link = $PHP_SELF.'?olym='.$olym.'&amp;mode=update&amp;no='.$DB_no.'&amp;'.$param_link;
		  $delete_link = $content_action_controller.'?olym='.$olym.'&amp;mode=delete&amp;part=one&amp;type=one&amp;no='.$row['no'].'&amp;table_name='.$table_name.'&amp;page='.$page.'&amp;'.$param_link;
		}
	}

	if(!$mode) $mode = "list";
	if($mode=='create' || $mode=='update'){
		include '06_esti01_create.php';
	}else{
		include '06_esti01_'.$mode.'.php';
	}
?>
