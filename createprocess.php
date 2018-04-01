<?php
//create process
//process對應的執行函數
function doProcess(swoole_process $woker)
{
//    var_dump($woker);
    echo "PID, $woker->pid \n";
    sleep(10);
}

//create process
$process = new swoole_process("doProcess");
$process->start();

$process = new swoole_process("doProcess");
$process->start();

$process = new swoole_process("doProcess");
$process->start();

//等待結束
swoole_process::wait();
