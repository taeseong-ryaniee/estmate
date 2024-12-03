<?
  $bid = 'idea';
  // 게시판정보
  $board = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['board']." where bid='".$bid."'"));
  // 의견제안 쿼리
  $idea_result = $DBConn->DB_query("select * from ".$table['board']."_".$bid." where 1 order by headnum limit 4");
?>
<ul>
  <?
    for($n=1; $n<3; $n++){
      $idea = $DBConn->DB_fetch_assoc($idea_result);

      if($idea['no']){
        $idea['title'] = cut_str($idea['title'], 18);
        $idea['regdate'] = substr($idea['regdate'], 0, 10);
        // 뉴아이콘
        $new_icon = new_icon($idea['regdate'], $board['new_icon']);
        // 뷰링크
        $idea_view_link = './sub.php?olym=29&amp;mode=view&amp;no='.$idea['no'];
      }
  ?>
  <li>
    <?if($idea['no']){?>
    <div class="title"><a href="<?echo($idea_view_link);?>"><?echo($idea['title']);?><?if($new_icon == 'show'){?> <img src="<?echo($projectUrl);?>design/main/icon_new.gif" width="21" height="7" alt="new" /><?}?></a></div>
    <div class="date"><?echo($idea['regdate']);?></div>
    <?}else{?>
    &nbsp;
    <?}?>
  </li>
  <?}?>
</ul>
<p class="more"><a href="./sub.php?olym=29"><img src="<?echo($projectUrl);?>design/main/icon_more.gif" width="31" height="5" alt="의견제안 더보기" /></a></p>