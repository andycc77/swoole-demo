<?php
$workers = [];
$worker_num = 2;

for($i = 0; $i < $worker_num; $i++){
    $process = new swoole_process("doProcess", false, false);//create sub process
    $process->useQueue();//開啟queue，類似於全局函數
    $pid = $process->start();//啟動process，get the process id
    $workers[$pid] = $process;//store
}

function doProcess(swoole_process $process)
{
    $recv = $process->pop();//8192
    echo "from main process get data: $recv \n";
    sleep(5);
    $process->exit(0);
}

foreach ($workers as $pid => $process){
    $process->push("Hello subprocess $pid \n");
}

//等待subprocess結束 回收資源
for($i = 0; $i < $worker_num; $i++){
    $ret = swoole_process::wait();
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "exit subprocess $pid \n";
}