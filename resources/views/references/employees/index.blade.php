<table class="table table-bordered" id="table-employee" width="100%">
    <thead>                  
    <tr>
        <th>Employee Name</th>
        <th>Job Title</th>
        <th>Branch Assignment</th>
        <th style="width: 40px">Action</th>
    </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<div id="modal-add-user" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-add-user">
            <div class="modal-header">
                <h3>Add User </h3>
            </div>
            <div class="modal-body">
                
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="name">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control">
                    </div>   
                    <div class="form-group">
                        <label>Password (Optional/(default:PassworD)):</label>
                        <input type="password" name="password" class="form-control">
                    </div>   
                    
            </div>
            <div class="modal-footer">
                <div class="clearfix pull-right">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>