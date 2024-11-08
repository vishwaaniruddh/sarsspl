 <!-- BEGIN: Footer-->
      <footer class="footer footer-static footer-light navbar-border navbar-shadow">
         <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">
            Copyright © <?=date('Y')?>
            <a class="text-bold-800 grey darken-2" href="#" target="_blank">
            ALLMART
            </a>
            </span>
            <span class="float-md-right d-none d-lg-block">
            Hand-crafted & Made with
            <i class="ft-heart pink">
            </i>
            <span id="scroll-top">
            </span>
            </span>
         </p>
      </footer>
      <!-- END: Footer-->
      <!-- BEGIN: Vendor JS-->
         

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url('assets/')?>js/core/app-menu.min.js"></script>
    <script src="<?=base_url('assets/')?>js/core/app.min.js"></script>
    <script src="<?=base_url('assets/')?>js/scripts/customizer.min.js"></script>
    <script src="<?=base_url('assets/')?>js/scripts/footer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/tables/datatables/datatable-basic.min.js"></script>
    <!-- END: Page JS-->


     <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/charts/chart.min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/charts/raphael-min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/charts/morris.min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
    <script src="<?=base_url('assets/')?>data/jvector/visitor-data.js"></script>
    <!-- END: Page Vendor JS-->

     <script src="<?=base_url('assets/')?>/js/scripts/extensions/toastr.min.js"></script>

     <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

<script>
      document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
      },1000);
  }
}
    </script>
   </body>
   <!-- END: Body-->
</html>