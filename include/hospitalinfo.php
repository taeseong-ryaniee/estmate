<?
  $bid = 'hospitalinfo';
  // 게시판정보
  $board = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['board']." where bid='".$bid."'"));
  // 자료실 쿼리
  $data_result = $DBConn->DB_query("select * from ".$table['board']."_".$bid." where 1 order by headnum limit 8");
?>
<ul>
  <?
    for($n=1; $n<=8; $n++){
      $data = $DBConn->DB_fetch_assoc($data_result);
      if($data['no']){
        $data['title'] = cut_str($data['title'], 18);
        $data['regdate'] = substr($data['regdate'], 0, 10);
        // 카테고리
        $cate_data = $DBConn->DB_fetch_assoc($DBConn->DB_query("select * from ".$table['category']." where bid='".$bid."' and no=".$data['category']." limit 1"));
        if($cate_data['no']){
          $data['title'] = '<span class="cate1">['.$cate_data['name'].']</span> '.$data['title'];
        }
        // 뉴아이콘
        $new_icon = new_icon($data['regdate'], $board['new_icon']);
        // 뷰링크
        $data_view_link = './sub.php?olym=57&amp;mode=view&amp;no='.$data['no'];
      }
  ?>
  <li>
    <?if($data['no']){?>
    <div class="title"><a href="<?echo($data_view_link);?>"> <?echo($data['title']);?><?if($new_icon == 'show'){?> <img src="<?echo($projectUrl);?>design/main/icon_new.gif" width="21" height="7" alt="new" /><?}?></a></div>
    <div class="date" style="width:60px;"><?echo($data['regdate']);?></div>
    <?}else{?>
    &nbsp;
    <?}?>
  </li>
  <?}?>
</ul>
<p class="more"><a href="./sub.php?olym=57"><img src="<?echo($projectUrl);?>design/main/icon_more.gif" width="31" height="5" alt="오픈병원정보 더보기" /></a></p>