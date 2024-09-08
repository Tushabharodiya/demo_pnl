<main role="main" class="container">
    <?php if(!empty($viewBanner)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Banner </h5>
            <small class="text-left ml-1"> Android Banner </small> 
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-banner" class="text-white"> New Android Banner </a></div>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-banner" class="text-white"> New Android Banner </a></div>
                <?php } ?>
            <?php } ?>
        </div>
    
        <div class="pt-2 overflow-none">
            <div class="row small">
                <?php foreach($viewBanner as $data) { ?>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card my-2">
                        <img class="card-img-top" src="<?php echo base_url(); ?>/uploads/banners/<?php echo $data->banner_image; ?>" alt="banners">
                        <div class="card-body">
                            <p class="card-title m-0"><b><?php echo $data->banner_title; ?></b></p>
                            <p class="m-0"><?php echo $data->banner_description; ?></p>
                            <p class="m-0"><?php echo $data->banner_url; ?></p>
                            <p class="m-0"><b>Button</b> : <?php echo $data->banner_button; ?></p>
                            <p class="mb-3"><b>Status</b> : <?php echo $data->banner_status; ?></p>
                            <div class="btn btn-primary btn-sm mb-0"><a href="<?php echo base_url();?>edit-banner/<?php echo md5($data->banner_id); ?>" class="text-white">Edit Banner</a> </div>
                            <div class="btn btn-danger btn-sm mb-0"><a href="<?php echo base_url();?>delete-banner/<?php echo md5($data->banner_id); ?>" class="text-white">Delete Banner</a> </div>
                        </div>
                    </div> 
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
  
    <?php if(empty($viewBanner)) { ?>
      <div class="my-3 p-4 bg-white rounded box-shadow">
        <div class="span small text-center">
          <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
          <h5 class="d-block mb-1">No banners data found</h5>
          <p class="d-block mb-3">Please add some banners for common json data.</p>
          <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>new-banner" class="text-white"> New Banner </a></div>
        </div> 
      </div>
    <?php } ?>
</main>

