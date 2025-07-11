@include('css')

<div class="page">
    @include('header')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-4 col-sm-12 card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">Apply Documents</h4>
                </div>

                <div class="card-body">
                    <div id="alertContainer">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
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
                    <form id="smartCardForm" data-submit-url="{{ route('submit-document') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="row">
                            <div class="row">
                                <div class="col-md-12 mb-12">
                                    <label for="applyFor" class="form-label">Apply For <small
                                            class='text-danger'>*</small></label>
                                    <select class="form-select" id="applyFor" name="applyFor" required>
                                        <option value="">Select</option>
                                        @foreach ($allApplidDocuments as $showDocuments)
                                        <option value="{{$showDocuments['ID']}}">{{$showDocuments['DocumentName']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-12">
                                    <label for="numberOfSem" class="form-label">Number of Semester <small
                                            class='text-danger'>*</small></label>
                                    <select class="form-select" id="numberOfSem" name="numberOfSem">
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>

                            <div id="documentInputs" class="row"></div>

                            <div class="col-lg-12" id="deliveryModeWrapper" style="display: none;">
                                <label class="form-label">Delivery Mode <small class='text-danger'>*</small></label>
                                <select class="form-select" id="deliveryMode" name="deliveryMode" required>
                                    <option value="">Select</option>
                                    <option value="Home Delivery">Home Delivery</option>
                                    <option value="By Hand">By Hand</option>
                                </select>
                            </div>


                            <div class="col-lg-12" id="postOptions" style="display: none;">
                                <label class="form-label">Post Type</label>
                                <select class="form-select" id="postType" name="postType" required>
                                    <option value="">Select</option>
                                    <option value="Within India">Within India</option>
                                    <option value="Outside India">Outside India</option>
                                </select>
                            </div>

                            <!-- Within India address fields -->
                            <div id="withinIndiaFields" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-md-4" id="countryForOther" style="display:none;">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" id="country" name="country"
                                            onchange="loadState_i(this.value); updateLabel('country');">
                                            <option value="">Select</option>
                                            @foreach ($allCountries as $countriesName)
                                            <option value="{{ $countriesName['id'] }}">{{ $countriesName['name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="country_label" id="country_label">
                                    </div>
                                    <div class="col-md-4" id="countryForIndia" style="display:none;">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" id="country1" name="country"
                                            onchange="loadState_i(this.value); updateLabel1('country1');">
                                            <option value="">Select</option>
                                            <option value="101">India</option>
                                        </select>
                                        <input type="hidden" name="country1_label1" id="country1_label1">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">State</label>
                                        <select class="form-select" id="state" name="state"
                                            onchange="loadCity_i(this.value); updateLabel('state');">
                                            <option value="">Select</option>
                                        </select>
                                        <input type="hidden" name="state_label" id="state_label">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="city" name="district"
                                            onchange="updateLabel('city');">
                                            <option value="">Select</option>
                                        </select>
                                        <input type="hidden" name="district_label" id="city_label">
                                    </div>



                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">PIN Code</label>
                                        <input type="text" class="form-control" name="pin">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Full Address</label>
                                        <textarea class="form-control" name="full_address" rows="1"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12" id="feeTable" style="display: none;">
                                <h4 class="mt-4">Charges Summary</h4>

                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Particular</th>
                                            <th>Amount (₹)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Document Fee</td>
                                            <td>
                                                ₹<span id="docFeeText"></span>
                                                <input type="hidden" id="docFee" value="">
                                            </td>
                                        </tr>

                                        <tr id="postalChargeRow">
                                            <td>Postal Charge</td>
                                            <td>
                                                ₹<span id="postalChargeText"></span>
                                                <input type="hidden" id="postalCharge" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Other Charges</td>
                                            <td>
                                                ₹<span id="otherChargeText"></span>
                                                <input type="hidden" id="otherCharge" value="">

                                            </td>
                                        </tr>

                                        <tr class="table-info fw-bold">
                                            <td>Total</td>
                                            <td>
                                                ₹<span id="totalAmount">

                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <div class="row align-items-right">
                        <div class="col-lg-10"></div>
                        <div class="col-auto">
                            <button class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                </form>

            </div>
            <!-- <div id="subjectsTableDiv"></div> -->

            <div class="col-lg-8 col-sm-12">
                <form action="#" method="post" class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h4 class="card-title">All Documents Requests</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="table-default" class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Request No</th>
                                            <th>Document Name</th>
                                            <th>Submit Date</th>

                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">

                                        @if (!empty($DataFinal))
                                        @foreach ($DataFinal as $DataFinalShows)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $DataFinalShows['Id']}}</td>
                                            <td>{{ $DataFinalShows['DocumentName']}}</td>
                                            <td>{{ \Carbon\Carbon::parse($DataFinalShows['SubmitDate'])->format('d-m-Y') }}
                                            </td>

                                            <td>
                                                @if ($DataFinalShows['Status']=='-1')
                                                <b class="text-primary">Pending to Confirm</b>
                                                @elseif ($DataFinalShows['Status']=='0')
                                                <b class="text-warning">Payment Pending</b>
                                                @elseif ($DataFinalShows['Status']=='1')
                                                <b class="text-success">In Process</b>
                                                <!-- due to: <b class="text-danger">{{ $DataFinalShows['ReceivingType']}}</b> -->
                                                @else
                                                <b class="text-danger">--</b>
                                                @endif
                                            </td>
                                            <td>

                                                @if ($DataFinalShows['Status']=='-1')
                                                <button type="button" class="btn btn-danger btn-sm">Cencel</button>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    onclick="window.location.href='{{ route('apply-documents-view',  Crypt::encrypt($DataFinalShows['Id'])) }}'">
                                                    View &nbsp;
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </button>
                                                @elseif ($DataFinalShows['Status']=='0')
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="window.location.href='{{ route('payu.confirm', Crypt::encrypt($DataFinalShows['Id'])) }}'">
                                                    Pay Now
                                                </button>

                                                @elseif ($DataFinalShows['Status']=='1')
                                                <button type="button" class="btn btn-success btn-sm">Track</button>
                                                @else
                                                <b class="text-danger">--</b>
                                                @endif

                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">---No Record---</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('footer')
</div>
<script>
document.getElementById('applyFor').addEventListener('change', handleDocLoad);
document.getElementById('numberOfSem').addEventListener('change', handleDocLoad);
const semDropdown = document.getElementById('numberOfSem').parentElement;
semDropdown.style.display = 'none';

function handleDocLoad() {
    const applyFor = document.getElementById('applyFor').value;
    const numberOfSem = document.getElementById('numberOfSem').value;

    if (applyFor) {
        loadRequiredDocs(applyFor, numberOfSem);
    }
}

function loadRequiredDocs(applyFor, numberOfSem) {
    showLoader();
    fetch('/fetch-required', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                applyFor
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            hideLoader();
            document.getElementById('deliveryModeWrapper').style.display = 'block';
            document.getElementById('feeTable').style.display = 'block';
            const container = document.getElementById('documentInputs');
            container.innerHTML = '';

            data.forEach((doc, index) => {
                container.innerHTML += `
    <div class="col-md-6 mb-3">
      <label class="form-label">${doc.DocumentName} Document <small class='text-danger'>* (Only .${doc.DocumentExtension},Max 5 MB)</small></label>
      <input type="file" class="form-control" name="${doc.DocumentName}_${doc.Id}" accept=".${doc.DocumentExtension}" required>
    </div>
  `;
            });


            let type = data.length > 0 ? data[0].Type : null;

            if (type === 1) {
                semDropdown.style.display = 'block';
                addSemesterInputs(container, 'DMC', numberOfSem);
            } else {
                semDropdown.style.display = 'none';
            }

            if (type === 2) {
                addSemesterCheckboxes(container, 'Semester');
            }
        })
        .catch(err => {
            hideLoader();
            console.error('Error fetching documents:', err);
        });
}

function addSemesterInputs(container, label, numberOfSem) {
    for (let i = 1; i <= parseInt(numberOfSem || 0); i++) {
        container.innerHTML += `
            <div class="col-md-6 mb-3">
                <label class="form-label">${i} Semester ${label}<small class='text-danger'>* (Only .pdf,Max 5 MB)</small></label>
                <input type="file" class="form-control" name="${label.toLowerCase()}${i}[]" accept=".pdf" multiple required>
            </div>`;
    }
}

function addSemesterCheckboxes(container, label, total = 12) {
    let html = '<div class="row">';
    for (let i = 1; i <= total; i++) {
        html += `
            <div class="col-6 col-sm-4 col-md-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="${label.toLowerCase()}_${i}" id="${label.toLowerCase()}_${i}">
                    <label class="form-check-label" for="${label.toLowerCase()}_${i}">${label} ${i}</label>
                </div>
            </div>`;
    }
    html += '</div>';
    container.innerHTML += html;
}


document.getElementById('deliveryMode').addEventListener('change', function() {
    const deliveryMode = this.value;
    toggleSection('postOptions', deliveryMode === 'Home Delivery');



    toggleSection('withinIndiaFields', false);
});

document.getElementById('postType').addEventListener('change', function() {
    const withinIndia = document.getElementById('withinIndiaFields');
    const countryForOther = document.getElementById('countryForOther');
    const countryForIndia = document.getElementById('countryForIndia');
    const postType = document.getElementById('postType').value;
    if (postType == 'Within India') {
        countryForIndia.style.display = 'block';
        countryForOther.style.display = 'none';
    } else {
        countryForIndia.style.display = 'none';
        countryForOther.style.display = 'block';
    }
    alert(postType);
    document.getElementById('country').value = "";
    withinIndia.style.display = (postType != '') ? 'block' : 'none';
});


function toggleSection(sectionId, show) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = show ? 'block' : 'none';
        section.querySelectorAll('input, select, textarea').forEach(el => {
            el.required = show;
        });
    }
}



document.getElementById('smartCardForm').addEventListener('submit', function(e) {
    e.preventDefault();
    showLoader();
    document.getElementById('alertContainer').innerHTML = '';

    const formData = new FormData(this);
    // Append checked semester checkboxes (if any)
    document.querySelectorAll('#documentInputs input[type="checkbox"]').forEach(chk => {
        formData.append(chk.name, chk.checked ? '1' : '0');
    });

    const url = this.dataset.submitUrl;
    // console.log("Submitting to:", url);

    fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(async res => {
            hideLoader();
            const text = await res.text();
            // console.log("Server response text:", text.slice(0, 300)); // show part of response

            let data = null;
            try {
                data = JSON.parse(text);
            } catch (err) {
                console.error("Invalid JSON returned from server:", err);
                document.getElementById('alertContainer').innerHTML = `
                <div class="alert alert-danger">
                    Server returned invalid response. Please try again or contact support.
                </div>`;
                return;
            }

            if (data.flag == 1) {
                document.getElementById('alertContainer').innerHTML = `
                <div class="alert alert-success">${data.message}</div>`;
            } else {

                document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-danger">${data.message}</div>
    `;
            }
        })
        .catch(err => {
            hideLoader();
            console.error("Fetch error:", err);
            document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-danger">
                An error occurred while submitting. Please try again.
            </div>`;
        });
});


function updateLabel(fieldId) {
    const select = document.getElementById(fieldId);
    const selectedText = select.options[select.selectedIndex]?.text || '';
    const hiddenField = document.getElementById(fieldId + '_label');
    if (hiddenField) {
        hiddenField.value = selectedText;
    }
}

function updateLabel1(fieldId) {
    const select = document.getElementById(fieldId);
    const selectedText = select.options[select.selectedIndex]?.text || '';
    const hiddenField = document.getElementById(fieldId + '_label1');
    if (hiddenField) {
        hiddenField.value = selectedText;
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const docSelect = document.getElementById('applyFor');
    const receivingSelect = document.getElementById('deliveryMode');
    const countrySelect = document.getElementById('country');
    const postType = document.getElementById('postType');

    // if (docSelect) {
    //     docSelect.addEventListener('change', fetchCharges);
    // }

    if (receivingSelect) {
        receivingSelect.addEventListener('change', fetchCharges);
    }

    if (countrySelect) {
        countrySelect.addEventListener('change', fetchCharges);
    }
    if (postType) {
        postType.addEventListener('change', fetchCharges);
    }

    function fetchCharges() {
        const docName = docSelect?.value || '';
        const deliveryMode = receivingSelect?.value || '';
        const countryId = countrySelect?.value || '';
        const postTypeid = postType?.value || '';

        showLoader();

        fetch("{{ route('document.charges') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    documentName: docName,
                    deliveryMode: deliveryMode,
                    postTypeid: postTypeid,
                    countryId: countryId
                })
            })
            .then(response => response.json())
            .then(data => {
                hideLoader();
                if (data.success) {
                    // Document Fee
                    document.getElementById('docFee').value = data.fee;
                    document.getElementById('docFeeText').textContent = parseFloat(data.fee).toFixed(2);

                    // Postal Charge
                    if (deliveryMode === 'Home Delivery') {
                        document.getElementById('postalCharge').value = data.postal_charge;
                        document.getElementById('postalChargeText').textContent = parseFloat(data
                            .postal_charge).toFixed(2);



                        document.getElementById('otherCharge').value = data.Other;
                        document.getElementById('otherChargeText').textContent = parseFloat(data.Other)
                            .toFixed(2);
                        document.getElementById('postalChargeRow').style.display = '';
                    } else {
                        document.getElementById('postalCharge').value = 0;
                        document.getElementById('postalChargeText').textContent = '0.00';
                        document.getElementById('otherCharge').value = 0;
                        document.getElementById('otherChargeText').textContent = '0.00';
                        document.getElementById('postalChargeRow').style.display = 'none';
                    }

                    calculateTotal();
                }
            });
    }

    function calculateTotal() {
        let fee = parseFloat(document.getElementById('docFee').value) || 0;
        let postal = parseFloat(document.getElementById('postalCharge').value) || 0;
        let other = parseFloat(document.getElementById('otherCharge').value) || 0;
        let total = fee + postal + other;

        document.getElementById('totalAmount').textContent = total.toFixed(2);
    }
});
</script>


@include('script')