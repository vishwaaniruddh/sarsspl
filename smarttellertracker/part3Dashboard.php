<div class="row">
    <div class="col-sm-12">


        <?php



        echo '<div class="card">
    <div class="card-header">
            <h5>LHO Wise Open Calls</h5>
            <hr />
        </div>
    
        <div class="card-block">';

       
            $sql = "select a.lho,count(1) as count from mis a INNER JOIN mis_details b ON b.mis_id = a.id   where 1 and b.mis_id = a.id and   CAST(b.created_at AS DATE) >= '2023-01-01' and CAST(b.created_at AS DATE) <= '" . $date . "' and b.status in ('open', 'reassign')
      ";
      
        $sql .= " group by a.lho order by a.lho asc ";

        // echo $sql ; 
        $lhosql = mysqli_query($con, $sql);
        if (mysqli_num_rows($lhosql) > 0) {


            echo '
<table class="table table-hover table-styling table-xs">
    <thead>
        <tr class="table-primary">
            <th>Sr No</th>
            <th>LHO</th>
            <th>Total Calls</th>
            <th>Open</th>
            <th>Close</th>
        <tr>
    <thead>
    <tbody>
    ';

            $totalLhoOpenCalls = 0;
            $totalLhoCloseCalls = 0;
            $totalallcall = 0;

            while ($lhosql_result = mysqli_fetch_assoc($lhosql)) {

              
                    $allcallsql = "select count(1) as total from mis where lho like '" . $lho . "'";
                    $opencallsql = "select count(1) as total from mis a INNER JOIN mis_details b ON b.mis_id = a.id where 1 and 
                     b.mis_id = a.id and CAST(b.created_at AS DATE) >= '2023-01-01' and CAST(b.created_at AS DATE) <= '" . $date . "' and 
                     b.status in ('open', 'schedule', 'material_requirement', 'material_dispatch', 'permission_require', 'material_delivered', 'MRS', 'cancelled', 'available', 'not_available', 'material_in_process', 'fund_required', 'reassign', 'Mail Update')";
                    $closecallsql = "select count(1) as total from mis a where 1 and a.status like 'close' and a.lho='" . $lho . "'";

               
                // echo $closecallsql;
                // echo $allcallsql ; 
        
                $allcall = mysqli_fetch_assoc(mysqli_query($con, $allcallsql))['total'];
                $opencall = mysqli_fetch_assoc(mysqli_query($con, $opencallsql))['total'];
                $closecall = mysqli_fetch_assoc(mysqli_query($con, $closecallsql))['total'];


                echo "<tr>
            <td>{$lhowiseSrno}</td>
            <td>{$lho}</td>
            <td>{$allcall}</td>
            <td>{$lhosql_result['count']}</td>
            <td>{$closecall}</td>
        <tr>";

                $totalLhoOpenCalls = $totalLhoOpenCalls + $lhosql_result['count'];

                $totalLhoCloseCalls = $totalLhoCloseCalls + $closecall;
                $totalallcall = $totalallcall + $allcall;


                $lhowiseSrno++;
            }




            echo "

  <tr class='table-primary'>
            <th></th>
            <th>Total</th>
            <th>{$totalallcall}</th>
            <th>{$totalLhoOpenCalls}</th>
            <th>{$totalLhoCloseCalls}</th>
        <tr>
        
        
        
        
</tbody>
</table>";

        } else {

            echo '
                                                
    <div class="noRecordsContainer">
        <img src="assets/no_records.jpg">
    </div>';

        }


        echo '
        </div>
    </div>
    ';





        ?>
    </div>
</div>