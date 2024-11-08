 <!-- BEGIN: Vendor CSS-->
 <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->


      <!-- BEGIN: Content-->
      <div class="app-content content">
         <div class="content-overlay">
         </div>
         <div class="content-wrapper">
            <div class="content-header row">
              <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Advertisement</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?=base_url('Advt/AddNew')?>">advertisement</a>
                  </li>
                  <li class="breadcrumb-item active">Add advertisement
                  </li>
                </ol>
              </div>
            </div>
          </div>
            </div>
            <div class="content-body"><!-- Zero configuration table -->
          <section id="configuration">
              <div class="row">
              <div class="card">
				<div class="card-header">
                <?=$this->session->flashdata('FlashMassage');?>
								<h4 class="form-section"><i class="la la-image"></i> User Details</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				</div>
                <form class="form" action="<?=base_url(uri_string())?>" method="POST" enctype="multipart/form-data">

				<div class="card-content collapse show">
					<div class="card-body">
							<div class="form-body">
								<div class="row">
                                    <div class="col-md-3">
                                        <label>Upload Type</label>
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                <input type="radio" name="uploadtype" class="custom-control-input" value="Top" onclick="CheckUpload(this.value)" checked id="yes">
                                                <label class="custom-control-label" for="yes">Top</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="uploadtype" class="custom-control-input" value="Bottom" onclick="CheckUpload(this.value)" id="no">
                                                <label class="custom-control-label" for="no">Bottom</label>
                                            </div>
                                            </div>
                                    </div>
                                    <div class="col-md-3" id="category" >
                                    <label>Advertisement Category</label>
                                    <select class="form-control" name="advttype">
                                        <option value="">Select Category</option>
                                        <option value="Property">Property</option>
                                        <option value="Land">Land</option>
                                    </select>
                                    </div>
                                    <div class="col-md-3" id="portion" style="display:none">
                                        <label>Bottom Portion</label>
                                           <div class="input-group skin skin-square">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" name="bottomportion" class="custom-control-input" value="80"  checked id="eat">
                                                    <label class="custom-control-label" for="eat">80%</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio">
                                                    <input type="radio" name="bottomportion" class="custom-control-input" value="100"  id="had">
                                                    <label class="custom-control-label" for="had">100%</label>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">Upload Profile Image <span class="text-danger" title="required Input">*</span></label>
                                           <input accept="image/*"  name="image" class="form-control" type='file' id="uploadfile" required/>
                                           <small class="text-warning">Image Must be atleast 500 width x 500 height and png,jpg,jpeg format</small>
                                        </div>
                                        <span id="response"></span>
                                    </div>
                                    <div class="col-md-3" >
                                        <label>Give Advertisement</label>
                                           <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                <input type="radio" name="giveadvt" class="custom-control-input" value="Yes"  checked id="yes1">
                                                <label class="custom-control-label" for="yes1">Yes</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="giveadvt" class="custom-control-input" value="No"  id="no1">
                                                <label class="custom-control-label" for="no1">No</label>
                                            </div>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Ads Name</label>
											<input type="text" placeholder="Ads Name" name="Adsname"    class="form-control">
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Number of Person </label>
											<input type="number" placeholder="Number of Person" name="namberofperson" value="0" id="val1" onkeyup="calculate()" class="form-control">
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Number of Days </label>
											<input type="number"  placeholder="Number of Days" name="namberofdays"  value="0" id="val2" onkeyup="calculate()" class="form-control">
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Total Advertisement </label>
											<input type="number" placeholder="Total Advertisement" name="totaladvertisement" id="total"  value="0" class="form-control" readonly>
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Gender</label>
											<div class="input-group skin skin-square">
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" name="gender" class="custom-control-input" value="Both"  checked id="Both">
                                                    <label class="custom-control-label" for="Both">Both</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                    <input type="radio" name="gender" class="custom-control-input" value="Male"   id="Male">
                                                    <label class="custom-control-label" for="Male">Male</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio">
                                                    <input type="radio" name="gender" class="custom-control-input" value="Female"  id="Female">
                                                    <label class="custom-control-label" for="Female">Female</label>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Age Limit</label>
                                            <select name="age" class="form-control">
                                              <option value="-25">Below 25</option>
                                              <option value="25-40">Between 25-40</option>
                                              <option value="+40">Above 40</option>
                                            </select>
											</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Minimum Income</label>
											<input type="number"  placeholder="Minimum Income" name="minimunIncome"  class="form-control">
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Maximum Income</label>
											<input type="number" placeholder="Maximum Income" name="maximumIncome"  class="form-control">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Country </label>
                                            <input type="text"  placeholder="Country"  id="txtCountry"  class="form-control typeahead txtCountry">
                                            <select name="country" id="country"  class="form-control"  >

                                                 <option value="1" selected>INDIA</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Zone </label>
                                            <input type="text"  placeholder="Zone"  id="txtzone"  class="form-control typeahead">
											<select name="zone" id="zone"  class="form-control"  >
                                                 <option value="">Select Zone</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">State</label>
                                            <input type="text"  placeholder="State" id="txtState"   class="form-control typeahead">
											<select name="State" id="State"  class="form-control"  >
                                                  <option value="">Select State</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Division</label>
                                            <input type="text"  placeholder="Division" id="txtDivision"   class="form-control typeahead">
											<select name="Division" id="Division"  class="form-control"  >
                                                 <option value="">Select Division</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">District</label>
                                            <input type="text"  placeholder="District" id="txtdistrict"   class="form-control typeahead">
											<select name="district" id="district"  class="form-control"  >
                                                 <option value="">Select District</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Taluka</label>
                                            <input type="text"  placeholder="Taluka" id="txttaluka"   class="form-control typeahead">
											<select name="taluka" id="taluka"  class="form-control"  >
                                                <option value="">Select Taluka</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Pincode </label>
											<input type="number"  id="txtpincode" class="form-control typeahead" >
                                            <select name="pincode" id="pincode"  class="form-control"  >
                                                <option value="">Select Pincode</option>
                                            </select>
										</div>
									</div>

								</div>
							</div>
							<div class="form-actions">
								<button type="button" class="btn btn-warning mr-1">
									<i class="ft-x"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<input type="hidden" value="1" name="RegisterForm">
									<i class="la la-check-square-o"></i> Save
								</button>
							</div>
					</div>
				</div>
</form>
			</div>
              </div>
          </section>
        </div>
         </div>
      </div>
       <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/tables/datatables/datatable-basic.min.js"></script>
    <!-- END: Page JS-->

     <!-- END: Content-->
     <script>
    	function checkPassword () {
    		var password = $("#txtPassword").val();
    		var ConfirmPassword = $("#ConfirmPassword").val();
    		if(password===ConfirmPassword)
    		{
    			$("#msg").html("<span class='text-success'>Password Match</span>");
    		}
    		else
    		{
    			$("#msg").html("<span class='text-danger'>Password Not Match</span>");
    		}
    	}
    </script>
    <script>
    	function CheckPasswordreq () {
    		var password = $("#txtPassword").val();
    		var ConfirmPassword = $("#ConfirmPassword").val();
    		var village = $("#village").val();
    		if(village!==''){
	    		if(password===ConfirmPassword)
	    		{
	    			return true;
	    		}
	    		else
	    		{
	    			return false;
	    		}
	    	}
	    	else
	    	{
                 return false;
	    	}
    	}
    </script>
    <script>
        function CheckUpload(val)
        {
           if(val=='Bottom')
           {
               $("#category").hide();
               $("#portion").show();
           }
           else
           {
            $("#category").show();
               $("#portion").hide();
           }
           if(val=='Top')
           {
            $("#category").show();
               $("#portion").hide();
           }
           else
           {
            $("#category").hide();
               $("#portion").show();
           }
        }
    </script>
    <script>
        function calculate()
        {
            var val1 = $("#val1").val();
            var val2 = $("#val2").val();
            if(val1!='' && val2!='')
            {
             var total =val1*val2;
             $("#total").val(total);
            }
            else
            {
             $("#total").val('0');
            }
        }
    </script>
    <!-- BEGIN: Vendor JS-->

    <script>
    	$('#txtpincode').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtzone").val('');
                $("#txtState").val('');
                $("#txtdistrict").val('');
                $("#txtDivision").val('');
                $("#txttaluka").val('');
                $.ajax({
                    url: "<?=base_url('Result/getpincode')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selecttaluka(item.id);
                // getnoofvilage(item.id);
                this.html("<option value='"+item.id+"'>"+item.name+"</option>")
                console.log("====="+item)
                return item;
            }
        });

    	$('#txttaluka').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtzone").val('');
                $("#txtState").val('');
                $("#txtdistrict").val('');
                $("#txtDivision").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');
                $.ajax({
                    url: "<?=base_url('Result/gettaluka1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selectdistrict(item.id);
                // getnoofvilage(item.id);
                $("#taluka").html("<option value='"+item.id+"'>"+item.name+"</option>")
                console.log("====="+item)
                return item;
            }
        });

    	$('#txtdistrict').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtzone").val('');
                $("#txtState").val('');
                $("#txtDivision").val('');
                $("#txttaluka").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');
                $.ajax({
                    url: "<?=base_url('Result/getdistrict1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selectdivision(item.id);
                // getnoofvilage(item.id);
                $("#district").html("<option value='"+item.id+"'>"+item.name+"</option>")
                console.log("====="+item)
                return item;
            }
        });

    	$('#txtDivision').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtzone").val('');
                $("#txtState").val('');
                $("#txtdistrict").val('');
                $("#txttaluka").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');
                $.ajax({
                    url: "<?=base_url('Result/getdivision1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selectState(item.id);
                // getnoofvilage(item.id);
                $("#Division").html("<option value='"+item.id+"'>"+item.name+"</option>")
                console.log("====="+item)
                return item;
            }
        });

    	$('#txtState').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtzone").val('');
                $("#txtdistrict").val('');
                $("#txtDivision").val('');
                $("#txttaluka").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');

                $.ajax({
                    url: "<?=base_url('Result/getState1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selectZone(item.id);
                // getnoofvilage(item.id)
                $("#State").html("<option value='"+item.id+"'>"+item.name+"</option>");
                console.log("====="+item)
                return item;
            }
        });
    	$('#txtzone').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtCountry").val('');
                $("#txtState").val('');
                $("#txtdistrict").val('');
                $("#txtDivision").val('');
                $("#txttaluka").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');
                $.ajax({
                    url: "<?=base_url('Result/getZone1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                selectCountry(item.id);
                // getnoofvilage(item.id);
                $("#zone").html("<option value='"+item.id+"'>"+item.name+"</option>");
                console.log("====="+item)
                return item;
            }
        });



    	$('.txtCountry').typeahead({
            source: function (query, result) {
                $("#village").html('');
                $("#taluka").html('');
                $("#district").html('');
                $("#Division").html('');
                $("#State").html('');
                $("#zone").html('');
                $("#country").html('');
                $("#getfranchise").html('');
                $("#txtzone").val('');
                $("#txtState").val('');
                $("#txtdistrict").val('');
                $("#txtDivision").val('');
                $("#txttaluka").val('');
                $("#pincode").html('');
                $("#txtpincode").val('');
                $.ajax({
                    url: "<?=base_url('Result/getCountry1')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                // selectvilage(item.id);
                // selectCountry(item.id);
                // getnoofvilage(item.id);
                $("#country").html("<option value='"+item.id+"'>"+item.name+"</option>");
                console.log("====="+item)
                return item;
            }
        });


    </script>

    <script>
    	function selectvilage(pincode)
    	{
    		 $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getvillage')?>",
                    data: 'query=' + pincode,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#village").val(data);
                          // $("#load").hide();
                    }
                });
    	}
    </script>

    <script>
    	function selecttaluka(pincode)
    	{
           $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/gettaluka')?>",
                    data: 'query=' + pincode,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#taluka").html(data);
                        var taluka= $('#taluka').val();
                        selectdistrict(taluka);
                         $("#load").hide();
                    }
                });
    	}
    </script>
    <script>
    	function selectdistrict(taluka)
    	{
    		 // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getdistrict')?>",
                    data: 'query=' + taluka,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#district").html(data);
                        var district= $('#district').val();
                        selectdivision(district);
                         $("#load").hide();
                    }
                });
    	}
    </script>
    <script>
    	function selectdivision(district)
    	{
        // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getdivision')?>",
                    data: 'query=' + district,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#Division").html(data);
                        var division= $('#Division').val();
                        selectState(division);
                         $("#load").hide();
                    }
                });
    	}
    </script>
    <script>
    	function selectState(division)
    	{
    		 // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getState')?>",
                    data: 'query=' + division,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#State").html(data);
                        var State= $('#State').val();
                        selectZone(State);
                         $("#load").hide();
                    }
                });
    	}
    </script>
    <script>
    	function selectZone(state)
    	{
          // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getZone')?>",
                    data: 'query=' + state,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#zone").html(data);
                        var zone= $('#zone').val();
                        selectCountry(zone);
                         $("#load").hide();
                    }
                });
    	}
    </script>
    <script>
    	function selectCountry(zone)
    	{
    		 // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getCountry')?>",
                    data: 'query=' + zone,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#country").html(data);
                         $("#load").hide();
                    }
                });
    	}
    </script>

