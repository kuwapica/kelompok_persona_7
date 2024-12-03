<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
require 'koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    //cek username
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            //set session
            $_SESSION['login'] = true;
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style1.css" />
  </head>
  <body>
    <div class="formulir">
      <header>LOGIN</header>
      <form action="">
        <div><input type="text" id="input_nama" name="username" placeholder="Username...." /></div>
        <div>
          <input type="text" id="input_password" name="password" placeholder="Password...." />
        </div>
        <div><input type="submit" name="login" value="Login" /></div>
      </form>
      <div class="sign-txt">Not yet member? <a href="../login/registrasi.php">Signup now</a></div>
    </div>
  </body>
</html>
