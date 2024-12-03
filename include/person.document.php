<?
  // 수신문서
  $note_count = $DBConn->DB_fetch_row($DBConn->DB_query("select count(*) from ".$table['note']." where receive_id='".$_memberID."' and send_check=1 and receive_check='0' and send_state=1 and receive_state=1"));
  // 상신문서
  $report_count = $DBConn->DB_fetch_row($DBConn->DB_query("select count(*) from ".$table['sanction_document']." where userid='".$_memberID."' and state='1'"));
  // 반려문서
  $return_count = $DBConn->DB_fetch_row($DBConn->DB_query("select count(*) from ".$table['sanction_document']." where userid='".$_memberID."' and state>'1' and complete ='0'"));
  // 결재완료문서
  $complete_count = $DBConn->DB_fetch_row($DBConn->DB_query("select count(*) from ".$table['sanction_document']." where userid='".$_memberID."' and state='1' and complete ='1'"));
?>
<table summary="개인문서함 정보" width="100%" class="table_basic" cellspacing="0">
  <caption>개인문서함</caption>
  <tr>
    <th scope="col">수신문서</th>
    <th scope="col">상신문서</th>
    <th scope="col">반려문서</th>
    <th class="last" scope="col">결재완료</th>
  </tr>
  <tr>
    <td><a href="./sub.php?olym=9"><?echo(number_format($note_count[0]));?>건</a></td>
    <td><a href="./sub.php?olym=10"><?echo(number_format($report_count[0]));?>건</a></td>
    <td><a href="./sub.php?olym=12"><?echo(number_format($return_count[0]));?>건</a></td>
    <td class="last"><a href="./sub.php?olym=13"><?echo(number_format($complete_count[0]));?>건</a></td>
  </tr>
</table>
