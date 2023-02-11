<?php

const a = 'hello world';

$callback = function() {
    echo 'check';
};

$check_values = function(array $arr, callable $call) {
    if(array_sum($arr) >= 100)
        $call();
};

echo a . "<br>";

$check_values([99, 1] , $callback);