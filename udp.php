<?php
//monitor all ip
$serv = new swoole_server('0.0.0.0', 9505, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

//event
$serv->on('packet', function ($serv, $data, $fd){
    //send data to client
    $serv->sendto($fd['address'], $fd['port'], "Server: $data");
});
/*
 * $serv:server message
 * $data:data
 * $fd:client
 */

//start server
$serv->start();