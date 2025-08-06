@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-5 col-sm-12">
                
                <form action="{{ url('searchStudyMaterial') }}" method="POST" class="card">
                  @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <div class="card-status-top bg-primary"></div>
                  <div class="card-header">
                    <h4 class="card-title">Study Material</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                                        
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                          <div class="col-lg-4">
                          <div class="mb-3">
                              <div class="form-label">Semester</div>
                              <select class="form-select" id="semID" name="semID" onchange="loadSubjects(this.value);" >
                                <option value="">Select</option>
                              @foreach ($semData as $semShow)
                                <option value="{{$semShow['SemesterId']}}">{{$semShow['SemesterId']}}</option>
                              @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-4">
                          <div class="mb-3">
                              <div class="form-label">Subject Name</div>
                              <select class="form-select" id="subID" name="subID">
                              <option value="">Select</option>
                          </select>
                            </div>
                          </div>
                          <div class="col-lg-4">
                          <div class="mb-3">
                              <div class="form-label">Action</div>
                              <button type="submit" onclick="showLoaders()" class="btn btn-primary ms-auto"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>Search</button>
                            </div>
                          </div>
                        </div>   
                    </form>
                 </div>
           
          </div>
          <div class="col-lg-7 col-sm-12">
                <form action="https://httpbin.org/post" method="post" class="card">
                  <div class="card-status-top bg-primary"></div>
                  <div class="card-header">
                    <h4 class="card-title">Study Materials</h4>
                  </div>
                  <div class="card-body">
                        <div class="row">
                      
                        <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                          <th><button class="table-sort">College Name</button></th>
                        <th><button class="table-sort">Course</button></th>
                        <th><button class="table-sort">Topic</button></th>
                       
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                
    @foreach ($studyMaterialData as $showStudyMaterialData)
        <tr>
            <td class="sort-session">{{ $showStudyMaterialData['CollegeName'] }}</td>
            <td class="sort-session">{{ $showStudyMaterialData['Course'] }}</td>
            <td class="sort-date">{{ $showStudyMaterialData['Topic'] }}</td>
            <td class="sort-transaction">
              @if($showStudyMaterialData['DocumentType']!='Video/Audio')
            <a href="http://erp.gku.ac.in:86/StudyMaterial/{{ $showStudyMaterialData['CourseFile'] }}" target="_blank">  <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>
                </a>
                @else
                <a href="{{ $showStudyMaterialData['CourseFile'] }}" target="_blank">  <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>
                </a>
                @endif


            </td>
        </tr>
    @endforeach


                    </tbody>
                  </table>
                        </div>   
                        </div>   
                    </form>
                 </div>
           
          </div>
        </div>


      </div>
      @include('footer')
    </div>
@include('script')


      