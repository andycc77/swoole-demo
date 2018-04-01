<?php
//循環執行 timer
swoole_timer_tick(2000, function ($timer_id){
    echo "run $timer_id\n";
});

//單次執行 timer
swoole_timer_after(3000, function (){
    echo "after 3000s run \n";
});