<?php

session_start();
 include('head.php');
?>
<nav class="breadcrumb" aria-label="breadcrumbs">

        <div class="container-bg">

          <h1>Account</h1>

          <a href="index.php" title="Back to the frontpage">Home</a>



          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

          <span>Account</span>

        </div>

      </nav>



      <main class="main-content">

        <div class="dt-sc-hr-invisible-small"></div>



        <div class="wrapper">

          <div class="grid-uniform">

            <div class="grid__item">

              <div class="container-bg">

                <div class="grid__item">

                  <div class="user-account">

                    <div class="grid__item text-center">

                      <div

                        class="note form-success"

                        id="ResetSuccess"

                        style="display: none"

                      >

                        We&#39;ve sent you an email with a link to update your

                        password.

                      </div>



                      <div id="CustomerLoginForm">

                        <form

                          method="post"

                          action="login_form_process.php"

                          id="customer_login"

                          accept-charset="UTF-8"

                        >

                         



                          <label for="CustomerEmail" class="label--hidden"

                            >User Id</label

                          >

                          <input

                            type="text"

                            name="member_id"

                            id="CustomerEmail"

                            placeholder="User Id"

                            autocorrect="off"

                            autocapitalize="off"

                            required

                          />



                          <label for="CustomerPassword" class="label--hidden"

                            >Password</label

                          >

                          <input

                            type="password"

                            value=""

                            name="value"

                            id="CustomerPassword"

                            placeholder="Password"
                            required

                          />



                       



                          <p>

                            <input type="submit" class="btn" value="Sign In" />

                          </p>


                          <a href="index.php"

                            >Return to Store</a

                          >

                        </form>

                      </div>



                      <div id="" style="display: none">

                        <div class="section-header section-header--small">
                           <a href="">
                              <h2 class="section-header__title">

                            Reset your password

                          </h2>
                           </a>
                         

                        </div>

                        <p>We will send you an email to reset your password.</p>



                        <form

                          method="post"

                          action="#"

                          accept-charset="UTF-8"

                        >

                          <input

                            type="hidden"

                            name="form_type"

                            value="recover_customer_password"

                          /><input type="hidden" name="utf8" value="✓" />



                          <label for="RecoverEmail" class="label--hidden"

                            >Email</label

                          >

                          <input

                            type="email"

                            value=""

                            name="email"

                            id="RecoverEmail"

                            placeholder="Email"

                            autocorrect="off"

                            autocapitalize="off"

                          />



                          <p>

                            <input type="submit" class="btn" value="Submit" />

                          </p>

                          <a

                            href="#"

                            onclick="hideRecoverPasswordForm();return false;"

                            >Cancel</a

                          >

                        </form>

                      </div>

                    </div>

                  </div>



                  <script>

                    /*

    Show/hide the recover password form when requested.

  */

                    function showRecoverPasswordForm() {

                      document.getElementById(

                        "RecoverPasswordForm"

                      ).style.display = "block";

                      document.getElementById(

                        "CustomerLoginForm"

                      ).style.display = "none";

                    }



                    function hideRecoverPasswordForm() {

                      document.getElementById(

                        "RecoverPasswordForm"

                      ).style.display = "none";

                      document.getElementById(

                        "CustomerLoginForm"

                      ).style.display = "block";

                    }



                    // Allow deep linking to the recover password form

                    if (window.location.hash == "#recover") {

                      showRecoverPasswordForm();

                    }



                    // reset_success is only true when the reset form is

                  </script>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="dt-sc-hr-invisible-large"></div>

      </main>

<?php include('footer.php');?>