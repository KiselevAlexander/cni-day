<?php include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: application/json');
CModule::IncludeModule('iblock');

$result = array();
$gals = array();

//$imageSize = array(
//    'width'=>1180,
//    'height'=>846
//);

$imageSize = array(
    'width'=>590,
    'height'=>423
);

$res = CIBlockElement::GetProperty(1, $_REQUEST["id"], "sort", "asc", array("CODE" => "GALLERY_".$_REQUEST["req"]));
while ($ob = $res->GetNext())
{
    $gals[] = $ob['VALUE'];
}

foreach ($gals as $gal){
    $arSelect = Array("ID", "IBLOCK_ID", "PROPERTIES_*", "NAME", "CODE");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID" => $gal);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    if($ob = $res->GetNextElement()){
        $gallery = $ob->GetProperties();
        $name = $ob->getFields();
        $photos = array();
        foreach($gallery["PHOTOS"]["VALUE"] as $photo){
            $arFile = CFile::GetFileArray($photo);
            $file = CFile::ResizeImageGet($arFile, $imageSize, BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $photos[] = $file['src'];
        }

        $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
        $uInfo['PERSONAL_PHOTO'] = $img;

        $result[] = array(
            "date" => (!empty($gallery["DATE"]["VALUE"]))? $gallery["DATE"]["VALUE"]: "",
            "title" => $name["NAME"],
            "name" => $name["CODE"],
            "image" => $photos[0],
            "items" => $photos
        );
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);