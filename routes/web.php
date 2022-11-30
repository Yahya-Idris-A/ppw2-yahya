<?php

use App\Models\Post;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GreetController;

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
    echo asset('Storage/file.txt');
});

Route::get('/home', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

Route::get('/projects', [PostController::class, 'index_projects']);

Route::resource('posts', 'App\Http\Controllers\PostController');

Route::resource('gallery', 'App\Http\Controllers\GalleryController');

Auth::routes([
    'reset' => true,
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/about', function () {
        return view('about', [
            "title" => "About"
        ]);
    });

    Route::get('/education', function () {
        return view('education', [
            "title" => "Education"
        ]);
    });
});

// Route::get('/send-email', function () {
//     $data = [
//         'name' => 'Nama Anda',
//         'body' => 'Testing Kirim Email'
//     ];
//     Mail::to('yahyaidrisabdurrahmanz@gmail.com')->send(new SendEmail($data));
//     dd("Email Berhasil dikirim.");
// });

Route::get('/send-email', [SendEmailController::class, 'index'])->name('kirim-email');
Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');
Storage::disk('local')->put('file.txt', 'Contents');
Route::get('/greet', [GreetController::class, 'greet'])->name('greeting');
Route::get('/gallery2', [GreetController::class, 'gallery'])->name('gallery');
