<main role="main" class="container"> 
    <?php
        $subscriptionCode = null; $subscriptionTitleOne = null; $subscriptionTitleTwo = null; $subscriptionTitleThree = null; 
        $subscriptionTitleFour = null;
        if (form_error('subscription_code') != null){
            $subscriptionCode = "Please enter subscription code*";
        }
        if (form_error('subscription_title_one') != null){
            $subscriptionTitleOne = "Please enter subscription title one*";
        }
        if (form_error('subscription_title_two') != null){
        $subscriptionTitleTwo = "Please enter subscription title two*";
        }
        if (form_error('subscription_title_three') != null){
            $subscriptionTitleThree = "Please enter subscription title three*";
        }
        if (form_error('subscription_title_four') != null){
            $subscriptionTitleFour = "Please enter subscription title four*";
        }
    ?> 
    <form action="" method="post">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
                <h5 class="d-inline-block m-0"> Subscription </h5>
                <small class="text-left ml-1"> New Subscription </small>
                <?php if(!empty($this->session->userdata['user_role'])) { ?>
                    <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                        <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="overflow-none mt-3">
            <div class="row small">
                <input type="hidden" name="app_id" value="<?php echo $data['app_id'] ?>">
                <div class="form-group col-md-6">
                    <?php if($subscriptionCode != null){ ?>
                    <label class="text-danger"><?php echo $subscriptionCode; ?></label>
                    <?php } else { ?>
                        <label>Subscription Code *</label>
                    <?php } ?>
                    <input type="text" name="subscription_code" class="form-control" placeholder="Enter Subscription Code">
                </div>
                <div class="form-group col-md-6">
                    <?php if($subscriptionTitleOne != null){ ?>
                    <label class="text-danger"><?php echo $subscriptionTitleOne; ?></label>
                    <?php } else { ?>
                        <label>Subscription Title One *</label>
                    <?php } ?>
                    <input type="text" name="subscription_title_one" class="form-control" placeholder="Enter Subscription Title One">
                </div>
                <div class="form-group col-md-6">
                    <?php if($subscriptionTitleTwo != null){ ?>
                    <label class="text-danger"><?php echo $subscriptionTitleTwo; ?></label>
                    <?php } else { ?>
                        <label>Subscription Title Two *</label>
                    <?php } ?>
                    <input type="text" name="subscription_title_two" class="form-control" placeholder="Enter Subscription Title Two">
                </div>
                <div class="form-group col-md-6">
                    <?php if($subscriptionTitleThree != null){ ?>
                    <label class="text-danger"><?php echo $subscriptionTitleThree; ?></label>
                    <?php } else { ?>
                        <label>Subscription Title Three *</label>
                    <?php } ?>
                    <input type="text" name="subscription_title_three" class="form-control" placeholder="Enter Subscription Title Three">
                </div>
                <div class="form-group col-md-6">
                    <?php if($subscriptionTitleFour != null){ ?>
                    <label class="text-danger"><?php echo $subscriptionTitleFour; ?></label>
                    <?php } else { ?>
                        <label>Subscription Title Four *</label>
                    <?php } ?>
                    <input type="text" name="subscription_title_four" class="form-control" placeholder="Enter Subscription Title Four">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Primary *</label>
                    <select name="subscription_primary" class="form-control">
                    <option value="true">True</option>
                    <option value="false">False</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Status *</label>
                    <select name="subscription_status" class="form-control">
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>