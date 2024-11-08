 <!-- BEGIN: Header-->
      <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
         <div class="navbar-wrapper">
            <div class="navbar-header">
               <ul class="nav navbar-nav flex-row">
                  <li class="nav-item mobile-menu d-lg-none mr-auto">
                     <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                     <i class="ft-menu font-large-1">
                     </i>
                     </a>
                  </li>
                  <li class="nav-item mr-auto">
                     <a class="navbar-brand" href="index.html">
                        <img alt="modern admin logo" class="brand-logo" src="<?=base_url('assets/')?>images/logo/logo.png">
                        <h3 class="brand-text">
                           Allmart
                        </h3>
                        </img>
                     </a>
                  </li>
                  <li class="nav-item d-none d-lg-block nav-toggle">
                     <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                     <i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right">
                     </i>
                     </a>
                  </li>
                  <li class="nav-item d-lg-none">
                     <a class="nav-link open-navbar-container" data-target="#navbar-mobile" data-toggle="collapse">
                     <i class="la la-ellipsis-v">
                     </i>
                     </a>
                  </li>
               </ul>
            </div>
            <div class="navbar-container content">
               <div class="collapse navbar-collapse" id="navbar-mobile">
                  <ul class="nav navbar-nav mr-auto float-left">
                     <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-expand" href="#">
                        <i class="ficon ft-maximize">
                        </i>
                        </a>
                     </li>
                     
                     <li class="nav-item nav-search">
                        <a class="nav-link nav-link-search" href="#">
                        <i class="ficon ft-search">
                        </i>
                        </a>
                        <div class="search-input">
                           <input class="input" data-search="template-list" placeholder="Explore Modern..." tabindex="0" type="text">
                           <div class="search-input-close">
                              <i class="ft-x">
                              </i>
                           </div>
                           <ul class="search-list">
                           </ul>
                           </input>
                        </div>
                     </li>
                  </ul>
                  <ul class="nav navbar-nav float-right">
                     
   
                     <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" data-toggle="dropdown" href="#">
                        <span class="mr-1 user-name text-bold-700">
                        
                        <?php 
                        if(isset($this->session->LoggedUserId)){
                        $this->load->model('AuthLog_M');
                        $User=$this->AuthLog_M->getuserDeta($this->session->LoggedUserId);
                        if($User)
                        {
                           echo $User->customer_name;
                        }
                        else
                        {
                           redirect(base_url('Login'));
                        }
                        
                       
                        }
                         ?>
                        </span>
                        <span class="avatar avatar-online">
                           <?php
                           if($User->image!=='')
                           {
                           ?>
                        <img alt="avatar" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$User->image?>">
                           <?php
                           }
                           else
                           {
                           ?>
                           <img alt="avatar" src="<?=base_url()?>/assets/images/defualt.png">
                           <?php
                           }
                           ?>
                        <i>
                        </i>
                        </img>
                        </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="<?=base_url('User/EditProfile')?>">
                           <!--<a class="dropdown-item" href="#">-->
                           <i class="ft-user">
                           </i>
                           Edit Profile
                           </a>
                           
                           
                           <div class="dropdown-divider">
                           </div>
                           <a class="dropdown-item" href="<?=base_url('Login/Logout')?>">
                           <i class="ft-power">
                           </i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      <!-- END: Header-->