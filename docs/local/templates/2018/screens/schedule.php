<section class="mbr-section mbr-section__container article" id="header3-i" data-rv-view="864" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2">Программа дня CNI для Краснодара:</h3>

            </div>
        </div>
    </div>
</section>

<section class="mbr-section article mbr-section__container" id="content2-f" data-rv-view="866" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 lead">
                <?if ($day['DAY_2']['~VALUE']):?>
                    <h3>День 1</h3>
                <?endif;?>
                <?foreach ($day['DAY_1']['~VALUE'] as $k=>$schedule):?>
                        <blockquote>
                            <strong>
                                <?=$day['DAY_1']['DESCRIPTION'][$k]?>
                            </strong>
                        </blockquote>
                        <blockquote>
                            <p>
                                <?=str_replace("\n", '<br />', $schedule);?>
                            </p>
                        </blockquote>
                <?endforeach;?>

                <?if ($day['DAY_2']['~VALUE']):?>
                    <h3 style="margin-top: 2rem">День 2</h3>
                <?endif;?>
                <?foreach ($day['DAY_2']['~VALUE'] as $k=>$schedule):?>
                    <blockquote>
                        <strong>
                            <?=$day['DAY_2']['DESCRIPTION'][$k]?>
                        </strong>
                    </blockquote>
                    <blockquote>
                        <p>
                            <?=str_replace("\n", '<br />', $schedule);?>
                        </p>
                    </blockquote>
                <?endforeach;?>

                <?if ($day['DAY_3']['~VALUE']):?>
                    <h3 style="margin-top: 2rem">День 3</h3>
                <?endif;?>
                <?foreach ($day['DAY_3']['~VALUE'] as $k=>$schedule):?>
                    <blockquote>
                        <strong>
                            <?=$day['DAY_3']['DESCRIPTION'][$k]?>
                        </strong>
                    </blockquote>
                    <blockquote>
                        <p>
                            <?=str_replace("\n", '<br />', $schedule);?>
                        </p>
                    </blockquote>
                <?endforeach;?>
            </div>
        </div>
    </div>

</section>