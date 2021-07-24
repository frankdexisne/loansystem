@include('loans.reports_include.header',['report_title'=>'Collection Report '.($payment_mode_id==1 ? '(Daily Areas)' : '(Weekly Areas)'),'subtitle'=>'Date : '.date('m/d/Y',strtotime($date))])

<table width="870px" border="1">
    <tr>
        <th width="200px" style="font-weight:bold;text-align:center;font-size:11px;">Name</th>
        <th width="280px" style="font-weight:bold;text-align:center;font-size:11px;">Address</th>
        <th width="50px" style="font-weight:bold;text-align:center;font-size:11px;">PS</th>
        <th width="50px" style="font-weight:bold;text-align:center;font-size:11px;">CBU</th>
        <th width="50px" style="font-weight:bold;text-align:center;font-size:11px;">Ins</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Prin Amount</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Total</th>
        <th width="60px" style="font-weight:bold;text-align:center;font-size:11px;">OR #</th>
    </tr>
    @php
        $overall_cbu = 0;
        $overall_ps = 0;
        $overall_ins = 0;
        $overall_amount =0;
        $overall_total=0;
    @endphp
    @foreach($data as $row)
        <tr>
            <td style="font-weight:bold;" colspan="10"> AREA {{$row['area']}}</td>
        </tr>
        @php
            $area_cbu = 0;
            $area_ps = 0;
            $area_ins = 0;
            $area_amount =0;
            $area_total=0;
        @endphp
        @foreach($row['subdata'] as $subdata)
            <tr>
                <td>&nbsp;{{$subdata['client_name']}}</td>
                <td>&nbsp;{{$subdata['full_address']}}</td>
                <td align="right">{{number_format($subdata['ps_amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($subdata['cbu_amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($subdata['ins_amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($subdata['amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($subdata['ps_amount']+$subdata['cbu_amount']+$subdata['ins_amount']+$subdata['amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td></td>
            </tr>
            @php
                $area_ps += $subdata['ps_amount'];
                $area_cbu += $subdata['cbu_amount'];
                $area_ins += $subdata['ins_amount'];
                $area_amount += $subdata['amount'];
                $area_total += $subdata['ps_amount']+$subdata['cbu_amount']+$subdata['ins_amount']+$subdata['amount'];
            @endphp
        @endforeach
        <tr style="background-color:#438EB9;color:#fff">
            <td colspan="2">&nbsp;AREA {{$row['area']}} TOTAL</td>
            <td align="right">{{number_format($area_ps,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_cbu,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_ins,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_amount,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_total,2,'.',',')}}&nbsp;&nbsp;</td>
            <td></td>
        </tr>
        @php
            $overall_cbu += $area_cbu;
            $overall_ps += $area_ps;
            $overall_ins += $area_ins;
            $overall_amount +=$area_amount;
            $overall_total +=$area_total;
        @endphp
    @endforeach
    <tr style="background-color:#307ECC;color:#fff">
        <td colspan="2">&nbsp;ALL AREAS TOTAL</td>
        <td align="right">{{number_format($overall_ps,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_cbu,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_ins,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_amount,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_total,2,'.',',')}}&nbsp;&nbsp;</td>
        <td></td>
    </tr>
</table>

<br><br><br><br><br>
<table width="890px">
    <tr>
        <td align="center" width="260px" style="border-bottom:1px solid #000; font-weight: bold;">{{getBranchCashier()}}</td>
        
        <td width="370px"></td>
        
        <td align="center" width="260px" style="border-bottom:1px solid #000; font-weight: bold;">{{getBranchManager()}}</td>
    </tr>
    <tr>
        <td align="center">CASHIER</td>
        <td></td>
        <!-- <td align="center">ACCOUNT OFFICER</td> -->
        <!-- <td></td> -->
        <td align="center">BRANCH MANAGER</td>
    </tr>
</table>

