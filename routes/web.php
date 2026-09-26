<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentImportController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ResidentPortalController;
use App\Http\Controllers\StaffPasswordController;
use App\Http\Controllers\DepartmentReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect()->route('resident.index');
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

// 4. RESIDENT PORTAL
Route::middleware(['verified_resident'])->group(function () {
    Route::get('/resident', [ResidentPortalController::class, 'index'])->name('resident.index');
    Route::post('/resident/document-request', [ResidentPortalController::class, 'storeDocumentRequest'])->name('resident.document.request');
    Route::get('/resident/document-request', fn() => redirect()->route('resident.index'));
    Route::post('/resident/issue-report', [ResidentPortalController::class, 'storeIssueReport'])->name('resident.issue.report');
    Route::get('/resident/issue-report', fn() => redirect()->route('resident.index'));
    Route::post('/resident/digital-id/request', [ResidentPortalController::class, 'requestDigitalId'])->name('resident.digital.id.request');
    Route::get('/resident/digital-id/request', fn() => redirect()->route('resident.index'));
    Route::post('/resident/voter/upload', [ResidentPortalController::class, 'reuploadVoterId'])->name('resident.voter.upload');
    Route::get('/resident/voter/upload', fn() => redirect()->route('resident.index'));
    Route::post('/resident/message', [ResidentPortalController::class, 'sendMessage'])->name('resident.message.send');
    Route::get('/resident/message', fn() => redirect()->route('resident.index'));
    Route::post('/resident/notifications/read', [ResidentPortalController::class, 'markNotificationsRead'])->name('resident.notifications.read');
    Route::post('/resident/profile-photo', [ResidentPortalController::class, 'uploadProfilePhoto'])->name('resident.profile.photo')->middleware('auth');
    Route::get('/resident/profile-photo', fn() => redirect()->route('resident.index'));
    Route::post('/resident/family', [ResidentPortalController::class, 'storeFamilyMember'])->name('resident.family.store')->middleware('auth');
    Route::get('/resident/family', fn() => redirect()->route('resident.index'));
    Route::post('/resident/email', [ResidentPortalController::class, 'updateResidentEmail'])->name('resident.email.update')->middleware('auth');
    Route::get('/resident/email', fn() => redirect()->route('resident.index'));

    Route::post('/resident/digital-id', [ResidentPortalController::class, 'requestDigitalId'])
        ->middleware('auth')
        ->name('resident.digital.id.request.alias');
    Route::get('/resident/digital-id', fn() => redirect()->route('resident.index'));
    Route::post('/resident/pet/{id}', [ResidentPortalController::class, 'updatePet'])->name('resident.pet.update')->middleware('auth');
    Route::post('/resident/document-request/{id}/reschedule', [ResidentPortalController::class, 'rescheduleDocument'])->name('resident.document.reschedule');
    Route::get('/resident/document-request/availability', [ResidentPortalController::class, 'checkAvailability'])->name('resident.document.availability');
    Route::post('/resident/emergency-sos', [ResidentPortalController::class, 'storeEmergencySos'])->name('resident.emergency.sos');
    Route::get('/resident/emergency-sos', fn() => redirect()->route('resident.index'));
});

// 5. Staff & Admin (auth required)
Route::middleware(['auth', 'verified'])->group(function () {

    // ── ADMIN DASHBOARD ──
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ── Admin Officials ──
    Route::post('/admin/officials', [AdminController::class, 'storeOfficial'])->name('admin.officials.store');
    Route::put('/admin/officials/{id}', [AdminController::class, 'updateOfficial'])->name('admin.officials.update');
    Route::patch('/admin/officials/{id}/archive', [AdminController::class, 'archiveOfficial'])->name('admin.officials.archive');
    Route::patch('/admin/officials/{id}/restore', [AdminController::class, 'restoreOfficial'])->name('admin.officials.restore');
    Route::delete('/admin/officials/{id}', [AdminController::class, 'destroyOfficial'])->name('admin.officials.destroy');

    // ── Admin Announcements ──
    Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::put('/admin/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.announcements.update');
    Route::patch('/admin/announcements/{id}/archive', [AdminController::class, 'archiveAnnouncement'])->name('admin.announcements.archive');
    Route::patch('/admin/announcements/{id}/restore', [AdminController::class, 'restoreAnnouncement'])->name('admin.announcements.restore');
    Route::delete('/admin/announcements/{id}', [AdminController::class, 'destroyAnnouncement'])->name('admin.announcements.destroy');

    // ── Admin Events ──
    Route::post('/admin/events', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    Route::put('/admin/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::patch('/admin/events/{id}/archive', [AdminController::class, 'archiveEvent'])->name('admin.events.archive');
    Route::patch('/admin/events/{id}/restore', [AdminController::class, 'restoreEvent'])->name('admin.events.restore');
    Route::delete('/admin/events/{id}', [AdminController::class, 'destroyEvent'])->name('admin.events.destroy');

    // ── Admin Projects ──
    Route::post('/admin/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::put('/admin/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::patch('/admin/projects/{id}/archive', [AdminController::class, 'archiveProject'])->name('admin.projects.archive');
    Route::patch('/admin/projects/{id}/restore', [AdminController::class, 'restoreProject'])->name('admin.projects.restore');
    Route::delete('/admin/projects/{id}', [AdminController::class, 'destroyProject'])->name('admin.projects.destroy');
    
    // ── Admin Carousel ──
    Route::post('/admin/carousel', [AdminController::class, 'storeCarouselSlide'])->name('admin.carousel.store');
    Route::put('/admin/carousel/{id}', [AdminController::class, 'updateCarouselSlide'])->name('admin.carousel.update');
    Route::delete('/admin/carousel/{id}', [AdminController::class, 'destroyCarouselSlide'])->name('admin.carousel.destroy');
    Route::post('/admin/carousel/link/{type}/{id}', [AdminController::class, 'linkToCarousel'])->name('admin.carousel.link');

    // ── Admin Site Settings ──
    Route::post('/admin/settings', [AdminController::class, 'updateSiteSetting'])->name('admin.settings.update');

    // ── Staff Portal Security & Password Recovery Q&A ──
    Route::post('/admin/staff-security/update', [AdminController::class, 'updateStaffSecurity'])->name('admin.staff-security.update');

    // ── Admin Messages ──
    Route::patch('/admin/messages/{id}/read', [AdminController::class, 'markMessageRead'])->name('admin.message.read');
    Route::post('/admin/messages/{id}/reply', [AdminController::class, 'replyMessage'])->name('admin.message.reply');

    // ── STAFF PASSWORD CHANGE ──
    Route::get('/staff/change-password', [StaffPasswordController::class, 'show'])->name('staff.password.show');
    Route::post('/staff/change-password', [StaffPasswordController::class, 'update'])->name('staff.password.update');
    Route::post('/staff/change-password/otp', [StaffPasswordController::class, 'sendOtp'])->name('staff.password.otp');

    // ── OFFICE ──
    Route::get('/office', [OfficeController::class, 'index'])->name('office.index');
    Route::get('/office/export', [OfficeController::class, 'export'])->name('office.export');
    Route::post('/office', [OfficeController::class, 'store'])->name('office.store');
    Route::get('/office/{id}/edit', [OfficeController::class, 'edit'])->name('office.edit');
    Route::put('/office/{id}', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('/office/{id}', [OfficeController::class, 'destroy'])->name('office.destroy');
    Route::patch('/office/{id}/archive', [OfficeController::class, 'archive'])->name('office.archive');
    Route::patch('/office/{id}/restore', [OfficeController::class, 'restore'])->name('office.restore');
    Route::get('/office/family/{id}', [OfficeController::class, 'getFamily'])->name('office.family');

    // ── Office Document Requests & Templates ──
    Route::patch('/office/document-request/{id}/status', [OfficeController::class, 'updateDocumentStatus'])->name('office.document.status');
    Route::get('/office/document-request/{id}/json', [OfficeController::class, 'getDocumentRequest'])->name('office.document.request.json');
    Route::delete('/office/document-request/{id}', [OfficeController::class, 'destroyDocumentRequest'])->name('office.document.destroy');
    Route::post('/office/document-requests/purge-archive', [OfficeController::class, 'purgeArchivedRequests'])->name('office.document.purge-archive');
    Route::get('/office/document-templates', [\App\Http\Controllers\DocumentTemplateController::class, 'all'])->name('office.document.templates');
    Route::post('/office/document-templates/{key}', [\App\Http\Controllers\DocumentTemplateController::class, 'update'])->name('office.document.templates.update');
    Route::post('/office/document-templates/{key}/reset', [\App\Http\Controllers\DocumentTemplateController::class, 'reset'])->name('office.document.templates.reset');

    // ── Office Digital ID ──
    Route::post('/office/digital-id/{id}/generate', [OfficeController::class, 'generateDigitalId'])->name('office.digital.id.generate');
    Route::post('/office/digital-id/generate-manual/{resident_id}', [OfficeController::class, 'generateManualDigitalId'])->name('office.digital.id.generate-manual');

    // ── Office Voter Verification & Import ──
    Route::post('/office/import', [OfficeController::class, 'import'])->name('office.import');
    Route::post('/office/voter-verification/{user}/approve', [OfficeController::class, 'approveVoter'])->name('office.voter.approve');
    Route::post('/office/voter-verification/{user}/decline', [OfficeController::class, 'declineVoter'])->name('office.voter.decline');

    // ── Office Resident Verification ──
    Route::post('/office/resident-verification/{id}/approve', [OfficeController::class, 'approveResident'])->name('office.resident.approve');
    Route::post('/office/resident-verification/{id}/reject', [OfficeController::class, 'rejectResident'])->name('office.resident.reject');

    // ── Office Smart Masterlist Registrant Verification ──
    Route::post('/office/verifications/{id}/approve', [OfficeController::class, 'approveVerification'])->name('office.verification.approve');
    Route::post('/office/verifications/{id}/reject', [OfficeController::class, 'rejectVerification'])->name('office.verification.reject');


    // ── PETS ──
    Route::post('/pets/store', [OfficeController::class, 'storePet'])->name('pets.store');
    Route::delete('/pets/{id}', [OfficeController::class, 'destroyPet'])->name('pets.destroy');
    Route::patch('/pets/{id}/restore', [OfficeController::class, 'restorePet'])->name('pets.restore');
    Route::patch('/pets/{id}/status', [OfficeController::class, 'updatePetStatus'])->name('pets.status');
    Route::post('/pets/{id}/approve-vaccine', [OfficeController::class, 'approvePetVaccine'])->name('office.pets.approve-vaccine');

    // ── JUSTICE ──
    Route::get('/justice', [\App\Http\Controllers\JusticeController::class, 'dashboard'])->name('justice.dashboard');
    Route::post('/justice/blotter', [\App\Http\Controllers\JusticeController::class, 'storeBlotter'])->name('justice.blotter.store');
    Route::patch('/justice/blotter/{id}/status', [\App\Http\Controllers\JusticeController::class, 'updateStatus']);
    Route::post('/justice/summons/issue', [\App\Http\Controllers\JusticeController::class, 'issueSummon'])->name('justice.summons.issue');
    Route::get('/justice/export', [\App\Http\Controllers\JusticeController::class, 'export'])->name('justice.export');
    Route::post('/justice/import', [\App\Http\Controllers\JusticeController::class, 'importBlotter'])->name('justice.import');
    Route::get('/justice/sample-template', [\App\Http\Controllers\JusticeController::class, 'sampleTemplate'])->name('justice.sample.template');

    // ── VAWC ──
    Route::get('/vawc', [\App\Http\Controllers\VawcController::class, 'index'])->name('vawc.dashboard');
    Route::patch('/vawc/issues/{id}/status', [\App\Http\Controllers\VawcController::class, 'updateStatus']);
    Route::patch('/vawc/issues/{id}/summary', [\App\Http\Controllers\VawcController::class, 'updateSummary']);
    Route::patch('/vawc/issues/{id}/referral-details', [\App\Http\Controllers\VawcController::class, 'updateReferralDetails'])->name('vawc.referral.update');
    Route::post('/vawc/issues/{id}/upload-document', [\App\Http\Controllers\VawcController::class, 'uploadOfficialDocument'])->name('vawc.document.upload');
    Route::delete('/vawc/issues/{id}/remove-document', [\App\Http\Controllers\VawcController::class, 'removeOfficialDocument'])->name('vawc.document.remove');
    Route::post('/vawc/issues', [\App\Http\Controllers\VawcController::class, 'storeIncident']);
    Route::post('/vawc/issues/{id}/pnp-referral', [\App\Http\Controllers\VawcController::class, 'pnpReferral']);
    Route::get('/vawc/issues/{id}/print-referral', [\App\Http\Controllers\VawcController::class, 'printReferral']);
    Route::patch('/vawc/issues/{id}/transfer-peace', [\App\Http\Controllers\VawcController::class, 'transferToPeace'])->name('vawc.transfer.peace');
    Route::get('/vawc/export', [\App\Http\Controllers\VawcController::class, 'export'])->name('vawc.export');
    Route::post('/vawc/import', [\App\Http\Controllers\VawcController::class, 'importBlotter'])->name('vawc.import');
    Route::get('/vawc/sample-template', [\App\Http\Controllers\VawcController::class, 'sampleTemplate'])->name('vawc.sample.template');
    Route::get('/vawc/audit-logs', [\App\Http\Controllers\VawcController::class, 'getAuditLogs'])->name('vawc.audit.logs');

    // ── PEACE AND ORDER ──
    Route::get('/peace',   [\App\Http\Controllers\PeaceController::class, 'dashboard'])->name('peace.dashboard');
    Route::post('/peace/blotter', [\App\Http\Controllers\PeaceController::class, 'storeBlotter'])->name('peace.blotter.store');
    Route::post('/peace/patrol', [\App\Http\Controllers\PeaceController::class, 'storePatrol'])->name('peace.patrol.store');
    Route::patch('/peace/patrol/{id}/proof', [\App\Http\Controllers\PeaceController::class, 'updatePatrolProof'])->name('peace.patrol.proof');
    Route::patch('/peace/patrol/{id}/status', [\App\Http\Controllers\PeaceController::class, 'updatePatrolStatus'])->name('peace.patrol.status');
    Route::delete('/peace/patrol/{id}', [\App\Http\Controllers\PeaceController::class, 'destroyPatrol'])->name('peace.patrol.destroy');
    Route::patch('/peace/issues/{id}/status', [\App\Http\Controllers\PeaceController::class, 'updateStatus']);
    Route::patch('/peace/issues/{id}/summary', [\App\Http\Controllers\PeaceController::class, 'updateSummary']);
    Route::patch('/peace/issues/{id}/escalate-justice', [\App\Http\Controllers\PeaceController::class, 'escalateToJustice']);
    Route::patch('/peace/issues/{id}/transfer-vawc', [\App\Http\Controllers\PeaceController::class, 'transferToVawc'])->name('peace.transfer.vawc');
    Route::get('/peace/sos-alerts', [\App\Http\Controllers\PeaceController::class, 'getSosAlerts'])->name('peace.sos.alerts');
    Route::match(['patch', 'post'], '/peace/sos-alerts/{id}/status', [\App\Http\Controllers\PeaceController::class, 'updateSosStatus'])->name('peace.sos.update');
    Route::match(['patch', 'post'], '/peace-and-order/sos/{id}/status', [\App\Http\Controllers\PeaceController::class, 'updateSosStatus']);
    Route::get('/peace/export', [\App\Http\Controllers\PeaceController::class, 'export'])->name('peace.export');
    Route::post('/peace/import', [\App\Http\Controllers\PeaceController::class, 'importBlotter'])->name('peace.import');
    Route::get('/peace/sample-template', [\App\Http\Controllers\PeaceController::class, 'sampleTemplate'])->name('peace.sample.template');

    // ── DEPARTMENT SUBMITTED REPORTS ──
    Route::post('/department-reports/submit', [DepartmentReportController::class, 'submit'])->name('department.reports.submit');
    Route::get('/department-reports/{id}', [DepartmentReportController::class, 'show'])->name('department.reports.show');
    Route::post('/department-reports/template-upload', [DepartmentReportController::class, 'uploadTemplate'])->name('department.reports.upload_template');
    Route::match(['delete', 'post'], '/department-reports/template-delete', [DepartmentReportController::class, 'deleteTemplate'])->name('department.reports.delete_template');

    // ── BACKUP & MAINTENANCE ──
    Route::get('/admin/backups', [\App\Http\Controllers\BackupController::class, 'index']);
    Route::post('/admin/backups/run', [\App\Http\Controllers\BackupController::class, 'run']);
    Route::get('/admin/backups/download/{filename}', [\App\Http\Controllers\BackupController::class, 'download']);
    Route::delete('/admin/backups/delete/{filename}', [\App\Http\Controllers\BackupController::class, 'destroy']);
});

// ── GRACEFUL STORAGE ASSET FALLBACK ROUTE ──
// Ensures uploaded images or lost ephemeral files never show broken image icons
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (file_exists($fullPath)) {
        return response()->file($fullPath);
    }
    $imgFallback = public_path('images/cleanup.jpg');
    if (file_exists($imgFallback)) {
        return response()->file($imgFallback);
    }
    abort(404);
})->where('path', '.*');

require __DIR__ . '/auth.php';
