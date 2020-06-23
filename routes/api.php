<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
header('Access-Control-Allow-Headers:Content-Type, X-Auth-Token, Origin');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
///
Route::post('addadmin', 'Adminmanager@addadmin');
Route::post('adminlogin', 'Adminmanager@login');
Route::post('logoutadmin', 'Adminmanager@logout');
Route::post('cekadmin','Adminmanager@cekuser');

Route::get('totals','Adminmanager@totals');
Route::get('dash','Adminmanager@dashboard');

Route::post('adduser', 'Adminmanager@adduser');
Route::get('alluser','Adminmanager@alluser');


Route::post('addpengumuman', 'Adminmanager@addpengumuman');
Route::delete('deletepengumuman/{id}', 'Adminmanager@deletepengumuman');
Route::get('pengumuman', 'Adminmanager@pengumuman');

Route::post('addprodi', 'Adminmanager@addprodi');
Route::delete('deleteprodi', 'Adminmanager@deleteprodi');
Route::post('prodi', 'Adminmanager@prodi');
Route::post('usrc', 'Adminmanager@usrc');

Route::post('login', 'Usermanager@login');
Route::post('logincek', 'Usermanager@cekuser');
Route::post('cek', 'Usermanager@checkdata');
Route::post('lengkapidata', 'Usermanager@lengkapidata');
Route::post('usershow', 'Usermanager@rich');
Route::post('logout', 'Usermanager@logout');

Route::get('cetak/{noreg}', 'Usermanager@cetak');
Route::post('cetak2', 'Usermanager@cetak2');

