@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row row-cards">  
                    
            <div class="page-body ">
                
          <div class="container-xl ">
            <div class="row">
            <div id="alertContainer" >
                                @if (session('success'))
                                    <div class="alert alert-success">
                                       <b> {{ session('success') }}</b>
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
                            </div>
                            </div>
            <div class="row row-cards">

              
              <div class="col-sm-12 col-lg-4">
                <div class="card card-md">
                <div class="card-status-top bg-primary"></div>
                  <div class="card-header">
                            <h4 class="card-title">Profile</h4>
                        </div>
                   
                  <div class="card">
                  <div class="card-body text-center">
                    
                  <div class="mb-3 position-relative" style="display: inline-block;">
                  <span class="avatar avatar-xl rounded" 
                style="background-image: url('{{ isset($profileData['Image']) ? 'http://erp.gku.ac.in:86/Images/Students/'.$profileData['Image'] : 'default-image-url.jpg' }}'); position: relative;"></span>
            
            <!-- Edit Icon in the Center of the Image -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-view-upload-image" class="position-absolute" style="top: 0%; left: 100%; transform: translate(-50%, -50%); background: #223260; border-radius: 20%; padding: 2px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#f8f7f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#f8f7f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>   </a>
                  
            </a>
        </div>
        <div class="mb-2">
          <h2>{{$profileData['StudentName']}}</h2>
        </div>
                    <div class="mb-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z" fill="#080341"></path> </g></svg>
                            Email ID: <strong>{{$profileData['EmailID']}}</strong>
                    </div>
                        <div class="mb-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M17.3545 22.2323C15.3344 21.7262 11.1989 20.2993 7.44976 16.5502C3.70065 12.8011 2.2738 8.66559 1.76767 6.6455C1.47681 5.48459 2.00058 4.36434 2.88869 3.72997L5.21694 2.06693C6.57922 1.09388 8.47432 1.42407 9.42724 2.80051L10.893 4.91776C11.5152 5.8165 11.3006 7.0483 10.4111 7.68365L9.24234 8.51849C9.41923 9.1951 9.96939 10.5846 11.6924 12.3076C13.4154 14.0306 14.8049 14.5807 15.4815 14.7576L16.3163 13.5888C16.9517 12.6994 18.1835 12.4847 19.0822 13.1069L21.1995 14.5727C22.5759 15.5257 22.9061 17.4207 21.933 18.783L20.27 21.1113C19.6356 21.9994 18.5154 22.5232 17.3545 22.2323ZM8.86397 15.136C12.2734 18.5454 16.0358 19.8401 17.8405 20.2923C18.1043 20.3583 18.4232 20.2558 18.6425 19.9488L20.3056 17.6205C20.6299 17.1665 20.5199 16.5348 20.061 16.2171L17.9438 14.7513L17.0479 16.0056C16.6818 16.5182 16.0047 16.9202 15.2163 16.7501C14.2323 16.5378 12.4133 15.8569 10.2782 13.7218C8.1431 11.5867 7.46219 9.7677 7.24987 8.7837C7.07977 7.9953 7.48181 7.31821 7.99439 6.95208L9.24864 6.05618L7.78285 3.93893C7.46521 3.48011 6.83351 3.37005 6.37942 3.6944L4.05117 5.35744C3.74413 5.57675 3.64162 5.89565 3.70771 6.15943C4.15989 7.96418 5.45459 11.7266 8.86397 15.136Z" fill="#0F0F0F"></path> </g></svg> 
                          Mobile No: <strong>{{$profileData['StudentMobileNo']}}</strong>
                        </div>
                        <div class="mb-3 position-relative" style="display: inline-block;">
                      <span class="avatar avatar-xl rounded" style="background-image: url('{{ isset($profileData['SignaturePath']) ? 'http://erp.gku.ac.in:86/Images/Signature/'.$profileData['SignaturePath'] : 'default-image-url.jpg' }}');width:300px; height:100px;">


                      </span>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-view-upload-signature" class="position-absolute" style="top: 0%; left: 100%; transform: translate(-50%, -50%); background: #223260; border-radius: 20%; padding: 2px;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#f8f7f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#f8f7f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>   </a>
                  
                    </div>
                  </div>
                 
                </div>
                </div>
              </div>
              
              
              <div class="col-lg-8 col-sm-12">
                <div class="card ">
        
                  <div class="card-body">
             
                  <form id="smartCardForm"action="{{ url('submitProfileData') }}" method="POST">
                    @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <div class="card-status-top bg-primary"></div>
                  
    <div class="col-md-12">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg viewBox="0 0 24 24" width="24" height="24"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#766f6f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#766f6f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>   Basic Details</a>
                      </li>
                      <li class="nav-item">
                        <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  stroke="#9d9595"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 19V6.2C5 5.0799 5 4.51984 5.21799 4.09202C5.40973 3.71569 5.71569 3.40973 6.09202 3.21799C6.51984 3 7.0799 3 8.2 3H15.8C16.9201 3 17.4802 3 17.908 3.21799C18.2843 3.40973 18.5903 3.71569 18.782 4.09202C19 4.51984 19 5.0799 19 6.2V17H7C5.89543 17 5 17.8954 5 19ZM5 19C5 20.1046 5.89543 21 7 21H19M18 17V21M15 13.5C14.7164 12.3589 13.481 11.5 12 11.5C10.519 11.5 9.28364 12.3589 9 13.5M12 7.5H12.01M13 7.5C13 8.05228 12.5523 8.5 12 8.5C11.4477 8.5 11 8.05228 11 7.5C11 6.94772 11.4477 6.5 12 6.5C12.5523 6.5 13 6.94772 13 7.5Z" stroke="#766f6f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        Course</a>
                      </li>
                    
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active show" id="tabs-home-7">
                      <div class="row">
                <!-- Father Name -->
                <div class="col-md-6 mb-3">
                    <label for="father_name" class="form-label">Father Name</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" value="{{$profileData['FatherName']}}" disabled>
                </div>

                <!-- Mother Name -->
                <div class="col-md-6 mb-3">
                    <label for="mother_name" class="form-label">Mother Name</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{$profileData['MotherName']}}" disabled>
                </div>

                <!-- Gender -->
                <div class="col-md-3 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="{{$profileData['Sex']}}">{{$profileData['Sex']}}</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="text" class="form-control" id="dob" name="dob" value="{{ \Carbon\Carbon::parse($profileData['DOB'])->format('d-m-Y') }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="bloodgroup" class="form-label">Blood Group</label>
                    <select id="bloodgroup" name="bloodgroup" class="form-select">
                    <option value="{{$profileData['BloodGroup']}}">{{$profileData['BloodGroup']}}</option>
                                            <option value="A +ve">A +Ve</option>
                                             <option value="A -ve">A -Ve</option>
                                             <option value="AB +ve">AB +Ve</option>
                                             <option value="AB -ve">AB -Ve</option>
                                             <option value="B +ve">B +Ve</option>
                                             <option value="B -ve">B -Ve</option>
                                             <option value="O +ve">O +Ve</option>
                                             <option value="O -ve">O -Ve</option>
                                             <option value="NA">NA</option>
                                             </select>
                  
                </div>
                <div class="col-md-3 mb-3">
                    <label for="aadhar" class="form-label">ABC ID</label>
                    @if ($profileData['ABCID']!='' || $profileData['ABCID']!=NULL )
                    <div class="input-icon mb-3">
                      <input type="text" class="form-control" id="abcid" name="abcid" value="{{$profileData['ABCID']}}" readonly>
                                <!-- <input type="text" value="" class="form-control" placeholder="Search…"> -->
                                <span class="input-icon-addon">
                                <svg fill="#f40101" class="icon" width="24" height="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve" stroke="#f40101"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_509_"> <path id="XMLID_510_" d="M65,330h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15h-15V85c0-46.869-38.131-85-85-85 S80,38.131,80,85v45H65c-8.284,0-15,6.716-15,15v170C50,323.284,56.716,330,65,330z M180,234.986V255c0,8.284-6.716,15-15,15 s-15-6.716-15-15v-20.014c-6.068-4.565-10-11.824-10-19.986c0-13.785,11.215-25,25-25s25,11.215,25,25 C190,223.162,186.068,230.421,180,234.986z M110,85c0-30.327,24.673-55,55-55s55,24.673,55,55v45H110V85z"></path> </g> </g></svg>
                              </span>
                              </div>
                              @else
                              <div class="input-icon mb-3">
                                <input type="text" class="form-control" id="abcid" name="abcid" value="{{$profileData['ABCID']}}" >
                                          <!-- <input type="text" value="" class="form-control" placeholder="Search…"> -->
                                          <span class="input-icon-addon">
                                          <svg fill="#1a9509" class="icon" width="24" height="24"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_516_"> <path id="XMLID_517_" d="M15,160c8.284,0,15-6.716,15-15V85c0-30.327,24.673-55,55-55c30.327,0,55,24.673,55,55v45h-25 c-8.284,0-15,6.716-15,15v170c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15H170V85 c0-46.869-38.131-85-85-85S0,38.131,0,85v60C0,153.284,6.716,160,15,160z"></path> </g> </g></svg>  </div>
                   
                    @endif
                </div>

                <!-- Email -->
                <div class="col-md-4 mb-3">
                    <label for="otr" class="form-label">OTR <small class="text-danger">(Only for punjab SC/ST students)</small></label>
                    <input type="text" class="form-control" id="otr" name="otr" value="{{$profileData['OTR']}}" required>
                </div>
                <!-- Email -->
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$profileData['EmailID']}}" required>
                </div>
              
                <!-- Category -->
                

                <!-- Date of Birth -->
               

                <!-- Mobile -->
                <div class="col-md-4 mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{$profileData['StudentMobileNo']}}" required>
                </div>

                <!-- Aadhar No -->
              
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$profileData['PermanentAddress']}}" >
                </div>
            </div>
        
                         </div>
        
     
                      <div class="tab-pane" id="tabs-profile-7">
                          <!-- Course -->
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="course" class="form-label">Course</label>
                    <input type="text" class="form-control" id="course" name="course" value="{{$profileData['Course']}}" disabled>
                </div>

                <!-- Class Roll No -->
                <div class="col-md-6 mb-3">
                    <label for="class_roll_no" class="form-label">Class Roll No</label>
                    <input type="text" class="form-control" id="class_roll_no" name="class_roll_no" value="{{$profileData['ClassRollNo']}}" disabled>
                </div>

                <!-- Uni Roll No -->
                <div class="col-md-6 mb-3">
                    <label for="uni_roll_no" class="form-label">Uni Roll No</label>
                    <input type="text" class="form-control" id="uni_roll_no" name="uni_roll_no" value="{{$profileData['UniRollNo']}}" disabled>
                </div>

                <!-- IDNO -->
                <div class="col-md-6 mb-3">
                    <label for="idno" class="form-label">IDNO</label>
                    <input type="text" class="form-control" id="idno" name="idno" value="{{$profileData['IDNo']}}" disabled>
                </div>

                <!-- Batch -->
                <div class="col-md-6 mb-3">
                    <label for="batch" class="form-label">Batch</label>
                    <input type="text" class="form-control" id="batch" name="batch" value="{{$profileData['Batch']}}" disabled>
                </div>

                <!-- College -->
                <div class="col-md-6 mb-3">
                    <label for="college" class="form-label">College</label>
                    <input type="text" class="form-control" id="college" name="college" value="{{$profileData['CollegeName']}}" disabled>
                </div>
                    </div>
                  </div>
                  </div>
                  <div class="card-footer">
                  <div class="row align-items-right">
                    <div class="col-lg-10"></div>
                    <div class="col-auto">
                      <button  class="btn btn-primary">
                        Update
</button>
                    </div>
                  </div>
                </div>
            
    </div>
</form>

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
