@include('loans.reports_include.header',['report_title'=>'Loan Report','subtitle'=>'Date : '.date('m/d/Y',strtotime($date))])

<table width="870px" border="1">
    <tr>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">#</th>
        <th width="210px" style="font-weight:bold;text-align:center;font-size:11px;">Name</th>
        <th width="110px" style="font-weight:bold;text-align:center;font-size:11px;">Loan Amount</th>
        <th width="130px" style="font-weight:bold;text-align:center;font-size:11px;">Loan Balance</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Sales</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Deduction</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Byout</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Net</th>
    </tr>

</table>