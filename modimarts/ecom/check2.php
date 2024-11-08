<html dir="ltr" class="ltr" lang="en"><!--<![endif]--><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Checkout</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <base href="http://sarmicrosystems.in/oc1/">
                    	    	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon">
    	                <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet">
                <link href="catalog/view/theme/pav_bigstore/stylesheet/skins/brown.css" rel="stylesheet">
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet">
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet">
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet">
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet">
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet">
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet">
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet">
                <link href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet">
                        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/moment.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        
    <!-- FONT -->

        <!-- FONT -->


      </head>
    <body class="checkout-checkout page-checkout-checkout layout-fullwidth">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    <div id="header-main">
        <div class="container">
            <div class="row">
            <?php include('toplogo.php')?>
            </div>
        </div>
    </div>
    <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            
                                              <?php include('menu.php')?>
                                              
                                                </div>
                    </div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                            <?php include("mancategories.php")?>                        </div>
                                     </div>
            </div>
        </div>
    </div>
</header>


        <!-- /header -->
        <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                        <div class="container">
  <ul class="breadcrumb">
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=checkout/cart">Shopping Cart</a></li>
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=checkout/checkout">Checkout</a></li>
      </ul>
    <div class="row">                <div id="content" class="col-sm-12"><h1>Checkout</h1>
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-checkout-option" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" aria-expanded="true">Step 1: Checkout Options <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse in" id="collapse-checkout-option" aria-expanded="true" style="">
            <!---login page come here---->
          </div>
        </div>
                <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 2: Account &amp; Billing Details</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-payment-address">
            <div class="panel-body"></div>
          </div>
        </div>
                        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 3: Delivery Details</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-shipping-address">
            <div class="panel-body"></div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 4: Delivery Method</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-shipping-method">
            <div class="panel-body"></div>
          </div>
        </div>
                <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 5: Payment Method</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-payment-method">
            <div class="panel-body"></div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 6: Confirm Order</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-checkout-confirm">
            <div class="panel-body"></div>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>
<script type="text/javascript"><!--
$(document).on('change', 'input[name=\'account\']', function() {
	if ($('#collapse-payment-address').parent().find('.panel-heading .panel-title > *').is('a')) {
		if (this.value == 'register') {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Account &amp; Billing Details <i class="fa fa-caret-down"></i></a>');
		} else {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
		}
	} else {
		if (this.value == 'register') {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('Step 2: Account &amp; Billing Details');
		} else {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('Step 2: Billing Details');
		}
	}
});

$(document).ready(function() {
    $.ajax({
        url: 'index.php?route=checkout/login',
        dataType: 'html',
        success: function(html) {
           $('#collapse-checkout-option .panel-body').html("ok");

			$('#collapse-checkout-option').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-option" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 1: Checkout Options <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-checkout-option\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Checkout
$(document).delegate('#button-account', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/' + $('input[name=\'account\']:checked').val(),
        dataType: 'html',
        beforeSend: function() {
        	$('#button-account').button('loading');
		},
        complete: function() {
			$('#button-account').button('reset');
        },
        success: function(html) {
            $('.alert, .text-danger').remove();

            $('#collapse-payment-address .panel-body').html(html);

			if ($('input[name=\'account\']:checked').val() == 'register') {
				$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Account &amp; Billing Details <i class="fa fa-caret-down"></i></a>');
			} else {
				$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
			}

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Login
$(document).delegate('#button-login', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/login/save',
        type: 'post',
        data: $('#collapse-checkout-option :input'),
        dataType: 'json',
        beforeSend: function() {
        	$('#button-login').button('loading');
		},
        complete: function() {
            $('#button-login').button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#collapse-checkout-option .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				// Highlight any found errors
				$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
		   }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Register
$(document).delegate('#button-register', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/register/save',
        type: 'post',
        data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'password\'], #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address textarea, #collapse-payment-address select'),
        dataType: 'json',
        beforeSend: function() {
			$('#button-register').button('loading');
		},
        success: function(json) {
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-register').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
            } else {
                                var shipping_address = $('#payment-address input[name=\'shipping_address\']:checked').prop('value');

                if (shipping_address) {
                    $.ajax({
                        url: 'index.php?route=checkout/shipping_method',
                        dataType: 'html',
                        success: function(html) {
							// Add the shipping address
                            $.ajax({
                                url: 'index.php?route=checkout/shipping_address',
                                dataType: 'html',
                                success: function(html) {
                                    $('#collapse-shipping-address .panel-body').html(html);

									$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                }
                            });

							$('#collapse-shipping-method .panel-body').html(html);

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a>');

   							$('a[href=\'#collapse-shipping-method\']').trigger('click');

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'index.php?route=checkout/shipping_address',
                        dataType: 'html',
                        success: function(html) {
                            $('#collapse-shipping-address .panel-body').html(html);

							$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');

							$('a[href=\'#collapse-shipping-address\']').trigger('click');

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
                
                $.ajax({
                    url: 'index.php?route=checkout/payment_address',
                    dataType: 'html',
                    complete: function() {
                        $('#button-register').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-payment-address .panel-body').html(html);

						$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Payment Address
$(document).delegate('#button-payment-address', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/payment_address/save',
        type: 'post',
        data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'password\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address textarea, #collapse-payment-address select'),
        dataType: 'json',
        beforeSend: function() {
        	$('#button-payment-address').button('loading');
		},
        complete: function() {
			$('#button-payment-address').button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                if (json['error']['warning']) {
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().parent().addClass('has-error');
            } else {
                                $.ajax({
                    url: 'index.php?route=checkout/shipping_address',
                    dataType: 'html',
                    success: function(html) {
                        $('#collapse-shipping-address .panel-body').html(html);

						$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-shipping-address\']').trigger('click');

						$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
                
                $.ajax({
                    url: 'index.php?route=checkout/payment_address',
                    dataType: 'html',
                    success: function(html) {
                        $('#collapse-payment-address .panel-body').html(html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Shipping Address
$(document).delegate('#button-shipping-address', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/shipping_address/save',
        type: 'post',
        data: $('#collapse-shipping-address input[type=\'text\'], #collapse-shipping-address input[type=\'date\'], #collapse-shipping-address input[type=\'datetime-local\'], #collapse-shipping-address input[type=\'time\'], #collapse-shipping-address input[type=\'password\'], #collapse-shipping-address input[type=\'checkbox\']:checked, #collapse-shipping-address input[type=\'radio\']:checked, #collapse-shipping-address textarea, #collapse-shipping-address select'),
        dataType: 'json',
        beforeSend: function() {
			$('#button-shipping-address').button('loading');
	    },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-shipping-address').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-shipping-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-shipping-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().parent().addClass('has-error');
            } else {
                $.ajax({
                    url: 'index.php?route=checkout/shipping_method',
                    dataType: 'html',
                    complete: function() {
                        $('#button-shipping-address').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-shipping-method .panel-body').html(html);

						$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-shipping-method\']').trigger('click');

						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');

                        $.ajax({
                            url: 'index.php?route=checkout/shipping_address',
                            dataType: 'html',
                            success: function(html) {
                                $('#collapse-shipping-address .panel-body').html(html);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

                $.ajax({
                    url: 'index.php?route=checkout/payment_address',
                    dataType: 'html',
                    success: function(html) {
                        $('#collapse-payment-address .panel-body').html(html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Guest
$(document).delegate('#button-guest', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/guest/save',
        type: 'post',
        data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address textarea, #collapse-payment-address select'),
        dataType: 'json',
        beforeSend: function() {
       		$('#button-guest').button('loading');
	    },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-guest').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
            } else {
                                var shipping_address = $('#collapse-payment-address input[name=\'shipping_address\']:checked').prop('value');

                if (shipping_address) {
                    $.ajax({
                        url: 'index.php?route=checkout/shipping_method',
                        dataType: 'html',
                        complete: function() {
                            $('#button-guest').button('reset');
                        },
                        success: function(html) {
							// Add the shipping address
                            $.ajax({
                                url: 'index.php?route=checkout/guest_shipping',
                                dataType: 'html',
                                success: function(html) {
                                    $('#collapse-shipping-address .panel-body').html(html);

									$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                }
                            });

						    $('#collapse-shipping-method .panel-body').html(html);

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a>');

							$('a[href=\'#collapse-shipping-method\']').trigger('click');

							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'index.php?route=checkout/guest_shipping',
                        dataType: 'html',
                        complete: function() {
                            $('#button-guest').button('reset');
                        },
                        success: function(html) {
                            $('#collapse-shipping-address .panel-body').html(html);

							$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');

							$('a[href=\'#collapse-shipping-address\']').trigger('click');

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
                            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Guest Shipping
$(document).delegate('#button-guest-shipping', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/guest_shipping/save',
        type: 'post',
        data: $('#collapse-shipping-address input[type=\'text\'], #collapse-shipping-address input[type=\'date\'], #collapse-shipping-address input[type=\'datetime-local\'], #collapse-shipping-address input[type=\'time\'], #collapse-shipping-address input[type=\'password\'], #collapse-shipping-address input[type=\'checkbox\']:checked, #collapse-shipping-address input[type=\'radio\']:checked, #collapse-shipping-address textarea, #collapse-shipping-address select'),
        dataType: 'json',
        beforeSend: function() {
        	$('#button-guest-shipping').button('loading');
		},
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-guest-shipping').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-shipping-address .panel-body').prepend('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-shipping-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
            } else {
                $.ajax({
                    url: 'index.php?route=checkout/shipping_method',
                    dataType: 'html',
                    complete: function() {
                        $('#button-guest-shipping').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-shipping-method .panel-body').html(html);

						$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i>');

						$('a[href=\'#collapse-shipping-method\']').trigger('click');

						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

$(document).delegate('#button-shipping-method', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/shipping_method/save',
        type: 'post',
        data: $('#collapse-shipping-method input[type=\'radio\']:checked, #collapse-shipping-method textarea'),
        dataType: 'json',
        beforeSend: function() {
        	$('#button-shipping-method').button('loading');
		},
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-shipping-method').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-shipping-method .panel-body').prepend('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            } else {
                $.ajax({
                    url: 'index.php?route=checkout/payment_method',
                    dataType: 'html',
                    complete: function() {
                        $('#button-shipping-method').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-payment-method .panel-body').html(html);

						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 5: Payment Method <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-payment-method\']').trigger('click');

						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

$(document).delegate('#button-payment-method', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/payment_method/save',
        type: 'post',
        data: $('#collapse-payment-method input[type=\'radio\']:checked, #collapse-payment-method input[type=\'checkbox\']:checked, #collapse-payment-method textarea'),
        dataType: 'json',
        beforeSend: function() {
         	$('#button-payment-method').button('loading');
		},
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-payment-method').button('reset');
                
                if (json['error']['warning']) {
                    $('#collapse-payment-method .panel-body').prepend('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            } else {
                $.ajax({
                    url: 'index.php?route=checkout/confirm',
                    dataType: 'html',
                    complete: function() {
                        $('#button-payment-method').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-checkout-confirm .panel-body').html(html);

						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 6: Confirm Order <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-checkout-confirm\']').trigger('click');
					},
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
//--></script>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">
 
  

  <div class="footer-center " id="pavo-footer-center">
  <div class="container">
      <div class="row">
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="media">  				<div class="logo-about">  		
				<!--<h2>Merabazaar</h2>------>	<img alt="icon" src="image/catalog/logo.png"> 	</div>    				<div class="media-body">  					<div class="ourservice-content">  						<p>Proin gravida nibh velit auctor bibendum auctor, nisi elituat ipsum odio sit amet nibh ulpate cursus a sit amet mauris.</p>  					</div>  				</div>    			</div>        </div>
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          
<div class=" pav-newsletter" id="newsletter_1984645366">
		<form id="formNewLestter" method="post" action="http://sarmicrosystems.in/oc/index.php?route=extension/module/pavnewsletter/subscribe" class="formNewLestter">
            <div class="panel-heading"><h4 class="panel-title">Newsletter</h4></div>
            <div class="box-content">
                <div class="description"><p>A newsletter is a regularly distributed publication that is generally about one main topic of interest to its subscribers.</p></div>
                <div class="input-group">
                    <input class="form-control email" placeholder="Your email address" name="email" type="text">
                	<div class="input-group-btn">
                    	<button type="submit" name="submitNewsletter" class="btn btn-custom" value="Subscribe">
                    	<span class="fa fa-paper-plane"></span></button>
                	</div>
                </div>
             
                <input value="1" name="action" type="hidden">
                <div class="valid"></div>
                            </div>	
		</form>
</div>
<script type="text/javascript"><!--

$( document ).ready(function() {

	$('#formNewLestter').on('submit', function() {
		var email = $('.email').val();
		$(".success_inline, .warning_inline, .error").remove();
		if(!isValidEmailAddress(email)) {				
			$('.valid').html("<div class=\"error alert alert-danger\">Email is not valid!<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div></div>");
			$('.email').focus();
			return false;
		}
	
		var url = "http://sarmicrosystems.in/oc/index.php?route=extension/module/pavnewsletter/subscribe";
		$.ajax({
			type: "post",
			url: url,
			data: $("#formNewLestter").serialize(),
			dataType: 'json',
			success: function(json)
			{
				$(".success_inline, .warning_inline, .error").remove();
				if (json['error']) {
					$('.valid').html("<div class=\"warning_inline alert alert-danger\">"+json['error']+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div>");
				}
				if (json['success']) {
					$('.valid').html("<div class=\"success_inline alert alert-success\">"+json['success']+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div>");
				}
			}
		}); return false;
	
	}); //end submmit
}); //end document

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
--></script>        </div>
                  <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="box pav-custom">              
              <div class="panel-heading">
                <h4 class="panel-title">Contact Us</h4>
              </div>
              <div class="box-content">
                <div class="box-content">  	<div class="description">PO Box 16122 Collins Street West Victoria 8007 Australia</div>  	<ul class="list contact">  		<li><span class="iconbox"><i class="fa fa-phone">&nbsp;</i>+844 123 456 78</span></li>  		<li><span class="iconbox"><i class="fa fa-mobile-phone">&nbsp;</i>+844 123 456 79</span></li>  		<li><span class="iconbox"><i class="fa fa-envelope">&nbsp;</i>contac@yourcompany.com</span></li>  	</ul>  </div>              </div>
            </div>
          </div>        
        
                <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box pav-custom">
            <div class="panel-heading">
              <h4 class="panel-title">follow us</h4>
            </div>
              <div class="box-content">
              <ul class="list folow">  					<li><i class="fa fa-facebook">&nbsp;</i><a data-original-title="Facebook" data-placement="top" href="#" title=""><span>Facebook</span> </a></li>  					<li><i class="fa fa-twitter">&nbsp;</i><a data-original-title="Twitter" data-placement="top" href="#" title=""><span>Twitter</span> </a></li>  					<li><i class="fa fa-google-plus">&nbsp;</i><a data-original-title="Google +" data-placement="top" href="#" title=""><span>Google +</span> </a></li>  					<li><i class="fa fa-youtube">&nbsp;</i><a data-original-title="Youtube" data-placement="top" href="#" title=""><span>Youtube</span> </a></li>  				</ul>            </div>
          </div>
        </div>        
              </div>
  </div>
</div>
    <div class="footer-bottom " id="pavo-footer-bottom">
  <div class="container">
    <div class="container-inner">
    <div class="row">
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">My Account</h4>
          </div>
          <ul class="list-unstyled list">
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/account">My Account</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/order">Order History</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist">Wish List</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/newsletter">Newsletter</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=product/special">Specials</a></li>
          </ul>
        </div>
      </div>
            <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">Information</h4>
          </div>
          <ul class="list-unstyled list">
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=4">About Us</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=6">Delivery Information</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=3">Privacy Policy</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=5">Terms &amp; Conditions</a></li>
                      </ul>
        </div>
      </div>
            
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">Customer Service</h4>
          </div>
          <ul class="list-unstyled list">
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/contact">Contact Us</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/return/add">Returns</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/sitemap">Site Map</a></li>
             <li><a href="http://sarmicrosystems.in/oc/index.php?route=product/manufacturer">Brands</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/voucher">Gift Certificates</a></li>
          </ul>
        </div>
      </div>


              <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box contact-us">
            <div class="panel-heading">
              <h4 class="panel-title">Business Hours</h4>
            </div>
              <div class="box-content">
              <ul class="list-unstyled list">  			            <li>Mon - Fri: ---------------8am - 5pm</li>  			            <li>Sat: ----------------------8am - 11am</li>  			            <li>Sun: ------------------------- Closed</li>  			            <li>We work all the holidays</li>  			        </ul>            </div>
          </div>
        </div>        
      
      </div>
    </div>
  </div>
</div>

</footer>
 
 
<div id="powered">
  <div class="container">
    <div class="copyright pull-left">
          Powered By <a href="http://www.opencart.com">OpenCart</a><br> Your Store © 2017. 
        </div> 

          <div class="paypal pull-right">
        <img src="image/catalog/demo/payment.png" alt="">      </div>
     
</div>


</div>

  
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>

<div id="pav-paneltool" class="hidden-sm hidden-xs">
	<div class="paneltool themetool">
		<div class="panelbutton">
			<i class="fa fa-cog"></i>
		</div>
		<div class="panelcontent ">
			<div class="panelinner">
				<h4>Panel Tool</h4>
				<form action="/oc/index.php?route=checkout/checkout" method="post" class="clearfix"><div class="clearfix">
					<div class="group-input row">
						<label class="col-sm-4">Theme</label>
						<select class="col-sm-8" name="userparams[skin]">
							<option value="">default</option>
														<option value="blue">blue</option>
														<option value="brown" selected="selected">brown</option>
														<option value="green">green</option>
														<option value="greenlight">greenlight</option>
													</select>					
					</div>
					<div class="group-input row">
						<label class="col-sm-4">Layout</label>
						<select class="col-sm-8" name="userparams[layout]">
														<option value="fullwidth" selected="selected">Full Width</option>
														<option value="boxed-lg">Boxed Desktop Large</option>
													</select>					
					</div>

					<hr>
					<div class="clearfix"></div>
					<p class="group-input pull-right">
						<button value="Apply" class="btn btn-small" name="btn-save" type="submit">Apply</button>
						<a class="btn btn-small" href="http://sarmicrosystems.in/oc/?pavreset=?"><span>Reset</span></a>
					</p>
				</div></form>
			</div>	
		</div>
	</div>
	
	<div class="paneltool editortool">
		<div class="panelbutton">
			<i class="fa fa-adjust"></i>
		</div>
		<div class="panelcontent editortool"><div class="panelinner">
							
				<h4>Live Theme Editor</h4>					
									<div class="clearfix" id="customize-body">			
						<ul class="nav nav-tabs" id="myTab">
														<li class="active"><a href="#tab-selectors">Layout Selectors</a></li>		
														<li><a href="#tab-elements">Layout Elements</a></li>		
													</ul>										
						<div class="tab-content"> 
														<div class="tab-pane active" id="tab-selectors">
																<div class="accordion" id="custom-accordionselectors">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsebody">
												Body Content	 
											</a>
										</div>

			                            <div id="collapsebody" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 													  <div class="form-group background-images"> 
															<label>Background Image</label>
															<a class="clear-bg btn btn-small" href="#">Clear</a>
															<input value="" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="background-image" readonly="readonly" type="hidden">

															<div class="clearfix"></div>
															 <p><em style="font-size:10px">Those Images in folder YOURTHEME/img/patterns/</em></p>
															<div class="bi-wrapper clearfix">
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png" data-val="../../img/patterns/pattern17.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png" data-val="../../img/patterns/pattern18.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png" data-val="../../img/patterns/pattern19.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png" data-val="../../img/patterns/pattern20.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png">

															</div>
																				                                    </div>
					                                  </div>
					                                  

																									 					                                   <div class="form-group">
						                                   <label>Font-Size</label>
						                                  	<select name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="font-size">
																<option value="">Inherit</option>
																												<option value="9">9</option>
																														<option value="10">10</option>
																														<option value="11">11</option>
																														<option value="12">12</option>
																														<option value="13">13</option>
																														<option value="14">14</option>
																														<option value="15">15</option>
																														<option value="16">16</option>
																															</select>
																<a href="#" class="clear-bg btn btn-small">Clear</a>
					                                  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Font-Family</label>
															<input value="" size="10" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="font-family" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" class="input-setting" data-selector="body a,body #page a" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsetop-bar">
												Top Bar	 
											</a>
										</div>

			                            <div id="collapsetop-bar" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" class="input-setting" data-selector="#topbar" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" class="input-setting" data-selector="#topbar a,#topbar .dropdown .dropdown-toggle" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" class="input-setting" data-selector="#topbar a:hover,#topbar .dropdown:hover .dropdown-toggle" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepav-mainnav">
												Main Menu	 
											</a>
										</div>

			                            <div id="collapsepav-mainnav" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" class="input-setting" data-selector="#pav-mainnav,#pav-mainnav .navbar-default" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Link</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" class="input-setting" data-selector="#pav-megamenu .navbar-nav li a" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-top">
												Footer top	 
											</a>
										</div>

			                            <div id="collapsefooter-top" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-top][]" data-match="footer-top" class="input-setting" data-selector=".footer-top" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-center">
												Footer Center	 
											</a>
										</div>

			                            <div id="collapsefooter-center" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" class="input-setting" data-selector=".footer-center,.footer-center .container" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" class="input-setting" data-selector=".footer-center .container .column,.footer-center .container .column .panel-title" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" class="input-setting" data-selector=".footer-center .container .column a" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" class="input-setting" data-selector=".footer-center .container .column a:hover" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg newsletter</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" class="input-setting" data-selector=".btn-custom" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepowered">
												Powered	 
											</a>
										</div>

			                            <div id="collapsepowered" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" class="input-setting" data-selector="#powered .container" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" class="input-setting" data-selector="#powered .container" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" class="input-setting" data-selector="#powered .container a" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	 </div>
															</div>
						   							<div class="tab-pane" id="tab-elements">
																<div class="accordion" id="custom-accordionelements">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionelements" href="#collapseproduct">
												Products	 
											</a>
										</div>

			                            <div id="collapseproduct" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Product Name</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector=".product-block .name a" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price New</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector=".price .price-new" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price Old</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector=".price .price-old" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Icon Color</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector="
				.cart .fa, .wishlist .fa, .compare .fa, .quick-view .fa,.zoom .fa
			" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector=".product-label" data-attrs="color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" class="input-setting" data-selector=".product-label.sale-exist" data-attrs="background-color" readonly="readonly" type="text"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	 </div>
															</div>
						   						</div>   
					</div>    
				</div>
		</div>	 
	</div>

</div> 
 
<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 

</script>
</div>
<div class="sidebar-offcanvas visible-xs visible-sm">
    <div class="offcanvas-inner panel-offcanvas">
        <div class="offcanvas-heading clearfix">
            <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasmenu">
		<ul class="nav navbar-nav megamenu"><li class="home"><a href="?route=common/home"><span class="menu-title">Home</span></a></li><li class="parent dropdown  aligned-left"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61"><span class="menu-title">Fashion</span><b class="caret"></b></a><div class="dropdown-menu level1" style="width:800px"><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-xs-12 col-sm-12 col-md-3" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61"><span class="menu-title">Mens</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_70"><span class="menu-title">Shirt</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67"><span class="menu-title">T-Shirt</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=69_62"><span class="menu-title">Jeans</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_71"><span class="menu-title">cap</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_66"><span class="menu-title">Watches</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Shoes</span></a></li></ul></div></div></div></div></div></li></ul></div></div><div class="mega-col col-xs-12 col-sm-12 col-md-3" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=20"><span class="menu-title">Women</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61"><span class="menu-title">T-Shirt</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Shoes</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">watch</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_72_73"><span class="menu-title">Dress</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">shandel</span></a></li></ul></div></div></div></div></div></li></ul></div></div></div></div></div></li><li class="parent dropdown  aligned-left"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=20"><span class="menu-title">Electronics</span><b class="caret"></b></a><div class="dropdown-menu level1" style="width:700px"><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-xs-12 col-sm-12 col-md-4" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Mobiles &amp; Accessories</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="Mi-Note4-Mobile"><span class="menu-title">Mi-Note4-Mobile</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Camera</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Ac</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Computer</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Telivision</span></a></li></ul></div></div></div></div></div></li></ul></div></div><div class="mega-col col-xs-12 col-sm-12 col-md-6" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Laptop &amp; Accessories</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Trimmer</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Business Laptops</span></a></li></ul></div></div></div></div></div></li></ul></div></div></div></div></div></li><li class="parent dropdown  aligned-fullwidth"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=33"><span class="badges new">new</span><span class="menu-title">Grocery</span><b class="caret"></b></a><div class="dropdown-menu level1" style="width:700px"><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-xs-12 col-sm-12 col-md-3" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=33"><span class="menu-title">Vegetable</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Cauliflower</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Capsicums</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Tomato</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Pressure Cookers</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Pans</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">karela</span></a></li></ul></div></div></div></div></div></li></ul></div></div><div class="mega-col col-xs-12 col-sm-12 col-md-2" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Biscuit</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Parle-G </span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Tiger</span></a></li></ul></div></div></div></div></div></li></ul></div></div><div class="mega-col col-xs-12 col-sm-12 col-md-2" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Oil</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Coconut Oil</span></a></li></ul></div></div></div></div></div></li></ul></div></div></div></div></div></li><li class="parent dropdown  aligned-left"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=34"><span class="menu-title">Home &amp; Kitchen</span><b class="caret"></b></a><div class="dropdown-menu level1" style="width:700px"><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-xs-12 col-sm-12 col-md-4" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Kitchen and Dining</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Coffee Mugs</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Kitchen Containers</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Dining Sets</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Bar &amp; Glassware</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Gas Stoves</span></a></li></ul></div></div></div></div></div></li></ul></div></div><div class="mega-col col-xs-12 col-sm-12 col-md-4" data-type="menu"><div class="mega-col-inner"><ul><li class="parent dropdown-submenu mega-group"><i class="click-canavs-menu zmdi zmdi-plus"></i><a class="dropdown-toggle" data-toggle="dropdown" href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Lunch Boxes</span><b class="caret"></b></a><div class="dropdown-mega level2"><div class="dropdown-menu-inner"><div class="row"><div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu"><div class="mega-col-inner"><ul><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Sofa Beds </span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Gifts &amp; Gift Sets</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Floor Coverings</span></a></li><li class=" mega-group"><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=0"><span class="menu-title">Bed-Sheet</span></a></li></ul></div></div></div></div></div></li></ul></div></div></div></div></div></li><li class=""><a href="?route=information/contact"><span class="menu-title">Contact</span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li><li class=""><a href=""><span class="menu-title"></span></a></li></ul>	</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#" style="display: block;"><i class="fa fa-angle-up"></i>TOP</a></div>
</div><div class="colorpicker" id="collorpicker_74"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_367"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_477"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_880"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_297"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_437"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_992"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_413"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_301"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_373"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_904"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_698"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_570"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_992"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_321"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_774"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_449"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_289"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_114"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_252"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_178"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_760"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_428"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_978"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div><div class="colorpicker" id="collorpicker_392"><div class="colorpicker_color" style="background-color: rgb(255, 0, 0);"><div><div style="left: 150px; top: 0px;"></div></div></div><div class="colorpicker_hue"><div style="top: 150px;"></div></div><div class="colorpicker_new_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_current_color" style="background-color: rgb(255, 0, 0);"></div><div class="colorpicker_hex"><input maxlength="6" size="6" type="text"></div><div class="colorpicker_rgb_r colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input maxlength="3" size="3" type="text"><span></span></div><div class="colorpicker_submit"></div></div>
</body></html>