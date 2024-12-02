<?php
    include 'config/db.php';  // DB 연결
    session_start();

    $userid = $_SESSION['userid'];  // 세션에서 사용자 아이디

    $id = $_GET["id"]; // URL 파라미터에서 가져온 id
    $page = $_GET["page"];

    // tini_goods_info 테이블에서 데이터 조회
    $sql = "SELECT g.id, g.title, g.content, g.place_name, u.user_nickname AS nickname, g.reg_date, g.hit, u.id AS user_id
            FROM tini_goods_info g
            JOIN tbl_user u ON g.user_id = u.id 
            WHERE g.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_array();
    $title = $row["title"];
    $nickname = $row["nickname"];
    $reg_date = $row["reg_date"];
    $content = $row["content"];
    $hit = $row["hit"];
    $place_name = $row["place_name"];
    $board_userid = $row["user_id"];

    // HTML 콘텐츠 그대로 출력하려면, htmlspecialchars을 사용하지 말고 그대로 출력
    $content = $content;

    // 조회수 증가
    $new_hit = $hit + 1;
    $sql = "UPDATE tini_goods_info SET hit = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_hit, $id);
    $stmt->execute();
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

   function go_List(){
    window.location.href="TINi_goods.php";
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
	    		굿즈 판매 정보 > 글 수정
		</h3>

	    <form  name="board_form" method="POST" action="goods_modify.php?id=<?=$id?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?= $_SESSION['name'] ?></span> <!-- 세션에서 이름 가져오기 -->
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
                <li>
                    <span class="col1">장소 : </span>
                    <span class="col2"><input name="place_name" type="text" value="<?=$place_name?>"></span> <!-- 장소 수정 -->
                </li>
	    	    </ul>
	    	<ul class="buttons">
				 <!-- "저장" 버튼 클릭 시 check_input 함수 실행 -->
                 <li><button class="letter-button" type="button" onclick="check_input(event)">저장</button></li>
                <!-- "목록" 버튼 클릭 시 goToList 함수 실행 -->
                <li><button class="letter-button" type="button" onclick="go_List()">목록</button></li>
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