@include ('css')
    <div class="page">
 @include('header')
 <div class="container-xl">
            <div class="card">
            <div class="card-header">
                    <h4 class="card-title">Fee Receipts</h4>
                  </div>
              <div class="card-body">
                <div id="table-default" class="table-responsive">
                  <table class="table table-vcenter card-table">
                    <thead>
                      <tr>
                        <th><button class="table-sort">SrNo</button></th>
                        <th><button class="table-sort">Session</button></th>
                        <th><button class="table-sort">DateEntry</button></th>
                        <th><button class="table-sort">Semester</button></th>
                        <th><button class="table-sort">Type</button></th>
                        <th><button class="table-sort">ReceiptNo</button></th>
                        <th><button class="table-sort">TransactionID</button></th>
                        <th><button class="table-sort">Amount</button></th>
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @foreach ($feeReceiptData as $feedata)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="sort-session">{{ $feedata['Session'] }}</td>
                            <td class="sort-date">{{ $feedata['DateEntry'] }}</td>
                            <td class="sort-semester">{{ $feedata['Semester'] }}</td>
                            <td class="sort-type">{{ $feedata['Type'] }}</td>
                            <td class="sort-receipt">{{ $feedata['ReceiptNo'] }}</td>
                            <td class="sort-transaction">{{ $feedata['TransactionID'] }}</td>
                            <td class="sort-amount">{{ number_format($feedata['Amount']) }}</td>
                            <td class="sort-transaction">
                            <form action="{{url('fetch-receipt')}}" method="post">
                                @csrf
                              <input type="hidden" name="SlipID" value="{{$feedata['ReceiptNo']}}">
                              <input type="hidden" name="lagerName" value="{{$feedata['Type']}}">
                              <input type="hidden" name="session" value="{{$feedata['Session']}}">
                            <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
  <path d="M7 11l5 5l5 -5" />
  <path d="M12 4l0 12" />
</svg>      Download</button> </form>   </td>
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

