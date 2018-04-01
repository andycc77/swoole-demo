<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

$client->on('connect', function ($cli){
    $cli->send("hello \n");
});

$client->on('receive', function ($cli, $data){
    echo "data: $data";
});

$client->on('error', function ($cli){
    echo "fail \n";
});

$client->on('close', function ($cli){
    echo "close \n";
});

$client->connect('127.0.0.1', 8080,10);//but local is not support async