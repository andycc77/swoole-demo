<?php
//create websocket server
$ws = new swoole_websocket_server('127.0.0.1', 9509);

//on
//open 建立連接 $ws: server $request:
$ws->on('open', function ($ws, $request){
    var_dump($request);
    $ws->push($request->fd, "welcome \n");
});

//message 接收訊息
$ws->on('message', function ($ws, $request){
    echo "Message: $request->data";
    $ws->push($request->fd, 'get message');
});

//close
$ws->on('close', function ($ws, $request){
    echo "close \n";
});

$ws->start();