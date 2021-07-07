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


