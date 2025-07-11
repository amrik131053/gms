@include('css')
<div class="page">
    @include('header')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header ">
                <h4 class="mb-0">Document Application Confirmation</h4>
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
                <input type="hidden" name="docID" id="docID" value="{{$data['DocumentRequested']}}">
                <form id="update-receiving-type"
                    action="{{ route('apply-documents.update-address', Crypt::encrypt($data['Id'])) }}" method="POST">
                    <table class="table table-bordered">

                        <tr>
                            <th>Applied Document</th>
                            <td>{{ $data['AppliedDoc'] }}</td>
                        </tr>

                        <tr>
                            <th>Receiving Type</th>
                            <td>

                                <div class="d-flex gap-2 align-items-center">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ $data['ReceivingType'] ?? '-' }}
                                    </span>
                                    @csrf
                                    @method('PUT')
                                    <select name="ReceivingType" id="receivingTypeSelect"
                                        class="form-select form-select-sm w-auto">
                                        <option value="Home Delivery"
                                            {{ $data['ReceivingType'] == 'Home Delivery' ? 'selected' : '' }}>Home
                                            Delivery
                                        </option>
                                        <option value="By Hand"
                                            {{ $data['ReceivingType'] == 'By Hand' ? 'selected' : '' }}>
                                            By Hand</option>
                                    </select>
                                </div>

                            </td>
                        </tr>

                        <!-- ADDRESS FIELDS, visible only if Home Delivery -->
                        <tbody id="addressRows"
                            style="display: {{ $data['ReceivingType'] == 'Home Delivery' ? 'table-row-group' : 'none' }};">
                            <tr>
                                <th>Country</th>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ is_array($data) && array_key_exists('Country', $data) ? $data['Country'] : '-' }}
                                    </span>

                                    <select class="form-select form-select-sm" id="country" name="country"
                                        onchange="loadState_i(this.value); updateLabel('country');" required>
                                        <option value="">Select</option>
                                        @foreach ($allCountries as $countriesName)
                                        <option value="{{ $countriesName['id'] }}"
                                            {{ ($countriesName['name'] == data_get($data, 'Country')) ? 'selected' : '' }}>
                                            {{ $countriesName['name'] }}
                                        </option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="country_label" id="country_label">
                                </td>
                            </tr>

                            <tr>
                                <th>State</th>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ is_array($data) && array_key_exists('State', $data) ? $data['State'] : '-' }}
                                    </span>
                                    <select class="form-select form-select-sm" id="state" name="state"
                                        onchange="loadCity_i(this.value); updateLabel('state');" required>
                                        <option value="">Select</option>
                                        {{-- Your dynamically loaded options here --}}
                                    </select>
                                    <input type="hidden" name="state_label" id="state_label">
                                </td>
                            </tr>

                            <tr>
                                <th>District</th>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ is_array($data) && array_key_exists('District', $data) ? $data['District'] : '-' }}
                                    </span>
                                    <select class="form-select form-select-sm" id="city" name="district"
                                        onchange="updateLabel('city');" required>
                                        <option value="">Select</option>
                                        {{-- Your dynamically loaded options here --}}
                                    </select>
                                    <input type="hidden" name="district_label" id="city_label">
                                </td>
                            </tr>

                            <tr>
                                <th>PIN</th>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ is_array($data) && array_key_exists('Pin', $data) ? $data['Pin'] : '-' }}
                                    </span>
                                    <input type="text" class="form-control form-control-sm" name="Pin"
                                        form="update-receiving-type"
                                        value="{{ is_array($data) && array_key_exists('Pin', $data) ? $data['Pin'] : '' }}">
                                </td>
                            </tr>

                            <tr>
                                <th>Address Line</th>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="fw-bold text-secondary small" style="min-width: 120px;">
                                        {{ is_array($data) && array_key_exists('AddressLine', $data) ? $data['AddressLine'] : '-' }}
                                    </span>
                                    <input type="text" class="form-control form-control-sm" name="AddressLine"
                                        form="update-receiving-type"
                                        value="{{ is_array($data) && array_key_exists('AddressLine', $data) ? $data['AddressLine'] : '-' }}">
                                </td>

                            </tr>

                        </tbody>
                        <tr>
                            <td></td>
                            <td class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Save Address </button>
                            </td>

                        </tr>
                    </table>

                </form>



                <h4 class="mt-4">Documents Requested</h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Document Name</th>
                            <th>Status</th>
                            <th style="width: 250px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataDocument as $doc)
                        <tr id="doc-row-{{ $doc['DocId'] }}">
                            <td>{{ $doc['DocName'] }}</td>
                            <td>
                                <span id="doc-status-{{ $doc['DocId'] }}"
                                    class="badge bg-{{ $doc['DocStatus'] == 1 ? 'success' : 'warning' }} text-white">
                                    {{ $doc['DocStatus'] == 1 ? 'Uploaded' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    @if(!empty($doc['DocumentPath']))
                                    <a href="http://erp.gku.ac.in:86/Documents/Students/{{ $doc['DocumentPath'] }}"
                                        target="_blank" class="btn btn-primary btn-sm">
                                        View &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                    @endif

                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick="toggleUpload({{ $doc['DocId'] }})">
                                        Edit
                                    </button>
                                </div>

                                <!-- Upload form hidden initially -->
                                <form id="upload-form-{{ $doc['DocId'] }}" class="row gx-2 mt-2 d-none"
                                    enctype="multipart/form-data" onsubmit="submitDocument(event, {{ $doc['DocId'] }})">

                                    @csrf
                                    <div class="col-12 col-md">
                                        <input type="file" name="document" accept=".{{ $doc['DocumentExtension'] }}"
                                            class="form-control form-control-sm" required>
                                        <input type="hidden" name="docId" value="{{ $doc['DocId'] }}">
                                        <input type="hidden" name="requestId"
                                            value="{{ Crypt::encrypt($data['DocId']) }}">
                                    </div>
                                    <div class="col-12 col-md-auto mt-2 mt-md-0">
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            Upload
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                                ₹<span id="docFeeText">{{ number_format($data['DocumentCharges'], 2) }}</span>
                                <input type="hidden" id="docFee" value="{{ $data['DocumentCharges'] }}">
                            </td>
                        </tr>

                        <tr id="postalChargeRow"
                            style="{{ $data['ReceivingType'] === 'Home Delivery' ? '' : 'display:none;' }}">
                            <td>Postal Charge</td>
                            <td>
                                ₹<span id="postalChargeText">{{ number_format($data['PostalCharges'] ?? 0, 2) }}</span>
                                <input type="hidden" id="postalCharge" value="{{ $data['PostalCharges'] ?? 0 }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Other Charges</td>
                            <td>
                                ₹<span id="otherChargeText">{{ number_format($data['OtherCharges']??0, 2) }}</span>
                                <input type="hidden" id="otherCharge" value="{{ $data['OtherCharges'] ?? 0 }}">

                            </td>
                        </tr>

                        <tr class="table-info fw-bold">
                            <td>Total</td>
                            <td>
                                ₹<span id="totalAmount">
                                    {{
                        number_format($data['TotalAmount'])
                    }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="confirmationCheck" required>
                    <label class="form-check-label" for="confirmationCheck">
                        I hereby confirm that I have carefully reviewed and verified all the details and charges
                        mentioned above. I understand that the application once submitted cannot be modified, and I
                        agree to proceed with the document request.
                    </label>
                </div>


                <div class="mt-4 d-flex justify-content-between">

                    <form method="POST" action="{{ route('apply-documents-finalize', Crypt::encrypt($data['Id'])) }}">
                        @csrf
                        <button type="submit" id="finalSubmitBtn" class="btn btn-success" disabled>
                            Final Submit
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    @include('footer')
</div>


@include('script')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('confirmationCheck');
    const submitBtn = document.getElementById('finalSubmitBtn');

    checkbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });
});
</script>

<script>
function updateLabel(fieldId) {
    const select = document.getElementById(fieldId);
    const selectedText = select.options[select.selectedIndex]?.text || '';
    const hiddenField = document.getElementById(fieldId + '_label');
    if (hiddenField) {
        hiddenField.value = selectedText;
    }
}

function toggleUpload(docId) {
    const form = document.getElementById('upload-form-' + docId);
    form.classList.toggle('d-none');
}

function submitDocument(e, docId) {
    e.preventDefault();

    const form = document.getElementById('upload-form-' + docId);
    const formData = new FormData(form);

    fetch("{{ url('/apply-documents/upload-document') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.flag == 1) {
                // alert('Document uploaded!');
                document.getElementById('doc-status-' + docId).innerText = 'Uploaded';
                document.getElementById('doc-status-' + docId).className = 'badge bg-success';
                // location.reload(); // Optional: to update the "View" link
            } else {
                // alert('Upload failed: ' + (data.message || ''));
            }
        })
        .catch(err => {
            // alert('Error uploading file.');
            console.error(err);
        });
}
</script>

<script>
document.getElementById('receivingTypeSelect').addEventListener('change', function() {
    const addressRows = document.getElementById('addressRows');
    if (this.value === 'Home Delivery') {
        addressRows.style.display = 'table-row-group';
    } else {
        addressRows.style.display = 'none';
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const docSelect = document.getElementById('docID');
    const receivingSelect = document.getElementById('receivingTypeSelect');
    const countrySelect = document.getElementById('country');

    // if (docSelect) {
    //     docSelect.addEventListener('change', fetchCharges);
    // }

    if (receivingSelect) {
        receivingSelect.addEventListener('change', fetchCharges);
    }

    if (countrySelect) {
        countrySelect.addEventListener('change', fetchCharges);
    }

    function fetchCharges() {
        const docName = docSelect?.value || '';
        const deliveryMode = receivingSelect?.value || '';
        const countryId = countrySelect?.value || '';

        // if (!docName) {
        //     return;
        // }

        fetch("{{ route('document.charges') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    documentName: docName,
                    deliveryMode: deliveryMode,
                    countryId: countryId
                })
            })
            .then(response => response.json())
            .then(data => {
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