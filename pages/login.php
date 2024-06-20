<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/tela-login.css">
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <h2>Login</h2>
    </div>
    <form class="login-form" action="../validateLogin.php" method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
      <p>
        Não tem conta ?
        <a href="cadastro.php">Criar uma</a>
      </p>
    </form>
  </div>
</body>

</html>