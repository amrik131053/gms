@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-sm-12">
                
              <form action="{{ route('payu.initiate') }}" method="POST" class="card">
              @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  
                  <div class="card-header">
                    <h4 class="card-title">Confirmation Payment
                    </h4>
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
                        

                 
        <div class="form-group">
            <div class="form-label">Student Name</div>
            <input type="text" class="form-control" name="student_name" id="student_name" value="{{ $details['StudentName'] }}" readonly required>
        </div>
        <div class="form-group">
            <div class="form-label">Father Name</div>
            <input type="text" class="form-control" name="father_name" id="father_name" value="{{ $details['FatherName'] }}" readonly required>
        </div>
        <div class="form-group">
        <div class="form-label">Mobile No</div>
            <input type="mobile" class="form-control" name="mobile" id="mobile" value="{{ $details['StudentMobileNo'] }}" required>
        </div>
        <div class="form-group">
        <div class="form-label">Email</div>
            <input type="email" class="form-control" name="email" id="email" value="{{ $details['EmailID'] }}" required>
        </div>
        <div class="form-group">
        <div class="form-label">Fee Type</div>
            <input type="text" class="form-control" name="fee_type" id="fee_type" value="{{ $submit_details['fee_type'] }}" readonly required>
        </div>
        <div class="form-group">
        <div class="form-label">Semester</div>
            <input type="text" class="form-control" name="semester" id="semester" value="{{ $submit_details['semester'] }}" readonly required>
        </div>
        <div class="form-group">
        <div class="form-label">Amount</div>
            <input type="text" class="form-control" name="amount" id="amount" value="{{ $submit_details['amount'] }}" readonly required>
        </div>
        <div class="form-group">
        <div class="form-label">Remarks</div>
            <textarea name="remarks"  class="form-control" id="remarks" readonly>{{ $submit_details['remarks'] }}</textarea>
        </div>
        <div class="form-label"></div>
        <div class="form-group">
        <button type="submit" class="btn btn-danger">Confirm and Pay</button>
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

