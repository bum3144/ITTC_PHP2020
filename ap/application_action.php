    <?php
        // file
        $uploads_dir = ' ';

        $img_select = $_FILES['img_select']['name'];


        $uname = $_POST[uname];
        $cellphone = $_POST[cellphone];
        $address = $_POST[address];
        $birthday = $_POST[birthday];
        $age = $_POST[age];
        $gender = $_POST[gender];
        $Height = $_POST[Height];
        $Weigth = $_POST[Weigth];
        $civil  = $_POST[civil];
        $spouse  = $_POST[spouse];
        $children  = $_POST[children];
        $religious  = $_POST[religious];
        $pastor  = $_POST[civpastoril];
        $elementary  = $_POST[elementary];
        $eyear  = $_POST[eyear];
        $highschool  = $_POST[highschool];
        $hyear  = $_POST[hyear];
        $college  = $_POST[college];
        $cyear  = $_POST[cyear];
        $postgraduate  = $_POST[postgraduate];
        $pyear  = $_POST[pyear];
        $skills  = $_POST[skills];


       echo $img_select ."<br>";

       echo $uname ."<br>";
       echo  $cellphone ."<br>";
       echo  $address ."<br>";
       echo  $birthday ."<br>";
       echo  $agev ."<br>";
       echo  $gender ."<br>";
       echo  $Height ."<br>";
       echo  $Weigth ."<br>";
       echo  $civil ."<br>";
       echo  $spouse ."<br>";
       echo  $children ."<br>";
       echo  $religious ."<br>";
       echo  $pastor ."<br>";
       echo  $elementary ."<br>";
       echo  $eyear ."<br>";
       echo  $highschool ."<br>";
       echo  $hyear ."<br>";
       echo  $college ."<br>";
       echo  $cyear ."<br>";
       echo  $postgraduate ."<br>";
       echo  $pyear ."<br>";
       echo  $skills ."<br>";






        exit;




        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'zxcv1234');

        if ($id) {
            // edit record
            $sql = 'UPDATE example13_member
                SET userid = :userid,
                firstname = :firstname,
                middlename = :middlename,
                lastname = :lastname,
                birthday = :birthday,
                address = :address,
                post = :post';
            if ($userpw) {
                $sql .= ',password = :password';
            }
            $sql .= ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $params = [
                'userid' => $userid,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname,
                'birthday' => $birth,
                'address' => $address,
                'post' => $post,
                'id' => $id,
            ];
            if ($userpw) {
                $params['password'] = $userpw;
            }
            $stmt->execute($params);
        } else {
            // create new record
            $stmt = $pdo->prepare('INSERT INTO example13_member (
                userid, password, firstname, middlename, lastname, birthday, address, post
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?
            )');
            $stmt->execute([ $userid, $userpw, $firstname, $middlename, $lastname, $birth, $address, $post ]);
    
        }
        print_r($stmt->errorInfo());
        echo 'USER ID : ' . $userid .'<br>';
        echo 'PASSWORD : ' . $userpw .'<br>';
        echo 'PASSWORD CHECK : ' . $userpw2 .'<br>';
        echo 'FIRST NAME : ' . $firstname .'<br>';
        echo 'MIDDLE NAME : ' . $middlename .'<br>';
        echo 'LAST NAME : ' . $lastname .'<br>';
        echo 'BIRTHDAY : ' . $birth .'<br>';
        echo 'ADDRESS : ' . $address .'<br>';
        echo 'POST NUMBER : ' . $post .'<br>';
    ?>