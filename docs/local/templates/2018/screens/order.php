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


                                    <form action="/local/templates/2018/" method="post" data-form-title="ОСТАВЬТЕ ЗАЯВКУ">

                                        <input type="hidden" value="d+W6CUmCvzkkK6cu/pvPGiAJ6ddQRsLROu7TqRMCF4NT3eN2DDvw2p7gOo95/up4QNIyDpyYUoMxWrbYzp1cbEM2lUv+i2sBnxFOmIP0FFn2GnYH1IawHyEQBCvqCFz4" data-form-email="true">

                                        <input data-form-sendto="true" type="hidden" name="sendto" value="<?=implode(',', $day['SEND_MAIL_ADDRESS']['VALUE'])?>">
                                        <input data-form-product="true" type="hidden" name="product" value="0">
                                        <input data-form-city="true" type="hidden" name="city" value="<?=$arParams['CITY_NAME']?>">

                                        <div class="row row-sm-offset">

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="form1-8-name">Имя<span class="form-asterisk">*</span></label>
                                                    <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-8-name">
                                                </div>
                                            </div>



                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="form1-8-phone">Телефон<span class="form-asterisk">*</span></label>
                                                    <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="form1-8-phone">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="form1-8-message">Комментарии</label>
                                            <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-8-message"></textarea>
                                        </div>

                                        <div><button type="submit" class="btn btn-primary">ЗАПИСАТЬСЯ</button></div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>