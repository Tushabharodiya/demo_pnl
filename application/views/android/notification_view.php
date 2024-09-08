<main role="main" class="container">
    <?php if(!empty($viewNotification)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
          <h5 class="d-inline-block m-0"> Notification </h5>
          <small class="text-left ml-1"> All Notification </small>
          <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0 mt-2"><a href="<?php echo base_url();?>new-notification" class="text-white"> New Notification </a></div>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0 mt-2"><a href="<?php echo base_url();?>new-notification" class="text-white"> New Notification </a></div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="pt-3 overflow-none">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark small">
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>App Name</th>
                          <th>Title</th>
                          <th>Message</th>
                          <th>URL</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach($viewNotification as $data) { ?>
                    <tr class="small">
                        <th scope="row"> <?php echo $data['notification_id']; ?> </th>
                        <td> <img src="<?php echo base_url(); ?>/uploads/notification/<?php echo $data['notification_image']; ?>" height="80" width="80"> </td>
                        <td> <?php echo $data['appData']->app_name; ?> </td>
                        <td> <?php echo $data['notification_title']; ?> </td>
                        <td> <?php echo $data['notification_message']; ?> </td>
                        <td> <?php echo $data['notification_url']; ?> </td>
                        <td> <?php echo $data['notification_status']; ?> </td>
                        <td> 
                          <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>edit-notification/<?php echo md5($data['notification_id']);?>" class="text-white"><i class="far fa-edit"></i></a></div>
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
    <?php if(empty($viewNotification)) { ?>
    <div class="my-3 p-4 bg-white rounded box-shadow">
      <div class="span small text-center">
        <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
        <h5 class="d-block mb-1">Notification Database is Empty</h5>
        <p class="d-block mb-3">Please add notification from the below button.</p>
        <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>new-notification" class="text-white"> New Notification </a></div>
      </div> 
    </div>
    <?php } ?>
</main>






