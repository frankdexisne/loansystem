<div class="widget-box">
    <div class="widget-header">
        <h4 class="smaller">
            Entry Form
            <small>Charge</small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form id="form-charge">
                @csrf

                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>   
                <div class="form-group">
                    <label>Value</label>
                    <input type="number" min="1" name="value" class="form-control" required>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="is_percent" type="checkbox" class="ace" />
                        <span class="lbl"> Is percent</span>
                    </label>
                </div>
                
                <button class="btn btn-success">Save</button>
                    
            </form>
            
        </div>
    </div>
</div>