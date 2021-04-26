@extends('layouts.ace_master')

@section('style')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
.step-pane{
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
    <li class="active">Active Loans</li>
</ul>
@endsection

@section('content')



<div class="row">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">
                List
            </h4>
            <span class="widget-toolbar">
                <a href="#" id="open-wizard">
                    <i class="ace-icon fa fa-plus"></i> Apply loan
                </a>
            </span>
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
                    <th>Applied Loan(s)</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
                
            </div>
        </div>
    </div>
</div>

<div id="modal-for-release" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Tag as for release</h3>
            </div>

            <div class="modal-body">
                <form id="form-for-release">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="">Transaction code</label>
                        <input type="text" disabled class="form-control" name="transactioncode">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Loan Amount</label>
                        <input type="number" class="form-control" name="loan_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">Net Amount</label>
                        <input type="number" class="form-control" name="net" readonly required>
                    </div>
                    <label>Please select charge(s) to be deduct</label>
                    <table id="table-charge" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Charge name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <label>Please select previous loan(s) to be deduct</label>
                    <table id="table-loan" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Category</th>
                                <th>Term</th>
                                <th>Payment Mode</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success pull-right button-release">
                    <i class="ace-icon fa fa-tag"></i>
                    Tag
                </button>
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    

</div>

<div id="modal-edit" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Edit loan</h3>
            </div>

            <div class="modal-body">
                <form id="form-edit">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="">Transaction code</label>
                        <input type="text" disabled class="form-control" name="transactioncode">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Payment mode</label>
                        <select name="payment_mode_id" class="form-control">
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Term</label>
                        <select name="term_id" class="form-control">
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Loan Amount</label>
                        <input type="number" class="form-control" name="loan_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">Interest</label>
                        <input type="number" class="form-control" name="interest" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success pull-right button-submit">
                    <i class="ace-icon fa fa-file"></i>
                    Save
                </button>
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@include('loans.create')
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
<script src="{{asset('/ace-master')}}/js/wizard.min.js"></script>
<script src="{{asset('/js/sweetalert2.js')}}"></script>
<script src="{{asset('/js/references.js')}}"></script>
<script src="{{asset('/ace-master')}}/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){    
    
    $('#is_existing_client').on('change',function(e){
        $modal = $(this).closest('.modal');
        if($(this).is(':checked')){
            $modal.find('.modal-body').removeClass('.step-content');
            $modal.find('.modal-body').find('.step-pane').attr('style','display:none');
            $modal.find('.modal-body').find('.existing-client').removeAttr('style');
            $modal.find('ul.steps').attr('style','display:none');
            $modal.find('.modal-title').removeAttr('style');
            $modal.find('.wizard-actions').attr('style','display:none');
            searchTable();
        }else{
            $modal.find('.modal-body').addClass('.step-content');
            $modal.find('.modal-body').find('.step-pane').removeAttr('style');
            $modal.find('.modal-body').find('.existing-client').attr('style','display:none');
            $modal.find('ul.steps').removeAttr('style');
            $modal.find('.modal-title').attr('style','display:none');
            $modal.find('.wizard-actions').removeAttr('style');
            $('#table-search').DataTable().destroy();
        }
    });
    
    $('#modal-wizard').find('.button-search').click(function(){
        $('#table-search').DataTable().destroy();
        searchTable();
    });

    $('form#form-step-4 select[name="payment_mode_id"]').on('change',function(){
        $('form#form-step-4 select[name="term_id"]').html('');
        var daily_only = $(this).val()==1 ? 1: 0;
        $.ajax({
            url: "{{url('terms-json')}}",
            type: "GET",
            dataType: 'JSON',
            data: {
                daily_only : daily_only,
                filter : 1
            },
            success: function(result){
                $data = result.data;
                $('form#form-step-4 select[name="term_id"]').html('');
                $.each($data, function() {
                    $('form#form-step-4 select[name="term_id"]').append($("<option />").val(this['id']).text(this['name']));
                });
                
            }
        })
    });

    $('#open-wizard').click(function(){
        $('#modal-wizard').modal('show');
        populate_dropdown("{{url('areas-json')}}",'form#form-step-1 select[name="area_id"]','id','name');
        populate_dropdown("{{url('address-json')}}",'form#form-step-1 select.cities','city_municipality_code','city_municipality_description');
        populate_dropdown("{{url('address-json')}}",'form#form-step-2 select.cities','city_municipality_code','city_municipality_description');
        populate_dropdown("{{url('relationships-json')}}",'form#form-step-3 select[name="relationship_id"]','id','name');
        populate_dropdown("{{url('categories-json')}}",'form#form-step-4 select[name="category_id"]','id','name');
        populate_dropdown("{{url('payment-modes-json')}}",'form#form-step-4 select[name="payment_mode_id"]','id','name');
        
    });

    $('#modal-wizard select.cities').on('change',function(e){
        e.preventDefault();
        $this = $(this);
        $form = $this.closest('form');
        $barangay = $form.find('select.barangay');
        $barangay.html('');
        populate_dropdown("{{url('barangay-json')}}/"+$this.val(),'form#'+$form[0].id+' select.barangay','id','barangay_description');
    })
    

    $('#modal-wizard-container')
    .ace_wizard()
    .on('actionclicked.fu.wizard' , function(e, info){
        if(info.step == 1) {
            if(!$('#form-step-1').valid()) e.preventDefault();
        }
        if(info.step == 2) {
            if(!$('#form-step-2').valid()) e.preventDefault();
        }
        if(info.step == 3) {
            if(!$('#form-step-3').valid()) e.preventDefault();
        }
        if(info.step == 4) {
            if(!$('#form-step-4').valid()) e.preventDefault();
        }
    })
    .on('finished.fu.wizard', function(e) {
        var client = {
            lname : $('#form-step-1 input[name="lname"]').val(),
            fname : $('#form-step-1 input[name="fname"]').val(),
            mname : $('#form-step-1 input[name="mname"]').val(),
            dob : $('#form-step-1 input[name="dob"]').val(),
            gender : $('#form-step-1 select[name="gender"]').val(),
            contact_no : $('#form-step-1 input[name="contact_no"]').val(),
            company : $('#form-step-1 input[name="company"]').val(),
            position : $('#form-step-1 input[name="position"]').val(),
            monthly_salary : $('#form-step-1 input[name="monthly_salary"]').val(),
            city_id : $('#form-step-1 select[name="city_id"]').val(),
            barangay_id : $('#form-step-1 select[name="barangay_id"]').val(),
            street : $('#form-step-1 input[name="street"]').val(),
            area_id : $('#form-step-1 select[name="area_id"]').val()
        };

        var co_maker = {
            lname : $('#form-step-2 input[name="lname"]').val(),
            fname : $('#form-step-2 input[name="fname"]').val(),
            mname : $('#form-step-2 input[name="mname"]').val(),
            dob : $('#form-step-2 input[name="dob"]').val(),
            gender : $('#form-step-2 select[name="gender"]').val(),
            contact_no : $('#form-step-2 input[name="contact_no"]').val(),
            company : $('#form-step-2 input[name="company"]').val(),
            position : $('#form-step-2 input[name="position"]').val(),
            monthly_salary : $('#form-step-2 input[name="monthly_salary"]').val(),
            city_id : $('#form-step-2 select[name="city_id"]').val(),
            barangay_id : $('#form-step-2 select[name="barangay_id"]').val(),
            street : $('#form-step-2 input[name="street"]').val(),
        };

        var beneficiary = {
            lname : $('#form-step-3 input[name="lname"]').val(),
            fname : $('#form-step-3 input[name="fname"]').val(),
            mname : $('#form-step-3 input[name="mname"]').val(),
            gender : $('#form-step-3 select[name="gender"]').val(),
            relationship_id : $('#form-step-3 select[name="relationship_id"]').val()
        };

        var loan = {
            category_id : $('#form-step-4 select[name="category_id"]').val(),
            term_id : $('#form-step-4 select[name="term_id"]').val(),
            payment_mode_id : $('#form-step-4 select[name="payment_mode_id"]').val(),
            loan_amount : $('#form-step-4 input[name="loan_amount"]').val(),
            interest : $('#form-step-4 input[name="interest"]').val()
        };

        
        
        $.ajax({
            url: "{{route('clients.store')}}",
            type: "POST",
            data: {_token : "{{csrf_token()}}", client : client, co_maker: co_maker, beneficiary: beneficiary, loan: loan},
            dataType: 'JSON',
            success: function(result){
                swal("Record has been saved", {
                    icon: 'success',
                    title: 'Success!'
                    }).then(function(){
                        // window.location.reload(true);
                        // $('#form-step-1').trigger('reset');
                        // $('#form-step-2').trigger('reset');
                        // $('#form-step-3').trigger('reset');
                        // $('#form-step-4').trigger('reset');
                        // $('ul.steps li').removeClass("active").removeClass("complete");
                        // $('ul.steps>li').eq(0).addClass("active");
                        // $('div.step-content .step-pane').find('.active').removeClass('active');
                        // $('div.step-content>,step-pane').eq(0).addClass('active');
                    });
            },
            error: function(xhr,status){
                if(status==422){
                    swal("Please check your inputs", {
                    icon: 'error',
                    title: 'Ooops!'
                    });
                }
            }
        });
    });
    $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');

    $('#form-step-1').validate({
        rules: {
            lname: {
                required: true,
            },
            fname: {
                required: true,
            },
            mname: {
                required: true,
            },
            dob: {
                required: true,
                date: true
            },
            gender: {
                required: true
            },
            contact_no: {
                required: true
            },
            company: {
                required: true
            },
            position: {
                required: true
            },
            monthly_salary: {
                required: true,
                number: true
            },
            city: {
                required: true
            },
            barangay: {
                required: true
            },
            area_id : {
                required: true
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
        submitHandler(form){
        }
    });

    $('#form-step-2').validate({
        rules: {
            lname: {
                required: true,
            },
            fname: {
                required: true,
            },
            mname: {
                required: true,
            },
            gender: {
                required: true
            },
            contact_no: {
                required: true
            },
            company: {
                required: true
            },
            position: {
                required: true
            },
            monthly_salary: {
                required: true,
                number: true
            },
            city: {
                required: true
            },
            barangay: {
                required: true
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        }
    });

    $('#form-step-3').validate({
        rules: {
            lname: {
                required: true,
            },
            fname: {
                required: true,
            },
            mname: {
                required: true,
            },
            gender: {
                required: true
            },
            relationship_id: {
                required: true
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        }
    });

    $('#form-step-4').validate({
        rules: {
            category_id: {
                required: true,
            },
            term_id: {
                required: true,
            },
            payment_mode_id: {
                required: true,
            },
            loan_amount: {
                required: true,
                min: 1,
                number: true
            },
            interest: {
                required: true,
                min: 1,
                number: true
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        }
    });

    function searchTable(){
        
        var table_search = $('#table-search').DataTable({
            ajax: {
                url : "{{url('clients-json')}}",
                type: "GET",
                data: {
                    loading_type : 'search',
                    search_text : $('#modal-wizard').find('input[name="search_text"]').val()
                }
            },
            rowId: "id",
            processing: true,
            paging: false,
            bInfo: false,
            bFilter: false,
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
                {data: 'loan_balance'},
                
                
            ]
        });
        table_search.off('submit','.form-renewal');

        table_search.on('submit','.form-renewal',function(e){
            e.preventDefault();
            $form = $(this);
            var data = table_search.row($form.closest('tr').prev('tr')).data();
            
            $.ajax({
                url: "{{route('loans.store')}}",
                type: "POST",
                data: {_token : "{{csrf_token()}}", client_id: data['id'],category_id : $form.find('select[name="category_id"]').val(), payment_mode_id: $form.find('select[name="payment_mode_id"]').val(), term_id: $form.find('select[name="term_id"]').val(), loan_amount: $form.find('input[name="loan_amount"]').val(),interest: $form.find('input[name="interest"]').val()},
                dataType: 'JSON',
                success: function(result){
                    // swal("Record has been saved", {
                    //     icon: 'success',
                    //     title: 'Success!'
                    //     }).then(function(){
                    //         // window.location.reload(true);
                    //         // $('#form-step-1').trigger('reset');
                    //         // $('#form-step-2').trigger('reset');
                    //         // $('#form-step-3').trigger('reset');
                    //         // $('#form-step-4').trigger('reset');
                    //         // $('ul.steps li').removeClass("active").removeClass("complete");
                    //         // $('ul.steps>li').eq(0).addClass("active");
                    //         // $('div.step-content .step-pane').find('.active').removeClass('active');
                    //         // $('div.step-content>,step-pane').eq(0).addClass('active');
                    //     });
                },
                error: function(xhr,status){
                    if(status==422){
                        swal("Please check your inputs", {
                        icon: 'error',
                        title: 'Ooops!'
                        });
                    }
                }
            });
        })

        $('#table-search tbody').off('click', '.show');
    
        $('#table-search tbody').on('click', '.show', function (e) {
            e.preventDefault();
            var tr = $(this).closest('tr');
            var row = table_search.row( tr );
    
            if ( row.child.isShown() ) {
                
                tr.find('td').eq(0).html('<a class="green show" href="#"><i class="ace-icon fa fa-plus bigger-130"></i></a>')
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                tr.find('td').eq(0).html('<a class="red show" href="#"><i class="ace-icon fa fa-minus bigger-130"></i></a>');
                row.child( formatLoanForm(row.data()),'child-row' ).show();
                tr.addClass('shown');
                // POPULATE DATA IN DROPOWN
                populate_dropdown_subTable("{{url('categories-json')}}",tr.next('tr').find('select[name="category_id"]'),'id','name');
                populate_dropdown_subTable("{{url('payment-modes-json')}}",tr.next('tr').find('select[name="payment_mode_id"]'),'id','name');

                tr.next('tr').find('select[name="payment_mode_id"]').off('change');
                tr.next('tr').find('select[name="payment_mode_id"]').on('change',function(e){
                    e.preventDefault();
                    var daily_only = $(this).val()==1 ? 1: 0;
                    $.ajax({
                        url: "{{url('terms-json')}}",
                        type: "GET",
                        dataType: 'JSON',
                        data: {
                            daily_only : daily_only,
                            filter : 1
                        },
                        success: function(result){
                            $data = result.data;
                            tr.next('tr').find('select[name="term_id"]').html('');
                            $.each($data, function() {
                                tr.next('tr').find('select[name="term_id"]').append($("<option />").val(this['id']).text(this['name']));
                            });
                            
                        }
                    })
                })
                // console.log(tr.next('tr').find('select[name="category_id"]'));
                // console.log(tr.next('tr').find('select[name="payment_mode_id"]'));
                // console.log(tr.next('tr').find('select[name="term_id"]'));
                // POPULATE DATA IN DROPOWN
                
            }
        } );
    }

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

    function formatLoanForm(d){
        // var returnHTML = '';
        
        // returnHTML += '<div class="form-group">';
        // returnHTML += '<label>Category</label>';
        // returnHTML += '<select name="category_id" class="form-control">';
        // returnHTML += '<option value="none" selected disabled>Please select one</option>';
        // returnHTML += '</select>';
        // returnHTML += '</div>';
        
        // returnHTML += '<div class="form-group">';
        // returnHTML += '<label>Payment Mode</label>';
        // returnHTML += '<select name="payment_mode_id" class="form-control">';
        // returnHTML += '<option value="none" selected disabled>Please select one</option>';
        // returnHTML += '</select>';
        // returnHTML += '</div>';

        // returnHTML += '<div class="form-group">';
        // returnHTML += '<label>Term</label>';
        // returnHTML += '<select name="term_id" class="form-control">';
        // returnHTML += '<option value="none" selected disabled>Please select one</option>';
        // returnHTML += '</select>';
        // returnHTML += '</div>';
        

        // returnHTML += '<div class="form-group">';
        // returnHTML += '<label>Loan Amount</label>';
        // returnHTML += '<input type="number" min="1" name="loan_amount" class="form-control">';
        // returnHTML += '</div>';

        // returnHTML += '<div class="form-group">';
        // returnHTML += '<label>Interest</label>';
        // returnHTML += '<input type="number" min="1" max="100" name="interest" class="form-control">';
        // returnHTML += '</div>';
        
        // return returnHTML;

        returnHTML='<div class="tabbable">'+
            '<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">'+
                '<li class="active">'+
                    '<a data-toggle="tab" href="#renewal">Loan Renewal</a>'+
                '</li>'+
            '</ul>'+

            '<div class="tab-content">'+
                '<div id="renewal" class="tab-pane in active">'+
                    '<form class="form-renewal">'+
                        '<table width="100%">'+
                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Category</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="category_id" class="form-control" style="width:50%">'+
                                    '<option value="none" selected disabled>Please select one</option>'+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Payment Mode</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="payment_mode_id" class="form-control"  style="width:50%">'+
                                    '<option value="none" selected disabled>Please select one</option>'+
                                    '</select>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Term</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<select name="term_id" class="form-control" style="width:50%">'+
                                    '<option value="none" selected disabled>Please select one</option>'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Loan amount</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="number" min="1" name="loan_amount" class="form-control" style="margin-left:5px;width:50%">'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    '<label>Interest</label>'+
                                '</td>'+
                                '<td width="90%">'+
                                    '<input type="number" min="1" max="100" name="interest" class="form-control" style="margin-left:5px;width:50%">'+
                                '</td>'+
                            '</tr>'+

                            '<tr>'+
                                '<td width="10%">'+
                                    
                                '</td>'+
                                '<td width="90%">'+
                                    '<button type="submit" class="btn btn-success btn-sm" style="margin-left:5px;">Submit</button>'+
                                '</td>'+
                            '</tr>'+

                        '</table>'+
                    
                    '</form>'+
                '</div>'+
                
            '</div>'+
            '</div>';


        
        return returnHTML;
    }

    function format(d){
        var returnHTML = '';
        var depositRows = '';
        var withdrawRows = '';
        var history = '';
        var cityHTML = '';
        var barangayHTML = '';
        var coMakercityHTML = '';
        var coMakerbarangayHTML = '';
        var active_loans = '';
        var loan_details = '';
        var payment_schedules = '';
        var settled = '';
        
        $.each(d.active_loan,function(i){
            loan_details+='<div class="profile-user-info" data-index="'+i+'">'+
                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Transaction # </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.transaction_code+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Category </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.category.name+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Payment Mode </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.payment_mode.name+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Terms </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.term.no_of_months+'</span>'+
                    '</div>'+
                '</div>'+

                

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Application Date </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.date_loan_formatted+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Date Release </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.date_release_formatted+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> First Payment </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.first_payment_formatted+'</span>'+
                    '</div>'+
                '</div>'+

                '<div class="profile-info-row">'+
                    '<div class="profile-info-name"> Maturity Date </div>'+

                    '<div class="profile-info-value">'+
                        '<span>'+this.maturity_date_formatted+'</span>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<button class="btn btn-success btn-xs pull-right">'+
                '<i class="ace-icon fa fa-print bigger-160"></i>'+
                ' Statement of Account'+
            '</button>'+
            '<button class="btn btn-primary btn-xs pull-right">'+
                '<i class="ace-icon fa fa-file bigger-160"></i>'+
                ' Voucher'+
            '</button>';
            payment_schedules = '<table width="100%" class="table table-bordered" id="schedule-'+i+'"><thead><tr><th>Date</th><th>Progress</th></tr></thead><tbody>';

            $.each(this.schedule,function(j){
                payment_schedules+='<tr>';
                payment_schedules+='<td>'+this.schedule_date_formatted+'</th>';
                payment_schedules+='<td>'+this.progress+'</th>';
                payment_schedules+='</tr>';
            });
            payment_schedules += '</tbody></table>';

            

            settled+='<form class="form-payment '+i+'">'+
                '<table class="table table-bordered table-payment">'+
                    '<thead>'+
                        '<tr>'+

                            '<th width="20%">OR #</th>'+
                            '<th  width="30%">Date</th>'+
                            '<th  width="20%">Amount</th>'+
                            '<th  width="10%">PS</th>'+
                            '<th width="10%">CBU</th>'+
                            '<th width="10%"></th>'+
                        
                        '</tr>'+
                        
                        
                            '<tr class="form-inputs">'+
                                '<th><input type="text" name"orno" class="form-control orno" style="width:100%" required><span class="error-orno" style="display:none"></span></th>'+
                                '<th><input type="date" name"payment_date" class="form-control payment_date" style="width:100%" required><span class="error-payment_date" style="display:none"></span></th>'+
                                '<th><input type="number" name="amount" class="form-control amount" style="width:100%"><span class="error-amount" style="display:none"></span></th>'+
                                '<th><input type="number" name="ps" class="form-control ps" style="width:100%"><span class="error-ps" style="display:none"></span></th>'+
                                '<th><input type="number" name="cbu" class="form-control cbu" style="width:100%"><span class="error-cbu" style="display:none"></span></th>'+
                                '<th><button type="submit" class="btn btn-sm btn-success">Post</button></th>'+
                            '</tr>'+
                        
                    '</thead>'+

                    '<tbody>';
                    $.each(this.payment,function(k){
                        settled+='<tr data-id="'+this.id+'" data-index="'+k+'"><td>'+this.orno+'</td><td>'+this.payment_date_formatted+'</td><td>'+this.amount_formatted+'</td><td>'+(this.ps!=null ? this.ps.amount : 0)+'</td><td>'+(this.cbu!=null ? this.cbu.amount : 0)+'</td><td><a class="blue edit-payment" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a class="red delete-payment" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td></tr>';
                    });
            settled+='</tbody>'+
                '</table>'+
            '</form>';
            
        });
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
        // d.co_maker.co_maker_address.philippine_barangay.philippine_city.philippine_barangay
        $.each(d.address.philippine_barangay.philippine_city.philippine_barangay,function(){
            barangayHTML += '<option value="'+this.id+'" '+(d.address.philippine_barangay_id==this.id ? 'selected' : '')+'>'+this.barangay_description+'</option>';
        });

        $.each(d.co_maker.co_maker_address.philippine_barangay.philippine_province.philippine_city,function(){
            coMakercityHTML += '<option value="'+this.city_municipality_code+'" '+(d.co_maker.co_maker_address.philippine_barangay.city_municipality_code==this.city_municipality_code ? 'selected' : '')+'>'+this.city_municipality_description+'</option>';
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
                '<div id="profile" class="tab-pane  in active">'+
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
        ajax: "{{url('loans-json')}}",
        rowId: "id",
        processing: true,
        columnDefs:[
            {width: '5%', targets: [0]},
            {width: '35%', targets: [1]},
            
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
                            data['contact_no']+'<br><br>'+
                            '<b>Address : </b>'+data['address']['street']+', '+data['address']['philippine_barangay']['barangay_description']+', '+data['address']['philippine_barangay']['philippine_city']['city_municipality_description']+', '+data['address']['philippine_barangay']['philippine_province']['province_description']+
                            '<br>  <b>Area : </b>'+data['area']['name']+
                            '  <b>PS</b> : '+data['personal_saving']+
                            '  <b>CBU</b> : '+data['capital_build_up']+
                        '</div>'+
                    '</div>'+                    
                '</div>';
                
                
                return returnHTML;
            }},
            {data: null,render(data,type){
                var returnHTML = '';
                returnHTML = '<table class="table table-bordered">'+
                    '<thead>'+
                        '<tr>'+
                            '<th>#</th>'+
                            '<th>Date</th>'+
                            '<th>Category</th>'+
                            '<th>Payment Mode</th>'+
                            '<th>Terms</th>'+
                            '<th>Loan Amount</th>'+
                        '</tr>'+
                    '</thead>';
                returnHTML+='<tbody>';
                $.each(data['loan'],function(i){
                    var actionButtons = '';
                    var date_release_content = this.status.name=="APPROVED" ? this.date_release_formatted+(this.term.daily_only==1 ? '  <a href="#" class="blue for-release-loan" title="Tag"><i class="ace-icon fa fa-tag bigger-130"></i> Tag as for release</a>' : '') : this.date_release_formatted;
                    var first_payment_content = this.status.name=="APPROVED" && this.term.daily_only!=1 ? this.first_payment_formatted+' <a href="#" class="blue for-release-loan" title="Tag"><i class="ace-icon fa fa-tag bigger-130"></i> Tag as for release</a>' : this.first_payment_formatted;
                    
                    if(this.status.name=='FOR RELEASE'){
                        var date_release_content = this.status.name=="FOR RELEASE" ? '<input type="date" class="form-control" name="date_release">'+(this.term.daily_only==1 ? '  <a href="#" class="blue release-loan" title="Release"><i class="ace-icon fa fa-tag bigger-130"></i> Release</a>' : '') : this.date_release_formatted;
                        var first_payment_content = this.status.name=="FOR RELEASE" && this.term.daily_only!=1 ? '<input type="date" class="form-control" name="first_payment">'+' <a href="#" class="blue release-loan" title="Release"><i class="ace-icon fa fa-tag bigger-130"></i> Release</a>' : this.first_payment_formatted;
                    }

                    if(this.payment.length==0 && this.status.name!="DENIED" && this.status.name!="CLOSED"){ 

                        actionButtons+='<a class="red button-actions delete-loan" href="#"  data-question="Delete this loan" data-action="delete" title="Delete"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                        if([1,2,3,5].includes(this.status_id)){
                            actionButtons+='<a class="blue edit-loan"  data-question="Edit this loan" title="Edit"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                        }
                        
                    }
                    if(this.status.name=="FOR APPROVAL"){
                        actionButtons+=' <a class="green button-actions approve" data-question="Approve this loan" data-action="approve" href="#" title="Approve"><i class="ace-icon fa fa-thumbs-up bigger-130"></i></a>';
                        actionButtons+=' <a class="orange button-actions deny"  data-question="Deny this loan" data-action="deny" href="#" title="Deny"><i class="ace-icon fa fa-thumbs-down bigger-130"></i></a>';
                    }

                    if(this.status.name=="RELEASED"){
                        if(this.payment_mode_id!=1){
                            actionButtons+=' <a class="blue" href="'+"{{url('/loans/voucher')}}/"+this.id+'" href="#" title="Voucher"><i class="ace-icon fa fa-file bigger-130"></i></a>';
                        }
                        actionButtons+=' <a class="green" href="'+"{{url('/loans/soa')}}/"+this.id+'" title="SOA"><i class="ace-icon fa fa-list bigger-130"></i></a>';
                    }

                    returnHTML+='<tr data-index="'+i+'" id="'+this.id+'">'+
                        '<td>'+
                            '<b>'+this.transaction_code+'</b><br>'+
                            (this.status.name=="RELEASED" ? '<b>Maturity Date : </b>'+this.maturity_date_formatted+'<br>' : '')+
                            '<b>Status : </b><span class="status-name">'+this.status.name+'</span>'+
                            '<br><b><div class="action-buttons">Action(s) : </b>'+actionButtons+'</div>'+
                            '<br><div class="question-content" style="display:none"><span class="question">Are you sure?</span>   <a class="green proceed-approval" href="#" title="Proceed"><i class="ace-icon fa fa-check bigger-130"></i></a>  <a class="red cancel-approval" href="#" title="Cancel"><i class="ace-icon fa fa-times bigger-130"></i></a></div>'+
                        '</td>'+
                        '<td>'+
                            
                            '<table>'+
                                '<tr>'+
                                    '<td>Applied date : </td>'+
                                    '<td>'+this.date_loan_formatted+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>Date release : </td>'+
                                    '<td>'+date_release_content+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>First payment : </td>'+
                                    '<td>'+first_payment_content+'</td>'+
                                '</tr>'
                            +'</table>'+
                            
                        '</td>'+
                        '<td>'+this.category.name+'</td>'+
                        '<td>'+this.payment_mode.name+'</td>'+
                        '<td>'+this.term.name+'</td>'+
                        '<td>'+this.loan_amount_formatted+'</td>'+
                        '</tr>';
                })
                returnHTML+='</tbody>';
                returnHTML+='</table>';
                return returnHTML;
            }}
            // ,
            // {data:null,render(data,type){
            //     var returnHTML = '';
            //     returnHTML += 'PS : '+data['personal_saving'];
            //     returnHTML += '<br>CBU : '+data['capital_build_up'];
            //     return returnHTML;
            // }}
            // {data: null,render(data,type){
            //     var actionButtons = '<div class="action-buttons">';
                
            //     @can('clients.destroy')
            //         actionButtons += '<a class="red delete" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
            //     @endcan
            //     actionButtons += '</div>';
            //     return actionButtons;
            // }},
            
            
        ]
    });

    // $('form#search').find('select[name="area"]').off('change');

    // $('form#search').find('select[name="area"]').on('change',function(e){
    //     e.preventDefault();
    //     $this = $(this);
        
    //     table_client.ajax.params({area_id : $this.val()}).url("{{url('loans-json')}}").load();
    // });

    table_client.on('click','.button-actions',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('tr');
        $tr.find('.question-content').removeAttr('style');
        $tr.find('.question').html($this[0].dataset.question);
        $tr.find('.action-buttons').attr('style','display:none');
        $tr.find('.proceed-approval').attr('data-action',$this[0].dataset.action)
    });

    table_client.on('click','.cancel-approval',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('tr');
        $tr.find('.question-content').attr('style','display:none');
        $tr.find('.action-buttons').removeAttr('style');
        $tr.find('.proceed-approval').removeAttr('data-action');
        $tr.find('.question').html('');
    });

    table_client.on('click','.proceed-approval',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('tr');
        $parentTr = $tr.closest('table').closest('tr');
        var data = table_client.row($parentTr).data()['loan'][$tr[0].dataset.index];
        
        if($this[0].dataset.action=="approve"){
            $tr.find('.status-name').html('APPROVED');
        }else if($this[0].dataset.action=="deny"){
            $tr.find('.status-name').html('DENIED');
        }else{
            $.ajax({
                url: "{{url('/loans')}}/"+data['id'],
                type: "DELETE",
                data: {_token: "{{csrf_token()}}", _method: "_delete"},
                success: function(data){
                    $tr.remove();
                }
            });
        }
        $tr.find('.question-content').attr('style','display:none');
        $tr.find('.action-buttons').removeAttr('style');
        
        if($this[0].dataset.action=="approve" || $this[0].dataset.action=="deny"){
            $tr.find('.action-buttons').remove();
            $.ajax({
                url: "{{url('/loans/approval')}}",
                type: "POST",
                data: {_token: "{{csrf_token()}}",action: $this[0].dataset.action, id: data['id']},
                success: function(data){
                    
                }
            });
        }
        $tr.find('.proceed-approval').removeAttr('data-action');
        $tr.find('.question').html('');
    });

    table_client.off('click','.edit-loan');

    table_client.on('click','.edit-loan',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('tr');
        $parentTr = $tr.closest('table').closest('tr');
        var data= table_client.row($parentTr).data()['loan'][$tr[0].dataset.index]
        
        $modal = $('#modal-edit');
        $modal.find('input[name="id"]').val(data['id']);
        $modal.find('input[name="transactioncode"]').val(data['transaction_code']);
        $modal.find('input[name="loan_amount"]').val(data['loan_amount']);
        $modal.find('input[name="interest"]').val(data['interest']);
        populate_dropdown("{{url('categories-json')}}",'form#form-edit select[name="category_id"]','id','name');
        populate_dropdown("{{url('payment-modes-json')}}",'form#form-edit select[name="payment_mode_id"]','id','name');
        $('form#form-edit select[name="category_id"]').val(data['category_id']);
        $('form#form-edit select[name="payment_mode_id"]').val(data['payment_mode_id']);
        var daily_only = data['payment_mode_id']==1 ? 1: 0;
        $.ajax({
            url: "{{url('terms-json')}}",
            type: "GET",
            dataType: 'JSON',
            data: {
                daily_only : daily_only,
                filter : 1
            },
            success: function(result){
                $data = result.data;
                $('form#form-edit select[name="term_id"]').html('');
                $.each($data, function() {
                    $('form#form-edit select[name="term_id"]').append($("<option />").val(this['id']).text(this['name']));
                });
                $('form#form-edit select[name="term_id"]').val(data['term_id']);
            }
        })
        $modal.modal('show');
        
    });

    $('#modal-edit').find('.button-submit').off('click');
    
    $('#modal-edit').find('.button-submit').on('click',function(e){
        e.preventDefault();
        $('#form-edit').submit();    
    });

    $('#form-edit').validate({
        rules: {
            category_id : {
                required : true
            },
            term_id : {
                required: true
            },
            payment_mode_id: {
                required: true
            },
            loan_amount: {
                required: true,
                number: true
            },
            interest: {
                required: true,
                min: 1,
                max: 100
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
        submitHandler: function(form){

            $form = $('#form-edit');
            $id = $form.find('input[name="id"]').val();
            $category_id = $form.find('select[name="category_id"]').val();
            $payment_mode_id = $form.find('select[name="payment_mode_id"]').val();
            $term_id = $form.find('select[name="term_id"]').val();
            $loan_amount = $form.find('input[name="loan_amount"]').val();
            $interest = $form.find('input[name="interest"]').val();
            $.ajax({
                url: "{{url('/loans/')}}/"+$id,
                type: "PUT",
                data: {_token: "{{csrf_token()}}",id:$id, category_id : $category_id, term_id : $term_id, payment_mode_id : $payment_mode_id, interest: $interest,loan_amount: $loan_amount},
                success: function(data){
                    Swal.fire(
                        'Success!',
                        'Successfully updated',
                        'success'
                    ).then((result)=>{
                        table_client.ajax.url("{{url('loans-json')}}").load();
                        $('#modal-edit').find('.close').click();
                        
                    })
                },
                error: function(xhr){
                    if(xhr.status==422){
                        Swal.fire(
                            'Ooops!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                }
            });
            return false;
        }
    });

    table_client.on('click','.for-release-loan',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('table').closest('tr');
        $parentTr = $tr.closest('table').closest('tr');
        var data= table_client.row($parentTr).data()['loan'][$tr[0].dataset.index]
        
        
        $modal = $('#modal-for-release');
        $modal.find('input[name="id"]').val(data['id']);
        $modal.find('input[name="transactioncode"]').val(data['transaction_code']);
        $modal.find('input[name="loan_amount"]').val(data['loan_amount']);
        $modal.find('input[name="net"]').val(data['loan_amount']);
        
        $.ajax({
            url: "{{url('charges')}}/"+data['id'],
            type: "GET",
            dataType: "JSON",
            success: function(result){
                var content = '';
                $modal.find('#table-charge').find('tbody').html(result.content);
                $modal.find('#table-loan').find('tbody').html(result.prev_loan);
                $modal.modal('show');
            }
        });
        
    });

    table_client.on('click','.release-loan',function(e){
        e.preventDefault();
        $this = $(this);
        $tr = $this.closest('table').closest('tr');
        $parentTr = $tr.closest('table').closest('tr');
        var data= table_client.row($parentTr).data()['loan'][$tr[0].dataset.index]
        
        $date_release = $tr.find('input[name="date_release"]').val();
        $first_payment = $tr.find('input[name="first_payment"]') ? $tr.find('input[name="first_payment"]').val() : null;
        var proceed = false;
        if(data['term']['daily_only']==1){
            if($date_release!=='') proceed=true
        }else{
            if($date_release!=='' && $first_payment!=='') proceed=true
        }
        if(proceed){
            $.ajax({
                url: "{{url('/loans/release')}}",
                type: "POST",
                data: {_token: "{{csrf_token()}}",id:$tr.attr('id'),date_release: $date_release, first_payment: $first_payment},
                success: function(data){
                    
                },
                error: function(xhr){
                    if(xhr.status==422){
                        Swal.fire(
                            'Ooops!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                }
            });
        }else{
            var message = data['term']['daily_only']==1 ? 'Please provide date release' : 'Please provide date release and first payment date';
            Swal.fire(
                'Ooops!',
                message,
                'error'
            )
        }
        
    });

    

    var table_charge = $('#table-charge');
    var table_loan = $('#table-loan');
    var selected_charges = [];
    var selected_loans = [];
    function calculate_net(){
        var total_deduction = 0;
        $modal = $('#modal-for-release');
        table_charge.find('tbody').find('tr').each(function(){
            $outerText = $(this).find('td').eq(2)[0].outerText;
            total_deduction += $(this).find('input[type="checkbox"]').is(':checked') ? parseInt($outerText.split('.')[0].replace(',','')) : 0;
        })
        table_loan.find('tbody').find('tr').each(function(){
            $outerText = $(this).find('td').eq(5)[0].outerText;
            total_deduction += $(this).find('input[type="checkbox"]').is(':checked') ? parseInt($outerText.split('.')[0].replace(',','')) : 0;
        })
        if(($modal.find('input[name="loan_amount"]').val()-total_deduction)<0){
            $modal.find('.button-release').attr('disabled',true)
        }else{
            $modal.find('.button-release').removeAttr('disabled')
        }
        
        $modal.find('input[name="net"]').val($modal.find('input[name="loan_amount"]').val()-total_deduction);
    }

    table_charge.on('change','.select-charge',function(e){
        e.preventDefault();
        calculate_net()
    })

    table_loan.on('change','.select-loan',function(e){
        e.preventDefault();
        calculate_net()
    })
    

    $('#modal-for-release').find('button.button-release').on('click',function(){
        $('#form-for-release').submit();
        
    });

    $('#form-for-release').validate({
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
        submitHandler: function(form){
            var form_data = new FormData(form);
            selected_charges=[];selected_loans=[];
            $('#table-charge tbody > tr').each(function(){
                $this= $(this);
                $checkbox = $this.find('td').eq(0).find('input[type="checkbox"]');
                if($checkbox.is(':checked')){
                    selected_charges.push($checkbox.attr('value'));
                }
            })
            $('#table-loan tbody > tr').each(function(){
                $this= $(this);
                $checkbox = $this.find('td').eq(0).find('input[type="checkbox"]');
                if($checkbox.is(':checked')){
                    selected_loans.push($checkbox.attr('value'));
                }
            })
            
            form_data.append('_token',"{{csrf_token()}}");
            
            $form = $('#form-for-release');
            $id = $form.find('input[name="id"]').val();
            
            $.ajax({
                url: "{{url('/loans/for-release')}}",
                type: "POST",
                data: {_token: "{{csrf_token()}}",id:$id, charges : selected_charges, byouts: selected_loans},
                success: function(data){
                    Swal.fire(
                        'Success!',
                        'Successfully tagged',
                        'success'
                    ).then((result)=>{
                        table_client.ajax.url("{{url('loans-json')}}").load();
                        $('#modal-for-release').find('.close').click();
                        
                    })
                },
                error: function(xhr){
                    if(xhr.status==422){
                        Swal.fire(
                            'Ooops!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                }
            });
            return false;
        }
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