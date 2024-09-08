<main role="main" class="container">
    <?php if(!empty($viewUser)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
          <h5 class="d-inline-block m-0"> User </h5>
          <small class="text-left ml-1"> All User </small> 
            <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-user" class="text-white"> New User </a></div>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-user" class="text-white"> New User </a></div>
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
                          <th>Email</th>
                          <th>Role</th>
                          <th>Key</th>
                          <th>Login</th>
                          <th>Status</th>
                          <th>Is Login</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach($viewUser as $data) { ?>
                    <tbody>
                        <tr class="small" id="<?php echo md5($data['user_id']) ?>">
                          <th scope="row"> <?php echo $data['user_id']; ?> </th>
                          <td> <?php echo $data['user_name']; ?> </td>
                          <td> <?php echo $data['user_email']; ?> </td>
                          <td> <?php echo $data['user_role']; ?> </td>
                          <td> <?php echo $data['user_key']; ?> </td>
                          <td> <?php echo $data['user_login']; ?> </td>
                          <td> <?php echo $data['user_status']; ?> </td>
                          <td> <?php echo $data['is_login']; ?> </td>
                          <td> 
                              <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>edit-user/<?php echo md5($data['user_id']) ?>" class="text-white"> <i class="far fa-edit"></i> </a></div>
                              <?php if($data['user_role'] == "Administrator"){ ?>
                                <a href="<?php echo base_url();?>delete-user/<?php echo md5($data['user_id']) ?>" class="btn btn-danger btn-sm mb-0 mb-md-0 disabled" tabindex="-1" role="button" aria-disabled="true"><i class="fas fa-trash-alt"></i></a>
                              <?php } else { ?>
                                <div class="btn btn-danger btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>delete-user/<?php echo md5($data['user_id']) ?>" class="text-white"><i class="fas fa-trash-alt"></i></a></div>
                              <?php } ?>
                          </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
        <ul class="pagination justify-content-center mt-3">
          <?php echo $this->pagination->create_links(); ?>
        </ul>
    </div>
    <?php } ?>
    <?php if(empty($viewUser)) { ?>
    <div class="my-3 p-4 bg-white rounded box-shadow">
      <div class="span small text-center">
        <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
        <h5 class="d-block mb-1">No user data found</h5>
        <p class="d-block mb-3">Please add user from below button.</p>
        <div class="btn btn-primary btn-sm mb-0 mb-md-0"><a href="<?php echo base_url();?>new-user" class="text-white"> New User </a> </div>
      </div> 
    </div>
    <?php } ?>
</main>