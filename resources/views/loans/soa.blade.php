@include('loans.reports_include.header')
<table>
    <tr>
        <td>
            @include('loans.reports_include.information')
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table border="0.5">
                <tr style="font-weight:bold;" align="center">
                    <td>Payment Date</td>
                    <td>OR Number</td>
                    <td>Amount</td>
                    <td>PS</td>
                    <td>CBU</td>
                    <td>Total</td>
                </tr>

                @foreach($data->payment as $row)
                    <tr>
                        <td align="center">{{date('m/d/Y',strtotime($row->payment_date))}}</td>
                        <td align="center">{{$row->orno}}</td>
                        <td align="right">{{number_format($row->amount,2,'.',',')}}&nbsp;&nbsp;</td>
                        <td align="right">{{number_format($row->ps_amount,2,'.',',')}}&nbsp;&nbsp;</td>
                        <td align="right">{{number_format($row->cbu_amount,2,'.',',')}}&nbsp;&nbsp;</td>
                        <td align="right">{{number_format($row->amount+$row->ps_amount+$row->cbu_amount,2,'.',',')}}&nbsp;&nbsp;</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>