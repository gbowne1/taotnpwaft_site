function NShowNotification(type, message) {
  try {
    var opts = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
    switch (type) {
      case "success":
        toastr.success(message, "Success", opts);
        break;
      case "info":
        toastr.info(message, "Information", opts);
        break;
      case "warning":
        toastr.warning(message, "Warning", opts);
        break;
      case "error":
        toastr.error(message, "Error", opts);
        break;
      default:
        toastr.info(message, "Information", opts);
        break;
    }
  }
  catch (e) {
    alert(e);
  }
}
function Login() {
  $uname = $("#idUserName").val();
  $p = $("#idPassword").val();
  $.ajax({
    type: "POST",
    datatype: "json",
    url: 'Login.php',
    async: true,
    data: {
      UserName: $uname,
      Password: $p
    },
    success: function(data) {
      if (data == 1) {
        console.log('success', data);
      } else {
        console.log('fail', data);
      }
    }
  });
}


