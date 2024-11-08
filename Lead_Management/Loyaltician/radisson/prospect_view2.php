<?php session_start();
include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   

    <!-- jQuery library -->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script>
    
 function expfunc()
{//alert("hii")

$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();

   
}   


function toggle(source){
    
    chkboxes=document.getElementsByName('check[]');
    for(var i=0,n=chkboxes.length;i<n;i++){
        chkboxes[i].checked=source.checked;
        
    }
    
}



$(document).ready(function() {
	var t = $('#example').DataTable( {
        	    "processing": true,
        		"serverSide": true,
        		"ajax": "json/view_prospect.php",
                "columnDefs": [{
    		        "render": delegateBtn,
    		        "data": 5,
    		        "targets": [13]
        		    }
        		   ,{
    		        "render": editeBtn,
    		        "data": 5,
    		        "targets": [14]
        		    }
        		    ,{
    		        "render": converttoMemBtn,
    		        "data": 5,
    		        "targets": [15]
        		    }
        		    
        		    ],
        	});
});





function delegateBtn() {
    return '<input type="checkbox" class="delegateBtn" name="check[]">';
}

function editeBtn() {
    return '<input type="button" id="editeBtn" class="btn btn-primary" value="Edit">';
}

function converttoMemBtn() {
    return '<input type="button" id="converttoMemBtn" class="btn btn-primary" value="Convert To Member">';
}


var table; $(document).ready(function(){ table = $('#example').DataTable(); });



$(document).ready(function() {
    // var table = $('#example').DataTable();
    
    table.on( 'draw', function () {
        $("#example tbody tr").find("td:nth-child(13)").each(function() {    
               let delegate_status = $(this).html();
               if(delegate_status!='Pending'){
                   $(this).parent().find("td:nth-child(14)").html('');
                   $(this).parent().find("td:nth-child(15)").html('');
               }
            });

        $("#example tbody tr").find("td:nth-child(14)").each(function() {    
                  let lead_id = $(this).parent().find("td:nth-child(1)").html();
            $(this).find('input').attr('value', lead_id);
            //   let delegate_status = $(this).html();
            //   if(delegate_status!='Pending'){
            
            //       $(this).parent().find("td:nth-child(15)").html('');
            //   }
            });

        
        
        
        $("#example tbody tr").find("td:nth-child(12)").each(function() {    
               let pay_status = $(this).html();
               if(pay_status!='Payment Received'){
                   $(this).parent().find("td:nth-child(16)").html('');
               }
            });
            
        $('body').on('click', '#editeBtn', function(){
            var row  = $(this).parents('tr')[0];
            let data =  table.row( row ).data() 
            var id = data[0];
            console.log(id);
            window.location.href="lead_entry1.php?id="+id+"&excelid=0" ; 
        });
        
        $('body').on('click', '#converttoMemBtn', function(){
            var row  = $(this).parents('tr')[0];
            let data =  table.row( row ).data() 
            var id = data[0];
            window.location.href="MemberCreation.php?id="+id ; 
        });     
        
    });
});
  </script>
  
  
  
  
  
  
  
</head>
<body class="sidebar-pinned" id="rightclick">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> View Prospect
                        </h4>
                        

                    </div>
                </div>
            </div>
        </div>
 <form  method="post" id="formf" action="delegation.php">
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php include("config.php");
                          if($_SESSION['usertype']=='Admin' || $_SESSION['usertype']=='Fulfillment Team'  ){
                         	  $View="select * from Leads_table where Status!='3' ";
                          }else{
                              $View="select * from Leads_table where Status!='3' and leadEntryef='".$_SESSION['id']."'";
                          }
                              $qrys=mysqli_query($conn,$View);
                        ?>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Lead Source</label>
                                    <select class="form-control" name="Leadfilter" id="Leadfilter" >
                                        <option value="">Select Source</option>
                                        <?php
                                        $QuryLead_Sources=mysqli_query($conn,"SELECT * FROM `Lead_Sources` where Active='YES'");
                                        while($fetchLead_Sources=mysqli_fetch_array($QuryLead_Sources)){
                                        ?>
                                        <option value="<?php echo $fetchLead_Sources['SourceId'];?>"><?php echo $fetchLead_Sources['Name'];?></option><?php } ?>
                                    </select>
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                                </div>
                            </div>
    
                            <?php  if($_SESSION['usertype']=='Admin'){ ?>
                            <div align="right"><button id="myButtonControlID" class="btn btn-primary" onClick="expfunc();">Delegate</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label>Checked All :-</label><input type="checkbox" onClick="toggle(this)"/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div><?php } ?>
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>srno</th>                                      
                                            <th>Full Name</th>
                                            <th>Email-Id</th>
                                            <th>Mobile Number</th>
                                            <th>Office Number</th>
                                            <th>State</th> 
                                            <th>City</th>
                                            <th>Lead Source</th> 
                                            <th>Company</th>
                                            <th>Designation</th>
                                            <th>ASSOCIATE NAME</th>
                                            <th>ASSOCIATE STATUS</th>
                                            <th>DELEGATE STATUS</th>
                                            <th>DELEGATE</th>
                                            <th>EDIT</th>
                                            <th>CONVERT TO MEMBER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>srno</th>                                      
                                            <th>Full Name</th>
                                            <th>Email-Id</th>
                                            <th>Mobile Number</th>
                                            <th>Office Number</th>
                                            <th>State</th> 
                                            <th>City</th>
                                            <th>Lead Source</th> 
                                            <th>Company</th>
                                            <th>Designation</th>
                                            <th>ASSOCIATE NAME</th>
                                            <th>ASSOCIATE STATUS</th>
                                            <th>DELEGATE STATUS</th>
                                            <th>DELEGATE</th>
                                            <th>EDIT</th>
                                            <th>CONVERT TO MEMBER</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <?php  if($_SESSION['usertype']=='Admin'){ ?>	
                                <div align="center" > <button id="myButtonControlID" class="btn btn-primary" onClick="expfunc();">Delegate</button></div><?php } ?>
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


<script>


function searchfiltter(){
   var  Leadfilter=document.getElementById('Leadfilter').value;
   // alert(Leadfilter)
     
     
             $.ajax({
          
                    type:'POST',
                    url:'search_Filtter.php',
                     data:'Leadfilter='+Leadfilter,
                    
                    success:function(msg){
                       // alert(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                        for(var i=0;i<json.length;++i){
                          //  alert(json[i].FirstName)
                            
                            var fullName=json[i].FirstName+" "+json[i].LastName;
                            var srno=i+1;
                            var DelStatus='';
                            if(json[i].Status!='0'){
                                DelStatus='Delegated';}else{ DelStatus='Pending'; }
                           var d="";
                           if(json[i].Status=="0"){  d='<input type="checkbox" name="check[]" id="check" />';  } 
                           
                           var convrt="";
                           if(json[i].Status=='4'){
                           convrt='<input type="button" class="btn btn-primary" onclick="window.open("MemberCreation.php?id=<?php echo $_row['Lead_id'];?>","_self");" value="Convert To Member">';
                           }

                           
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+fullName+'</td><td>'+json[i].EmailId+'</td><td>'+json[i].MobileNumber+'</td><td>'+json[i].ContactNo1+'</td><td>'+json[i].State+'</td><td>'+json[i].City+'</td><td>'+json[i].LeadSource+'</td><td>'+json[i].Company+'</td><td>'+json[i].Designation+'</td><td>'+json[i].Status+'</td><td>'+DelStatus+'</td> <td>'+ d +'</td> </tr>');
                          }
                     
               test();
                   
                    }
                })
    
    
      
}



function test(){



 $('#example').DataTable();
                     
}
</script>
</body>
</html>
