<?
/**
 * Вывод формы
 * @param $email_addresses
 * @param $city - название города
 * @param $cityId - ID города
 */
function renderForm($email_addresses, $city, $cityId) {
    ?>
    <form action="/local/templates/2018/" method="post" data-form-title="ОСТАВЬТЕ ЗАЯВКУ">

        <input type="hidden" value="d+W6CUmCvzkkK6cu/pvPGiAJ6ddQRsLROu7TqRMCF4NT3eN2DDvw2p7gOo95/up4QNIyDpyYUoMxWrbYzp1cbEM2lUv+i2sBnxFOmIP0FFn2GnYH1IawHyEQBCvqCFz4" data-form-email="true">

        <input data-form-sendto="true" type="hidden" name="sendto" value="<?=implode(',', $email_addresses)?>">
        <input data-form-product="true" type="hidden" name="product" value="0">
        <input data-form-city="true" type="hidden" name="city" value="<?=$city?>">
        <input data-form-city="true" type="hidden" name="city_id" value="<?=$cityId?>">

        <div class="row row-sm-offset">

            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label class="form-control-label" for="form1-8-name">Имя<span class="form-asterisk">*</span></label>
                    <input type="text"
                           class="form-control"
                           name="name"
                           required="" data-form-field="Name"
                           id="form1-8-name"
                    >
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label class="form-control-label" for="form1-8-phone">Телефон<span class="form-asterisk">*</span></label>
                    <input type="tel"
                           class="form-control"
                           name="phone"
                           data-form-field="Phone"
                           id="form1-8-phone"
                           required
                    >
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label class="form-control-label" for="form1-8-email">Email<span class="form-asterisk">*</span></label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           data-form-field="Email"
                           id="form1-8-email"
                           required
                    >
                </div>
            </div>

        </div>

        <div class="form-group">
            <label class="form-control-label" for="form1-8-message">Комментарии</label>
            <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-8-message"></textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">ЗАПИСАТЬСЯ</button>
        </div>

    </form>
    <?
}
?>
<div class="modal fade no-animate" id="order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <section class="mbr-section" id="form1-8" style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 120px;">

                    <div class="mbr-section mbr-section__container mbr-section__container--middle">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 text-xs-center">
                                    <h3 class="mbr-section-title display-2 no-animate">ОСТАВЬТЕ ЗАЯВКУ</h3>
                                    <small class="mbr-section-subtitle no-animate">чтобы гарантированно попасть на главное событие нейл-индустрии в вашем городе!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">

                                    <div data-form-alert="true">
                                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Благодарим за заявку на участие. Сегодня с Вами свяжется менеджер и расскажет, как забрать билет!</div>
                                    </div>

                                    <? renderForm(
                                        $day['SEND_MAIL_ADDRESS']['VALUE'],
                                        $arParams['CITY_NAME'],
                                        $GLOBALS['iCurCityID']
                                    );
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>

<!--Заявка спикера-->
<div class="modal fade no-animate" id="order-speaker">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <section class="mbr-section" id="form1-8" style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 120px;">

                    <div class="mbr-section mbr-section__container mbr-section__container--middle">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 text-xs-center">
                                    <h3 class="mbr-section-title display-2 no-animate">ОСТАВЬТЕ ЗАЯВКУ</h3>
                                    <small class="mbr-section-subtitle no-animate">Запишитесь на семинар с отработкой у нейл-чемпиона
                                        Оставьте телефон, по которому мы можем вам перезвонить</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">


                                    <div data-form-alert="true">
                                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Благодарим за заявку на участие. Сегодня с Вами свяжется менеджер и расскажет, как забрать билет!</div>
                                    </div>

                                    <? renderForm(
                                        $day['SEND_MAIL_ADDRESS']['VALUE'],
                                        $arParams['CITY_NAME'],
                                        $GLOBALS['iCurCityID']
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>