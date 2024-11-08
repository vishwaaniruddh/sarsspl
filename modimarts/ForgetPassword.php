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



                      <div id="" >

                        <div class="section-header section-header--small">

                          <h2 class="section-header__title">

                            Reset your password

                          </h2>

                        </div>

                        <p>We will send you an email to reset your password.</p>



                        <form

                          method="post"

                          action="https://allmart.world/ForgetPasswordProcess.php"

                          accept-charset="UTF-8"

                        >

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
                            required

                          />



                          <p>

                            <input type="submit" class="btn" value="Submit" />

                          </p>

                          <a

                            href="https://allmart.world/login.php"

                            

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