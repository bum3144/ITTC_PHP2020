    <?php
        // file
        // $uploads_dir = ' ';
        // $img_select = $_FILES['img_select']['name'];
        //ini_set("display_errors", "1");
        $filepath = null;
        if ($_FILES['img_select']['error'] === UPLOAD_ERR_OK) {
            // $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';      
            $uploaddir = '/uploads/';      
            $uploadfile = $uploaddir . basename($_FILES['img_select']['name']);    
            
            if (!is_dir($uploaddir)) {
                mkdir($uploaddir);
            }
    
            // print_r($_FILES);   
    
            if (move_uploaded_file($_FILES['img_select']['tmp_name'], $uploadfile)) {        
              //  echo "file upload success.";
              $filepath = '/uploads/'.basename($_FILES['img_select']['name']);
            } else {        
                echo 'files infomation:';        
                print_r($_FILES);      
            }
        }       
        
// echo $uploadfile ; exit;
// echo $filepath; exit;
        $id = $_POST['id'];
         $uname = $_POST['uname'];
        $cellphone = $_POST['cellphone'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $height = $_POST['height'];
        $weigth = $_POST['weigth'];
        $civil  = $_POST['civil'];
        $spouse  = $_POST['spouse'];
        $children  = $_POST['children'];
        $religious  = $_POST['religious'];
        $pastor  = $_POST['pastor'];
        $elementary  = $_POST['elementary'];
        $eyear  = $_POST['eyear'];
        $highschool  = $_POST['highschool'];
        $hyear  = $_POST['hyear'];
        $college  = $_POST['college'];
        $cyear  = $_POST['cyear'];
        $postgraduate  = $_POST['postgraduate'];
        $pyear  = $_POST['pyear'];
        $skills  = $_POST['skills'];
        $literate  = $_POST['literate'];
        $useyear  = $_POST['useyear'];
        $usemonth  = $_POST['usemonth'];
        $level  = $_POST['level'];
        $employed  = $_POST['employed'];
        $company  = $_POST['company'];
        $position  = $_POST['position'];
        $rname1  = $_POST['rname1'];
        $raddress1  = $_POST['raddress1'];
        $rname2  = $_POST['rname2'];
        $raddress2  = $_POST['raddress2'];
        $ername  = $_POST['ername'];
        $ernumber  = $_POST['ernumber'];    

        $pdo = new PDO('mysql:host=localhost;dbname=phpStudy', 'root', 'abde1245');

        if ($id) {
            // edit record
            $sql = 'UPDATE application
                SET name = :uname,
                cellphone = :cellphone,
                address = :address,
                birthday = :birthday,
                age = :age,
                gender = :gender,
                height = :height,
                weight = :weight,
                civil = :civil,
                spouse = :spouse,
                children = :children,
                religious = :religious,
                pastor = :pastor,
                elementary = :elementary,
                eyear = :eyear,
                highschool = :highschool,
                hyear = :hyear,
                college = :college,
                cyear = :cyear,
                postgraduate = :postgraduate,
                pyear = :pyear,
                skills = :skills,
                literate = :literate,
                computeryear = :computeryear,
                computermonths = :computermonths,
                level = :level,
                employed = :employed,
                company = :company,
                position = :position,
                cname1 = :cname1,
                caddress1 = :caddress1,
                cname2 = :cname2,
                caddress2 = :caddress2,
                ename = :ename,
                enumber = :enumber';
            if ($filepath) {
                $sql .= ',upload = :upload';
            }
            $sql .= ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $params = [
                'uname' => $uname,
                'cellphone' => $cellphone,
                'address' => $address,
                'birthday' => $birthday,
                'age' => $age,
                'gender' => $gender,
                'height' => $height,
                'weigth' => $weigth,
                'civil' => $civil,
                'spouse' => $spouse,
                'children' => $children,
                'religious' => $religious,
                'pastor' => $pastor,
                'elementary' => $elementary,
                'eyear' => $eyear,
                'highschool' => $highschool,
                'hyear' => $hyear,
                'college' => $college,
                'cyear' => $cyear,
                'postgraduate' => $postgraduate,
                'pyear' => $pyear,
                'skills' => $skills,
                'literate' => $literate,
                'computeryear' => $useyear,
                   'computermonths' => $usemonth,
                'level' => $level,
                'employed' => $employed,
                'company' => $company,
                'position' => $position,
                'cname1' => $rname1,
                'caddress1' => $raddress1,
                'cname2' => $rname2,
                'caddress2' => $raddress2,
                'ename' => $ername,
                'enumber' => $ernumber,
                'id' => $id,
            ];
            if ($filepath) {
                $params['upload'] = $filepath;
            }
            $stmt->execute($params);



        } else {
            // create new record

            $stmt = $pdo->prepare('INSERT INTO application (
                upload, name, cellphone, address, birthday, age, gender, height, weight, civil, spouse, children, religious, pastor, elementary,
                eyear, highschool, hyear, college, cyear, postgraduate, pyear, skills, literate, computeryear, computermonths, level, employed,
                company, position, cname1, caddress1, cname2, caddress2, ename, enumber
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )');

            $stmt->execute([ 
                $uploadfile, $uname, $cellphone, $address, $birthday, $age, $gender, $height, $weigth, $civil, $spouse, $children, $religious, $pastor, 
                $elementary, $eyear, $highschool, $hyear, $college, $cyear, $postgraduate, $pyear, $skills, $literate, $useyear, $usemonth, $level, 
                $employed, $company, $position, $rname1, $raddress1, $rname2, $raddress2, $ername, $ernumber
            ]);
    
    
     
        }
        print_r($stmt->errorInfo());
        
    ?>