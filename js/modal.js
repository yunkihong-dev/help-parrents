// 모달 열기 함수
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add("show");
}

// 모달 닫기 함수
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove("show");
}

// 비밀번호 확인 함수
function checkPasswordMatch() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const passwordChkElement = document.getElementById("password-chk");

    if (confirmPassword === "") {
        passwordChkElement.textContent = "";
    } else if (password === confirmPassword) {
        passwordChkElement.textContent = "비밀번호가 일치합니다.";
        passwordChkElement.style.color = "green";
    } else {
        passwordChkElement.textContent = "비밀번호가 다릅니다.";
        passwordChkElement.style.color = "red";
    }
}

// 중복 확인 요청 함수
function checkDuplicate(type, value, statusElementId) {
    if (value === "") {
        updateStatus(statusElementId, `${type === "email" ? "이메일" : "닉네임"}을 입력하세요.`, "error");
        return;
    }

    window.open(`user/check_user.php?type=${type}&value=${value}`,
        "popupWindow", 
        "left=700, top=300, width=350, height=200, scrollbars=no, resizable=yes");
}

// 상태 업데이트 함수
function updateStatus(elementId, message, status) {
    const element = document.getElementById(elementId);
    element.textContent = message;
    element.style.color = status === "success" ? "green" : "red";
}

// 드롭다운 토글 함수
function toggleDropdown() {
    const dropdown = document.getElementById("user-dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// 페이지의 다른 부분을 클릭했을 때 드롭다운 닫기
window.addEventListener("click", (event) => {
    const dropdown = document.getElementById("user-dropdown");
    const userIcon = document.getElementById("user-icon");

    if (!dropdown.contains(event.target) && event.target !== userIcon) {
        dropdown.style.display = "none";
    }
});