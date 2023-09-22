<?php

use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\MenagesController;
use App\Http\Controllers\ProfileController;
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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menages routes
    Route::get('/menages', [MenagesController::class, 'index'])->name('menages.index');
    Route::post('/menages', [MenagesController::class, 'store'])->name('menages.store');
    Route::post('/AddExpense/{id}', [MenagesController::class, 'addUserExpense'])->name('menages.addUserExpense');
    Route::get('/menageChat/{menage}', [MenagesController::class, 'chat'])->name('menages.chat');
    Route::get('/menageExpenses/{menage}', [MenagesController::class, 'expenses'])->name('menages.expenses');
    
    // Invitations route
    Route::post('/inviteUser/{id}', [InvitationsController::class, 'store'])->name('invitation.invite');
    Route::get('/invitationReject/{invitation}', [InvitationsController::class, 'reject'])->name('invitation.reject');
    Route::get('/invitationAccept/{invitation}', [InvitationsController::class, 'accept'])->name('invitation.accept');

});

require __DIR__.'/auth.php';
