<?php

use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// All admin route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::post('/store/profile', 'storeProfile')->name('store.profile');
    Route::post('/update/password', 'updatePassword')->name('update.password');
});


// All Home Slide route
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('home/slide', 'HomeSlider')->name('home.slide');
    Route::post('update/slider', 'UpdateSlider')->name('update.slider');
});

// All About page route
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/about/edit', 'UpdateAbout')->name('update.about');
});


// Route::controller(DemoController::class)->group(function() {
//     Route::get('/about', "Index")->name('about.page')->middleware('check');
//     Route::get('/contact', "ContactMethod")->name('contact.page');
// });

require __DIR__.'/auth.php';
