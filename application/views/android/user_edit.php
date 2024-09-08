<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
            <h5 class="d-inline-block m-0"> User </h5>
            <small class="text-left ml-1"> Edit User </small> 
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
                            <label>User Name *</label>
                            <input type="text" name="user_name" class="form-control" value="<?php echo $userData->user_name ?>" placeholder="Enter User Name">
                        </div>
                        <div class="form-group">
                            <label>User Email *</label>
                            <input type="email" name="user_email" class="form-control" value="<?php echo $userData->user_email ?>" placeholder="Enter User Email">
                        </div>
                        <div class="form-group">
                            <label>User Password </label>
                            <input type="password" name="user_password" class="form-control" placeholder="Enter User Password">
                        </div>
                        <div class="form-group">
                            <label>User Role *</label>
                            <select name="user_role" class="form-control">
                                <option value="Administrator"<?php if($userData->user_role =="Administrator"){ echo "selected"; } else { echo ""; } ?>>Administrator</option> 
                                <option value="Editor"<?php if($userData->user_role =="Editor"){ echo "selected"; } else { echo ""; } ?>>Editor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>User Status *</label>
                            <select name="user_status" class="form-control">
                                <option value="<?php echo $userData->user_status ?>"> <?php echo $userData->user_status ?> </option>
                                <option value="active"> Active </option>
                                <option value="blocked"> Blocked </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</main>
