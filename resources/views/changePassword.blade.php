@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl ">
       <div class="row justify-content-center">
        
              <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">Password Change</h4>
                  </div>
                  <div class="card-body">
                  @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            
                        </div>
                        <script type="text/javascript">
        setTimeout(function() {
            document.cookie = "api_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            @php
                session()->forget('api_token');
            @endphp
            window.location.href = "{{ route('index') }}"; 
        }, 5000); 
    </script>
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
                  <form action="{{ route('passwordchangeAction') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="oldpassword" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="oldpassword" name="oldpassword" >
        </div>
        <div class="mb-3">
            <label for="newpassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newpassword" name="newpassword" >
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" >
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
                  </div>
                </div>
              </div>
            </div>
      </div>
      @include('footer')
    </div>
@include('script')
     