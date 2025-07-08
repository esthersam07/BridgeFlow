<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload Study Material</title>
  <link rel="stylesheet" href="<?= base_url('application/views/teacher_upload_sm_style.css'); ?>">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#class, #section').on('change', function () {
        let selectedClass = $('#class').val();
        let selectedSection = $('#section').val();

        if (selectedClass && selectedSection) {
          $.ajax({
            url: '<?= base_url("auth/getSubjects") ?>',
            type: 'POST',
            data: {
              class: selectedClass,
              section: selectedSection
            },
            success: function (response) {
              $('#subject').html(response);
            },
            error: function () {
              alert('Failed to fetch subjects.');
            }
          });
        } else {
          $('#subject').html('<option value="">Select Subject</option>');
        }
      });

      $('#class, #section').trigger('change');
    });
  </script>
</head>

<body>

  <?php $this->load->view('header'); ?>

  <main>
    <div class="contentWrapper">
      <div class="searchSection">
        <h2>Upload Study Material</h2>
        <form method="post" action="<?= base_url('auth/teacherUploadSearch'); ?>">

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
            <select name="section" id="section" required>
              <option value="">Select Section</option>
              <option value="A" <?= ($selectedSection == "A") ? 'selected' : '' ?>>A</option>
              <option value="B" <?= ($selectedSection == "B") ? 'selected' : '' ?>>B</option>
              <option value="C" <?= ($selectedSection == "C") ? 'selected' : '' ?>>C</option>
            </select>
          </label>

          <label> Subject:
            <select id="subject" name="subject" required>
              <option value="">Select Subject</option>
            </select>
          </label>

          <div style="width: auto; margin-top:28px;">
  <button class="button1" type="submit">Search</button>
</div>

        </form>
      </div>

      <?php if (!empty($this->input->post('class'))): ?>
        <h2>Subject : <?=$subject?></h2>
        <div class="container">
          <div class="uploads">
            <h3>Uploaded Materials</h3>
            <?php $sno = 1;
            if (!empty($t_data)) { ?>
              <table>
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Upload Date</th>
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
                      <td><a href="<?= base_url('uploads/' . $upload['upload_link']) ?>" target="_blank">View</a></td>
                      <td>
                        <form method="post" action="<?= base_url('auth/delete_sm'); ?>">
                          <input type="hidden" name="class" value="<?= $class; ?>">
                          <input type="hidden" name="section" value="<?= $section; ?>">
                          <input type="hidden" name="subject" value="<?= $subject; ?>">
                          <input type="hidden" name="id" value="<?= $upload['id']; ?>">
                          <button onclick="return confirm('Are you sure you want to DELETE this material?')">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php } else { ?>
              <p class="no-records">No Uploads.</p>
            <?php } ?>
          </div>

          <div class="upload">
            <h3>Upload New Material</h3>
            <form action="upload" method="post" enctype="multipart/form-data">
              <input type="hidden" name="class" value="<?= $class; ?>">
              <input type="hidden" name="section" value="<?= $section; ?>">
              <input type="hidden" name="subject" value="<?= $subject; ?>">
              <input type="hidden" name="subject_code" value="<?= $subjCode; ?>">
              <input type="hidden" name="by" value="<?= $this->session->userdata('user_id'); ?>">

              <table>
                <?php if (!empty($status)): ?>
                    <tr>
                      <td colspan="2" style="color: red; font-weight: bold; text-align: center;">
                        <?= htmlspecialchars($status) ?>
                      </td>
                    </tr>
                  <?php endif; ?>
                <tr>
                  <td>Title:<br><input type="text" name="title" required></td>
                </tr>
                <tr>
                  <td>Description:<br><input type="text" name="desc" required></td>
                </tr>
                <tr>
                  <td>Select File:<br><input type="file" name="file" required></td>
                </tr>
                <tr>
                  <td><input type="submit" name="submit" value="Upload"></td>
                </tr>
              </table>
            </form>
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
