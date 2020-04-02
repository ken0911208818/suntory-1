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
    return view('index');
});

Route::get('/yamasaki', 'FrontController@Yamasaki');//山崎
Route::get('/hak_his', 'FrontController@hak_his');//白州頁面
Route::get('/hibiki', 'FrontController@hibiki');//響
Route::get('/Dealer', 'FrontController@Dealer');//經銷商頁面

Route::get('/product_list', 'FrontController@product_list');//購物頁面

Route::get('/checkout', 'FrontController@checkout');//確認訂單頁面
Route::post('/checkout', 'FrontController@post_checkout');//送出訂單至綠界

//購物車
Route::post('/addcart', 'cartcontroller@addcart');
Route::post('/frontaddcart', 'cartcontroller@frontaddcart');

Route::get('/getcontent', 'cartcontroller@getcontent');
Route::get('/totalcart', 'cartcontroller@totalcart');
Route::post('/onChange', 'cartcontroller@onChange');//更新產品數量
Route::post('/deletecar', 'cartcontroller@deletecar');//刪除產品

//綠界api
Route::prefix('cart_ecpay')->group(function(){

    //當消費者付款完成後，綠界會將付款結果參數以幕後(Server POST)回傳到該網址。
    Route::post('notify', 'FrontController@notifyUrl')->name('notify');

    //付款完成後，綠界會將付款結果參數以幕前(Client POST)回傳到該網址
    Route::post('return', 'FrontController@returnUrl')->name('return');
});


Route::get('Inquire/{id}', 'orderController@Inquire'); //查詢訂單資料

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');


Route::post('admin/liqueurProduct_text', 'LiqueurProductController@liqueurProduct_text'); //獲得酒的產品資料
// 詳細資料
Route::post('admin/productdata', 'orderController@productdata'); //獲得訂單資料

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('liqueur', 'LiqueurController'); //酒類管理
    Route::post('liqueur_upload_img', 'LiqueurController@liqueur_upload_img'); //ajax 新增圖片
    Route::post('liqueur_delete_img', 'LiqueurController@liqueur_delete_img'); //ajax 刪除圖片

    //酒類故事管理
    Route::resource('liqueurStory', 'LiqueurStoryController');
    Route::post('liqueurStory_upload_img', 'LiqueurStoryController@liqueurStory_upload_img'); //axios上傳圖片
    Route::post('liqueurStory_delete_img', 'LiqueurStoryController@liqueurStory_delete_img'); //axios刪除圖片
    Route::post('liqueurStory_kind', 'LiqueurStoryController@liqueurStory_kind'); //獲得酒的種類

    Route::post('liqueurStory_text', 'LiqueurStoryController@liqueurStory_text');

    //酒類產品管理
    Route::resource('liqueurProduct', 'LiqueurProductController');
    Route::post('liqueurProduct_upload_img', 'LiqueurProductController@liqueurProduct_upload_img'); //axios上傳圖片
    Route::post('liqueurProduct_delete_img', 'LiqueurProductController@liqueurProduct_delete_img'); //axios刪除圖片
    Route::post('liqueurProduct_kind', 'LiqueurProductController@liqueurProduct_kind'); //獲得酒的種類

    Route::post('liqueurProduct_img', 'LiqueurProductController@liqueurProduct_img');

    //酒類態度
    Route::resource('liqueurAttitude', 'liqueurAttitudeController');
    Route::post('liqueurAttitude_upload_img', 'liqueurAttitudeController@liqueurAttitude_upload_img'); //axios上傳圖片
    Route::post('liqueurAttitude_delete_img', 'liqueurAttitudeController@liqueurAttitude_delete_img'); //axios刪除圖片
    Route::post('liqueurAttitude_kind', 'liqueurAttitudeController@liqueurAttitude_kind'); //獲得酒的種類
    Route::post('liqueurAttitude_text', 'liqueurAttitudeController@liqueurAttitude_text'); //獲得酒的態度資料

    //酒類肯定
    Route::resource('liqueurSure', 'liqueurSureController');
    Route::post('liqueurSure_upload_img', 'liqueurSureController@liqueurSure_upload_img'); //axios上傳圖片
    Route::post('liqueurSure_delete_img', 'liqueurSureController@liqueurSure_delete_img'); //axios刪除圖片
    Route::post('liqueurSure_product', 'liqueurSureController@liqueurSure_product'); //獲得酒的產品
    Route::post('liqueurSure_text', 'liqueurSureController@liqueurSure_text'); //獲得酒的獎項資料

    //酒類蒸餾場
    Route::resource('liqueurMethod', 'liqueurMethodController');
    Route::post('liqueurMethod_upload_img', 'liqueurMethodController@liqueurMethod_upload_img'); //axios上傳圖片
    Route::post('liqueurMethod_delete_img', 'liqueurMethodController@liqueurMethod_delete_img'); //axios刪除圖片
    Route::post('liqueurMethod_kind', 'liqueurMethodController@liqueurMethod_kind'); //獲得酒的種類
    Route::post('liqueurMethod_text', 'liqueurMethodController@liqueurMethod_text'); //獲得酒的態度資料

    //販售地點
    Route::resource('shop', 'shopController');
    Route::post('shop_upload_img', 'shopController@shop_upload_img'); //axios上傳圖片
    Route::post('shop_delete_img', 'shopController@shop_delete_img'); //axios刪除圖片
    Route::post('shop_text', 'shopController@shop_text'); //獲得販售地點資料

    //訂單
    Route::resource('order', 'orderController');
    Route::post('order_upload_img', 'orderController@order_upload_img'); //axios上傳圖片
    Route::post('order_delete_img', 'orderController@order_delete_img'); //axios刪除圖片
    Route::post('order_kind', 'orderController@order_kind'); //獲得酒的種類
    Route::post('order_text', 'orderController@order_text'); //獲得訂單資料



});
