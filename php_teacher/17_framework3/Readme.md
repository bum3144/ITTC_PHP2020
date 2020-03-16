# PHP URL 재작성(rewrite)
최근 PHP 웹사이트는 URL에 PHP 파일명을 노출하지 않는다.   
최근에는 보기 편하고 의미도 쉽게 파악하는 친화적 URL(friendly-urls)이 주로 쓰인다.
  
friendly URL. 간편 URL (clean URL. fancy URL)이라고도 한다.
  
# URL 재작성 설정 - phpinfo() -> mod_rewrite 확인
```
sudo a2enmod rewrites
```
# .htaccess 파일 root 경로에 작성, 수정
/var/www/html$ vi .htaccess
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [NC,L,QSA]
```
# conf 파일에 내용 추가 - 그리고 작업할 root 경로 변경 가능
```
$ sudo vi /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.
	#ServerName www.example.com
        ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html/php_teacher/16_framework2/public

        <Directory /var/www/html>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted
        </Directory>
```

DocumentRoot /var/www/html/php_teacher/15_framework/public  <== 루트 경로

# 아파치 재시작
```
sudo systemctl restart apache2
```

## index.php 개선사항

코드를 분할해 관리 편의성과 가독성을 높였다.  
리다이렉트에 문제가 생기면 ***checkURL()*** 메서드를,  
템플릿에 문제가 생기면 ***loadTemplate()*** 메서드를,  
특정 URL에 접속할 수 없으면 ***callAction()*** 메서드를 살펴보면 된다.  

## 다음 번 웹사이트 제작할때 재 사용 가능한 코드
**DatabaseTable** (O) 클래스는 모든 데이터베이스 테이블과 상호작용한다.  
**templates** (X) - 웹사이트 마다 HTML, form 항목이 다르다.  
**JokeController** (X) - 현재 사이트에 특화된 컨트롤러다.  
**EntryPoint** (O) 클래스 - 컨트롤러와 템플릿 파일을 불러오는 코드는 다른 웹사이트에서 유용하게 쓸 수 있다.  
템플릿과 컨트롤러는 달라도 그들을 불러오는 코드는 같을 것이다.  

# 범용성과 특수성 - 웹사이트 코드 종류
1) 프로젝트 전용 코드 : 특정 웹사이트에 관련된 코드
2) 범용 코드 : 다른 웹사이트를 구축할 때 재사용하는 코드