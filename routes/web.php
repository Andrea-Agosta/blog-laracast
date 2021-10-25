<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::post('newsletter', function (){
    request()->validate(['email' => 'required|email']);
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us6'
    ]);

    try {
        $response = $mailchimp->lists->addListMember('89e0b114a8',[
            'email_address' =>request('email'),
            'status' => 'subscribed'
        ]);
    } catch(\Exception $e) {
        throw \Illuminate\Validation\ValidationException::withMessages([
           'email' =>  'This email could not be added to our newsletter list.'
        ]);
    }
    return redirect('/')
        ->with('success', 'You are now signed up for our newsletter!');
});

Route::get('/', [PostsController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostsController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::get('logout', [SessionController::class, 'destroy'])->middleware('auth');

