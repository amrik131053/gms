@include('css')

<div class="page">
    @include('header')

    <div class="container-xl">
        <div class="row ">
            
        <div class="col-md-5">
            
        <div class="card">
        <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">Date Sheets</h4>
                </div>
                <div class="col-lg-12 " id="">

                </div>
            
            </div>
            </div>


            <div class="col-md-7">
            <div class="card">
            <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">All Admit Cards</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div id="table-default" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Sem/Type</th>
                                        <th>Examination</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    @if (!empty($AllExamForms))
                                    @foreach ($AllExamForms as $allExamShows)
                                   
                                    <tr>
                                        <td>{{ $allExamShows['Course'] }}</td>
                                        <td>{{ $allExamShows['SemesterId'] }}
                                            ({{ $allExamShows['Type'] }})</td>
                                        <td>{{ $allExamShows['Examination'] }}</td>
                                        <td>
                                            <form method="POST" action="{{route('downloadAdmitCard')}}">
                                                @csrf
                                                <input type="hidden" name="FormID" value="{{$allExamShows['ID']}}">
                                                <button class="btn btn-primary" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                    Download</button>
                                            </form>

                                        </td>
                                    </tr>
                                   
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">University Roll Number has not been issued yet. Please contact the Registration Branch for assistance</td>
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
    </div>

    @include('footer')
</div>

@include('script')