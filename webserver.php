<?php
$serv = new swoole_http_server('127.0.0.1',9507);

//獲取請求
/*
 * $request:請求信息get post
 * $response:返回信息
 */
$serv->on('request', function ($request, $response){
    var_dump($request);
    $response->header('Content-Type', 'text/html', 'charset=utf-8');//設置header
    $response->end('hello world '.rand(100,999));//向client browser發送html內容
});

$serv->start();//啟動