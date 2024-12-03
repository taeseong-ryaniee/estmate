<?php
  $head = array(
    'no'        => '번호',
    'estinum'   => '견적번호',
    'reception' => '수신처',
    'manager'   => '담당자',
    'tel'       => 'Tel',
    'existing'  => '구분',
	  'regdate'   => '등록일',
    'mb_no'     => '입력자',
  );

  // 리스트개수
  if(!$limitno){
    $limitno = 15;
  }
  // 페이지
  if(!$page){
    $page = 1;
  }
  // 시작번호
  $startno = ($page-1) * $limitno;

  // 기본쿼리
  $query = "select * from ".$table_name;
  $query2 = "select count(*) from ".$table_name;

  $search_query = '';
  // 검색

  if(!$item){
    $item = 'no';
  }
  if(!$sort){
    $sort = 'desc';
  }
  // 검색
  $search_query=" where 1";
  if($search && $keyword){
    if($search == 'mb_no'){
      if($intranet_admin==1){
        $s_sql = "SELECT no FROM olym_member WHERE username like '%{$keyword}%'";
        $s_result = $DBConn->DB_query($s_sql);

        $nos = array();
        while($s_row = $DBConn->DB_fetch_assoc($s_result)){
          array_push($nos, $s_row['no']);
        }

        $nos = implode(", ",$nos);
        $search_query .= " and mb_no in ({$nos})";
      }else{
        $search_query .= "";
      }
    }else{
      $search_query .= " and {$search} like '%{$keyword}%'";
    }
  }

  // 관리자가 아닐경우 본인이 작성한 것만 볼수 있음.
  if($intranet_admin==1){
    $search_query2="";
  }else{
    $search_query2 =" and mb_no = '{$_memberNo}'";
  }


  // 정렬
  $arrange_query = " order by {$item} {$sort} limit {$startno},{$limitno}";
  $result = $DBConn->DB_query($query.$search_query.$search_query2.$arrange_query);
  //echo $query.$search_query.$arrange_query;
  // 한페이지 게시물개수
  if($result){
    $total_list = $DBConn->DB_num_rows($result);
  }

  // 총 게시물개수
  $result2 = $DBConn->DB_query($query2.$search_query.$search_query2);
  if($result2){
    $total_row = $DBConn->DB_fetch_row($result2);
    $total_count = $total_row[0];
  }

  // 전체 페이지정보
  $total_page = ceil($total_count/$limitno);
?>
<script type="text/javascript">
//<![CDATA[
  function delete_check(str, url){
    var question = confirm("입력된 모든 내용은 삭제됩니다. \n\n정말 ("+str+") 데이터를 삭제하시겠습니까?");
    if(question == true){
      window.location.replace(url);
    }
  }
  function select_xls_esti(){
  var form = document.list_form;
  if(confirm("엑셀을 다운로드 하시겠습니까?")){
      form.action = "/project/code/06_esti/06_esti01_excel.php";
      form.submit();
  }
}
//]]>
</script>
<!-- 페이지정보 -->
<p class="page_total" style="padding-top:5px;"><em>Total :</em><?echo($total_count);?> &nbsp; <em>Page :</em><?echo($page);?>/<?echo($total_page);?></p>
<!-- //페이지정보 -->
<!-- 리스트 -->
<div>
<?php if($intranet_admin==1){?>
<a href="#select_xls" onclick="select_xls_esti(); return false;">[엑셀 다운로드]</a>
<?php }?>
<form id="list_form" name="list_form" method="post" action="<?echo($content_action_controller);?>">
<input type="hidden" name="mode" value="" />
<input type="hidden" name="part" value="" />
<input type="hidden" name="table_name" value="<?echo($table_name);?>" />
<input type="hidden" name="olym" value="<?echo($olym);?>" />
<input type="hidden" name="search" value="<?echo($search);?>" />
<input type="hidden" name="keyword" value="<?echo($keyword);?>" />
<input type="hidden" name="limitno" value="<?echo($limitno);?>" />
<input type="hidden" name="item" value="<?echo($item);?>" />
<input type="hidden" name="sort" value="<?echo($sort);?>" />
<input type="hidden" name="kind" />

<table summary="계정 목록을 볼 수 있는 곳" class="table_basic" cellspacing="0">
  <caption>계정 목록</caption>
  <colgroup>
  <? //if($intranet_admin == 1){ ?>
  <col width="4%" />
  <? // } ?>
  <col width="5%" />
  <col />
  <col />
  <col width="11%" />
  <col width="9%" />
  <col width="9%" />
  <col width="9%" />
  <col width="5%" />
  <? // if($intranet_admin == 1){ ?>
  <col width="270" />
  <? //} ?>
  </colgroup>
  <thead>
  <tr>
    <? //if($intranet_admin == 1){ ?>
    <th scope="col">선택</th>
    <?
      // }
      foreach($head as $key => $value){
        $th_class = '';
        if($key == 'regdate' && $intranet_admin == 0){
          $th_class = ' class="last"';
        }
    ?>
    <th scope="col"<?echo($th_class);?>><a href="<?echo($sort_link);?>&amp;item=<?echo($key);?>&amp;sort=<?echo($sort2);?>"><?echo($value);?></a></th>
    <?
      }
      // if($intranet_admin == 1){
    ?>
    <th class="last" scope="col">설정하기</th>
    <? //} ?>
  </tr>
  </thead>
  <tbody>
  <?
    for($i=0; $i<$total_list; $i++){
      $row = $DBConn->DB_fetch_assoc($result);

      foreach($row as $keys => $values){
        $keys = 'DB_'.$keys;
        $$keys = $values;
        unset($keys);
        unset($values);
      }

      // 폼링크
      $form_link = 'no='.$DB_no.'&amp;page='.$page.'&amp;'.$param_link;
      // 뷰링크
      $view_link = $PHP_SELF.'?olym='.$olym.'&amp;mode=view&amp;'.$form_link;
      // 업데이트링크
      $update_link = $PHP_SELF.'?olym='.$olym.'&amp;mode=update&amp;'.$form_link;
      // 삭제링크
 	    $delete_link = $project_action_controller.'?olym='.$olym.'&amp;mode=delete&amp;kind=esti&amp;table_name='.$table_name.'&amp;'.$form_link;

  ?>
  <tr onMouseOver='this.style.backgroundColor="#F6F6F6"' onMouseOut='this.style.backgroundColor="#FFFFFF"' style="cursor:pointer">
    <? //if($intranet_admin == 1){ ?>
    <td><input type="checkbox" name="select_check_no[]" value="<?echo($DB_no);?>" /></td>
    <?
      // }
      foreach($head as $key => $value){
        $DB_value = ${'DB_'.$key};
        $td_class = '';

        if($key == 'no'){
          $DB_value = $total_count - $i - (($page-1) * $limitno);
        }else if($key == 'regdate'){
          $DB_value = substr($DB_value, 0, 10);
        }else if($key == 'mb_no'){
          $q = "SELECT username FROM `olym_member` WHERE no={$DB_value}";
          $res = $DBConn->DB_query($q);
          $r = $DBConn->DB_fetch_assoc($res);
          $DB_value = $r['username'];
        }else{
          $DB_value;
        }
        if(!$DB_value){
          $DB_value = '&nbsp;';
        }
    ?>
    <td <?echo($td_class);?> onclick="location.href='<?echo($view_link);?>'"><?echo($DB_value);?></td>
    <?
      }
      // if($intranet_admin == 1){
    ?>
    <td class="last">
      <a href="#none" onclick="popup_center('print','/project/code/06_esti/06_esti01_print.php?no=<?=$DB_no?>',760,920,1,0,0);"><img src="<?echo($projectUrl);?>design/com/btn_print.gif" alt="인쇄" /></a>
      <a href="?olym=<?=$olym?>&mode=update&no=<?=$DB_no?>">
        <img src="/project/design/com/btn_edit.gif" alt="수정">
      </a>
      <a href="#delete" onclick="delete_check('<?echo($DB_reception);?>', '<?echo($delete_link);?>'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_delete.gif" alt="삭제" /></a>
    </td>
    <? //} ?>
  </tr>
  <?
    }
    if($total_list == 0){
  ?>
  <tr>
    <td colspan="9" class="blank">등록된 글이 없습니다.</td>
  </tr>
  <?}?>
  </tbody>
</table>
</form>
</div>
<!-- //리스트 -->

<!-- 페이지 링크 -->
<div id="page_navi"><?echo(page_navigation2($page_link));?></div>
<!-- //페이지 링크 -->

<!-- 선택 -->
<div style="float:left; text-align:left;">
  <?if($total_list > 0 && $intranet_admin == 1){?>
  <a href="#select_all_check" onclick="select_all_check('select_check_no[]'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_all_select.gif" alt="전체선택" /></a>
  <a href="#select_delete" onclick="select_delete('select_check_no[]'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_select_delete.gif" alt="선택삭제" /></a>
  <?}?>
  <!-- <a href="#excel" onclick="select_xls('/project/code/05_acco/05_acco01_excel.php'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_excel.gif" alt="엑셀다운로드" /></a> -->
  <a href="<?echo($create_link);?>"><img src="<?echo($commonUrl);?>images/button/btn_submit.gif" alt="등록하기" /></a>
</div>
<!-- //선택 -->

<!-- 검색 -->
<div id="search">
<form id="search_form" name="search_form" method="get" action="<?echo($PHP_SELF);?>">
<input type="hidden" name="olym" value="<?echo($olym);?>" />
<input type="hidden" name="page" value="<?echo($page);?>" />
<input type="hidden" name="item" value="<?echo($item);?>" />
<input type="hidden" name="sort" value="<?echo($sort);?>" />
  <div class="search_info">
    <select name="search" class="search_select">
    <?
      foreach($head as $key => $value){
        if($key == 'no' || $key == 'd_no' || $key == 'regdate'){
          continue;
        }
    ?>
    <option value="<?echo($key);?>"<?if($search == $key){?> selected="selected"<?}?>><?echo($value);?></option>
    <?
      }
    ?>
    </select>
    <input type="text" name="limitno" value="<?echo($limitno);?>" maxlength="3" class="search_input" style="width:28px;" onkeyup="num_check(this);" onblur="num_check(this);" />
    <input type="text" name="keyword" size="18" value="<?echo($keyword);?>" class="search_input" />
    <input type="image" src="<?echo($commonUrl);?>images/button/btn_search.gif" alt="검색" />

  </div>
</form>
</div>
<!-- //검색 -->
