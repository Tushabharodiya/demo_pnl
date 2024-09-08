<main role="main" class="container">
    <?php if(!empty($androidVersionData)) { ?>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="span border border-gray bg-light p-3">
          <h6 class="d-inline-block m-0"> <?php echo $androidAppData->app_name; ?> </h6>
          <small class="text-left ml-1"> <?php echo $androidAppData->app_developer; ?> </small> 
        </div>
        <div class="overflow-none">
            <div class="row small p-2 mt-3">
                <div class="col-md-2 com-sm-12">
                    <img class="logo-box" src="<?php echo base_url();?>uploads/logos/<?php echo $androidAppData->app_logo;?>" width="140" height="140">
                </div>
                <div class="col-md-10 com-sm-12">
                    <p class="m-0"> Code : <b><?php echo $androidAppData->app_code; ?></b> </p> 
                    <p class="m-0"> Package : <b><?php echo $androidAppData->app_package; ?></b> </p> 
                    <p class="m-0"> Release : <b><?php echo $androidAppData->app_release; ?></b> </p> 
                    <p class="m-0"> Download : <b><?php echo $androidAppData->app_download; ?></b> </p> 
                    <p class="m-0"> Privacy : <b><?php echo $androidAppData->app_privacy; ?></b> </p> 
                    <p class="m-0"> Terms : <b><?php echo $androidAppData->app_terms; ?></b> </p> 
                    <p class="mb-2"> Status : <b><?php echo $androidAppData->app_status; ?></b> </p> 
                    <div class="btn btn-sm btn-primary"><a href="<?php echo base_url();?>description-app/<?php echo md5($androidAppData->app_id);?>" class="text-white"> App Description </a></div>
                </div>
            </div> 
        </div> 
        <div class="span border border-gray bg-light p-3 mt-3">
            <h6 class="d-inline-block m-0"> VName : <?php echo $androidVersionData->version_name; ?> </h6>
            <small class="text-left ml-1"> Code : <?php echo $androidVersionData->version_code; ?> </small> 
        </div>
        <div class="table-responsive p-2 mt-3">
            <table class="table table-bordered">
              <thead class="thead-dark small">
                <tr>
                  <th scope="col">Parameter</th>
                  <th scope="col">Value</th>
                </tr>
              </thead>
              <tbody class="small">
                  <tr>
                  <th scope="row">Main Api</th>
                  <td class="col-10"><?php echo $androidVersionData->main_api; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Data Api</th>
                  <td class="col-10"><?php echo $androidVersionData->data_api; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Ads</th>
                  <td class="col-10"><?php echo $androidVersionData->app_ads; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Splash Ads</th>
                  <td class="col-10"><?php echo $androidVersionData->splash_ads; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Screen Ads</th>
                  <td class="col-10"><?php echo $androidVersionData->screen_ads; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Banner</th>
                  <td class="col-10"><?php echo $androidVersionData->app_banner; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Review</th>
                  <td class="col-10"><?php echo $androidVersionData->app_review; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Update</th>
                  <td class="col-10"><?php echo $androidVersionData->app_update; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Update Title</th>
                  <td class="col-10"><?php echo $androidVersionData->update_title; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Update Description</th>
                  <td class="col-10"><?php echo $androidVersionData->update_description; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Update Button</th>
                  <td class="col-10"><?php echo $androidVersionData->update_button; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Update Url</th>
                  <td class="col-10"><?php echo $androidVersionData->update_url; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Update</th>
                  <td class="col-10"><?php echo $androidVersionData->app_update; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Open</th>
                  <td class="col-10"><?php echo $androidVersionData->app_open; ?> </td>
                </tr>
                <tr>
                  <th scope="row">App Subscription</th>
                  <td class="col-10"><?php echo $androidVersionData->app_subscription; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Is Rewarded</th>
                  <td class="col-10"><?php echo $androidVersionData->is_rewarded; ?> </td>
                </tr>
                <tr>
                  <th scope="row">Version Status</th>
                  <td class="col-10"><?php echo $androidVersionData->version_status; ?> </td>
                </tr>
              </tbody>
            </table>
            <div class="btn btn-primary btn-sm"><a href="<?php echo base_url();?>edit-version/<?php echo md5($androidVersionData->version_id); ?>" class="text-white"> Edit Version </a> </div>
        </div>
    </div>
    <?php } ?>
    <?php if(empty($androidVersionData)) { ?>
      <div class="my-3 p-4 bg-white rounded box-shadow">
        <div class="span text-center">
          <h6 class="d-block m-0">Android Applications Are Not Available</h6>
        </div> 
      </div>
    <?php } ?>
</main>

