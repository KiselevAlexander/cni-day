<?php
/**
 * User: Alexander Kiselev
 * Date: 15.08.18
 * Time: 10:41
 */
?>
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/local/templates/2018/includes/contact-form.php",
                    "EDIT_TEMPLATE" => ""
                ),
                    false
                );?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>