<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


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

                <label for="ex_file">Picture upload :</label> <input type="file" name="img_select" id="img_select"><br>
              
                <label><span class="glyphicon glyphicon-asterisk"></span> Name :</label> 
                    <?=$item['name'];?> <br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Cellphone Number :</label> 
                    <?=$item['cellphone'];?><br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Address :</label> 
                    <?=$item['address'];?><br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Birthday :</label> 
                    <?=$item['birthday'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                <label><span class="glyphicon glyphicon-asterisk"></span> Age :</label> 
                    <?=$item['age'];?><br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Gender :</label>  
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
                <label><span class="glyphicon glyphicon-asterisk"></span> Name: </label> 
                    <?=$item['ename'];?> <br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Contart Number :</label> 
                    <?=$item['enumber'];?><br>
            </div>



        </div>
        


    </div>



</body>
</html>











</head>
<body>
    <?php
    $id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
$stmt = $pdo->prepare('SELECT * FROM example13_member WHERE id = ?');
$stmt->execute([ $id ]);
$item = $stmt->fetch();

echo 'USER ID : ' . $item['userid'] .'<br>';
echo 'PASSWORD : ' . $item['password'] .'<br>';
echo 'FIRST NAME : ' . $item['firstname'] .'<br>';
echo 'MIDDLE NAME : ' . $item['middlename'] .'<br>';
echo 'LAST NAME : ' . $item['lastname'] .'<br>';
echo 'BIRTHDAY : ' . $item['birthday'] .'<br>';
echo 'ADDRESS : ' . $item['address'] .'<br>';
echo 'POST NUMBER : ' . $item['post'] .'<br>';
    ?>
    <a href="example13_member.php?id=<?=$item['id'] ?>">Edit</a>
    <form id="delete-form" action="example13_member_delete.php" method="post">
        <input type="hidden" name="id" value="<?=$item['id'] ?>" />
        <button type="submit">Delete</button>
    </form>
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