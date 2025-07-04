<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile</title>
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
      padding: 120px 20px 90px;
      background-color: rgb(250, 240, 241);
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
          color: #002c84;
  margin-bottom: 20px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-top: 30px;
    }

    table {
  width: 100%;
      border-collapse: collapse;
    margin: 20px 0;
    }

    th, td {
      padding: 12px;
         border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f1f1f1;
      color: #333;
      width: 30%;
    }

    .actions {
          display: flex;
      flex-direction: row;
      gap: 15px;
          margin-top: 20px;
      margin-left: 120px;
    }

    .actions form {
      display: flex;
      justify-content: center;
    }

    button {
         padding: 10px 20px;
          background-color: #a32035;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
         background-color:rgb(90, 16, 29);
    }

    @media screen and (max-width: 600px) {
      .container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <?php $this->load->view('header'); ?>
    <?php
  $details = $details ?? [];
?>

  <main>
    <?php
    $user_id = $this->session->userdata('user_id');
    $user_name = $this->session->userdata('user_name');
    $user_email = $this->session->userdata('user_email');
    ?>
    <div class="container">
      <h1>Welcome, <?= $user_name; ?>!</h1>

      <h2>Personal Details</h2>
      <table>
        <tr>
          <th>Roll No.</th>
          <td><?= $user_id; ?></td>
        </tr>
        <tr>
          <th>Name</th>
          <td><?= $user_name; ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?= $user_email; ?></td>
        </tr>
        <tr>
  <th>Contact</th>
  <td><?= $details['contact'] ?? 'N/A'; ?></td>
</tr>
<tr>
  <th>Guardian Name</th>
  <td><?= $details['guardian_name'] ?? 'N/A'; ?></td>
</tr>
<tr>
  <th>Guardian Contact</th>
  <td><?= $details['guardian_contact'] ?? 'N/A'; ?></td>
</tr>
<tr>
  <th>Address</th>
  <td><?= $details['address'] ?? 'N/A'; ?></td>
</tr>
<tr>
  <th>Class</th>
  <td><?= $details['class'] ?? 'N/A'; ?></td>
</tr>
<tr>
  <th>Section</th>
  <td><?= $details['section'] ?? 'N/A'; ?></td>
</tr>

        

      </table>

      <div class="actions">
        <form method="post" action="<?= base_url('auth/userDelete'); ?>">
          <input type="hidden" name="email" value="<?= $user_email; ?>">
          <button type="submit" onclick="return confirm('Are you sure you want to delete your account?')">
            Delete Account
          </button>
        </form>

        <form method="post" action="<?= base_url('auth/userUpdate'); ?>">
          <input type="hidden" name="id" value="<?= $user_id; ?>">
          <button type="submit">Edit Profile</button>
        </form>
      </div>
    </div>
  </main>

  <?php $this->load->view('footer'); ?>

</body>
</html>
