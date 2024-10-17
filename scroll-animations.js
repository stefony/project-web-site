// Анимация при скролиране
document.addEventListener("DOMContentLoaded", function() {
    let factBoxes = document.querySelectorAll('.fact-box');
    
    // Функция за проверка дали елементът е видим в прозореца
    function isElementInViewport(el) {
        let rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Функция за добавяне на анимация
    function checkIfInView() {
        factBoxes.forEach(factBox => {
            if (isElementInViewport(factBox)) {
                factBox.classList.add('animate');
            }
        });
    }

    // Слушане на събития за скролиране
    window.addEventListener('scroll', checkIfInView);

    // Първоначална проверка, за да се види дали някой елемент е видим от самото начало
    checkIfInView();
});
