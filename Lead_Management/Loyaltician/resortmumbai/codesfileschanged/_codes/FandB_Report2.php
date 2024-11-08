<?php session_start();
include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    
    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/datedropper/datedropper.min.css">
    <link rel="stylesheet" href="assets/vendor/dropzone/dropzone.css">
     <style>
        th{font-size: 12px !important;}  
    </style>
<script>
    
 function expfunc()
{

$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();

   }   


function toggle(source){
    
    chkboxes=document.getElementsByName('check[]');
    for(var i=0,n=chkboxes.length;i<n;i++){
        chkboxes[i].checked=source.checked;
        
    }
    
}




</script>

</head>
<body class="sidebar-pinned" onload="searchfiltter('','')" id="rightclick">

<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Food and Beverage Spends
                        </h4>
                        

                    </div>
                </div>
            </div>
        </div><br /><br /><br />
<!-- <form  method="post" id="formf" action="delegation.php">-->
<form>
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php 
        $q1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table`  ");
        $f1=mysqli_fetch_array($q1);
        
        
        $q2=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table`  ");
        $f2=mysqli_fetch_array($q2);
        
        $revenu2=$f2['FoodAmt']+$f2['SoftBevAmt']+$f2['IndianLiqAmt']+$f2['ImpLiqAmt']+$f2['No_of_MiscAmt'];
        $discount2=$f2['FoodDiscAmt']+$f2['SoftBevDiscAmt']+$f2['IndianLiqDiscAmt']+$f2['ImpLiqDiscAmt']+$f2['MiscDiscAmt'];
        $netRevenue2=$revenu2-$discount2;
        
       
         if($revenu2>0){
         $percent2 = ($discount2*100)/$revenu2;
         $disPer2 = number_format( $percent2 ) . '%';}
         
         $APCcount=$netRevenue2/$f1['No_of_paxClose'];
         $APC = number_format( $APCcount );
?>                 



<div class="card-body">
     
                              
            <div class="container-fluid">
            <div class="row d-none  pull-up d-lg-flex">
                <div class="col m-b-30">
                    <div class="card ">

                        <div class="card-body">
                            
                            <div class="text-center p-t-30 p-b-20">
                                <div class="text-overline text-muted opacity-75" style="font-size: 13px;">COVERS</div>
                                <h1 class="text-success" id="BoxCOVERS"><?php echo $f1['No_of_paxClose'];?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">

                        <div class="card-body">
                          
                            <div class="text-center p-t-30 p-b-20">
                                <div class="text-overline text-muted opacity-75" style="font-size: 13px;">Net Revenue</div>
                                <h1 class="text-danger" id="BoxRevenue"><?php echo $netRevenue2;?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col m-b-30">
                    <div class="card ">

                        <div class="card-body">
                            
                            <div class="text-center p-t-30 p-b-20">
                                <div class="text-overline text-muted opacity-75" style="font-size: 13px;"> Discount</div>
                                <h1 class="text-success" id="BoxDiscount"> <?php echo $disPer2; ?> </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col m-b-30">
                    <div class="card ">

                        <div class="card-body">
                            
                            <div class="text-center p-t-30 p-b-20">
                                <div class="text-overline text-muted opacity-75" style="font-size: 13px;">APC</div>
                                <h1 class="text-danger"  id="BoxAPC"> <?php echo $APC;?></h1>
                            </div>
                        </div>
                    </div>
                </div>
               


            </div>
          
        </div>   
                       
                       
                        <div class="form-row">
                                   
                            
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">From Date</lable>
                                  <input class="form-control js-datepicker" id="fromDt" autocomplete="off" name="fromDt" data-large-mode="true" type="text">
                               </div>
                               
                               <div class="form-group col-md-2">
                                      <label for="inputAddress2">To Date</lable>
                                  <input class="form-control js-datepicker" id="ToDt" autocomplete="off" name="ToDt" data-large-mode="true" type="text">
                               </div>
                               
                               
                               
                            
                             
                                 <input type="button" class="btn btn-primary" style="height:30px;margin-top: 24px;padding-top: 2px;" onclick="searchfiltter('','')" value="Search">
                             
                             
                              </div>
                              <button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
  window.print();
}
</script>


                        <div class="m-b-10" style="margin: auto !important;width: 20% !important;">
                            <div class="spinner-border" style="display:none"  role="status">
                                <span class="sr-only" >Loading...</span>
                            </div>
                        </div>  


    <div class="table-responsive p-t-10">
    <div id="example1"></div>
    
    </div> 
    <br />
   <br />
                            <div class="row">
                                <div class="col-md-6" style="position: relative;padding-left: 15px;border-right-width: 73px;padding-right: 58px;"><h3 align="center" id="hd_text1" style="display:none">Covers by Meal Period</h3><div id="chart"></div></div>
                                <div class="col-md-6" ><h3 align="center" id="hd_text2" style="display:none">Covers by Day of the week</h3><div id="chart02"></div></div>
                            </div>
    <br />
    <hr />
     <hr />
    <br />  
    
                            <div class="row">
                                <div class="col-md-6" style="position: relative;padding-left: 15px;border-right-width: 73px;padding-right: 58px;"><h3 align="center" id="hd_text3" style="display:none">Visits by Meal Period</h3><div id="chart03"></div></div>
                                <div class="col-md-6" ><h3 align="center" id="hd_text4" style="display:none">Visits by Day of the week</h3><div id="chart04"></div></div>
                            </div>
    
     <br />
    <hr />
     <hr />
    <br />  
    
    
                           <div class="row">
                                <div class="col-md-6" style="position: relative;padding-left: 15px;border-right-width: 73px;padding-right: 58px;"><h3 align="center" id="hd_text5" style="display:none">Net Revenue by Meal Period</h3><div id="chart05"></div></div>
                                <div class="col-md-6" ><h3 align="center" id="hd_text6" style="display:none">Net Revenue by Day of the week</h3><div id="chart06"></div></div>
                            </div>
    <br/>
    
    
    <script src="assets/vendor/apexchart/apexcharts.min.js"></script>
             
     <script>            
     
     
         function graph1(FromDt,Todt){
                
                
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph1',
                     
                    success:function(msg){
                      //  alert(msg);
                       
                       $("#chart").empty();
                       $('#hd_text1').show();
                      
                       if(msg!=""){
                       
                      var Mumbai=[];
                         var jsr=JSON.parse(msg);
                        
                            Mumbai.push(parseInt(jsr[0]["breakfast"]));
                            Mumbai.push(parseInt(jsr[0]["LUNCH"]));
                            Mumbai.push(parseInt(jsr[0]["DINNER"]));
                            Mumbai.push(parseInt(jsr[0]["MISC"]));
                           
     
     
        var colors = ['#D35400', '#1B4F72', '#EC7063', '#117A65'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                name: "Covers",
                data:Mumbai
            }],
            xaxis: {
                categories: ['Breakfast', 'Lunch', 'Dinner', 'Misc'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );

        chart.render();
    
                       }}
                }) 
                  
                  
                graph2(FromDt,Todt);
          }
          
    
    
    
    
     function graph2(FromDt,Todt){
                
                
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph2',
                     
                    success:function(msg){
                        //alert(msg);
                       
                       $("#chart02").empty();
                       $('#hd_text2').show();
                      
                       if(msg!=""){
                       
                      var value=[];
                         var jsr=JSON.parse(msg);
                        
                        value.push(parseInt(jsr[0]["Monday"]));
                         value.push(parseInt(jsr[0]["Tuesday"]));
                          value.push(parseInt(jsr[0]["Wednesday"]));
                           value.push(parseInt(jsr[0]["Thursday"])); 
                            value.push(parseInt(jsr[0]["Friday"]));
                             value.push(parseInt(jsr[0]["Saturday"]));
                              value.push(parseInt(jsr[0]["Sunday"]));
                         
                           
     
     
        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#5D6D7E', '#117A65', '#873600'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                name: "Covers",
                data:value
            }],
            xaxis: {
                categories: ['Monday', 'Tue', 'Wed', 'Thu','Fri','Sat','Sun'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart02"),
            options
        );

        chart.render();
    
                       }}
                }) 
                graph3(FromDt,Todt) ; 
                  
                
          }
    
    
    
    function graph3(FromDt,Todt){
                
                
                  
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph3',
                     
                    success:function(msg){
                      // alert(msg);
                       
                       $("#chart03").empty();
                       $('#hd_text3').show();
                      
                       if(msg!=""){
                       
                      var Mumbai=[];
                         var jsr=JSON.parse(msg);
                        
                            Mumbai.push(parseInt(jsr[0]["breakfast"]));
                            Mumbai.push(parseInt(jsr[0]["LUNCH"]));
                            Mumbai.push(parseInt(jsr[0]["DINNER"]));
                            Mumbai.push(parseInt(jsr[0]["MISC"]));
                           
     
     
        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                 name: "Visits",
                data:Mumbai
            }],
            xaxis: {
                categories: ['Breakfast', 'Lunch', 'Dinner', 'Misc'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart03"),
            options
        );

        chart.render();
    
                       }}
                }) 
                  
               graph4(FromDt,Todt) ;     
                
          }
          
          
          
          
    function graph4(FromDt,Todt){
                
                
                  
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph4',
                     
                    success:function(msg){
                      // alert(msg);
                       
                       $("#chart04").empty();
                       $('#hd_text4').show();
                      
                       if(msg!=""){
                       
                       var value=[];
                         var jsr=JSON.parse(msg);
                        
                        value.push(parseInt(jsr[0]["Monday"]));
                         value.push(parseInt(jsr[0]["Tuesday"]));
                          value.push(parseInt(jsr[0]["Wednesday"]));
                           value.push(parseInt(jsr[0]["Thursday"])); 
                            value.push(parseInt(jsr[0]["Friday"]));
                             value.push(parseInt(jsr[0]["Saturday"]));
                              value.push(parseInt(jsr[0]["Sunday"]));
     
     
        var colors = ['#212F3D', '#D35400', '#1E8449', '#F1C40F', '#C0392B', '#2E86C1', '#95A5A6'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                name: "Visits",
                data:value
            }],
            xaxis: {
                categories: ['Monday', 'Tue', 'Wed', 'Thu','Fri','Sat','Sun'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart04"),
            options
        );

        chart.render();
    
                       }}
                }) 
                  
              graph5(FromDt,Todt) ;        
                
          }
    
    
    
    
    
     
    function graph5(FromDt,Todt){
                
                
                  
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph5',
                     
                    success:function(msg){
                     //  alert(msg);
                       
                       $("#chart05").empty();
                       $('#hd_text5').show();
                      
                       if(msg!=""){
                       
                      var Mumbai=[];
                         var jsr=JSON.parse(msg);
                        
                            Mumbai.push(parseInt(jsr[0]["breakfast"]));
                            Mumbai.push(parseInt(jsr[0]["LUNCH"]));
                            Mumbai.push(parseInt(jsr[0]["DINNER"]));
                            Mumbai.push(parseInt(jsr[0]["MISC"]));
                           
     
     
        var colors = ['#212F3D', '#D35400', '#1E8449', '#F1C40F'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                 name: "Net Revenue",
                data:Mumbai
            }],
            xaxis: {
                categories: ['Breakfast', 'Lunch', 'Dinner', 'Misc'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart05"),
            options
        );

        chart.render();
    
                       }}
                }) 
                  
                graph6(FromDt,Todt) ;      
                
          }
    
    
    
    
     
    function graph6(FromDt,Todt){
                
                
                  
                   $.ajax({
                    type:'POST',
                    url:'getFandB2_GraphProcess.php',
                    data:'FromDt='+FromDt+'&Todt='+Todt+'&graph=graph6',
                     
                    success:function(msg){
                      // alert(msg);
                       
                       $("#chart06").empty();
                       $('#hd_text6').show();
                      
                       if(msg!=""){
                       
                       var value=[];
                         var jsr=JSON.parse(msg);
                        
                        value.push(parseInt(jsr[0]["Monday"]));
                         value.push(parseInt(jsr[0]["Tuesday"]));
                          value.push(parseInt(jsr[0]["Wednesday"]));
                           value.push(parseInt(jsr[0]["Thursday"])); 
                            value.push(parseInt(jsr[0]["Friday"]));
                             value.push(parseInt(jsr[0]["Saturday"]));
                              value.push(parseInt(jsr[0]["Sunday"]));
     
     
        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
        var options = {
            chart: {
                height: 400,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                name: "Net Revenue",
                data:value
            }],
            xaxis: {
                categories: ['Monday', 'Tue', 'Wed', 'Thu','Fri','Sat','Sun'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart06"),
            options
        );

        chart.render();
    
                       }}
                }) 
                  
                  
                
          }
    
    
    
</script>

               
                   
                            
    
    
               
     </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>

</main>

<?php include('belowScript.php');?>
<!--page specific scripts for demo-->
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>


<script src="assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/vendor/datedropper/datedropper.min.js"></script>
<script src="assets/vendor/dropzone/dropzone.js"   ></script>
<script src="assets/vendor/jquery.mask/jquery.mask.min.js"></script>
<script src="assets/js/form-data.js"></script>


<!--====== this is for export to excel,pdf,copy --===================-->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<!--====== this is for export to excel,pdf,copy --===================-->
<script>

function ddl_listStatus(){
    var  Lead=document.getElementById('Lead').value;
    if(Lead==1){
        $('#LeadAllStatus').show();
        $('#LeadImportStatus').hide();
    }else if(Lead==2){
         $('#LeadAllStatus').hide();
         $('#LeadImportStatus').show();
    }
    
    
}
    
   function searchfiltter(strPage,perpg){
    
          var  fromDt=document.getElementById('fromDt').value;
          var  ToDt=document.getElementById('ToDt').value;
          
          
          
          perp=perpg;

var Page="";
if(strPage!="")
{
Page=strPage;
}
     
     if(fromDt==""){
         swal("Please select From date");
     }else if(ToDt==""){
         swal("Please select To date");
     }else{
         
               $('.spinner-border').show();  
     
            $.ajax({
            type:'POST',    
            url:'FandB_Report2_search.php',
            data:'Page='+Page+'&perpg='+perp+'&FromDt='+fromDt+'&ToDt='+ToDt,
            success: function(msg){
            //alert(msg);
            $('.spinner-border').hide();  
            document.getElementById("example1").innerHTML=msg;
          
           
           
           Box(Page,perp,fromDt,ToDt);
           test();
            graph1(fromDt,ToDt);
           
            } })
   
     }
}

function Box(Page,perp,fromDt,ToDt){
     $.ajax({
            type:'POST',    
            url:'FandB_Report2_searchBox.php',
            data:'Page='+Page+'&perpg='+perp+'&FromDt='+fromDt+'&ToDt='+ToDt,
            success: function(msg){
           // alert("anand"+msg);
           
            var json=$.parseJSON(msg);
            $('#BoxCOVERS').html(json[0].No_of_CloseTotal);
            $('#BoxRevenue').html(json[0].netRevenue);
            $('#BoxDiscount').html(json[0].disPer);
            $('#BoxAPC').html(json[0].APC);  
            } })
}

function test(){
$('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
}
</script>

</body>
</html>
<script>
    $(document).ready(function() {
    $("#rightclick").on("contextmenu",function(e){
       return false;
    }); 
}); 
</script>
