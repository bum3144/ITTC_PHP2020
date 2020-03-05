<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Form</title>
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
        .submit{
            text-align: center;
        }
	</style>
</head>
<body>
<?php
    $id = $_GET['id'];
    if ($id) {
        $pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');
        $stmt = $pdo->prepare('SELECT * FROM application WHERE id = ?');
        $stmt->execute([ $id ]);
        $item = $stmt->fetch();
    } else {
        $item = [];
    }
?>
    <div class="container">

        <div class="row">
            <div id="aside" class="col-12">
                <h3 id="top_title">IT Training Center [ APPLICATION FORM ]</h3>
            </div>
        </div>


        <div class="part col-12">
                <hr>
                <input type="button" value="Application List" class="btn btn-success" onclick="window.location='application_list.php';"> 
        </div>

        <form method="post" action="application_action.php" name="applyform" enctype="multipart/form-data">
        <div class="row">
            <div class="part col-12"> 
                <hr>
                <p class="sub_title">I. PERSONAL DATA : </p> 

                <p>( <span class="glyphicon glyphicon-asterisk"></span> Required fields )</p><br>
                    <input type="hidden" name="id" value="<?=$item['id'];?>" />
                <label for="ex_file">Picture upload :</label> 
                    <input type="file" name="img_select" id="img_select"><br>

                <script>
                $('#img_select').change(function(){
                    setImageFromFile(this, '#imgbox');
                });
                
                function setImageFromFile(input, expression) {
                    if (input.files && input.files[0])
                    {
                        var reader = new FileReader();
                
                            reader.onload = function (e) {
                                $(expression).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                </script>
                
                
                <label><span class="glyphicon glyphicon-asterisk"></span> Name :</label> 
                    <input type="text" name="uname" size="40" placeholder="full name" value="<?=$item['name'];?>" required><br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Cellphone Number :</label> 
                    <input type="number" name="cellphone" id="issuedate" maxlength="13" value="<?=$item['cellphone'];?>" required> ( with out '&boxh;' )<br>
                <label><span class="glyphicon glyphicon-asterisk"></span> Address :</label> 
                    <input type="text" name="address" size="60" value="<?=$item['address'];?>" required><br>      
                <label><span class="glyphicon glyphicon-asterisk"></span> Birthday :</label> 
                    <input type="date" name="birthday" id="birthday" value="<?=$item['birthday'];?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
                <label><span class="glyphicon glyphicon-asterisk"></span> Age :</label> 
                    <input type="number" name="age" id="age" min="20" max="33" value="<?=$item['age'];?>"><br>

                <script> 
                    // $("#birthday").change(function(){
                    //     var today = new Date();
                    //     var birthDate = new Date($('#birthday').val());
                    //     var age = today.getFullYear() - birthDate.getFullYear();
                    //     //alert(age);
                    //     var m = today.getMonth() - birthDate.getMonth();
                    //     if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    //         age--;
                    //     }
                    //     if (age <= 0){
                    //         alert("Your birthday is wrong! select again..!");
                    //         return false;
                    //     }
                    //     return $('#age').val(age);
                    // });   

                </script>

               
                <label><span class="glyphicon glyphicon-asterisk"></span> Gender - </label>  
                Man <input type="radio" name="gender" id="gender" value="m" <?php if($item['gender']=='m') {echo 'checked';}?>>  &nbsp;&nbsp; 
                Woman <input type="radio" name="gender" id="gender" value="w" <?php if($item['gender']=='w') {echo 'checked';}?>><br>
                <label>Height :</label> <input type="number" name="Height" maxlength="3" value="<?=$item['height'];?>"> Cm &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Weight :</label> <input type="number" name="Weigth" maxlength="3" value="<?=$item['weight'];?>"> Kg <br>
                <label>Civil Status :</label> <input type="text" name="civil" size="40" placeholder="your country" value="<?=$item['civil'];?>"> <br>
                <label>Name of Spouse (If married) :</label> <input type="text" name="spouse" value="<?=$item['spouse'];?>"> <br>
                <label>Number of Children (If have) :</label> <input type="number" name="children" value="<?=$item['children'];?>"> <br>
                <label>Religious Affiliation :</label> <input type="text" name="religious" value="<?=$item['religious'];?>"> <br>
                <label>Name of Pastor :</label> <input type="text" name="pastor" value="<?=$item['pastor'];?>"> <br>
                
            </div>
            
            <div class="part col-12">
                <hr>
                <p class="sub_title">II. EDUCATIONAL BACKGROUND : </p>

                <label>Elementary : </label> <input type="text" name="elementary" size="40" value="<?=$item['elementary'];?>"> &nbsp;&nbsp;
                <label>Year : </label> <input type="number" name="eyear" maxlength="4" value="<?=$item['eyear'];?>"><br>
                <label>High School : </label> <input type="text" name="highschool" size="40" value="<?=$item['highschool'];?>"> &nbsp;&nbsp;
                <label>Year : </label> <input type="number" name="hyear" maxlength="4" value="<?=$item['hyear'];?>"><br>
                <label>College : </label> <input type="text" name="college" size="40" value="<?=$item['college'];?>"> &nbsp;&nbsp;
                <label>Year : </label> <input type="number" name="cyear" maxlength="4" value="<?=$item['cyear'];?>"><br>
                <label>Post Graduate : </label> <input type="text" name="postgraduate" size="40" value="<?=$item['postgraduate'];?>"> &nbsp;&nbsp;
                <label>Year : </label> <input type="number" name="pyear" maxlength="4" value="<?=$item['pyear'];?>"><br>
                <label>Special Skills : </label> <textarea name="skills" rows="4" cols="70"><?=$item[skills]?></textarea> <br>
            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">III. QUESTIONS : </p>
                
                <label>1. Are you a computer literate? </label>  
                YES <input type="radio" name="literate" value="y" <?php if($item['literate']=='y') {echo 'checked';}?>> &nbsp;&nbsp;   
                NO <input type="radio" name="literate" value="n" <?php if($item['literate']=='n') {echo 'checked';}?>> <br>
                
                <label>2. How long have you been using the computer? </label>  <br>
                <input type="number" name="useyear" min=0 max=50 value="<?=$item['computeryear'];?>"> Years &nbsp;&nbsp;   
                <input type="number" name="usemonth" min=0 max=12 value="<?=$item['computermonths'];?>"> Months <br>

                <label>3. If you rate your computer skills, Kindly check : </label> 
                (1) Beginner user <input type="radio" name="level" value="1" <?php if($item['level']=='1') {echo 'checked';}?>> &nbsp;&nbsp;&nbsp;&nbsp;
                (2) Advanced user <input type="radio" name="level" value="2" <?php if($item['level']=='2') {echo 'checked';}?>> &nbsp;&nbsp;&nbsp;&nbsp; 
                (3) Expert user <input type="radio" name="level" value="3" <?php if($item['level']=='3') {echo 'checked';}?>> <br>
                
                <label>4. Are you currently employed? </label>  
                YES <input type="radio" name="employed" value="y" <?php if($item['employed']=='y') {echo 'checked';}?>> &nbsp;&nbsp;   
                NO <input type="radio" name="employed" value="n"  <?php if($item['employed']=='n') {echo 'checked';}?>> <br>

                <label>5. (4 - If yes) Name of Company? </label>  <br>
                Company <input type="text" name="company" placeholder="Company Name" value="<?=$item['company'];?>"> 
                Position <input type="text" name="position" placeholder="position" value="<?=$item['position'];?>"> <br>

            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">IV. CHARACTER REFERENCES : </p>
                <label>Name 1 : </label> <input type="text" name="rname1" size="40" placeholder="full name" value="<?=$item['cname1'];?>"><br>
                <label>Address :</label> <input type="text" name="raddress1" size="60" value="<?=$item['caddress1'];?>"><br>
                <label>Name 2 : </label> <input type="text" name="rname2" size="40" placeholder="full name" value="<?=$item['cname2'];?>"><br>
                <label>Address :</label> <input type="text" name="raddress2" size="60" value="<?=$item['caddress2'];?>"><br>
            </div>

            <div class="part col-12">
                <hr>
                <p class="sub_title">V. Person to be contacted in case of emergency : </p>
                <label><span class="glyphicon glyphicon-asterisk"></span> Name: </label> 
                    <input type="text" name="ername" size="40" placeholder="full name" value="<?=$item['ename'];?>" required>
                <label><span class="glyphicon glyphicon-asterisk"></span> Contart Number :</label> 
                    <input type="number" name="ernumber" size="60" maxlength="13" value="<?=$item['enumber'];?>" required> ( with out '&boxh;' )<br>
            </div>

            <div class="part col-12 submit">
                <hr>
                <input type="submit" value="Save Data" class="btn btn-warning">
            </div>

        </div>
        </form>


    </div>



</body>
</html>