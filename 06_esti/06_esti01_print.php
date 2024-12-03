<?
	define("__OLYM_ENGINE__", true);

	$engine_path = $_SERVER['DOCUMENT_ROOT'].'/olym/engine/';
	include $engine_path.'config/olym.engine.config.php';

	$table_name = 'olym_esti';

  $row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table_name." where no='".$no."' limit 1"));

  if($intranet_admin!=1){
    if($row['mb_no']!=$_memberNo){
      get_alert("올바르지 않은 접근입니다.", "-1", "");
    }
  }
  if(!$row['no']){
    get_alert("존재하지 않는 글입니다.", "-1", "");
  }
  foreach($row as $key => $value){
    $key = 'DB_'.$key;
    $$key = $value;
    unset($key);
    unset($value);
  }
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>견적서</title>
  <style>
body { font-family:"돋움"; line-height:1.2em; font-size:12px; }
@page a4sheet { size:21.0cm 29.7cm }
.a4 { page:a4sheet; page-break-after:always; }
.a4 h1 { text-align:center; font-size:24px; font-weight:bold;}
.a4 h2 { background:url(/project/design/com/bg_h_print.gif) repeat-x left 5px; padding:3px 0 0 0; margin:10px 0;}
.a4 .p_h2 { background:#fff; padding:2px 8px; display:inline; margin-left:8px; letter-spacing:-1px; font-size:12px; }
.table_form1 { font-size:12px; border-collapse:collapse; border:2px solid #000; }
.table_form1 th { text-align:left; padding:5px 5px 5px 5px; background:#f3f3f3; border:1px solid #bcbcbc; }
.table_form1 td { padding:5px 5px 5px 10px; border:1px solid #bcbcbc; }
.table_form1 .td_pa30 { padding:10px;}
.table_form1 th.txC{text-align:center;}
.table_form1 td.txC{text-align:center;}
.table_form1 th.txR{text-align:right;}
.table_form1 td.txR{text-align:right;}
.table_form1 .em{background-color:#B8DDE4}
.table_form2 { font-size:12px; border-collapse:collapse; border:2px solid #000 !important; margin-bottom: 10px; }
.table_form2 th { text-align:center; padding:5px 5px 5px 5px; background:#f3f3f3; border:1px solid #bcbcbc; }
.table_form2 td { padding:5px 5px 5px 5px; border:1px solid #bcbcbc; }
.table_form2 td.center { text-align: center;  }
.table_form2 .td_pa30 { padding:10px;}
.a4 ol { padding:10px; margin:0;}
.a4 .p14 { font-weight:bold; font-size:13px; text-align:center;}
.a4 .p_price { font-weight:bold; font-size:14px; text-decoration:underline;}
.a4 .p12 { font-weight:bold; font-size:12px; text-align:center;}
.a4 .underline { text-decoration:underline;}
.a4 .he_100px { height:100px;}
.a4 .bottom_logo { display:block; padding:10px 10px 10px 0px; float:left;}
.a4 .bottom_logo .img_logo { float:left; display:block;}
.a4 .bottom_logo .right_text { float:left; padding:10px 0 0 5px; font-size:11px; font-family:verdana,"돋움"; letter-spacing:-0.5px; line-height:15px;}
.a4 .bottom_logo .img_logo img{width:200px;}
.a4 .top_logo { display:block; padding:10px 10px 10px 0px; float:left;}
.a4 .top_logo .img_logo { float:left; display:block;}
.a4 .top_logo .img_logo img{width:200px;}
p.txR{text-align:right; font-size:12px; font-weight:600; margin:0 0 5px 0;}
.img{max-width:180px;width:100%;}
.img.stamp{width:70px; position: absolute; top: 164px; right:10px;}
.price{font-weight:600; }
.price span{ font-size: 16px; vertical-align: middle; }
.bottom_info{ float:right; width:400px; height:60px; text-align:right; padding:5px 3px 0 0;}
table.h_table{table-layout: fixed}
.price_im{font-weight: bold; font-size: 14px; }
/* tr.h_tr{height:110px; max-height:110px;} */
@page {size: auto; margin: 0 auto; }
.bottom_p{font-size:10px; text-align:right; padding-right:0px; margin-top:2px; margin-bottom:0px; padding-bottom:3px;}
.sign_wrapper{ border: 2px black solid; padding: 12px; }
.align_right{ text-align: right; }
.align_right .sign_under{width: 80px; border-bottom: 1px black solid; display: inline-block; }
</style>
  <script type="text/javascript">
  /*****프린트****/
  function hide_space() {
    document.getElementById("prn_btn").style.display = "none";
  }

  function show_space() {
    document.getElementById("prn_btn").style.display = "block";
  }

  function print_page() {
    //window.onbeforeprint = hide_space;
    //window.onafterprint = show_space;

    printArea('', '', true, 15, 15, 15, 15);
    //window.print();
    //self.close();
  }

  function printArea(headerStr, footerStr, portraits, lefrM, rightM, topM, bottomM) {
    factory.printing.header = headerStr; //머리말
    factory.printing.footer = footerStr; //꼬리말
    factory.printing.portrait = portraits; // true이면 세로 인쇄, false이면 가로 인쇄.
    factory.printing.leftMargin = lefrM; // 왼쪽 여백
    factory.printing.rightMargin = rightM; // 오른쪽 여백
    factory.printing.topMargin = topM; // 윗쪽 여백
    factory.printing.bottomMargin = bottomM; // 아랫쪽 여백
    factory.printing.Print(false, window); //window 대신 특정 프래임을 넣어주어도 프린트가 된다.
  }
  </script>
</head>

<body>
  <div class="a4">
    <br>
    <div class="top_logo">
      <div class="img_logo"><img src="/project/design/com/print_logo.png" alt="" /></div>
    </div><br><br><br>
    <h1>견&nbsp;&nbsp;&nbsp;적&nbsp;&nbsp;&nbsp;서</h1><br><br>
    <p class="bottom_p">[씨앤씨메디텍 서식]</p>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table_form2">
      <colgroup>
        <col width="80px">
        <col width="240px">
        <col width="90px">
        <col width="36px">
        <col width="100px">
        <col width="36px">
        <col width="">
      </colgroup>
      <tr>
        <td>수신처</td>
        <td><?=$DB_reception?></td>
        <td>등록번호</td>
        <td colspan="4">550-88-01119</td>
      </tr>
      <tr>
        <td>담 당 자</td>
        <td><?=$DB_manager?></td>
        <td>상호 (법인명)</td>
        <td colspan="2">㈜씨앤씨메디텍</td>
        <td>성명</td>
        <td>최 상 호<img src="/project/design/com/stamp.png" class="img stamp" /></td>
      </tr>
      <tr>
        <td>견적번호</td>
        <td><?=$DB_estinum?></td>
        <td rowspan="2">사업장 주소</td>
        <td rowspan="2" colspan="4">서울특별시 영등포구 영신로 220, 703호<br />(영등포동8가, knk 디지털타워)</td>
      </tr>
      <tr>
        <td>날짜</td>
        <td><?=$DB_esti_date?></td>
      </tr>
      <tr>
        <td>유효기간</td>
        <td>30일</td>
        <td>사업의 종류 </td>
        <td>업태</td>
        <td>도소매, 서비스</td>
        <td>종류</td>
        <td>컴퓨터 및 주변기기</td>
      </tr>
      <tr>
        <td>Tel / Fax</td>
        <td><?=$DB_tel?> / <?=$DB_email?></td>
        <td>Tel / Fax</td>
        <td colspan="4">1544-0268 / 02-2655-9989</td>
      </tr>
    </table>
    <span>아래와 같이 견적 드립니다.<br>
      In compliance with your inquery, we here by submit our quotation as mentioned here under.</span>
    <p class="txR">(금액단위: 원)</p>

    <?php
$ext_result=$DBConn->DB_query("select * from olym_esti_ext where e_no='".$DB_no."'");
$vat_total=0;
$sum_total=0;
while($ext_row = $DBConn->DB_fetch_assoc($ext_result)){
  $vat=cal_price($ext_row['ea_price'], $ext_row['vat'],"vat");
  $vat_total=$vat_total+($ext_row['ea']*$vat);
  $sum=cal_price($ext_row['ea_price'], $ext_row['vat'],"sum");
  $sum_total=$sum_total+($ext_row['ea']*$sum);
 }

?>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table_form1 h_table">
      <colgroup>
        <col width="120px" />
        <col width="100px" />
        <col width="" />
        <col width="40px" />
        <col width="80px" />
        <col width="80px" />
        <col width="100px" />
      </colgroup>
      <tr>
        <td colspan="2" class="txC price">합 계 금 액<br>(V.A.T 포함)</td>
        <td colspan="5" class="price">일 금 : <span><?=number2hangul(ceil($sum_total+$vat_total))?> ( ₩<?=number_format($sum_total+$vat_total)?> )</span></td>
      </tr>
      <tr>
        <th class="txC">품 목</th>
        <th colspan="2" class="txC">품 명</th>
        <th class="txC">수량</th>
        <th class="txC">단 가</th>
        <th class="txC">금 액</th>
        <th class="txC">비 고</th>
      </tr>
      <tr>
        <td></td>
        <td colspan="2"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
$ext_result=$DBConn->DB_query("select * from olym_esti_ext where e_no='".$DB_no."' order by no asc");
while($ext_row = $DBConn->DB_fetch_assoc($ext_result)){
?>
      <tr class="em">
        <td class="txC"><?=$ext_row['title']?></td>
        <td colspan="2"><?=$ext_row['name']?></td>
        <td class="txC"><?=$ext_row['ea']?></td>
        <?php if($ext_row['vat']=="3"){
          ?>
        <td class="txR" colspan="3"></td>
        <?php }else{?>
        <td class="txR"><?=number_format($ext_row['ea_price'])?></td>
        <td class="txR"><?=number_format($ext_row['ea']*$ext_row['ea_price'])?></td>
        <td class="txC">(V.A.T <?=($ext_row['vat']=="1")?"별도":"포함"?>)</td>
        <?php }?>
      </tr>
      <tr class="h_tr">
        <td></td>
        <td colspan="2" class="h_td"><?=nl2br($ext_row['detail'])?></td>
        <td></td>
        <td colspan="3"><?php if($ext_row['file_name']!=""){
          $exten=end(explode(".",$ext_row['file_name']));
if($exten=="jpg"||$exten=="JPG"||$exten=="png"||$exten=="PNG"){
          ?><img src="/olym/upload/esti/<?=$ext_row['no']?>/<?=$ext_row['file_name']?>" class="img" /><?php }?></td>
      </tr>
      <?php }
      }?>
    </table>

    <br>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table_form1">
      <colgroup>
        <col width="180px" />
        <col width="360px" />
        <col width="80px" />
        <col width="100px" />
      </colgroup>
      <?php
$m_row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from olym_member where no='".$DB_mb_no."' limit 1"));
$p_row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from olym_position where no='".$m_row['position']."' limit 1"));
?>
      <tr>
        <td class="txC">영업담당자 : <?=$m_row['username']?> <?=$p_row['name']?></td>
        <td class="txC">비&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;고</td>
        <td class="price_im">소 계</td>
        <td class="txR price_im"><?=number_format($sum_total)?></td>
      </tr>
      <tr>
        <td rowspan="2" class="txC">
          Tel : 1544-0268<br>
          H.P : <?=$m_row['mobile']?>
          <br><?=$m_row['email']?>
          </td>
        <td rowspan="2"><?=nl2br($DB_etc)?></td>
        <td class="price_im">부 가 세</td>
        <td class="txR price_im"><?=number_format($vat_total)?></td>
      </tr>
      <tr>
        <td class="price_im">제 안 가</td>
        <td class="txR price_im"><?=number_format($sum_total+$vat_total)?></td>
      </tr>
    </table>
    <br />
    <div class="sign_wrapper">
      당사는 이 견적서 상의 가격 및 조건들을 수용하고 이 견적서를 귀사에 대한 공식 발주서로 대신하고자 합니다.<br />
      ※발주 시 귀사의 명판 및 직인(또는 담당자 서명) 날인하여 담당자 이메일로 보내주십시오.
      <br /><br />
      <div class="align_right">발주자명 : <div class="sign_under"></div> (서명)</div>
    </div>

    <div class="bottom_logo">
      <div class="img_logo"><img src="/project/design/com/print_barco.jpg" alt="" /></div>
    </div>
    <div class="bottom_info">www.cncmeditech.com<br>의료기기전문업체<br>Medical Display 판매 및 유지보수<br>Healthcare solution biz
    </div>
  </div>

  </div>
</body>

</html>
<!-- 프린트 모듈 시작 -->
<object id="factory" style="display:none;" classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" viewastext
  codebase="<?=$commonUrl?>script/lib/smsx.cab#Version=6,5,439,50"></object>
<script type="text/javascript">
print_page()
</script>
<!-- 프린트 모듈 종료 -->