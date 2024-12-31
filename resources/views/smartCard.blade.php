@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row row-cards">        
            <div class="page-body ">
                
          <div class="container-xl ">
            
            <div class="row row-cards">
            
              <div class="col-sm-12 col-lg-4">
                <div class="card card-md">
                <div class="card-header">
                    <h4 class="card-title">ID Card Details</h4>
                  </div>
                  <div class="card">
                  <div class="card-body text-center">
                      <div><b>Course: {{isset($MasterCourse['shortname'])?$MasterCourse['shortname'] : ''}}</b></div>
                      <div><b>ValidUpTo:

                      {{ \Carbon\Carbon::parse($MasterCourse['validdate'])->format('d-m-Y') }}
                      </b></div>
                    <div class="mb-3">
                      <span class="avatar avatar-xl rounded" style="background-image: url('{{ isset($SmartCard['Image']) ? 'http://erp.gku.ac.in:86/Images/Students/'.$SmartCard['Image'] : 'default-image-url.jpg' }}')"></span>
                    </div>
                    <div class="card-title mb-1">Student Name:{{isset($SmartCard['StudentName'])?$SmartCard['StudentName'] : ''}}</div>
                    <div class="card-title mb-1">RollNo:{{isset($SmartCard['ClassRollNo'])?$SmartCard['ClassRollNo'] : ''}}</div>
                    <div class="text-strong">Father Name: {{isset($SmartCard['FatherName'])?$SmartCard['FatherName'] : ''}}</div>
                    <div class="text-strong">Date Of Birth:{{ \Carbon\Carbon::parse($SmartCard['DOB'])->format('d-m-Y') }}
                    </div>
                    <div class="text-strong">Mobile No: {{isset($SmartCard['StudentMobileNo'])?$SmartCard['StudentMobileNo'] : ''}}</div>
                    <div class="text-strong">Gender: {{isset($SmartCard['Sex'])?$SmartCard['Sex'] : ''}}</div>
                    <div><b>Address: {{isset($SmartCard['PermanentAddress'])?$SmartCard['PermanentAddress'] : ''}}</b></div>
                  </div>
                 
                </div>
                </div>
              </div>
              
              
              <div class="col-lg-8 col-sm-12">
                <div class="card card-md">
                <div class="card-header">
                    <h4 class="card-title">Smart Card Status</h4>
                  </div>
                  <div class="card-body">
                  @if($flag == 0 && $flag1 == 0)
                  <form id="smartCardForm" action="{{route('submitSmartCard')}}" method="POST">
                    @csrf
    <div class="row align-items-center">
        <div class="col">
            <h2 class="h3" id="checkboxLabel">
                <input type="checkbox" class="form-check-input" onclick="checkBoxIDcard();" id="smartCardCheckbox"> Check All Details Printed on Smart Card
            </h2>
            <p class="m-0 text-secondary" id="confirmationText">
                I hereby state that all above-mentioned information is correct; proceed for printing.
            </p>
        </div>
        <div class="col-auto">
           
            @if($flag == 0 && $flag1 == 0)
                <button id="applyButton" class="btn" type="submit">Click Here To Apply</button>
            @endif
        </div>
    </div>
</form>
@endif
<div id="table-default" class="table-responsive">
    @if (!empty($StatusIDCard))
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Applied Date</th>
                    <th>Card Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Carbon\Carbon::parse($StatusIDCard['ApplyDate'])->format('d-m-Y h:i:s A') }}</td>
                    <td>
                        @if ($StatusIDCard['status'] == 'Applied')
                            <b class="text-primary">{{ $StatusIDCard['status'] }}</b> on {{ \Carbon\Carbon::parse($StatusIDCard['ApplyDate'])->format('d-m-Y h:i:s A') }}
                        @elseif ($StatusIDCard['status'] == 'Printed') 
                            <b class="text-success">{{ $StatusIDCard['status'] }}</b> on {{ \Carbon\Carbon::parse($StatusIDCard['PrintDate'])->format('d-m-Y h:i:s A') }}
                        @elseif ($StatusIDCard['status'] == 'Verified') 
                            <b class="text-warning">{{ $StatusIDCard['status'] }}</b> on {{ \Carbon\Carbon::parse($StatusIDCard['VerifyDate'])->format('d-m-Y h:i:s A') }}
                        @elseif ($StatusIDCard['status'] == 'Rejected') 
                            <b class="text-danger">{{ $StatusIDCard['status'] }} on {{ \Carbon\Carbon::parse($StatusIDCard['RejectDate'])->format('d-m-Y h:i:s A') }} <br>due to {{ $StatusIDCard['RejectReason'] }}</b>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
                  </div>
                  </div>
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
