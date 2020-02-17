<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'zxcv1234');
$stmt = $pdo->prepare('SELECT * FROM example13_member');
$stmt->execute();
$list = $stmt->fetchAll();
    ?>
    <a href="example13_member.php">Create Member</a>
    <table>
        <thead>
            <tr>
                <th>UserID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item) { ?>
            <tr>
                <td><a href="example13_view.php?id=<?=$item['id']?>"><?=$item['userid'] ?></a></td>
                <td><?=$item['firstname'] ?> <?=$item['middlename'] ?> <?=$item['lastname'] ?></td>
                <td><?=$item['birthday'] ?></td>
                <td><?=$item['address'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>