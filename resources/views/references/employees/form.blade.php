<div class="widget-box">
    <div class="widget-header">
        <h4 class="smaller">
            Entry Form
            <small>Employee</small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form id="form-employee">
                @csrf
                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" name="lname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" name="fname" class="form-control" required>
                </div>   
                <div class="form-group">
                    <label>Middlename</label>
                    <input type="text" name="mname" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Job Title</label>
                    <select name="job_title_id" class="form-control">
                        
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Branch assignment</label>
                    <select name="branch_id" class="form-control">
                        
                    </select>
                </div>

                
                <button class="btn btn-success">Save</button>
                    
            </form>
        </div>
    </div>
</div>