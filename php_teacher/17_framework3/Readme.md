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
	DocumentRoot /var/www/html/php_teacher/17_framework3/public

        <Directory /var/www/html>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted
        </Directory>
```

DocumentRoot /var/www/html/php_teacher/17_framework3/public  <== 루트 경로

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
  
> 17_framework3  
# 범용성과 특수성 - 웹사이트 코드 종류  
1) 프로젝트 전용 코드 : 특정 웹사이트에 관련된 코드  
2) 범용 코드 : 다른 웹사이트를 구축할 때 재사용하는 코드  
  
# 범용 EntryPoint 클래스 - 종속성 제거  
1) 제거할 메서드를 정한다 -  callAction()  
2) 해당 메서드를 전용 클래스로 옮기고 public 선언 - classes/IjdbRoutes.php  
3) 참조 클래스 변수를 인수로 대체한다 $this->route를 $route로 바꾸고 메서드 인수에 $route를 추가  
4) 원래 클래스에 있던 메서드를 제거 - EntryPoint 클래스에서 callAction() 메서드를 제거  
5) 새로 만든 클래스를 담을 생성자 인수와 클래스 변수를 원래 클래스에 추가한다. - $routes 변수를 생성자 인수와 클래스 변수로 추가  
6) 새로 만든 클래스를 원래 클래스의 생성자로 전달 - $entryPoint = new EntryPoint($route, new IjdbRoutes()); index.php에서 IjdbRoutes.php 를 불러온다  
7) 새 객ㅊ테를 참조하도록 메서드 호출 코드를 변경하고 필요한 변수를 전달 - $page = $this->routes->callAction($this->route); 로 수정  

# 오토로딩과 네임스페이스  
> 오토로딩(autoloading): 클래스 파일을 자동으로 불러오는 기능. 모든 include문을 한곳에서 처리.  
```
function autoloader($className) {
	$file = __DIR__ . '/../classes/' . $className . '.php';
	include $file;
} 

spl_autoload_register('autoloader');

autoloader('DatabaseTable');
autoloader('EntryPoint');
```

PHP가 자동으로 autoloader() 함수를 호출하도록 선언 - 특정 클래스를 처음 사용할 때 자동으로 호출된다.  
spl_autoload_register() 함수는 PHP 내장함수  
```
spl_autoload_register('autoloader');
```

## 오토로더 대소문자
PHP 클래스명은 대소문자를 구별하지 않는다.  
그러나 처음 불러오는 오토로더에서는 대소문자가 틀려지면 문제가 발생한다.  

### 오토로더 구현
include 폴더에 autoload.php 파일을 만들고 index.php에 include 시킨다.  
EntryPoint.php, IjdbRoutes.php include를 제거한다.  

# 디렉토리 변경
범용파일 Ittc <= EntryPoint.php, DatabaseTable.php  
프로젝트 전용 Ijdb <= IjdbRoutes.php, Controllers 디렉토리   
경로수정 EntryPoint.php, IjdbRoutes.php '/../../templates/' or '/../../includes/'  

# PSR-4 - PHP Standards Recommendations   
## PHP 표준 권장안 클래스명과 디렉터리 규칙  
[PHP-FIG](https://www.php-fig.org)  

# 정규화된 클래스명 Fully qualified class name, FQCN
클래스명에 앞에 네임스페이스를 정확히 써야 해당 클래스를 불러옴  
DatabaseTable을 => \Ittc\DatabaseTable 로 고쳐야 한다.  

## 네임스페이스 선언한 다음, use 키워드 뒤에 정규화된 클래스명 쓰기  
namespace Ijdb\Controllers;  
use \Hanbit\DatabaseTable;  <= 이러면 전체 클래스명을 쓰지 않고 DatabaseTable를 불러올 수 있다.  

네임스페이스 구조는 상대적이다. 타입 힌트로 클래스명을 가리키거나 new 키워드로 객체를 생성할때,  
PHP는 현재 네임스페이스에서 해당 클래스를 찾는다. DatabaseTable.php 파일에서 ***PDO*** 객체를 사용하려면  
맨 앞에 역슬래시를 붙여 **\PDO**로 써야 정확히 해당 클래스를 가리킬 수 있다.  
***DataTime***이나 ***PDOException***도  **\DataTime**과 **\PDOException**으로 고쳐야 한다.  




