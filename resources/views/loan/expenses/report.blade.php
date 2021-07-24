@include('loans.reports_include.header',['report_title'=>'Expenses Report','subtitle'=>'Date : '.date('m/d/Y',strtotime($date))])

<table width="870px" border="1">
    <tr>
        <th width="40px" style="font-weight:bold;text-align:center;font-size:11px;">OR #</th>
        <th width="110px" style="font-weight:bold;text-align:center;font-size:11px;">Employee</th>
        <th width="120px" style="font-weight:bold;text-align:center;font-size:11px;">Expense Type</th>
        <th width="280px" style="font-weight:bold;text-align:center;font-size:11px;">Description</th>        
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Amount</th>
        <!-- <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Sales</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Balance</th>
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Signature</th> -->
    </tr>

</table>

