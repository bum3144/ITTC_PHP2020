<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application List</title>
</head>
<body>
    <?php

$pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
$stmt = $pdo->prepare('SELECT * FROM application');
$stmt->execute();
$list = $stmt->fetchAll();
    ?>
    <a href="application.php">Create Member</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>birthday</th>
                <th>address</th>
                <th>age</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item) { ?>
            <tr>
                <td><a href="application_view.php?id=<?=$item['id']?>"><?=$item['name'] ?></a></td>
                <td><?=$item['birthday'] ?></td>
                <td><?=$item['address'] ?></td>
                <td><?=$item['age'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>