<?
  $bid = 'notice';
  // 게시판정보
  $board = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['board']." where bid='".$bid."'"));
  // 공지사항 쿼리
  $notice_result = $DBConn->DB_query("select * from ".$table['board']."_".$bid." where category='0' or category='$_memberGroupID' order by headnum limit 17");
?>
<p class="more"><a href="./sub.php?olym=27"><img src="<?echo($projectUrl);?>design/main/icon_more.gif" width="31" height="5" alt="공지사항 더보기" /></a></p>
<ul>
  <?

    for($n=1; $n<=17; $n++){
      $notice = $DBConn->DB_fetch_assoc($notice_result);
      if($notice['no']){
        $notice['title'] = cut_str($notice['title'], 21);
        $notice['regdate'] = substr($notice['regdate'], 0, 10);
        // 카테고리
        if($notice['category'] > 0){
          // 게시판정보
          $cate_row = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['category']." where no='".$notice['category']."'"));
          $notice['title'] = '<span class="cate1">['.$cate_row['name'].']</span> '.$notice['title'];
        }
        // 뉴아이콘
        $new_icon = new_icon($notice['regdate'], $board['new_icon']);
        // 뷰링크
        $notice_view_link = './sub.php?olym=27&amp;mode=view&amp;no='.$notice['no'];
      }
  ?>
  <li>
    <?if($notice['no']){?>
    <div class="title"><a href="<?echo($notice_view_link);?>"><?echo($notice['title']);?><?if($new_icon == 'show'){?> <img src="<?echo($projectUrl);?>design/main/icon_new.gif" width="21" height="7" alt="new" /><?}?></a></div>
    <div class="date" style="width:60px;"><?echo($notice['regdate']);?></div>
    <?}else{?>
    &nbsp;
    <?}?>
  </li>
  <?}?>
</ul>

