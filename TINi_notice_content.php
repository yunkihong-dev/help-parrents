   	<div id="board_box">
	    <h3>
	    	공지사항
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

    include "config/db.php";

    $sql = "select n.id id, n.title title, n.content content,u.user_nickname nickname, n.reg_date reg_date, hit from tbl_notice n join tbl_user u on n.user_id = u.id order by n.id desc";
	$result = mysqli_query($conn, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $id         = $row["id"];
	  $title     = $row["title"];
	  $name        = $row["nickname"];
      $reg_date  = $row["reg_date"];
      $hit         = $row["hit"];
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="TINi_notice_view.php?id=<?=$id?>&page=<?=$page?>"><?=$title?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col5"><?=$reg_date?></span>
					<span class="col6"><?=$hit?></span>
				</li>
<?php
   	   $number--;
   }
   mysqli_close($conn);

?>	
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='TINi_notice.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='TINi_notice.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='TINi_notice.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li>
<?php 
    session_start(); // 세션 시작
    $user_roll = $_SESSION["roll"];
    if( $user_roll == 'ADMIN') {
?>
				<a href="TINi_notice_write.php" class="letter-button">작성하기</a>
<?php
	} elseif($userid) {
		
	} elseif (!$userid) {

	}
?>
				</li>
			</ul>
	</div>