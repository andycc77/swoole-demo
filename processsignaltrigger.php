<?php
//觸發function 異步執行 達到10停止
swoole_process::signal(SIGALRM, function (){
    static $i = 0;
    echo "$i \n";
    $i++;
    if($i>10){
        swoole_process::alarm(-1);//清除定時器
    }
});

//定時信號
swoole_process::alarm(100 * 1000);