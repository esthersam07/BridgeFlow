<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 80px 20px 120px;
      background-color: #f0f4fa;
    }

    .container {
      background-color: #fff;
      margin-top: 60px;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 100%;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #002c84;
    }

    label {
      display: block;
      font-weight: 600;
      font-size: 14px;
      color: #333;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input:focus {
      border-color: #007bff;
      outline: none;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    @media screen and (max-width: 500px) {
      .container {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>
  <?php $this->load->view('header'); ?>

  <main>
    <div class="container">
    <h2>Login</h2>
    <?php if (validation_errors()) : ?>
            <div class="error">
                <?php echo validation_errors(); ?>
            </div>
    <?php endif; ?>
    <?php if (isset($message)) {
         echo "<p style='color:red;'>$message</p>"; 
        } 
    ?>
    <form method="post" action="<?php echo base_url('auth/login_user'); ?>">
        <label for="type">User Type:
        <input type="radio" name="type" value="t"> Teacher
        <input type="radio" name="type" value="s"> Student
          </label>
        
        <label>
        Email: <input type="email" name="email" required>
        </label>

        <label>
        Password: <input type="password" name="pwd" required>
        </label>
        <div style="text-align: center; margin-top: 10px;">
            <button type="submit">Login</button>
        </div>
        
    </form>
    </div>
  </main>

  <?php $this->load->view('footer'); ?>
</body>
</html>
