<div id="modal-wizard" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="container-new">
                <div id="modal-wizard-container">
                    <div class="modal-header">
                        <ul class="steps">
                            <li data-step="1" class="active">
                                <span class="step">1</span>
                                <span class="title">Client Profile</span>
                            </li>

                            <li data-step="2">
                                <span class="step">2</span>
                                <span class="title">Co-Maker</span>
                            </li>

                            <li data-step="3">
                                <span class="step">3</span>
                                <span class="title">Beneficiary</span>
                            </li>

                            <li data-step="4">
                                <span class="step">4</span>
                                <span class="title">Loan Details</span>
                            </li>
                        </ul>
                        
                    </div>

                    <div class="modal-body step-content">
                        <div class="step-pane active" data-step="1">
                            @include('loan.loans.steps.step1')
                        </div>

                        <div class="step-pane" data-step="2">
                            @include('loan.loans.steps.step2')
                        </div>

                        <div class="step-pane" data-step="3">
                            @include('loan.loans.steps.step3')
                        </div>

                        <div class="step-pane" data-step="4">
                            
                            @include('loan.loans.steps.step4')
                            
                        </div>                        
                    </div>
                </div>

                <div class="modal-footer wizard-actions">
                    <button class="btn btn-sm btn-prev">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Prev
                    </button>

                    <button class="btn btn-success btn-sm btn-next" data-last="Finish">
                        Next
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>

                    <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>
                    
                    
                </div>
            </div>
           
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->