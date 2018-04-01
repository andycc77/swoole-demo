<?php
$fp = stream_socket_client('tcp://www.qq.com:80', $errno, $errstr, 30);
fwrite($fp, "GET / HTTP/1.1\r\nHost: www.qq.com\r\n\r\n");
swoole_event_add($fp, function ($fp){
    $response = fread($fp, 8192);
    var_dump($response);
    swoole_event_del($fp);
    fclose($fp);
});
echo "execute";