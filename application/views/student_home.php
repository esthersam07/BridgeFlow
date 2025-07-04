<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Home Page</title>
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
      background-color: rgb(250, 240, 241);
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 100px 20px 80px;
    }

    .container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      max-width: 1000px;
      width: 100%;
    }

    h1 {
      text-align: center;
      color: #002c84;
      margin-bottom: 30px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-top: 30px;
    }

    .section {
      padding: 40px 20px;
    }

    .section.actions {
      background-color: #fff;
      text-align: center;
    }

    .circle-buttons {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .circle-buttons a {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background-color: #002c84;
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      transition: transform 0.2s, background-color 0.2s;
    }

    .circle-buttons a:hover {
      transform: scale(1.08);
      background-color: #001e5e;
    }

    @media screen and (max-width: 600px) {
      .container {
        padding: 20px;
      }

      .circle-buttons {
        gap: 20px;
      }

      .circle-buttons a {
        width: 120px;
        height: 120px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <?php $this->load->view('header'); ?>

  <main>
    <?php
    $user_name = $this->session->userdata('user_name');
    ?>
    <div class="container">
      <h1>Welcome, <?= $user_name; ?>!</h1>

      <div class="section actions">
        <div class="circle-buttons">
          <a href="<?= base_url('auth/studentProfile'); ?>">Profile</a>
          <a href="<?= base_url('auth/viewMarks'); ?>">View Marks</a>
        </div>
      </div>
    </div>
  </main>

  <?php $this->load->view('footer'); ?>

</body>
</html>
