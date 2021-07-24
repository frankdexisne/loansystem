@include('loans.reports_include.header',['report_title'=>'Withdrawal Report','subtitle'=>'Date : '.date('m/d/Y',strtotime($date))])

<table width="870px" border="1">
    <tr>
        <th width="120px" style="font-weight:bold;text-align:center;font-size:11px;">#</th>    
        <th width="110px" style="font-weight:bold;text-align:center;font-size:11px;">Name</th>
        <th width="280px" style="font-weight:bold;text-align:center;font-size:11px;">Address</th>
        <!-- <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">PS</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">CBU</th>
        <th width="80px" style="font-weight:bold;text-align:center;font-size:11px;">Ins</th> -->
        
        <th width="100px" style="font-weight:bold;text-align:center;font-size:11px;">Amount</th>
        <!-- <th width="40px" style="font-weight:bold;text-align:center;font-size:11px;">OR #</th> -->
    </tr>

</table>
