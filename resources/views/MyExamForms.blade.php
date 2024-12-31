@include('css')

<div class="page">
    @include('header')

    <div class="container-xl">
        <div class="row row-cards">
        
            <div class="col-lg-12 col-sm-12">
                <form action="#" method="post" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Details</h4>
                    </div>

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="card-body">
                        <div class="row">
                        <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort">Course</button></th>
                        <th><button class="table-sort">Sem/Type</button></th>
                        <th><button class="table-sort">Examination</button></th>
                       
                        <th><button class="table-sort">Status</button></th>
                        
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @if (!empty($AllExamForms))
                      
                    @foreach ($AllExamForms as $allExamShows)
                        <tr>
                            <td class="sort-session">{{ $allExamShows['Course'] }}</td>
                            <td class="sort-session">{{ $allExamShows['Semesterid'] }}({{$allExamShows['Type']}})</td>
                            <td class="sort-date">{{ $allExamShows['Examination'] }}</td>
                    
                            <td class="sort-date">
                            @if ($allExamShows['Status']=='-1')
                              <b class="text-primary">Forward to Registration Branch</b>
                              @elseif ($allExamShows['Status']=='0')
                              <b class="text-primary">Forward To Department</b>
                              @elseif ($allExamShows['Status']=='1')
                              <b class="text-warning">Forward To Department</b>
                              @elseif ($allExamShows['Status']=='2')
                              <b class="text-danger">Reject By Department</b>
                              @elseif ($allExamShows['Status']=='3')
                              <b class="text-danger">Reject By Dean</b>
                              @elseif ($allExamShows['Status']=='4')
                              <b class="text-warning">Forward To Account</b>
                              @elseif ($allExamShows['Status']=='5')
                              <b class="text-warning">Forward To Examination</b>
                              @elseif ($allExamShows['Status']=='6')
                              <b class="text-danger">Rejected By Account</b>
                              @elseif ($allExamShows['Status']=='7')
                              <b class="text-danger">Rejected By Examination</b>
                              
                              @else
                              <b class="text-success">Accepted</b>
                            @endif  
                           </td>
                            
                            <td class="sort-transaction">
                            <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#modal-view-examForms" onclick="viewExamForm({{$allExamShows['ID']}})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                  <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>     </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>No Record</td>
                    </tr>
                    @endif
                    </tbody>
                  </table>
                        </div>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('footer')
</div>

@include('script')
