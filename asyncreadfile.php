<?php
swoole_async_readfile(__DIR__."/1.txt", function ($filename, $content){
    echo "$filename $content \n";
});
swoole_async_readfile(__DIR__."/2.txt", function ($filename, $content){
    echo "$filename $content \n";
});
swoole_async_readfile(__DIR__."/3.txt", function ($filename, $content){
    echo "$filename $content \n";
});