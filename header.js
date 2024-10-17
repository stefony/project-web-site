document.addEventListener("DOMContentLoaded", function() {
    // Зареждане на хедъра
    const headerHTML = `
    <div class="top-bar">
        <div class="contact-info">
            <span>📞 +359 888 399 621</span>
            <span>📧 stefony@gmail.com</span>
        </div>
        <div class="social-links">
            <a href="first.html" id="home-btn">Начало</a>
            <!-- Закоментиран е бутонът за вход, тъй като вече не се използва -->
            <!-- <a href="#" id="client-login-btn">Вход</a> -->
        </div>
    </div>
    <div class="logo-section">
        <div class="logo-container">
            <a href="first.html">
                <img src="https://img.freepik.com/free-photo/man-suit-sits-desk-with-magazine-his-hand_1340-37815.jpg?t=st=1724714580~exp=1724718180~hmac=05220bf40bfca89bbf5dfcee00e01f4c0702fac946d638ede9a7793f9fff16e8&w=360" alt="Peltoma Capital Partners Logo" class="logo">
                <span class="logo-text">Capital Partners</span>
            </a>
        </div>
    </div>
    `;

    // Вмъкване на хедъра в страницата
    document.getElementById('header-placeholder').innerHTML = headerHTML;

    // Премахнати са всички функции, свързани с модала за вход и бутона за вход
    /*
    const loginBtn = document.getElementById('client-login-btn');
    const loginModal = document.getElementById('login-modal');
    const closeModalBtn = document.querySelector('.close-btn');

    if (loginBtn && loginModal && closeModalBtn) {
        // Добавяне на функционалност за модалния прозорец "Вход"
        loginBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Спиране на стандартното поведение на линка
            loginModal.style.display = 'flex'; // Показване на модала
        });

        // Затваряне на модала при клик върху бутона за затваряне (X)
        closeModalBtn.addEventListener('click', function() {
            loginModal.style.display = 'none'; // Скриване на модала
        });

        // Затваряне на модала при клик извън него
        window.addEventListener('click', function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = 'none'; // Скриване на модала
            }
        });
    }

    // Показване на таба за вход по подразбиране, ако съществува елементът
    const loginTab = document.getElementById('Login');
    if (loginTab) {
        loginTab.style.display = 'block';
    }
    */
});
