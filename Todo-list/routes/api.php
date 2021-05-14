<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContentController;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(["namespace"=>'api'],function(){
  //Bekleyenleri Görüntüle
  Route::get('/index',[ContentController::class,'index']);
  //Tamamlananlar
  Route::get('/complete',[ContentController::class,'complete']);
  //İptal Edilenler
  Route::get('/cancel',[ContentController::class,'cancel']);
  //Oluştur
  Route::post('/create',[ContentController::class,'create']);
  //Tamamla
  Route::post('/completed',[ContentController::class,'completed']);
  //İptal Et
  Route::post('/canceled',[ContentController::class,'canceled']);
});
