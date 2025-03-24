<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ExamFormController extends Controller
{
    public function MyExamForms(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
            // dd($DataAfterPermissions);
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/1');
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
        }
        if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        // dd($AllExamForms);
        return View('MyExamForms', compact('DataButtonsExam', 'DataAfterPermissions','AllExamForms'));
    }
    public function RegularExamFormNormal(Request $request)
    { 

        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/regularsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
            // dd($DataAfterPermissions);
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/1');
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];
            // dd($DataAfterPermissions);
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
        }
        if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        // if ($responseSemesterExamForms->successful()) {
        //     $responseSemester = $responseSemesterExamForms->json()['data']??[];
        // }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        // dd($AllExamForms);
        $eID='1';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }
    public function RegularExamFormAgri(Request $request)
    {
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/3');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/regularsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
        }
         if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        $eID='3';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }
    public function RegularExamFormPHD(Request $request)
    {
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/5');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/regularsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];   
        }
          if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        $eID='5';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }
    public function ReappearExamFormNormal(Request $request)
    {
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/2');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/reappearsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
        } 
         if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        $eID='2';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }
    public function ReappearExamFormAgri(Request $request)
    {
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/4');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/reappearsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[];     
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];    
        }
          if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        $eID='4';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }
    public function ReappearExamFormPHD(Request $request)
    {
        $DataButtonsExam=[];
        $DataAfterPermissions=[];
        $AllExamForms=[];   
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/checkbutton');
        $responseCheckPermissions = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post($BaseURL.'Student/examdate/6');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $responseSemesterExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/reappearsemester');
        $responseGroupExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examgroup');
        $responseGroup=[];
        $responseSemester=[];
        if ($responseCheckPermissions->successful()) {
            $DataAfterPermissions = $responseCheckPermissions->json()['statusopen'][0]??[]; 
        }
        if ($responseExam->successful()) {
            $DataButtons = $responseExam->json();
            $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
            
        }
          if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
          if ($responseSemesterExamForms->successful()) {
            $responseSemester = $responseSemesterExamForms->json()['data']??[];
        }
        if ($responseGroupExamForms->successful()) {
            $responseGroup = $responseGroupExamForms->json()['data']??[];
        }
        $eID='6';
        return View('ExamForm', compact('eID','DataButtonsExam', 'DataAfterPermissions','AllExamForms','responseSemester','responseGroup'));
    }

    // public function searchExamForm(Request $request)
    // {
       
    //     $BaseURL = config('app.baseUrl');
    //     $semID = $request->input('semid'); 
    //     $Group = $request->input('groupid'); 
    //     $eID = $request->input('eID'); 
    //     $token = $request->session()->get('api_token');
    //     $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
    //         ->post($BaseURL . 'Student/regular/' . $semID . '/' . $Group);
    //         if ($response->successful()) {
    //             $resp = $response->json();
    //             if (empty($resp)) {
    //                 return response()->json(['error' => 'No data found'], 404);
    //             }
    //             $examSubjectNormalData = $resp['data'] ?? [];
    //             $subjectsOpenElectiveData = $resp['data1'] ?? [];
    //             // dd($subjectsOpenElectiveData);
    //             return response()->json([
    //                 'examSubjectNormalData' => $examSubjectNormalData,
    //                 'subjectsOpenElectiveData' => $subjectsOpenElectiveData
                    
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Request failed'], $response->status());
    //         }
    // }
    public function searchExamForm(Request $request)
{
    $BaseURL = config('app.baseUrl');
    $semID = $request->input('semid');
    $Group = $request->input('groupid');
    $eid = $request->input('eID');
  
    if ((int)$eid == 5 && $semID != 1) {
        $examSubjectNormalData = [
            ['SubjectCode' => $semID, 'SubjectName' => 'Research Work', 'SubjectType' => 'P']
        ];
        $subjectsOpenElectiveData = [];  
    
        return response()->json([
            'examSubjectNormalData' => $examSubjectNormalData,
            'subjectsOpenElectiveData' => $subjectsOpenElectiveData
        ]);
    }
    if((int)$eid==1 || (int)$eid==3 || (int)$eid==5)
{
    $apiRoute="regular";
}
else{
    $apiRoute="reappear";
}
// dd($apiRoute);
    $token = $request->session()->get('api_token');
    $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
        ->post($BaseURL . 'Student/'.$apiRoute.'/'. $semID . '/' . $Group);

    if ($response->successful()) {
        $resp = $response->json();
        if (empty($resp)) {
            return response()->json(['error' => 'No data found'], 404);
        }
        $examSubjectNormalData = $resp['data'] ?? [];
        $subjectsOpenElectiveData = $resp['data1'] ?? [];
        return response()->json([
            'examSubjectNormalData' => $examSubjectNormalData,
            'subjectsOpenElectiveData' => $subjectsOpenElectiveData
        ]);
    } else {
        return response()->json(['error' => 'Request failed'], $response->status());
    }
}

        public function submitExamForm(Request $request)
        {
            try {
                
                $BaseURL = config('app.baseUrl');
                $token = $request->session()->get('api_token');
                $eID = $request->input('eID'); 
                $subjects = $request->input('subjects'); 
                $basicInfo = $request->input('basicInfo');
                // dd($basicInfo);
                $array=[
                    "basicInfo"=>$basicInfo,
                   "subjects"=>$subjects 
                ];
if($eID==1 || $eID==3 || $eID==5)
{
    $apiRoute="examformsubmit";
}
else{
    $apiRoute="examformsubmitr";
}
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ])->timeout(60)
                ->post($BaseURL.'Student/'.$apiRoute,$array);
                if ($response->successful()) {
                    $res=$response->json(); 
                    return $res['flag'];
                 }
            } catch (\Exception $e) {
                // Handle any errors
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }
          public function fetchForm(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $ID = $request->input('ID');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post($BaseURL.'Student/examform/' . $ID);
            
            return $response['data1'];
    }  
        


    
}
