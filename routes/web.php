<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',[
        'as' => 'trang-chu',
        'uses' => 'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
    'as' => 'loaisanpham',
    'uses' => 'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
   'as' => 'chitietsanpham',
   'uses' => 'PageController@getChitiet'
]);

Route::get('lien-he',[
   'as' => 'lienhe',
   'uses' => 'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
   'as' => 'gioithieu',
   'uses' => 'PageController@getGioiThieu'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout_account',[
    'as' => 'logout_acc',
    'uses' => 'PageController@logout'
]);

Route::post('/insert-contact',[
   'as' => 'insert_contact',
   'uses' => 'PageController@insert_contact'
]);

Route::get('/mua-hang/{id}',
        ['as' => 'muahang',
         'uses' => 'PageController@muahang'
]);

Route::get('gio-hang',[
    'as' => 'giohang',
    'uses' => 'PageController@giohang'
]);

Route::get('xoa-gio-hang/{id}',[
    'as' => 'xoagiohang',
    'uses' => 'PageController@xoagiohang'
]);

Route::get('cap-nhat-gio-hang',[
   'as' => 'update_cart',
    'uses' => 'PageController@update_cart'
]);