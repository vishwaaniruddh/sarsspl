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

                   function Addtolist(id)
                   {
                     var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :id}
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Account/productdetails",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.name;
                           var offer_price=data.unit_price;
                           var pro_id=data.item_number;
                           var category_id=data.category;
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1; 

                            var rowhtml='<tr id="rowid_'+count+'"><td><input type="hidden" value="'+pro_id+'" name="item_no[]" id="item_no'+count+'"/><input type="hidden" value="'+category_id+'" name="item_cat[]"/> <input class="form-control" name="myitemid[]" id="itemname_'+count+'" value="'+productname+'" title="'+productname+'"  type="text" readonly ></td><td><input class="form-control" name="batchno[]" type="text"></input></td><td><input type="date" class="form-control date"  name="expirydate[]" data-toggle="date-picker" data-single-date-picker="true" data-date-format="mm-dd-yyyy"></input></td><td><input class="form-control cprice" id="cprice'+count+'" onkeyup="subtotal()" name="cprice[]" value="'+offer_price+'" type="text"></input></td><td><input class="form-control qty" id="qty'+count+'" name="qty[]" onkeyup="subtotal()" type="text"></input></td><td><input class="form-control subtotal" id="subtotal'+count+'" name="totalamt" onkeyup="subtotal()" type="text" readonly></input></td><td><a class="btn btn-danger text-white" onclick="deleterow('+count+')"><i class="uil-trash-alt"></i></a></td></tr>';
                            $("#addrow").append(rowhtml);

                            
                            $("#productdescrip").val("");
                            $("#rowcount").val(count);
                           
                          }
                    });
                   }
                   }
                   function Addtolist1(id)
                   {
                     var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :id}
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Account/productdetails",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.name;
                           var offer_price=data.unit_price;
                           var pro_id=data.item_id;
                           var category_id=data.category;
                           var expiry_date=data.expiry_date;
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1; 

                            var rowhtml='<tr id="rowid_'+count+'"><td><input type="hidden" value="'+pro_id+'" name="item_no[]" id="item_no'+count+'"/><input type="hidden" value="'+category_id+'" name="item_cat[]"/> <input class="form-control" name="myitemid[]" id="itemname_'+count+'" value="'+productname+'" title="'+productname+'"  type="text" readonly ></td><td><select class="form-control"  name="batchno[]" id="batchno_'+count+'" onchange="getexpiry('+count+')" required ><option>Select Batch</option></select></td><td><input type="text" class="form-control date"  name="expirydate[]"  id="expiry_date'+count+'" readonly></input></td><td><input class="form-control cprice" id="cprice'+count+'" onkeyup="subtotal()" name="cprice[]" value="'+offer_price+'" type="text"></input></td><td><input class="form-control qty" id="qty'+count+'" name="qty[]" onkeyup="subtotal()" type="text"></input></td><td><input class="form-control subtotal" id="subtotal'+count+'" name="totalamt" onkeyup="subtotal()" type="text" readonly></input></td><td><a class="btn btn-danger text-white" onclick="deleterow('+count+')"><i class="uil-trash-alt"></i></a></td></tr>';
                            $("#addrow").append(rowhtml);

                            
                            $("#productdescrip").val("");
                            $("#rowcount").val(count);
                            getbatch(count)
                           
                          }
                    });
                   }
                   }

                   function getbatch(count)
                   {

                    var productid=$("#item_no"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid}
                     
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
                   function getexpiry(count)
                   {
                      // alert(count);
                    var productid=$("#item_no"+count).val();
                    var batchno=$("#batchno_"+count).val();
                   // alert(productid);
                   var myKeyVals = { item_id :productid,batchno:batchno}
                     
                     $.ajax({
                          type: 'POST',
                          url: base_url+"Sale/GetExpiry",
                          data: myKeyVals,
                          success: function(resultData) { 
                          // alert(resultData);  
                          $("#expiry_date"+count).val(resultData);                         
                          }
                    });

                   }

                   function subtotal()
                    { //alert("hii");
                      var elem = document.getElementsByClassName('qty');
                       var price=document.getElementsByClassName('cprice');
                       //alert(price);
                       var subto=document.getElementsByClassName('subtotal');
                       var sumamt=0; var sumqty=0;
                       for(i=0;i<elem.length;i++)
                       {
                        if(elem[i]!=0 || price[i]!=0)
                        {
                          if(price[i].value=="")
                          price[i].value=0;
                          
                          if(elem[i].value=="")
                          elem[i].value=0;
                          
                          var subtotal=parseInt(elem[i].value)*parseInt(price[i].value);
                          subto[i].value=subtotal;
                          sumamt=sumamt+subtotal;
                          sumqty=sumqty+parseInt(elem[i].value);  
                        }  
                      }
                      
                          
                        document.getElementById('totalamt').value=sumamt;
                        document.getElementById('totalqty').value=sumqty;
                        document.getElementById('payamt').value=sumamt;
                        
                        
                      var amt=sumamt;
                      var type=document.getElementsByClassName('dis');
                      var dis=document.getElementById('per').value;

                      var gstty=document.getElementsByClassName('gst');
                      var gst=document.getElementById('gstper').value;
                      
                      calcAmt();
                      calcAmtgst();
                        
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
    }
  }


  document.getElementById('payamt').value=payamt;
  // document.getElementById('both').value=payamt;
}

                   