<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <!DOCTYPE html>
    <html >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/-3-139x128.png" type="image/x-icon">
        <meta name="description" content="Салон Красоты на Северной и Тургенева. Полный спектр ухода за ногтями: наращивание, моделирование, гель-лак, аппаратный и классический маникюр. Процедуры красоты: наращивание ресниц, броу-бар, перманентный макияж, шугаринг.">
        <title><?$APPLICATION->ShowTitle()?></title>
        <?$APPLICATION->ShowHead();?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/web/assets/mobirise-icons/mobirise-icons.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/et-line-font-plugin/style.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/tether/tether.min.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/dropdown/css/style.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/socicon/css/styles.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/style.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/slick.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/theme/css/style.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/mobirise-gallery/style.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/mobirise/css/mbr-additional.css" type="text/css">

    </head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<section id="ext_menu-7" data-rv-view="2">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">

                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="/?new=1" class="navbar-logo">
                            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/-3-139x128.png" alt="CNI Salon">
                        </a>
                    </div>

                </div>

                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        <li class="nav-item dropdown">
                            <a class="nav-link link dropdown-toggle" href="/" data-toggle="dropdown-submenu" aria-expanded="false">
                                УСЛУГИ
                            </a>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "top_menu_sections",
                                [
                                    "IBLOCK_ID" => 8,
                                    "IBLOCK_TYPE" => "Service",
                                    "TOP_DEPTH" => "2",
                                ]
                            );?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="/sterilization/?new=1">
                                СТЕРИЛИЗАЦИЯ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="/contacts/?new=1">
                                АДРЕС И&nbsp;ТЕЛЕФОН
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="/prices/">
                                ЦЕНЫ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="/reviews/?new=1">
                                ОТЗЫВЫ И&nbsp;МАСТЕРА
                            </a>
                        </li>
                        <li class="nav-item nav-btn">
                            <a class="nav-link btn btn-primary-outline btn-primary" href="/blog/?new=1">
                                БЛОГ
                            </a>
                        </li>
                        <li class="nav-item nav-btn">
                            <a class="nav-link btn btn-primary" data-toggle="modal" data-target="#orderModal">
                                ЗАПИСАТЬСЯ
                            </a>
                        </li>
                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>
