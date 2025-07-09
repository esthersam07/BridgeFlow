<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Marks</title>
  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
      background-color: rgb(250,240,241);
    }

    h2 {
      text-align: center;
      margin: 20px 0;
      color: #002c84;
    }

    .container {
      max-width: 1000px;
      margin-top :100px;
      margin-bottom :100px;
      margin-left: auto;
      margin-right: auto;
      padding: 20px;
      background: #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .logo {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .logo img {
      height: 100px;
      max-width: 200px;
    }

    .details {
      margin-bottom: 20px;
    }

    .details table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
    }

    .details th, .details td {
      text-align: left;
      padding: 8px 12px;
      border: none;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }

    .markSection tr:hover {
      background-color: #f1f5ff;
    }

    .percentage {
      margin-top: 20px;
      text-align: center;
      color: #002c84;
      font-size: 18px;
    }

    .print-btn {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    @media print {
      button {
        display: none;
      }
      body {
        background: white;
      }
    }
  </style>

  <script>
    function printMarksheet() {
      const printContents = document.getElementById('dataSection').innerHTML;
      const originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      location.reload();
    }
  </script>
</head>

<body>
<?php $this->load->view('header'); ?>

<a id="top"></a>

<?php if (!empty($st_data)) { ?>
  <div class="container" id="dataSection">
    <div class="logo">
      <img src="\stms\assets\images\school.jpg" alt="School Logo">
    </div>

    <div class="details">
      <table>
        <tr>
          <th>Roll No.:</th>
          <td><?= $this->session->userdata('user_id') ?></td>
          <th>Name:</th>
          <td><?= $this->session->userdata('user_name') ?></td>
        </tr>
        <tr>
          <th>Class:</th>
          <td><?= $class; ?></td>
          <th>Section:</th>
          <td><?= $section; ?></td>
        </tr>
      </table>
    </div>

    <h2>Your Marks</h2>
    <div class="markSection">
    <table>
      <thead>
        <tr>
          <th>S.No.</th>
          <th>Subject Code</th>
          <th>Subject Name</th>
          <th>Marks</th>
        </tr>
      </thead>
      <tbody>
        <?php $sno = 1; ?>
        <?php foreach ($st_data as $row): ?>
          <tr>
            <td><?= $sno++; ?></td>
            <td><?= $row['subject']; ?></td>
            <td><?= $row['subjName']; ?></td>
            <td><?= $row['marks']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
        </div>

    <div class="percentage">
      <p><b>Percentage = <?= $percent; ?></b></p>
    </div>

    <div class="print-btn">
      <button onclick="printMarksheet()">Print Marksheet</button>
    </div>
  </div>

<?php } else { ?>
  <div class="container">
    <h2>Marks</h2>
    <p style="text-align:center; color:red; font-size: 18px;">No records found.</p>
  </div>
<?php } ?>

<?php $this->load->view('footer'); ?>
</body>
</html>
