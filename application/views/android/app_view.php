<main role="main" class="container">
    <?php if(!empty($viewAndroidApp)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Android </h5>
            <small class="text-left ml-1"> Android Applications </small> 
            <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
            <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-app" class="text-white"> New App </a></div>
            <?php $sessionSearch =  $this->session->userdata('session_search'); ?>
            <form method="post">
            <div class="row">
                <div class="col-md-9 mt-3">
                    <input type="text" name="search" class="form-control" autocomplete="off" value="<?php echo $sessionSearch; ?>" placeholder="Search . . ." >
                </div>
                <div class="col-md-3 mt-3">
                    <input type="submit" name="submit" class="btn btn-outline-success" value="Search">
                    <input type="submit" name="reset_search" class="btn btn-outline-danger" value="Reset">
                </div>
            </div>
            </form>
        </div>
    
        <div class="pt-2 overflow-none">
            <div class="row small">
                <?php foreach($viewAndroidApp as $data) { ?>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card my-2">
                        <div class="p-5 bg-gray">
                            <img class="card-img-top logo-box" src="<?php echo base_url();?>uploads/logos/<?php echo $data['app_logo'];?>">
                        </div>
                        <div class="card-body">
                            <p class="card-title m-0"><b><?php echo $data['app_name'] ?></b></p>
                            <p class="m-0">Code : <b><?php echo $data['app_code'] ?></b></p>
                            <p class="m-0">Status : <?php echo $data['app_status'] ?></p>
                            <p class="m-0"><?php echo $data['app_package'] ?></p>
                            <div class="mt-2">
                                <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>description-app/<?php echo md5($data['app_id'])?>" class="text-white"> <i class="far fa-eye"></i> </a></div>
                                <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="https://play.google.com/store/apps/details?id=<?php echo $data['app_package'] ?>" target="_blank" class="text-white"> Go to Play Store </a></div>
                            </div>
                        </div>
                    </div> 
                </div>
                <?php } ?>
            </div>
        </div>
    
        <ul class="pagination justify-content-center mt-3">
          <?php echo $this->pagination->create_links(); ?>
        </ul>
    
    </div>
    <?php } ?>
  
    <?php if(empty($viewAndroidApp)) { ?>
        <div class="my-3 p-4 bg-white rounded box-shadow">
            <div class="span small text-center">
                <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
                <h5 class="d-block mb-1">No application data found</h5>
                <p class="d-block mb-3">Please add application from below button.</p>
                <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>app-new" class="text-white"> New Application </a></div>
            </div> 
        </div>
    <?php } ?>
</main>






