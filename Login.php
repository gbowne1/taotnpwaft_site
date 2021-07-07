<?php
  include "DatabaseHelper.php";
  $result = ValidateLogin($_POST['UserName'], $_POST['Password']);
  echo $result;
//  echo json_encode('{"result": ' . $result . '"}');
?>
