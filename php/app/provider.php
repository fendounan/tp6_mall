<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
// 公共模块
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
];
