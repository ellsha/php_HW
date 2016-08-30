/**
 * Функция Скрывает/Показывает блок
 **/

$(document).on("click" , ".comment-hide-show-button", function (event) {
    $obj = $(this).parent().find('.add-comment-block');
    if($obj.is(':hidden')) {
        $obj.show();
    } else {
        $obj.hide();
    }
});