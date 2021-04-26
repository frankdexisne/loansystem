<div class="widget-box">
    <div class="widget-header">
        <h4 class="smaller">
            Entry Form
            <small>Branch</small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form id="form-branch">
                @csrf
                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>   
                
                
                <button class="btn btn-success">Save</button>
                    
            </form>
            
        </div>
    </div>
</div>