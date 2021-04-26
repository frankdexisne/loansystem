@extends('layouts.ace_master')

@section('style')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
</style>
@endsection

@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="#">Home</a>
    </li>
    <li class="active">Clients</li>
</ul>
@endsection

@section('content')



<div class="row">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">
                List
            </h4>
            <!-- <span class="widget-toolbar">
                <a href="#">
                    <i class="ace-icon fa fa-plus"></i> Apply loan
                </a>
            </span> -->
        </div>

        <div class="widget-body">
            <div class="widget-main">
            <!-- <form action="" id="search">
                <div class="form-group">
                    
                    <select name="area" id="area" class="form-control">

                    </select>
                </div>
            </form> -->
            <table class="table table-bordered" id="table-client" width="100%">
                <thead>                  
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Savings</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
                
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script src="{{asset('/ace-master')}}/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/ace-master')}}/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="{{asset('/ace-master')}}/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.flash.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.html5.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.print.min.js"></script>
<script src="{{asset('/ace-master')}}/js/buttons.colVis.min.js"></script>
<script src="{{asset('/ace-master')}}/js/dataTables.select.min.js"></script>
<script src="{{asset('/ace-master')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){    

    populate_dropdown("{{url('areas-json')}}",'form#search select[name="area"]','id','name');
    $('form#search select[name="area"]').prepend("<option value='none' disabled selected='selected'>Filter by area</option>")
    var areaHTML = '';
    var cityHTML = '';
    var relationshipHTML='';
    $.ajax({
        url: "{{url('areas-json')}}",
        type: "GET",
        dataType: 'JSON',
        success: function(result){
            $data = result.data;
            $.each($data, function() {
                areaHTML += '<option value="'+this.id+'">'+this.name+'</option>';
            });
            
            
        }
    });

    $.ajax({
        url: "{{url('relationships-json')}}",
        type: "GET",
        dataType: 'JSON',
        success: function(result){
            $data = result.data;
            $.each($data, function() {
                relationshipHTML += '<option value="'+this.id+'">'+this.name+'</option>';
            });
            
            
        }
    });

    function format(d){
        var returnHTML = '';
        var depositRows = '';
        var withdrawRows = '';
        var history = '';
        var cityHTML = '';
        var barangayHTML = '';
        var coMakercityHTML = '';
        var coMakerbarangayHTML = '';
        
        $.each(d.deposit,function(i){
            depositRows+='<tr data-id="'+this.id+'" data-index="'+i+'"><td>'+this.orno+'</td><td>'+this.payment_date_formatted+'</td><td>'+(this.ps!=null ? this.ps.amount : 0)+'</td><td>'+(this.cbu!=null ? this.cbu.amount : 0)+'</td><td><a class="blue edit-deposit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a class="red delete-deposit" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td></tr>';
        });

        $.each(d.withdraw,function(i){
            withdrawRows+='<tr data-id="'+this.id+'" data-index="'+i+'"><td>'+this.reference_no+'</td><td>'+this.withdraw_date_formatted+'</td><td>'+this.amount+'</td><td>'+this.transaction.wallet.name+'</td><td><a class="blue edit-withdraw" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a class="red delete-withdraw" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td></tr>';
        });
        $.each(d.inactive_loan,function(){
            history+='<tr><td>'+this.transaction_code+'</td><td>'+this.date_loan_formatted+'</td><td>'+this.loan_amount+'</td><td>'+this.interest+'%</td><td><a class="blue view-soa" href="#"><i class="ace-icon fa fa-file bigger-130"></i> Statement of Account</a></td></tr>';
        });

        $.each(d.address.philippine_barangay.philippine_province.philippine_city,function(){
            cityHTML += '<option value="'+this.city_municipality_code+'" '+(d.address.philippine_barangay.city_municipality_code==this.city_municipality_code ? 'selected' : '')+'>'+this.city_municipality_description+'</option>';
        });

        $.each(d.address.philippine_barangay.philippine_city.philippine_barangay,function(){
            barangayHTML += '<option value="'+this.id+'" '+(d.address.philippine_barangay_id==this.id ? 'selected' : '')+'>'+this.barangay_description+'</option>';
        });

        $.each(d.co_maker.co_maker_address.philippine_barangay.philippine_province.philippine_city,function(){
            coMakercityHTML += '<option value="'+this.city_municipality_code+'" '+(d.co_maker.co_maker_address.philippine_barangay.city_municipality_code==this.city_municipality_code ? 'selected' : '')+'>'+this.city_municipality_description+'</option>';
        });

        $.each(d.co_maker.co_maker_address.philippine_barangay.philippine_city.philippine_barangay,function(){
            coMakerbarangayHTML += '<option value="'+this.id+'" '+(d.co_maker.co_maker_address.philippine_barangay_id==this.id ? 'selected' : '')+'>'+this.barangay_description+'</option>';
        });

        
        returnHTML='<div class="tabbable">'+
            '<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">'+
                '<li class="active">'+
                    '<a data-toggle="tab" href="#profile">Profile</a>'+
                '</li>'+
                '<li class="">'+
                    '<a data-toggle="tab" href="#beneficiary">Beneficiary</a>'+
                '</li>'+
                '<li class="">'+
                    '<a data-toggle="tab" href="#co-maker">Co-Maker</a>'+
                '</li>'+
                '<li class="">'+
                    '<a data-toggle="tab" href="#deposit">Deposits</a>'+
                '</li>'+
                '<li class="">'+
                    '<a data-toggle="tab" href="#withdraw">Withdraws</a>'+
                '</li>'+
                '<li class="">'+
                    '<a data-toggle="tab" href="#history">History</a>'+
                '</li>'+
            '</ul>'+

            '<div class="tab-content">'+
                '<div id="profile" class="tab-pane in active">'+
                    '<form class="form-profile">'+
                        '<table width="100%">'+
                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Lastname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control lname" name="lname" style="width:50%" value="'+d.lname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Firstname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control fname" name="fname" style="width:50%" value="'+d.fname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Middle name</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control mname" name="mname" style="width:50%" value="'+d.mname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Date of Birth</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="date" class="form-control dob" name="dob" style="width:50%;margin-left:4px;" value="'+d.dob+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Gender</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="gender" class="form-control gender" style="width:50%" required>'+
                                        '<option value="MALE"'+(d.gender=="MALE" ? 'selected' : '')+'>Male</option>'+
                                        '<option value="FEMALE"'+(d.gender=="FEMALE" ? 'selected' : '')+'>Female</option>'+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Contact Number</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control contact_no" name="contact_no" style="width:50%" value="'+d.contact_no+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Company</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control company" name="company" style="width:50%" value="'+d.company+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Position</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control position" name="position" style="width:50%" value="'+d.position+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Monthly Salary</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="number" class="form-control monthly_salary" name="monthly_salary" style="width:50%;margin-left:4px;" value="'+d.monthly_salary+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Area</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="area_id" class="form-control area_id" style="width:50%" required>'+
                                        areaHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>City</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="city_id" class="form-control city_id" style="width:50%" required>'+
                                        cityHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Barangay</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="barangay_id" class="form-control barangay_id" style="width:50%" required>'+
                                        barangayHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Street</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" name="street" class="form-control street" style="width:50%" value="'+d.address.street+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    
                                '</td>'+
                                '<td width="90%">'+
                                    '<br><button type="submit" class="btn btn-success">Save</button>'+
                                '</td>'+
                            '</tr>'+

                            
                            


                        '</table>'+
                    
                    '</form>'+
                '</div>'+
                '<div id="beneficiary" class="tab-pane">'+
                    '<form class="form-beneficiary">'+
                        '<table width="100%">'+
                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Lastname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control lname" name="lname" style="width:50%" value="'+d.beneficiary.lname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Firstname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control fname" name="fname" style="width:50%" value="'+d.beneficiary.fname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Middlename</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control mname" name="mname" style="width:50%" value="'+d.beneficiary.mname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Gender</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="gender" class="form-control gender" style="width:50%" required>'+
                                        '<option value="MALE"'+(d.beneficiary.gender=="MALE" ? 'selected' : '')+'>Male</option>'+
                                        '<option value="FEMALE"'+(d.beneficiary.gender=="FEMALE" ? 'selected' : '')+'>Female</option>'+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Relationship</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="relationship_id" class="form-control relationship_id" style="width:50%" required>'+
                                    relationshipHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    
                                '</td>'+
                                '<td width="90%">'+
                                    '<br><button type="submit" class="btn btn-success">Save</button>'+
                                '</td>'+
                            '</tr>'+
                            


                        '</table>'+
                    
                    '</form>'+
                '</div>'+
                '<div id="co-maker" class="tab-pane">'+
                    '<form class="form-co-maker">'+
                        '<table width="100%">'+
                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Lastname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control lname" name="lname" style="width:50%" value="'+d.co_maker.lname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Firstname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control fname" name="fname" style="width:50%" value="'+d.co_maker.fname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Firstname</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control mname" name="mname" style="width:50%" value="'+d.co_maker.mname+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Date of Birth</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="date" class="form-control dob" name="dob" style="width:50%;margin-left:4px;" value="'+d.co_maker.dob+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Gender</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="gender" class="form-control gender" style="width:50%" required>'+
                                        '<option value="MALE"'+(d.co_maker.gender=="MALE" ? 'selected' : '')+'>Male</option>'+
                                        '<option value="FEMALE"'+(d.co_maker.gender=="FEMALE" ? 'selected' : '')+'>Female</option>'+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Contact Number</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control contact_no" name="contact_no" style="width:50%" value="'+d.co_maker.contact_no+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Company</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control company" name="company" style="width:50%" value="'+d.co_maker.company+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Position</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" class="form-control position" name="position" style="width:50%" value="'+d.co_maker.position+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Monthly Salary</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="number" class="form-control monthly_salary" name="monthly_salary" style="width:50%;margin-left:4px;" value="'+d.co_maker.monthly_salary+'" required>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>City</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="city_id" class="form-control city_id" style="width:50%" required>'+
                                        coMakercityHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Barangay</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="barangay_id" class="form-control barangay_id" style="width:50%">'+
                                        coMakerbarangayHTML+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Street</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="text" name="street" class="form-control street" style="width:50%" value="'+d.co_maker.co_maker_address.street+'">'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    
                                '</td>'+
                                '<td width="90%">'+
                                    '<br><button type="submit" class="btn btn-success">Save</button>'+
                                '</td>'+
                            '</tr>'+

                            
                            


                        '</table>'+
                    
                    '</form>'+
                '</div>'+
                '<div id="deposit" class="tab-pane">'+
                    '<form class="form-deposit">'+
                        '<table class="table table-bordered table-deposit">'+
                            '<thead>'+
                                '<tr>'+

                                    '<th width="20%">OR #</th>'+
                                    '<th  width="30%">Date</th>'+
                                    '<th  width="20%">PS</th>'+
                                    '<th width="20%">CBU</th>'+
                                    '<th width="10%"></th>'+
                                
                                '</tr>'+
                                
                                
                                    '<tr class="form-inputs">'+
                                        '<th><input type="text" name"orno" class="form-control orno" style="width:100%" required><span class="error-orno" style="display:none"></span></th>'+
                                        '<th><input type="date" name"payment_date" class="form-control payment_date" style="width:100%" required><span class="error-payment_date" style="display:none"></span></th>'+
                                        '<th><input type="number" name="ps" class="form-control ps" style="width:100%"><span class="error-ps" style="display:none"></span></th>'+
                                        '<th><input type="number" name="cbu" class="form-control cbu" style="width:100%"><span class="error-cbu" style="display:none"></span></th>'+
                                        '<th><button type="submit" class="btn btn-sm btn-success">Deposit</button></th>'+
                                    '</tr>'+
                                
                            '</thead>'+

                            '<tbody>'+
                                depositRows +
                            '</tbody>'+
                        '</table>'+
                    '</form>'+
                '</div>'+
                '<div id="withdraw" class="tab-pane">'+
                    '<form class="form-withdraw">'+
                        '<table class="table table-bordered table-withdraw">'+
                            '<thead>'+
                                '<tr>'+

                                    '<th>Reference #</th>'+
                                    '<th>Date</th>'+
                                    '<th>Amount</th>'+
                                    '<th>(PS/CBU)</th>'+
                                    '<th></th>'+
                                
                                '</tr>'+
                                '<tr class="form-inputs">'+

                                    '<th>--Generate by system--</th>'+
                                    '<th><input type="date" name"payment_date" class="form-control payment_date" style="width:100%" required><span class="error-payment_date" style="display:none"></span></th>'+
                                    '<th><input type="number" name="amount" class="form-control amount" style="width:100%"><span class="error-amount" style="display:none"></span></th>'+
                                    '<th><select class="form-control wallet_name" style="width:100%;"><option value="ps">PERSONAL SAVINGS</option value="cbu"><option>CAPITAL BUILD UP</option></select><span class="error-withdraw_date" style="display:none"></span></th>'+
                                    '<th><button type="submit" class="btn btn-sm btn-success">Withdraw</button></th>'+
                                
                                '</tr>'+
                            '</thead>'+

                            '<tbody>'+
                                withdrawRows+
                            '</tbody>'+
                        '</table>'+
                    '</form>'+
                '</div>'+
                '<div id="history" class="tab-pane">'+
                    '<table class="table table-bordered table-history">'+
                        '<thead>'+
                            '<tr>'+

                                '<th>Trasaction #</th>'+
                                '<th>Date</th>'+
                                '<th>Loan Amount</th>'+
                                '<th>Interest</th>'+
                                '<th></th>'+
                            
                            '</tr>'+
                        '</thead>'+

                        '<tbody>'+
                            history+
                        '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
            '</div>';


        
        return returnHTML;
    }

    var table_client = $('#table-client').DataTable({
        ajax: "{{url('clients-json')}}",
        rowId: "id",
        processing: true,
        columnDefs:[
            {width: '5%', targets: [0]},
            {width: '35%', targets: [1]},
            {width: '10%', targets: [3]},
        ],
        columns: [
            {data: null, render(data,type){
                @if(auth()->user()->can('clients.edit'))
                    return '<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>';
                @else
                    return '';
                @endif
            }},
            {data : null, render(data,type){
                var returnHTML = '';
                returnHTML+='<div class="profile-activity clearfix">'+
                    '<div>'+
                        "<img class='pull-left' src='{{asset('/ace-master')}}/images/avatars/avatar5.png'>"+
                        '<a class="user" href="#">' + data['lname']+', '+data['fname']+' '+data['mname'] + '</a> ('+data['position']+' : '+data['monthly_salary']+')'+
                        '<div class="time">'+
                            '<i class="ace-icon fa fa-phone bigger-110"></i> '+
                            data['contact_no']+
                        '</div>'+
                    '</div>'+                    
                '</div>';
                return returnHTML;
            }},
            {data: null,render(data,type){
                var returnHTML = '';
                if(data['address']!=null){
                    returnHTML= returnHTML + data['address']['street']+', '+data['address']['philippine_barangay']['barangay_description']+', '+data['address']['philippine_barangay']['philippine_city']['city_municipality_description']+', '+data['address']['philippine_barangay']['philippine_province']['province_description'];
                }
                returnHTML = returnHTML +'<br>  Area: '+data['area']['name'];
                return returnHTML;
            }},
            {data:null,render(data,type){
                var returnHTML = '';
                returnHTML += 'PS : '+data['personal_saving'];
                returnHTML += '<br>CBU : '+data['capital_build_up'];
                return returnHTML;
            }},
            {data: null,render(data,type){
                var actionButtons = '<div class="action-buttons">';
                
                @can('clients.destroy')
                    actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                @endcan
                actionButtons += '</div>';
                return actionButtons;
            }},
            
            
        ]
    });

    table_client.on('click','.delete',function(e){
        Swal.fire({
            title: 'Are you sure?',
            text: "Deleting client also deleting its all transaction(Loans,Savings,Withdraws)!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {    
            if (result.isConfirmed) {
                var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: data['id']};

                $.ajax({
                    url: "{{url('/clients')}}/"+data['id'],
                    type: "DELETE",
                    data: form_data,
                    success: function(result){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then((result)=>{
                            table_client.row($tr).remove().draw();
                        })
                    }
                });
                
            }
        })
        e.preventDefault();
    })
    $('#table-client tbody').off('click', '.show');

    $('#table-client tbody').on('click', '.show', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table_client.row( tr );
 
        if ( row.child.isShown() ) {
            
            tr.find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            $prevTr=$('#table-client tbody tr.child-row');
            $prevTr.prev('tr').find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
            table_client.row( $prevTr.prev('tr') ).child.hide()
            $prevTr.prev('tr').removeClass('shown');
            tr.find('td').eq(0).html('<a class="red show" href="#"><i class="ace-icon fa fa-minus bigger-130"></i></a>');
            row.child( format(row.data()),'child-row' ).show();
            tr.addClass('shown');
            tr.next('tr').find('.form-beneficiary').find('.relationship_id').val(row.data()['beneficiary']['relationship_id']);
            
        }
    } );

    table_client.on('submit','.form-profile',function(e){
        e.preventDefault();
        $this=$(this);
        $tr = $this.closest('tr').prev('tr.shown');
        
        var data = table_client.row($tr).data();
        
        if($(this).valid()){
            
            $.ajax({
                url: "{{url('/clients')}}/"+data['id'],
                type: "PUT",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}",
                    id: data['id'],
                    lname: $this.find('.lname').val(),
                    fname: $this.find('.fname').val(),
                    mname: $this.find('.mname').val(),
                    dob: $this.find('.dob').val(),
                    gender: $this.find('.gender').val(),
                    contact_no: $this.find('.contact_no').val(),
                    company: $this.find('.company').val(),
                    position: $this.find('.position').val(),
                    monthly_salary: $this.find('.monthly_salary').val(),
                    area_id: $this.find('.area_id').val(),
                    city_id: $this.find('.city_id').val(),
                    philippine_barangay_id: $this.find('.barangay_id').val(),
                    street: $this.find('.street').val(),
                },
                success: function(result){
                    Swal.fire(
                        'Success!',
                        'Profile has been updated',
                        'success'
                    )
                },
                error: function(xhr){

                }
            })
        }
    });

    table_client.on('submit','.form-beneficiary',function(e){
        e.preventDefault();
        $this=$(this);
        $tr = $this.closest('tr').prev('tr.shown');
        
        var data = table_client.row($tr).data();
        
        if($(this).valid()){
            
            $.ajax({
                url: "{{url('/clients/beneficiary/')}}/"+data['id'],
                type: "PUT",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}",
                    id: data['id'],
                    lname: $this.find('.lname').val(),
                    fname: $this.find('.fname').val(),
                    mname: $this.find('.mname').val(),
                    gender: $this.find('.gender').val(),
                    relationship_id: $this.find('.relationship_id').val()
                },
                success: function(result){
                    Swal.fire(
                        'Success!',
                        'Beneficiary has been updated',
                        'success'
                    )
                },
                error: function(xhr){

                }
            })
        }
    });

    table_client.on('submit','.form-co-maker',function(e){
        e.preventDefault();
        $this=$(this);
        $tr = $this.closest('tr').prev('tr.shown');
        
        var data = table_client.row($tr).data();
        
        if($(this).valid()){
            
            $.ajax({
                url: "{{url('/clients/co-maker')}}/"+data['id'],
                type: "PUT",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}",
                    co_maker_id: data['co_maker']['id'],
                    lname: $this.find('.lname').val(),
                    fname: $this.find('.fname').val(),
                    mname: $this.find('.mname').val(),
                    dob: $this.find('.dob').val(),
                    gender: $this.find('.gender').val(),
                    contact_no: $this.find('.contact_no').val(),
                    company: $this.find('.company').val(),
                    position: $this.find('.position').val(),
                    monthly_salary: $this.find('.monthly_salary').val(),
                    city_id: $this.find('.city_id').val(),
                    philippine_barangay_id: $this.find('.barangay_id').val(),
                    street: $this.find('.street').val(),
                },
                success: function(result){
                    Swal.fire(
                        'Success!',
                        'Co-Maker has been updated',
                        'success'
                    )
                },
                error: function(xhr){

                }
            })
        }
    });

    table_client.on('submit','.form-deposit',function(e){
        e.preventDefault();
        
        $this=$(this);
        $tr = $this.closest('tr').prev('tr.shown');
        
        var data = table_client.row($tr).data();
        
        if($(this).valid()){
            
            $.ajax({
                url: "{{route('payments.store')}}",
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}",
                    client_id: data['id'],
                    loan_id: null,
                    orno: $this.find('.orno').val(),
                    payment_date: $this.find('.payment_date').val(),
                    ps: $this.find('.ps').val(),
                    cbu: $this.find('.cbu').val()
                },
                success: function(result){
                    Swal.fire(
                        'Success!',
                        'Savings has been deposited',
                        'success'
                    ).then(function(){
                        var appendHTML = '';
                        appendHTML = '<tr data-id="'+result.id+'">'+
                                        '<td>'+result.payment.orno+'</td>'+
                                        '<td>'+result.payment.payment_date_formatted+'</td>'+
                                        '<td>'+$this.find('.ps').val()+'</td>'+
                                        '<td>'+$this.find('.cbu').val()+'</td>'+
                                        '<td><a class="blue edit-deposit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a class="red delete-deposit" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>'+
                                    '</tr>';
                        $this.find('table tbody').append(appendHTML);
                        var formInputs = '<th><input type="text" name"orno" class="form-control orno" style="width:100%" required><span class="error-orno" style="display:none"></span></th>'+
                                        '<th><input type="date" name"payment_date" class="form-control payment_date" style="width:100%" required><span class="error-payment_date" style="display:none"></span></th>'+
                                        '<th><input type="number" name="ps" class="form-control ps" style="width:100%"><span class="error-ps" style="display:none"></span></th>'+
                                        '<th><input type="number" name="cbu" class="form-control cbu" style="width:100%"><span class="error-cbu" style="display:none"></span></th>'+
                                        '<th><button type="submit" class="btn btn-sm btn-success">Deposit</button></th>';
                        $this.find('tr.form-inputs').html(formInputs);
                        $this.trigger('reset');
                    })
                    
                },
                error: function(xhr){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        $tr = $this.find('tr.form-inputs');
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('span.error-'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
        }
    });

    table_client.on('click','.delete-deposit',function(e){
        e.preventDefault();
        $this = $(this);

        $tr = $this.closest('tr.child-row').prev('tr.shown');
        var data = table_client.row($tr).data();
        Swal.fire({
            title: 'Are you sure?',
            text: "Cancel this deposit!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {    
            if (result.isConfirmed) {
                var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: $this.closest('tr')[0].dataset.id};

                $.ajax({
                    url: "{{url('/payments')}}/"+$this.closest('tr')[0].dataset.id,
                    type: "DELETE",
                    data: form_data,
                    success: function(result){
                        Swal.fire(
                            'Cancelled!',
                            'Deposit is already cancelled',
                            'success'
                        ).then((result)=>{
                            $this.closest('tr').remove();
                        })
                    }
                });
                
            }
        })
    })

    @can('payments.edit')
        table_client.on('click','.edit-deposit',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_client.row($parentTr).data();
            console.log(data);
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="number" class="form-control orno" value="'+data['deposit'][$index]['orno']+'" style="width:100%;" required><span class="orno" style="display:none"></div></div>');
            $tds.eq(1).html('<div class="form-group"><input type="date" class="form-control payment_date" value="'+data['deposit'][$index]['payment_date']+'" style="width:100%;" required><span class="orno" style="display:none"></div></div>');
            $tds.eq(2).html('<div class="form-group"><input type="number" class="form-control ps" value="'+data['deposit'][$index]['ps']['amount']+'" style="width:100%;" required><span class="ps" style="display:none"></div></div>');
            $tds.eq(3).html('<div class="form-group"><input type="number" class="form-control cbu" value="'+data['deposit'][$index]['cbu']['amount']+'" style="width:100%;" required><span class="cbu" style="display:none"></div></div>');

            $actionButtonTD.html('<div class="action-buttons"><a class="green submit-deposit" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel-deposit" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_client.on('click','.submit-deposit',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('payments.edit')
                actionButtons += '<a class="blue edit-deposit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('payments.destroy')
                actionButtons += '<a class="red delete-deposit" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_client.row($parentTr).data();
            $tds = $tr.find('td');         
            $orno = $tds.eq(0).find('input.orno').val();
            $payment_date = $tds.eq(1).find('input.payment_date').val();
            $ps = $tds.eq(2).find('input.ps').val();
            $cbu = $tds.eq(3).find('input.cbu').val();
            $.ajax({
                url: "{{url('/payments')}}/"+$this.closest('tr')[0].dataset.id,
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: $this.closest('tr')[0].dataset.id, orno: $orno,payment_date: $payment_date,ps : $ps, cbu : $cbu},
                success: function(result){
                    
                    data['deposit'][$index]['orno']=$orno;
                    data['deposit'][$index]['payment_date']=$payment_date;
                    data['deposit'][$index]['ps']['amount']=$ps;
                    data['deposit'][$index]['cbu']['amount']=$cbu;
                    $stringDate = $payment_date.split('-');
                    $tds.eq(0).html($orno);
                    $tds.eq(1).html($stringDate[1]+"/"+$stringDate[2]+"/"+$stringDate[0]);
                    $tds.eq(2).html($ps);
                    $tds.eq(3).html($cbu);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_client.on('click','.cancel-deposit',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');

            
            $actionButtonTD = $(this).closest('td');
            var data = table_client.row($parentTr).data();
            
            $tds = $tr.find('td');
            $tds.eq(0).html(data['deposit'][$index]['orno']);
            $tds.eq(1).html(data['deposit'][$index]['payment_date_formatted']);
            $tds.eq(2).html(data['deposit'][$index]['ps']['amount']);
            $tds.eq(3).html(data['deposit'][$index]['cbu']['amount']);
            var actionButtons = '<div class="action-buttons">';
            @can('terms.edit')
                actionButtons += '<a class="blue edit-deposit" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('terms.destroy')
                actionButtons += '<a class="red delete-deposit" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan

    table_client.on('submit','.form-withdraw',function(e){
        e.preventDefault();
        
        $this=$(this);
        $tr = $this.closest('tr').prev('tr.shown');
        
        var data = table_client.row($tr).data();
        
        if($(this).valid()){
            
            $.ajax({
                url: "{{route('withdraws.store')}}",
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}",
                    client_id: data['id'],
                    amount: $this.find('.amount').val(),
                    withdraw: $this.find('.withdraw_date').val(),
                    wallet_name: $this.find('.wallet_name').val()
                },
                success: function(result){
                    Swal.fire(
                        'Success!',
                        'Savings has been withdraw',
                        'success'
                    ).then(function(){
                        var appendHTML = '';
                        appendHTML = '<tr data-id="'+result.id+'">'+
                                        '<td>'+result.withdraw.reference_no+'</td>'+
                                        '<td>'+result.withdraw.withdraw_date_formatted+'</td>'+
                                        '<td>'+$this.find('.amount').val()+'</td>'+
                                        '<td>'+$this.find('.wallet_name')[0].selectedOptions[0].outerText+'</td>'+
                                        '<td><a class="blue edit-withdraw" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a class="red delete-withdraw" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>'+
                                    '</tr>';
                        $this.find('table tbody').append(appendHTML);
                        var formInputs = '<th>--Generate by system--</th>'+
                                        '<th><input type="date" name"payment_date" class="form-control payment_date" style="width:100%" required><span class="error-payment_date" style="display:none"></span></th>'+
                                        '<th><input type="number" name="amount" class="form-control amount" style="width:100%"><span class="error-amount" style="display:none"></span></th>'+
                                        '<th><select class="form-control wallet_name" style="width:100%;"><option value="ps">PERSONAL SAVINGS</option value="cbu"><option>CAPITAL BUILD UP</option></select><span class="error-withdraw_date" style="display:none"></span></th>'+
                                        '<th><button type="submit" class="btn btn-sm btn-success">Withdraw</button></th>';
                        $this.find('tr.form-inputs').html(formInputs);
                        $this.trigger('reset');
                    })
                    
                },
                error: function(xhr){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        $tr = $this.find('tr.form-inputs');
                        
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('span.error-'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
        }
    });

    @can('withdraws.edit')
        table_client.on('click','.edit-withdraw',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_client.row($parentTr).data();
            console.log(data);
            $tds = $tr.find('td');
            $tds.eq(0).html('<div class="form-group"><input type="number" class="form-control reference_no" value="'+data['withdraw'][$index]['reference_no']+'" style="width:100%;" disabled><span class="reference_no" style="display:none"></div></div>');
            $tds.eq(1).html('<div class="form-group"><input type="date" class="form-control withdraw_date" value="'+data['withdraw'][$index]['withdraw_date']+'" style="width:100%;" required><span class="withdraw_date" style="display:none"></div></div>');
            $tds.eq(2).html('<div class="form-group"><input type="number" class="form-control amount" value="'+data['withdraw'][$index]['amount']+'" style="width:100%;" required><span class="amount" style="display:none"></div></div>');
            $tds.eq(3).html('<div class="form-group"><select class="form-control wallet_name" style="width:100%;" required><option value="ps" '+(data['withdraw'][$index]['transaction']['wallet']['slug']=='ps' ? 'selected' : '')+'>PERSONAL SAVINGS</option><option value="cbu" '+(data['withdraw'][$index]['transaction']['wallet']['slug']=='cbu' ? 'selected' : '')+'>CAPITAL BUILD UP</option></select><span class="wallet_name" style="display:none"></div></div>');

            $actionButtonTD.html('<div class="action-buttons"><a class="green submit-withdraw" href="#"><i class="ace-icon fa fa-check bigger-130"></i></a><a class="red cancel-withdraw" href="#"><i class="ace-icon fa fa-times bigger-130"></i></a></div>');
        })

        table_client.on('click','.submit-withdraw',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            
            var actionButtons = '<div class="action-buttons">';
            @can('withdraws.edit')
                actionButtons += '<a class="blue edit-withdraw" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('withdraws.destroy')
                actionButtons += '<a class="red delete-withdraw" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            var data = table_client.row($parentTr).data();
            $tds = $tr.find('td');         
            
            $withdraw_date = $tds.eq(1).find('input.withdraw_date').val();

            $amount = $tds.eq(2).find('input.amount').val();
            $wallet_name = $tds.eq(3).find('select.wallet_name').val();
            $.ajax({
                url: "{{url('/withdraws')}}/"+$this.closest('tr')[0].dataset.id,
                type: "PUT",
                data: {_token : "{{csrf_token()}}", id: $this.closest('tr')[0].dataset.id,withdraw_date: $withdraw_date , amount : $amount, wallet_name : $wallet_name},
                success: function(result){
                    
                    
                    data['withdraw'][$index]['withdraw_date']=$withdraw_date;
                    data['withdraw'][$index]['amount']=$amount;
                    data['withdraw'][$index]['transaction']['amount']='-'+$amount;
                    data['withdraw'][$index]['transaction']['wallet']['name']=$tr.find('.wallet_name')[0].selectedOptions[0].outerText;
                    data['withdraw'][$index]['transaction']['wallet']['slug']=$tr.find('.wallet_name').val();
                    $stringDate = $withdraw_date.split('-');
                    $tds.eq(0).html(data['withdraw'][$index]['reference_no']);
                    $tds.eq(1).html($stringDate[1]+"/"+$stringDate[2]+"/"+$stringDate[0]);
                    $tds.eq(2).html($amount);
                    $tds.eq(3).html($tr.find('.wallet_name')[0].selectedOptions[0].outerText);
                    $actionButtonTD.html(actionButtons);
                },
                error: function(xhr,status){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            $span = $tr.find('.'+key);
                            $span.attr('style','color:red');
                            $span.html(value);
                        });
                    }
                }
            })
            
            
        });

        table_client.on('click','.cancel-withdraw',function(e){
            $this = $(this);
            $index = $this.closest('tr')[0].dataset.index;
            $parentTr = $this.closest('tr.child-row').prev('tr.shown');
            $tr = $(this).closest('tr');
            $actionButtonTD = $(this).closest('td');
            var data = table_client.row($parentTr).data();
            $tds = $tr.find('td');
            $tds.eq(0).html(data['withdraw'][$index]['reference_no']);
            $tds.eq(1).html(data['withdraw'][$index]['withdraw_date_formatted']);
            $tds.eq(2).html(data['withdraw'][$index]['amount']);
            $tds.eq(3).html(data['withdraw'][$index]['transaction']['wallet']['name']);
            var actionButtons = '<div class="action-buttons">';
            @can('withdraws.edit')
                actionButtons += '<a class="blue edit-withdraw" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            @endcan
            @can('withdraws.destroy')
                actionButtons += '<a class="red delete-withdraw" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            @endcan
            actionButtons += '</div>';
            $actionButtonTD.html(actionButtons);
        })

    @endcan

    table_client.on('click','.delete-withdraw',function(e){
        e.preventDefault();
        $this = $(this);

        $tr = $this.closest('tr.child-row').prev('tr.shown');
        var data = table_client.row($tr).data();
        Swal.fire({
            title: 'Are you sure?',
            text: "Cancel this withdrawal!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {    
            if (result.isConfirmed) {
                var form_data = { _token : "{{csrf_token()}}", _method: "_delete" , id: $this.closest('tr')[0].dataset.id};

                $.ajax({
                    url: "{{url('/withdraws')}}/"+$this.closest('tr')[0].dataset.id,
                    type: "DELETE",
                    data: form_data,
                    success: function(result){
                        Swal.fire(
                            'Cancelled!',
                            'Withdraw is already cancelled',
                            'success'
                        ).then((result)=>{
                            $this.closest('tr').remove();
                        })
                    }
                });
                
            }
        })
    })
    
    

});
</script>
@endsection