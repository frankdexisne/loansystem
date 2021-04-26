<table>
    <tr>
        <td width="100px">Transaction #</td>
        <td width="20px">:</td>
        <td style="font-weight:bold;">{{$data->transaction_code}}</td>
    </tr>
    <tr>
        <td>Category</td>
        <td>:</td>
        <td style="font-weight:bold;">{{$data->category->name}}</td>
    </tr>
    <tr>
        <td>Payment Mode</td>
        <td>:</td>
        <td style="font-weight:bold;">{{$data->payment_mode->name}}</td>
    </tr>
    <tr>
        <td>Terms</td>
        <td>:</td>
        <td style="font-weight:bold;">{{$data->term->no_of_months}} months</td>
    </tr>
    <tr>
        <td>Loan Amount</td>
        <td>:</td>
        <td style="font-weight:bold;">{{number_format($data->loan_amount,2,'.',',')}}</td>
    </tr>
    <tr>
        <td>Interest</td>
        <td>:</td>
        <td style="font-weight:bold;">{{number_format($data->loan_amount*($data->interest/100),2,'.',',')}} ({{$data->interest}} %)</td>
    </tr>
    <tr>
        <td>Date Release</td>
        <td>:</td>
        <td style="font-weight:bold;">{{date('m/d/Y',strtotime($data->date_release))}}</td>
    </tr>
    <tr>
        <td>Maturity Date</td>
        <td>:</td>
        <td style="font-weight:bold;">{{date('m/d/Y',strtotime($data->maturity_date))}}</td>
    </tr>
</table>