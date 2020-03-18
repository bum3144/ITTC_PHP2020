# Don't Repeat Yourself

The DRY Principle is one of the tenets or key concepts of programing. DRY (D-R-Y) stands for Don't Repeat Yourself. If you see yourself repeating code in the same place, for example, writing the same string over and over again, it's a good sign you can improve your programming using DRY programming techniques.

## Humor board project

PHP Humor board project [git_infomaiton]](https://github.com/bum3144/ITTC_PHP2020/tree/master/php_teacher) 

```bash
Internet Joke World
Welcome to the Internet Joke World~!
```

## PHP version

```bash
~$ php --version
 $ PHP 7.3.15
```

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

## License
[ITTC](http://ITTC.kr)