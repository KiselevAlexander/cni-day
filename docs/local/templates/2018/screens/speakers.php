<?
/**
 * @param $name
 * @param $surname
 * @param $description
 * @param $image
 */
function renderSpeaker($name, $surname, $description, $image) {

    ?>
    <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
        <div class="container">
            <div class="card cart-block">
                <?if ($image):?>
                    <div class="card-img"
                         style="background-image: url('<?=$image?>');"
                    ></div>
                <?endif;?>
                <div class="card-block">
                    <h4 class="card-title" style="color: #fff">
                        <?=$name?> <?=$surname?>
                    </h4>

                    <p class="card-text" style="color: #fff">
                        <?=$description?>
                    </p>

                    <div class="card-btn">
                        <a href="/#order-speaker"
                           class="btn btn-danger"
                           data-toggle="modal"
                           data-target="#order-speaker"
                           data-additional-data="<?=json_encode([
                                   'speakerName' => "{$name} {$surname}"
                           ])?>"
                        >
                            ЗАПИСАТЬСЯ
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?
}
?>

<?if ($day['SPEAKER_NAME']['VALUE']):?>
    <section class="mbr-section mbr-section__container article" id="header3-e" data-rv-view="868" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="mbr-section-title display-2 text-uppercase">
                        <?=($day['SPEKERS_TITLE']['VALUE']) ? $day['SPEKERS_TITLE']['VALUE'] : 'СПИКЕРЫ ДНЯ CNI'?>
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="mbr-cards mbr-section mbr-section-nopadding speakers" id="features1-d" data-rv-view="870" style="background-color: rgb(40, 50, 78);">

        <div class="mbr-cards-row row striped">

            <?
            foreach ($day['SPEAKER_NAME']['VALUE'] as $key => $speakerName) {
                renderSpeaker(
                    $day['SPEAKER_NAME']['VALUE'][$key],
                    $day['SPEAKER_SURNAME']['VALUE'][$key],
                    $day["SPEAKER_DESCRIPTION"]["~VALUE"][$key],
                    CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][$key])
                );
            }
            ?>

        </div>
    </section>

<?endif;?>