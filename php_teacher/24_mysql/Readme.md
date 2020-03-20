### Mysql management
> 24_mysql 455   

**mysqlpump** 데이터베이스 백업 명령  
```
mysqlpump -u ijdbuser -pmypassword ijdb > 20200320Ijdb.sql
```
-u 로그인ID : MySQL 서버 사용자명  
-pmypassword : -p와 비밀번호는 붙여쓴다. 그렇지 않으면 실행 후 비밀번호를 별도로 입력해야 한다.  
ijdb : 백업할 스키마  
명령어 뒤에 > 연산자를 붙이면 명령 실행 결과가 파일로 저장된다.   
경로 없이 파일명만 지정하여 실행하면 실행한 디렉터리에 백업 파일이 생성된다.  
/var/backups/ijdb.sql 처럼 전체경로를 지정해되 된다 .

**mysql** 데이터베이스 복원 명령 
```
mysql -u ijdbuser -pmypassword ijdb < 20200320Ijdb.sql
```
> 바이너리 로그 증분 백업   
- Select문을 제외한 모든 INSERT, UPDATE, DELETE문이 기록된다.  
- MySQL 워크벤치나 mysqlpump로 만든 백업 파일을 먼저 복원하고, 백업 시점 이후에 변경된 데이터를 바이너리 로그로 복구한다.  
- my.cnf 파일에 서버 설정이 저장된다. 설정 파일이 없으면 기본설정이 적용되므로 새로 파일을 만들고 바이너리 로그 설정을 추가해야 한다. 명령줄 편집기로 고쳐야 한다  
- /etc/mysql/mysql.conf.d/mysqld.cnf
```
sudo vi /etc/mysql/mysql.conf.d/mysqld.cnf
```
1. log_bin
>> #log_bin                 = /var/log/mysql/mysql-bin.log
=> # 주석을 제거한다.
>> log_bin                 = /var/log/mysql/mysql-bin.log
2. server-id 
>> #server-id               = 1
=> # 주석을 제거한다.
>> server-id               = 1
3. MySQL 재시작
```
sudo systemctl restart mysql.service
```
4. log_bin 파일 경로 : ls /var/log/mysql
5. mysqlbinlog : MySQL 바이너리 로그 데이터를 일반적인 SQL 명령어로 변환한다.
```
mysqlbinlog binlog.000041 binlog.000042 > binlog.sql
mysql -u root -pabde1245 < binlog.sql
```

**MySQL 비밀번호 분실**
```
sudo systemctl stop mysql.service

sudo vi /etc/mysql/mysql.conf.d/mysqld.cnf
```
>> **my.cnf** 파일에서 [ mysqld ]를 찾고 skip-grant-tables 설정을 추가한다    
>> MySQL 서버의 모든 계정에 무제한적인 권한을 부여하는 설정.   
>> ***수정후 바로 삭제!!***
```
[ mysqld ]
skip-grant-tables
```
>> 서버를 재시작한다  
```
sudo systemctl start mysql.service
```
>> MySQl 접속 후 비밀번호 재설정한다  
```
UPDATE mysql.user SET Password=PASSWORD('pass1234') WHERE User = 'user-name'
```
>> 서버 정지 후 my.cnf 파일 설정을 다시 원래대로 제거  
```
sudo systemctl stop mysql.service

sudo vi /etc/mysql/mysql.conf.d/mysqld.cnf

[ mysqld ]  
# skip-grant-tables  
```
>> 서버를 재시작한다    
```
sudo systemctl start mysql.service
```

**MySQL Index**
>> EXPAIN : SELECT 쿠리를 수행하는 내부 과정을 직접 볼 수 있다.  
```
EXPLAIN SELECT joketext FROM joke WHERE id = 6;
```
>> index  
```
ALTER TABLE `ijdb`.`joke` ADD INDEX `index2` (`authorid` ASC);
```

>> Composite index 다중 인덱스  
```
ALTER TABLE `ijdb`.`jokecategory` ADD INDEX `composite` (`jokeid` ASC, `categoryid` ASC);
```
다음 쿼리는 3,4번 글 카테고리에 포함되는지 검사하는 인덱스를 조회한다  
select * from jokecategory where jokeid =3 and categoryid = 4;  
두 컬럼 중 인덱스 정의에 먼저 나온 컬럼은 단독 인덱스 기능도 수행한다.  
select * from joke_category where jokeid = 1  

**Foreing Key**
외래 키 제약은 테이블을 생성할 때 CREATE TABLE 명령어에 명시한다.  
```
CREATE TABLE joke (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    joketext TEXT,
    jokedate DATE NOT NULL,
    authorID INT,
    FOREIGN KEY (authorID) REFERENCES author (id)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB
```
기본테이블은 ALTER TABLE 명령으로 외래 키 제약을 추가할 수 있다  
```
ALTER TABLE joke ADD FOREIGN KEY (authorId) REFERENCES author (id)
```