<?php

Route::post('/curl-login',[\Yang\UploadTest\controllers\CurlLoginController::class,"login"] );
Route::post('/add-user',[\Yang\UploadTest\controllers\CurlLoginController::class,"addUser"] );
