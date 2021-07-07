<?php
/*------------------------------------------------------------
 * Name:          GetMySqliConnection
 * Purpose:       Gets an instance of a MySqlI Connection Object
 * Args:          None
 * Returns:       MySqli Connection Object
 * Date Created:  06 July 2021
 * Author:        Ivan Dormain
 * ------------------------------------------------------------*/
function GetMySqliConnection(): mysqli
{
  $servername = "64.20.44.202";
  $username = "radio_admin";
  $password = "G3tR3@dY1970";

  //Create connection
  $conn = new mysqli($servername, $username, $password);

  //Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}
/*------------------------------------------------------------
 * Name:          ValidateLogin
 * Purpose:       Validates a User Login from the Logins Tabe
 * Args:          UserName (STRING)
 *                Password (STRING)
 * Returns:       BOOL
 * Date Created:  06 July 2021
 * Author:        Ivan Dormain
 * ------------------------------------------------------------*/
function ValidateLogin($username, $password) : bool {
  $conn = GetMySqliConnection();
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $conn -> select_db("radiologger");
  $sql = "SELECT * FROM logins WHERE UserName='" . $username . "' AND Password = '" . $password ."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $date = date('Y/m/d H:i:s');
    $sql = "UPDATE logins SET LastLogin = '" . $date . "' WHERE UserName = '" . $username . "'";
    if ($conn->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
    $conn->close();
  }
  else {
    $conn->close();
    return false;
  }
}
/*------------------------------------------------------------
 * Name:          GetLoginTableData
 * Purpose:       Returns JSON of all Record in the Login Table
 * Args:          None
 * Returns:       JSON
 * Date Created:  06 July 2021
 * Author:        Ivan Dormain
 * ------------------------------------------------------------*/
function GetLoginTableData() {
  $conn = GetMySqliConnection();
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $conn -> select_db("radiologger");
  $sql = "SELECT * FROM logins";
  $result = $conn->query($sql);
  $info=array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $loginInfo = array();
      $loginInfo["LoginId"]=$row["LoginId"];
      $loginInfo["UserName"]=$row["UserName"];
      $loginInfo["Password"]=$row["Password"];
      $loginInfo["LastLogin"]=$row["LastLogin"];
      array_push($info, $loginInfo);
    }
    return json_encode($info);
  } else {
    echo "0 results";
  }
}

/*------------------------------------------------------------
 * Name:          General PHP to Check for an AJAX Call from JQuery
 * Purpose:       General PHP to Check for an AJAX Call from JQuery
 * Args:          None
 * Returns:       None
 * Date Created:  06 July 2021
 * Author:        Ivan Dormain
 * ------------------------------------------------------------*/
if (isset($_POST['GetLoginTableData'])) {
  echo GetLoginTableData($_POST['GetLoginTableData']);
}
