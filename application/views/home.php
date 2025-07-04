<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
    }

    .section {
      padding: 60px 40px;
    }

    .section.actions {
      background-color:rgb(255, 255, 255);
      text-align: center;
    }

    .circle-buttons {
      display: flex;
      justify-content: center;
      gap: 50px;
    }

    .circle-buttons a {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background-color: #002c84;
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: transform 0.2s;
    }

    .circle-buttons a:hover {
      transform: scale(1.05);
      background-color: #001e5e;
    }

    .section.table {
      background-color: #f2f7ff;
    }

    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid #aaa;
      padding: 10px;
      text-align: center;
    }

    .activate {
      background-color: rgba(250, 187, 187);
      color:black;
      border-radius: 5px;
      padding: 5px 10px;
    }
    button.activate:hover {
  transform: scale(1.05);
}


    .deactivate {
      background-color: rgba(252, 249, 155);
    border-radius: 5px;
      padding: 5px 10px;
      color:black;
    }
    button.deactivate:hover {
  transform: scale(1.05);
}

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .about-bg {
  background-image: url('<?= base_url("assets/images/stms_home.webp"); ?>');
  background-size: cover;
  background-position: center;
  height: 400px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px;
  color: white;
}

.overlay-box {
  background-color: rgba(251, 240, 218, 0); 
  padding: 20px 30px;
  border-radius: 8px;
  max-width: 600px;
}

  </style>
</head>
<body>

<?php $this->load->view('header'); ?>
<a id="top"></a>

<div class="section about-bg">
  <div class="overlay-box">
    <h2>ABOUT</h2>
    <p>
      A student-teacher management system to display my learnings of Codeigniter.
    </p>
  </div>
</div>

<div class="section actions">
  <div class="circle-buttons">
    <a href="<?= base_url('register'); ?>">Register</a>
    <a href="<?= base_url('login'); ?>">Login</a>
  </div>
</div>

<?php if (isset($all_data)) { ?>
<div class="section table" id="dataSection">
  <h2>All Users</h2>
  <?php if (!empty($all_data)) { ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
      </tr>
      <?php foreach ($all_data as $row): ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['email']; ?></td>
        <td>
          <?php if ($row['status'] === 'n') { ?>
            <form method="post" action="<?= base_url('auth/activate_user'); ?>">
              <input type="hidden" name="id" value="<?= $row['id']; ?>">
              <button class="activate" type="submit" onclick="return confirm('Are you sure you want to ACTIVATE this account?')">Activate</button>
            </form>
          <?php } else { ?>
            <form method="post" action="<?= base_url('auth/deactivate_user'); ?>">
              <input type="hidden" name="id" value="<?= $row['id']; ?>">
              <button class="deactivate" onclick="return confirm('Are you sure you want to DEACTIVATE this account?')">Deactivate</button>
            </form>
          <?php } ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  <?php } else { ?>
    <p style="text-align:center; color:red;">No records found.</p>
  <?php } ?>
</div>
<?php } ?>

<?php $this->load->view('footer'); ?>

</body>
</html>
