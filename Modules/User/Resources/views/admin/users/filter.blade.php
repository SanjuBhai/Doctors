<div class='row'>
    <div class='col-md-4'>
        <label for='name'>First Name</label>
        <input type="text" name='name' id='name' value="{{ request('name') }}" class='form-control' autofocus>
    </div>
    <div class='col-md-4'>
        <label for='email'>Email</label>
        <input type="email" name='email' id='email' value="{{ request('email') }}" class='form-control'>
    </div>
    <div class='col-md-4'>
        <label for='phone'>Phone</label>
        <input type="text" name='phone' id='phone' value="{{ request('phone') }}" class='form-control'>
    </div>
</div>
<div class='row mt-10'>
    <div class='col-md-4'>
        <label for='state'>State</label>
        <input type="text" name='state' id='state' value="{{ request('state') }}" class='form-control'>
    </div>
    <div class='col-md-4'>
        <label for='city'>City</label>
        <input type="text" name='city' id='city' value="{{ request('city') }}" class='form-control'>
    </div>
    <div class='col-md-4'>
        <label for='address'>Address</label>
        <input type="text" name='address' id='address' value="{{ request('address') }}" class='form-control'>
    </div>
</div>