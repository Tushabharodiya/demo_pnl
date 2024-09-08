<main role="main" class="container">
    <form action="" method="post">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
              <h5 class="d-inline-block m-0"> Version </h5>
              <small class="text-left ml-1"> Edit Version </small> 
              <?php if(!empty($this->session->userdata['user_role'])) { ?>
                <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                    <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                    <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                <?php } ?>
            <?php } ?>
             </div>
            <div class="overflow-none border mt-3 p-3">
                <div class="row small">
                    <div class="form-group col-md-6">
                        <label>Version Name *</label>
                        <input type="text" name="version_name" class="form-control" value="<?php echo $androidVersionData->version_name ?>" placeholder="Enter Version Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Version Code *</label>
                        <input type="text" name="version_code" class="form-control" value="<?php echo $androidVersionData->version_code ?>" placeholder="Enter Version Code">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Main Api *</label>
                        <input type="text" name="main_api" class="form-control" value="<?php echo $androidVersionData->main_api ?>" placeholder="https://example.com/api/">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Data Api *</label>
                        <input type="text" name="data_api" class="form-control" value="<?php echo $androidVersionData->data_api ?>" placeholder="https://example.com/data/">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Ads *</label>
                        <select name="app_ads" class="form-control">
                          <option value="<?php echo $androidVersionData->app_ads; ?>"><?php echo $androidVersionData->app_ads; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Banner *</label>
                        <select name="app_banner" class="form-control">
                          <option value="<?php echo $androidVersionData->app_banner; ?>"><?php echo $androidVersionData->app_banner; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Splash Ads *</label>
                        <select name="splash_ads" class="form-control">
                          <option value="<?php echo $androidVersionData->splash_ads; ?>"><?php echo $androidVersionData->splash_ads; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Screen Ads *</label>
                        <select name="screen_ads" class="form-control">
                          <option value="<?php echo $androidVersionData->screen_ads; ?>"><?php echo $androidVersionData->screen_ads; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ads Count One *</label>
                        <input type="text" name="ads_count_one" class="form-control" value="<?php echo $androidVersionData->ads_count_one ?>" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ads Count Two *</label>
                        <input type="text" name="ads_count_two" class="form-control" value="<?php echo $androidVersionData->ads_count_two ?>" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ads Count Three *</label>
                        <input type="text" name="ads_count_three" class="form-control" value="<?php echo $androidVersionData->ads_count_three ?>" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ads Count Four *</label>
                        <input type="text" name="ads_count_four" class="form-control" value="<?php echo $androidVersionData->ads_count_four ?>" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Review *</label>
                        <select name="app_review" class="form-control">
                          <option value="<?php echo $androidVersionData->app_review; ?>"><?php echo $androidVersionData->app_review; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Review Count *</label>
                        <input type="text" name="review_count" class="form-control" value="<?php echo $androidVersionData->review_count ?>" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Title *</label>
                        <input type="text" name="update_title" class="form-control" value="<?php echo $androidVersionData->update_title ?>" placeholder="Enter Update Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Description *</label>
                        <input type="text" name="update_description" class="form-control" value="<?php echo $androidVersionData->update_description ?>" placeholder="Enter Update Description">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Url *</label>
                        <input type="text" name="update_url" class="form-control" value="<?php echo $androidVersionData->update_url ?>" placeholder="Enter Update Url">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Button *</label>
                        <input type="text" name="update_button" class="form-control" value="<?php echo $androidVersionData->update_button ?>" placeholder="Enter Update Button">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Update *</label>
                        <select name="app_update" class="form-control">
                          <option value="<?php echo $androidVersionData->app_update; ?>"><?php echo $androidVersionData->app_update; ?></option>
                          <option value="false">False</option>
                          <option value="true">True</option>
                          <option value="critical">Critical</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Open *</label>
                        <select name="app_open" class="form-control">
                          <option value="<?php echo $androidVersionData->app_open; ?>"><?php echo $androidVersionData->app_open; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Subscription *</label>
                        <select name="app_subscription" class="form-control">
                          <option value="<?php echo $androidVersionData->app_subscription; ?>"><?php echo $androidVersionData->app_subscription; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Rewarded *</label>
                        <select name="is_rewarded" class="form-control">
                          <option value="<?php echo $androidVersionData->is_rewarded; ?>"><?php echo $androidVersionData->is_rewarded; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Version Status *</label>
                        <select name="version_status" class="form-control">
                          <option value="<?php echo $androidVersionData->version_status; ?>"><?php echo $androidVersionData->version_status; ?></option>
                          <option value="true">True</option>
                          <option value="false">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary  mt-3">
        </div>
    </form>
</main>
           


