<section class="mbr-cards mbr-section mbr-section-nopadding" id="features1-6" style="background-color: rgb(255, 255, 255);">

    <div class="mbr-cards-row row striped">

        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
            <div class="container">
                <div class="card cart-block seminar">
                    <?if($day['SEMINAR_2_IMAGE']['VALUE']):?>
                        <div class="card-img seminar-image"
                             style="background-image: url('<?=CFile::getPath($day['SEMINAR_1_IMAGE']['VALUE'])?>');"></div>
                    <?endif;?>
                    <div class="card-block">
                        <h4 class="card-title"><?=$day['SEMINAR_1']['VALUE']?></h4>
                        <h5 class="card-subtitle"><?=$day['SEMINAR_1']['DESCRIPTION']?></h5>
                        <div class="card-text">
                            <?=$day['SEMINAR_1_TEXT']['~VALUE']['TEXT']?>
                            <?if($day['SEMINAR_1_COST']['VALUE']):?>
                                <p>
                                    Стоимость участия = <?=$day['SEMINAR_1_COST']['VALUE']?> p.
                                </p>
                            <?endif;?>
                        </div>
                        <div class="card-btn">
                            <a href="/#order"
                               class="btn btn-danger"
                               onclick="$('[data-form-product]').val(1); reachGoal('3scrn_open_program');"
                               data-toggle="modal"
                               data-target="#order"
                               data-submit-goal="3scrn_send_program"
                            >
                                ЗАПИСАТЬСЯ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
            <div class="container">
                <div class="card cart-block seminar">
                    <?if($day['SEMINAR_2_IMAGE']['VALUE']):?>
                        <div class="card-img seminar-image"
                             style="background-image: url('<?=CFile::getPath($day['SEMINAR_2_IMAGE']['VALUE'])?>');"></div>
                    <?endif;?>
                    <div class="card-block">
                        <h4 class="card-title"><?=$day['SEMINAR_2']['VALUE']?></h4>
                        <h5 class="card-subtitle"><?=$day['SEMINAR_2']['DESCRIPTION']?></h5>
                        <div class="card-text">
                            <?=$day['SEMINAR_2_TEXT']['~VALUE']['TEXT']?>
                            <?if($day['SEMINAR_2_COST']['VALUE']):?>
                                <p>
                                    Стоимость участия = <?=$day['SEMINAR_2_COST']['VALUE']?> p.
                                </p>
                            <?endif;?>
                        </div>
                        <div class="card-btn">
                            <a href="/#order"
                               class="btn btn-primary"
                               onclick="$('[data-form-product]').val(2); reachGoal('3scrn_open_action');"
                               data-toggle="modal"
                               data-target="#order"
                               data-submit-goal="3scrn_send_action"
                            >
                                ЗАПИСАТЬСЯ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
