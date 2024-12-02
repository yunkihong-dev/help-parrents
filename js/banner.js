const banner = document.querySelector('.banner');
const images = document.querySelectorAll('.banner-image');
const imageCount = images.length;

let currentIndex = 0;

// 일정 시간마다 이미지 이동
function moveBanner() {
    currentIndex++;
    banner.style.transform = `translateX(-${598 * currentIndex}px)`; // 각 이미지 크기만큼 이동

    // 마지막 이미지에 도달하면 첫 번째 이미지로 돌아가기
    if (currentIndex === imageCount) {
        setTimeout(() => {
            banner.style.transition = 'none'; // 이동 애니메이션 제거
            banner.style.transform = 'translateX(0)'; // 첫 번째 이미지로 복귀
            currentIndex = 0;
        }, 500); // 애니메이션 시간만큼 대기
    } else {
        banner.style.transition = 'transform 1s ease-in-out'; // 부드러운 이동
    }
}

// 3초마다 이동
setInterval(moveBanner, 3000);
