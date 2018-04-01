<?php
//create tcp server
$serv = new swoole_server('127.0.0.1', 9510);

//set async process works
$serv->set(['task_worker_num' => 4]);

//投遞async works
$serv->on('receive', function ($serv, $fd, $from, $data) {
    $task_id = $serv->task($data);//async id
    echo "async id: $task_id \n";
});

//handle async works
$serv->on('task', function ($serv, $task_id, $from, $data){
    echo "execute async id: $task_id \n";
    $serv->finish("$data -> ok");
});

//handle result
$serv->on('finish', function ($serv, $task_id, $data){
    echo "finished";
});

$serv->start();