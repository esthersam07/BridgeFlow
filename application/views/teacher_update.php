<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
      align-items: flex-start;
      padding: 120px 20px 100px;
      background-color: #fff;
    }

    .container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .single-form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color:  #a32035;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(90, 17, 29);
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php $id = $user_id; ?>
    <?php $this->load->view('header'); ?>
    <main>
    <div class="container">
        <h1>Update Details</h1>
        <?php if (validation_errors()) : ?>
            <div class="error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('auth/teacherUpdateDetails'); ?>" method="post">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="single-form">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $user_name; ?>" required>
            </div>

            <div class="single-form">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder="Enter New Password Only If Want To Change">
            </div>
           
            <button type="submit">Update</button>
        </form>
    </div>
        </main>
        <?php $this->load->view('footer'); ?>
</body>
</html>
