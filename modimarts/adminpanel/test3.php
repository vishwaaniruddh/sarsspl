<form class="form-horizontal" action="up.php" method="post" name="uploadCSV" enctype="multipart/form-data">
    <div class="input-row">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv">
        <button type="submit"  name="import" class="btn-submit">Import</button>
        <br />

    </div>
    <div id="labelError"></div>
</form>