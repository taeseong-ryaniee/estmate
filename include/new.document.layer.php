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

  $new_note_check = 0;
  if($no != $new_note['no'] && $new_note['send_id']){
    $new_note_check = 1;
    $note_cookie = 'new_note'.$new_note['no'].'_'.$_memberID;
    $new_note_cookie = $_COOKIE[$note_cookie];
?>

<script type="text/javascript">
//<![CDATA[
  cookiedata = document.cookie;
  if(cookiedata.indexOf("new_note<?echo($new_note['no']);?>_<?echo($_memberID);?>=done") < 0){
    olymOverlay.showLayer('module', 'layer/layer.php?kind=new.note', '', 373, 324);
  }
//]]>
</script>
<?
  }

  if($new_sanc['sanction_next_userid'] && $new_note_check == 0 && ($mode != 'view' || $new_note_cookie == 'done')){
?>
<script type="text/javascript">
//<![CDATA[
  cookiedata = document.cookie;
  if(cookiedata.indexOf("new_sanc<?echo($new_sanc['no']);?>_<?echo($_memberID);?>=done") < 0){
    olymOverlay.showLayer('module', 'layer/layer.php?kind=new.document', '', 373, 324);
  }
//]]>
</script>
<?}?>