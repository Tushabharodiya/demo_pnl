<main role="main" class="container">   
    <?php
        $versionName = null; $versionCode = null; $adsCountOne = null; $adsCountTwo = null; $adsCountThree = null; $adsCountFour = null; $reviewCount = null;
      	if (form_error('version_name') != null){
      		$versionName = "Please enter version name *";
      	}
      	if (form_error('version_code') != null){
      		$versionCode = "Please enter version code *";
      	}
      	if (form_error('ads_count_one') != null){
      		$adsCountOne = "Please enter ads count one*";
      	}
        if (form_error('ads_count_two') != null){
          $adsCountTwo = "Please enter ads count two*";
        }
        if (form_error('ads_count_three') != null){
          $adsCountThree = "Please enter ads count three*";
        }
        if (form_error('ads_count_four') != null){
          $adsCountFour = "Please enter ads count four*";
        }
      	if (form_error('review_count') != null){
      		$reviewCount = "Please enter review count *";
      	}
    ?> 

    <form action="" method="post">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border p-3">
              <h5 class="d-inline-block m-0"> Version </h5>
              <small class="text-left ml-1"> New Version </small>
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
                        <input type="hidden" name="app_id" value="<?php echo $data['app_id'] ?>">
                        <?php if($versionName != null){ ?>
                      	    <label class="text-danger"><?php echo $versionName; ?></label>
                        <?php } else { ?>
                          <label>Version Name *</label>
                        <?php } ?>
                        <input type="text" name="version_name" class="form-control" placeholder="Enter Version Name">
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($versionCode != null){ ?>
                    	    <label class="text-danger"><?php echo $versionCode; ?></label>
                        <?php } else { ?>
                            <label>Version Code *</label>
                        <?php } ?>
                        <input type="text" name="version_code" class="form-control" placeholder="Enter Version Code">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Main Api *</label>
                        <input type="text" name="main_api" class="form-control" placeholder="https://example.com/api/">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Data Api *</label>
                        <input type="text" name="data_api" class="form-control" placeholder="https://example.com/data/">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Ads *</label>
                        <select name="app_ads" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Banner *</label>
                        <select name="app_banner" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Splash Ads *</label>
                        <select name="splash_ads" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Screen Ads *</label>
                        <select name="screen_ads" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($adsCountOne != null){ ?>
                    	    <label class="text-danger"><?php echo $adsCountOne; ?></label>
                        <?php } else { ?>
                            <label>Ads Count One*</label>
                        <?php } ?>
                        <input type="text" name="ads_count_one" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($adsCountTwo != null){ ?>
                            <label class="text-danger"><?php echo $adsCountTwo; ?></label>
                        <?php } else { ?>
                            <label>Ads Count Two*</label>
                        <?php } ?>
                        <input type="text" name="ads_count_two" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($adsCountThree != null){ ?>
                            <label class="text-danger"><?php echo $adsCountThree; ?></label>
                        <?php } else { ?>
                            <label>Ads Count Three*</label>
                        <?php } ?>
                        <input type="text" name="ads_count_three" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($adsCountFour != null){ ?>
                            <label class="text-danger"><?php echo $adsCountFour; ?></label>
                        <?php } else { ?>
                            <label>Ads Count Four*</label>
                        <?php } ?>
                        <input type="text" name="ads_count_four" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Review *</label>
                        <select name="app_review" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <?php if($reviewCount != null){ ?>
                    	    <label class="text-danger"><?php echo $reviewCount; ?></label>
                        <?php } else { ?>
                            <label>Review Count *</label>
                        <?php } ?>
                        <input type="text" name="review_count" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Title *</label>
                        <input type="text" name="update_title" class="form-control" placeholder="Enter Update Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Description *</label>
                        <input type="text" name="update_description" class="form-control" placeholder="Enter Update Description">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Url *</label>
                        <input type="text" name="update_url" class="form-control" placeholder="Enter Update Url">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Update Button *</label>
                        <input type="text" name="update_button" class="form-control" placeholder="Enter Update Button">
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Update *</label>
                        <select name="app_update" class="form-control">
                            <option value="false">False</option>
                            <option value="true">True</option>
                            <option value="critical">Critical</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Open *</label>
                        <select name="app_open" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Subscription *</label>
                        <select name="app_subscription" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>App Rewarded *</label>
                        <select name="is_rewarded" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Version Status *</label>
                        <select name="version_status" class="form-control">
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
</main>
           


