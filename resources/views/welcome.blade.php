@include ('css')
<div class="page">
    @include('header')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm card-link card-link-rotate">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-note">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M13 20l7 -7" />
                                                <path
                                                    d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7" />
                                            </svg> </span>
                                    </div>
                                    <div class="card-status-top bg-primary"></div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Library
                                        </div>
                                        <div class="text-secondary">

                                            Books Issued:{{$booksCount['books']}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm card-link card-link-rotate">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <svg version="1.1" id="Layer_1" width="24" height="24"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path style="fill:#f7f7f7;"
                                                        d="M384.305,86.553H127.695c-25.72,0-46.763,21.043-46.763,46.763v320.232 c0,25.72,21.043,46.763,46.763,46.763h256.611c25.72,0,46.763-21.043,46.763-46.763V133.316 C431.068,107.597,410.025,86.553,384.305,86.553z">
                                                    </path>
                                                    <rect x="223.853" y="11.691" style="fill:#524E4D;" width="64.299"
                                                        height="109.846"></rect>
                                                    <rect x="171.829" y="191.681" style="fill:#FFFFFF;" width="168.346"
                                                        height="168.346"></rect>
                                                    <circle style="fill:#EE3840;" cx="256.002" cy="252.472" r="23.381">
                                                    </circle>
                                                    <path
                                                        d="M384.305,74.863H299.84V11.691C299.84,5.235,294.605,0,288.149,0h-64.299c-6.456,0-11.691,5.235-11.691,11.691v63.172 h-84.465c-32.231,0-58.453,26.222-58.453,58.453v320.23c0,32.231,26.222,58.453,58.453,58.453h256.611 c32.231,0,58.453-26.222,58.453-58.453v-320.23C442.759,101.085,416.537,74.863,384.305,74.863z M235.541,23.381h40.917v86.459 h-40.917V23.381z M419.378,453.546c0,19.339-15.733,35.072-35.072,35.072H127.695c-19.339,0-35.072-15.733-35.072-35.072v-320.23 c0-19.339,15.733-35.072,35.072-35.072h84.465v11.596h-11.691c-6.456,0-11.691,5.235-11.691,11.691s5.235,11.691,11.691,11.691 h111.062c6.456,0,11.691-5.235,11.691-11.691s-5.235-11.691-11.691-11.691H299.84V98.244h84.465 c19.339,0,35.072,15.733,35.072,35.072V453.546z">
                                                    </path>
                                                    <path
                                                        d="M256,59.623c6.769,0,12.275-5.506,12.275-12.275S262.769,35.072,256,35.072c-6.769,0-12.275,5.506-12.275,12.275 S249.231,59.623,256,59.623z">
                                                    </path>
                                                    <path
                                                        d="M340.173,418.474H171.827c-6.456,0-11.691,5.235-11.691,11.691c0,6.456,5.235,11.691,11.691,11.691h168.346 c6.456,0,11.691-5.235,11.691-11.691C351.864,423.709,346.629,418.474,340.173,418.474z">
                                                    </path>
                                                    <path
                                                        d="M206.899,313.258c0,6.456,5.235,11.691,11.691,11.691h74.82c6.456,0,11.691-5.235,11.691-11.691 c0-6.456-5.235-11.691-11.691-11.691h-74.82C212.133,301.567,206.899,306.803,206.899,313.258z">
                                                    </path>
                                                    <path
                                                        d="M291.072,254.805c0-19.339-15.733-35.072-35.072-35.072s-35.072,15.733-35.072,35.072s15.733,35.072,35.072,35.072 S291.072,274.143,291.072,254.805z M244.309,254.805c0-6.446,5.244-11.691,11.691-11.691c6.446,0,11.691,5.244,11.691,11.691 c0,6.446-5.244,11.691-11.691,11.691C249.554,266.495,244.309,261.251,244.309,254.805z">
                                                    </path>
                                                    <path
                                                        d="M340.173,179.984H171.827c-6.456,0-11.691,5.235-11.691,11.691v168.346c0,6.456,5.235,11.691,11.691,11.691h168.346 c6.456,0,11.691-5.235,11.691-11.691v-37.284c0-6.456-5.235-11.691-11.691-11.691c-6.456,0-11.691,5.235-11.691,11.691v25.593 H183.518V203.366h144.965v79.498c0,6.456,5.235,11.691,11.691,11.691c6.456,0,11.691-5.235,11.691-11.691v-91.189 C351.864,185.219,346.629,179.984,340.173,179.984z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="card-status-top bg-primary"></div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Smart Card
                                        </div>
                                        <div class="text-secondary">
                                            @if ($smartcardStatus['status'] == 'Applied')
                                            Status:<b class="text-primary">{{ $smartcardStatus['status'] }}</b>
                                            @elseif ($smartcardStatus['status'] == 'Printed')
                                            Status:<b class="text-success">{{ $smartcardStatus['status'] }}</b>
                                            @elseif ($smartcardStatus['status'] == 'Verified')
                                            Status: <b class="text-warning">{{ $smartcardStatus['status'] }}</b>
                                            @elseif ($smartcardStatus['status'] == 'Rejected')
                                            Status: <b class="text-danger">{{ $smartcardStatus['status'] }}</b>
                                            @else
                                            Status: <b class="text-danger">{{ $smartcardStatus['status'] }}</b>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm card-link card-link-rotate">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg> </span>
                                    </div>
                                    <div class="card-status-top bg-primary"></div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ \Carbon\Carbon::now()->format('l') }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ \Carbon\Carbon::now()->format('d-M-Y') }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm card-link card-link-rotate">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-facebook text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="card-status-top bg-primary"></div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Hostel
                                        </div>
                                        <div class="text-secondary">
                                            @if (!empty($meterDetails) && array_key_exists('article_no', $meterDetails))
                                            <b>Room No: {{ $meterDetails['article_no'] }}</b></br>
                                            <b>Current Bill: {{ intval($meterDetails['amount']) }} Each Student</b>

                                            @else
                                            <b>Room No: NA</b>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <!-- <div class="card"> -->
                <!-- <div class="card-header">
                    <h3 class="card-title">Cards inside card</h3>
                  </div> -->
                <!-- <div class="card-body"> -->
                <div class="row row-cards">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-status-top bg-primary"></div>
                            <div class="card-header">
                                <h3 class="card-title">Office Order </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y" style="height: 20rem">

                                        @foreach ($noticeBoard as $noticeBoardShow )
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span
                                                        class="avatar">{{ \Carbon\Carbon::parse($noticeBoardShow['DateEntry'])->format('d') }}<br>{{ \Carbon\Carbon::parse($noticeBoardShow['DateEntry'])->format('M') }}</span>
                                                </div>
                                                <div class="col">
                                                    <div class="">
                                                        <strong class="text-danger">
                                                            {{$noticeBoardShow['Subject']}}</strong> <a target="_blank"
                                                            href="http://erp.gku.ac.in:86/Notices/{{$noticeBoardShow['FileName']}}"><b>Click
                                                                Here</b></a>
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \Carbon\Carbon::parse($noticeBoardShow['DateEntry'])->format('d-m-Y') }}
                                                    </div>
                                                </div>
                                                <!-- <div class="col-auto align-self-center"> -->
                                                <!-- <div class="badge bg-primary">Click Here</div> -->
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-status-top bg-primary"></div>
                            <div class="card-header">
                                <h3 class="card-title">Notice</h3>
                            </div>
                            <div class="card-body p-0">

                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y" style="height: 20rem">
                                        @foreach ($officeOrder as $officeorderShow )
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span
                                                        class="avatar">{{ \Carbon\Carbon::parse($officeorderShow['Date'])->format('d') }}<br>{{ \Carbon\Carbon::parse($officeorderShow['Date'])->format('M') }}</span>
                                                </div>
                                                <div class="col">
                                                    <div class="">
                                                        <strong class="text-danger">
                                                            {{$officeorderShow['Subject']}}</strong> <a target="_blank"
                                                            href="http://erp.gku.ac.in:86/Notices/{{$officeorderShow['FileName']}}"><b>Click
                                                                Here</b></a>
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \Carbon\Carbon::parse($officeorderShow['Date'])->format('d-m-Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-status-top bg-primary"></div>
                            <div class="card-header">
                                <h3 class="card-title">Latest News</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y" style="height: 20rem">
                                        @foreach ($newsDetails as $newsDetailsShow )
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span
                                                        class="avatar">{{ \Carbon\Carbon::parse($newsDetailsShow['expiry'])->format('d') }}<br>{{ \Carbon\Carbon::parse($newsDetailsShow['expiry'])->format('M') }}</span>
                                                </div>
                                                <div class="col">
                                                    <div class="">
                                                        <strong class="text-danger">
                                                            {{ Str::limit(html_entity_decode($newsDetailsShow['subjectEng']), 100) }}
                                                        </strong>
                                                        <span class="short-text">
                                                            {{ Str::limit(html_entity_decode($newsDetailsShow['bodyEng']), 100) }}
                                                        </span>
                                                        <a target="_blank"
                                                            href="http://erp.gku.ac.in:86/Notices/{{$newsDetailsShow['newsRef']}}"><b>Read
                                                                More
                                                            </b></a>
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ \Carbon\Carbon::parse($newsDetailsShow['expiry'])->format('d-m-Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
</div>


















</div>
</div>
@include('footer')
</div>
</div>
@include('script')