
<!-- Page made by fb24m -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvestLegal</title>
    <link rel="stylesheet" href="css/modules.css">
    <!-- Подключение главного CSS-файла -->
    <link rel="stylesheet" href="css/style.min.css">

    <link rel="stylesheet" type="text/css" href="js/bootstrap_4.5.2/bootstrap.min.css">

    <!-- JS dependencies -->
    <script src="js/jquery_1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 4 dependency -->
    <script src="js/popper_2.4.4/popper.min.js"></script>
    <script src="js/bootstrap_4.5.2/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="js/bootbox_5.4.0/bootbox.min.js"></script>
    <script src="js/bootbox_5.4.0/bootbox.locales.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <header class="header">
  <div class="header__container" id="menu">
    <div class="header__logo">
      <img src="img/_header/logo.webp" alt="Не удалось загрузить изображение" class="header__icon">
      <span class="header__label">invest.legal</span>
    </div>
    <div class="header__menu menu">
      <nav class="menu__body">
        <ul class="menu__list">
          <li class="menu__item menu__item_selected">
            <a href="#menu" class="menu__link text text_style_normal">Главная</a>
          </li>
          <li class="menu__item"><a href="#process" class="menu__link text text_style_normal">Процесс покупки</a></li>
          <li class="menu__item"><a href="#contacts" class="menu__link text text_style_normal">Контакты</a></li>
        </ul>
      </nav>
    </div>
    <div class="header__contacts">
      <div class="header__contact header__contact_mail">
        <svg class="header__contact-icon">
          <use href="img/icons/icons.svg#mail"></use>
        </svg>
        <a href="mailto:invest.legal@yandex.ru" class="header__link text text_style_normal">invest.legal@yandex.ru</a>
      </div>
      <div class="header__contact">
        <svg class="header__contact-icon header__contact_phone" data-popup-toggle="request-call">
          <use href="img/icons/icons.svg#phone"></use>
        </svg>
        <a href="tel:+74954790170" class="header__link text text_style_normal">+7 495 479-01-70</a>
      </div>
    </div>
    <div class="header__buttons">
      <button class="header__button button button_border_blue" data-popup-toggle="request-call">Заказать звонок</button>
      <div class="header__icon" id="menu-icon" data-open-block="menu"><span></span></div>
    </div>
  </div>
</header>
    <main class="main">
      <section class="welcome">
	<div class="welcome__container">
		<div class="welcome__block">
			<h1 class="welcome__title">Покупаем акции <span><?=$emitentFN?></span></h1>
			<ul class="welcome__list checked-list">
				<li class="welcome__item">Способ оплаты по договоренности с вами, в т.ч. наличными</li>
				<li class="welcome__item">Никаких скрытых комиссий и налогов с нашей стороны</li>
				<li class="welcome__item">Сопровождаем процесс оформления и подачи документов</li>
				<li class="welcome__item">Расходы на переоформление берем на себя</li>
			</ul>
		</div>
		<div class="welcome__block">
			<span class="welcome__subtitle text text_style_bold">Калькулятор</span>
			<div class="welcome__sub-block">
				<div class="welcome__market-price">
					<span class="welcome__price-title text text_style_bigger">Рыночная цена акции, ₽</span>
					<span class="welcome__price text text_style_bigger"><?=$priceLowStr?> - <?=$priceHighStr?></span>
				</div>
				<form action="" class="welcome__form" id="calculator">
					<!-- data-factor - множитель. Введенное в поле число будет умножено на него. -->
					<!-- Например: введено число 5. 5 * 500 = 2500 будет выведено. -->
					<!-- Можно изменять только на число (можно с дробью через точку) -->
                    <input type="hidden" id="price_min" name="price_min" value="<?=$priceLow?>">
                    <input type="hidden" id="price_max" name="price_min" value="<?=$priceHigh?>">
					<input type="text" class="input welcome__input" data-factor="<?=$priceLow?>" id="count" name="count"
						placeholder="Введите количество, шт">
					<div class="welcome__total welcome__total_hidden">
						<span class="welcome__total-title text text_style_bigger">Стоимость пакета</span>
						<div class="welcome__total-block">
							<span class="welcome__total-price text text_style_bold">? ₽</span>
							<span class="welcome__total-difference text text_style_normal">Разница 5%</span>
						</div>
					</div>
					<button class="welcome__button button button_color_white" type="submit">Пересчитать</button>
				</form>
				<button class="welcome__button button button_color_accent-dark" data-popup-toggle="submit-application">
					Отправить заявку
				</button>
			</div>
		</div>
	</div>
</section>

<section id="process" class="process">
	<div class="process__container">
		<h2 class="process__title">Процесс оформления покупки</h2>
		<div class="process__cards">
			
<div class="process__card process-card">
	<img src="img/home/icon-1.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
	<span class="process-card__title">Воспользуетесь нашим предварительным калькулятором</span>

	
</div>

			
<div class="process__card process-card">
	<img src="img/home/icon-2.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
	<span class="process-card__title">Связываетесь с нами удобным способом</span>

	
	<ul class="process-card__social-list">
		<li class="process-card__social-item"><svg class="process-card__icon">
				<use href="img/icons/icons.svg#old-phone"></use>
			</svg></li>
		<li class="process-card__social-item"><svg class="process-card__icon">
				<use href="img/icons/icons.svg#mail"></use>
			</svg></li>
        <li class="process-card__social-item">
            <a href="https://t.me/Ilya_Chesov" target="_blank">
                <img src="img/home/logos_telegram.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
            </a>
		</li>
		<li class="process-card__social-item">
            <a href="https://api.whatsapp.com/send/?phone=79653251823" target="_blank">
                <img src="img/home/whatsapp.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
            </a>
		</li>
	</ul>
	
</div>

			
<div class="process__card process-card">
	<img src="img/home/icon-3.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
	<span class="process-card__title">Проводим оценку акций, согласовываем условия</span>

	
</div>

			
<div class="process__card process-card">
	<img src="img/home/icon-4.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
	<span class="process-card__title">Назначаем встречу и заключаем договор, оформляем документы</span>

	
</div>

			
<div class="process__card process-card">
	<img src="img/home/icon-5.svg" alt="Не удалось загрузить изображение" class="process-card__icon">
	<span class="process-card__title">Проводим расчеты</span>

	
</div>

		</div>
	</div>
</section>

      <section id="contacts" class="contact">
	<div class="contact__container">
		<h2 class="contact__title">Остались вопросы?</h2>
		<span class="contact__label">Cвязаться с нами</span>
		<div class="contact__contacts">
			<div class="contact__contact">
                <a href="https://t.me/Ilya_Chesov" target="_blank">
                    <img src="img/home/logos_telegram.svg" alt="Не удалось загрузить изображение" class="contact__icon">
                </a>
                <a href="https://api.whatsapp.com/send/?phone=79653251823" target="_blank">
                    <img src="img/home/whatsapp.svg" alt="Не удалось загрузить изображение" class="contact__icon">
                </a>
                <span class="contact__info">
                    <a href="tel:+74954790170" class="header__link text text_style_normal">+7 495 479-01-70</a>
                </span>
			</div>
			<div class="contact__contact">
                <a href="mailto:invest.legal@yandex.ru" class="header__link text text_style_normal">
				<svg class="contact__icon">
					<use href="img/icons/icons.svg#mail"></use>
				</svg>
                </a>
				<span class="contact__info">invest.legal@yandex.ru</span>
			</div>
		</div>
	</div>
</section>
    </main>
    <footer class="footer">
    <div class="footer__container">
        <div class="footer__top    footer-top">
            <div class="footer__block">
                <a href="/?action=policy" target="_blank" class="footer-top__link">Соглашение о персональных данных</a>
            </div>
            <div class="footer__block">
                <a href="/?action=user_agreement" target="_blank" class="footer-top__link">Пользовательское соглашение</a>
            </div>
        </div>
        <div class="footer__bottom footer-bottom">
            <div class="footer__sub-block"></div>
            <div class="footer__sub-block">
                <div class="footer-bottom__text">2009-2023</div>
            </div>
            <div class="footer__sub-block">
                <div class="footer-bottom__text footer-bottom__text_gray">ИП Черкасов Илья Сергеевич</div>
                <div class="footer-bottom__text footer-bottom__text_gray">ИНН 772003421438</div>
            </div>
        </div>
    </div>
</footer>
    <div class="popup" data-popup="submit-application">
  <div class="popup__wrapper">
    <div class="popup__window">
      <div class="popup__content">
        <button class="popup__close" id="order-close" data-popup-toggle="submit-application"><svg xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M17.7142 17.7143L6.28564 6.28571M17.7142 6.28571L6.28564 17.7143" stroke="#5B5B5B"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg></button>
        <form action="" class="popup__form" id="application-form">
          <textarea name="#" id="#" placeholder="Сообщение" class="popup__message input message"></textarea>
          <input type="text" name="client_name" class="popup__input input name" placeholder="Ваше имя">
          <div class="popup__block">
            <input type="text" name="phone" class="popup__input input phone phone-mask" placeholder="Телефон">
          </div>
          <span>или</span>
          <div class="popup__block">
            <input type="email" name="email" class="popup__input input email" placeholder="Email">
            <button style="display:none;" class="popup__button popup__button_blue" id="request-code">Запросить код подтверждения</button>
          </div>
          <div style="display:none;" displayclass="popup__block">
            <input type="text" class="popup__input input code" placeholder="Введите код">
            <button class="popup__button" id="submit-code">Подтвердить</button>
          </div>
          <button class="popup__button button button_color_accent-dark" type="submit" disabled>Отправить заявку</button>
          <span class="popup__warning">Не заполненно обязательное поле Телефон ИЛИ Email</span>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="popup" data-popup="request-call">
  <div class="popup__wrapper">
    <div class="popup__window">
      <div class="popup__content">
        <button id="request-call-close" class="popup__close" data-popup-toggle="request-call"><svg xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none">
            <path d="M17.7142 17.7143L6.28564 6.28571M17.7142 6.28571L6.28564 17.7143" stroke="#5B5B5B"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg></button>
        <form action="" class="popup__form" id="request-call">
          <input type="text" class="popup__input input name" placeholder="Ваше имя" name="client_name">
          <input type="text" class="popup__input input phone phone-mask" placeholder="Телефон" name="phone">
          <button class="popup__button button button_color_accent-dark">Заказать звонок</button>
            <span class="popup__warning">Нажимая кнопку Отправить заявку, Вы соглашаетесь с условиями <a href="/?action=user_agreement" target="_blank">Пользовательского соглашения</a>, а также на <a href="/?action=policy" target="_blank">обработку персональных данных</a></span>
        </form>
      </div>
    </div>
  </div>
</div>
  </div>
  <!-- Подключение главного JavaScript-файла -->
<script src="js/app.js"></script>
</body>

</html>