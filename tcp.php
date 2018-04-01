<?php
//create server
$host = '0.0.0.0';
$port = 9505;
$serv = new swoole_server($host, $port);
/*
 *$host:127.0.0.1 本地ip
 *      10.88.88.71.168.50.133監聽對應外網ip
 *      0.0.0.0
 * ipv4/ipv6::0
 *
 * $port:port
 * 1024以下:root
 * 9501
 * $mode:SWOOLE_PROCESS multi process 默認(可不設定)
 * $sock_type:SWOOLE_SOCK_TCP 默認(可不設定)
 */

//event
$serv->on('connect', function ($serv, $fd) {
//    var_dump($serv);
//    var_dump($fd);
    echo "Client: Connect.\n";
});

$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: ".$data);//to client some message
    echo "receive data\n";
    var_dump($data);
});

$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//start server
$serv->start();
/*
 * bool swoole_server->on(string $event, mixed $callback);//監聽
 * $event:
 * connect:當建立連接的時候 $serv:server message $fd:the id number of client
 * receive:當接收到數據 $serv:server message $fd:client message $from_id:client id $data:data
 * close:關閉連接
 */
