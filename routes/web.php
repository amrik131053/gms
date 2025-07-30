<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\BusPassController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SmartCardController;
use App\Http\Controllers\ExamFormController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PayuPaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\AdmitCardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\GrievanceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StudentLeaveController;
use App\Http\Controllers\ApplyDocumentsController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Middleware\CheckAuthentication;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
// Auth Routes
Route::get('/', [AuthController::class, 'loginPage'])->name('index');
Route::get('dashboard', [AuthController::class, 'mainDashboard'])->name('dashboard')->middleware(CheckAuthentication::class);
Route::get('login', [AuthController::class, 'loginPage']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forgot', [AuthController::class, 'forgotPasswordAction']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware(CheckAuthentication::class);
Route::get('password_change', [AuthController::class, 'showPasswordChangeForm'])->name('password_change')->middleware(CheckAuthentication::class);
Route::post('passwordchangeAction', [AuthController::class, 'passwordchangeAction'])->name('passwordchangeAction');

// Fee Routes
Route::get('feeReceipt', [FeeController::class, 'feeReceipts'])->name('feeReceipt')->middleware(CheckAuthentication::class);
Route::post('fetch-receipt', [FeeController::class, 'generateReceiptPDF'])->name('/fetch-receipt');
// bus pass Routes
Route::get('applyBusPass', [BusPassController::class, 'busPassPage'])->name('applyBusPass')->middleware(CheckAuthentication::class);
Route::post('/fetch-spots', [BusPassController::class, 'fetchSpots']);
// Route::post('/submitBusPass', [BusPassController::class, 'submitBusPass']);
Route::post('submitBusPass', [BusPassController::class, 'submitBusPass'])->name('submitBusPass');
Route::post('fetch-buss-pass', [BusPassController::class, 'fetchPass'])->name('fetch-buss-pass');

// Results
Route::get('results', [ResultController::class, 'allresults'])->name('results')->middleware(CheckAuthentication::class);
Route::post('fetch-result', [ResultController::class, 'generateResultPDF'])->name('/fetch-result');
// Smart card
Route::get('applysmartCard', [SmartCardController::class, 'applysmartCard'])->name('applysmartCard')->middleware(CheckAuthentication::class);
Route::post('submitSmartCard', [SmartCardController::class, 'submitSmartCard'])->name('submitSmartCard');

// Apply Exam Form Regular
Route::get('RegularExamForm', [ExamFormController::class, 'RegularExamFormNormal'])->name('RegularExamForm')->middleware(CheckAuthentication::class);
Route::get('RegularAgriExamForm', [ExamFormController::class, 'RegularExamFormAgri'])->name('RegularAgriExamForm')->middleware(CheckAuthentication::class);
Route::get('RegularPhdExamForm', [ExamFormController::class, 'RegularExamFormPHD'])->name('RegularPhdExamForm')->middleware(CheckAuthentication::class);
// Apply Exam Form Reappear
Route::get('ReappearExamForm', [ExamFormController::class, 'ReappearExamFormNormal'])->name('ReappearExamForm')->middleware(CheckAuthentication::class);
Route::get('ReappearAgriExamForm', [ExamFormController::class, 'ReappearExamFormAgri'])->name('ReappearAgriExamForm')->middleware(CheckAuthentication::class);
Route::get('ReappearPhdExamForm', [ExamFormController::class, 'ReappearExamFormPHD'])->name('ReappearPhdExamForm')->middleware(CheckAuthentication::class);
Route::get('MyExamForms', [ExamFormController::class, 'MyExamForms'])->name('MyExamForms')->middleware(CheckAuthentication::class);
Route::post('searchExamForms', [ExamFormController::class, 'searchExamForm'])->name('searchExamForms')->middleware(CheckAuthentication::class);
Route::post('submitSubjects', [ExamFormController::class, 'submitExamForm'])->name('submitSubjects')->middleware(CheckAuthentication::class);
Route::post('/fetch-exam-form', [ExamFormController::class, 'fetchForm'])->name('/fetch-exam-form');

//Admit Card
Route::match(['get', 'post'], '/AdmitCard', [AdmitCardController::class, 'AdmitCards'])->name('AdmitCard')->middleware(CheckAuthentication::class);
Route::post('/download-admit-card', [AdmitCardController::class, 'generateAdmitCardPDF'])->name('downloadAdmitCard');
// Route::match(['get', 'post'], '/AdmitCard', [AdmitCardController::class, 'AdmitCards'])->name('AdmitCard');
Route::post('/fetch-no-dues-record', [AdmitCardController::class, 'fetchNoDuesAPI'])->name('/fetch-no-dues-record');

//study metrial
Route::get('study-material', [AcademicsController::class, 'studyMaterial'])->name('studymaterial')->middleware(CheckAuthentication::class);
Route::post('/fetch-subject', [AcademicsController::class, 'fetchsubject'])->middleware(CheckAuthentication::class);
Route::post('searchStudyMaterial', [AcademicsController::class, 'searchStudy'])->name('searchStudyMaterial')->middleware(CheckAuthentication::class);
Route::get('searchStudyMaterial', [AcademicsController::class, 'studyMaterial'])->name('study-material')->middleware(CheckAuthentication::class);


// profile
Route::get('profile', [ProfileController::class, 'showProfilePage'])->name('showProfilePage')->middleware(CheckAuthentication::class);
Route::post('submitProfileData', [ProfileController::class, 'submitProfileForm'])->name('submitProfileData')->middleware(CheckAuthentication::class);
Route::post('upload-student-image', [ProfileController::class, 'uploadImage'])->name('upload-student-image')->middleware(CheckAuthentication::class);
Route::post('upload-student-signature', [ProfileController::class, 'uploadsignature'])->name('upload-student-signature')->middleware(CheckAuthentication::class);



// News Routes
// Route::post('/show-news-details', [NewsController::class, 'showNewsDetails'])->middleware(CheckAuthentication::class);

// correction details
Route::get('correctionRequest', [ProfileController::class, 'correctionRequest'])->name('correctionrequest')->middleware(CheckAuthentication::class);
Route::post('submitCorrectionData', [ProfileController::class, 'submitCorrectionForm'])->name('submitCorrectionData')->middleware(CheckAuthentication::class);
// grievance 
Route::get('grievance', [GrievanceController::class, 'grievance'])->name('grievance')->middleware(CheckAuthentication::class);
Route::post('submitGrievanceData', [GrievanceController::class, 'submitGrievanceForm'])->name('submitGrievanceData')->middleware(CheckAuthentication::class);
Route::post('complaintTrack', [GrievanceController::class, 'complaintTrack'])->name('complaintTrack')->middleware(CheckAuthentication::class);

// hostel leave 
Route::get('leaveApply', [StudentLeaveController::class, 'applyHostelLeave'])->name('applyHostelLeave')->middleware(CheckAuthentication::class);
Route::post('submitHostelLeaveData', [StudentLeaveController::class, 'submitHostelLeaveForm'])->name('submitHostelLeaveData')->middleware(CheckAuthentication::class);
// Route::post('complaintTrack', [StudentLeaveController::class, 'complaintTrack'])->name('complaintTrack')->middleware(CheckAuthentication::class);

//Library
Route::get('library', [LibraryController::class, 'libraryBooks'])->name('libraryBooks')->middleware(CheckAuthentication::class);
Route::post('searchBooks', [LibraryController::class, 'searchBooksApi'])->name('searchBooks')->middleware(CheckAuthentication::class);
Route::get('searchBooks', [LibraryController::class, 'libraryBooks'])->name('searchBooks')->middleware(CheckAuthentication::class);

Route::get('libraryDetails', [LibraryController::class, 'libraryDetailsBooks'])->name('libraryDetailsBooks')->middleware(CheckAuthentication::class);
Route::get('libraryBooksReturn', [LibraryController::class, 'libraryBooksReturnAction'])->name('libraryBooksReturn')->middleware(CheckAuthentication::class);

//document uploads
Route::get('documents', [DocumentController::class, 'showDocumentPage'])->name('showDocumentPage')->middleware(CheckAuthentication::class);
Route::post('/upload-document', [DocumentController::class, 'upload'])->name('documentupload');

// Apply Documents
Route::get('applyDocuments', [ApplyDocumentsController::class, 'applyDocuments'])->name('applyDocuments')->middleware(CheckAuthentication::class);
Route::post('/fetch-required', [ApplyDocumentsController::class, 'fetchRequired'])->middleware(CheckAuthentication::class);
Route::post('/fetch-states', [ApplyDocumentsController::class, 'fetchState']);
Route::post('/fetch-citys', [ApplyDocumentsController::class, 'fetchcity']);
Route::post('/submit-document', [ApplyDocumentsController::class, 'submitDocument'])->name('submit-document');
Route::post('fetch-apply-documents', [ApplyDocumentsController::class, 'fetchDocument'])->name('fetch-apply-documents');
Route::get('/{id}', [ApplyDocumentsController::class, 'view'])->name('apply-documents-view');
Route::post('/finalize/{id}', [ApplyDocumentsController::class, 'finalize'])->name('apply-documents-finalize');
Route::post('/apply-documents/upload-document', [ApplyDocumentsController::class, 'uploadDocument'])->name('apply-documents.upload-document');
Route::put('/apply-documents/update-address/{id}', [ApplyDocumentsController::class, 'updateAddress'])->name('apply-documents.update-address');
Route::any('/get-document-charges', [ApplyDocumentsController::class, 'getDocumentCharges'])->name('document.charges');

//payment gateway PayU
Route::any('/payu/form', [PayuPaymentController::class, 'showPaymentForm'])->name('payu.form');
Route::any('/payu/confirm/{encryptedId}', [PayuPaymentController::class, 'showConfirmation'])->name('payu.confirm');
Route::any('/payu/fee/{encryptedId}', [PayuPaymentController::class, 'showConfirmationOpen'])->name('payu.confirm-fee');
Route::post('/payu/initiate', [PayuPaymentController::class, 'startPayment'])->name('payu.initiate');
Route::post('/sync-fee', [PayuPaymentController::class, 'syncfee'])->name('sync-fee');


