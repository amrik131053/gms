<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\PayuPaymentController;

// Route::post('payu/initiate', [PayuPaymentController::class, 'startPaymentAPI']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(AuthController::class)->group(function(){
//     Route::post('login','login');
//     Route::post('register','register');
// });

// // API endpoint for PayU payment response
// Route::post('payu/payment-response', [PayuPaymentController::class, 'paymentResponseMobile'])->name('api.payu.response');
// Route::post('payu/payment-response-web', [PayuPaymentController::class, 'paymentResponse'])->name('api.payu.response');

// // API endpoints for success/failure
// Route::get('payu/payment-success', function (Request $request) {
//     return response()->json([
//         'success' => true,
//         'message' => 'Payment Successful!',
//         'data' => [
//             'txnid' => $request->txnid,
//             'mihpayid' => $request->mihpayid,
//             'amount' => $request->amount,
//         ],
//     ]);
// })->name('api.payu.success');

// Route::get('payu/payment-failure', function (Request $request) {
//     return response()->json([
//         'success' => false,
//         'message' => 'Payment Failed.',
//         'data' => [
//             'txnid' => $request->txnid,
//             'status' => $request->status,
//             'amount' => $request->amount,
//             'error_message' => $request->error_message,
//         ],
//     ]);
// })->name('api.payu.failure');