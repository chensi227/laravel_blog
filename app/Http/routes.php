<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','IndexController@index');
Route::get('cate/{cate_id}','IndexController@cate');
Route::get('art/{id}','IndexController@article');


Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['login','throttle:60,1']],function(){
    Route::get('','IndexController@index');
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::any('check','ValidateController@check');
    Route::any('changepass','LoginController@changepass');
    Route::any('checkpass','ValidateController@checkpass');
    Route::resource('category','CategoryController');
    Route::any('cate/changesort','CategoryController@changesort');
    Route::resource('article','ArticleController');
    Route::resource('link','LinkController');
    Route::any('link/changesort','LinkController@changesort');
    Route::resource('navs','NavsController');
    Route::any('navs/changeorder','NavsController@changeOrder');

    Route::get('config/test','ConfigController@test');

    Route::resource('config','ConfigController');
    Route::any('config/changeorder','ConfigController@changeOrder');
    Route::any('config/changecontent','ConfigController@changecontent');


});
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::any('login','LoginController@login');
    Route::get('outlogin','LoginController@outlogin');
    Route::get('code','ValidateController@create');
    Route::any('upload','CommonController@upload');
});
Route::any('admin/crypt','Admin\LoginController@crypt');



Route::any('admin/test',function(){
//    DB::connection()->enableQueryLog(); // 开启查询日志
    $list=DB::table('category')
        ->where('cate_id','>','1')
        ->where('cate_desc','>','1')
        ->get();
    dd($list);
//    dd(DB::getQueryLog());

});

Route::get('/test1','IndexController@test1');
Route::get('/test','IndexController@test');
Route::get('/getdata/{id?}/{name?}','IndexController@getdata');
Route::post('/wechat','WechatController@wechat');