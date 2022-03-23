<input type="hidden" name="id" value="">
    
<div class="form-group">
    <label>Employee ID</label>
    <input type="text" name="employeeId" value="{{ old('employeeId', $user->employeeId) }}" class="form-control" autofocus autocomplete="off">
	<div class="invalid-feedback">Please fill in the Employee Id</div>
</div>

<div class="form-group">
    <label>Full Name</label>
    <input type="text" name="fullName"value="{{ old('fullName', $user->fullName) }}" class="form-control" autofocus autocomplete="off">
	<div class="invalid-feedback">Please fill in the Full Name</div>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" readonly autofocus autocomplete="off">
</div>

<div class="form-group">
    <label class="col-form-label">
		Address
	</label>
    <textarea class="form-control" name="address">{{ old('address', $user->address) }}</textarea>
</div>

<div class="form-group">
	<label>Avatar</label>
	<input name="avatar" type="file" class="form-control">
	<div class="invalid-feedback">Please fill in your thumbnail</div>
</div>

<button type="submit" class="btn btn-primary">
	Save
</button>