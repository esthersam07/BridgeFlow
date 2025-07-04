<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Marks</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
    }

    main {
      display: flex;
      justify-content: center;
      padding: 50px 20px;
    }

    .searchSection{
      background: white;
      padding: 30px 40px;
      border-radius: 4px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 1000px;
      margin-bottom: 30px;
      margin-top: 100px;
    }

    .container {
      background: white;
      padding: 30px 40px;
      border-radius: 4px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 1000px;
      margin-bottom: 20px;
      margin-top: 50px;
    }

    label {
      font-weight: bold;
      margin-right: 15px;
      display: inline-block;
    }

    select {
      margin-right: 20px;
      padding: 6px;
    }

    .button1, .uploadBtn {
      background-color: #a32035;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 10px 16px;
      cursor: pointer;
      font-size: 14px;
      margin-top: 10px;
    }

    .button1:hover, .uploadBtn:hover {
      background-color: #5a111d;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color:rgb(214, 222, 240, 0.5);
      font-weight: bold;
    }

    .no-records {
      text-align: center;
      color: red;
      font-size: 18px;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      label, select {
        display: block;
        margin-bottom: 10px;
      }

      .button1 {
        margin-left: 0;
      }
    }
    .footer{
      margin-top: 200px;
    }
    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
  $('#class, #section').on('change', function () {
    let selectedClass = $('#class').val();
    let selectedSection = $('#section').val();

    if (selectedClass && selectedSection) {
      $.ajax({
        url: '<?= base_url("auth/getRollNos") ?>',
        type: 'POST',
        data: {
          class: selectedClass,
          section: selectedSection
        },
        success: function (response) {
          $('#rollNo').html(response);
        },
        error: function () {
          alert('Failed to fetch roll numbers.');
        }
      });
    } else {
      $('#rollNo').html('<option value="">Select Roll No.</option>');
    }
  });

  $('#class, #section').trigger('change');
});
</script>

</head>
<body>

  <?php $this->load->view('header'); ?>

  <main>
    <div>
      <div class="searchSection">
        <form method="post" action="<?= base_url('auth/teacherSearch'); ?>">

          <label for="class">Class:
            <?php $selectedClass = $this->input->post('class'); ?>
              <select name="class" id="class" required>
                <option value="">Select Class</option>
                <option value="10" <?= ($selectedClass == "10") ? 'selected' : '' ?>>10</option>
                <option value="11" <?= ($selectedClass == "11") ? 'selected' : '' ?>>11</option>
              </select>
          </label>

          <label for="section">Section:
            <?php $selectedSection = $this->input->post('section'); ?>
            <select name="section" id="section">
              <option value="">Select Section</option>
              <option value="A" <?= ($selectedSection == "A") ? 'selected' : '' ?>>A</option>
              <option value="B" <?= ($selectedSection == "B") ? 'selected' : '' ?>>B</option>
              <option value="C" <?= ($selectedSection == "C") ? 'selected' : '' ?>>C</option>
            </select>
          </label>

          <!--<label for="subject">Subject:
            <?php $selectedSubject = $this->input->post('subject'); ?>
            <select name="subject" id="subject">
              <option value="">Select Subject</option>
              <option value="English" <?= ($selectedSubject == "English") ? 'selected' : '' ?>>English</option>
              <option value="Science" <?= ($selectedSubject == "Science") ? 'selected' : '' ?>>Science</option>
              <option value="Social Science" <?= ($selectedSubject == "Social Science") ? 'selected' : '' ?>>Social Sci</option>
              <option value="Math" <?= ($selectedSubject == "Math") ? 'selected' : '' ?>>Math</option>
              <option value="Hindi" <?= ($selectedSubject == "Hindi") ? 'selected' : '' ?>>Hindi</option>
              <option value="Physics" <?= ($selectedSubject == "Physics") ? 'selected' : '' ?>>Phys</option>
              <option value="Chemistry" <?= ($selectedSubject == "Chemistry") ? 'selected' : '' ?>>Chem</option>
              <option value="Biology" <?= ($selectedSubject == "Biology") ? 'selected' : '' ?>>Bio</option>
              <option value="History" <?= ($selectedSubject == "History") ? 'selected' : '' ?>>His</option>
              <option value="Political Science" <?= ($selectedSubject == "Political Science") ? 'selected' : '' ?>>Pol Sci</option>
              <option value="Geography" <?= ($selectedSubject == "Geography") ? 'selected' : '' ?>>Geo</option>
              <option value="Econimics" <?= ($selectedSubject == "Econimics") ? 'selected' : '' ?>>Eco</option>
            </select>
          </label>-->

          <!-- <label>Roll No.
            <?php $selectedRollNo = $this->input->post('roll_no'); ?>
            <input type="integer" name = "roll_no" <?= ($selectedSection == "A") ? 'selected' : '' ?>>
          </label> -->

          <label> Roll No.
            <select id="rollNo" name="rollNo">
              <option value="">Select Roll No.</option>
            </select> 
          </label>

          <button class="button1" type="submit">Search</button>
        </form>
      </div>

      <?php $isSearchTriggered = $this->input->post('class'); ?>
      <?php if ($isSearchTriggered): ?>
      <div class="container">
        <?php if (!empty($t_data)) { ?>
          <p><strong>Roll No:</strong> <?= $t_data[0]['roll_no']; ?></p>
          <p><strong>Name:</strong> <?= $t_data[0]['name']; ?></p>
          <p><strong>Email:</strong> <?= $t_data[0]['email']; ?></p>
          <?php if (validation_errors()) : ?>
        <div class="error">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
          <form method="post" action="<?= base_url('auth/updateMarks'); ?>">
            <input type="hidden" name="rollNo" value="<?= $t_data[0]['roll_no']; ?>">
            <input type="hidden" name="class" value="<?= $t_data[0]['class']; ?>">
            <input type="hidden" name="section" value="<?= $t_data[0]['section']; ?>">
            <table>
              <tr>
                <th>S.No.</th>
                <!-- <th>Roll No.</th> -->
                 <th>Subject Code</th>
                <th>Subject</th>
                <th>Marks</th>
              </tr>
              <?php $sno = 1; ?>
              <?php foreach ($t_data as $row): ?>
              <tr>
                <td><?= $sno++; ?></td>
                <td><?= $row['subject']; ?></td>
                <td><?= $row['subjName']; ?></td>
                <?php $subject = $row['subject']; ?>
                <td>
                  <input type="text" name="marksArr[<?= $subject ?>]" value="<?= $row['marks']; ?>" required>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
            <div style="text-align:right; margin-top: 20px;">
              <button type="submit" class="uploadBtn">Upload</button>
            </div>
          </form>
        <?php } else { ?>
          <p class="no-records">No records found.</p>
        <?php } ?>
      </div>
      <?php endif; ?>

    </div>
  </main>
  <div class="footer">
    <?php $this->load->view('footer'); ?>
  </div>
</body>
</html>
