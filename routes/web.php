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

/**
 * ユーザー側
 */
// トップ画面表示
Route::get('/', 'UserTopController@goTop');
// ログインボタンが押された時
Route::post('/login', 'UserLoginController@login');
// ログインが完了した時と新規登録が完了した時
Route::get('/goPortal', 'UserPortalController@goPortal');
// ログアウトボタンが押された時
Route::get('/logout', 'UserLoginController@logout');
// 新規登録ボタンが押された時
Route::post('/registration', 'UserRegistrationController@registration');
// お店が選択された時
Route::get('/store/{storeId}', 'StoreDetailsController@goStoreDetails');
// 事前注文画面が押された時
Route::get('/order/{storeId}', 'OrderController@goOrder');
// 事前注文が押された時
Route::post('/oredrConfirm/{storeId}', 'OrderController@oredrConfirm');
// 事前注文が完了した時
Route::get('/orderEnd', 'OrderController@orderEnd');


/**
 * ストア側
 */
// トップ画面表示
Route::get('/storeTop', 'StoreTopController@goTop');
// ログインボタンが押された時
Route::post('/storeLogin', 'StoreLoginController@login');
// ログインが完了した時
Route::get('/goStorePortal', 'StorePortalController@goPortal');
// ログアウトボタンが押された時
Route::get('/storeLogout', 'StoreLoginController@logout');
// 注文詳細ボタンが押された時
Route::get('/orderDetails/{orderId}', 'StorePortalController@orderDetails');
// 注文状況変更ボタンが押された時
Route::post('/orderStatus', 'StorePortalController@orderStatus');
// 注文履歴ボタンが押された時
Route::get('/orderHistory', 'StorePortalController@orderHistory');
// 絞り込み検索ボタンが押された時
Route::get('/orderRefine', 'StorePortalController@orderRefine');
