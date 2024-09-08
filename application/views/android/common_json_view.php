<main role="main" class="container">
    <?php if(!empty($viewJsonBanner)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
          <h5 class="d-inline-block m-0"> Common Json </h5>
          <small class="text-left ml-1"> View Android Common Json </small> 
          <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="pt-2 overflow-none">
            <div class="row small">
                <?php foreach($viewJsonBanner as $data) { ?>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card my-2">
                      <img class="card-img-top" src="<?php echo base_url(); ?>/uploads/banners/<?php echo $data->banner_image; ?>" alt="banners">
                      <div class="card-body">
                        <p class="card-title m-0"><b><?php echo $data->banner_title; ?></b></p>
                        <p class="m-0"><?php echo $data->banner_description; ?></p>
                        <p class="m-0"><?php echo $data->banner_url; ?></p>
                        <p class="m-0"><b>Button</b> : <?php echo $data->banner_button; ?></p>
                      </div>
                    </div> 
                </div>
                <?php } ?>
            </div>
            <div class="btn btn-primary btn-sm mt-2"><a href="<?php echo base_url();?>edit-common-json/<?php echo md5($jsonData->json_id); ?>" class="text-white"> Edit Common Json Data </a> </div>
        </div>
    </div>
    <?php } ?>
    <?php if(empty($viewJsonBanner)) { ?>
        <div class="my-3 p-4 bg-white rounded box-shadow">
            <div class="span small text-center">
                <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
                <h5 class="d-block mb-1">No common json data found</h5>
                <p class="d-block mb-3">Please add common json for new app.</p>
                <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>new-common-json" class="text-white"> New Common Json </a> </div>
            </div> 
        </div>
    <?php } ?>
</main>

