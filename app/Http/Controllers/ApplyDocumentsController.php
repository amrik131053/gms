<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ApplyDocumentsController extends Controller
{
    public function applyDocuments(Request $request)
    { 
        $correctionData=[];
        $allApplidDocuments=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $getCountries = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://10.0.8.181:95/common/allcountries');
        $allCountries = $getCountries->json()??[];
        $DataResponseDocuments = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/allApplyDocuments');
        $AllRequests = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://10.0.8.181:89/Student/allDocRequests');
        $allRequestData = $AllRequests->json()??[];
        $DataFinal=$allRequestData['data'] ?? [];
        $resData = $DataResponse->json()??[];
        $DataResponseCorr = $DataResponseDocuments->json();
        $correctionData=$resData['data'][0] ?? [];
        $allApplidDocuments=$DataResponseCorr['data'] ?? [];
        return view('applyDocuments', compact('correctionData','allApplidDocuments','allCountries','DataFinal'));
    }

    public function fetchRequired(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $applyFor = $request->input('applyFor');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post($BaseURL.'Student/requiredDocs/' . $applyFor);
        if ($response->successful()) {
            $subjectData = $response->json();
            $docs=$subjectData['data'];
            return response()->json($docs);
        }
       
    return response()->json($docs);
    }
    public function submitDocument(Request $request)
    {
        Validator::make($request->all(), [
            'applyFor'        => 'required|numeric',
            'numberOfSem'     => 'nullable|integer|min:1|max:12',
            'country_label'   => 'nullable|string|max:191',
            'country1_label1' => 'nullable|string|max:191',
            'deliveryMode'    => 'required|in:Home Delivery,By Hand',
            'postType'        => 'nullable|in:Within India,Outside India',
            'state_label'     => 'nullable|string|max:191',
            'district_label'  => 'nullable|string|max:191',
            'pin'             => 'nullable|digits_between:4,8',
            'full_address'    => 'nullable|string|max:500',
        ])
        ->sometimes('postType', 'required', function ($input) {
            return $input->deliveryMode === 'Home Delivery';
        })
        ->sometimes(['state_label', 'district_label', 'pin', 'full_address'], 'required', function ($input) {
            return $input->postType === 'Within India';
        })
        ->validate();
        $validated=$request->all();

            $uploadedFiles = [];
    foreach ($request->allFiles() as $inputName => $files) {
        if (!is_array($files)) {
            $files = [$files];
        }
        foreach ($files as $file) {
            $filename = $inputName.'_'.time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $uploadedFiles[] = [
                'input' => $inputName,
                'filename' => $filename
            ];
        }
    }
    $selectedSemesters = [];
    foreach ($request->all() as $key => $val) {
        if (Str::startsWith($key, 'semester_') && $val == '1') {
            $selectedSemesters[] = $key;
        }
    }
    $token = $request->session()->get('api_token');
    $request = Http::withoutVerifying()
    ->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ]);

foreach ($uploadedFiles as $uploadedFile) {
    $filePath = public_path('uploads/' . $uploadedFile['filename']);
    if (file_exists($filePath)) {
        $request = $request->attach(
            'docs',                           
            file_get_contents($filePath),                 
            $uploadedFile['filename']              
        );
    }
}

$country = $validated['country_label']
         ?? $validated['country1_label1']
         ?? null;

$response = $request->post('http://10.0.8.181:89/student/uploadRequiredDocs/', [
   'applyFor'            => $validated['applyFor'],
    'numberOfSem'         => $validated['numberOfSem']??null,
    'deliveryMode'        => $validated['deliveryMode'],
    'postType'            => $validated['postType'] ?? null,
    'country'               => $country,
    'state'               => $validated['state_label'] ?? null,
    'district'            => $validated['district_label'] ?? null,
    'pin'                 => $validated['pin'] ?? null,
    'full_address'        => $validated['full_address'] ?? null,
    'semArray'  => json_encode($selectedSemesters)?? [],
]);

    if ($response->successful()) {
        return $response->json();
    } else {
        return $response->json();
    }
        

    }

    public function fetchState(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $ID = $request->input('ID');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post('http://10.0.8.181:95/common/allstates/' . $ID);
           $states= $response->json()??[];
            return $states;
    }
    public function fetchcity(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $ID = $request->input('ID');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post('http://10.0.8.181:95/common/allcities/' . $ID);
           $states= $response->json()??[];
            return $states;
    }

    public function view($encryptedId, Request $request)
    {
        $token = $request->session()->get('api_token');
        $id = Crypt::decrypt($encryptedId);
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/Student/eachDocRequest/', [
            'requestId' => $id,
        ]);
        $getCountries = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://10.0.8.181:95/common/allcountries');
        $allCountries = $getCountries->json()??[];
        $data = $response->json()['data'] ?? null;
        if (!$data) {
            return redirect()->back()->with('error', 'Record not found.');
        }
        return view('documentFinalSubmit', compact('data','allCountries'));
    }

    public function getDocumentCharges(Request $request)
    {
        $token = $request->session()->get('api_token');
        $documentName = $request->documentName;
        $postTypeid = $request->postTypeid;
    $deliveryMode = $request->deliveryMode;
    $countryId = $request->countryId;

    if($postTypeid=='Within India')
    {
        $countryId=0;
    }
    else
    {
     if($countryId!='101' && $countryId!=null)
    {
        $countryId=1;
    }
    else if($countryId==null)
    {
        $countryId=2;
    }
    else
    {
        $countryId=0;
    }
    }
    if($deliveryMode=='Home Delivery')
    {
        $deliveryMode=1;
    }
    else if($deliveryMode=='By Hand')
    {
        $deliveryMode=0;
    }
    else
    {
        $deliveryMode=0;
    }
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('http://10.0.8.181:89/student/documentCharges/', [
        'docId'    => $documentName,
        'receivingType'    => $deliveryMode,
        'addressType'    => $countryId,
    ]);
    if ($response->successful() && !empty($response->json()['data'][0])) {
        $charges = $response->json()['data'][0];
    }
    else
    {
        $charges = [
            'Fee' => 0,
            'PostalCharges' => 0,
            'OtherCharges' => 0,
        ];
    }
    return response()->json([
        'success' => true,
        'fee' => $charges['Fee'],
        'postal_charge' =>$charges['PostalCharges'],
        'Other' =>$charges['OtherCharges'],
    ]);
    }
    
  
    public function uploadDocument(Request $request)
    {
        $requestId = Crypt::decrypt($request->input('requestId'));
        $docId = $request->input('docId');
        $token = $request->session()->get('api_token');
        if (!$request->hasFile('document')) {
            return response()->json(['success' => false, 'message' => 'No file uploaded']);
        }
        $file = $request->file('document');
        $filename = uniqid().'_'.$file->getClientOriginalName();
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->attach(
            'docs',                          // name expected by API
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post('http://10.0.8.181:89/student/updateDocument/', [
            'docId'    => $docId,
        ]);
        if ($response->successful()) {
            return $response->json();
        } else {
            return $response->json();
        }
    }
    
    
    public function updateAddress(Request $request, $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $token = $request->session()->get('api_token');
        $data = [
            'ReceivingType' => $request->ReceivingType,
            'country_label' => $request->country_label,
            'state_label' => $request->state_label,
            'district_label' => $request->district_label,
            'Pin' => $request->Pin,
            'AddressLine' => $request->AddressLine
    ];
    
    if ($request->ReceivingType === 'Home Delivery') {
        $ResPonseVariable=2;
    }
    elseif ($request->ReceivingType === 'By Hand') 
    {
        $ResPonseVariable=1;
    } 
    else {
        $ResPonseVariable=0;
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/student/changeAddress/', [
            'purpose'            => $ResPonseVariable,
            'id'         => $id,
            'countryName'        => $data['country_label'],
            'stateName'            => $data['state_label'] ?? null,
         'cityName'               => $data['district_label'] ?? null,
         'pin'               => $data['Pin'] ?? null,
         'addressLine'            => $data['AddressLine'] ?? null
        ]);
   
            return redirect()->back()->with('success', 'Details updated successfully!');
        }
    public function finalize(Request $request, $encryptedId)
    {
        $ID = Crypt::decrypt($encryptedId);
        $token = $request->session()->get('api_token');
        
    
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/student/finalSubmit/', [
            'id'         => $ID,
        ]);
   
        if ($response->successful()) {
            // ✅ Redirect to the URL you want
            return redirect('applyDocuments')
                ->with('success', 'Final submitted successfully!');
        } else {
            return back()->with('error', 'Final submit failed.');
        }
        }
        
        
        
    }