<?php
class DatabaseTable
{
    // // 01. public 변수는 언제 어디서나 새로 값을 설정할 수 잇어서 문제가 된다
    // public $pdo;
    // public $table;
    // public $primaryKey;

    // 02. private 으로 설정하면 클래스 외부에서 해당 변수를 읽거나 쓸 수 없다
    private $pdo;
    private $table;
    private $primaryKey;

    // __construct() 이 함수는 클래스 인스턴스가 생성될 때마다 자동으로 실행된다.
    // 타입힌트를 지정하려면 변수명 앞에 타입명을 쓴다.
    public function __construct(PDO $pdo, string $table, string $primaryKey){
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    /* query */ 
    private function query($sql, $parameters = []){
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /* get the all table row(number) */
    public function total(){
        $query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    /* get the table data by ID */
    public function findById($value){
        $query = 'SELECT * FROM `' . $this->table . '` 
            WHERE `' . $this->primaryKey . '` = :value';

        $parameters = [
            'value' => $value
        ];

        $query = $this->query($query, $parameters);

        return $query->fetch();
    }

    /* insert table data */
    private function insert($fields){
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach($fields as $key => $value){
            $query .= '`' . $key . '`,'; 
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';

        foreach($fields as $key => $value){
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ')';
        
        $fields = $this->processDates($fields);

        $this->query($query, $fields);
    }


    /* update table data */
    private function update($fields){
        $query = 'UPDATE `' . $this->table . '` SET ';

        foreach($fields as $key => $value){
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        
        // :primaryKey 변수 설정
        $fields['primaryKey'] = $fields['id'];

        $fields = $this->processDates($fields);

        $this->query($query, $fields);
    }

    /* delete table data */
    public function delete($id){
        $parameters = [':id' => $id ];

        $this->query($pdo, 'DELETE FROM `' . $this->table . '` 
            WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }

    /* get the all table data */
    private function findAll(){
        $result = $this->query('SELECT * FROM `' . $this->table . '`');

        return $result->fetchAll();
    }

    /* date type */
    private function processDates($fields){
        foreach ($fields as $key => $value){
            // $value가 DateTime 객체라면...
            if($value instanceof DateTime){
                // Y-m-d H:i:s 형식으로 변환해라
                $fields[$key] = $value->format('Y-m-d H:i:s');
            }
        }    
        return $fields;
    }

    /* (insert data) or (edit data) */
    public function save($record) {
        try{
            if($record[$this->primaryKey] == '') {    // 기본키는 대부분 INT며 정수만 허용. 빈문자열을 전달하면 오류가 발생한다.
                $record[$this->primaryKey] = null;   // null을 지정하면 auto_increment 기능이 실행된다
            }
            $this->insert($record);
        }catch (PDOException $e){
            $this->update($record);
        }
    } 

}

// 전체가 PHP 코드일 때는 종료 태크 ? > 를 생략하는 편이 좋다. 종료 태그 다음에 빈 줄, 탭, 공백 및 문자가 있으면 브라우저로 전송된다.
// 종료 태크가 없으면 마지막 공백 문자들을 알아서 무시한다 