(function($) {
  // =========================================
  // Sign-up Handler
  // =========================================
  $(function() {
    $("[data-form='signup'").validate({
      rules: {
        "name": {
          required: true,
          maxlength: 10,
          minlength: 2,
        },
        "email": {
          required: true,
          maxlength: 255,
          validate_email: true,
        },
        "sex": {
          required: true,
        },
        "password": {
          validate_password: true,
        },
        "password_confirmation": {
          equalTo: "[name='password']"
        }
      },
      messages: {
        "name": {
          required: "Vui lòng nhập tên của bạn",
          maxlength: "Tên của bạn tối chỉ đa 10 ký tự",
          minlength: "Tên của bạn tối phải thiểu 2 ký tự"
        },
        "email": {
          required: "Vui lòng nhập địa chỉ e-mail",
          maxlength: "Địa chỉ mail chỉ tối đa 255 ký tự",
          validate_email: "Vui lòng nhập một e-mail hợp lệ"
        },
        "password": {
          validate_password: "Mật khẩu yêu cầu tối thiểu 8 ký tự và phải tồn tại ký tự hoa, thường, chữ số và ký tự đặt biệt"
        },
        "password_confirmation": {
          equalTo: "Mật khẩu nhập lại không khớp"
        }
      }
    });
  });
})(jQuery);
