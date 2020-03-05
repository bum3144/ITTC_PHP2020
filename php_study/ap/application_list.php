<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style>
		body{
			width: 960px;
			margin: 0 auto;
            margin-top: 50px;
            margin-bottom: 50px;
		}
        .container{
            border: 1px solid black;
            margin-top: 100px;
            padding: 50px;
        }
        #aside{
            height: 100px;
        }
        #top_title{
            text-align: center;
        }
        .sub_title{
            font-weight: bold;
        }
        img{ 
            width: 50px;
            margin: 5px;
        }
	</style>
</head>
<body>
    <?php
        $pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
        $stmt = $pdo->prepare('SELECT * FROM application');
        $stmt->execute();
        $list = $stmt->fetchAll();
    ?>

    <div class="container">

        <div class="row">
            <div id="aside" class="col-12">
                <h3 id="top_title">IT Training Center [ APPLICATION List ]</h3>
            </div>
        </div>

        <div class="row">
            <div class="part col-12"> 
                <hr>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Name</th>
                            <th scope="col">birthday</th>
                            <th scope="col">address</th>
                            <th scope="col">age</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $item) { ?>
                        <tr>
                            <th scope="row"><?=$item['id'] ?></th>
                            <td><a href="application_view.php?id=<?=$item['id'];?>"><img src="<?=$item['upload'];?>" alt=""></a></td>
                            <td><a href="application_view.php?id=<?=$item['id'];?>"><?=$item['name'];?></a></td>
                            <td><?=$item['birthday'];?></td>
                            <td><?=$item['address'];?></td>
                            <td><?=$item['age'];?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="part col-12">
                <input type="button" value="Create Application" class="btn btn-primary" onclick="window.location='application.php';"> 
        </div>

    </div>

</body>
</html>