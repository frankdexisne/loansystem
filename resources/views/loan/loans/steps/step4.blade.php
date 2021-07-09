<form action="" id="form-step-4">
    <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="none" selected disabled>Please select one</option>
            
        </select>
    </div>   
    
    <div class="form-group">
        <label>Payment Mode</label>
        <select name="payment_mode_id" class="form-control">
            <option value="none" selected disabled>Please select one</option>
            
        </select>
    </div>

    <div class="form-group">
        <label>Term</label>
        <select name="term_id" class="form-control">
            <option value="none" selected disabled>Please select one</option>
            
        </select>
    </div>   
    

    <div class="form-group">
        <label>Loan Amount</label>
        <input type="number" min="1" name="loan_amount" class="form-control">
    </div>

    <div class="form-group">
        <label>Interest</label>
        <input type="number" min="1" max="100" name="interest" class="form-control">
    </div>
</form>