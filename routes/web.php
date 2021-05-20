<?php
use App\Http\Controllers\ReclamCommentController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\DroitController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MsgController;
use App\Http\Controllers\ReclamEventsController;
use App\Http\Controllers\ReponseController;








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
//Route::post('/login/{provider}/callback', 'Auth\LoginController@handleCallback');
Route::get("/login", [LoginController::class, "login"]);
Route::post("/register", [RegisterController::class, "register"]);

Route::get("/blogs",[BlogController::class,"index"]);
Route::post("/addBlog",[BlogController::class,"store"]);
Route::get("/editBlog/{id}",[BlogController::class,"update"]);
Route::get("/suppBlog/{id}",[BlogController::class,"destroy"]);

Route::get("/comments/{idBlog}",[CommentController::class,"index"]);
Route::get("/addcomment/{idBlog}",[CommentController::class,"store"]);
Route::get("/editcomment/{idBlog}/{id}",[CommentController::class,"update"]);
Route::get("/suppcomment/{idBlog}/{id}",[CommentController::class,"destroy"]);

Route::get("/Event",[EventController::class,"index"]);
Route::get("/addEvent/{idAsso}",[EventController::class,"store"]);
Route::get("/editEvent/{id}",[EventController::class,"update"]);
Route::get("/suppEvent/{id}",[EventController::class,"destroy"]);


Route::get("/Action",[ActionController::class,"index"]);
Route::get("/addAction/{idAsso}",[ActionController::class,"store"]);
Route::get("/editAction/{id}",[ActionController::class,"update"]);
Route::get("/suppAction/{id}",[ActionController::class,"destroy"]);

Route::get("/Doc",[DocController::class,"index"]);
Route::get("/addDoc/{idUser}",[DocController::class,"store"]);
Route::get("/editDoc/{id}",[DocController::class,"update"]);
Route::get("/suppDoc/{id}",[DocController::class,"destroy"]);

Route::get("/Droit",[DroitController::class,"index"]);
Route::get("/addDroit/{idUser}",[DroitController::class,"store"]);
Route::get("/editDroit/{id}",[Droitcontroller::class,"update"]);
Route::get("/suppDroit/{id}",[DroitController::class,"destroy"]);

Route::get("/Msg",[MsgController::class,"index"]);
Route::get("/addMsg/{idUser}",[MsgController::class,"store"]);
Route::get("/suppMsg/{idUser}/{idMsg}",[MsgController::class,"destroy"]);


Route::get("/ReclamEvent/{id}",[ReclamCommentEvent::class,"index"]);
Route::get("/addReclamEvent/{idUser}",[ReclamCommentEvent::class,"store"]);
Route::get("/editReclamEvent/{id}",[ReclamCommentEvent::class,"update"]);
Route::get("/suppReclamEvent/{id}",[ReclamCommentEvent::class,"destroy"]);


Route::get("/createReclam/{idBlog}/{id}",[ReclamCommentController::class,"create"]);
Route::get("/reclam/{idBlog}/{id}",[ReclamCommentController::class,"index"]);
Route::get("/editReclamComment/{id}",[ReclamCommentController::class,"update"]);
Route::get("/suppReclamComment/{id}",[ReclamCommentController::class,"destroy"]);
