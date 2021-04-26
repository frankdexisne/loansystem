@include('loans.reports_include.header')
<table>
    <tr>
        <td>
            @include('loans.reports_include.information')

            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100px">Loan Processor</td>
                    <td width="20px">:</td>
                    <td style="font-weight:bold;">___________________________</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100px">Branch Manager</td>
                    <td width="20px">:</td>
                    <td style="font-weight:bold;">___________________________</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100px">Client</td>
                    <td width="20px">:</td>
                    <td style="font-weight:bold;">___________________________</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0.5">
                <tr style="font-weight:bold;" align="center">
                    <td>Schedule Date</td>
                    <td>Amount</td>
                    <td>PS</td>
                    <td>CBU</td>
                    <td>Total</td>
                </tr>

                @foreach($data->schedule as $row)
                    <tr>
                        <td align="center">{{date('m/d/Y',strtotime($row->schedule_date))}}</td>
                        <td align="right">{{number_format($data->payment_per_sched,2,'.',',')}}&nbsp;&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>