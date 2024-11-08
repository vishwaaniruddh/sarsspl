 <!-- BEGIN: Main Menu-->
 <?php 
 $sidebar=$this->uri->segment(2);
 $User_Id = $this->session->LoggedUserId;
 $query=$this->db->query("SELECT * FROM `customer_promotion` WHERE `customer_id` = '".$User_Id."'");
 $userdata=$query->row();

  ?>
      <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
         <div class="main-menu-content">
            <ul class="navigation navigation-main" data-menu="menu-navigation" id="main-menu-navigation">
               
               <li class=" nav-item <?php if($sidebar=='Dashboard'){echo 'active';} ?>" >
                  <a href="<?=base_url()?>">
                  <i class="la la-home">
                  </i>
                  <span class="menu-title" data-i18n="Dashboard">
                  Dashboard
                  </span>
                  </a>
               </li>
              
              
               <?php
                if ($userdata->is_franchisee=='3') {
                    ?>
             
               
               <li class=" nav-item "><a href="#"><i class="la la-envelope-o"></i><span class="menu-title" data-i18n="Greetings">Advertisement</span></a>
               <ul class="menu-content">
                  <li class="<?php if($sidebar=='Advt'){echo 'active';} ?>"><a class="menu-item" href="<?=base_url('Advt/AddNew')?>"><i></i><span data-i18n="Greetings"> Add New</span></a>               
                 </li>
                 
                  
                 
               </ul>
             </li>

            <?php
            }
                if ($userdata->is_franchisee!=='3') {
                    ?>
             
               
               <li class=" nav-item "><a href="#"><i class="la la-envelope-o"></i><span class="menu-title" data-i18n="Greetings">Greetings</span></a>
               <ul class="menu-content">
                  <li class="<?php if($sidebar=='View'){echo 'active';} ?>"><a class="menu-item" href="<?=base_url('Greetings/View')?>"><i></i><span data-i18n="Greetings"> View</span></a>               
                 </li>
                 <li class="<?php if($sidebar=='TodayImages'){echo 'active';} ?>"><a class="menu-item" href="<?=base_url('Greetings/TodayImages')?>"><i></i><span data-i18n="Greetings"> Today Images</span></a>               
                 </li>
                  
                 
               </ul>
             </li>

            <?php
            }
             if ($userdata->is_franchisee && $userdata->is_franchisee!=='3') {
                 ?>
                 <li class=" nav-item <?php if($sidebar=='Referral'){echo 'active';} ?>" >
                  <a href="<?=base_url('Referral')?>">
                  <i class="la la-home">
                  </i>
                  <span class="menu-title" data-i18n="Dashboard">
                  Referral
                  </span>
                  </a>
               </li>
                 <?php
              } ?>
               
               
            </ul>
         </div>
      </div>
      <!-- END: Main Menu-->