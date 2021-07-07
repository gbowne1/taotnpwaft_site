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

