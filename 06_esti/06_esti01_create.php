<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">
  var count = 0;
<?php if($mode=="create"){?>
$(function() {
  add_item();
});
<?php }?>

function add_item() {
  $.ajax({
    type: "POST",
    url: "/project/code/06_esti/add_item.php",
    data: ({
      no: count + 1,
      esti_no:'<?=$no?>'
    }),
    success: function(data) {
      count++;
      $(".item_box").append(data);
    }
  });
}

function delete_item(obj){
  if(!obj){
    return false;
  }
  var child = $(obj).parent().parent().parent().parent();
  child.remove();
}

function write_form_check(form) {
  form.action = module_url + "project/project.action.controller.php";
  return true;
}
</script>

<?php
if($mode == 'update'){
  $esti = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table_name." where no='".$no."'"));
}
?>
<div id="data_form">
  <form id="companyForm" name="companyForm" method="post" action="./" onsubmit="return write_form_check(this)"
    enctype="multipart/form-data">
    <input type="hidden" name="olym" value="<?=$olym?>" />
    <input type="hidden" name="kind" value="esti" />
    <input type="hidden" name="mode" value="<?=$mode?>" />
    <input type="hidden" name="no" value="<?=$no?>" />
    <p class="title_basic">견적서</p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table3">
      <colgroup>
        <col width="250" />
        <col />
        <col width="250" />
        <col />
      </colgroup>
      <tr>
        <th class="left">구분</th>
        <td class="left" colspan="3">
          <input type="radio" name="existing" id="existing1" value="신규"
            <?=($esti['existing']=="신규" || $mode=="create")?"checked":""?>> <label for="existing1">신규</label>
          <input type="radio" name="existing" id="existing2" value="경쟁사" <?=($esti['existing']=="경쟁사")?"checked":""?>>
          <label for="existing2">경쟁사</label>
          <input type="radio" name="existing" id="existing3" value="기존" <?=($esti['existing']=="기존")?"checked":""?>>
          <label for="existing3">기존</label>
        </td>
      </tr>
      <tr>
        <th class="left">수신처</th>
        <td class="left"><input type="text" class="input_text" size="30" name="reception"
            value="<?=$esti['reception']?>" /></td>
        <th class="left">담당자</th>
        <td class="left"><input type="text" class="input_text" size="30" name="manager" value="<?=$esti['manager']?>" />
        </td>
      </tr>
      <tr>
        <th class="left">날짜</th>
        <td class="left" colspan="3">
          <input type="date" class="input_text" size="12" name="esti_date" value="<?=$esti['esti_date']?>" />
        </td>
      </tr>
      <tr>
        <th class="left">Tel</th>
        <td class="left"><input type="text" class="input_text" size="30" name="tel" value="<?=$esti['tel']?>" /></td>
        <th class="left">Email</th>
        <td class="left"><input type="text" class="input_text" size="30" name="email" value="<?=$esti['email']?>" />
        </td>
      </tr>
    </table>

    <div class="item_box">
      <?php if($mode=="update"){
        $ext_result=$DBConn->DB_query("select * from olym_esti_ext where e_no='".$no."' order by no asc");
        while($ext_row = $DBConn->DB_fetch_assoc($ext_result)){ ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table3 add_item">
            <colgroup>
              <col width="250" />
              <col />
              <col width="250" />
              <col />
            </colgroup>

            <tr class="delete_item item<?=$ext_row['no']?>">
            <input type="hidden" name="new_check[<?=$ext_row['no']?>]" value="update" />
              <th class="left">품목 <a href="javascript:;" onclick="delete_item(this)">
                <img src="/project/design/com/btn_delete.gif" alt="삭제" /> </a></th>
              <td class="left"><input type="text" class="input_text" size="30" name="title[<?=$ext_row['no']?>]" value="<?=$ext_row['title']?>" /></td>
              <th class="left">품명</th>
              <td class="left"><input type="text" class="input_text" size="30" name="name[<?=$ext_row['no']?>]" value="<?=$ext_row['name']?>" /></td>
            </tr>

            <tr class="delete_item item<?=$ext_row['no']?>">
              <th class="left">품명 (세부)</th>
              <td class="left" colspan="3"><textarea name="detail[<?=$ext_row['no']?>]" rows="8" cols="80" class="textarea_500"
                  style="width: 98%;padding:6px"><?=$ext_row['detail']?></textarea></td>
            </tr>

            <tr class="delete_item item<?=$ext_row['no']?>">
              <th class="left">수량</th>
              <td class="left"><input type="text" class="input_text" size="10" name="ea[<?=$ext_row['no']?>]" value="<?=$ext_row['ea']?>"
                  onkeyup="num_check(this);" onblur="num_check(this);" /></td>
              <th class="left">단가</th>
              <td class="left"><input type="text" class="input_text" size="30" name="ea_price[<?=$ext_row['no']?>]" value="<?=$ext_row['ea_price']?>"
                  onkeyup="num_check(this);" onblur="num_check(this);" />
                <input type="radio" name="vat[<?=$ext_row['no']?>]" id="vat<?=$ext_row['no']?>_1" value="1" <?=($ext_row['vat']=="1")?"checked":""?>> <label
                  for="vat<?=$ext_row['no']?>_1">V.A.T 별도</label>&nbsp;&nbsp;
                <input type="radio" name="vat[<?=$ext_row['no']?>]" id="vat<?=$ext_row['no']?>_2" value="2" <?=($ext_row['vat']=="2")?"checked":""?>> <label
                  for="vat<?=$ext_row['no']?>_2">V.A.T 포함</label>&nbsp;&nbsp;
                <input type="radio" name="vat[<?=$ext_row['no']?>]" id="vat<?=$ext_row['no']?>_3" value="3" <?=($ext_row['vat']=="3")?"checked":""?>> <label
                  for="vat<?=$ext_row['no']?>_3">없음</label>
              </td>
            </tr>

            <tr class="delete_item item<?=$ext_row['no']?>">
              <th class="left">이미지</th>
              <td class="left" colspan="3">
                <?php if($ext_row['file_name']!=""){?><?=$ext_row['file_name']?> <a href="/olym/module/admin/include/download2.php?no=<?=$no?>&e_no=<?=$ext_row['no']?>" class="btn_s_blue">다운로드</a><?php }?>
                <input type="file" id="" name="file_name[<?=$ext_row['no']?>]" size="60" class="input_text" style="height:20px;" />
                &nbsp <input type="checkbox" id="" name="is_delete[<?=$ext_row['no']?>]" value="1"/> 파일삭제 [체크하고 등록하면 해당 파일이 삭제됩니다.]
              </td>
            </tr>

          </table>
        <?php }
      }?>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table3">
      <colgroup>
        <col width="250" />
        <col />
        <col width="250" />
        <col />
      </colgroup>
      <tr>
        <th class="left">비고</th>
        <td class="left" colspan="3">
          <textarea name="etc" rows="8" cols="80" class="textarea_500"
            style="width: 98%;padding:6px"><?=$esti['etc']?></textarea>
        </td>
      </tr>
    </table>
    <br>

    <a href="javascript:add_item();"><img src="/project/design/com/btn_add.gif" alt="추가" /> </a>
    <div style="padding:20px; text-align:center;"><a href="<?=$basic_link?>">
        <input type="image" src="/project/design/com/btn_submit.gif" alt="등록" /> </a>
        <a href="<?=$basic_link?>"><img src="/project/design/com/btn_list.gif" alt="목록" /></a>
    </div>
  </form>
</div>
