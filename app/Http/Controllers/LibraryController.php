<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function libraryBooks(Request $request)
    {
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post($BaseURL . 'Student/noofsem');
    
        if ($response->successful()) {
            $semData = $response->json();
            $semData = $semData['semesters']['recordset'];
            return view('libraryBooks')->with([
                'semData' => $semData,
                'studyMaterialData' => [], 
            ]);
        } else {
            return view('libraryBooks')->withErrors(['message' => 'Failed to retrieve data.']);
        }
    }
    
                public function searchBooksApi(Request $request)
                {
                    $request->validate([
                        'sortBy' => 'required',
        'searchType' => 'required',
        'searchValue' => 'required'
    ], [
        'sortBy.required' => 'Please select a semester.',
        'searchType.required' => 'Please select a search Type.',
        'searchValue.required' => 'Please select a search Value.'
    ]);
    
    $BaseURL = config('app.baseUrl');
    $sortBy = $request->input('sortBy');
    $searchType = $request->input('searchType');
    $searchValue = $request->input('searchValue');
    $token = $request->session()->get('api_token');
    // dd($request);
    if (!$token) {
        return back()->withErrors(['error' => 'Token is missing']);
    }
    $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
    ->post($BaseURL . 'Student/searchBooks/' . $sortBy . '/' . $searchType. '/' . $searchValue);
    
    if ($response->successful()) {
        $resp = $response->json();
        $studyMaterialData = $resp['data']??[];
        // dd($studyMaterialData);
        return view('libraryBooks')->with([
            'booksMaterialData' => $studyMaterialData,
        ]);
    } else {
        
        return back()->withErrors(['error' => 'Failed to retrieve data.']);
    }
}
    public function libraryDetailsBooks(Request $request)
    {
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post($BaseURL . 'Student/issueddetail');

        if ($response->successful()) {
            $booksArray = $response->json();
            // dd($booksArray);
            $booksArray = $booksArray['books']??[];
            return view('libraryDetails')->with([
                'issuedMaterialData' => $booksArray, 
            ]);
        } else {
            return view('libraryDetails')->withErrors(['message' => 'Failed to retrieve data.']);
        }
    }
    public function libraryBooksReturnAction(Request $request)
    {
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post($BaseURL . 'Student/finedetail');

        if ($response->successful()) {
            $booksArray = $response->json();
            // dd($booksArray);
            // $booksArray = $booksArray['books']??[];
            return view('libraryBooksReturn')->with([
                'allMaterialData' => $booksArray, 
            ]);
        } else {
            return view('libraryBooksReturn')->withErrors(['message' => 'Failed to retrieve data.']);
        }
    }
}
