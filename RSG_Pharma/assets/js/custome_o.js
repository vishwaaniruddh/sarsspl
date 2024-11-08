                    function base_url() {
                        var pathparts = location.pathname.split('/');
                            var url = location.origin+'/'+pathparts[1].trim('/')+'/'; 
                       
                        return url;
                    }

                      var hostname = window.location.origin;
                      var base_url= base_url();

                  //  $("#productdescrip").typeahead({
                  //          source: function (query, result) {
                  //         $.ajax({
                  //             url: base_url+"Account/productsearch",
                  //             data: 'proname=' + query,
                  //             dataType: "json",
                  //             type: "POST",
                  //             success: function (data) {
                  //                 result($.map(data, function (item) {
                  //                     return item;
                  //                 }));
                  //             }
                  //         });
                  //     },
                  //     updater: function(item) {
                  //         Addtolist();                         
                  //         return item;
                  //     }
                  // });



                  //  Function For Add Purchase Product From Database
                   function Addtolist(id)
                   {
                     
                   var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :id};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Account/productdetails",
                          data: myKeyVals,
                          success: function(resultData) { 
                            //  alert(resultData);
                         var data = $.parseJSON(resultData);
                           var productname=data.name;
                           var offer_price=data.unit_price;
                           var pro_id=data.item_number;
                           var category_id=data.category;
                           var GST=data.GST;
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1; 

                            var rowhtml='<tr id="rowid_'+count+'"><td><input type="hidden" value="'+pro_id+'" name="item_no[]" id="item_no'+count+'"/><input type="hidden" value="'+category_id+'" name="item_cat[]"/> <input class="form-control" name="myitemid[]" id="itemname_'+count+'" value="'+productname+'" title="'+productname+'"  type="text" readonly ></td><td><input class="form-control" name="batchno[]" type="text"></input></td><td><input type="text" class="form-control date"    name="expirydate[]"></td><td><input class="form-control cprice" id="cprice'+count+'" onblur="subtotal()" name="cprice[]" value="0" type="text"><td><input class="form-control crate" id="crate'+count+'" onblur="subtotal()" name="crate[]" value="0" type="text"></input></td><td><input class="form-control qty" id="qty'+count+'" name="qty[]" onblur="subtotal()" type="text"></input></td><td><input class="form-control scheme_qty" id="scheme_qty'+count+'" name="scheme_qty[]" onblur="subtotal()" type="text" value="0"></input></td><td><input class="form-control GST" id="GST'+count+'" name="GST[]" value='+GST+' onkeyup="subtotal()" type="text" readonly></input></td><td><input class="form-control subtotal" id="subtotal'+count+'" name="ptotalamt[]" onkeyup="subtotal()" type="text" readonly></input></td><td><input class="form-control discount" id="discount'+count+'" name="discount[]" onkeyup="subtotal()" type="text" ></input></td><td><a class="btn btn-danger text-white" onclick="deleterow('+count+')"><i class="uil-trash-alt"></i></a></td></tr>';
                            $("#addrow").append(rowhtml);

                            
                            $("#productdescrip").val("");
                            $("#rowcount").val(count);
                             $(".date").datepicker({                                
                                autoclose: true,
                                format: "yyyy-mm",
                                startView: "months", 
                                minViewMode: "months"
                            });
                           
                          }
                    });
                   }
                   }



                    // Function For the add product In the list from the Database
                   function Addtolist1(id)
                   {
                     var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :id};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Account/productdetails",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData);
                           var productname=data.name;
                           var offer_price=data.unit_price;
                           var pro_id=data.item_id;
                           var category_id=data.category;
                           var expiry_date=data.expiry_date;
                           var GST=data.GST;
                          
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1; 

                            var rowhtml='<tr id="rowid_'+count+'"><td><input type="hidden" value="'+pro_id+'" name="item_no[]" id="item_no'+count+'"/><input type="hidden" value="'+category_id+'" name="item_cat[]"/> <input class="form-control" name="myitemid[]" id="itemname_'+count+'" value="'+productname+'" title="'+productname+'"  type="text" readonly ></td><td><select class="form-control"  name="batchno[]" id="batchno_'+count+'" onchange="getexpiry('+count+')" required ><option>Select Batch</option></select></td><td><input type="text" class="form-control date"  name="expirydate[]"  id="expiry_date'+count+'" readonly></input></td><td><input class="form-control crate" id="crate'+count+'" onblur="subtotal()" name="crate[]" value="0" type="text"></input></td><td><input class="form-control qty" id="qty'+count+'" name="qty[]" onblur="subtotal()" type="text"></input></td><td><input class="form-control GST" id="GST'+count+'" name="GST[]" value='+GST+' onkeyup="subtotal()" type="text" readonly></input></td><td><input class="form-control subtotal" id="subtotal'+count+'" name="totalamt" onkeyup="subtotal()" type="text" readonly></input></td><td><input class="form-control discount" id="discount'+count+'" name="discount[]" onkeyup="subtotal()" type="text" ></input></td><td><a class="btn btn-danger text-white" onclick="deleterow('+count+')"><i class="uil-trash-alt"></i></a></td></tr>';
                            $("#addrow").append(rowhtml);
                            $("#productdescrip").val("");
                            $("#rowcount").val(count);
                            getbatch(count);
                           
                          }
                    });
                   }
                   }

                    // Function For the add product In the list from the Database For Retailer
                   function AddtolistTwo(id)
                   {
                       
                     var productdescrip= $("#productdescrip").val();
                     var n = productdescrip.length;
                    //  alert(n);
                     if (n>2) {
                      var myKeyVals = { proname :id};
                     
                     $.ajax({
                         
                          type: 'POST',
                          url: base_url+"Account/productdetails",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData);
                           var productname=data.name;
                           var pro_id=data.item_id;
                           var category_id=data.category;
                          
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1; 

                            var rowhtml='<tr id="rowid_'+count+'"><td><input type="hidden" value="'+pro_id+'" name="item_no[]" id="item_no'+count+'"/><input type="hidden" value="'+category_id+'" name="item_cat[]"/> <input class="form-control" name="myitemid[]" id="itemname_'+count+'" value="'+productname+'" title="'+productname+'"  type="text" readonly ></td><td><select class="form-control"  name="batchno[]" id="batchno_'+count+'" onchange="getexpiryTwo('+count+')" required ><option>Select Batch</option></select></td><td><input type="text" class="form-control date"  name="expirydate[]"  id="expiry_date'+count+'" readonly></input></td><td><input class="form-control crate" id="crate'+count+'" onblur="subtotalforTwo()" name="crate[]" value="0" type="text"></input></td><td><input class="form-control qty" id="qty'+count+'" name="qty[]" onblur="subtotalforTwo()" type="text"></input></td></input></td><td><input class="form-control subtotal" id="subtotal'+count+'" name="totalamt" onkeyup="subtotalforTwo()" type="text" readonly></input></td><td><a class="btn btn-danger text-white" onclick="deleterow('+count+')"><i class="uil-trash-alt"></i></a></td></tr>';
                            $("#addrow").append(rowhtml);
                            $("#productdescrip").val("");
                            $("#rowcount").val(count);
                            getbatchTwo(count);
                           
                          }
                    });
                   }
                   }
                    //  Get batchno For Sale Bill First
                   function getbatch(count)
                   {
                    var productid=$("#item_no"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Sale/GetBatch",
                          data: myKeyVals,
                          success: function(resultData) { 
                          // alert(resultData);  
                          $("#batchno_"+count).append(resultData);                         
                          }
                    });
                   }
                    //  Get batchno For Sale Bill Two
                   function getbatchTwo(count)
                   {
                    var productid=$("#item_no"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Sale/GetBatch",
                          data: myKeyVals,
                          success: function(resultData) { 
                          // alert(resultData);  
                          $("#batchno_"+count).append(resultData);                         
                          }
                    });
                   }
                    //  Get Expiry For Sale First 
                   function getexpiry(count)
                   {
                      // alert(count);
                    var productid=$("#item_no"+count).val();
                    var batchno=$("#batchno_"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid,batchno:batchno};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Sale/GetExpiry",
                          data: myKeyVals,
                          success: function(resultData) { 
                          // alert(resultData);  
                          console.log(resultData);
						              var res = resultData.split('&');
                          $("#expiry_date"+count).val(res[0]);     
                          $("#crate"+count).val(res[1]);
                          $("#qty"+count).val('1');
                          subtotal();

                          }
                    });

                   }
                    //  Get Expiry For Sale First 
                   function getexpiryTwo(count)
                   {
                      // alert(count);
                    var productid=$("#item_no"+count).val();
                    var batchno=$("#batchno_"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid,batchno:batchno};
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Sale/GetExpiry",
                          data: myKeyVals,
                          success: function(resultData) { 
                          // alert(resultData);  
                          console.log(resultData);
						              var res = resultData.split('&');
                          $("#expiry_date"+count).val(res[0]);     
                          $("#crate"+count).val(res[1]);
                          $("#qty"+count).val('1');
                          subtotalforTwo();

                          }
                    });

                   }

                   
                   function subtotalforTwo()
                    { //alert("hii"); 
                    // debugger;
                      var elem = document.getElementsByClassName('qty');
                       var rate=document.getElementsByClassName('crate');
                       //alert(price);
                       var subto=document.getElementsByClassName('subtotal');
                       var sumamt=0;
                       var sumqty=0;
                       
                       for(i=0;i<elem.length;i++)
                       {
                        var qty_price=0;
                          if(rate.length>0){
                            if(rate[i].value=="")
                              qty_price=0;
                            else
                              qty_price = rate[i].value;
                          
                          }
                        if(elem[i]!=0 || qty_price!=0)
                        {
                          if(qty_price=="")
                          qty_price=0;
                          
                          if(elem[i].value=="")
                          elem[i].value=0;
                          
                         

                       

                         
                        
                          
                          var subtotal=parseFloat(elem[i].value)*parseFloat(rate[i].value);
                        
                          subto[i].value=subtotal;
                           


                          sumamt=parseFloat(sumamt)+parseFloat(subtotal);
                          sumqty=sumqty+parseFloat(elem[i].value); 
                        }  
                      }
                      
                          
                        document.getElementById('totalamt').value=parseFloat(sumamt).toFixed(2);
                        document.getElementById('totalqty').value=sumqty;
                        document.getElementById('payamt').value=parseFloat(sumamt).toFixed(2);
                        
                        
                    
                    }


                   function subtotal()
                    { //alert("hii"); 
                 
                      var elem = document.getElementsByClassName('qty');
                      var elem_1 = document.getElementsByClassName('scheme_qty');
                       var price=document.getElementsByClassName('cprice');
                       var rate=document.getElementsByClassName('crate');
                       var gst=document.getElementsByClassName('GST');
                       var discount=document.getElementsByClassName('discount');
                       var subto=document.getElementsByClassName('subtotal');
                       var sumamt=0; var sumqty=0;
                       
                       for(i=0;i<elem.length;i++)
                       {
                           var qty_price=0;
                          if(price.length>0){
                            if(price[i].value=="")
                              qty_price=0;
                            else
                              qty_price = price[i].value;
                          }
                          console.log(qty_price)
                        if(elem[i].value!=0 || qty_price!=0)
                        {
                          if(qty_price=="")
                          {
                             qty_price=0;
                          
                          }
                         
                          if(elem[i].value=="")
                          {
                             elem[i].value=0;
                          }
                         
                          
                          var schemeqty=0;

                          if(elem_1.length>0){
                            if(elem_1[i].value=="")
                            {
                              schemeqty=0;
                            }
                            else
                            {
                               schemeqty = elem_1[i].value;
                            }
                             
                          }

                         if(gst[i].value=="")
                         {
                              gst[i].value=0;
                         }
                       

                         if(discount[i].value=="")
                         {
                           discount[i].value=0;
                         }
                          
                        
                          
                          var subtotal=parseFloat(elem[i].value)*parseFloat(rate[i].value);
                          var gstp=gst[i].value;
                          var disp=discount[i].value;
                          var subtotalt=parseFloat(subtotal)-parseFloat(disp)


                          var gstamount=CalculateGST(subtotalt,gstp);

                          var netnew=gstamount;
                          subto[i].value=netnew;
                           


                          sumamt=parseFloat(sumamt)+parseFloat(netnew);
                          sumqty=sumqty+parseFloat(elem[i].value)+parseFloat(schemeqty); 
                          console.log(netnew)
                        }  
                      }
                      console.log(sumamt)
                      
                          
                        document.getElementById('totalamt').value=parseFloat(sumamt).toFixed(2);
                        document.getElementById('totalqty').value=sumqty;
                        document.getElementById('payamt').value=parseFloat(sumamt).toFixed(2);
                        
                    }


function calcAmt()
{
  var amt=parseInt(document.getElementById('totalamt').value);
  var type=document.getElementsByClassName('dis');
  var gstty=document.getElementsByClassName('gst');
  var dis=parseInt(document.getElementById('per').value);
  var gst=parseInt(document.getElementById('gstper').value);
  var dicamt=parseInt(document.getElementById('disamt').value);
  var addgst=parseInt(document.getElementById('addgst').value);


  if(type[0].checked)
  {
    if(dis>0){
      disamt=amt*dis/100;
      payamt=Math.round((amt-disamt)+addgst);
      document.getElementById('distype').value="percentage";
      document.getElementById('disamt').value=disamt;
    }
    else
    {
      payamt=Math.round(amt+addgst);
      document.getElementById('distype').value="";
      document.getElementById('disamt').value='0';
    }

  }
  else
  {
    if(dis>0){
    payamt=Math.round((amt-dis)+addgst);
    document.getElementById('distype').value="Rupees";
    document.getElementById('disamt').value=dis;
    }
    else
    {
      payamt=Math.round(amt+addgst);
      document.getElementById('distype').value="";
      document.getElementById('disamt').value='0';
    }


  }
  document.getElementById('payamt').value=payamt;
  // document.getElementById('both').value=payamt;
}

function calcAmtTwo()
{
  var amt=parseInt(document.getElementById('totalamt').value);
  var type=document.getElementsByClassName('dis');
  var dis=parseInt(document.getElementById('per').value);
  var addgst=parseInt(document.getElementById('addgst').value);


  if(type[0].checked)
  {
    if(dis>0){
      disamt=amt*dis/100;
      payamt=parseFloat((amt-disamt)+addgst).toFixed(2);
      document.getElementById('distype').value="percentage";
      document.getElementById('disamt').value=disamt;
    }
    else
    {
      payamt=parseFloat(amt+addgst).toFixed(2);
      document.getElementById('distype').value="";
      document.getElementById('disamt').value='0';
    }

  }
  else
  {
    if(dis>0){
    payamt=parseFloat((amt-dis)+addgst).toFixed(2);
    document.getElementById('distype').value="Rupees";
    document.getElementById('disamt').value=dis;
    }
    else
    {
      payamt=parseFloat(amt+addgst).toFixed(2);
      document.getElementById('distype').value="";
      document.getElementById('disamt').value='0';
    }


  }
  document.getElementById('payamt').value=payamt;
  // document.getElementById('both').value=payamt;
}

function calcAmtgst()
{
  var amt=parseInt(document.getElementById('totalamt').value);
  var dicamt=parseInt(document.getElementById('disamt').value);
  var addgst=parseInt(document.getElementById('addgst').value);
  var gstty=document.getElementsByClassName('gst');
  var gst=parseInt(document.getElementById('gstper').value);


  if(gstty[0].checked)
  {

      if(gst>0){
      gstamt=amt*gst/100;
      payamt=Math.round(amt+gstamt-dicamt);
      document.getElementById('gsttype').value="percentage";
      document.getElementById('addgst').value=gstamt;

          }
    else
    {
      payamt=Math.round(amt-dicamt);
      document.getElementById('gsttype').value="";
      document.getElementById('addgst').value='0';
    }

  }
  else
  {
    if(gst>0){
    payamt=Math.round(amt+gst-dicamt);
    document.getElementById('gsttype').value="Rupees";
    document.getElementById('addgst').value=gst;
    }
    else
    {
      payamt=Math.round(amt-dicamt);
      document.getElementById('gsttype').value="";
      document.getElementById('addgst').value='0';
    }
  }


  document.getElementById('payamt').value=payamt;
  // document.getElementById('both').value=payamt;
}

function CalculateGST(amount,percent)
{
        var gst_amount  = (amount * percent) / 100;
        var total       = parseFloat(amount + gst_amount);
        var gtotal =parseFloat(total).toFixed(2);
        return gtotal;
}
function Calculatediscount(amount,percent)
{
        var dis_amount  = (amount * percent) / 100;
        var distotal =parseFloat(dis_amount).toFixed(2);
        return distotal;
}

                   