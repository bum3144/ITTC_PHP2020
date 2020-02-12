<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Edit</title>
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
        label { 
            display: inline-block; 
            margin-top : 10px;
            color: #999999;
        }
        img{ 
            width: 200px;
            margin: 5px;
        }
	</style>
</head>
<body>
<?php
$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
$stmt = $pdo->prepare('SELECT * FROM application WHERE id = ?');
$stmt->execute([ $id ]);
$item = $stmt->fetch();

($item['gender']== 'm') ? $gender = 'Man' : $gender = 'Woman';
($item['literate']== 'y') ? $literate = 'Yes' : $literate = 'No';
switch ($item['level']) {
    case 1:
        $level = 'Beginner user';
        break;             
    case 2:
        $level = 'Advanced user';
        break;
    default:
        $level = 'Expert user';        
}
($item['employed']== 'y') ? $employed = 'Yes' : $employed = 'No';


?>
    <div class="container">

        <div class="row">
            <div id="aside" class="col-12">
                <h3 id="top_title">IT Training Center [ APPLICATION FORM ]</h3>
            </div>
        </div>

        <div class="row">
            <div class="part col-12"> 
                <hr>
                <p class="sub_title">I. PERSONAL DATA : </p> 

                <label for="ex_file">Picture upload :</label> <br>
                    <img src="<?=$item['upload'];?>" alt=""> <br>            
                <label>ID :</label> 
                    <?=$item['id'];?> <br>            
                <label>Name :</label> 
                    <?=$item['name'];?> <br>
                <label>Cellphone Number :</label> 
                    <?=$item['cellphone'];?><br>
                <label>Address :</label> 
                    <?=$item['address'];?><br>
                <label>Birthday :</label> 
                    <?=$item['birthday'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>Age :</label> 
                    <?=$item['age'];?><br>
                <label>Gender :</label>  
                    <?=$gender;?>  &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Height :</label> <?=$item['height'];?> Cm &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Weight :</label> <?=$item['weight'];?> Kg <br>
                <label>Civil Status :</label> <?=$item['civil'];?> <br>
                <label>Name of Spouse (If married) :</label> <?=$item['spouse'];?> <br>
                <label>Number of Children (If have) :</label> <?=$item['children'];?> <br>
                <label>Religious Affiliation :</label> <?=$item['religious'];?> <br>
                <label>Name of Pastor :</label> <?=$item['pastor'];?> <br>
                
            </div>
            
            <div class="part col-12">
                <hr>
                <p class="sub_title">II. EDUCATIONAL BACKGROUND : </p>

                <label>Elementary : </label> <?=$item['elementary'];?> &nbsp;&nbsp;
                <label>Year : </label> <?=$item['eyear'];?><br>
                <label>High School : </label> <?=$item['highschool'];?> &nbsp;&nbsp;
                <label>Year : </label> <?=$item['hyear'];?><br>
                <label>College : </label> <?=$item['college'];?> &nbsp;&nbsp;
                <label>Year : </label> <?=$item['cyear'];?><br>
                <label>Post Graduate : </label> <?=$item['postgraduate'];?> &nbsp;&nbsp;
                <label>Year : </label> <?=$item['pyear'];?><br>
                <label>Special Skills : </label> <?=$item['skills'];?> <br>
            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">III. QUESTIONS : </p>
                
                <label>1. Are you a computer literate? </label>  
                    <?=$literate;?> <br>
                
                <label>2. How long have you been using the computer? </label>  <br>
                    <?=$item['computeryear'];?> Years &nbsp;&nbsp;   
                    <?=$item['computermonth'];?> Months <br>

                <label>3. If you rate your computer skills, Kindly check : </label> 
                    <?=$level;?> <br>
                
                <label>4. Are you currently employed? </label>  
                <?=$employed;?> <br>

                <label>5. (4 - If yes) Name of Company? </label>  <br>
                <label>Company :</label> <?=$item['company'];?>  &nbsp;&nbsp;&nbsp;&nbsp; 
                <label>Position :</label> <?=$item['position'];?> <br>

            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">IV. CHARACTER REFERENCES : </p>
                <label>Name 1 : </label> <?=$item['cname1'];?><br>
                <label>Address :</label> <?=$item['caddress1'];?><br>
                <label>Name 2 : </label> <?=$item['cname2'];?><br>
                <label>Address :</label> <?=$item['caddress2'];?><br>
            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">V. Person to be contacted in case of emergency : </p>
                <label>Name: </label> 
                    <?=$item['ename'];?> <br>
                <label>Contart Number :</label> 
                    <?=$item['enumber'];?><br>
            </div>
        </div>  
        <div class="part col-12">
    <?php
        $id = $_GET['id'];

        $pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
        $stmt = $pdo->prepare('SELECT * FROM application WHERE id = ?');
        $stmt->execute([ $id ]);
        $item = $stmt->fetch();

    ?>        
            <hr>
            
            <form id="delete-form" action="application_delete.php" method="post">
                <input type="hidden" name="id" value="<?=$item['id'] ?>" />
                <input type="button" value="List" class="btn btn-success" onclick="window.location='application_list.php';"> 
                <input type="button" value="Edit" class="btn btn-warning" onclick="window.location='application.php?id=<?=$item[id];?>';"> 
                <input type="submit" value="Delete" class="btn btn-danger">

            </form>

        </div>
    </div>
    <script>
        $(function() {
            $('#delete-form').submit(function(event) {
                if (!confirm('Do you REALLY want to delete this?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>











</head>
<body>



</body>
</html>