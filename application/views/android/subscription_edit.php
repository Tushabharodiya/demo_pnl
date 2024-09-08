<main role="main" class="container">
    <form action="" method="post">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
                <h5 class="d-inline-block m-0"> Subscription </h5>
                <small class="text-left ml-1"> Edit Subscription </small> 
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
                <div class="form-group col-md-6">
                    <label>Subscription Code *</label>
                    <input type="text" name="subscription_code" class="form-control" value="<?php echo $androidSubscriptionData->subscription_code ?>" placeholder="Enter Subscription Code">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Title One *</label>
                    <input type="text" name="subscription_title_one" class="form-control" value="<?php echo $androidSubscriptionData->subscription_title_one ?>" placeholder="Enter Subscription Title One">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Title Two *</label>
                    <input type="text" name="subscription_title_two" class="form-control" value="<?php echo $androidSubscriptionData->subscription_title_two ?>" placeholder="Enter Subscription Title Two">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Title Three *</label>
                    <input type="text" name="subscription_title_three" class="form-control" value="<?php echo $androidSubscriptionData->subscription_title_three ?>" placeholder="Enter Subscription Title Three">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Title Four *</label>
                    <input type="text" name="subscription_title_four" class="form-control" value="<?php echo $androidSubscriptionData->subscription_title_four ?>" placeholder="Enter Subscription Title Four">
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Primary *</label>
                    <select name="subscription_primary" class="form-control">
                    <option value="<?php echo $androidSubscriptionData->subscription_primary; ?>"><?php echo $androidSubscriptionData->subscription_primary; ?></option>
                    <option value="true">True</option>
                    <option value="false">False</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Subscription Status *</label>
                    <select name="subscription_status" class="form-control">
                    <option value="<?php echo $androidSubscriptionData->subscription_status; ?>"><?php echo $androidSubscriptionData->subscription_status; ?></option>
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary"> 
    </form>
</main>