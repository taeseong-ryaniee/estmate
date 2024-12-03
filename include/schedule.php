<div id="tab_sche">
  <a href="#tab_schedule" onclick="tab_change(1,2); return false;" onkeydown="tab_change(1,2);"><img src="<?echo($projectUrl);?>design/main/tab_sche1_over.gif" id="T1" name="T1" alt="개인" title="개인일정보기" width="52" height="22" border="0" /></a>
  <a href="#tab_schedule" onclick="tab_change(2,2); return false;" onkeydown="tab_change(2,2);"><img src="<?echo($projectUrl);?>design/main/tab_sche2_off.gif" id="T2" name="T2" alt="부서" title="부서일정보기" width="52" height="22" border="0" /></a>
</div>
<?
  // 개인일정
  $today = date("Y-m-d");
  $schedule_result = $DBConn->DB_query("select * from ".$table['schedule_person']." where date='".$today."' and userid='".$_memberID."' order by date, hour, minute");
?>
<div id="tab_schedule1">
<table summary="금일 개인일정" class="table_basic" cellspacing="0">
  <caption>금일 개인일정</caption>
  <col width="20%" />
  <col />
  <tr>
    <th scope="col">시간</th>
    <th class="last" scope="col">일정</th>
  </tr>
  <?
    for($s=1; $s<=5; $s++){
      $schedule_row = $DBConn->DB_fetch_assoc($schedule_result);
      $schedule_title = '&nbsp;';
      $schedule_time = '&nbsp;';
      if($schedule_row['no']){
        $schedule_view_link = './sub.php?olym=7&amp;mode=view&amp;kind=month&amp;no='.$schedule_row['no'].'&amp;year='.date("Y").'&amp;month='.date("m").'&amp;day='.date("d");
        $schedule_time = sprintf("%02d:%02d", $schedule_row['hour'], $schedule_row['minute']);
        $schedule_title = $schedule_row['title'];
      }
  ?>
  <tr>
    <td><?echo($schedule_time);?></td>
    <td class="left_last">
      <?if($schedule_row['no']){?>
      <a href="<?echo($schedule_view_link);?>"><?echo($schedule_title);?></a>
      <?}else{?>
      &nbsp;
      <?}?>
    </td>
  </tr>
  <?}?>
</table>
</div>

<?
  // 그룹일정
  $schedule_result2 = $DBConn->DB_query("select * from ".$table['schedule_group']." where date='".$today."' and groupid='".$_memberGroupID."' order by date, hour, minute");
?>
<div id="tab_schedule2" style="display:none;">
<table summary="금일 그룹일정" class="table_basic" cellspacing="0">
  <caption>금일 그룹일정</caption>
  <col width="20%" />
  <col />
  <tr>
    <th scope="col">시간</th>
    <th class="last" scope="col">일정</th>
  </tr>
  <?
    for($s=1; $s<=5; $s++){
      $schedule_row2 = $DBConn->DB_fetch_assoc($schedule_result2);
      $schedule_title2 = '&nbsp;';
      $schedule_time2 = '&nbsp;';
      if($schedule_row2['no']){
        $schedule_view_link2 = './sub.php?olym=8&amp;mode=view&amp;kind=month&amp;no='.$schedule_row2['no'].'&amp;year='.date("Y").'&amp;month='.date("m").'&amp;day='.date("d");
        $schedule_time2 = sprintf("%02d:%02d", $schedule_row2['hour'], $schedule_row2['minute']);
        $schedule_title2 = $schedule_row2['title'];
      }
  ?>
  <tr>
    <td><?echo($schedule_time2);?></td>
    <td class="left_last">
      <?if($schedule_row2['no']){?>
      <a href="<?echo($schedule_view_link2);?>"><?echo($schedule_title2);?></a>
      <?}else{?>
      &nbsp;
      <?}?>
    </td>
  </tr>
  <?}?>
</table>
</div>