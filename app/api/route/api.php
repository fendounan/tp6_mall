<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/18
 * Time: 21:40
 */

use think\facade\Route;

Route::get('test', 'Test/test');
Route::post('smscode', 'sms/code');
Route::post('login', 'login/index');
Route::rule('logout', 'logout/index','get|post');
Route::rule('category', 'category/index','get|post');
// Route::post('user','user/index');
// 资源路由
Route::resource('user', 'User');
