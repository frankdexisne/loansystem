<div class="widget-box">
    <div class="widget-header">
        <h4 class="smaller">
            Entry Form
            <small>Term</small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form id="form-term">
                @csrf
                
                <div class="form-group">
                    <label>No of months</label>
                    <input type="number" min="1" name="no_of_months" class="form-control" required>
                </div>  
                <button class="btn btn-success">Save</button>
                    
            </form>
            
        </div>
    </div>
</div>