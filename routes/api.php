<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/postS/{id}', function($id='', Request $cc){
    if($id!='' && $id==1){
        //return 'Y: '.$cc->id;
        Route::post('/postT', 'Controller@postTest');
    }
    else{
        return '0';
    }
});
// Route::post('/postT/nick', 'Controller@postTest');

// Route::post('/postT', function(){
//     return '你好.';
// });
Route::post('/postT', 'Controller@postTest');
Route::Get('/postC', 'Controller@postTestC');

Route::post('/linebot', 'LineBotT@postTest');


Route::get('/infoGet', 'Controller@infoD');


//test
Route::post('products', 'ProductController@store');



Route::middleware('lineAuth')->group(function () {
    // 要應用驗證機制的 Route 都放這裡
});
// 登入用的 Route 要放在外面哦
Route::get('/login', 'Api\LineAuthController@login');

/*
https://unproLineMessagi.ngrok.io
ngrok authtoken 2gGqqTQ8vivoweAkGEYeT_7hWY47nA2Un4QPV3igFw6
https://tkogo.000webhostapp.com/api/postT
 */