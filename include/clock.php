<?
  // 오늘날짜 정보
  $today = date("Y-m-d");
  $yoil = get_weekday(date("Y"), date("m"), date("d"));
  $today_info = date("Y년 m월 d일").'&nbsp;'.$yoil.'요일';

  // 오늘정보
  $today_row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['commute']." where date='".$today."' and userid='".$_memberID."' limit 1"));

  // 출근시간
  $start_time = '출근확인해 주세요';
  if($today_row['start_check'] == 1){
    $start_time = $today_row['start_time'];
  }

  // 퇴근시간
  $end_time = '퇴근확인해 주세요';
  if($today_row['end_check'] == 1){
    $end_time = $today_row['end_time'];
  }
?>
<ul class="clock_head">
  <li class="li1"><?echo($today_info);?></li>
  <li style="display:none;">
    <!-- 시계 -->
    <div id="webClock"></div>
    <!-- //시계 -->
  </li>
  <li>
    <ul class="clock_text">
      <li><img src="<?echo($projectUrl);?>design/com/ico_apm_blank.gif" id="apm" name="apm" width="27" height="37" alt="" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="hour1" name="hour1" width="27" height="37" alt="" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="hour2" name="hour2" width="27" height="37" alt="" /></li>
      <li class="li_colon"><img src="<?echo($projectUrl);?>design/com/ico_colon.gif" width="6" height="16" alt=":" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="minute1" name="minute1" width="27" height="37" alt="" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="minute2" name="minute2" width="27" height="37" alt="" /></li>
      <li class="li_colon"><img src="<?echo($projectUrl);?>design/com/ico_colon.gif" width="6" height="16" alt=":" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="second1" name="second1" width="27" height="37" alt="" /></li>
      <li><img src="<?echo($projectUrl);?>design/com/ico_num_blank.gif" id="second2" name="second2" width="27" height="37" alt="" /></li>
    </ul>
  </li>
  <li class="li2">
    <div style="float:left; height:57px;">
    <?if($today_row['start_check'] == 0){?>
      <div class="start_off">
      <?if($my_info['position'] && $u=='pc'){?>
        <a href="#commute_check" onclick="commute_check('start');" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/main/btn_start_off.gif" alt="출근" /></a>
      <?}else{?>
        <a href="#commute_check" onclick="alert('출근체크를 할 수 없습니다.');" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/main/btn_start_off.gif" alt="출근" /></a>
      <?}?>
      </div>
    <?}else{?>
      <div class="start_complete"><div>출근시간</div><p><?echo($start_time);?></p></div>
    <?
      }
    ?>
    </div>

    <div style="float:left; height:47px;">
    <?
       // 현재시간
      $current_hour = date("G");
      // 출근시간
      $start_time_array = explode(":", $site['start_time']);
      $start_time_hour = (int)$start_time_array[0];
      // 퇴근시간
      $end_time_array = explode(":", $site['end_time']);
      $end_time_hour = (int)$end_time_array[0];

      // 어제정보
      $yesterday = date("Y-m-d", (time()-86400));
      $yesterday_row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['commute']." where date='".$yesterday."' and userid='".$_memberID."' limit 1"));

      if((($today_row['start_check'] == 1 && $today_row['end_check'] == 0 && $current_hour >= $end_time_hour) || ($yesterday_row['start_check'] == 1 && $yesterday_row['end_check'] == 0 && $current_hour < $start_time_hour)) && $u=='pc'){
    ?>
      <div><a href="#commute_check" onclick="commute_check('end');" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/main/btn_finish_off.gif" alt="퇴근" /></a></div>
    <?}else if($today_row['start_check'] == 1 && $today_row['end_check'] == 1){?>
      <div class="end_complete"><div>퇴근시간</div><p><?echo($end_time);?></p></div>
    <?}else{?>
      <div><a href="#commute_check" onclick="alert('퇴근체크를 할 수 없습니다.');" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/main/btn_finish_off.gif" alt="퇴근" /></a></div>
    <?}?>
    </div>
  </li>
</ul>