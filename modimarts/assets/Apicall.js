var notyf = new Notyf;
function ApiAddtocard() {

	var user=$('#User_id').val();
	var proname=$('#proname').val();
	var pro_id=$('#pro_id').val();
	var shopping=$('#shopping').val();
	var sku_id=$('#sku_id').val();
	var pro_img=$('#pro_img').val();
    var image="https://thebrandtadka.com/images_inventory_products/front_images/"+pro_img;
	var color=$('#selectcolor').val();
	var size=$('#selectsize').val();
	var price=$('#price').val();
    var quantity=$("#quantity").val();
    var HSN=$("#HSN").val();
    var Mrp=$("#Mrp").val();
    var Discount=$("#Discount").val();

    if(price>1000){
    var GST=$("#GST2").val();
    }
    else
    {
    var GST=$("#GST").val();
    }

	// add_to_card(sku_id,pro_id,price,pro_img,proname,prod_id,'shopping',shopping);

    if (user != '') {

        // var callurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=addToCart&token=8cc6be81ea4f574acf24aa1aaae2252d&product_id="+pro_id+"&member_id="+user+"&size_id="+size+"&color_id="+color;
        // var parameters="hello";
        // var variables="variables";
        //  $.ajax({
        //             type: 'POST',
        //             url:'https://allmart.world/api_addtocart.php',
        //             data:'url='+callurl+'&parameters='+parameters+'&variables='+variables,
        //             success: function(msg){ debugger;
        //            var res= JSON.parse(msg);

        //            var status=res.Status;
        //            if(status=='Success')
        //            {
                     // alert(GST);
                     // alert(HSN);
                     apiaddtocart(sku_id,pro_id,price,image,proname,sku_id,'shipping_out_state',shopping,quantity,1,color,size,GST,HSN,Mrp,Discount);
                        
                //    }
                //    else
                //    {
                //       notyf.error("sorry your session has been expired");
                //    }
                //    }
                // });
    }
    else
    {
     notyf.error("Please Login ");
    }
}

function apiaddtocart(t, r, a, e, c, o, s, n, d,f,b,v,g,h,m,z) {
    try {
        "" == d && (d = 1), $.ajax({
            type: "POST",
            url: "https://allmart.world/addcart.php",
            data: "prodid=" + r + "&cid=" + t + "&price=" + a + "&image=" + e + "&pname=" + c + "&pid=" + o + "&shipping=" + s + "&shipping_charges=" + n + "&quantity=" + d+"&outside_product="+f+"&color="+b+"&size="+v+"&gst="+g+"&hsn="+h+"&mrp="+m+"&discount="+z,
            success: function(t) {
                console.log(t), 2 == t ? notyf.error("sorry your session has been expired") : 1 == t ? notyf.success("Product added to cart successfully !") : notyf.error("Error  Please  try again after some time")
            }
        }), showcart(), loadcart(), showcartproduct()
    } catch (t) {
        alert(t)
    }
}