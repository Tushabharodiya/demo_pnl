<main role="main" class="container">
    <?php if(!empty($androidBannerData)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Json </h5>
            <small class="text-left ml-1"> Edit json </small> 
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                <?php } ?>
            <?php } ?>
        </div>
    
        <form action="" method="post">
            <div class="pt-3 overflow-none">
                <div class="row small">
                    <?php foreach($androidBannerData as $data) { ?>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card my-2">
                            <img class="card-img-top" src="<?php echo base_url(); ?>/uploads/banners/<?php echo $data->banner_image; ?>" alt="banners">
                            <div class="card-body">
                                <p class="card-title"><b><?php echo $data->banner_title; ?></b></p>
                                <p class="m-0"><?php echo $data->banner_description; ?></p>
                                <p class="m-0"><?php echo $data->banner_url; ?></p>
                                <p class="m-0"><b>Button</b> : <?php echo $data->banner_button; ?></b></p>
                            <div class="form-group m-0 border-top pt-3">
                                <input type="checkbox" name="data_json[]" value="<?php echo $data->banner_id; ?>" 
                            <?php if(!empty($androidJsonData)){
                                $bannerIDs = $androidJsonData->json_data;
                		        $bannerArray = explode(",",$bannerIDs);
                		        foreach ($bannerArray as $row) {
                		        $bannerID = $row;
                		        if($bannerID == $data->banner_id){ ?>
                		          checked
                	        <?php } } } ?> >
                            <label class="form-check-label" for="gridCheck"> Check for JsonData </label>
                        </div>
                    </div>
                </div> 
            </div>
            <?php } ?>
        </div>
    </div>
    <input type="submit" name="submit" value="Update Json Data" class="btn btn-primary btn-sm mt-2">
    </form>
    </div>
    <?php } ?>
  
    <?php if(empty($androidBannerData)) { ?>
        <div class="my-3 p-4 bg-white rounded box-shadow">
            <div class="span text-center">
                <h6 class="d-block m-0">No Banner are Available</h6>
            </div> 
        </div>
    <?php } ?>
</main>

