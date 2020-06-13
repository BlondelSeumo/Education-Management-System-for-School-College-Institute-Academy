<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

<div class="row">
    <div class="col-lg-12">
        <table class="display school-table school-table-style" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Payment Date</th>
                    <th>Reference No</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
            @php $x=1; @endphp
            @if($payments)
                @foreach($payments as $value)
                <tr>
                    <td>{{$x++}}</td>
                    <td  data-sort="{{strtotime($value->payment_date)}}" >
                       {{$value->payment_date != ""? App\SmGeneralSettings::DateConvater($value->payment_date):''}}
                    </td>
                    <td>{{$value->reference_no}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->paymentMethods !=""?$value->paymentMethods->method:""}}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_sell_payments({{$value->id}})">Delete</button></td>
                </tr>
               @endforeach
               @endif
            </tbody>
        </table>
    </div>
</div>
