<div class="row">
  <div class="col-sm-6">
    <h2>New Customer</h2>
    <p>Checkout Options:</p>
    <div class="radio">
      <label>
                <input name="account" value="register" checked="checked" type="radio">
                Register Account</label>
    </div>
        <div class="radio">
      <label>
                <input name="account" value="guest" type="radio">
                Guest Checkout</label>
    </div>
        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
    <input value="Continue" id="button-account" data-loading-text="Loading..." class="btn btn-primary" type="button">
  </div>
  <div class="col-sm-6">
    <h2>Login</h2>
    <p></p>
    <div class="form-group">
      <label class="control-label" for="input-email">E-Mail</label>
      <input name="email" value="" placeholder="E-Mail" id="input-email" class="form-control" type="text">
    </div>
    <div class="form-group">
      <label class="control-label" for="input-password">Password</label>
      <input name="password" value="" placeholder="Password" id="input-password" class="form-control" type="password">
      <a href="">Forgotten Password</a></div>
    <input value="Login" id="button-login" data-loading-text="Loading..." class="btn btn-primary" type="button">
  </div>
</div>