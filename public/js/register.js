  var oscss_pass = $('#password');
  var oscss_confirm = $('#password-confirm');
  var oscss_register_btn = $('#register-btn');
  var oscss_invalid_feedback = $('.invalid-feedback');
  /*
  * 確認パスワードのキーボード（KeyUp）イベントリスナー
  */
  oscss_confirm.on('keyup', function() {
    // まだパスワード（確認）を入力していない
    if (oscss_confirm.val() === "") {
      oscss_confirm.removeClass("is-valid");
      oscss_confirm.removeClass("is-invalid");
      oscss_invalid_feedback.css("display","none");
      return;
    }
    // 先頭から一文字ずつ取り出してチェックし最後まで到達していなくとも「問題無し」と判断
    var array_pass_chars = oscss_pass.val().split("");
    var array_confirm_chars = oscss_confirm.val().split("");
    $.each(array_confirm_chars, function(index, char) {
      if (array_pass_chars[index] === char){
        // 先頭から一文字ずつ一致している場合には中途でも何も表示しない
        oscss_confirm.removeClass("is-valid");
        oscss_confirm.removeClass("is-invalid");
        oscss_invalid_feedback.css("display","none");
        oscss_register_btn.prop('disabled',false);
      }else{
        // 一文字でも異なる場合はInvalid
        oscss_confirm.removeClass("is-valid");
        oscss_confirm.addClass("is-invalid");
        oscss_invalid_feedback.css("display","inline");
        oscss_invalid_feedback.text("入力されたパスワードが一致しません。");
        oscss_register_btn.prop('disabled',true);
	return false;
      }
    });
    // 完全一致したらValid
    if (oscss_pass.val() === oscss_confirm.val()) {
      oscss_confirm.addClass("is-valid");
      oscss_invalid_feedback.css("display","none");
      oscss_register_btn.prop('disabled',false);
    }
    else {
      oscss_confirm.addClass("is-invalid");
      oscss_invalid_feedback.css("display","inline");
      oscss_invalid_feedback.text("入力されたパスワードが一致しません。");
      oscss_register_btn.prop('disabled',true);
    }
  });
  /*
  * 確認パスワード入力のフォーカスを失ったとき（Blur）のイベントリスナー
  */
  oscss_confirm.on('blur', function() {
    if (oscss_pass.val() === oscss_confirm.val()) {
      oscss_confirm.removeClass("is-invalid");
      oscss_confirm.addClass("is-valid");
      oscss_register_btn.prop('disabled',false);
    }
    // フォーカスが失われたときパスワードが一致しないと判断（Invalid）
    else {
      oscss_confirm.removeClass("is-valid");
      oscss_confirm.addClass("is-invalid");
      oscss_register_btn.prop('disabled',true);
    }
  });
