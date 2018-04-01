<?php
$content = "write hello world";
swoole_async_writefile('1.txt', $content, function ($filename){
    echo $filename;
},0);