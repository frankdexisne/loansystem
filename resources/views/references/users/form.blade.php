<div class="widget-box">
    <div class="widget-header">
        <h4 class="smaller">
            Entry Form
            <small>User</small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form id="form-user">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>   
                <div class="checkbox">
                    <label>
                        <input name="is_multiple_client" type="checkbox" class="ace" />
                        <span class="lbl"> Is multiple</span>
                    </label>
                </div>
                
                <button class="btn btn-success">Save</button>
                    
            </form>
            
        </div>
    </div>
</div>