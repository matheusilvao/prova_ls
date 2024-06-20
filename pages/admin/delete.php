<?php
session_start();
include_once "../../connect.php";

if (!empty($_GET["id"])) {
  $id = $_GET["id"];
  $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
  $result = $conexao->query($sqlSelect);

  if ($result->num_rows > 0) {
    $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
    if ($conexao->query($sqlDelete) === true) {
      header("Location: dash-adm.php");
      exit();
    } else {
      echo "Erro ao deletar usuário: " . $conexao->error;
    }
  } else {
    header("Location: dash-adm.php");
    exit();
  }
} else {
  header("Location: dash-adm.php");
  exit();
}
?>