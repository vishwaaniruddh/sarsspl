<?php include('./header.php'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

<div class="row">
    <div class="col-sm-12 grid-margin">
        <div class="card">
            <div class="card-block">
                <?php
                // Handle adding a subcomponent
                if (isset($_POST['submit']) && isset($_POST['subcomponent']) && isset($_POST['component'])) {
                    $component = $_POST['component'];
                    $name = $_POST['subcomponent'];
                    $date = date('Y-m-d');
                    
                    $statement = "INSERT INTO mis_subcomponent(component_id,name,status,created_at) VALUES('$component','$name','1','$date')";
                    
                    if (mysqli_query($con, $statement)) {
                        echo "<script>
                            alert('Sub Component Added');
                            window.location.href='add_subcomponent.php';
                        </script>";
                    } else {
                        echo mysqli_error($con);
                    }
                }

                // Handle deletion of a subcomponent
                if (isset($_POST['delete']) && isset($_POST['subcomponent_id'])) {
                    $subcomponent_id = $_POST['subcomponent_id'];
                    $delete_statement = "DELETE FROM mis_subcomponent WHERE id='$subcomponent_id'";

                    if (mysqli_query($con, $delete_statement)) {
                        echo "<script>
                            alert('Sub Component Deleted');
                            window.location.href='./add_subcomponent.php';
                        </script>";
                    } else {
                        echo mysqli_error($con);
                    }
                }

                // Handle updating a subcomponent
                if (isset($_POST['update']) && isset($_POST['subcomponent_id']) && isset($_POST['edit_component']) && isset($_POST['edit_subcomponent'])) {
                    $subcomponent_id = $_POST['subcomponent_id'];
                    $component = $_POST['edit_component'];
                    $name = $_POST['edit_subcomponent'];

                    $update_statement = "UPDATE mis_subcomponent SET component_id='$component', name='$name' WHERE id='$subcomponent_id'";

                    if (mysqli_query($con, $update_statement)) {
                        echo "<script>
                            alert('Sub Component Updated');
                            window.location.href='./add_subcomponent.php';
                        </script>";
                    } else {
                        echo mysqli_error($con);
                    }
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h3>Add Sub Component</h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <select name="component" class="form-control">
                                <option value="">Select Component</option>
                                <?php
                                $com_sql = mysqli_query($con, "SELECT * FROM mis_component WHERE status=1");
                                while ($com_sql_result = mysqli_fetch_assoc($com_sql)) {
                                    echo "<option value='".$com_sql_result['id']."'>".$com_sql_result['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="subcomponent" class="form-control" placeholder="Sub Component Name">
                        </div>
                        <div class="col-sm-2">
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
                            <th>Sub Component</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = mysqli_query($con, "SELECT sc.id, c.name as component_name, sc.name as subcomponent_name FROM mis_subcomponent sc JOIN mis_component c ON sc.component_id = c.id WHERE sc.status=1 ORDER BY sc.id DESC");
                        $i = 1;
                        while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                            <tr>
                                <th><?php echo $i++; ?></th>
                                <th><?php echo $sql_result['component_name']; ?></th>
                                <th><?php echo $sql_result['subcomponent_name']; ?></th>
                                <th>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="subcomponent_id" value="<?php echo $sql_result['id']; ?>">
                                        <input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subcomponent?');">
                                    </form>
                                    <button class="btn btn-primary edit-btn" data-id="<?php echo $sql_result['id']; ?>" data-component="<?php echo $sql_result['component_name']; ?>" data-subcomponent="<?php echo $sql_result['subcomponent_name']; ?>">Edit</button>
                                </th>
                            </tr>    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sub Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="subcomponent_id" id="edit_subcomponent_id">
                    <div class="form-group">
                        <label for="edit_component">Component</label>
                        <select name="edit_component" id="edit_component" class="form-control">
                            <option value="">Select Component</option>
                            <?php
                            $com_sql = mysqli_query($con, "SELECT * FROM mis_component WHERE status=1");
                            while ($com_sql_result = mysqli_fetch_assoc($com_sql)) {
                                echo "<option value='".$com_sql_result['id']."'>".$com_sql_result['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_subcomponent">Sub Component Name</label>
                        <input type="text" name="edit_subcomponent" id="edit_subcomponent" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // Handle Edit button click
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        var component = $(this).data('component');
        var subcomponent = $(this).data('subcomponent');

        $('#edit_subcomponent_id').val(id);
        $('#edit_component option').filter(function() {
            return $(this).text() == component;
        }).prop('selected', true);
        $('#edit_subcomponent').val(subcomponent);

        $('#editModal').modal('show');
    });
});
</script>

<?php include('./footer.php'); ?>
