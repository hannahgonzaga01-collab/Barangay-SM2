<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentImportController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ResidentPortalController;
use App\Http\Controllers\StaffPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;


// 1. Landing Page
Route::get('/', function () {
    return redirect('/login');
});

// 2. Dashboard redirect by role
Route::get('/dashboard', function () {
    $role = Auth::user()?->role;

    if ($role === 'admin')
        return redirect()->route('admin.dashboard');
    if ($role === 'office')
        return redirect()->route('office.index');
    if ($role === 'justice')
        return redirect()->route('justice.dashboard');
    if ($role === 'vawc')
        return redirect()->route('vawc.dashboard');
    if ($role === 'peace')
        return redirect()->route('peace.dashboard');
    if ($role === 'resident')
        return redirect()->route('resident.index');

    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Profile & Import (auth only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/import-residents', [ResidentImportController::class, 'show'])->name('residents.import');
    Route::post('/import-residents', [ResidentImportController::class, 'store']);
});

// 4. RESIDENT PORTAL — Public access (guests can browse & submit)
Route::get('/resident', [ResidentPortalController::class, 'index'])->name('resident.index');
Route::post('/resident/document-request', [ResidentPortalController::class, 'storeDocumentRequest'])->name('resident.document.request');
Route::post('/resident/issue-report', [ResidentPortalController::class, 'storeIssueReport'])->name('resident.issue.report');
Route::post('/resident/notifications/read', [ResidentPortalController::class, 'markNotificationsRead'])->name('resident.notifications.read');
Route::post('/resident/message/send', [ResidentPortalController::class, 'sendMessage'])->name('resident.message.send');

Route::post('/resident/digital-id', [ResidentPortalController::class, 'requestDigitalId'])
    ->middleware('auth')
    ->name('resident.digital.id.request');

// 5. Staff & Admin (auth required)
Route::middleware(['auth', 'verified'])->group(function () {

    // ── ADMIN DASHBOARD ──
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/lgu-sync', [AdminController::class, 'syncLguJson'])->name('admin.lgu.sync');

    // ── Admin Officials ──
    Route::post('/admin/officials', [AdminController::class, 'storeOfficial'])->name('admin.officials.store');
    Route::put('/admin/officials/{id}', [AdminController::class, 'updateOfficial'])->name('admin.officials.update');
    Route::patch('/admin/officials/{id}/archive', [AdminController::class, 'archiveOfficial'])->name('admin.officials.archive');
    Route::patch('/admin/officials/{id}/restore', [AdminController::class, 'restoreOfficial'])->name('admin.officials.restore');

    // ── Admin Announcements ──
    Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::put('/admin/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.announcements.update');
    Route::patch('/admin/announcements/{id}/archive', [AdminController::class, 'archiveAnnouncement'])->name('admin.announcements.archive');
    Route::patch('/admin/announcements/{id}/restore', [AdminController::class, 'restoreAnnouncement'])->name('admin.announcements.restore');

    // ── Admin Events ──
    Route::post('/admin/events', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    Route::put('/admin/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::patch('/admin/events/{id}/archive', [AdminController::class, 'archiveEvent'])->name('admin.events.archive');
    Route::patch('/admin/events/{id}/restore', [AdminController::class, 'restoreEvent'])->name('admin.events.restore');

    // ── Admin Messages ──
    Route::patch('/admin/messages/{id}/read', [AdminController::class, 'markMessageRead'])->name('admin.message.read');
    Route::post('/admin/messages/{id}/reply', [AdminController::class, 'replyMessage'])->name('admin.message.reply');

    // ── STAFF PASSWORD CHANGE ──
    Route::get('/staff/change-password', [StaffPasswordController::class, 'show'])->name('staff.password.show');
    Route::post('/staff/change-password', [StaffPasswordController::class, 'update'])->name('staff.password.update');

    // ── OFFICE ──
    Route::get('/office', [OfficeController::class, 'index'])->name('office.index');
    Route::post('/office', [OfficeController::class, 'store'])->name('office.store');
    Route::get('/office/{id}/edit', [OfficeController::class, 'edit'])->name('office.edit');
    Route::put('/office/{id}', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('/office/{id}', [OfficeController::class, 'destroy'])->name('office.destroy');
    Route::patch('/office/{id}/archive', [OfficeController::class, 'archive'])->name('office.archive');
    Route::patch('/office/{id}/restore', [OfficeController::class, 'restore'])->name('office.restore');

    // ── Office Document Requests ──
    Route::patch('/office/document-request/{id}/status', [OfficeController::class, 'updateDocumentStatus'])->name('office.document.status');
    Route::get('/office/document-request/{id}/json', [OfficeController::class, 'getDocumentRequest'])->name('office.document.request.json');

    // ── Office Digital ID ──
    Route::post('/office/digital-id/{id}/generate', [OfficeController::class, 'generateDigitalId'])->name('office.digital.id.generate');

    // ── PETS ──
    Route::post('/pets/store', [OfficeController::class, 'storePet'])->name('pets.store');
    Route::delete('/pets/{id}', [OfficeController::class, 'destroyPet'])->name('pets.destroy');
    Route::patch('/pets/{id}/status', [OfficeController::class, 'updatePetStatus'])->name('pets.status');

    // ── JUSTICE ──
    Route::get('/justice', [\App\Http\Controllers\JusticeController::class, 'dashboard'])->name('justice.dashboard');
    Route::post('/justice/blotter', [\App\Http\Controllers\JusticeController::class, 'storeBlotter'])->name('justice.blotter.store');
    Route::post('/justice/summons/issue', [\App\Http\Controllers\JusticeController::class, 'issueSummon'])->name('justice.summons.issue');
    Route::patch('/justice/blotter/{id}/status', [\App\Http\Controllers\JusticeController::class, 'updateStatus']);

    // ── VAWC ──
    Route::get('/vawc', [\App\Http\Controllers\VawcController::class, 'index'])->name('vawc.dashboard');
    Route::patch('/vawc/issues/{id}/status', [\App\Http\Controllers\VawcController::class, 'updateStatus']);
    Route::patch('/vawc/issues/{id}/summary', [\App\Http\Controllers\VawcController::class, 'updateSummary']);
    Route::post('/vawc/issues', [\App\Http\Controllers\VawcController::class, 'storeIncident']);
    Route::post('/vawc/issues/{id}/pnp-referral', [\App\Http\Controllers\VawcController::class, 'pnpReferral']);
    Route::get('/vawc/issues/{id}/print-referral', [\App\Http\Controllers\VawcController::class, 'printReferral']);

    // ── PEACE AND ORDER ──
    Route::get('/peace', function () { return view('peace and order.index'); })->name('peace.dashboard');
    Route::post('/peace/blotter', [\App\Http\Controllers\PeaceController::class, 'storeBlotter'])->name('peace.blotter.store');
    Route::post('/peace/patrol', [\App\Http\Controllers\PeaceController::class, 'storePatrol'])->name('peace.patrol.store');
    Route::patch('/peace/issues/{id}/status', [\App\Http\Controllers\PeaceController::class, 'updateStatus']);
    Route::patch('/peace/issues/{id}/summary', [\App\Http\Controllers\PeaceController::class, 'updateSummary']);
    Route::patch('/peace/issues/{id}/escalate', [\App\Http\Controllers\PeaceController::class, 'escalateToJustice']);

});

require __DIR__ . '/auth.php';
