<? include('config.php'); ?>


// $country = $_POST['country'];
// $zone = $_POST['zone'];


<style>
    
element.style {
    cursor: pointer;
}
table {
    border-collapse: collapse;
    width: 100%;
}
table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
}
table, td, th {
    text-align: center;
}
table {
    background-color: transparent;
}
table {
    border-spacing: 0;
    border-collapse: collapse;
}

th, td {
    text-align: center;
    padding: 8px;
    /* white-space: nowrap; */
    border: 1px solid;
}

th {
    background-color: red;
    color: white;
}
th, td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}
table, td, th {
    text-align: center;
}
th {
    text-align: left;
}
td, th {
    padding: 0;
}
</style>


<?
$country = '1';
$zone = '1';



if($country){
    $level_id = 1;
    $star = 'Country';
    if($zone){
        $level_id =$level_id+1;
        $star = 'Zone';
        if($state){
            $level_id =$level_id+1;
            $star = 'State';
                if($division){
                   $level_id =$level_id+1;
                   $star = 'Division';
                   if($district){
                      $level_id =$level_id+1;
                      $star = 'District';
                      if($taluka){
                             $level_id =$level_id+1;
                             $star = 'Taluka';
                             if($pincode){
                                $level_id =$level_id+1;
                                $star = 'Pincode';
                             
                                if($village){
                                    $level_id =$level_id+1;
                                    $star = 'Village';
                                    }
                                else{
                                    $village='0';
                                }
                            }
                            else{
                                $pincode = '0';
                            }
                      }
                      else{
                       $taluka = '0';   
                      }
                }
                else{
                    $district = '0';
                }
            }
            else{
                $division = '0';
            }

        }
        else{
            $state= '0';
            }
    }
    else{
        $zone = '0';
    }
}
else{
    $country = '0';
}




$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];

if($zone==''){
    $zone = '0';
}
if($state==''){
    $state = '0';
}
if($division==''){
    $division = '0';
}
if($district==''){
    $district = '0';
}
if($taluka==''){
    $taluka = '0';
}
if($pincode==''){
    $pincode = '0';
}
if($village==''){
    $village = '0';
} 




?>



    <div class="content">


        <div style="text-align: center;">
            <h2><? echo $star;?></h2>
        </div>

        <div style="overflow-x:auto; margin: 20px;">
        <table  class="table_deco" style="cursor: pointer;">
          <tr class="table_deco">
            <th class="table_deco" id="table_deco_th">Franchise</th>
            <th class="table_deco" id="table_deco_th">Total Franchise</th>
            <th class="table_deco" id="table_deco_th">Franchise Given</th>
            <th class="table_deco" id="table_deco_th">Qualified Made 6 Franchisee all over india or under them</th>
            <th class="table_deco" id="table_deco_th">Under Process of Qualifying Not Completed 9 Days</th>
            <th class="table_deco" id="table_deco_th">Not Qualified</th>
            <th class="table_deco" id="table_deco_th">Franchisee Not Given</th>
            <th class="table_deco" id="table_deco_th">Total Franchisee Available</th>
            <th class="table_deco" id="table_deco_th">Applied in Waiting List</th>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">India</td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">Zone</td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
            <td class="table_deco"></td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">State</td>
            <td class="table_deco">1</td>
            <td class="table_deco">1</td>
            <td class="table_deco">1</td>
            <td class="table_deco"></td>
            <td class="table_deco">0</td>
            <td class="table_deco">0</td>
            <td class="table_deco">0</td>
            <td class="table_deco">2</td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">Division</td>
            <td class="table_deco">6</td>
            <td class="table_deco">6</td>
            <td class="table_deco">3</td>
            <td class="table_deco">0</td>
            <td class="table_deco">3</td>
            <td class="table_deco">0</td>
            <td class="table_deco">3</td>
            <td class="table_deco">5</td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco"id="table_deco_td">District</td>
            <td class="table_deco">36</td>
            <td class="table_deco">34</td>
            <td class="table_deco">20</td>
            <td class="table_deco">3</td>
            <td class="table_deco">11</td>
            <td class="table_deco">2</td>
            <td class="table_deco">13</td>
            <td class="table_deco">10</td>
          </tr>
          <tr class="table_deco">
            <td  class="table_deco" id="table_deco_td">Taluka</td>
            <td class="table_deco">142</td>
            <td class="table_deco">100</td>
            <td class="table_deco">20</td>
            <td class="table_deco">30</td>
            <td class="table_deco">50</td>
            <td class="table_deco">42</td>
            <td class="table_deco">92</td>
            <td class="table_deco">5</td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">Pincode</td>
            <td class="table_deco">702</td>
            <td class="table_deco">300</td>
            <td class="table_deco">100</td>
            <td class="table_deco">20</td>
            <td class="table_deco">180</td>
            <td class="table_deco">402</td>
            <td class="table_deco">582</td>
            <td class="table_deco">500</td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td">Village</td>
            <td class="table_deco">4256</td>
            <td class="table_deco">100</td>
            <td class="table_deco">20</td>
            <td class="table_deco">5</td>
            <td class="table_deco">75</td>
            <td class="table_deco">4156</td>
            <td class="table_deco">4231</td>
            <td class="table_deco">3000</td>
          </tr>
          <tr class="table_deco">
            <td class="table_deco" id="table_deco_td"><b>Total</b></td>
            <td class="table_deco" id="table_deco_td">5143</td>
            <td class="table_deco" id="table_deco_td">541</td>
            <td class="table_deco" id="table_deco_td">164</td>
            <td class="table_deco" id="table_deco_td">58</td>
            <td class="table_deco" id="table_deco_td">319</td>
            <td class="table_deco" id="table_deco_td">4602</td>
            <td class="table_deco" id="table_deco_td">4921</td>
            <td class="table_deco" id="table_deco_td">3522</td>
          </tr>
        </table>
    </div>

    </div>
