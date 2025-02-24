<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () 
{
    return view('welcome');
});
// Route::resource('/user', UserController::class );
Route::get("/register", [UserController::class, 'Showregform'])->name('showregform');
Route::post("/register", [UserController::class, 'store'])->name('register');

Route::get("/login", [UserController::class, 'showlogform'])->name('showlogform');
Route::post("/login", [UserController::class, 'login'])->name('login');



Route::get("/home", [UserController::class, 'home'])->name('index')->middleware(['auth']);
Route::get('users/users', [UsersController::class, 'index'])->name('users.users');
Route::get('admin/events', [EventController::class, 'index'])->name('admin.events');



Route::get("/admin/register", [AdminController::class, 'adminregform'])->name('adminregform');
Route::post("/admin/register", [AdminController::class, 'storeadmin'])->name('adminregister');
Route::get("/admin/login", [AdminController::class, 'adminlogform'])->name('adminlogform');
Route::post("/admin/login", [AdminController::class, 'adminlogin'])->name('adminlogin');
Route::post("/admin/users/delete/{id}", [UserController::class, 'destroy'])->name('deleteuser');
Route::get("/admin/users/update/{id}", [UserController::class, 'updateuser'])->name('update');

Route::get("/admin/dashboard", [AdminController::class, 'dashboard'])->name('admins.dashboard')->middleware(AdminMiddleware::class);
Route::post("/admin/musics/addmusic",[MusicController::class, 'create'])->name('addmusic')->middleware(AdminMiddleware::class);
Route::get('admin/events', [EventController::class, 'index'])->name('admin.events');
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post("/admin/musics/delete/{id}", [MusicController::class, 'destroy'])->name('deletemusic');
Route::get("/admin/music/update/{id}", [MusicController::class, 'updatemusicform'])->name('updatemusicshow');
Route::post("/musics/updatemusic/{id}", [MusicController::class, 'updatemusic'])->name('updatemusic');
Route::post('/downloadmusic/{id}', [MusicController::class, 'downloadmusic'])->name('musics.downloadmusic');

Route::post("/admin/event/addevent", [EventController::class, 'store'])->name('addevent');Route::post("/admin/event/updateevent/{id}", [EventController::class, 'updateevent'])->name('updateevent');Route::get("/admin/event/updateeventform/{id}", [EventController::class, 'updateeventform'])->name('updateeventform');
Route::post("/admin/event/delete/{id}", [EventController::class, 'deleteevent'])->name('deleteevent');

Route::prefix('admin')->name('admin')->group(function(){
    Route::middleware('guest:admin')->group(function(){  
        //Both Guests and Admins          
   
   
    });

    Route::middleware(AdminMiddleware::class)->group(function(){        
        //Logged in admins    
                // Route::get("/musics/addmusic",[MusicController::class, 'addmusicform'])->name('addmusicform');
                Route::get("/musics/updatemusic/{id}", [MusicController::class, 'updatemusicform'])->name('updatemusicform');
                
                
                // Route::get("/musics/musics", [MusicController::class, 'musics'])->name('musics');
                

                // Route::get("/events/addevent", [EventController::class, 'addeventform'])->name('addeventform');
                // Route::post("/events/addevent", [EventController::class, 'addevent'])->name('addevent');
                // Route::get("/events/update", [AdminController::class, 'updateform'])->name('updateform');
                // Route::post("/events/updateevent", [EventController::class, 'updateevent'])->name('updateevent');

        });
});





