document.addEventListener("DOMContentLoaded", function() {
    // Зареждане на хедъра
    const headerHTML = `
    <div class="top-bar">
        <div class="contact-info">
            <span>📞 +359 888 399 621</span>
            <span>📧 stefony@gmail.com</span>
        </div>
        <div class="social-links">
            <a href="index.html" id="home-btn">Начало</a>
        </div>
    </div>

    <div class="logo-section">
        <div class="logo-container">
            <a href="index.html">
                <img src="https://img.freepik.com/free-photo/man-suit-sits-desk-with-magazine-his-hand_1340-37815.jpg" alt="Peltoma Capital Partners Logo" class="logo">
                <span class="logo-text">Capital Partners</span>
            </a>
        </div>

        <nav>
            <ul class="menu">
                <li class="dropdown">
                    <a href="#" class="dropbtn">Относно</a>
                    <div class="dropdown-content">
                        <a href="01_about-us.html">За Нас</a>
                        <a href="02_make_an_appointment.html">Запазете час за среща</a>
                        <a href="03_purchase or credit.html">Покупка или кредит</a>
                        <a href="04_blog.html">Блог Български публични компании</a>
                        <a href="05_do_you_know_that.html">Знаете ли че..</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Предоставяне на Услуги</a>
                    <div class="dropdown-content">
                        <a href="06_Provided services.html">Видове услуги</a>
                        <a href="07_estate.html">Обезпечение</a>
                        <a href="08_insurance.html">Застраховки</a>
                        <a href="09_business_plan.html">Бизнес план</a>
                        <a href="10_Loan Restructuring.html">Преструктуриране на кредити</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Tools</a>
                    <div class="dropdown-content">
                        <a href="11_glossary.html">Речник</a>
                        <a href="12_tax-resources.html">Данъци</a>
                    </div>
                </li>
                <li><a href="13_connect-with-us.html">Свържете се с нас</a></li>
            </ul>
        </nav>
    </div>
    `;

    document.getElementById('header-placeholder').innerHTML = headerHTML;

    // Логиката за burger менюто е премахната
});
