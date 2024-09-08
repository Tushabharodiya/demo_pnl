<main role="main" class="container">
    <?php if(!empty($viewSubscription)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> Subscription </h5>
            <small class="text-left ml-1"> Android Subscription </small>
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php foreach($viewSubscription as $data) { }?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-subscription/<?php echo md5($data['app_id']);?>" class="text-white"> New Subscription </a></div>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-subscription/<?php echo md5($data['app_id']);?>" class="text-white"> New Subscription </a></div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="pt-3 overflow-none">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark small">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Title One</th>
                            <th>Title Two</th>
                            <th>Title Three</th>
                            <th>Title Four</th>
                            <th>Primary</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach($viewSubscription as $data) { ?>
                        <tr class="small">
                            <th scope="row"> <?php echo $data['subscription_id'] ?> </th>
                            <td> <?php echo $data['subscription_code']; ?> </td>
                            <td> <?php echo $data['subscription_title_one']; ?> </td>
                            <td> <?php echo $data['subscription_title_two']; ?> </td>
                            <td> <?php echo $data['subscription_title_three']; ?> </td>
                            <td> <?php echo $data['subscription_title_four']; ?> </td>
                            <td> <?php echo $data['subscription_primary']; ?> </td>
                            <td> <?php echo $data['subscription_status']; ?> </td>
                            <td> 
                            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>edit-subscription/<?php echo md5($data['subscription_id']);?>" class="text-white"> <i class="far fa-edit"></i>  </a> </div>
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
    <?php if(empty($viewSubscription)) { ?>
    <div class="my-3 p-4 bg-white rounded box-shadow">
        <div class="span small text-center">
            <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
            <h5 class="d-block mb-1">No subscription data found</h5>
            <p class="d-block mb-3">Please add subscription from below button.</p>
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>new-subscription" class="text-white"> New Subscription </a> </div>
        </div> 
    </div>
    <?php } ?>
</main>