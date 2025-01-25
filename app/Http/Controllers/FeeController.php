<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberToWords\NumberToWords;

class FeeController extends Controller
{
    
    public function feeReceipts(Request $request)
    {

        // return view('');
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/receipts');
        if ($response->successful()) {
            $feeData = $response->json();
               $feeData=$feeData['data'];
            //    dd($feeData);
            return view('feeReceipt')->with('feeReceiptData', $feeData);
        } 
        else 
        {
            return view('feeReceipt')->withErrors(['message' => 'Failed to retrieve profile data.']);
        }
    }

    public function generateReceiptPDF(Request $request)
    {
        $SlipID = $request->input('SlipID');
        $lagerName = $request->input('lagerName');
        $session = $request->input('session');
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/preceipts/'.$lagerName.'/'.$SlipID.'/'.$session);
        // dd('Student/preceipts/'.$lagerName.'/'.$SlipID.'/'.$session);
        if ($response->successful()) {
            $feeReceiptData = $response->json();
            // dd($feeReceiptData);
            $feeReceiptData=$feeReceiptData['data'];
            $genderDSo="";
            if($feeReceiptData[0]['Sex']=='Male')
            {
                $genderDSo="S/O";
            }
            else
            {
                $genderDSo="D/O";
            }
            function convertAmountToWords($amount) {
                // Create a new instance of NumberToWords
                $numberToWords = new NumberToWords();
            
                // Convert the amount to words (for example, in English)
                $numberTransformer = $numberToWords->getNumberTransformer('en');
                $amountInWords = $numberTransformer->toWords($amount);
            
                return ucfirst($amountInWords); // Capitalize the first letter
            }
            $amountInWords = convertAmountToWords($feeReceiptData[0]['Credit1']);

             $data = [
                'CollegeName'=>$feeReceiptData[0]['CollegeName'],
                'ReceiptNo'=>$feeReceiptData[0]['ReceiptNo'],
                'DateEntry'=>$feeReceiptData[0]['DateEntry'],
                'StudentName'=>$feeReceiptData[0]['StudentName'],
                'FatherName'=>$feeReceiptData[0]['FatherName'],
                'Course'=>$feeReceiptData[0]['Course'],
                'Batch'=>$feeReceiptData[0]['Batch'],
                'Semester'=>$feeReceiptData[0]['Semester'],
                'ClassRollNo'=>$feeReceiptData[0]['ClassRollNo'],
                'IDNo'=>$feeReceiptData[0]['IDNo'],
                'UniRollNo'=>$feeReceiptData[0]['UniRollNo'],
                'credit'=>$feeReceiptData[0]['Credit1'],
                'OnAccountof'=>$feeReceiptData[0]['OnAccountof'],
                'ChequeDraftBank'=>$feeReceiptData[0]['ChequeDraftBank'],
                'ChequeDraftNo'=>$feeReceiptData[0]['ChequeDraftNo'],
                'ChequeDraftDate'=>$feeReceiptData[0]['ChequeDraftDate'],
                'ModeOfPayment'=>$feeReceiptData[0]['ModeOfPayment'],
                'ReferenceNumber'=>$feeReceiptData[0]['ReferenceNumber'],
                'Sex'=>$feeReceiptData[0]['Sex'],
                'genderDSo'=>$genderDSo,
                'amountInWords'=>$amountInWords
            ];  
    $numberToWords = new NumberToWords();
    $converter = $numberToWords->getNumberTransformer('en');
    $data['credit_in_words'] = ucwords($converter->toWords($feeReceiptData[0]['credit']));

    $pdf = PDF::loadView('ViewReceipt', $data);
    return $pdf->download('ReceiptNo_'.$SlipID.'.pdf');
    } 
    else 
    {
        return view('feeReceipt')->withErrors(['message' => 'Failed to retrieve  data.']);
    }
    }
}
