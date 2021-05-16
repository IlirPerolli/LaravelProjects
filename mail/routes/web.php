<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
//Se pari e marrim guzzlen (ne dokumentim)
Route::get('/', function () {
    //return view('welcome');
    $data = ['title'=>'Hi student I hope you like the course', 'content'=>'This laravel course was created with a log of love and dedication for you'];
//Parametri i pare eshte view, parametri i dyte te dhenat, e treta funksion ku e marrim objektin
    Mail::send('mails.test', $data, function($message){
        $message->to('ilir_perolli@live.com', 'Ilir')->subject('Hello student');
    });
});
