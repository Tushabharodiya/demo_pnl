<main role="main" class="container">
    <?php if(!empty($viewVersion)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Version </h5>
            <small class="text-left ml-1"> Android Version </small>
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php foreach($viewVersion as $data) { }?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-version/<?php echo md5($data['app_id']);?>" class="text-white"> New Version </a></div>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-version/<?php echo md5($data['app_id']);?>" class="text-white"> New Version </a></div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="pt-3 overflow-none">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark small">
                        <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Code</th>
                              <th>Ads</th>
                              <th>Splash</th>
                              <th>Screen</th>
                              <th>Banner</th>
                              <th>Review</th>
                              <th>Update</th>
                              <th>App</th>
                              <th>Subscription</th>
                              <th>Rewarded</th>
                              <th>Status</th>
                              <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach($viewVersion as $data) { ?>
                        <tr class="small">
                            <th scope="row"> <?php echo $data['version_id'] ?> </th>
                            <td> <?php echo $data['version_name']; ?> </td>
                            <td> <?php echo $data['version_code']; ?> </td>
                            <td> <?php echo $data['app_ads']; ?> </td>
                            <td> <?php echo $data['splash_ads']; ?> </td>
                            <td> <?php echo $data['screen_ads']; ?> </td>
                            <td> <?php echo $data['app_banner']; ?> </td>
                            <td> <?php echo $data['app_review']; ?> </td>
                            <td> <?php echo $data['app_update']; ?> </td>
                            <td> <?php echo $data['app_open']; ?> </td>
                            <td> <?php echo $data['app_subscription']; ?> </td>
                            <td> <?php echo $data['is_rewarded']; ?> </td>
                            <td> <?php echo $data['version_status']; ?> </td>
                            <td> 
                            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>description-version/<?php echo md5($data['version_id']);?>" class="text-white"> <i class="far fa-eye"></i> </a> </div>
                            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>edit-version/<?php echo md5($data['version_id']);?>" class="text-white"> <i class="far fa-edit"></i>  </a> </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <ul class="pagination justify-content-center mt-3">
            <?php echo $this->pagination->create_links(); ?>
        </ul>
    </div>
    <?php } ?>
    <?php if(empty($viewVersion)) { ?>
    <div class="my-3 p-4 bg-white rounded box-shadow">
        <div class="span small text-center">
            <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
            <h5 class="d-block mb-1">No version data found</h5>
            <p class="d-block mb-3">Please add version from below button.</p>
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>new-version" class="text-white"> New Version </a> </div>
        </div> 
    </div>
    <?php } ?>
</main>