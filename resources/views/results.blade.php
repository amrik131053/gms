@include ('css')
    <div class="page">
 @include('header')
 <div class="container-xl">
            <div class="card">
            <div class="card-status-top bg-primary"></div>
            <div class="card-header">
                    <h4 class="card-title">All Results</h4>
                  </div>
              <div class="card-body">
                <div id="table-default" class="table-responsive">
                  <table class="table table-vcenter card-table">
                    <thead>
                      <tr>
                        <th>SrNo</th>
                        <th>Semester</th>
                        <th>Type</th>
                        <th>Examination</th>
                        <th>Sgpa</th>
                        <th>DeclareDate</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @foreach ($resultsData as $resultdata)
                   <tr>
                   <td>{{ $loop->iteration }}</td>
                            <td>{{ $resultdata['Semester'] }}</td>
                            <td>{{ $resultdata['Type'] }}</td>
                            <td>{{ $resultdata['Examination'] }}</td>
                            <td>{{ $resultdata['Sgpa'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($resultdata['DeclareDate'])->format('d-m-Y') }}</td>
                            <td>
                              <form action="{{url('fetch-result')}}" method="post">
                                @csrf
                              <input type="hidden" name="ResultID" value="{{$resultdata['Id']}}">
                            <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
  <path d="M7 11l5 5l5 -5" />
  <path d="M12 4l0 12" />
</svg>Download</button> </form>
                          </td>
                        </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
</div>  
      @include('footer')
      </div>
    </div>
@include('script')

