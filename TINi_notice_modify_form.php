<?php
	$id  = $_GET["id"];
	$page = $_GET["page"];
   
    include "config/db.php";

	$sql = "SELECT n.id, n.title, n.content, u.user_nickname AS nickname, n.reg_date, n.hit, n.user_id
			FROM tbl_notice n 
			JOIN tbl_user u ON n.user_id = u.id 
			WHERE n.id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id); // SQL 인젝션 방지
	$stmt->execute();
	$result = $stmt->get_result();

	if ($row = $result->fetch_array()) {
		$name       = $row["nickname"];
		$title      = $row["title"];
		$content    = $row["content"];
		$user_id    = $row["user_id"];
	} else {
		echo "데이터를 찾을 수 없습니다.";
		exit;
	}


    // 세션 시작
    session_start();

    // 세션에 저장된 user_id
    $session_user_id = $_SESSION['id'];

    if($user_id != $session_user_id ){
        echo "<script>
        alert('자신의 글만 수정할 수 있어요!');
        history.back();
        </script>";
    }

    
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>엄빠를 도와핑!</title>
<link rel="stylesheet" type="text/css" href="./css/header_style.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
  // 썸머노트 초기화
  $(document).ready(function() {
      $('#summernote').summernote({
          height: 300,  // 높이 설정
          placeholder: '내용을 입력하세요...',
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });

      // 기존 콘텐츠가 있으면 썸머노트에 세팅
      let content = `<?= $content ?>`;
      $('#summernote').summernote('code', content); // 썸머노트에 기존 내용 삽입
  });

  function check_input() {
      if (!document.board_form.title.value) {
          alert("제목을 입력하세요!");
          document.board_form.title.focus();
          return;
      }
      if (!$('#summernote').summernote('isEmpty')) {
          document.board_form.content.value = $('#summernote').summernote('code'); // 썸머노트 내용 저장
          document.board_form.submit();
      } else {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
   }
</script>

</head>
<body> 
<header>
    <?php include "TINi_header.php";?>
</header>  
<section>
   	<div id="board_box">
	    <h3 id="board_title">
	    		공지사항 > 글 수정
		</h3>

	    <form  name="board_form" method="POST" action="notice_modify.php?id=<?=$id?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="title" type="text" value="<?=$title?>"></span> <!-- 제목 수정 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<!-- 썸머노트 에디터를 사용 -->
	    				<textarea id="summernote" name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><a href="#" class="letter_button" onclick="check_input()">저장하기</a></li>
				<li><a href="TINi_notice.php?page=<?=$page?>" class="letter_button">목록으로</a></li> <!-- 수정된 부분 -->
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php";?>
</footer>
<script src="./js/modal.js"></script>
</body>
</html>