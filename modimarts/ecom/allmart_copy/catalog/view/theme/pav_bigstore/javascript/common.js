function wpo_play_owl_carousel( owl ){
  var $ = jQuery; 
  var config = {
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : $(owl).data( 'pagination' )
  }; 
     
  if( $(owl).data('show') == 1 ){
      config.singleItem = true;
  }else {
      config.items = $(owl).data( 'show' );
  }
  $(owl).owlCarousel( config );
  $('.left',$(owl).parent()).click(function(){
        owl.trigger('owl.prev');
        return false; 
  });
  $('.right',$(owl).parent()).click(function(){
      owl.trigger('owl.next');
      return false; 
  });
}
// 1. Jquery Framework ( not edit )
$(document).ready(function() {

  $(".dropdown-toggle-overlay").click( function(){
         $($(this).data( 'target' )).addClass("active");
  } );

       $(".dropdown-toggle-button").click( function(){
             $($(this).data( 'target' )).removeClass("active");
             return false;
      } );
  // Click top scroll
  $('#top').click(function(){
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  });

  // Fix First Click Menu
  $(document.body).on('click', '.megamenu [data-toggle="dropdown"], .verticalmenu [data-toggle="dropdown"]' ,function(){
      if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
          window.location.href = this.href;
      }
  });

  // Automatic apply  OWL carousel
  $(".owl-carousel-play .owl-carousel").each( function(){
    var owl = $(this);
    wpo_play_owl_carousel( owl );
  }); 

  // Adding the clear Fix
  cols1 = $('#column-right, #column-left').length;
    
  if(cols1 == 2){
    $('#content .product-layout:nth-child(2n+2)').after('<div class="clearfix visible-md visible-sm"></div>');
  }else if(cols1 == 1){
    $('#content .product-layout:nth-child(3n+3)').after('<div class="clearfix visible-lg"></div>');
  }else{
    $('#content .product-layout:nth-child(4n+4)').after('<div class="clearfix"></div>');
  }



	// Product List
	$('#list-view').click(function() {
		$('#content .product-grid > .clearfix').remove();

		$('#content .row > .product-grid').attr('class', 'product-layout product-list col-xs-12');

		localStorage.setItem('display', 'list');
	});

	// Product Grid
	$('#grid-view').click(function() {
		// What a shame bootstrap does not take into account dynamically loaded columns
		var cols = $('#column-right, #column-left').length;

		if (cols == 2) {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		} else if (cols == 1) {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-4 col-xs-12');
		} else {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
		}

		localStorage.setItem('display', 'grid');
	});

	if (localStorage.getItem('display') == 'list') {
		$('#list-view').trigger('click');
	} else {
		$('#grid-view').trigger('click');
	}






  // Offcanvas Click
  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  $('#offcanvasmenu a.dropdown-toggle').parent().prepend('<i class="click-canavs-menu zmdi zmdi-plus"></i>');
   $( "body" ).on( "click", "i.click-canavs-menu.zmdi-plus", function() {
     $this = $(this);
     $this.removeClass('zmdi-plus').addClass('zmdi-minus');
     $this.parent().find('.dropdown-menu:first').toggle();
 });

 $( "body" ).on( "click", "i.click-canavs-menu.zmdi-minus", function() {
     $(this).removeClass('zmdi-minus').addClass('zmdi-plus');
     $(this).parent().find('.dropdown-menu:first').toggle();
 });
 
  // Offcanvas Search
  $('#offcanvas-search input[name=\'search\']').parent().find('button').on('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';
    var value = $('.sidebar-offcanvas input[name=\'search\']').val();
    if (value) {
      url += '&search=' + encodeURIComponent(value);
    }
    location = url;
  });

  // offcanvase search trigger click
  $('#offcanvas-search input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('.sidebar-offcanvas input[name=\'search\']').parent().find('button').trigger('click');
    }
  });

  // magnificPopup Product Zoom
  $('.product-zoom').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    image: { verticalFit: true }
  });

  $('.iframe-link').magnificPopup({
    type:'iframe'
  });

  // magnificPopup Form Contact, etc...
  $('.popup-with-form').magnificPopup({
    type: 'inline',
    preloader: false,
    focus: '#input-name',
    callbacks: {
      beforeOpen: function() {
        if($(window).width() < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#input-name';
        }
      }
    }
  });

// scroll-to-top button show and hide
    jQuery(document).ready(function(){
        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.scrollup').fadeIn();
            } else {
                jQuery('.scrollup').fadeOut();
        }
    });
    // scroll-to-top animate
    jQuery('.scrollup').click(function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

        
    });
  $('.dropdown-menu input').click(function(e) {
    e.stopPropagation();
  });

   // Grid list switcher at category page
  $("button.btn-switch").bind("click", function(e){
    e.preventDefault();
    var theid = $(this).attr("id");
    var row = $("#products");

    row.removeClass();

    if($(this).hasClass("active")) {
      return false;
    } else {
      if(theid == "list-view"){
        $('#list-view').addClass("active");
        $('#grid-view').removeClass("active");
        // remove class list
        row.removeClass('product-grid');
        // add class gird
        row.addClass('product-list');
        localStorage.setItem('display', 'list');
      }else if(theid =="grid-view"){
        $('#grid-view').addClass("active");
        $('#list-view').removeClass("active");
        // remove class list
        row.removeClass('product-list');
        // add class gird
        row.addClass('product-grid');
        localStorage.setItem('display', 'grid');
      }
    }
  });

  if (localStorage.getItem('display') == 'list') {
    $('#list-view').trigger('click');
  } else {
    $('#grid-view').trigger('click');
  }

  // Quantity Adder at Product page
  $(".quantity-adder .add-action").click(function(){
    if( $(this).hasClass('add-up') ) {  
        $("[name=quantity]",'.quantity-adder').val( parseInt($("[name=quantity]",'.quantity-adder').val()) + 1 );
    }else {
      if( parseInt($("[name=quantity]",'.quantity-adder').val())  > 1 ) {
        $("input",'.quantity-adder').val( parseInt($("[name=quantity]",'.quantity-adder').val()) - 1 );
      }
    }
  });
  
}); // end document


// 2. Customize other function script
$(document).ready(function(){
  
  //search
  $('#search input[name=\'search\']').parent().find('button').on('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';
    var value = $('#search input[name=\'search\']').val();
    if (value) {
      url += '&search=' + encodeURIComponent(value);
    }
    location = url;
  });
  $('#search input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('#search input[name=\'search\']').parent().find('button').trigger('click');
    }
  });



});// end document

// Cart add remove functions
var cart = {
  'add': function(product_id, quantity) { 
    $.ajax({
      url: 'index.php?route=checkout/cart/add',
      type: 'post',
      data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      success: function(json) {
        $('.alert, .text-danger').remove();

        if (json['redirect']) {
          location = json['redirect'];
        }

        if (json['success']) {

          $('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

          $('#cart #cart-total').html(json['total']);

          $('html, body').animate({ scrollTop: 0 }, 'slow');

          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }
      }
    });
  },
  'update': function(key, quantity) {
    $.ajax({
      url: 'index.php?route=checkout/cart/edit',
      type: 'post',
      data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      success: function(json) {
        $('#cart > button').button('reset');

        $('#cart #cart-total').html(json['total']);
        if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
          location = 'index.php?route=checkout/cart';
        } else {
          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }
      }
    });
  },
  'remove': function(key) {
    $.ajax({
      url: 'index.php?route=checkout/cart/remove',
      type: 'post',
      data: 'key=' + key,
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        $('#cart #cart-total').html(json['total']);

        if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
          location = 'index.php?route=checkout/cart';
        } else {
          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }
      }
    });
  }
}

var wishlist = {
  'add': function(product_id) {
    $.ajax({
      url: 'index.php?route=account/wishlist/add',
      type: 'post',
      data: 'product_id=' + product_id,
      dataType: 'json',
      success: function(json) {
        $('.alert').remove();

        if (json['success']) {
          $('#notification').html('<div class="alert alert-info"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['info']) {
          $('#notification').html('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        $('#wishlist-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    });
  },
  'remove': function() {

  }
}

var compare = {
  'add': function(product_id) {
    $.ajax({
      url: 'index.php?route=product/compare/add',
      type: 'post',
      data: 'product_id=' + product_id,
      dataType: 'json',
      success: function(json) {
        $('.alert').remove();

        if (json['success']) {
          $('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

          $('#compare-total').html(json['total']);

          $('html, body').animate({ scrollTop: 0 }, 'slow');
        }
      }
    });
  },
  'remove': function() {

  }
}

