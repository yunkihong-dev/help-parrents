<?php

if (isset($_FILES['file']['name'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    
    // 업로드할 디렉토리 설정 (상대 경로 사용)
    $upload_dir = __DIR__ . '/files/'; // 현재 스크립트 기준으로 상대 경로
    
    // 디렉토리가 없으면 생성
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // 777 권한으로 디렉토리 생성
    }

    // 고유한 파일명 생성
    $unique_filename = uniqid() . '_' . basename($file_name);
    $target_file = $upload_dir . $unique_filename;

    // 파일 업로드
    if (move_uploaded_file($file_tmp_name, $target_file)) {
        // 성공적으로 업로드되면 파일 경로를 상대 경로로 반환
        echo '/helpparrants/files/' . $unique_filename; // 업로드된 파일 경로 출력 (상대 경로)
    } else {
        $error_message = "파일 업로드 실패: " . $file_name;
        error_log($error_message); // 에러 메시지 로그에 기록
        echo $error_message;
    }
} else {
    $error_message = "파일이 전송되지 않았습니다.";
    echo $error_message;
}
?>