<?php

use App\Http\Controllers\DrinksFoodsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| 1. HERKESE AÇIK SAYFALAR (Ziyaretçiler ve Login Olanlar)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return app(DrinksFoodsController::class)->home();
})->name('home');

Route::get('/about', [DrinksFoodsController::class, 'aboutPage'])->name('about');

/*
|--------------------------------------------------------------------------
| 3. MENÜ VE İLETİŞİM (Herkes Görebilir)
|--------------------------------------------------------------------------
*/
Route::get('/menu/drinks', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return app(DrinksFoodsController::class)->homeDrinks();
})->name('drinksfoodsaboutmail.homeDrinks');

Route::get('/menu/foods', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return app(DrinksFoodsController::class)->homeFoods();
})->name('drinksfoodsaboutmail.homeFoods');

Route::get('/menu/about', [DrinksFoodsController::class, 'homeAbout'])->name('drinksfoodsaboutmail.homeAbout');

Route::get('/contact', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // 👉 WEB SAYFASI
    return view('contact');
})->name('contact.view');

Route::post('/contact', [DrinksFoodsController::class, 'sendMail'])
    ->name('contact.send');
/*
|--------------------------------------------------------------------------
| 2. PANEL ROTALARI (Giriş Yapanlar İçin & No-Cache)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'nocache'])->group(function () {

    // Dashboard & Kullanıcı Listesi
    Route::get('/dashboard', [DrinksFoodsController::class, 'dashboard'])->name('dashboard');
    Route::get('/kullanicilar', [DrinksFoodsController::class, 'kullanicilar'])->name('kullanicilar');

    // Profil ve Şifre İşlemleri
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/update-password', fn() => view('profile.partials.update-password-form'))->name('update-password-form');

    // Admin: Kullanıcı Yönetimi
    Route::get('user/{user}/edit-password', [DrinksFoodsController::class, 'editPassword'])->name('admin.user.edit-password');
    Route::put('user/{user}/update-password', [DrinksFoodsController::class, 'updatePassword'])->name('admin.user.update-password');
    Route::delete('user/{user}/update-password', [DrinksFoodsController::class, 'deleteKullanici'])->name('deleteKullanici');

    // Drinks CRUD
    Route::get('/drinks', [DrinksFoodsController::class, 'drinkss'])->name('drinks');
    Route::post('/drinks', [DrinksFoodsController::class, 'drinks'])->name('drinks.store');
    Route::get('/DrinksCreate', fn() => view('DrinksCreate'))->name('drinks.create');
    Route::get('/edit/{id}', [DrinksFoodsController::class, 'editData'])->name('edit');
    Route::post('/update/{id}', [DrinksFoodsController::class, 'updateData'])->name('update');
    Route::delete('/delete/{id}', [DrinksFoodsController::class, 'deleteData'])->name('delete');

    // Foods CRUD
    Route::get('/foods', [DrinksFoodsController::class, 'foodss'])->name('foods');
    Route::post('/foods', [DrinksFoodsController::class, 'foods'])->name('foods.store');
    Route::get('/FoodsCreate', fn() => view('FoodsCreate'))->name('foods.create');
    Route::get('/editFood/{id}', [DrinksFoodsController::class, 'editFoods'])->name('editFood');
    Route::post('/updateFood/{id}', [DrinksFoodsController::class, 'updateFoods'])->name('updateFood');
    // Yanlış: Route::delete('/deleteFood/{id}', [DrinksFoodsController::class, 'deleteFood'])->name('deleteFood');
// Doğru: Controller içindeki isim 'deleteFoods' olduğu için burayı güncelliyoruz:
Route::delete('/deleteFood/{id}', [DrinksFoodsController::class, 'deleteFoods'])->name('deleteFood');

    // About CRUD
    Route::post('/about', [DrinksFoodsController::class, 'about'])->name('about.store');
    Route::get('/editAbout/{id}', [DrinksFoodsController::class, 'editAbout'])->name('editAbout');
    Route::post('/updateAbout/{id}', [DrinksFoodsController::class, 'updateAbout'])->name('updateAbout');
});

/*
|--------------------------------------------------------------------------
| 4. AUTH SİSTEMİ
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
