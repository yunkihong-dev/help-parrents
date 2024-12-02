<?php
// 데이터베이스 연결 설정
$host = 'localhost'; // 데이터베이스 호스트
$user = 'root';      // 사용자 이름
$password = '';      // 비밀번호 (XAMPP의 기본값은 비어 있음)
$database = 'tiniping'; // 데이터베이스 이름

// 데이터베이스 연결 생성
$conn = new mysqli($host, $user, $password, $database);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>