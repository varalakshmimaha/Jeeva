<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CalendlyWebhookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\AdminSettingsController;

// Calendly webhook — no CSRF, no auth
Route::post('/webhooks/calendly', [CalendlyWebhookController::class, 'handle'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('webhooks.calendly');

// Page Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{id}', [PageController::class, 'serviceShow'])->name('service.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');

// Contact Form Submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/calendly/event-time', [ContactController::class, 'calendlyEventTime'])->name('calendly.event-time');
Route::get('/booked-slots', [PageController::class, 'bookedSlots'])->name('booked.slots');

// Testing & Debugging
Route::get('/debug/settings', function () {
    $settingsPath = storage_path('app/settings.json');
    $settings = [];
    
    if (file_exists($settingsPath)) {
        $settings = json_decode(file_get_contents($settingsPath), true);
    }
    
    return response()->json([
        'settings_path' => $settingsPath,
        'file_exists' => file_exists($settingsPath),
        'directory_exists' => is_dir(storage_path('app')),
        'directory_writable' => is_writable(storage_path('app')),
        'settings' => $settings,
        'map_embed' => $settings['map_embed'] ?? 'NOT SET'
    ]);
});

// API Routes for Admin Settings (to sync localStorage to backend) - Public API
Route::middleware(['api'])->group(function () {
    Route::post('/api/admin/settings/save', [AdminSettingsController::class, 'saveSettings'])->withoutMiddleware('csrf')->name('api.admin.settings.save');
    Route::get('/api/admin/settings', [AdminSettingsController::class, 'getSettings'])->name('api.admin.settings.get');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Auth Routes
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Protected Admin Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Services
        Route::get('/services', [AdminController::class, 'servicesIndex'])->name('admin.services.index');
        Route::get('/services/create', [AdminController::class, 'servicesCreate'])->name('admin.services.create');
        Route::post('/services', [AdminController::class, 'servicesStore'])->name('admin.services.store');
        Route::get('/services/{id}/edit', [AdminController::class, 'servicesEdit'])->name('admin.services.edit');
        Route::put('/services/{id}', [AdminController::class, 'servicesUpdate'])->name('admin.services.update');
        Route::delete('/services/{id}', [AdminController::class, 'servicesDestroy'])->name('admin.services.destroy');
        
        // Banners
        Route::get('/banners', [AdminController::class, 'bannersIndex'])->name('admin.banners.index');
        Route::get('/banners/create', [AdminController::class, 'bannersCreate'])->name('admin.banners.create');
        Route::post('/banners', [AdminController::class, 'bannersStore'])->name('admin.banners.store');
        Route::get('/banners/{id}/edit', [AdminController::class, 'bannersEdit'])->name('admin.banners.edit');
        Route::put('/banners/{id}', [AdminController::class, 'bannersUpdate'])->name('admin.banners.update');
        Route::delete('/banners/{id}', [AdminController::class, 'bannersDestroy'])->name('admin.banners.destroy');
        
        // Blogs
        Route::get('/blogs', [AdminController::class, 'blogsIndex'])->name('admin.blogs.index');
        Route::get('/blogs/create', [AdminController::class, 'blogsCreate'])->name('admin.blogs.create');
        Route::post('/blogs', [AdminController::class, 'blogsStore'])->name('admin.blogs.store');
        Route::get('/blogs/{id}/edit', [AdminController::class, 'blogsEdit'])->name('admin.blogs.edit');
        Route::put('/blogs/{id}', [AdminController::class, 'blogsUpdate'])->name('admin.blogs.update');
        Route::delete('/blogs/{id}', [AdminController::class, 'blogsDestroy'])->name('admin.blogs.destroy');
        
        // Gallery
        Route::get('/gallery', [AdminController::class, 'galleryIndex'])->name('admin.gallery.index');
        Route::get('/gallery/create', [AdminController::class, 'galleryCreate'])->name('admin.gallery.create');
        Route::post('/gallery', [AdminController::class, 'galleryStore'])->name('admin.gallery.store');
        Route::get('/gallery/{id}/edit', [AdminController::class, 'galleryEdit'])->name('admin.gallery.edit');
        Route::put('/gallery/{id}', [AdminController::class, 'galleryUpdate'])->name('admin.gallery.update');
        Route::delete('/gallery/{id}', [AdminController::class, 'galleryDestroy'])->name('admin.gallery.destroy');
        
        // Testimonials
        Route::get('/testimonials', [AdminController::class, 'testimonialsIndex'])->name('admin.testimonials.index');
        Route::get('/testimonials/create', [AdminController::class, 'testimonialsCreate'])->name('admin.testimonials.create');
        Route::post('/testimonials', [AdminController::class, 'testimonialsStore'])->name('admin.testimonials.store');
        Route::get('/testimonials/{id}/edit', [AdminController::class, 'testimonialsEdit'])->name('admin.testimonials.edit');
        Route::put('/testimonials/{id}', [AdminController::class, 'testimonialsUpdate'])->name('admin.testimonials.update');
        Route::delete('/testimonials/{id}', [AdminController::class, 'testimonialsDestroy'])->name('admin.testimonials.destroy');

        // FAQs
        Route::get('/faqs', [AdminController::class, 'faqsIndex'])->name('admin.faqs.index');
        Route::get('/faqs/create', [AdminController::class, 'faqsCreate'])->name('admin.faqs.create');
        Route::post('/faqs', [AdminController::class, 'faqsStore'])->name('admin.faqs.store');
        Route::get('/faqs/{id}/edit', [AdminController::class, 'faqsEdit'])->name('admin.faqs.edit');
        Route::put('/faqs/{id}', [AdminController::class, 'faqsUpdate'])->name('admin.faqs.update');
        Route::delete('/faqs/{id}', [AdminController::class, 'faqsDestroy'])->name('admin.faqs.destroy');

        // Contact Messages
        Route::get('/messages', [AdminController::class, 'messagesIndex'])->name('admin.messages.index');
        Route::get('/messages/{id}', [AdminController::class, 'messagesShow'])->name('admin.messages.show');
        Route::put('/messages/{id}/status', [AdminController::class, 'messagesUpdateStatus'])->name('admin.messages.update-status');
        Route::delete('/messages/{id}', [AdminController::class, 'messagesDestroy'])->name('admin.messages.destroy');

        // Analytics
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');

        // Settings
        Route::get('/settings', [SettingsController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
        Route::post('/settings/calendly-webhook', [SettingsController::class, 'registerCalendlyWebhook'])->name('admin.settings.calendly.webhook');
    });
});
