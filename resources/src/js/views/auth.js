(function($) {
  // =========================================
  // Sign-up Handler
  // =========================================
  $(function() {
    const validatorSignup = $("[data-form='signup']").validate({
      rules: {
        "data[name]": {
          required: true,
          maxlength: 255,
        },
        "data[email]": {
          required: true,
          maxlength: 255,
          validate_email: true,
        }
      }
    });
  });

  // =========================================
  // Sign-in Handler
  // =========================================
  $(function() {

  });
})(jQuery);
