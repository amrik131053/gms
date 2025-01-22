@include ('css')
    <div class="page">
 @include('header')
       <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-5 col-sm-12">
                
                <form action="{{ url('searchBooks') }}" method="POST" class="card">
                  @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <div class="card-status-top bg-primary"></div>
                  <div class="card-header">
                    <h4 class="card-title">Books Search</h4>
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
                     

                    <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">Sort By</label>
                                    <select class="form-select" id="sortBy" name="sortBy">
                                        <option value="All">All</option>
                                        <option value="Issued">Issued</option>
                                        <option value="Available">Available</option>
                                    </select>
                                </div>
                                </div>

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">Search By</label>
                                    <select class="form-select" id="searchType" name="searchType"
                                        onchange="updateTextBox()">
                                        <option value="" selected="selected">Select</option>
                                        <option value="Title">Title</option>
                                        <option value="AccessionNo">AccessionNo</option>
                                        <option value="Author">Author</option>
                                        <option value="Edition" >Edition</option>
                                        <option value="Publisher">Publisher</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label class="form-label">Search Value</label>
                                    <input class="form-control" type="text" id="searchValue" name="searchValue"
                                        placeholder="Enter Edition">
                                </div>
                            </div>
                            </div>
                          <div class="col-lg-1">
                          <div class="mb-1">
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
                    <h4 class="card-title">All Books</h4>
                  </div>
                  <div class="card-body">
                        <div class="row">
                        <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>SrNo</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Publisher</th>
                       </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @if (!empty($booksMaterialData))
                @foreach ($booksMaterialData as $showbookMaterialData)
                    <tr><td>{{ $loop->iteration }}</td>
                        <td>{{ $showbookMaterialData['Title'][0] }}</td>
                        <td>{{ $showbookMaterialData['Author'][0] }}</td>
                        <td>{{ $showbookMaterialData['Publisher'] }}</td></tr>
                @endforeach
                   @else
                    <tr><td colspan="4" class="text-danger text-center">--No Record--</td></tr>
                    @endif
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


      