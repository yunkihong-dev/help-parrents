### 엄빠를 도와핑 (TINi Project)

“엄빠를 도와핑” 프로젝트는 티니핑을 관리하고 정보 공유를 위한 웹 애플리케이션입니다. 이 프로젝트에서는 티니핑 캐릭터 정보를 데이터베이스에서 조회하고, 각 티니핑의 정보(성격, 특징, 마법 등)를 입력 및 수정할 수 있으며, 사용자는 티니핑에 대한 정보를 보고 검색할 수 있습니다.

주요 기능

	•	티니핑 목록 조회: 모든 티니핑 정보를 이미지와 함께 나열.
	•	상세 정보 보기: 티니핑 이미지를 클릭하여 상세 정보를 토글로 표시.
	•	글 작성 및 수정: 관리자 권한으로 새로운 글을 작성하거나 기존 글을 수정.
	•	장소 검색: 카카오맵을 사용하여 장소를 검색하고 지도에 표시.
	•	파일 업로드: 게시글 내용에 이미지를 첨부할 수 있는 기능.

기술 스택

	•	Frontend: HTML, CSS, JavaScript, jQuery, Summernote (WYSIWYG editor)
	•	Backend: PHP (with MySQL)
	•	Database: MySQL
	•	API: Kakao Maps API (for location search and map display)

설치 방법

1. GitHub에서 코드 클론
	git clone https://github.com/yunkihong-dev/tini-project.git
	cd tini-project

2. 데이터베이스 설정
	db 내 테이블들 생성

3. 환경 설정
	•	config/db.php 파일에서 데이터베이스 연결 정보를 설정합니다.

4. 파일 업로드 경로 설정

파일 업로드를 위한 file_upload.php 파일을 구현하여, 이미지나 기타 파일을 서버에 저장할 수 있도록 합니다. 해당 경로는 images/ 폴더로 설정할 수 있습니다.

사용법

1. 관리자 로그인

	•	관리자는 login.php 페이지에서 로그인하여 관리자 권한을 획득한 후, 티니핑 정보를 관리할 수 있습니다.

2. 티니핑 정보 보기

	•	티니핑 목록에서 각 티니핑의 이미지를 클릭하여, 해당 티니핑의 상세 정보를 볼 수 있습니다.
	•	각 티니핑의 성격, 마법, 아이템 등 다양한 정보를 확인할 수 있습니다.

3. 게시글 작성

	•	관리자 권한으로 새로운 게시글을 작성하고, 글 내용에 이미지를 포함시킬 수 있습니다.
	•	Summernote를 사용하여 WYSIWYG 방식으로 글을 작성하고, 글에 파일을 첨부할 수 있습니다.

4. 카카오맵 기능

	•	글 작성 페이지에서 장소명을 입력하고, “검색” 버튼을 클릭하여 해당 장소를 카카오맵에 표시할 수 있습니다.

폴더 구조
<pre>
<code>
	/tini-project
	├── /css                # CSS 파일 (스타일)
	├── /images             # 이미지 파일
	├── /js                 # JavaScript 파일
	├── /config             # DB 설정 파일
	├── /public             # 공개 폴더 (웹에서 접근 가능한 파일들)
	├── /templates          # HTML 템플릿 파일
	├── /uploads            # 업로드된 파일 저장 폴더
	└── /index.php          # 메인 페이지
</code>
</pre>
