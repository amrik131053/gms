@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-5 col-sm-12">
                
                <form action="{{ url('submitBusPass') }}" method="POST" class="card">
                  @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  
                  <div class="card-header">
                    <h4 class="card-title">Apply Bus Pass</h4>
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
                              <div class="form-label">Route Name</div>
                              <select class="form-select" id="routeid" name="routeid" onchange="loadBusspot(this.value);" >
                                <option value="">Select</option>
                              @foreach ($routeData as $routeName)
                                <option value="{{$routeName['BusRouteID']}}">{{$routeName['RouteName']}}</option>
                              @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-4">
                          <div class="mb-3">
                              <div class="form-label">Spot</div>
                              <select class="form-select" id="spotid" name="spotid">
                              <option value="">Select</option>
                          </select>
                            </div>
                          </div>
                          <div class="col-lg-4">
                          <div class="mb-3">
                              <div class="form-label">Action</div>
                              <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                            </div>
                          </div>
                        </div>   
                    </form>
                 </div>
           
          </div>
          <div class="col-lg-7 col-sm-12">
                <form action="" method="post" class="card">
                  <div class="card-header">
                    <h4 class="card-title">Applied Bus Pass</h4>
                  </div>
                  <div class="card-body">
                        <div class="row">
                        <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort">Session</button></th>
                        <th><button class="table-sort">Route</button></th>
                        <th><button class="table-sort">Spot</button></th>
                        <th><button class="table-sort">Submit Date</button></th>
                        <th><button class="table-sort">Status</button></th>
                        
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @foreach ($buspassData as $busdata)
                        <tr>
                            <td class="sort-session">{{ $busdata['session'] }}</td>
                            <td class="sort-session">{{ $busdata['route'] }}</td>
                            <td class="sort-date">{{ $busdata['spot'] }}</td>
                            <td class="sort-semester"> {{ \Carbon\Carbon::parse($busdata['SubmitDate'])->format('d-m-Y') }}</td>
                            <td class="sort-date">
                            @if ($busdata['p_status']=='1')
                              <b class="text-secondary">Pending</b>
                              @elseif ($busdata['p_status']=='2')
                              <b class="text-danger">Rejected By IT</b>
                              @elseif ($busdata['p_status']=='3')
                              <b class="text-warning">Forward to Account</b>
                              @elseif ($busdata['p_status']=='4')
                              <b class="text-danger">Rejected By Account</b>
                              @elseif ($busdata['p_status']=='5')
                              <b class="text-primary">Ready To Print</b>
                              @else
                              <b class="text-success">Printed</b>
                            @endif  
                           </td>
                            
                            <td class="sort-transaction">
                            <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#modal-view-busspass" onclick="viewBusPass({{ $busdata['SerialNo'] }});" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                  <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>     </td>
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

