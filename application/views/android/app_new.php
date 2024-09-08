<main role="main" class="container">
    <?php
    $appCode = null; $appName = null; $appPackage = null; $appLogo = null; $appDeveloper = null; 
    $appWebsite = null; $appRelease = null; $appStore = null; $versionName = null; $versionCode = null; $adsCount = null; $reviewCount = null;

	if (form_error('app_code') != null){
		$appCode = "Please enter app code *";
	}
	if (form_error('app_name') != null){
		$appName = "Please enter app name *";
	}
	if (form_error('app_package') != null){
		$appPackage = "Please enter app package *";
	}
	if (form_error('app_logo') != null){
		$appLogo = "Please enter app logo *";
	}
	if (form_error('app_developer') != null){
		$appDeveloper = "Please enter app developer *";
	}
	if (form_error('app_website') != null){
		$appWebsite = "Please enter app website *";
	}
	if (form_error('app_release') != null){
		$appRelease = "Please enter app release *";
	}
	if (form_error('app_store') != null){
		$appStore = "Please enter app store *";
	}
	if (form_error('version_name') != null){
		$versionName = "Please enter version name *";
	}
	if (form_error('version_code') != null){
		$versionCode = "Please enter version code *";
	}
	if (form_error('ads_count') != null){
		$adsCount = "Please enter ads count *";
	}
	if (form_error('review_count') != null){
		$reviewCount = "Please enter review count *";
	}
    ?>
 
    <form action="" method="post" enctype="multipart/form-data">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
                <h5 class="d-inline-block m-0"> Application </h5>
                <small class="text-left ml-1"> New Application </small> 
            </div>    
            <div class="overflow-none">
                <div class="border p-3 mt-3"> 
                    <div class="row small">
                        <div class="form-group col-md-6">
                            <?php if($appCode != null){ ?>
                            	<label class="text-danger"><?php echo $appCode; ?></label>
                            <?php } else { ?>
                                <label>App Code *</label>
                            <?php } ?>
                            <input type="text" name="app_code" class="form-control" placeholder="Enter Application Code">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appName != null){ ?>
                            	<label class="text-danger"><?php echo $appName; ?></label>
                            <?php } else { ?>
                                <label>App Name *</label>
                            <?php } ?>
                            <input type="text" name="app_name" class="form-control" placeholder="Enter Application Name">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appPackage != null){ ?>
                            	<label class="text-danger"><?php echo $appPackage; ?></label>
                            <?php } else { ?>
                                <label>App Package *</label>
                            <?php } ?>
                            <input type="text" name="app_package" class="form-control" placeholder="com.example.apps">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appLogo != null){ ?>
                            	<label class="text-danger"><?php echo $appLogo; ?></label>
                            <?php } else { ?>
                                <label>App Logo  - 512 x 512 *</label>
                            <?php } ?>
                            <div class="form-group custom-file">
                                <label class="custom-file-label" >Choose Application Logo</label>
                                <input type="file" name="app_logo" class="custom-file-input">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appDeveloper != null){ ?>
                            	<label class="text-danger"><?php echo $appDeveloper; ?></label>
                            <?php } else { ?>
                                <label>App Developer *</label>
                            <?php } ?>
                            <input type="text" name="app_developer" class="form-control" placeholder="Enter Developer Name">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appWebsite != null){ ?>
                            	<label class="text-danger"><?php echo $appWebsite; ?></label>
                            <?php } else { ?>
                                <label> App Website *</label>
                            <?php } ?>
                            <input type="text" name="app_website" class="form-control" placeholder="Enter App Website">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Email *</label>
                            <input type="email" name="app_email" class="form-control" placeholder="Enter App Email">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appStore != null){ ?>
                            	<label class="text-danger"><?php echo $appStore; ?></label>
                            <?php } else { ?>
                                <label> App Store *</label>
                            <?php } ?>
                            <input type="text" name="app_store" class="form-control" placeholder="Enter App Store Url">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Privacy *</label>
                            <input type="text" name="app_privacy" class="form-control" placeholder="https://example.com/privacy/">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Terms *</label>
                            <input type="text" name="app_terms" class="form-control" placeholder="https://example.com/terms/">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Support *</label>
                            <input type="text" name="app_support" class="form-control" placeholder="https://example.com/support/">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($appRelease != null){ ?>
                                <label class="text-danger"><?php echo $appRelease; ?></label>
                            <?php } else { ?>
                                <label>App Release *</label>
                            <?php } ?>
                            <input type="date" name="app_release" class="form-control" placeholder="Enter Application Release Date">
                        </div>
                        <div class="form-group col-md-6">
                            <label>App Status *</label>
                            <select name="app_status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="development">Development</option>
                                <option value="publish">Publish</option>
                                <option value="unpublish">UnPublish</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span border border-gray bg-light p-3 mt-3">
                <h5 class="d-inline-block m-0"> Version </h5>
                <small class="text-left ml-1"> New Version </small> 
            </div> 
            <div class="overflow-none"> 
                <div class="border p-3 mt-3"> 
                    <div class="row small">
                        <div class="form-group col-md-6"> 
                            <?php if($versionName != null){ ?>
                                <label class="text-danger"><?php echo $versionName; ?></label>
                            <?php } else { ?>
                                <label>Version Name *</label>
                            <?php } ?>
                            <input type="text" name="version_name" class="form-control" placeholder="1.0.0">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($versionCode != null){ ?>
                                <label class="text-danger"><?php echo $versionCode; ?></label>
                            <?php } else { ?>
                                <label>Version Code *</label>
                            <?php } ?>
                            <input type="text" name="version_code" class="form-control" placeholder="1">
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
                            <label>App Open *</label>
                            <select name="app_open" class="form-control">
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
                            <?php if($adsCount != null){ ?>
                                <label class="text-danger"><?php echo $adsCount; ?></label>
                            <?php } else { ?>
                                <label>Ads Count One*</label>
                            <?php } ?>    
                            <input type="text" name="ads_count_one" class="form-control" placeholder="0">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($adsCount != null){ ?>
                                <label class="text-danger"><?php echo $adsCount; ?></label>
                            <?php } else { ?>
                                <label>Ads Count Two*</label>
                            <?php } ?>    
                            <input type="text" name="ads_count_two" class="form-control" placeholder="0">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($adsCount != null){ ?>
                                <label class="text-danger"><?php echo $adsCount; ?></label>
                            <?php } else { ?>
                                <label>Ads Count Three*</label>
                            <?php } ?>    
                            <input type="text" name="ads_count_three" class="form-control" placeholder="0">
                        </div>
                        <div class="form-group col-md-6">
                            <?php if($adsCount != null){ ?>
                                <label class="text-danger"><?php echo $adsCount; ?></label>
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
                            <label>App Update *</label>
                            <select name="app_update" class="form-control">
                                <option value="false">False</option>
                                <option value="normal">Normal</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Is Crawler *</label>
                            <select name="is_crawler" class="form-control">
                                <option value="true">True</option>
                                <option value="false">False</option>
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
            </div>

            <div class="span border border-gray bg-light p-3 mt-3">
                <h5 class="d-inline-block m-0"> Ads </h5>
                <small class="text-left ml-1"> New Ads </small> 
            </div> 
            <div class="overflow-none">
                <div class="border p-3 mt-3">
                    <div class="border borderbox p-3">
                        <label class="small"><b>Banner Ads One Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="banner_ads_one[]" value="@">
                        <label class="small"><b>Banner Ads One Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Banner Ads Two Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="banner_ads_two[]" value="@">
                        <label class="small"><b>Banner Ads Two Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Banner Ads Three Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="banner_ads_three[]" value="@">
                        <label class="small"><b>Banner Ads Three Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Banner Ads Four Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="banner_ads_four[]" value="@">
                        <label class="small"><b>Banner Ads Four Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Banner Ads Five Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="banner_ads_five[]" value="@">
                        <label class="small"><b>Banner Ads Five Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border borderbox p-3">  
                        <label class="small"><b>Native Ads One Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div> 
                        <input type="hidden" name="native_ads_one[]" value="@">
                        <label class="small"><b>Native Ads One Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Two Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_two[]" value="@">
                        <label class="small"><b>Native Ads Two Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Three Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_three[]" value="@">
                        <label class="small"><b>Native Ads Three Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Four Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_four[]" value="@">
                        <label class="small"><b>Native Ads Four Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Five Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="native_ads_five[]" value="@">
                        <label class="small"><b>Native Ads Five Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Six Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_six[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_six[]" value="@">
                        <label class="small"><b>Native Ads Six Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_six[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Seven Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_seven[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_seven[]" value="@">
                        <label class="small"><b>Native Ads Seven Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_seven[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Eight Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_eight[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="native_ads_eight[]" value="@">
                        <label class="small"><b>Native Ads Eight Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_eight[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Nine Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_nine[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="native_ads_nine[]" value="@">
                        <label class="small"><b>Native Ads Nine Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_nine[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Native Ads Ten Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_ten[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="native_ads_ten[]" value="@">
                        <label class="small"><b>Native Ads Ten Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_ten[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border borderbox p-3">
                        <label class="small"><b>Interstitial Ads One Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_one[]" value="@">
                        <label class="small"><b>Interstitial Ads One Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Two Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_two[]" value="@">
                        <label class="small"><b>Interstitial Ads Two Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_two[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Three Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_three[]" value="@">
                        <label class="small"><b>Interstitial Ads Three Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_three[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Four Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_four[]" value="@">
                        <label class="small"><b>Interstitial Ads Four Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_four[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Five Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_five[]" value="@">
                        <label class="small"><b>Interstitial Ads Five Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_five[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Six Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_six[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="interstitial_ads_six[]" value="@">
                        <label class="small"><b>Interstitial Ads Six Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_six[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Seven Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_seven[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_seven[]" value="@">
                        <label class="small"><b>Interstitial Ads Seven Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_seven[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Eight Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_eight[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="interstitial_ads_eight[]" value="@">
                        <label class="small"><b>Interstitial Ads Eight Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_eight[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Nine Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_nine[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_nine[]" value="@">
                        <label class="small"><b>Interstitial Ads Nine Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_nine[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border borderbox p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Ten Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_ten[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="interstitial_ads_ten[]" value="@">
                        <label class="small"><b>Interstitial Ads Ten Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_ten[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border borderbox p-3">
                        <label class="small"><b>Open Ads One Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="open_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                        <input type="hidden" name="open_ads_one[]" value="@">
                        <label class="small"><b>Open Ads One Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="open_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border borderbox p-3">
                        <label class="small"><b>Rewards Ads One Primary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="rewards_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="rewards_ads_one[]" value="@">
                        <label class="small"><b>Rewards Ads One Secondary</b></label>    
                        <div class="row small">
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="rewards_ads_one[]" class="form-control" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
</main>    

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>


 



