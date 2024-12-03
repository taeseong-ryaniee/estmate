<?
  $bid = 'lounge';
  // 게시판정보
  $board = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['board']." where bid='".$bid."'"));
  // 사내쉼터 쿼리
  $lounge_result = $DBConn->DB_query("select * from ".$table['board']."_".$bid." where 1 order by headnum limit 2");
?>
<ul>
  <?
    for($n=1; $n<3; $n++){
      $lounge = $DBConn->DB_fetch_assoc($lounge_result);

      if($lounge['no']){
        $lounge['title'] = cut_str($lounge['title'], 18);
        $lounge['regdate'] = substr($lounge['regdate'], 0, 10);
        // 카테고리
        $cate_lounge = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['category']." where bid='".$bid."' and no=".$lounge['category']." limit 1"));
        if($cate_lounge['no']){
          $lounge['title'] = '<span class="cate1">['.$cate_lounge['name'].']</span> '.$lounge['title'];
        }
        // 뉴아이콘
        $new_icon = new_icon($lounge['regdate'], $board['new_icon']);
        // 뷰링크
        $lounge_view_link = './sub.php?olym=31&amp;mode=view&amp;no='.$lounge['no'];
      }
  ?>
  <li>
    <?if($lounge['no']){?>
    <div class="title"><a href="<?echo($lounge_view_link);?>"><?echo($lounge['title']);?><?if($new_icon == 'show'){?> <img src="<?echo($projectUrl);?>design/main/icon_new.gif" width="21" height="7" alt="new" /><?}?></a></div>
    <div class="date"><?echo($lounge['regdate']);?></div>
    <?}else{?>
    &nbsp;
    <?}?>
  </li>
  <?}?>
</ul>
<p class="more"><a href="./sub.php?olym=31"><img src="<?echo($projectUrl);?>design/main/icon_more.gif" width="31" height="5" alt="사내쉼터 더보기" /></a></p>