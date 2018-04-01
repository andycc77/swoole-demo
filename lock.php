<?php
$lock = new swoole_lock(SWOOLE_MUTEX);
echo "創建互斥鎖 \n";
$lock->lock();//開始鎖定主進程
if(pcntl_fork() > 0){
    sleep(1);
    $lock->unlock();//解鎖
}else{
    echo "子進程 等待鎖 \n";
    $lock->lock();//上鎖
    echo "子進程 獲取鎖 \n";
    $lock->unlock();//釋放鎖
    exit("子進程退出");
}
echo "主進程 釋放鎖";
unset($lock);
sleep(1);
echo "子進程退出";