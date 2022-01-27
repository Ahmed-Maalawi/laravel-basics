<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Contact;
use Illuminate\Support\Facades\Route;
use app\models\user;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\DB;  //used for query builder

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

Route::get('/home', function () {
    echo "this is home page";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact',[Contact::class, 'index']);

Route::post('/category/add', [CategoryController::class, 'addCate'])->name('store.category');

// category Controller
//---------------------

Route::get('/category/all',[CategoryController::class, 'allCat'])->name('all.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softdelete'])->name('category.softdelete');
Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('/destroy/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/brand/all', [BrandController::class, 'allBrands'])->name('all.brands');
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::post('/brand/updated/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::get('/brand/softdelete/{id}', [BrandController::class, 'softdelete'])->name('brand.softdelete');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $users = User::all();

    return view('dashboard', compact('users'));

})->name('dashboard');
