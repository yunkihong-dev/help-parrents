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
        ],
        callbacks: {
            // 이미지 업로드 처리
            onImageUpload: function(files) {
                var data = new FormData();
                data.append("file", files[0]);

                $.ajax({
                    url: 'file_upload.php', // 이미지 업로드 PHP 파일
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#summernote').summernote('insertImage', response); // 업로드된 이미지 삽입
                    },
                    error: function() {
                        alert("이미지 업로드 실패");
                    }
                });
            }
        }
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
      window.location.href = "TINi_ask.php";  // 목록 페이지로 이동
  }
  
// 파일 업로드 처리
$(document).ready(function() {
    $('#board_form').submit(function(event) {
        event.preventDefault(); // 폼 제출 막기

        // 폼 데이터 준비
        var formData = new FormData(this);
        
        // 파일이 업로드된 경우에만 처리
        if ($('#file').val()) {
            $.ajax({
                url: 'file_upload.php', // 파일을 처리할 PHP 파일
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.includes('files/')) {
                        // 업로드된 파일 경로를 숨겨진 필드에 저장
                        $('input[name="file_path"]').val(response);
                        // 폼 제출
                        $('#board_form')[0].submit();
                    } else {
                        alert(response); // 업로드 실패 메시지
                    }
                },
                error: function() {
                    alert("파일 업로드 중 오류 발생");
                }
            });
        } else {
            // 파일이 없으면 그냥 폼 제출
            $('#board_form')[0].submit();
        }
    });
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
            문의사항 > 글 쓰기
        </h3>
        <form name="board_form" method="post" action="ask_insert.php" enctype="multipart/form-data">
            <ul id="board_form"> 
                <li>
                    <?php
                        $username = $_SESSION["name"];
                    ?>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?=$username?></span>
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
            </ul>
            <ul class="buttons">
                <!-- "저장" 버튼 클릭 시 check_input 함수 실행 -->
                <li><button class="letter-button" type="button" onclick="check_input(event)">저장</button></li>
                <!-- "목록" 버튼 클릭 시 goToList 함수 실행 -->
                <li><button class="letter-button" type="button" onclick="goToList()">목록</button></li>
            </ul>
        </form>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php"; ?>
</footer>
</body>
<script src="./js/modal.js"></script>
</html>
