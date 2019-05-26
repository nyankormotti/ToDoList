$(function(){

    // メッセージ宣言
    const MSG_CONTACT_COUNT_ERR = '500文字以内で入力してください。';

    // SPメニュー
    $('.js-toggle-sp--menu').on('click',function(){
        $(this).toggleClass('active');
        $('.js-toggle-sp--menu-target').toggleClass('active');
    });

    // コメントカウント(お問い合わせ画面)
    $('.js-comment-input').keyup(function () {
        // 入力値の文字列長を取得
        let count = $(this).val().length;
        // 文字列長を画面に出力
        $('.js-comment--count').text(count);

        // DOMを取得
        let textarea = $('.js-comment-input');
        let err_msg = $('.js-err_comment');
        let btn = $('.btn');
        // var form_g = $(this).closest('.form-group');

        if (count > 500){
            textarea.addClass('err__block');
            err_msg.addClass('err__comment');
            err_msg.text(MSG_CONTACT_COUNT_ERR);
            btn.prop("disabled", true);
            btn.addClass('inactive');
        } else {
            textarea.removeClass('err__block');
            err_msg.removeClass('err__comment');
            err_msg.text("");
            btn.prop("disabled", false);
            btn.removeClass('inactive');
        }

    });

    // カレンダー表示
    $('.datepicker').datepicker({
        showOtherMonths: true, //他の月を表示
        selectOtherMonths: true //他の月を選択可能
    });

    // アコーディオンメニュー
    $('.toggle_switch').on('click', function () {
        $(this).toggleClass('open');
        $(this).next('.toggle_contents').slideToggle();
    });

    //処理完了時のメッセージ表示

    let $jsShowMsg = $('#js-msg');
    let msg = $jsShowMsg.text();
    if (msg.replace(/^[\s ]+|[\s ]+$/g, "").length) {
        $jsShowMsg.slideToggle('slow');
        setTimeout(function () { $jsShowMsg.slideToggle('slow'); }, 5000);
    }
});