<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\siteController;

use App\Models\User;

use Illuminate\Support\Facades\DB;

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
// ->middleware('age');

// Route::get('/no-access', function(){
//     echo 'You are not adult';
// })->name('pagla');

Route::view('/block', 'component-test');

Route::get('/block/controller/{data}', [siteController::class, 'block']);

// Route::get('/block/controller/{data}', function($id){
//     return view('component-test', ['id'=>$id]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        // $user = User::all();
        $user = DB::table('users')->get();
        return view('dashboard', compact('user'));
        // return view('dashboard', ['user'=>$user]);
    })->name('dashboard');
});

Route::get('/category', [CategoryController::class, 'getData'])->name('category');

Route::post('/add/category', [CategoryController::class, 'addCat'])->name('add.cat');
