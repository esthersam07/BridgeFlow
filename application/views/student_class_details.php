<!DOCTYPE html>
<html>
<head>
  <title>Student Class Details</title>
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
    }

    input,select {
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
  <script>
  function fetchSubjects() {
    const classVal = document.getElementById("class").value;
    const sectionVal = document.getElementById("section").value;

    if (!classVal || (classVal === "11" && !sectionVal)) {
      document.getElementById("subjectsContainer").innerHTML = '';
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "<?= base_url('auth/get_subjects') ?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (this.status === 200) {
        const subjects = JSON.parse(this.responseText);
        let html = "<label>Select All Subjects:</label><br>";
        subjects.forEach((subj, index) => {
          html += `
            <label>
              <input type="checkbox" name="subjects[]" value="${subj}" required> ${subj}
            </label><br>`;
        });
        document.getElementById("subjectsContainer").innerHTML = html;
      }
    };

    xhr.send(`class=${classVal}&section=${sectionVal}`);
  }
</script>

</head>
<body>
  <?php $this->load->view('header'); ?>

  <main>
    <div class="container">
      <h2>Enter Class Details</h2>

      <?php if (validation_errors()) : ?>
        <div class="error">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
        <?php $user_id = $this->session->userdata('user_id'); ?>

      <form method="post" action="<?= base_url('auth/studentClassDetails'); ?>">
        <label for="roll_no">Roll No:</label>
        <input type="text" name="roll_no" id="roll_no" value="<?= $user_id ?>" readonly>

        <label for="class">Class:</label>
        <select name="class" id="class" required onchange="fetchSubjects()">
            <option value="">Select Class</option>
            <option value="10">10</option>
            <option value="11">11</option>
        </select>

        <label for="section">Section:</label>
        <select name="section" id="section" onchange="fetchSubjects()" required>
            <option value="">Select Section</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        <div id="subjectsContainer">
        </div>

        <button type="submit">Submit Class Details</button>
      </form>
    </div>
  </main>

  <?php $this->load->view('footer'); ?>
</body>
</html>
