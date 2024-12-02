<?php
include 'config/db.php';
session_start();

// 로그인 확인
if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
    echo "<script>alert('로그인이 필요합니다!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['id'];
$username = $_SESSION['name'];

?>

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>엄빠를 도와핑!</title>
<link rel="stylesheet" type="text/css" href="./css/header_style.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<!-- Summernote CSS/JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
        height: 300,  // 높이 설정
        placeholder: '여기에 내용을 입력하세요...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
  });

  function check_input(event) {
      event.preventDefault();  // 폼 제출을 일단 막고, 유효성 검사 후 수동 제출

      if (!document.board_form.title.value) {
          alert("제목을 입력하세요!");
          document.board_form.title.focus();
          return;
      }

      // Summernote 내용이 비어있는지 체크
      if (!$('#summernote').summernote('isEmpty')) {
          document.board_form.submit();  // 유효성 통과 시 폼 제출
      } else {
          alert("내용을 입력하세요!");
          return;
      }
  }

  // 목록 페이지로 이동
  function goToList() {
      window.location.href = "TINi_goods.php";  // 목록 페이지로 이동
  }
   // 티니핑 버튼 클릭 시 선택된 티니핑 ID를 hidden 필드에 저장
   $(document).on('click', '.tini_button', function() {
    var tini_id = $(this).data('id');  // 버튼의 data-id 속성에서 티니핑 ID를 가져옴
    $('#tini_id').val(tini_id);  // hidden 필드에 ID 저장
    // 버튼 스타일 변경 (선택된 버튼을 강조할 수 있음)
    $('.tini_button').removeClass('selected');
    $(this).addClass('selected');
  });
</script>

</head>
<body> 
<header>
    <?php include "TINi_header.php"; ?>
</header>  
<section>
    <div id="board_box">
        <h3 id="board_title">
            굿즈 판매 정보 > 글 쓰기
        </h3>
        <form name="board_form" method="post" action="goods_insert.php" enctype="multipart/form-data">
            <ul id="board_form"> 
                <li>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?= $username ?></span>
                </li>        
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input name="title" type="text"></span>
                </li>            
                <li id="text_area">    
                    <span class="col1">내용 : </span>
                    <span class="col2">
                        <textarea id="summernote" name="content"></textarea>
                    </span>
                </li>
                <li>    
                    <span class="col1">장소 : </span>
                    <span class="col2">
                        <input name="place_name" type="text">
                    </span>
                </li>
                <li>    
                    <span class="col1">티니핑 : </span>
                    <span class="col2">
                        <?php
                        // tbl_tiniping에서 데이터를 가져와서 버튼 생성
                        $sql = "SELECT id, tini_name FROM tbl_tiniping";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // 각 티니핑에 대해 버튼을 생성
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<button type='button' class='tini_button' data-id='{$row['id']}'>{$row['tini_name']}</button> ";
                            }
                        } else {
                            echo "등록된 티니핑이 없습니다.";
                        }
                        ?>
                    </span>
                </li>
                <input type="hidden" name="tini_id" id="tini_id"> <!-- 선택된 티니핑의 id를 이 hidden 필드에 저장 -->
            </ul>
            <ul class="buttons">
                <li><button class="letter-button" type="button" onclick="check_input(event)">저장</button></li>
                <li><button class="letter-button" type="button" onclick="goToList()">목록</button></li>
            </ul>
        </form>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php"; ?>
</footer>
<script src="./js/modal.js"></script>
</body>
</html>