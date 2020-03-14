<?php
class DatabaseTable
{
    /* query */ 
    private function query($pdo, $sql, $parameters = []){
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /* get the all table row(number) */
    public function total($pdo, $table){
        $query = $this->query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    /* get the table data by ID */
    public function findById($pdo, $table, $primaryKey, $value){
        $query = 'SELECT * FROM `' . $table . '` 
            WHERE `' . $primaryKey . '` = :value';

        $parameters = [
            'value' => $value
        ];

        $query = $this->query($pdo, $query, $parameters);

        return $query->fetch();
    }

    /* insert table data */
    private function insert($pdo, $table, $fields){
        $query = 'INSERT INTO `' . $table . '` (';

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
        
        $fields = processDates($fields);

        $this->query($pdo, $query, $fields);
    }


    /* update table data */
    private function update($pdo, $table, $primaryKey, $fields){
        $query = 'UPDATE `' . $table . '` SET ';

        foreach($fields as $key => $value){
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
        
        // :primaryKey 변수 설정
        $fields['primaryKey'] = $fields['id'];

        $fields = processDates($fields);

        $this->query($pdo, $query, $fields);
    }

    /* delete table data */
    public function delete($pdo, $table, $primaryKey, $id){
        $parameters = [':id' => $id ];

        $this->query($pdo, 'DELETE FROM `' . $table . '` 
            WHERE `' . $primaryKey . '` = :id', $parameters);
    }

    /* get the all table data */
    private function findAll($pdo, $table){
        $result = $this->query($pdo,'SELECT * FROM `' . $table . '`');

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
    public function save($pdo, $table, $primaryKey, $record) {
        try{
            if($record[$primaryKey] == '') {    // 기본키는 대부분 INT며 정수만 허용. 빈문자열을 전달하면 오류가 발생한다.
                $record[$primaryKey] = null;   // null을 지정하면 auto_increment 기능이 실행된다
            }
            $this->insert($pdo, $table, $record);
        }catch (PDOException $e){
            $this->update($pdo, $table, $primaryKey, $record);
        }
    } 



}
?>