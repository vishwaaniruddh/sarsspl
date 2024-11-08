$(document).ready(function(){
    
generateid();
updatecart();
});

function generateid()
{
//alert("testdfsf");
try
{
$.ajax({
   type: 'POST',  
url:'setuseridpg.php',
data:'',

success: function(msg){
//alert(msg);
updatecart();
}
});

}catch(exdce)
{
    //alert(exdce);
}
}

function addcart(prodid,cid)
{
try
{
   //alert("this1");
$.ajax({
   type: 'POST',    
url:'addcart.php',
data:'pid='+prodid+'&cid='+cid,
success: function(msg){
alert(msg);
updatecart();
 
//addincart();
//funcs('','');
if(msg==2)
{
    toastfunc("sorry your session has been expired");
    //alert("sorry your session has been expired");
}
else if(msg==1)
{
    toastfunc("Product added to cart successfully ");
}
else
{
    toastfunc("Error  Please  try again after some time");
}

//document.getElementById('show').innerHTML=msg;
    }
});

}catch(exc)
{
    alert(exc);
}
}

function updatecart()
{
    try
    {
        $.ajax({
           type: 'POST',    
            url:'showcartpg.php',
            data:'',
            success: function(msg){
            // alert(msg);
            document.getElementById('cartshowid').innerHTML=msg;
            }
        });
    }catch(exc)
    {
        alert(exc);
    }
}
function remfromcart(cartid)
{
    try
    {
        $.ajax({
            type: 'POST',    
            url:'remvcart.php',
            data:'cartid='+cartid,

            success: function(msg){
                //alert(msg);
                if(msg==2)
                {
                    // alert("sorry your session has been expired");
                    toastfunc("sorry your session has been expired");
                }
                else if(msg==1){
                    updatecart();
                    toastfunc("Product removed from cart");
                } else {
                    toastfunc("Error removing from cart");
                }
                updatecart();
                //document.getElementById('show').innerHTML=msg;
            }
        });
    }catch(exc){
        alert(exc);
    }  
}

function toastfunc(msg)
{
    //alert("hihihi"+msg)
    var x = document.getElementById("notification");
    // x.innerHtml="";
    x.innerHTML=msg;
    x.className = "showalrt";
    setTimeout(function(){ x.className = x.className.replace("showalrt", ""); }, 5000);

}
function toastreffunc()
{
    var x = document.getElementById("notification");
    // x.innerHtml="";
    x.innerHTML=msg;
    x.className = "";
    //setTimeout(function(){ x.className = x.className.replace("showalrt", ""); }, 5000);
}
//========================================================

function wishlistfunc(prodid,cat)
{ 
    try
    {
       //alert("this1");
        $.ajax({
        type: 'POST',    
        url:'add_wishlist.php',
        data:'pid='+prodid+'&cat='+cat,
        success: function(msg){
            //alert(msg);
            //updatecart();
            //addincart();
            //funcs('','');
            if(msg==2)
            {
                // alert("alredy exist!!");
                toastfunc("This product is already in your wishlist");
            }
            else if(msg==1)
            {
                toastfunc("Product added to your wishlist");
            }
            else if(msg==3)
            {
                toastfunc("Please login to add product to your wishlist");
            }else if(msg==4)
            {
                // alert("sorry your session has been expired");
                toastfunc("sorry your session has been expired");
        } else {
            toastfunc("Error");
        }
        //document.getElementById('show').innerHTML=msg;
             }
    });
    }catch(exc)
    {
    alert(exc);
    }
}
function comparefunc(prid,cat)
{
    try
    {
        // alert("this2");
        $.ajax({
        type: 'POST',    
        url:'processcompare.php',
        data:'prid='+prid+'&cat='+cat,
        success: function(msg){
            //alert(msg);
            if(msg==2)
            {
                // alert("sorry your session has been expired");
                toastfunc("sorry your session has been expired");
            }
            else if(msg==3)
            {
                //toastfunc();
                toastfunc("Product is already added to compare list");
            } else if(msg==4) {
                //toastfunc();
                toastfunc("Maximum 4 products can be added for comparison");
            }
            else if(msg==1)
            {
                //toastfunc();
                toastfunc("Product added to compare list");
            } else {
                toastfunc("Error adding product to compare");
            }
            updatecart();
            //document.getElementById('show').innerHTML=msg;
        }
    });
}catch(exc)
{
alert(exc);
}
}

function removecompare(compareid)
{
    try
    {
        // alert("this2");
        $.ajax({
        type: 'POST',    
        url:'processremovecompare.php',
        data:'compareid='+compareid,
        success: function(msg){
        //alert(msg);
        if(msg==2)
        {
           // alert("sorry your session has been expired");
           toastfunc("sorry your session has been expired");
        }
        else if(msg==1)
        {
            //toastfunc();
            toastfunc("Product removed from compare list");
        } else {
            toastfunc("Error removing product from compare");
        }
        //updatecart();
        window.location.reload();
        //document.getElementById('show').innerHTML=msg;
    }
});

}catch(exc)
{
    alert(exc);
}  
}
//==================================================================
function removewishlist(wishlistid)
{
    try
    {
        // alert("this2");
        $.ajax({
            type: 'POST',    
            url:'processremovewishlist.php',
            data:'wishlistid='+wishlistid,
    
            success: function(msg){
                //alert(msg);
                if(msg==2)
                {
                   // alert("sorry your session has been expired");
                   toastfunc("sorry your session has been expired");
                } else if(msg==1) {
                    //toastfunc();
                    toastfunc("Product removed from wish list");
                } else {
                    toastfunc("Error removing product from wish list");
                }
                //updatecart();
                window.location.reload();
                //document.getElementById('show').innerHTML=msg;
            }
        });
    }catch(exc)
    {
        alert(exc);
    }  
}