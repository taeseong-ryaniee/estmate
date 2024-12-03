<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8"/>
<title><?php $Project->naviTitle(); ?></title>
<link rel="stylesheet" type="text/css" href="<?echo($projectUrl);?>css/default.css" />
<!--[if lte IE 7]>
<link rel="stylesheet" type="text/css" href="<?echo($projectUrl);?>css/ie.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?echo($projectUrl);?>css/contents.css" />
<link rel="stylesheet" type="text/css" href="<?echo($commonUrl);?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?echo($commonUrl);?>css/dtree.css" />
<?if($menu['bid']){?>
<link rel="stylesheet" type="text/css" href="<?echo($boardUrl);?>css/<?echo($site['boardcss']);?>/board.css" />
<?}?>
<!-- lib -->
<script type="text/javascript" src="<?echo($commonUrl);?>script/lib/prototype.js"></script>
<!-- //lib -->
<!-- lightbox -->
<link rel="stylesheet" href="<?echo($commonUrl);?>css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?echo($commonUrl);?>script/lib/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="<?echo($commonUrl);?>script/plugin/lightbox.js"></script>
<!-- //lightbox -->
<?php get_script(); ?>
<!-- basic -->
<script src="<?echo($commonUrl);?>script/module/plugin/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?echo($commonUrl);?>script/module/olym.engine.js"></script>
<script type="text/javascript" src="<?echo($commonUrl);?>script/module/olym.overlay.js"></script>
<script type="text/javascript" src="<?echo($commonUrl);?>script/plugin/calendar.layer.js"></script>
<!-- //basic -->
<script type="text/javascript" src="<?echo($commonUrl);?>script/plugin/dtree.js"></script>

</head>
<body>
<!-- wrap -->
<div id="wrap">
  <!-- header -->
  <div id="header"  style="background-color: white; ">

    <!-- 상단배경 -->
    <div id="head_center">&nbsp;</div>
    <div id="head_left">&nbsp;</div>
    <div id="head_right">&nbsp;</div>
    <!-- //상단배경 -->

    <!-- gnb -->
    <div id="gnb">
      <h1><a href="<?echo($localUrl);?>"><img src="<?echo($projectUrl);?>design/com/logo.gif" alt="<?echo($site['name']);?>" title="인트라넷 메인으로 이동합니다." /></a></h1>
      <div id="login_area">
        <p><span><? echo date("Y년 m월 d일"); echo '&nbsp;'.get_weekday(date("Y"), date("m"), date("d")); ?>요일</span> 안녕하세요! <?echo($my_info['name']);?> <?echo($my_info['position']);?>님 좋은 하루 되세요~!</p>
        <div id="top_btn">
          <ul>
            <li><a href="<?echo($localUrl);?>" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/com/btn_home_off.gif" width="45" height="27" alt="메인" /></a></li>
            <li><a href="./sub.php?olym=member.update" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/com/btn_mypage_off.gif" width="73" height="27" alt="마이페이지" /></a></li>
            <li><a href="<?echo($logout_link);?>" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/com/btn_logout_off.gif" width="65" height="27" alt="로그아웃" /></a></li>
            <?if($intranet_admin == 1){?>
            <li><a href="<?echo($localUrl);?>admin" onmouseover="rollover(this);" onfocus="rollover(this);" onmouseout="rollout(this);" onblur="rollout(this);"><img src="<?echo($projectUrl);?>design/com/btn_admin_off.gif" alt="관리자메뉴" /></a></li>
            <?}?>
          </ul>
        </div>
      </div>
    </div>
    <!-- //gnb -->
    <!-- lnb -->
    <div id="lnb">
      <?php $Project->mainMenu(); ?>
    </div>
    <!-- //lnb -->
  </div>
  <!-- //header -->

  <!-- container -->
  <div id="container">
    <!-- contents-box -->
    <div id="content_box">
      <!-- snb -->
      <div id="snb">
        <h2><?php $Project->label(182, 50); ?></h2>
        <div id="nav">
          <div id="dtree">
            <?php $Project->leftMenu(); ?>
          </div>
		  <br/>
		  <!--유지보수바로가기-->
		  <p style="margin-left:-7px;">
			<!-- <a href="http://cs.olymcompany.com" target="_blank"><img src="<?echo($adminUrl);?>images/button/btn_maintenance.gif"  alt="유지보수 바로가기" /></a> -->
		  </p>
        </div>
        <!--
        <div id="manual"><a href="<?echo($projectUrl);?>manual/" target="_blank"><img src="<?echo($projectUrl);?>design/com/btn_manual.gif"  alt="인트라넷 사용자 매뉴얼" /></a></div>
        -->
      </div>
      <!-- //snb -->

      <!-- content_body -->
      <div id="content_body">
        <div id="content_navi">
          <div id="stle">
            <h3><?php $Project->title(100, 50); ?></h3>
          </div>
          <div id="path"><img src="<?echo($projectUrl);?>design/com/ico_home.gif" alt="" /> <a href="<?echo($localUrl);?>">홈</a> &gt; <?php $Project->navigation(">"); ?></div>
        </div>
        <!-- contents -->
        <div id="contents">
        <?php
          // 탭메뉴
          $Project->tabMenu();
          // 페이지 컨틀롤러
          include $engine_path.'controller/page.controller.php';
        ?>
        </div>
        <!-- //contents -->
      </div>
      <!-- //content_body -->
      <div class="clear"></div>
    </div>
    <!-- //contents-box -->
  </div>
  <!--// container -->

  <!-- footer -->
  <div id="footer">
    <!-- 하단배경 -->
    <div id="foot_center"><p id="copyright"><img src="<?echo($projectUrl);?>design/com/p_footer.gif" alt="<?echo($site['address']);?> | Tel : <?echo($site['telephone']);?> | Fax : <?echo($site['fax']);?> Copyright (c) <?echo(date("Y"));?> <?echo($site['name_eng']);?> Co.,Ltd. All Right Reserved" /></p></div>
    <div id="foot_left">&nbsp;</div>
    <div id="foot_right">&nbsp;</div>
    <!-- //하단배경 -->
  </div>
  <!-- //footer -->
</div>
<!-- //wrap -->
<?php
  // 새로온 수신레이어
  include $projectDir.'include/new.document.layer.php';
?>
</body>
</html>
