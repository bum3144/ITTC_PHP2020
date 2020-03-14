<!-- example 1. -->
<!-- <form action="" method="post">
    <input type="hidden" name="jokeid" value="<?php //if(isset($joke)) { echo $joke['id']; }?>">
    <label for="joketext">Please enter a joke post: </label>
    <textarea id="joketext" name="joketext" row="3" cols="40" 
        style="width:400px;height:200px;"><?php //if(isset($joke)) { echo $joke['joketext']; }?></textarea>
    <input type="submit" value="Save">
</form> -->


<!-- 
    example 2. null coalescing operator 널 병합 연산자 
            - form 필드에서 name 속성ㄱ을 배열 형태로 지정한다.
            - form 필드 데이터는 PHP 배열 형태로 전달된다 
            - 전달된 $_POST['joke]는 단일값이 아니라 배열이다. $_POST['joke']['id']로 id 를 읽을 수 있다. 
-->
<form action="" method="post">
    <input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
    <label for="joketext">Please enter a joke post: </label>
    <textarea id="joketext" name="joke[joketext]" row="3" cols="40" style="width:400px;height:200px;"><?=$joke['joketext'] ?? ''?></textarea>
    <input type="submit" value="Save">
</form>