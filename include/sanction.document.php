<?
  $sanction_query = "select * from ".$table['sanction_document']." where (sanction_next_userid='".$_memberID."' or help_next_userid='".$_memberID."') and state='1' and complete='0' order by no desc";
  $sanction_result = $DBConn->DB_query($sanction_query);
?>
<table summary="전자미결재문서" class="table_basic" cellspacing="0">
  <caption>전자미결재</caption>
  <colgroup>
  <col width="25%" />
  <col />
  <col width="25%" />
  </colgroup>
  <tr>
    <th scope="col">문서번호</th>
    <th scope="col">문서명</th>
    <th class="last" scope="col">기안자</th>
  </tr>
  <?
    for($s=1; $s<=3; $s++){
      $sanc_row = $DBConn->DB_fetch_assoc($sanction_result);
      $sanc_doc_num = '&nbsp;';
      $sanc_title = '&nbsp;';
      $sanc_member = '&nbsp;';
      if($sanc_row['no']){
        $sanc_doc_num = substr($sanc_row['regdate'], 2, 2).substr($sanc_row['regdate'], 5, 2).'-'.sprintf("%04d", $sanc_row['serial']);
        $sanc_member = str_replace("/", " ", $sanc_row['username']);

        $sanc_view_link = './olym/module/content/content.popup.php?kind=sanction&amp;page_info=sanction.view&amp;did='.$sanc_row['no'];
        $sanc_title = '<a href="#view" onclick="popup_center(\'view\',\''.$sanc_view_link.'\', 800, 700, 1, 0, 0); return false;">'.$sanc_row['title'].'</a>';
      }
  ?>
  <tr>
    <td><?echo($sanc_doc_num);?></td>
    <td class="left"><?echo($sanc_title);?></td>
    <td class="last"><?echo($sanc_member);?></td>
  </tr>
  <?}?>
</table>