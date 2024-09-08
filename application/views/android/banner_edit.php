<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Banner </h5>
            <small class="text-left ml-1"> Edit Banner </small> 
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                <?php } ?>
            <?php } ?>
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="pt-3 overflow-none">     
                <div class="row small">
                    <div class="form-group col-md-6">
                        <label>Banner Title</label>
                        <input type="text" name="banner_title" class="form-control" value="<?php echo $androidBannerData->banner_title ?>" placeholder="Enter Banner Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Description</label>
                        <input type="text" name="banner_description" class="form-control" value="<?php echo $androidBannerData->banner_description ?>" placeholder="Enter Banner Description">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Image - Upload Size 720 x 280</label>
                        <div class="form-group custom-file">
                            <label class="custom-file-label" >Choose Banner</label>
                            <input type="file" name="banner_image" class="custom-file-input">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Url</label>
                        <input type="text" name="banner_url" class="form-control" value="<?php echo $androidBannerData->banner_url ?>" placeholder="Enter Banner URL">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Button</label>
                        <input type="text" name="banner_button" class="form-control" value="<?php echo $androidBannerData->banner_button ?>" placeholder="Enter Banner Button">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Banner Status</label>
                        <select name="banner_status" class="form-control">
                            <option value="<?php echo $androidBannerData->banner_status ?>"> <?php echo $androidBannerData->banner_status ?> </option>
                            <option value="true"> True </option>
                            <option value="false"> False </option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</main>




