<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successfully Registered</title>
    <style>
        body {
            background-color: #002c84;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color:  #a32035;;
      margin-top: 60px;
      padding: 30px 40px;
      border-radius: 10px;
      max-width: 450px;
      width: 100%;
      color: white;
        }
        .container a {
  color: white;
  font-size: 14px;
  letter-spacing: 1px;
}

.container a:hover {
  color: #FFD700;
}
    </style>
</head>
<body>
    <div class="container">
    <p><?php echo $message; ?></p>
    <a href="<?php echo base_url('login'); ?>">Login</a>
</div>
</body>
</html>