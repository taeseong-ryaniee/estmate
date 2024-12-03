<?php
/**
 * File Name : contactus.php
 * Description : 관리자문의
 * @author 연명학
 * Email : ymh525@nate.com
 * Date : 2009.11.19
 * Update : 2010.05.28
 * Copyright (c) 2009 OLYMCOMUNICATIONS. All Rights Reserved.
 */

  //if(!defined("__OLYM_ENGINE__")) exit();

  if(!$olym){
    $olym = 'main';
  }

  $projectUrl = '/project/';
?>
<script type="text/javascript">
//<![CDATA[
contactus_form_check = function(form){
  if(!form.contact_name.value){
    alert("성명을 입력해 주세요");
    form.contact_name.focus();
    return false;
  }
  if(!form.contact_tel1.value){
    alert("연락처를 입력해 주세요");
    form.contact_tel1.focus();
    return false;
  }
  if(!form.contact_tel2.value){
    alert("연락처를 입력해 주세요");
    form.contact_tel2.focus();
    return false;
  }
  if(!form.contact_tel3.value){
    alert("연락처를 입력해 주세요");
    form.contact_tel3.focus();
    return false;
  }
  re=/^[0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,3}$/i;
  if(!form.contact_email.value || !re.test(form.contact_email.value)){
    alert("올바른 이메일 주소를 입력해 주십시오.");
    form.contact_email.focus();
    return false;
  }
  if(!form.contact_title.value){
    alert("제목을 입력해 주세요");
    form.contact_title.focus();
    return false;
  }
  if(!form.contact_memo.value){
    alert("내용을 입력해 주세요");
    form.contact_memo.focus();
    return false;
  }
  contactus_check();
  return false;
}
//]]>
</script>

<div id="contactus_wrap">
  <div id="contactus_header">
    <!-- 상단배경 -->
    <div id="contactus_head_center">&nbsp;</div>
    <div id="contactus_head_left">&nbsp;</div>
    <div id="contactus_head_right">&nbsp;</div>
    <!-- //상단배경 -->
    <div id="contactus_head_content">
      <h1><img src="<?echo($projectUrl);?>design/contactus/h_contact.gif" alt="CONTACT US 관리자에게 메일보내기" /></h1>
      <p style="clear:both;"><img src="<?echo($projectUrl);?>design/contactus/p_contact.gif" alt="관리자에게 메일을 보내실 수 있습니다. 답장을 위한 메일 주소는 필히 남겨주시기 바랍니다." /></p>
    </div>
  </div>

  <form id="contactus_form" name="contactus_form" method="post" action="./" onsubmit="return contactus_form_check(this)" enctype="multipart/form-data">
  <input type="hidden" name="olym" value="<?echo($olym);?>" />
  <input type="hidden" name="kind" value="contactus" />
  <div id="contactus_container">
    <div id="contactus_contents_box">
      <div id="line_h"></div>
      <div class="form_esse"><span class="c_red">*</span>&nbsp;&nbsp; 는 필수 항목입니다.</div>

        <table summary="관리자문의 하기" width="100%" border="0" cellspacing="0" cellpadding="0" class="table_form2">
          <caption>관리자문의</caption>
          <colgroup>
            <col width="130" />
            <col width="10" />
            <col />
          </colgroup>
          <tr>
            <th scope="row"><label for="contact_name">성명</label><span class="c_red">*</span></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td><input type="text" name="contact_name" id="contact_name" class="input_form" /></td>
          </tr>
          <tr>
            <th scope="row" class="bg2"><label for="contact_company">업체명</label></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td><input type="text" name="contact_company" id="contact_company" class="input_form" /></td>
          </tr>
          <tr>
            <th scope="row"><label for="contact_tel1">연락처</label><span class="c_red">*</span></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td>
              <input type="text" name="contact_tel1" id="contact_tel1" class="input_form" size="3" maxlength="3" onkeyup="num_check(this);" onblur="num_check(this);" title="지역번호" /> -
              <input type="text" name="contact_tel2" id="contact_tel2" class="input_form" size="4" maxlength="4" onkeyup="num_check(this);" onblur="num_check(this);" title="국번" /> -
              <input type="text" name="contact_tel3" id="contact_tel3" class="input_form" size="4" maxlength="4" onkeyup="num_check(this);" onblur="num_check(this);" title="가입번호" />
            </td>
          </tr>
          <tr>
            <th scope="row" class="bg2"><label for="contact_email">이메일</label><span class="c_red">*</span></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td><input type="text" name="contact_email" id="contact_email" size="35" class="input_form" /></td>
          </tr>
          <tr>
            <th scope="row"><label for="contact_title">제목</label><span class="c_red">*</span></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td><input type="text" name="contact_title" id="contact_title" size="60" class="input_form" /></td>
          </tr>
          <tr>
            <th scope="row" class="bg2"><label for="contact_memo">내용</label><span class="c_red">*</span></th>
            <td><img src="<?echo($projectUrl);?>design/contactus/line_v_dot_form.gif" alt="" /></td>
            <td><textarea name="contact_memo" id="contact_memo" cols="45" rows="5" class="textarea_form"></textarea></td>
          </tr>
        </table>

      </div>
    <div class="clear"></div>
  </div>
  <div id="contactus_btn_bottom">
    <div style="float:left"><input type="image" src="<?echo($projectUrl);?>design/contactus/btn_reg_form_off.gif" alt="등록" />&nbsp;</div>
    <div style="float:left"><a href="#close" onclick="layer_showhide('contactus'); return false;"><img src="<?echo($projectUrl);?>design/contactus/btn_close_off.gif" alt="닫기" /></a></div>
  </div>
  <div id="contactus_footer">
    <div id="contactus_foot_center">&nbsp;</div>
    <div id="contactus_foot_left">&nbsp;</div>
    <div id="contactus_foot_right">&nbsp;</div>
  </div>
  </form>
</div>