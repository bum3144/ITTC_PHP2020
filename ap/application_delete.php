<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Delete</title>
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
        #top_title, #message{
            text-align: center;
        }
        .sub_title{
            font-weight: bold;
        }    
        
    </style>
</head>
<body>
    <?php
    $id = $_POST['id'];

    $pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
    $stmt = $pdo->prepare('DELETE FROM application WHERE id = ?');
    $stmt->execute([ $id ]);

  //  print_r($stmt->errorInfo());
    ?>




<div class="container">

<div class="row">
    <div id="aside" class="col-12">
        <h3 id="top_title">IT Training Center [ APPLICATION DELETE ]</h3>
    </div>
</div>

<div class="row">
    <div class="part col-12"> 
        <hr>
        <h1 id="message">Deleted successfully.</h1>
    </div>
    
    <div class="part col-12">
        <hr>
        <input type="button" value="List" class="btn btn-success" onclick="window.location='application_list.php';"> 
    </div>

</div>  

</body>
</html>