<?php
/**
 * File Name : new.document.layer.php
 * Description : 새로온 문서 결재
 * @author 연명학
 * Email : ymh525@nate.com
 * Date : 2010.01.18
 * Update : 2010.07.15
 * Copyright (c) 2009 OLYMCOMUNICATIONS. All Rights Reserved.
 */

  if(!defined("__OLYM_ENGINE__")) exit();
?>
<!-- 문서도착 -->
<?
  $new_note = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['note']." where receive_id='".$_memberID."' and send_check=1 and send_state=1 and receive_check='0' order by no desc limit 1"));
  if($new_note['send_id']){
    $member_note_row = $Project->getMember($new_note['send_id']);
    $document_note_menu = $DBConn->DB_fetch_assoc($DBConn->DB_query("select no from olym_menu where page_file='document/document.note.php'"));
    $new_note_link = './sub.php?olym='.$document_note_menu['no'].'&amp;mode=view&amp;no='.$new_note['no'];
?>
<div id="new_note" style="position:absolute; display:none;">
  <div class="letter">
    <img src="<?echo($projectUrl);?>design/com/alim_letter01.gif" width="373" height="146" alt="문서도착" />
    <ul>
    <li class="text">
      <span class="name"><strong><?echo($member_note_row['username']);?></strong></span>님이 보내신 새로운 문서가<br />도착하였습니다.
    </li>
    <li class="title"><strong>&quot;<?echo(cut_str($new_note['title'], 20));?>&quot;</strong></li>
    </ul>
    <ul class="btn">
      <li><a href="#layer_hidden" onclick="after_view('new_note'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_alim_after.gif" width="96" height="22" alt="나중에보기" /></a></li>
      <li><a href="<?echo($new_note_link);?>"><img src="<?echo($projectUrl);?>design/com/btn_alim_ok.gif" width="96" height="22" alt="지금확인하기" /></a></li>
    </ul>
  </div>
</div>
<script type="text/javascript">
//<![CDATA[
  cookiedata = document.cookie;
  if(cookiedata.indexOf("new_note=done") < 0){
    layer_center('new_note', 373, 324);
  }
//]]>
</script>
<?}?>
<!-- //문서도착 -->

<!-- 결재문서도착 -->
<?
  $new_sanc_query = "state=1 and complete='0' and (help_next_userid='".$_memberID."' or (help='0' and sanction_next_userid='".$_memberID."') or (help='1' and help_sign>0 and help_sign=help_sign_check and sanction_next_userid='".$_memberID."' and state=1 and complete='0'))";
  $new_sanc = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['sanction_document']." where ".$new_sanc_query." order by no desc limit 1"));
  if($new_sanc['sanction_next_userid']){
    $new_sanc_link = './olym/module/content/content.popup.php?kind=sanction&amp;page_info=sanction.view&amp;did='.$new_sanc['no'];
?>
<div id="new_sanc" style="position:absolute; display:none;">
  <div class="letter">
    <img src="<?echo($projectUrl);?>design/com/alim_letter02.gif" width="373" height="146" alt="결재도착" />
    <ul>
    <li class="text">
      <span class="name"><strong><?echo(str_replace("/", " ", $new_sanc['username']));?></strong></span>님이 보내신 새로운 결재가<br />도착하였습니다.
    </li>
    <li class="title"><strong>&quot;<?echo(cut_str($new_sanc['title'], 20));?>&quot;</strong></li>
    </ul>
    <ul class="btn">
      <li><a href="#layer_hidden" onclick="after_view('new_sanc'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_alim_after.gif" width="96" height="22" alt="나중에보기" /></a></li>
      <li>
        <?if($new_sanc['no']){?>
        <a href="#new_sanc_view" onclick="popup_center('view','<?echo($new_sanc_link);?>', 800, 700, 1, 0, 0); layer_showhide('new_sanc'); return false;"><img src="<?echo($projectUrl);?>design/com/btn_alim_ok.gif" width="96" height="22" alt="지금확인하기" /></a>
        <?}else{?>
        <img src="<?echo($projectUrl);?>design/com/btn_alim_ok.gif" width="96" height="22" alt="지금확인하기" />
        <?}?>
      </li>
    </ul>
  </div>
</div>
<script type="text/javascript">
//<![CDATA[
  cookiedata = document.cookie;
  if(cookiedata.indexOf("new_sanc=done") < 0){
    layer_center('new_sanc', 373, 324);
  }
//]]>
</script>
<?}?>
<!-- //결재문서도착 -->