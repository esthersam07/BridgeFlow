<?php if (!empty($sm_data)): ?>
    <?php foreach ($sm_data as $row): ?>
        <?php $imageURL = 'uploads/' . $row["upload_link"]; ?>
        <p><?= $imageURL; ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>No files found...</p>
<?php endif; ?>