<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\ClientController;

// Auth redirects to admin login by default
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');



// ─── Frontend Routes ────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [HomeController::class, 'plans'])->name('plans');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [HomeController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/refund-policy', [HomeController::class, 'refund'])->name('refund');
Route::get('/sample-report', [HomeController::class, 'sampleReport'])->name('sample.report');

// ─── Onboarding & Payment ───────────────────────────────────
Route::get('/onboard/{plan}', [OnboardingController::class, 'show'])->name('onboard');
Route::post('/onboard/{plan}', [OnboardingController::class, 'store'])->name('onboard.store');
Route::get('/payment/{subscription}', [PaymentController::class, 'show'])->name('payment');
Route::post('/payment/{subscription}', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/success/{subscription}', [PaymentController::class, 'success'])->name('success');
Route::get('/invoice/{invoice}', [PaymentController::class, 'publicInvoice'])->name('invoice.public');

// ─── Admin Routes ───────────────────────────────────────────
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients');
        Route::get('/clients/{id}', [AdminController::class, 'clientShow'])->name('admin.clients.show');

        Route::get('/report', [AdminController::class, 'report'])->name('admin.report');

        Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('admin.subscriptions');
        Route::get('/upcoming-dues', [AdminController::class, 'upcomingDues'])->name('admin.dues');

        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/profile', [AdminController::class, 'profileEdit'])->name('admin.profile.edit');
        Route::put('/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');

        Route::middleware('role:admin,manager')->group(function () {
            Route::get('/clients/{id}/edit', [AdminController::class, 'clientEdit'])->name('admin.clients.edit');
            Route::put('/clients/{id}', [AdminController::class, 'clientUpdate'])->name('admin.clients.update');
            Route::patch('/clients/{id}/suspend', [AdminController::class, 'clientSuspend'])->name('admin.clients.suspend');
            Route::patch('/clients/{id}/activate', [AdminController::class, 'clientActivate'])->name('admin.clients.activate');
            Route::post('/upcoming-dues/{id}/send-reminder', [AdminController::class, 'sendUpcomingDueReminder'])->name('admin.dues.send-reminder');

            Route::get('/invoices', [AdminController::class, 'invoices'])->name('admin.invoices');
            Route::get('/invoices/{id}', [AdminController::class, 'invoiceShow'])->name('admin.invoices.show');
        });

        Route::middleware('role:admin')->group(function () {
            Route::delete('/clients/{id}', [AdminController::class, 'clientDelete'])->name('admin.clients.delete');

            Route::get('/subscriptions/create', [AdminController::class, 'subscriptionCreate'])->name('admin.subscriptions.create');
            Route::post('/subscriptions', [AdminController::class, 'subscriptionStore'])->name('admin.subscriptions.store');
            Route::get('/subscriptions/{id}/edit', [AdminController::class, 'subscriptionEdit'])->name('admin.subscriptions.edit');
            Route::put('/subscriptions/{id}', [AdminController::class, 'subscriptionUpdate'])->name('admin.subscriptions.update');
            Route::get('/plans', [AdminController::class, 'plans'])->name('admin.plans');
            Route::get('/plans/{id}/edit', [AdminController::class, 'planEdit'])->name('admin.plans.edit');
            Route::put('/plans/{id}', [AdminController::class, 'planUpdate'])->name('admin.plans.update');
            Route::put('/plans/{id}', [AdminController::class, 'planUpdate'])->name('admin.plans.update');
    Route::post('/plan-features', [AdminController::class, 'planFeatureStore'])->name('admin.plan-features.store');

            Route::put('/plan-features/{id}', [AdminController::class, 'planFeatureUpdate'])->name('admin.plan-features.update');
            Route::delete('/plan-features/{id}', [AdminController::class, 'planFeatureDelete'])->name('admin.plan-features.delete');


            Route::get('/users/create', [AdminController::class, 'userCreate'])->name('admin.users.create');
            Route::post('/users', [AdminController::class, 'userStore'])->name('admin.users.store');
            Route::get('/users/{id}/edit', [AdminController::class, 'userEdit'])->name('admin.users.edit');
            Route::put('/users/{id}', [AdminController::class, 'userUpdate'])->name('admin.users.update');
            Route::delete('/users/{id}', [AdminController::class, 'userDelete'])->name('admin.users.delete');
        });
    });
});

Route::get('/run-migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return "<h1>Database Migrated Successfully!</h1>";
});

Route::get('/run-clear', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "<h1>All Caches Cleared!</h1>";
});

Route::get('/run-link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return "<h1>Storage Link Created!</h1>";
});
