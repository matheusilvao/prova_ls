<?php
session_start();
include_once "./connect.php";
if (
  $_SERVER["REQUEST_METHOD"] == "POST" 
) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conexao, $query);

  if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
    $nivel_acesso = $usuario["nivel_acesso"];
    if ($nivel_acesso == 1) {
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      header("Location: pages/admin/dash-adm.php");
      exit();
    } else if ($nivel_acesso == 2) {
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      header("Location: pages/client/dash-client.php");
      exit();
    }
  } else {
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
    header("Location: ./pages/login.php");
  }
}
?>
