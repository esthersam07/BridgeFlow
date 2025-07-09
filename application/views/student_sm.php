<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Study Material Corner</title>
  <link rel="stylesheet" href="<?= base_url('application/views/student_sm_style.css'); ?>">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>

<body>

  <?php $this->load->view('header'); ?>

  <main>
    <div class="contentWrapper">
      <div class="searchSection">
        <h2>View Study Material</h2>
        <form method="post" action="<?= base_url('auth/studentSMSearch'); ?>">

          <label for="class">Class: <?= $class;?>
            <input name="class" id="class" value ="<?= $class;?>" type="hidden">
          </label>

          <label for="section">Section: <?= $section;?>
            <input name="section" id="section" value="<?= $section;?>" type="hidden">
          </label>
        <label> Subject:
            <select id="subject" name="subject" required>
                <option value="">Select Subject</option>
                <?php $selectedSubject = $_POST['subject'] ?? ''; 
                foreach ($subjects as $subject) {
                  $selected = ($subject == $selectedSubject) ? 'selected' : '';
                  echo "<option value='" . htmlspecialchars($subject) . "' $selected>" . htmlspecialchars($subject) . "</option>";
                }
                ?>
            </select>
        </label>

          <div style="width: auto; margin-top:28px;">
  <button class="button1" type="submit">Search</button>
</div>

        </form>
      </div>

      <?php if (!empty($this->input->post('subject'))): ?>
        <div class="container">
          <div class="uploads">
            <h3>Uploaded Materials</h3>
            <!-- <h4>Subject : <?=$subject?></h4> -->
            <?php $sno = 1;
            if (!empty($t_data)) { ?>
              <table>
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Upload Date</th>
                    <th>Uploaded By</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($t_data as $upload): ?>
                    <tr>
                      <td><?= $sno++; ?></td>
                      <td><?= $upload['title']; ?></td>
                      <td><?= $upload['description']; ?></td>
                      <td><?= date('d M Y', strtotime($upload['upload_date'])) ?></td>
                      <td><?= $upload['uploaded_by']; ?></td>
                      <td><a href="<?= base_url('uploads/' . $upload['upload_link']) ?>" target="_blank">View</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php } else { ?>
              <p class="no-records">No Uploads.</p>
            <?php } ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <div class="footer">
    <?php $this->load->view('footer'); ?>
  </div>

</body>
</html>
