@include('css')

<div class="page">
    @include('header')
    
    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-lg-5 col-sm-12 card">
               

                    <div class="card-header">
                        <h4 class="card-title">Date Sheets</h4>
                    </div>
                 
                        <div class="col-lg-12 " id="">
                            
                        </div>
                    </div>
                
            <!-- </div> -->
            <!-- <div id="subjectsTableDiv"></div> -->

            <div class="col-lg-7 col-sm-12 card">
                 
                    <div class="card-header">
                        <h4 class="card-title">All Admit Cards</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort">Course</button></th>
                        <th><button class="table-sort">Sem/Type</button></th>
                        <th><button class="table-sort">Examination</button></th>
                       
                        
                        
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @if (!empty($AllExamForms))
    @foreach ($AllExamForms as $allExamShows)
        @if ($allExamShows['Status'] == 8) <!-- Filter condition for status 8 -->
            <tr>
                <td class="sort-session">{{ $allExamShows['Course'] }}</td>
                <td class="sort-session">{{ $allExamShows['Semesterid'] }} ({{ $allExamShows['Type'] }})</td>
                <td class="sort-date">{{ $allExamShows['Examination'] }}</td>
                <td class="sort-transaction">
                              <form method="POST" action="{{route('downloadAdmitCard')}}" >
                                @csrf
                              <input type="hidden" name="FormID" value="{{$allExamShows['ID']}}">
                              <input type="hidden" name="Semesterid" value="{{$allExamShows['Semesterid']}}">
                              <input type="hidden" name="Type" value="{{$allExamShows['Type']}}">
                              <input type="hidden" name="Course" value="{{$allExamShows['Course']}}">
                              <input type="hidden" name="Examination" value="{{$allExamShows['Examination']}}">
                              <input type="hidden" name="SubmitFormDate" value="{{$allExamShows['SubmitFormDate']}}">
                            <button class="btn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
  <path d="M7 11l5 5l5 -5" />
  <path d="M12 4l0 12" />
</svg>    
  Download</button> </form>
         
</td>
            </tr>
        @endif
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center text-danger">---No Record---</td>
    </tr>
@endif

                    </tbody>
                  </table>
                        </div>   
                        </div>
                    </div>
              
            </div>
        </div>
    </div>

    @include('footer')
</div>

@include('script')
