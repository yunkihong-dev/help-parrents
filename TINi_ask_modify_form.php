<?php
    $id  = $_GET["id"];
    $page = $_GET["page"];
   
    include "config/db.php";  // DB 연결

    // 게시글 정보 가져오기: 제목, 내용, 작성자, 작성일, 조회수 등
    $sql = "SELECT o.id, o.title, o.content, u.user_nickname AS nickname, o.reg_date, o.hit, o.user_id
            FROM tbl_opinion o 
            JOIN tbl_user u ON o.user_id = u.id 
            WHERE o.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id); // SQL 인젝션 방지
    $stmt->execute();
    $result = $stmt->get_result();

    // 게시글을 가져온 후 정보 추출
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

    // 게시글 수정 권한 확인: 작성자와 세션의 user_id가 동일해야 수정 가능
    if ($user_id != $session_user_id) {
        echo "<script>
        alert('자신의 글만 수정할 수 있어요!');
        history.back();
        </script>";
        exit;
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
      var content = `<?= $content ?>`;  // PHP에서 가져온 내용을 그대로 삽입
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

   function go_List(){
    window.location.href="TINi_community.php";  // 목록으로 돌아가는 함수
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
	    		문의사항 > 글 수정
		</h3>

	    <form  name="board_form" method="POST" action="ask_modify.php?id=<?=$id?>&page=<?=$page?>" enctype="multipart/form-data">
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
				<li><button class="letter-button" type="button" onclick="check_input()">저장</button></li>
				<li><button class="letter-button" type="button" onclick="go_List()">목록</button></li> <!-- 수정된 부분 -->
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