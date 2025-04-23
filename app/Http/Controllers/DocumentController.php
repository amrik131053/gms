<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentController extends Controller
{
    public function showDocumentPage(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/certificateList');
        if ($DataResponse->failed()) {
            return view('index', [
                'documentsList' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        // dd($resData);
        $documentsList=$resData;
        return view('documentUpload', compact('documentsList'));
    }

public function upload(Request $request)
{
    $request->validate([
        'document' => 'required|file|max:2048',
        'DocumentType' => 'required',
        'IDNo' => 'required',
    ]);

    if ($request->hasFile('document')) {
        $document = $request->file('document');
        $documentType = $request->input('DocumentType');
        $idNo = $request->input('IDNo');
        $tempPath = $document->getRealPath();

        $baseUrl = config('app.baseUrl');
        $token = $request->session()->get('api_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->attach(
            'certificate', file_get_contents($tempPath), $document->getClientOriginalName()
        )->post($baseUrl . 'Student/uploadCertificates/' . $documentType);

        if ($response->successful()) {
            return back()->with('success', 'Document uploaded successfully!');
        } else {
            return back()->withErrors(['error' => 'Upload failed. Please try again later.']);
        }
    }

    return back()->withErrors(['error' => 'No file uploaded.']);
}


}