@include('loans.reports_include.header',['report_title'=>'Sales Monitoring Report '.($payment_mode_id==1 ? '(Daily Areas)' : '(Weekly Areas)'),'subtitle'=>'Date : '.date('m/d/Y',strtotime($date))])

<table width="870px" border="0.5">
    <tr>
        <th width="230px" style="font-weight:bold;text-align:center;font-size:11px;">Name</th>
        <th width="40px" style="font-weight:bold;text-align:center;font-size:11px;">R/N</th>
        <th width="50px" style="font-weight:bold;text-align:center;font-size:11px;">LSP</th>
        <th width="50px" style="font-weight:bold;text-align:center;font-size:11px;">CBU</th>
        <th width="70px" style="font-weight:bold;text-align:center;font-size:11px;">Deduction</th>
        <th width="110px" style="font-weight:bold;text-align:center;font-size:11px;">Principal Amount</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Net</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Sales</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Balance</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Signature</th>
    </tr>
    @php
        $overall_deduction = 0;
        $overall_loan_amount = 0;
        $overall_net = 0;
        $overall_sales = 0;
        $overall_balance = 0;
    @endphp
    @foreach($data as $row)
        <tr>
            <td style="font-weight:bold;" colspan="10"> AREA {{$row['area']}}</td>
        </tr>
        @php
            $area_total_deduction = 0;
            $area_total_loan_amount = 0;
            $area_total_net = 0;
            $area_sales = 0;
            $area_total_balance = 0;
        @endphp
        @foreach($row['loans'] as $loan)
            <tr>
                <td>{{$loan['lname'].' '.$loan['fname'].' '.$loan['mname']}}</td>
                <td align="center">{{$loan['is_renew']==1 ? 'R' : 'N'}}</td>
                <td></td>
                <td></td>
                <td align="right">{{number_format($loan['total_deduction'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($loan['loan_amount'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($loan['loan_amount']-$loan['total_deduction'],2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($loan['loan_amount']*($loan['interest']/100),2,'.',',')}}&nbsp;&nbsp;</td>
                <td align="right">{{number_format($loan['loan_amount']+($loan['loan_amount']*($loan['interest']/100)),2,'.',',')}}&nbsp;&nbsp;</td>
                <td></td>
            </tr>
            @php
                $area_total_deduction+= $loan['total_deduction'];
                $area_total_loan_amount+= $loan['loan_amount'];
                $area_total_net+= $loan['loan_amount']-$loan['total_deduction'];
                $area_sales+= $loan['loan_amount']*($loan['interest']/100);
                $area_total_balance+= $loan['loan_amount']+($loan['loan_amount']*($loan['interest']/100));
            @endphp
        @endforeach
        <tr style="background-color:#438EB9;color:#fff">
            <td style="font-weight:bold;" colspan="2">AREA {{strtoupper($row['area'])}} TOTAL</td>
            <td></td>
            <td></td>
            <td align="right">{{number_format($area_total_deduction,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_total_loan_amount,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_total_net,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_sales,2,'.',',')}}&nbsp;&nbsp;</td>
            <td align="right">{{number_format($area_total_balance,2,'.',',')}}&nbsp;&nbsp;</td>
            <td></td>
        </tr>
        @php
            $overall_deduction += $area_total_deduction;
            $overall_loan_amount += $area_total_loan_amount;
            $overall_net += $area_total_net;
            $overall_sales += $area_sales;
            $overall_balance += $area_total_balance;
        @endphp
    @endforeach
    <tr style="background-color:#307ECC;color:#fff">
        <td style="font-weight:bold;" colspan="2">ALL AREA TOTAL</td>
        <td></td>
        <td></td>
        <td align="right">{{number_format($overall_deduction,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_loan_amount,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_net,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_sales,2,'.',',')}}&nbsp;&nbsp;</td>
        <td align="right">{{number_format($overall_balance,2,'.',',')}}&nbsp;&nbsp;</td>
        <td></td>
    </tr>
</table>
<br><br><br><br><br>
<table width="890px">
    <tr>
        <td width="260px" style="border-bottom:1px solid #000">{{getBranchSecretary()}}</td>
        <td width="55px"></td>
        <td width="260px" style="border-bottom:1px solid #000"></td>
        <td width="55px"></td>
        <td width="260px" style="border-bottom:1px solid #000">{{getBranchManager()}}</td>
    </tr>
    <tr>
        <td align="center">SECRETARY</td>
        <td></td>
        <td align="center">ACCOUNT OFFICER</td>
        <td></td>
        <td align="center">BRANCH MANAGER</td>
    </tr>
</table>
