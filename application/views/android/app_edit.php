<main role="main" class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
                <h5 class="d-inline-block m-0"> Application </h5>
                <small class="text-left ml-1"> Edit Application </small>
                <?php if(!empty($this->session->userdata['user_role'])) { ?>
                    <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                        <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <?php } ?>
                <?php } ?>
            </div>    
            <div class="overflow-none">
                <div class="border p-3 mt-3"> 
                    <div class="row small">
                        <div class="form-group col-md-6">
                            <label>App Code *</label>
                            <input type="text" name="app_code" class="form-control" value="<?php echo $androidAppData->app_code; ?>" placeholder="Enter Application Code">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Name *</label>
                            <input type="text" name="app_name" class="form-control" value="<?php echo $androidAppData->app_name; ?>" placeholder="Enter Application Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Package *</label>
                            <input type="text" name="app_package" class="form-control" value="<?php echo $androidAppData->app_package; ?>" placeholder="Enter Application Package">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Logo *</label>
                            <div class="form-group custom-file">
                                <label class="custom-file-label" >Choose Application Logo</label>
                                <input type="file" name="app_logo" class="custom-file-input"  value="<?php echo $androidAppData->app_logo; ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Developer *</label>
                            <input type="text" name="app_developer" class="form-control" value="<?php echo $androidAppData->app_developer; ?>" placeholder="Enter Application Developer">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Website *</label>
                            <input type="text" name="app_website" class="form-control" value="<?php echo $androidAppData->app_website; ?>" placeholder="Enter Application Website">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Email *</label>
                            <input type="text" name="app_email" class="form-control" value="<?php echo $androidAppData->app_email; ?>" placeholder="Enter Application Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Store *</label>
                            <input type="text" name="app_store" class="form-control" value="<?php echo $androidAppData->app_store; ?>" placeholder="Enter Application Store Url">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Privacy *</label>
                            <input type="text" name="app_privacy" class="form-control" value="<?php echo $androidAppData->app_privacy; ?>" placeholder="Enter Application Privacy">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Terms *</label>
                            <input type="text" name="app_terms" class="form-control" value="<?php echo $androidAppData->app_terms; ?>" placeholder="Enter Application Terms">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Support *</label>
                            <input type="text" name="app_support" class="form-control" value="<?php echo $androidAppData->app_support; ?>" placeholder="Enter Application Support">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Realese *</label>
                            <input type="date" name="app_release" class="form-control" value="<?php echo $androidAppData->app_release; ?>" placeholder="Enter Application Release Date">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Status *</label>
                            <select name="app_status" class="form-control">
                                <option value="<?php echo $androidAppData->app_status; ?>"><?php echo $androidAppData->app_status; ?></option>
                                <option value="draft">Draft</option>
                                <option value="development">Development</option>
                                <option value="publish">Publish</option>
                                <option value="unpublish">UnPublish</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                </div>    
            </div>
            <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3">
        </div>
    </form>
</main>    

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

 



