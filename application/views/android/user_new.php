<main role="main" class="container">
    <?php
        $userName = null; $userEmail = null; $userPassword = null; $userRole = null; 
        if (form_error('user_name') != null){
        	$userName = "Please enter user name *";
        }
        if (form_error('user_email') != null){
        	$userEmail = "Please enter user email *";
        }
        if (form_error('user_password') != null){
        	$userPassword = "Please enter user password *";
        }
        if (form_error('user_role') != null){
        	$userRole = "Please enter user role *";
        }
    ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> User </h5>
            <small class="text-left ml-1"> New User </small> 
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
                    <div class="col-12">
                        <div class="form-group">
                            <?php if($userName != null){ ?>
                                <label class="text-danger"><?php echo $userName; ?></label>
                            <?php } else { ?>
                                <label>User Name *</label>
                            <?php } ?>
                            <input type="text" name="user_name" class="form-control" placeholder="Enter User Name">
                        </div>
                        <div class="form-group">
                            <?php if($userEmail != null){ ?>
                                <label class="text-danger"><?php echo $userEmail; ?></label>
                            <?php } else { ?>
                                <label>User Email *</label>
                            <?php } ?>
                            <input type="email" name="user_email" class="form-control" placeholder="Enter User Email">
                        </div>
                        <div class="form-group">
                            <?php if($userPassword != null){ ?>
                                <label class="text-danger"><?php echo $userPassword; ?></label>
                            <?php } else { ?>
                                <label>User Password *</label>
                            <?php } ?>
                            <input type="password" name="user_password" class="form-control" placeholder="Enter User Password">
                        </div>
                        <div class="form-group">
                            <?php if($userRole != null){ ?>
                                <label class="text-danger"><?php echo $userRole; ?></label>
                            <?php } else { ?>
                                <label>User Role</label>
                          <?php } ?>
                          <select name="user_role" class="form-control">
                            <option value="Administrator"> Administrator </option>
                            <option value="Editor"> Editor </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>User Status *</label>
                          <select name="user_status" class="form-control">
                            <option value="active"> Active </option>
                            <option value="blocked"> Blocked </option>
                          </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>

