<?php
  define("__OLYM_ENGINE__", true);
  // ATOM ENGINE 열기
  $engine_path = '../../../olym/engine/';
  require_once $engine_path.'config/olym.engine.config.php';

  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=utf-8");
  Header("Content-Disposition: attachment; filename=견적서(".date("Y-m-d").").xls");
  Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");

  $today=date("Y-m-d");
?>
<table border="1" cellspacing="0" cellpadding="0">
  <colgroup>
    <col width="80px" />
    <col width="150px" />
    <col width="200px" />
    <col width="200px" />
    <col width="300px" />
    <col width="300px" />
    <col width="200px" />
    <col width="200px" />
    <col width="200px" />
    <col width="200px" />
    <col width="300px" />
    <!-- <col width="800px" /> -->
    <col width="100px" />
    <col width="100px" />
    <col width="200px" />
    <col width="200px" />
    <col width="200px" />
    <col width="200px" />
  </colgroup>
  <tr>
    <th colspan="17">견적서 목록(<?=$today?>)</th>
  </tr>
  <tr height="30">
    <th>번호</th>
    <th>견적번호</th>
    <th>입력자</th>
    <th>구분</th>
    <th>수신처</th>
    <th>담당자</th>
    <th>날짜</th>
    <th>Tel</th>
    <th>Email</th>
    <th>품명</th>
    <th>품목</th>
    <!-- <th>품목(세부)</th> -->
    <th>수량</th>
    <th>단가</th>
    <th>부가세 포함 여부</th>
    <th>소계</th>
    <th>부가세</th>
    <th>견적 총 금액</th>
  </tr>
  <?
  $i=0;
  // $sum=0;
  $f_sum=0;
  $f_vat=0;
  $f_p=0;
  $e_cnt_result=$DBConn->DB_query("select count(e_no) as cnt, e_no from olym_esti_ext group by e_no");
  while($e_cnt_row=$DBConn->DB_fetch_assoc($e_cnt_result)){
  $rowspan=$e_cnt_row['cnt'];
  $row=$DBConn->DB_fetch_assoc($DBConn->DB_query("select * from olym_esti where no='{$e_cnt_row['e_no']}'"));
  $m_row=$DBConn->DB_fetch_assoc($DBConn->DB_query("select * from olym_member where no='{$row['mb_no']}'"));
  $i++;
  $j=$rowspan;
  $e_result=$DBConn->DB_query("select * from olym_esti_ext where e_no='{$e_cnt_row['e_no']}' order by no asc");
  $e_result1=$DBConn->DB_query("select * from olym_esti_ext where e_no='{$e_cnt_row['e_no']}'");
  $vat_total=0;
  $sum_total=0;
  while($e_row1=$DBConn->DB_fetch_assoc($e_result1)){
    $vat=cal_price($e_row1['ea_price'], $e_row1['vat'],"vat");
    $vat_total=$vat_total+($e_row1['ea']*$vat);
    $sum=cal_price($e_row1['ea_price'], $e_row1['vat'],"sum");
    $sum_total=$sum_total+($e_row1['ea']*$sum);
  }
  $check=true;
  while($e_row=$DBConn->DB_fetch_assoc($e_result)){
  ?>
  <tr>
    <?php if($check){?>
    <td rowspan="<?=$j?>"><?=$i?></td>
    <td rowspan="<?=$j?>"><?=$row['estinum']?></td>
    <td rowspan="<?=$j?>"><?=$m_row['username']?></td>
    <td rowspan="<?=$j?>"><?=$row['existing']?></td>
    <td rowspan="<?=$j?>"><?=$row['reception']?></td>
    <td rowspan="<?=$j?>"><?=$row['manager']?></td>
    <td rowspan="<?=$j?>"><?=$row['esti_date']?></td>
    <td rowspan="<?=$j?>"><?=$row['tel']?></td>
    <td rowspan="<?=$j?>"><?=$row['email']?></td>
    <?php }?>
    <td><?=$e_row['title']?></td>
    <td><?=$e_row['name']?></td>
    <!-- <td><?=nl2br($e_row['detail'])?></td> -->
    <td><?=$e_row['ea']?></td>
    <td><?=number_format($e_row['ea_price'])?></td>
    <td><?php if($e_row['vat']=="1"){ $e_txt="(V.A.T 별도)";}
    else if($e_row['vat']=="2"){ $e_txt="(V.A.T 포함)";}
    else if($e_row['vat']=="3"){ $e_txt="없음";}
    ?><?=$e_txt?></td>
    <?php if($check){?>
    <td rowspan="<?=$j?>" style="font-weight:bold;"><?=number_format($sum_total)?></td>
    <td rowspan="<?=$j?>" style="font-weight:bold;"><?=number_format($vat_total)?></td>
    <td rowspan="<?=$j?>" style="font-weight:bold;"><?=number_format($sum_total+$vat_total)?></td>

    <?php
    $f_sum=$f_sum+$sum_total;
    $f_vat=$f_vat+$vat_total;
    $f_p=$f_sum+$f_vat;
  }?>
  </tr>
  <?php
  $j=1;
  $check=false;
}
  }
?>
  <tr>
    <td colspan="14" style="font-weight:bold;"></td>
    <td style="font-weight:bold;"><?=number_format($f_sum)?></td>
    <td style="font-weight:bold;"><?=number_format($f_vat)?></td>
    <td style="font-weight:bold;"><?=number_format($f_p)?></td>
  </tr>
</table>