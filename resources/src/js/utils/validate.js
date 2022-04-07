(function($) {
  $(function() {
    // =========================================
    // Add Global setup default
    // =========================================
    $.validator.setDefaults({
      errorClass: "msg-error",
      validClass: "focus",
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
    });
    // =========================================
    // Add Global validate method
    // =========================================
    $.validator.addMethod('validate_email', function(value, element) {
      if (value.match(/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]*)*@[a-zA-Z]+([a-zA-Z0-9]*(_|-|\.){0,1}[a-zA-Z0-9])+(\.[a-z]{2,4})$/)) {
        return true;
      }

      return false;
    }, $.validator.format("Please enter the correct value"));
  });
})(jQuery);