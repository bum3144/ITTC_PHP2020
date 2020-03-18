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
# Validation
email 중복 체크를 위한 쿼리 - DatabaseTable.php  
email 중복 체크, 빈칸 체크  
password - one way hashing function  
password_hash(), password_verify()  
PASSWORD_DEFAULT 기본 알고리즘  
> 데이터베이스에 저장하기 전에 비밀번호를 해시화  
> $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);  
  
> 21_cookieSession 410   
# Cookie
- PHP 스크립트에서 PHP스크립트 URL에 접속하면 setcookie() 내장 함수 호출  
- 쿠키명과 값을 HTTP set-cookie 헤더에 담아 브라우저에 전송. ex) 쿠키명 mycookie, 값 value  
- 브라우저는 HTTP 헤더를 읽고 mycookie 쿠키에 value를 저장한다  
- 이후 페이지를 요청할 때마다 브라우저는 mycookie=value를 HTTP쿠키 헤더에 추가한다  
- 페이지 요청에 HTTP 쿠키 헤더가 있으면 PHP는 자동으로 $_COOKIE 배열에 쿠키 정보를 할당한다  
- $_COOKIE['mycookie'] 에 'value' 문자열이 저장된다  
```
setcookie ( string $name [, string $value = "" [, int $expires = 0 [, string $path = "" [, string $domain =  " [, bool $secure = FALSE [, bool $httponly = FALSE ]]]]]] )
```
- **path** '/admin/'  지정하면 admin과 하위 디렉터리 페이지를 요청할 때만 쿠키 정보를 전달한다. 마지막 / 는 디렉터리명을 정확히 지정하는 역활을 하며, 생략하면 /adminfake/ 등 /admin으로 시작하는 모든 경로에서 쿠키에 접근할 수 있다.
- **domain** 인수도 비슷하다. 지정한 도메인 외에는 쿠키에 접근하지 못하도록 차단한다.
- www.example.com, support.example.com 등 여러 도메인에 사용하려면 '.example.com'을 지정하여 쿠키를 공유하도록 허용한다. 
- **secure** 인수를 1로 지정하면 SSL(secure socket layer) 접속, 즉 https:// 로 시작하는 URL을 요청할 때만 쿠키를 전송
- **httpOnly** 인수를 1로 지정하면 브라우저와 자바스크립트가 쿠키에 접근할 수 없다. 일반적으로 자바스크립트는 현재 페이지에 설정된 쿠키를 읽고 다양한 방식으로 활용한다. 혹여 쿠키 데이터에 민감한 개인정보가 담겨 있다면 막대한 피해를 입는다. httpOnly를 1로 설정하면 PHP 스크립트는 평소와 똑같이 쿠키를 브라우저로 전송하지만 브라우저의 자바스크립트는 쿠키를 볼 수 없다.
> **name**을 제외한 모든 인수는 생략할 수 있다. 그러나 인수에 값을 지정하려면ㄴ 그 앞에 선언된 모든 인수에 값을 지정해야 한다. 예로 domain 인수를 지정하려면 expiryTime 인수도 값을 지정해야 한다. 이때 문자열 인수 (value, path, domain)는 빈 문자열을, 숫자 인수(expiryTime, secure)는 0을 전달하면 인수 생략과 같은 효과를 낸다.f

