<?php
$workers = [];
$worker_num = 3;

for($i = 0; $i < $worker_num; $i++){
    $process = new swoole_process("doProcess");//創建單獨新process
    $pid = $process->start();//啟動process，get the process id
    $workers[$pid] = $process;//store
}

function doProcess(swoole_process $process)
{
    $process->write("PID: $process->pid");//sub process寫入message至pipe
    echo "write: $process->id $process->callback \n";
}

//添加process事件，向每一個sub process添加需要執行的動作
foreach ($workers as $process){
    //add
    swoole_event_add($process->pipe, function ($pipe) use($process) {
        $data = $process->read();//能否讀取數據
        echo "get: $data \n";
    });
}