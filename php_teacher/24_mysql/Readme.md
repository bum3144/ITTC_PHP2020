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