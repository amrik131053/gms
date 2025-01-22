@include ('css')
<div class="page">
    @include('header')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12 col-sm-12">
                <div class="card-status-top bg-primary"></div>
                <div class="col-lg-12 col-sm-12 card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h4 class="card-title">Book Details</h4>
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
                                            <th>AccessionNo</th>
                                            <th>LastReturnDate</th>
                                            <th>IssueDate</th>

                                            <th>fine</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @if (!empty($issuedMaterialData))
                                        @foreach ($issuedMaterialData as $showbookMaterialData)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $showbookMaterialData['Title'] }}</td>
                                            <td>{{ $showbookMaterialData['Author'] }}</td>
                                            <td>{{ $showbookMaterialData['AccessionNo'] }}</td>

                                            <td>{{ \Carbon\Carbon::parse($showbookMaterialData['LastReturnDate'])->format('d-m-Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($showbookMaterialData['IssueDate'])->format('d-m-Y') }}
                                            </td>
                                            <td>₹ {{ $showbookMaterialData['fine'] }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-danger text-center">--No Record--</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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