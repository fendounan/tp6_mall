<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/18
 * Time: 21:40
 */

use think\facade\Route;

Route::get('test','Test/test');
Route::post('smscode','sms/code');
Route::post('login','login/index');
Route::post('user','user/index');
