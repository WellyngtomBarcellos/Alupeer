<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\itemController;
use App\Http\Controllers\AnounceController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\pageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeCheckoutController;
use App\Http\Controllers\Auth\GoogleController;



Route::get('/Bookin/make/devolvido', [AnounceController::class, 'getBack']);
Route::get('review/send', [AnounceController::class, 'reviewSend']);

Route::get('anounce/edit', [AnounceController::class, 'editAnounceView']);
Route::get('tripple', function () {
    return view('popup');
});



Route::post('user/edit/anounce/name', [AnounceController::class, 'EditName']);
Route::post('user/edit/anounce/category', [AnounceController::class, 'EditCategory']);
Route::post('user/edit/anounce/float', [AnounceController::class, 'EditFloat']);
Route::post('user/edit/anounce/price', [AnounceController::class, 'EditPrice']);
Route::post('user/edit/anounce/desc', [AnounceController::class, 'EditDescription']);

Route::get('send', [pageController::class, 'mail'])->name('mail');
Route::get('carrinho', [itemController::class, 'carrinho'])->name('carrinho');
Route::get('carrinho/remover', [itemController::class, 'removerDoCarrinho'])->name('removerDoCarrinho');

Route::post('/addCart', [itemController::class, 'addCart']);
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/stripe/webhook', [StripeCheckoutController::class, 'handleWebhook']);
Route::post('/edit/chatItem', [AnounceController::class, 'chatItem'])->name('chatItem');
Route::get('/', [itemController::class, 'index'])->name('home');
Route::get('/documentacao/design', [pageController::class, 'documentationDesign'])->name('documentationDesign');
Route::get('/store/dates-unavaliable', [itemController::class, 'storeDates'])->name('storeDates');
Route::post('/store/booking', [itemController::class, 'booking'])->name('booking');
Route::get('/politicas-privacidade', [pageController::class, 'politics'])->name('politica');
Route::get('/Bookin/data', [pageController::class, 'returnBookin'])->name('returnBookin');
Route::post('/Bookin/data/delete-booking', [pageController::class, 'deleteBooking'])->name('deleteBooking');
Route::post('/Bookin/data/accept-booking', [pageController::class, 'acceptBooking'])->name('acceptBooking');
Route::get('/email/verify', function () {return view('auth.verify-email');})->middleware(['auth', 'verified'])->name('verification.notice');
Route::get('/result/local', [itemController::class, 'locateNear'])->name('locateNear');
Route::get('/produto/{token}', [pageController::class, 'index'])->name('produto.page');
Route::get('/help', [pageController::class, 'helper'])->name('helper.page');
Route::get('/data/chat/informations', [itemController::class, 'getDataChat'])->name('chatData');
Route::get('/success', [StripeCheckoutController::class, 'success'])->name('stripe.success');
Route::get('/download', [DownloadController::class, 'download'])->name('file.download');
Route::get('/filter-advanced/local', [itemController::class, 'locateLocal'])->name('filter.advanced');
Route::get('/filter-advanced/all', [itemController::class, 'locateAll'])->name('filter.all');
Route::post('/create-checkout-session', [StripeCheckoutController::class, 'createCheckoutSession'])->name('checkout.create');
Route::post('/carteira/sucess', [StripeCheckoutController::class, 'InsertAmount'])->name('wallet.sucess');
Route::post('/carteira/cancell', [StripeCheckoutController::class, 'cancel'])->name('wallet.cancel');
Route::post('/create-checkout-session', [StripeCheckoutController::class, 'createCheckoutSession'])->name('checkout.create');
Route::get('/user/{user}', [itemController::class, 'Mylisting'])->name('Mylisting');
Route::get('/edit-anounce', [AnounceController::class, 'editAnounceView'])->name('edit-anounce');
Route::post('/user/anounce/delete', [itemController::class, 'delete'])->name('delete.anounce');
Route::post('/alugar/produtos/edit', [AnounceController::class, 'update'])->name('anouce.edit');
Route::post('/send-coment/post', [PageController::class, 'send_coment'])->name('comment.create');
Route::post('/send-answer/post', [PageController::class, 'send_answer'])->name('answer.create');

Route::post('/update-activity', [pageController::class, 'update'])->name('online.status');
Route::post('/update-activity/status', [pageController::class, 'check'])->name('online.check');
Route::get('/result', [itemController::class, 'dataReceive']);
Route::get('/search', [itemController::class, 'searchItem']);
Route::get('/result/category/local', [ItemController::class, 'localResults'])->name('localResults');
Route::get('/result/category', [ItemController::class, 'geralResult'])->name('categoryResults');
Route::get('/return/view', [AnounceController::class, 'components'])->name('components');

Route::middleware('auth')->group(function () {
    Route::get('/reservas', [pageController::class, 'reservations'])->name('reservations');
    Route::get('/carteira', [StripeCheckoutController::class, 'index'])->name('wallet');
    Route::get('/notify/verification', [PageController::class, 'notification'])->name('notification.verify');
    Route::get('/notify/verification/return', [PageController::class, 'notification'])->name('notification.verify.double');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ProfileController::class, 'updateProfile'])->name('updateProfile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/locador/new-anounce', [AnounceController::class, 'index'])->name('anouce.new');
    Route::get('/locador', [AnounceController::class, 'before'])->name('anouce.before');
    Route::post('/alugar/produtos/success', [AnounceController::class, 'create'])->name('anouce.create');
    Route::get('/locador/anounce/done', [AnounceController::class, 'wellcome'])->name('wellcome.done');
});



require __DIR__.'/auth.php';