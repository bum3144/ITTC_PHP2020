<?php
namespace Ittc;

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $constructorArgs;

    // stdClass는 php 내장 클래스며 빈 클래스다. 간단한 데이터를 저장하는 용도로 쓴다.
    // 클래스명 인수를 생략하면 기본적으로 stdClass가 저장된다
    public function __construct(\PDO $pdo, string $table, string $primaryKey, 
        string $className = '\stdClass', array $constructorArgs = []){
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
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
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

        $parameters = [
            'value' => $value
        ];

        $query = $this->query($query, $parameters);

        // return $query->fetch();
        return $query->fetchObject($this->className, $this->constructorArgs);
    }

    /* email 중복 체크를 위한 쿼리 */
    public function find($column, $value)
    {
        $query = 'SELECT * FROM '. $this->table . ' WHERE ' . $column . ' = :value';

        $parameters = [
            'value' => $value
        ];

        $query = $this->query($query, $parameters);

        return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
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

        $this->query('DELETE FROM `' . $this->table . '` 
            WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }

    /* get the all table data */
    public function findAll(){
        $result = $this->query('SELECT * FROM ' . $this->table);

        return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
    }

    /* date type */
    private function processDates($fields){
        foreach ($fields as $key => $value){
            // $value가 DateTime 객체라면...
            if($value instanceof \DateTime){
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
        }catch (\PDOException $e){
            $this->update($record);
        }
    } 

}

// 전체가 PHP 코드일 때는 종료 태크 ? > 를 생략하는 편이 좋다. 종료 태그 다음에 빈 줄, 탭, 공백 및 문자가 있으면 브라우저로 전송된다.
// 종료 태크가 없으면 마지막 공백 문자들을 알아서 무시한다 