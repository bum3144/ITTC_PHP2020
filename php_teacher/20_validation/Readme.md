### PHP URL 재작성(rewrite)
최근 PHP 웹사이트는 URL에 PHP 파일명을 노출하지 않는다.   
  
### URL 재작성 설정 - phpinfo() -> mod_rewrite 확인
```
sudo a2enmod rewrites
```
### .htaccess 파일 root 경로에 작성, 수정
/var/www/html$ vi .htaccess
```
RewriteRule ^.*$ /index.php [NC,L,QSA]
```
### conf 파일에 내용 추가 - 그리고 작업할 root 경로 변경 가능
```
$ sudo vi /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
	~
    ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html/php_teacher/17_framework3/public

        <Directory /var/www/html>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted
        </Directory>
	~	
sudo systemctl restart apache2  
```
  
> 19_registration 390 CMS-EntryPoint-namespaces-Router  
  
author Table -> password COLUMN 추가  
Register class 생성, register.html.php 생성, registersuccess.html.php 생성  
IjdbRoutes.php -> $authorController 추가, $routes 추가  
Register.php -> registerUser() 메서드 추가  

>> 유효성 검사
- 모든 필드 데이터 유효성 검사 (이메일, 사용자명은 공백 불가)  
- 올바른 이메일 주소 형식  
- 동일한 이메일 주소를 등록한 기존 사용자가 없어야 함  

$author['name'] =='' 조건은 누군가 악의적으로 POST 요청을 조작하면 오류메시지를 사용해 중요한 정보가 노출된다.  
empty($author['name'])은 name 키가 없어도 오류를 내지않고 단순히 false를 반환한다  