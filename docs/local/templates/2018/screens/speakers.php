<?
/**
 * @param $name
 * @param $surname
 * @param $description
 * @param $image
 * @param $title
 */
function renderSpeaker($name, $surname, $description, $image, $title) {

    ?>
    <div class="mbr-cards-col col-xs-12">
        <h3
                class="mbr-section-title display-2 text-uppercase"
        >
            <?=$title?>
        </h3>
        <div class="container"  style="padding-top: 40px; padding-bottom: 40px;">
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
                           data-additional-data="<?=json_encode(['speakerName' => "{$name} {$surname}"])?>"
                           onclick="reachGoal('5scrn_open_teacher')"
                           data-submit-goal="5scrn_send_teacher"
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

    <section class="mbr-cards mbr-section mbr-section-nopadding speakers" id="features1-d" data-rv-view="870" style="background-color: rgb(40, 50, 78);">

        <div class="mbr-cards-row row striped">

            <?
            foreach ($day['SPEAKER_NAME']['VALUE'] as $key => $speakerName) {
                $sKey = $key +1;
                renderSpeaker(
                    $day['SPEAKER_NAME']['VALUE'][$key],
                    $day['SPEAKER_SURNAME']['VALUE'][$key],
                    $day["SPEAKER_DESCRIPTION"]["~VALUE"][$key],
                    CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][$key]),
                    $day["SPEAKERS_TITLE_{$sKey}"]['VALUE']
                );
            }
            ?>

        </div>
    </section>

<?endif;?>
