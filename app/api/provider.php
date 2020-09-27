<?php

use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
    // 'think\Request'          => Request::class,
    // 异常处理改为自定义
    'think\exception\Handle' => 'app\\api\\exception\Http',
];
