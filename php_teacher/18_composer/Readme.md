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
  
> 18_composer 375 CMS-EntryPoint-namespaces-Router

# 컴포저  
1) 서드파티 라이브러리를 빠르게 내려받고 쉽게 설치하는 도구  
2) PSR-4 규약에 따라 클래스를 만들면 컴포저 오토로더로 기존 autoload.php를 대체할 수 있다.

```
{
	"autolod": {
		"psr-4": {
			"Ittc\\": "classes/Ittc",
			"Ijdb\\": "classes/Ijdb"
		}
	}	
}
```
[Composer참고사이트](https://www.sitepoint.com/re-introducing-composer) 
[참고사이트](https://www.lesstif.com/pages/viewpage.action?pageId=26083685)  


# 다차원 데이트 방식
```
$routes = [
    'joke/edit' => [
        'POST' => [
            'controller' => $jokeController,
            'action' => 'saveEdit'
        ],
        'GET' => [
            'controller' => $jokeController,
            'action' => 'edit'
        ],
        'home' => [
            'controller' => $jokeController,
            'action' => 'home'
        ]
    ]
];
```
$route = $routes['joke/edit'];   
$postRoute = $route['POST'];   
echo($controller = $postRoute['controller']) ."<br>";   
echo($action = $postRoute['action']) ."<br>";   
> 대가로 []를 연속으로 쓰면 쉽게 이용할 수 있다  
echo $controller = $routes['joke/edit']['POST']['controller'] ."<br>";   
echo $controller = $routes['joke/edit']['POST']['action'] ."<br>";   

## REST (Representational State Transfer) 레스트 기법
> $_SERVER 배열의 REQUEST_URI 와 REQUEST_METHOD   
```
$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = $route[$route][$method]['controller'];
$action = $route[$route][Rmethod]['action'];

$controller->$action();
```

[참고사이트-RESTfull_API_설계가이드](https://sanghaklee.tistory.com/57)  


# 테스트 주도 개발 방법론 (Test-Driven Development, TDD)