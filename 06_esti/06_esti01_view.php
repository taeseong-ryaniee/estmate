<?php
if($mode == 'update'||$mode == 'view'){
  $row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from olym_esti where no='".$no."'"));
}
if($intranet_admin!=1){
  if($row['mb_no']!=$_memberNo){
    get_alert("올바르지 않은 접근입니다.", "-1", "");
  }
}
?>
<div id="data_form">
<p class="title_basic">견적서</p>
<p align="right"> <a href="#none" onclick="popup_center('print','/project/code/06_esti/06_esti01_print.php?no=<?=$no?>',760,920,1,0,0);"><img src="<?echo($projectUrl);?>design/com/btn_print.gif" alt="인쇄" /></a>
<a href="?olym=<?=$olym?>&mode=update&no=<?=$DB_no?>">
        <img src="/project/design/com/btn_edit.gif" alt="수정">
      </a>
</p><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table3">
<colgroup>
<col width="250" />
<col />
<col width="250" />
<col />
</colgroup>
<tr>
  <th class="left">견적번호</th>
  <td class="left"><?=$DB_estinum?></td>
  <th class="left">구분</th>
  <td class="left"><?=$DB_existing?></td>
</tr>
<tr>
  <th class="left">수신처</th>
  <td class="left"><?=$DB_reception?></td>
  <th class="left">담당자</th>
  <td class="left"><?=$DB_manager?></td>
</tr>
<tr>
  <th class="left">날짜</th>
  <td class="left" colspan="3"><?=$DB_esti_date?></td>
</tr>
<tr>
  <th class="left">Tel</th>
  <td class="left"><?=$DB_tel?></td>
  <th class="left">Email</th>
  <td class="left"><?=$DB_email?></td>
</tr>
<?php
$ext_result=$DBConn->DB_query("select * from olym_esti_ext where e_no='".$no."' order by no asc");
$vat_total=0;
$sum_total=0;
while($ext_row = $DBConn->DB_fetch_assoc($ext_result)){
  $vat=cal_price($ext_row['ea_price'], $ext_row['vat'],"vat");
  $vat_total=$vat_total+($ext_row['ea']*$vat);
  $sum=cal_price($ext_row['ea_price'], $ext_row['vat'],"sum");
  $sum_total=$sum_total+($ext_row['ea']*$sum);
?>
<tr>
  <th class="left">품목</th>
  <td class="left"><?=$ext_row['title']?></td>
  <th class="left">품명</th>
  <td class="left"><?=$ext_row['name']?></td>
</tr>
<tr>
  <th class="left">품명 (세부)</th>
  <td class="left" colspan="3"><?=nl2br($ext_row['detail'])?></td>
</tr>
<tr>
  <th class="left">수량</th>
  <td class="left"><?=$ext_row['ea']?></td>
  <th class="left">단가</th>
  <td class="left"><?=number_format($ext_row['ea_price'])?>
  <?php if($ext_row['vat']=="1"){ $e_txt="(V.A.T 별도)";}
    else if($ext_row['vat']=="2"){ $e_txt="(V.A.T 포함)";}
    else if($ext_row['vat']=="3"){ $e_txt="없음";}
    ?><?=$e_txt?>
  부가세 : <?=number_format($vat)?></td>
</tr>
<tr>
  <th class="left">이미지</th>
  <td class="left" colspan="3"><?php if($ext_row['file_name']!=""){?><?=$ext_row['file_name']?> <a href="/olym/module/admin/include/download2.php?no=<?=$no?>&e_no=<?=$ext_row['no']?>" class="btn_s_blue">다운로드</a><?php }?></td>
</tr>
<?php } ?>
<tr>
  <th class="left">비고</th>
  <td class="left" colspan="3"><?=nl2br($DB_etc)?></td>
</tr>
<tr>
  <th class="left">소계</th>
  <td class="left"><?=number_format($sum_total)?></td>
  <th class="left">부가세</th>
  <td class="left"><?=number_format($vat_total)?></td>
</tr>
<tr>
  <?php
  $round_total=round($sum_total+$vat_total,-1);
  ?>
  <th class="left">제안가</th>
  <td class="left"><?=number_format($round_total)?></td>
  <th class="left">제안가 (한글)</th>
  <td class="left"><?=number2hangul($round_total)?></td>
</tr>
</table>


<div style="padding:20px; text-align:center;">

<a href="<?=$basic_link?>"><img src="/project/design/com/btn_list.gif" alt="목록" /></a></div>

</div>
