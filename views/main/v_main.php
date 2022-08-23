<main class="main">
    <div class="article">
        <section class="section__main">
            <div class="section__header" style="margin-top: 0;">
                <h1 class="section__title section__title_after">
                    <?= $title ?>
                </h1>

                <div class="section__text">
                    <p>
                        Осуществляем срочный ремонт холодильников, стиральных машин c выездом на дом. Мастер
                        приедет в удобное для вас время и отремонтирует вашу технику на дому с гарантией до 1 года.
                        В большинстве случаев ремонт выполняется за один визит.
                        На наиболее распространенные поломки — запчасти с собой.
                    </p>
                </div>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="<?= BASE_URL ?>assets/img/about/1.jpg" alt="ремонт холодильника">
                        </div>
                        <div class="card__text">ремонт холодильников</div>
                    </div>
                    <a href="tel:+79196093485" class="phone__btn">
                        Вызвать мастера <span>8 919 609‒34‒85</span></a>
                </div>
                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img card__img--yellow">
                            <img src="<?= BASE_URL ?>assets/img/about/3.jpg" alt="ремонт стиральной машины">
                        </div>
                        <div class="card__text">ремонт стиральных машин</div>
                    </div>
                    <div>
                        <a href="tel:+79610510205" class="phone__btn">
                            Вызвать мастера <span>8 961 051-02-05</span></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services -->
        <section class="section__main" id="services">
            <div class="section__header">
                <h2 class="section__title section__title_after">Как узнать стоимость ремонта?</h2>
                <div class="section__text">
                    <p>
                        Бесплатная диагностика предназначена для выявление причины неисправности
                        и определения итоговой стоимости работ.
                    </p>
                </div>
            </div>

            <div class="services">
                <div class="services__item">
                    <img src="<?= BASE_URL ?>assets/img/services/clock.png" alt="часы работы">
                    <div class="services__title">Часы работы</div>
                    <div class="services__text">10.00 – 20.00. Без выходных.
                    </div>
                </div>
                <div class="services__item  services__item--border">
                    <img src="<?= BASE_URL ?>assets/img/services/home.png" alt="на дому">
                    <div class="services__title">РЕМОНТ НА ДОМУ</div>
                    <div class="services__text">Все необходимое оборудование с собой.</div>
                </div>
                <div class="services__item">
                    <img src="<?= BASE_URL ?>assets/img/services/guarantee.png" alt="гарантия">
                    <div class="services__title">ГАРАНТИЯ</div>
                    <div class="services__text">Сроком до 1 года — на работу и запчасти.
                    </div>
                </div>
                <div class="services__item  services__item--border">
                    <img src="<?= BASE_URL ?>assets/img/services/car.png" alt="диагностика">
                    <div class="services__title">Диагностика</div>
                    <div class="services__text">Вызов и диагностика
                        в случае ремонта <span>0 ₽</span>.</div>
                </div>
                <div class="services__item">
                    <img src="<?= BASE_URL ?>assets/img/services/coins.png" alt="монеты">
                    <div class="services__title">БЕЗ ПОСРЕДНИКОВ</div>
                    <div class="services__text">Услуги без посредников — выгода для заказчика.
                    </div>
                </div>
                <div class="services__item  services__item--border">
                    <img src="<?= BASE_URL ?>assets/img/services/repairing-service.png" alt="мастер">
                    <div class="services__title">Запчасти</div>
                    <div class="services__text">Проверенные запчасти и современное оборудование для
                        ремонта.</div>
                </div>
            </div>
        </section>
        <section class="section__main">
            <div class="section__header">
                <h2 class="section__title section__title_after">Самые распространенные неисправности</h2>
                <div class="section__text">
                    <p>
                        Если у вас нет опыта в ремонте бытовой техники, то не пытайтесь
                        самостоятельно её починить.
                        Это может привести к неисправной работе или к полной
                        неработоспособности. Что приведет еще к
                        более дорогостоящему ремонту или к покупке новой техники.
                    </p>
                </div>
            </div>
            <div class="wedo wedo--tr">
                <div class="wedo__item">
                    <img class="wedo__img show" src="<?= BASE_URL ?>assets/img/tools/glassCompr.jpg" data-src="assets/img/tools/glassCompr.jpg" alt="мотор компрессор">
                </div>
                <div class="wedo__item">
                    <div class="accordion">
                        <div class="accordion__item">
                            <div style="padding:15px 20px 15px 65px" class="accordion__header">
                              <img class="accordion__icon" src="<?= BASE_URL ?>assets/img/services/fridge.png" alt="холодильник">
                                <div class="accordion__title">Холодильник:
                                </div>
                            </div>
                            <div class="accordion__content">
                                <ul>
                                    <li>не включается,</li>
                                    <li>запускается, но сразу отключается,</li>
                                    <li>не морозит,</li>
                                    <li>перемораживает,</li>
                                    <li>проткнули ножом,</li>
                                    <li>сильно шумит,</li>
                                    <li>работает не выключаясь,</li>
                                    <li>покрывается льдом</li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <div style="padding:15px 20px 15px 65px" class="accordion__header">
                                <img class="accordion__icon" src="<?= BASE_URL ?>assets/img/services/washing-machine.png" alt="стиральная машина">
                                <div class="accordion__title">CМА:
                                </div>
                            </div>
                            <div class="accordion__content">
                                <ul>
                                    <li>не включaется,</li>
                                    <li>не сливает,</li>
                                    <li>не заливает,</li>
                                    <li>не греет воду,</li>
                                    <li>выбивaет автомат (пробки),</li>
                                    <li>не oтжимает,</li>
                                    <li>не врaщается барабан,</li>
                                    <li>выдает код ошибки,</li>
                                    <li>протекaет,</li>
                                    <li>cильнo шумит или вибрируeт,</li>
                                    <li>не oткрывается или пoдклинивает</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- /.accordion -->
                </div><!-- /.wedo__item -->
            </div><!-- /.wedo -->
        </section>
        <section class="section__main">
            <div class="section__header">
                <h2 class="section__title section__title_after">Оставьте заявку на выезд мастера</h2>
                <div class="section__text">
                    <div class="error-list"></div>
                </div>
            </div>
            <form class="form" method="post" action="send">

                <div class="form__group">
                    <label>Контактное лицо</label>
                    <input class="caption" name="name" type="text">
                </div>

                <div class="form__group">
                    <label>Номер телефона <span class="star">*</span></label>
                    <input class="caption" id="phone" name="phone" type="tel">
                </div>

                <div class=" form__group">
                    <label>Опишите неисправность..</label>
                    <textarea class="desc" name="info"></textarea>
                </div>

                <div class="form__group">
                    <input checked name="accept" type="checkbox" id="chckd">
                    <label for="chckd"> Нажимая «Отправить», вы принимаете условия<b><a id="go" class="confidential" href=""> политики конфиденциальности</a></b></label>
                </div>

                <div class="form__group respon-kaptcha">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                </div>

                <div class="form__row">
                    <button type="submit" class="btn btn--red">Отправить</button>
                </div>

            </form>
        </section>
    </div>
</main>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY; ?>', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>