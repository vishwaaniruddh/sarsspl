<?php include("config.php");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $rank = $_POST['rank'];
    $under = $_POST['under'];

    // echo $name; echo $rank; echo $under;
    echo '<pre>';print_r($_POST);echo '</pre>';
    $insert = "insert into `project_catT` (`name`,`disc`,`rank`,`UNDER`) values ('".$name."','".$name."','".$rank."','".$under."') ";
    $insertsql = mysqli_query($con,$insert);
        echo '<pre>';print_r($insertsql);echo '</pre>';
        if($insertsql)
        {
            echo 1;
        }
        else{
            echo 2;
        }


}

$_categ = mysqli_query($con,"select id,name,rank,UNDER from project_catT where UNDER>0");
?>
<form action="insert_topic.php" method="POST">
   
    <label for="cat">Select Category</label>
<select name="under" id="cat">
    <?php while($sql_res = mysqli_fetch_assoc($_categ)){ ?>
    <option value="<?php echo $sql_res['id']?>"><?php echo $sql_res['name'];?></option>
    <?php }?>
</select>  
<label for="name">Topic Name</label>
<input type="text" id="name[]" name="name" >
<label for="rank">Rank</label>
<input type="text" id="rank[]" name="rank" >
<!--<label for="under">under</label>-->
<!--<input type="text" id="under" name="under" >-->
<!--<div class="card-body">-->
<!--                        <div class="row" id="">-->
<!--                          <div class="col-md-6">-->
<!--                            <div class="form-group">-->
<!--                              <h4 class="text-center"> Details of Deceased Person</h4>-->
<!--                              <div class="form-check">-->
<!--                                <label class="form-check-label">-->
<!--                                  <input type="checkbox" class="form-check-input" id="dexcheck_0" onclick="setCheck('0')">-->
<!--                                   To Add More Details, Please Check this Box-->
<!--                                </label>-->
<!--                              </div>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                            <div class=""  id="add_row_new" >-->
<!--                                <br>-->
<!--                              </div>-->
<!--                              <div class="row">-->
<!--                                  <hr> <input type="hidden" id="remove_more" name="remove_more"> <br>-->
<!--                              </div>-->
<!--                              <button type="button" id="addmore" class="btn btn-success mr-2" style="display:none;">Add More+</button><hr>-->
<!--                              <div  class="col-sm-12">-->
<!--                                <br><input type="hidden" id="totalrow" name="totalrow" value="0">-->
<!--                              </div>-->
                        
<!--</div>-->
                        <input type="submit" name="submit" value="submit">  
</form>

<!--<script>-->

<!--            var num=1;-->

<!--            $("#add").on('click',function(){-->
<!--            var key = num;-->
<!--             num++;-->
<!--             $("#totalrow").val(num);-->

<!--              var new_html = '<div class="row" id="rowid'+num+'" >';-->
<!--              new_html += ' <hr/>';-->
<!--              new_html += '';-->
<!--            new_html += '<label class="label_label">Select Topic</label>';-->
<!--            new_html += '<input type="text" name="name[]" id="name'+num+'" class="form-control" >';-->

<!--            new_html +=	'<label class="label_label">Address</label>';-->
<!--            new_html += '<input class="form-control"  type="text" name="rank[]" id="rank'+num+'">';-->

<!--            new_html += '<div class="wrapper"><br><div type="button" class="btn btn-warning" onclick="removeDiv('+num+')"><i class="fas fa-trash">Remove</i></div></div>';-->
<!--            new_html += '</div>';-->
<!--            new_html += ' <hr/>';-->
<!--            $('#add_row_new').append(new_html);-->

<!--          });-->
<!--          function removeDiv(num)-->
<!--          {-->
<!--            $('#rowid'+num).remove();-->
<!--            var total_secondary = $('#totalrow').val();-->
<!--            total_secondary = total_secondary - 1;-->
<!--            $('#totalrow').val(total_secondary);-->
<!--              alert("removed");-->
<!--          }-->
<!--          function setCheck(val)-->
<!--            {-->

<!--              if($("#dexcheck_"+val).is(":checked"))-->
<!--              {-->
<!--                $("#add_row_new").show();-->
<!--                $("#addmore").show();-->
<!--              }-->
<!--              else{-->
               
<!--                $("#add_row_new").hide();-->
<!--                $("#addmore").hide();-->
<!--              }-->

<!--            }-->

<!--</script>-->
 