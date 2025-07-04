<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All</title>
</head>
<body>
    <h1>These are all the users</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <tbody>
            <?php foreach ($all_data as $row):?>
                <tr class="trow">
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['password']; ?></td>
        </tr>

            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</body>
</html>