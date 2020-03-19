<?php
// echo phpinfo(); die;

if(!isset($_COOKIE['visits'])){
    $_COOKIE['visits'] = 0;
}
$visits = $_COOKIE['visits'] + 1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);
// time() 유닉스 타임스탬프(unix timestamp) 1970년 1월1일 부터 32비트 정수
// 3600초(60초 * 60분), 24시간 , 365일.
// ex) 쿠키 만료일 20년 이후로 설정. setcookie('mycookie', 'somevalue', time() + 3600 * 24 * 365 *20);
// but,,  32비트 정수 최댓값을 날짜로 환산하면 2038년 1월 19일이다. 이후 시각은 오류가 발생한다. (참고)
if($visits > 1){
    echo "$visits 번째 방문하셨습니다. (COOKIE)<br>";
}else{ // 첫 방문
    echo "웹사이트에 오신 걸 환영합니다. 둘러보려면 여기를 클릭하세요! (COOKIE)<br>";
}


session_start();
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits'] = $_SESSION['visits'] + 1;
// 세션은 보존 기간을 계산할 필요가 없는 대신 브라우저를 닫는 즉시 모든 데이터가 사라진다.
if ($_SESSION['visits'] > 1) {
    echo $_SESSION['visits'] . "번째 방문하셨습니다. (SESSION)<br>";
} else { // 첫 방문
    echo "웹사이트에 오신 걸 환영합니다. 둘러보려면 여기를 클릭하세요! (SESSION) ";
}




try{
    include __DIR__ . '/../includes/autoload.php';
    
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    // EntryPoint 생성자로 $method를 전달한다
    $entryPoint = new \Ittc\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
    $entryPoint->run();

}catch (\PDOException $e){

    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();  

    include __DIR__ . '/../templates/layout.html.php';
}  
?>