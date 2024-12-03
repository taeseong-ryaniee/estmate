<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table3 add_item">
  <colgroup>
    <col width="250" />
    <col />
    <col width="250" />
    <col />
  </colgroup>

  <tr class="delete_item item<?=$_POST['no']?>">
  <input type="hidden" name="new_check[<?=$_POST['no']?>]" value="create" />
    <th class="left">품목 <a href="javascript:;" onclick="delete_item(this)">
      <img src="/project/design/com/btn_delete.gif" alt="삭제" /> </a></th>
    <td class="left"><input type="text" class="input_text" size="30" name="title[<?=$_POST['no']?>]" value="" /></td>
    <th class="left">품명</th>
    <td class="left"><input type="text" class="input_text" size="30" name="name[<?=$_POST['no']?>]" value="" /></td>
  </tr>
  <tr class="delete_item item<?=$_POST['no']?>">
    <th class="left">품명 (세부)</th>
    <td class="left" colspan="3">
      <textarea name="detail[<?=$_POST['no']?>]" rows="8" cols="80" class="textarea_500" style="width: 98%;padding:6px"></textarea></td>
  </tr>
  <tr class="delete_item item<?=$_POST['no']?>">
    <th class="left">수량</th>
    <td class="left"><input type="text" class="input_text" size="10" name="ea[<?=$_POST['no']?>]" value=""
        onkeyup="num_check(this);" onblur="num_check(this);" /></td>
    <th class="left">단가</th>
    <td class="left"><input type="text" class="input_text" size="30" name="ea_price[<?=$_POST['no']?>]" value=""
        onkeyup="num_check(this);" onblur="num_check(this);" />
      <input type="radio" name="vat[<?=$_POST['no']?>]" id="vat<?=$_POST['no']?>_1" value="1" checked>
      <label for="vat<?=$_POST['no']?>_1">V.A.T 별도</label>&nbsp;&nbsp;
      <input type="radio" name="vat[<?=$_POST['no']?>]" id="vat<?=$_POST['no']?>_2" value="2">
      <label for="vat<?=$_POST['no']?>_2">V.A.T 포함</label>&nbsp;&nbsp;
      <input type="radio" name="vat[<?=$_POST['no']?>]" id="vat<?=$_POST['no']?>_3" value="3">
      <label for="vat<?=$_POST['no']?>_3">없음</label>
    </td>
  </tr>
  <tr class="delete_item item<?=$_POST['no']?>">
    <th class="left">이미지</th>
    <td class="left" colspan="3">
      <input type="file" id="" name="file_name[<?=$_POST['no']?>]" size="60" class="input_text" style="height:20px;" /></td>
  </tr>
</table>