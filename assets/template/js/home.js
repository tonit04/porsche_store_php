
document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.querySelector('.car-slider-container');
    if (!sliderContainer) return; // Thoát nếu không tìm thấy container

    const sliderTrack = sliderContainer.querySelector('.car-slider-track');
    const carItems = sliderTrack.querySelectorAll('.car-item');
    const prevBtn = sliderContainer.querySelector('.car-slider-btn.prev');
    const nextBtn = sliderContainer.querySelector('.car-slider-btn.next');

    const totalItems = carItems.length;
    const itemsPerSlide = 3; // Số lượng xe hiển thị mỗi lần
    const totalSlides = Math.ceil(totalItems / itemsPerSlide);
    let currentSlide = 0;

    function updateSliderPosition() {
        // Tính toán lượng dịch chuyển dựa trên slide hiện tại
        // Dịch chuyển sang trái, nên giá trị là âm
        const offset = -currentSlide * 100; // Dịch chuyển 100% container cho mỗi slide
        sliderTrack.style.transform = `translateX(${offset}%)`;
    }

    function updateButtonStates() {
        // Vô hiệu hóa nút Prev ở slide đầu tiên
        prevBtn.disabled = currentSlide === 0;
        prevBtn.style.opacity = currentSlide === 0 ? '0.5' : '1';
        prevBtn.style.cursor = currentSlide === 0 ? 'default' : 'pointer';

        // Vô hiệu hóa nút Next ở slide cuối cùng
        nextBtn.disabled = currentSlide >= totalSlides - 1;
        nextBtn.style.opacity = currentSlide >= totalSlides - 1 ? '0.5' : '1';
        nextBtn.style.cursor = currentSlide >= totalSlides - 1 ? 'default' : 'pointer';
    }

    // Xử lý sự kiện nút Next
    nextBtn.addEventListener('click', () => {
        if (currentSlide < totalSlides - 1) {
            currentSlide++;
            updateSliderPosition();
            updateButtonStates();
        }
    });

    // Xử lý sự kiện nút Prev
    prevBtn.addEventListener('click', () => {
        if (currentSlide > 0) {
            currentSlide--;
            updateSliderPosition();
            updateButtonStates();
        }
    });

    // Cập nhật trạng thái nút ban đầu
    updateButtonStates();
});
