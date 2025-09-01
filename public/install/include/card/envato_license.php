<?php
if (!session_get('requirement')) { ?>
    <script>
        window.location.href = '/?a=requirement';
    </script>
<?php
    exit();
}

// ✅ Backend Processing (No validation)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'envato-license') {
    $user_id      = $_POST['user_id'] ?? '';
    $purchase_key = $_POST['purchase_key'] ?? '';

    // Save function (Optional, your system function)
    if (function_exists('save_license_data')) {
        save_license_data($user_id, $purchase_key);
    }

    // Set session that Envato step is done
    session_set('envato_license', true);

    // Success → next step
    header("Location: ./?a=env_requirement");
    exit();
}
?>

<h1>Envato License</h1>
<div class="row">
    <div class="col-md-12">
        <fieldset>
            <legend>Envato License (Optional)</legend>

            <div class="row">
                <div class="col-md-12">
                    <!-- Optional: Previous purchase key update link -->
                    <?php if (get_purchase_data('purchase_key_used') && isset($_GET['status']) && $_GET['status']) { ?>
                        <a target="_blank" class="btn btn-warning pull-right" 
                           href="#" role="button">Update Purchase Key</a>
                    <?php } ?>
                </div>
            </div>

            <form class="form-horizontal" method="POST" action="./">
                <input type="hidden" name="action" value="envato-license">

                <div class="form-group">
                    <label for="user_id" class="col-sm-4 col-form-label">Envato User ID
                        <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom"
                              title="Enter Envato User ID or Enter 'bdtask' as non Envato User"></span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="user_id" name="user_id" 
                               value="<?php echo @$_GET['user_id'] ?>" placeholder="User ID">
                    </div>
                </div>

                <div class="form-group">
                    <label for="purchase_key" class="col-sm-4 col-form-label">Purchase Key
                        <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom"
                              title="Enter Purchase Key or leave empty"></span>
                    </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="purchase_key" 
                               value="<?php echo @$_GET['purchase_key'] ?>" name="purchase_key" 
                               placeholder="Purchase Key">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </div>
            </form>

            <!-- ✅ Skip Button (Optional, go to next step directly) -->
            <div class="row">
                <div class="col-sm-12">
                    <a href="./?a=env_requirement" class="btn btn-primary btn-sm pull-right" style="margin-top:10px;">
                        Skip & Go to Next Step
                    </a>
                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 ">
        <br><br>
        <a href="./?a=requirement" class="btn btn-success pull-left aiia-wizard-button-previous"><span>Previous</span></a>
    </div>
</div>
