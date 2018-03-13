<?if ($day['SPEAKER_NAME']['VALUE']):?>
    <section class="mbr-section mbr-section__container article" id="header3-e" data-rv-view="868" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="mbr-section-title display-2">СПИКЕРЫ ДНЯ CNI</h3>

                </div>
            </div>
        </div>
    </section>

    <section class="mbr-cards mbr-section mbr-section-nopadding speakers" id="features1-d" data-rv-view="870" style="background-color: rgb(40, 50, 78);">

        <div class="mbr-cards-row row striped">

            <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
                <div class="container">
                    <div class="card cart-block">
                        <div class="card-img"
                             style="background-image: url('<?=CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][0])?>');"
                        ></div>
                        <div class="card-block">
                            <h4 class="card-title">
                                <?=$day['SPEAKER_NAME']['VALUE'][0]?> <?=$day['SPEAKER_SURNAME']['VALUE'][0]?>
                            </h4>

                            <p class="card-text">
                                <?=$day["SPEAKER_DESCRIPTION"]["~VALUE"][0]?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
                <div class="container">
                    <div class="card cart-block">
                        <div class="card-img"
                             style="background-image: url('<?=CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][1])?>');"
                        ></div>
                        <div class="card-block">
                            <h4 class="card-title" style="color: white;">
                                <?=$day['SPEAKER_NAME']['VALUE'][1]?> <?=$day['SPEAKER_SURNAME']['VALUE'][1]?>
                            </h4>

                            <p class="card-text" style="color: white;">
                                <?=$day["SPEAKER_DESCRIPTION"]["~VALUE"][1]?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?endif;?>