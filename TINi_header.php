<header>
    <?php   
        session_start();
        if (isset($_SESSION["id"])) $userid = $_SESSION["id"];
        if (isset($_SESSION["name"])) $name = $_SESSION["name"];
        else $userid = "";
    ?>     
    <div id="top_menu">
        <a href="TINi_index.php">
            <img id="logo" src="img/logo.png" alt="logo">
        </a>
        <ul id="menu_bar">
            <li><a href="TINi_info.php">티니핑 소개</a></li>
            <li><a href="TINi_notice.php">공지사항</a></li>
            <li><a href="TINi_goods.php">굿즈 판매 정보</a></li>
            <li><a href="TINi_community.php">커뮤니티</a></li>
            <li><a href="TINi_ask.php">문의사항</a></li>
        </ul>

        <?php if(!$userid) { ?>     
        <div id="user_section">
            <button onclick="openModal('loginModal')">로그인</button>
            |	 
            <button onclick="openModal('signupModal')">회원가입</button>
        </div>
        <?php } else { ?>
            <div id="user-container">
                <img id="user-icon" src="img/user.png" alt="user" onclick="toggleDropdown()" />
                <div id="user-dropdown">
                    <p><?= "$name"; ?> 님 반갑습니다!</p>
                    <a href="">내정보 수정</a>
                    <a href="user/logout.php">로그아웃</a>
                </div>
            </div>
        <?php } ?>
    </div>


    <!-- 로그인 모달 -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <h2>로그인</h2>
            <form method="post" id="loginForm" action="user/login.php">
                <input type="text" name="email" placeholder="이메일" required><br>
                <input type="password" name="password" placeholder="비밀번호" required><br>
                <button type="submit" class="submit-btn">로그인</button>
            </form>
        </div>
    </div>

    <!-- 회원가입 모달 -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('signupModal')">&times;</span>
            <h2>회원가입</h2>
            <form method="post" id="signupForm" action="user/user_register.php">
                <div class="input-div">
                    <input type="email" id="email" name="email" placeholder="이메일" required>
                    <button type="button" class="chk_btn" onclick="checkDuplicate('email', document.getElementById('email').value, 'emailCheckStatus')">중복 확인</button>
                </div>
                <p id="emailCheckStatus"></p>
                <div class="input-div">
                    <input type="text" id="nickname" name="nickname" placeholder="닉네임" required>
                    <button type="button" class="chk_btn" onclick="checkDuplicate('nickname', document.getElementById('nickname').value, 'nicknameCheckStatus')">중복 확인</button>
                </div>
                <p id="nicknameCheckStatus"></p>
                <input type="password" id="password" name="password" placeholder="비밀번호" required><br>
                <input type="password" id="confirmPassword" placeholder="비밀번호 확인" required oninput="checkPasswordMatch()"><br>
                <p id="password-chk"></p>
                <button type="submit" class="submit-btn">회원가입</button>
            </form>
        </div>
    </div>
</header>