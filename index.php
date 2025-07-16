<?php
  function login($username,$password){
    $data = file_get_contents(__DIR__.'/users.json');
    $users = json_decode($data, true);
    foreach ($users as $user) {
      if($user['username'] == $username && $user['password'] == $password){
        return true;
      }
    }
    return false;
  }

  $error = null;
  $success = null;

  // Register
  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['register'])){
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if(empty($username) || empty($email) || empty($password)){
      $error = "All fields are required!";
    } else {
      $data = file_get_contents(__DIR__.'/users.json');
      $users = json_decode($data, true);
      foreach ($users as $user) {
        if($user['username'] == $username){
          $error = "Username already exists!";
          break;
        }
      }
      if(!$error){
        $users[] = ['username' => $username, 'email' => $email, 'password' => $password];
        file_put_contents(__DIR__.'/users.json', json_encode($users, JSON_PRETTY_PRINT));
        $success = "Registration successful!";
      }
    }
  }

  // Login
  if($_SERVER['REQUEST_METHOD'] =='POST' && !isset($_POST['register'])){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(empty($username) || empty($password)){
      $error = "Username and password cannot be empty!";
    } else {
      if(login($username, $password)){
        $success = "Logged in successfully! Welcome $username";
      } else {
        $error = "Invalid username or password!";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login / Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: #fff;
      width: 400px;
      height: 500px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      position: relative;
    }

    .form-wrapper {
      display: flex;
      width: 200%;
      height: 100%;
      transition: transform 0.5s ease-in-out;
    }

    .form-container {
      width: 50%;
      padding: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #007bff;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #0056b3;
    }

    .toggle-text {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .toggle-text a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
    }

    .show-register .form-wrapper {
      transform: translateX(-50%);
    }

    .form-message{
      position: absolute;
      bottom: 20px;
      width: 100%;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container" id="form-container">
  <div class="form-wrapper">

    <form id="login-form" class="form-container" method="POST" action="">
      <h2>Login</h2>
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <div class="toggle-text">Don't have an account? <a onclick="toggleForm()">Register now</a></div>
    </form>

    <form id="register-form" class="form-container" method="POST" action="">
      <h2>Register</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
     <button type="submit" name="register">Register</button>
      <div class="toggle-text">Already have an account? <a onclick="toggleForm()">Login here</a></div>
    </form>
  </div>
    <div class="form-message">
    <?php
      if(isset($error)) {
        echo "<h3 style='color:red; font-weight:bold;'>$error</h3>";
      }
      if(isset($success)) {
        echo "<h3 style='color:green; font-weight:bold;'>$success</h3>";
      }
    ?></div>
</div>

<script>
  function toggleForm() {
    document.getElementById('form-container').classList.toggle('show-register');
  }
</script>

</body>
</html>
