<?php include('./header.php'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

<div class="row">
    <div class="col-sm-12 grid-margin">
        <div class="card">
            <div class="card-block">
                <?
                // Handle adding a component
                if (isset($_POST['submit']) && isset($_POST['component'])) {
                    $name = $_POST['component'];
                    $date = date('Y-m-d');
                    $statement = "INSERT INTO mis_component(name,status,created_at) VALUES('".$name."','1','".$date."')";
                    
                    if (mysqli_query($con, $statement)) { ?>
                        <script>
                            alert('Component Added');
                            window.location.href="./add_component.php";
                        </script>
                    <? } else {
                        echo mysqli_error($con);
                    }
                }

                // Handle deleting a component
                if (isset($_POST['delete']) && isset($_POST['component_id'])) {
                    $component_id = $_POST['component_id'];
                    $delete_statement = "DELETE FROM mis_component WHERE id='".$component_id."'";

                    if (mysqli_query($con, $delete_statement)) { ?>
                        <script>
                            alert('Component Deleted');
                            window.location.href="./add_component.php";
                        </script>
                    <? } else {
                        echo mysqli_error($con);
                    }
                }
                ?>
                <form action="<? echo $_SERVER['PHP_SELF'] ;?>" method="POST">
                    <h3>Add Component</h3>
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" name="component" class="form-control" placeholder="" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="submit" name="submit" value="Add" class="btn btn-success">
                        </div>
                    </div>    
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-block">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="componentTable">
                    <thead>
                        <tr>
                            <th>SR</th>
                            <th>Component</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = mysqli_query($con, "SELECT * FROM mis_component WHERE status=1 ORDER BY id ASC");
                        $i = 1;
                        while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                            <tr>
                                <th><? echo $i; ?></th>
                                <th><? echo $sql_result['name']; ?></th>
                                <th>
                                    <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="component_id" value="<? echo $sql_result['id']; ?>">
                                        <input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this component?');">
                                    </form>
                                </th>
                            </tr>    
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('./footer.php'); ?>
