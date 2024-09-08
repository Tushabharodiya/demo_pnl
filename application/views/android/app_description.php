<main role="main" class="container">
    <?php if(!empty($getAndroidApp)) { ?>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>edit-app/<?php echo md5($getAndroidApp->app_id)?>" class="text-white">Edit Apps</a></div>
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>edit-ads/<?php echo md5($getAndroidApp->app_id)?>" class="text-white">Edit Ads</a></div>
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>view-version/<?php echo md5($getAndroidApp->app_id);?>" class="text-white"> Manage Version </a></div>
            <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?>view-subscription/<?php echo md5($getAndroidApp->app_id); ?>" class="text-white"> Manage Subscriptions </a></div>
            
        
            <div class="span border border-gray bg-light p-3 mt-3">
                <h6 class="d-inline-block m-0"> <?php echo $getAndroidApp->app_name; ?> / </h6>
                <small class="text-left ml-1"> <?php echo $getAndroidApp->app_developer; ?> </small> 
            </div>

            <div class="overflow-none">
                <div class="row small p-2 mt-3">
                    <div class="col-md-2 com-sm-12">
                        <img class="logo-box" src="<?php echo base_url();?>uploads/logos/<?php echo $getAndroidApp->app_logo;?>" width="140" height="140">
                    </div>
                    <div class="col-md-10 com-sm-12">
                        <p class="m-0"> Code : <b><?php echo $getAndroidApp->app_code; ?></b> </p> 
                        <p class="m-0"> Package : <b><?php echo $getAndroidApp->app_package; ?></b> </p> 
                        <p class="m-0"> Release : <b><?php echo $getAndroidApp->app_release; ?></b> </p> 
                        <p class="m-0"> Download : <b><?php echo $getAndroidApp->app_download; ?></b> </p> 
                        <p class="m-0"> Privacy : <b><?php echo $getAndroidApp->app_privacy; ?></b> </p> 
                        <p class="m-0"> Terms : <b><?php echo $getAndroidApp->app_terms; ?></b> </p> 
                        <p class="m-0"> Status : <b><?php echo $getAndroidApp->app_status; ?></b> </p> 
                    </div>
                </div> 
            </div> 

        <div class="span border border-gray bg-light p-3 mt-4">
            <h6 class="d-inline-block m-0"> App Json </h6>
            <small class="text-left ml-1"> App Json Banners </small> 
        </div>
        <div class="overflow-none">
            <div class="row small mt-4">
                <?php foreach($getAndroidJsonData as $data) { ?>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo base_url(); ?>/uploads/banners/<?php echo $data->banner_image; ?>" alt="banners">
                            <div class="card-body">
                                <p class="card-title m-0"><b><?php echo $data->banner_title; ?></b></p>
                                <p class="m-0"><?php echo $data->banner_description; ?></p>
                                <p class="m-0"><?php echo $data->banner_url; ?></p>
                                <p class="m-0"><b>Button</b> : <?php echo $data->banner_button; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="btn btn-primary btn-sm mt-3"><a href="<?php echo base_url();?>edit-json/<?php echo md5($getAndroidJson->json_id); ?>" class="text-white"> Edit App Json Data </a> </div>
        </div>
        <?php } ?>

        <?php if(empty($getAndroidApp)) { ?>
            <div class="my-3 p-4 bg-white rounded box-shadow">
                <div class="span text-center">
                    <h6 class="d-block m-0">Android Applications Are Not Available</h6>
                </div> 
            </div>
        <?php } ?>    

        <div class="span border border-gray bg-light p-3 mt-4">
            <h5 class="d-inline-block m-0"> Ads </h5>
            <small class="text-left ml-1"> App Ads </small> 
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark small">
                    <tr>
                        <th width = 20%><b>Ads Name </b></th>
                        <th width = 10%><b>Priority </b></th>
                        <th width = 50%><b>Code </b></th>
                        <th width = 10%><b>Status </b></th>
                        <th width = 10%><b>Clickable </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $bannerOne = $getAndroidAds->banner_ads_one;
                        $bannerAdsOne = preg_split('/(\s|#|@)/',$bannerOne);
                    ?>
                    <tr class="small">
                        <td rowspan="2"><b>Banner - 1</b></td>
                        <td><?php echo $bannerAdsOne[0]; ?> </td>
                        <td class="text-success"><b><?php echo $bannerAdsOne[1]?> </b></td>
                        <td><?php echo $bannerAdsOne[2]; ?> </td>
                        <td><?php echo $bannerAdsOne[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $bannerAdsOne[4]; ?> </td>
                        <td><?php echo $bannerAdsOne[5]; ?> </td>
                        <td><?php echo $bannerAdsOne[6]; ?> </td>
                        <td><?php echo $bannerAdsOne[7]; ?> </td>
                    </tr>
                    <?php
                        $bannerTwo = $getAndroidAds->banner_ads_two;
                        $bannerAdsTwo = preg_split('/(\s|#|@)/',$bannerTwo);
                    ?>
                    <tr class="small">
                        <td rowspan="2"><b>Banner - 2</b></td>
                        <td><?php echo $bannerAdsTwo[0]; ?> </td>
                        <td class="text-success"><b><?php echo $bannerAdsTwo[1]?> </b></td>
                        <td><?php echo $bannerAdsTwo[2]; ?> </td>
                        <td><?php echo $bannerAdsTwo[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $bannerAdsTwo[4]; ?> </td>
                        <td><?php echo $bannerAdsTwo[5]; ?> </td>
                        <td><?php echo $bannerAdsTwo[6]; ?> </td>
                        <td><?php echo $bannerAdsTwo[7]; ?> </td>
                    </tr>
                    <?php
                        $bannerThree = $getAndroidAds->banner_ads_three;
                        $bannerAdsThree = preg_split('/(\s|#|@)/',$bannerThree);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Banner - 3</b></td>
                        <td><?php echo $bannerAdsThree[0]; ?> </td>
                        <td class="text-success"><b><?php echo $bannerAdsThree[1]?> </b></td>
                        <td><?php echo $bannerAdsThree[2]; ?> </td>
                        <td><?php echo $bannerAdsThree[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $bannerAdsThree[4]; ?> </td>
                        <td><?php echo $bannerAdsThree[5]; ?> </td>
                        <td><?php echo $bannerAdsThree[6]; ?> </td>
                        <td><?php echo $bannerAdsThree[7]; ?> </td>
                    </tr>
                    <?php
                        $bannerFour = $getAndroidAds->banner_ads_four;
                        $bannerAdsFour = preg_split('/(\s|#|@)/',$bannerFour);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Banner - 4</b></td>
                        <td><?php echo $bannerAdsFour[0]; ?> </td>
                        <td class="text-success"><b><?php echo $bannerAdsFour[1]?> </b></td>
                        <td><?php echo $bannerAdsFour[2]; ?> </td>
                        <td><?php echo $bannerAdsFour[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $bannerAdsFour[4]; ?> </td>
                        <td><?php echo $bannerAdsFour[5]; ?> </td>
                        <td><?php echo $bannerAdsFour[6]; ?> </td>
                        <td><?php echo $bannerAdsFour[7]; ?> </td>
                    </tr>
                    <?php
                        $bannerFive = $getAndroidAds->banner_ads_five;
                        $bannerAdsFive = preg_split('/(\s|#|@)/',$bannerFive);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Banner - 5</b></td>
                        <td><?php echo $bannerAdsFive[0]; ?> </td>
                        <td class="text-success"><b><?php echo $bannerAdsFive[1]?> </b></td>
                        <td><?php echo $bannerAdsFive[2]; ?> </td>
                        <td><?php echo $bannerAdsFive[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $bannerAdsFive[4]; ?> </td>
                        <td><?php echo $bannerAdsFive[5]; ?> </td>
                        <td><?php echo $bannerAdsFive[6]; ?> </td>
                        <td><?php echo $bannerAdsFive[7]; ?> </td>
                    </tr>
                </tbody>
            </table>   
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark small">
                    <tr>
                        <th width = 20%><b>Ads Name </b></th>
                        <th width = 10%><b>Priority </b></th>
                        <th width = 50%><b>Code </b></th>
                        <th width = 10%><b>Status </b></th>
                        <th width = 10%><b>Clickable </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nativeOne = $getAndroidAds->native_ads_one;
                        $nativeAdsOne = preg_split('/(\s|#|@)/',$nativeOne);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 1</b></td>
                        <td><?php echo $nativeAdsOne[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsOne[1]?> </b></td>
                        <td><?php echo $nativeAdsOne[2]; ?> </td>
                        <td><?php echo $nativeAdsOne[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsOne[4]; ?> </td>
                        <td><?php echo $nativeAdsOne[5]; ?> </td>
                        <td><?php echo $nativeAdsOne[6]; ?> </td>
                        <td><?php echo $nativeAdsOne[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeTwo = $getAndroidAds->native_ads_two;
                        $nativeAdsTwo = preg_split('/(\s|#|@)/',$nativeTwo);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 2</b></td>
                        <td><?php echo $nativeAdsTwo[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsTwo[1]?> </b></td>
                        <td><?php echo $nativeAdsTwo[2]; ?> </td>
                        <td><?php echo $nativeAdsTwo[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsTwo[4]; ?> </td>
                        <td><?php echo $nativeAdsTwo[5]; ?> </td>
                        <td><?php echo $nativeAdsTwo[6]; ?> </td>
                        <td><?php echo $nativeAdsTwo[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeThree = $getAndroidAds->native_ads_three;
                        $nativeAdsThree = preg_split('/(\s|#|@)/',$nativeThree);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 3</b></td>
                        <td><?php echo $nativeAdsThree[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsThree[1]?> </b></td>
                        <td><?php echo $nativeAdsThree[2]; ?> </td>
                        <td><?php echo $nativeAdsThree[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsThree[4]; ?> </td>
                        <td><?php echo $nativeAdsThree[5]; ?> </td>
                        <td><?php echo $nativeAdsThree[6]; ?> </td>
                        <td><?php echo $nativeAdsThree[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeFour = $getAndroidAds->native_ads_four;
                        $nativeAdsFour = preg_split('/(\s|#|@)/',$nativeFour);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 4</b></td>
                        <td><?php echo $nativeAdsFour[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsFour[1]?> </b></td>
                        <td><?php echo $nativeAdsFour[2]; ?> </td>
                        <td><?php echo $nativeAdsFour[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsFour[4]; ?> </td>
                        <td><?php echo $nativeAdsFour[5]; ?> </td>
                        <td><?php echo $nativeAdsFour[6]; ?> </td>
                        <td><?php echo $nativeAdsFour[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeFive = $getAndroidAds->native_ads_five;
                        $nativeAdsFive = preg_split('/(\s|#|@)/',$nativeFive);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 5</b></td>
                        <td><?php echo $nativeAdsFive[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsFive[1]?> </b></td>
                        <td><?php echo $nativeAdsFive[2]; ?> </td>
                        <td><?php echo $nativeAdsFive[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsFive[4]; ?> </td>
                        <td><?php echo $nativeAdsFive[5]; ?> </td>
                        <td><?php echo $nativeAdsFive[6]; ?> </td>
                        <td><?php echo $nativeAdsFive[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeSix = $getAndroidAds->native_ads_six;
                        $nativeAdsSix = preg_split('/(\s|#|@)/',$nativeSix);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 6</b></td>
                        <td><?php echo $nativeAdsSix[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsSix[1]?> </b></td>
                        <td><?php echo $nativeAdsSix[2]; ?> </td>
                        <td><?php echo $nativeAdsSix[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsSix[4]; ?> </td>
                        <td><?php echo $nativeAdsSix[5]; ?> </td>
                        <td><?php echo $nativeAdsSix[6]; ?> </td>
                        <td><?php echo $nativeAdsSix[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeSeven = $getAndroidAds->native_ads_seven;
                        $nativeAdsSeven = preg_split('/(\s|#|@)/',$nativeSeven);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 7</b></td>
                        <td><?php echo $nativeAdsSeven[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsSeven[1]?> </b></td>
                        <td><?php echo $nativeAdsSeven[2]; ?> </td>
                        <td><?php echo $nativeAdsSeven[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsSeven[4]; ?> </td>
                        <td><?php echo $nativeAdsSeven[5]; ?> </td>
                        <td><?php echo $nativeAdsSeven[6]; ?> </td>
                        <td><?php echo $nativeAdsSeven[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeEight = $getAndroidAds->native_ads_eight;
                        $nativeAdsEight = preg_split('/(\s|#|@)/',$nativeEight);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 8</b></td>
                        <td><?php echo $nativeAdsEight[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsEight[1]?> </b></td>
                        <td><?php echo $nativeAdsEight[2]; ?> </td>
                        <td><?php echo $nativeAdsEight[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsEight[4]; ?> </td>
                        <td><?php echo $nativeAdsEight[5]; ?> </td>
                        <td><?php echo $nativeAdsEight[6]; ?> </td>
                        <td><?php echo $nativeAdsEight[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeNine = $getAndroidAds->native_ads_nine;
                        $nativeAdsNine = preg_split('/(\s|#|@)/',$nativeNine);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 9</b></td>
                        <td><?php echo $nativeAdsNine[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsNine[1]?> </b></td>
                        <td><?php echo $nativeAdsNine[2]; ?> </td>
                        <td><?php echo $nativeAdsNine[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsNine[4]; ?> </td>
                        <td><?php echo $nativeAdsNine[5]; ?> </td>
                        <td><?php echo $nativeAdsNine[6]; ?> </td>
                        <td><?php echo $nativeAdsNine[7]; ?> </td>
                    </tr>
                    <?php
                        $nativeTen = $getAndroidAds->native_ads_ten;
                        $nativeAdsTen = preg_split('/(\s|#|@)/',$nativeTen);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Native - 10</b></td>
                        <td><?php echo $nativeAdsTen[0]; ?> </td>
                        <td class="text-success"><b><?php echo $nativeAdsTen[1]?> </b></td>
                        <td><?php echo $nativeAdsTen[2]; ?> </td>
                        <td><?php echo $nativeAdsTen[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $nativeAdsTen[4]; ?> </td>
                        <td><?php echo $nativeAdsTen[5]; ?> </td>
                        <td><?php echo $nativeAdsTen[6]; ?> </td>
                        <td><?php echo $nativeAdsTen[7]; ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark small">
                    <tr>
                        <th width = 20%><b>Ads Name </b></th>
                        <th width = 10%><b>Priority </b></th>
                        <th width = 50%><b>Code </b></th>
                        <th width = 10%><b>Status </b></th>
                        <th width = 10%><b>Clickable </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $interstitialOne = $getAndroidAds->interstitial_ads_one;
                        $interstitialAdsOne = preg_split('/(\s|#|@)/',$interstitialOne);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 1</b></td>
                        <td><?php echo $interstitialAdsOne[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsOne[1]?> </b></td>
                        <td><?php echo $interstitialAdsOne[2]; ?> </td>
                        <td><?php echo $interstitialAdsOne[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsOne[4]; ?> </td>
                        <td><?php echo $interstitialAdsOne[5]; ?> </td>
                        <td><?php echo $interstitialAdsOne[6]; ?> </td>
                        <td><?php echo $interstitialAdsOne[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialTwo = $getAndroidAds->interstitial_ads_two;
                        $interstitialAdsTwo = preg_split('/(\s|#|@)/',$interstitialTwo);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 2</b></td>
                        <td><?php echo $interstitialAdsTwo[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsTwo[1]?> </b></td>
                        <td><?php echo $interstitialAdsTwo[2]; ?> </td>
                        <td><?php echo $interstitialAdsTwo[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsTwo[4]; ?> </td>
                        <td><?php echo $interstitialAdsTwo[5]; ?> </td>
                        <td><?php echo $interstitialAdsTwo[6]; ?> </td>
                        <td><?php echo $interstitialAdsTwo[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialThree = $getAndroidAds->interstitial_ads_three;
                        $interstitialAdsThree = preg_split('/(\s|#|@)/',$interstitialThree);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 3</b></td>
                        <td><?php echo $interstitialAdsThree[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsThree[1]?> </b></td>
                        <td><?php echo $interstitialAdsThree[2]; ?> </td>
                        <td><?php echo $interstitialAdsThree[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsThree[4]; ?> </td>
                        <td><?php echo $interstitialAdsThree[5]; ?> </td>
                        <td><?php echo $interstitialAdsThree[6]; ?> </td>
                        <td><?php echo $interstitialAdsThree[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialFour = $getAndroidAds->interstitial_ads_four;
                        $interstitialAdsFour = preg_split('/(\s|#|@)/',$interstitialFour);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 4</b></td>
                        <td><?php echo $interstitialAdsFour[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsFour[1]?> </b></td>
                        <td><?php echo $interstitialAdsFour[2]; ?> </td>
                        <td><?php echo $interstitialAdsFour[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsFour[4]; ?> </td>
                        <td><?php echo $interstitialAdsFour[5]; ?> </td>
                        <td><?php echo $interstitialAdsFour[6]; ?> </td>
                        <td><?php echo $interstitialAdsFour[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialFive = $getAndroidAds->interstitial_ads_five;
                        $interstitialAdsFive = preg_split('/(\s|#|@)/',$interstitialFive);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 5</b></td>
                        <td><?php echo $interstitialAdsFive[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsFive[1]?> </b></td>
                        <td><?php echo $interstitialAdsFive[2]; ?> </td>
                        <td><?php echo $interstitialAdsFive[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsFive[4]; ?> </td>
                        <td><?php echo $interstitialAdsFive[5]; ?> </td>
                        <td><?php echo $interstitialAdsFive[6]; ?> </td>
                        <td><?php echo $interstitialAdsFive[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialSix = $getAndroidAds->interstitial_ads_six;
                        $interstitialAdsSix = preg_split('/(\s|#|@)/',$interstitialSix);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 6</b></td>
                        <td><?php echo $interstitialAdsSix[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsSix[1]?> </b></td>
                        <td><?php echo $interstitialAdsSix[2]; ?> </td>
                        <td><?php echo $interstitialAdsSix[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsSix[4]; ?> </td>
                        <td><?php echo $interstitialAdsSix[5]; ?> </td>
                        <td><?php echo $interstitialAdsSix[6]; ?> </td>
                        <td><?php echo $interstitialAdsSix[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialSeven = $getAndroidAds->interstitial_ads_seven;
                        $interstitialAdsSeven = preg_split('/(\s|#|@)/',$interstitialSeven);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 7</b></td>
                        <td><?php echo $interstitialAdsSeven[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsSeven[1]?> </b></td>
                        <td><?php echo $interstitialAdsSeven[2]; ?> </td>
                        <td><?php echo $interstitialAdsSeven[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsSeven[4]; ?> </td>
                        <td><?php echo $interstitialAdsSeven[5]; ?> </td>
                        <td><?php echo $interstitialAdsSeven[6]; ?> </td>
                        <td><?php echo $interstitialAdsSeven[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialEight = $getAndroidAds->interstitial_ads_eight;
                        $interstitialAdsEight = preg_split('/(\s|#|@)/',$interstitialEight);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 8</b></td>
                        <td><?php echo $interstitialAdsEight[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsEight[1]?> </b></td>
                        <td><?php echo $interstitialAdsEight[2]; ?> </td>
                        <td><?php echo $interstitialAdsEight[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsEight[4]; ?> </td>
                        <td><?php echo $interstitialAdsEight[5]; ?> </td>
                        <td><?php echo $interstitialAdsEight[6]; ?> </td>
                        <td><?php echo $interstitialAdsEight[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialNine = $getAndroidAds->interstitial_ads_nine;
                        $interstitialAdsNine = preg_split('/(\s|#|@)/',$interstitialNine);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Interstitial - 9</b></td>
                        <td><?php echo $interstitialAdsNine[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsNine[1]?> </b></td>
                        <td><?php echo $interstitialAdsNine[2]; ?> </td>
                        <td><?php echo $interstitialAdsNine[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsNine[4]; ?> </td>
                        <td><?php echo $interstitialAdsNine[5]; ?> </td>
                        <td><?php echo $interstitialAdsNine[6]; ?> </td>
                        <td><?php echo $interstitialAdsNine[7]; ?> </td>
                    </tr>
                    <?php
                        $interstitialTen = $getAndroidAds->interstitial_ads_ten;
                        $interstitialAdsTen = preg_split('/(\s|#|@)/',$interstitialTen);
                    ?>
                   <tr class="small">
                        <td  rowspan="2"><b>Interstitial - 10</b></td>
                        <td><?php echo $interstitialAdsTen[0]; ?> </td>
                        <td class="text-success"><b><?php echo $interstitialAdsTen[1]?> </b></td>
                        <td><?php echo $interstitialAdsTen[2]; ?> </td>
                        <td><?php echo $interstitialAdsTen[3]; ?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $interstitialAdsTen[4]; ?> </td>
                        <td><?php echo $interstitialAdsTen[5]; ?> </td>
                        <td><?php echo $interstitialAdsTen[6]; ?> </td>
                        <td><?php echo $interstitialAdsTen[7]; ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark small">
                    <tr>
                        <th width = 20%><b>Ads Name </b></th>
                        <th width = 10%><b>Priority </b></th>
                        <th width = 50%><b>Code </b></th>
                        <th width = 10%><b>Status </b></th>
                        <th width = 10%><b>Clickable </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $openOne = $getAndroidAds->open_ads_one;
                        $openAdsOne = preg_split('/(\s|#|@)/',$openOne);
                    ?>
                   <tr class="small">
                        <td rowspan="2"><b>Open - 1</b></td>
                        <td><?php echo $openAdsOne[0]?> </td>
                        <td class="text-success"><b><?php echo $openAdsOne[1]?> </b></td>
                        <td><?php echo $openAdsOne[2]?> </td>
                        <td><?php echo $openAdsOne[3]?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $openAdsOne[4]?> </td>
                        <td><?php echo $openAdsOne[5]?> </td>
                        <td><?php echo $openAdsOne[6]?> </td>
                        <td><?php echo $openAdsOne[7]?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark small">
                    <tr>
                        <th width = 20%><b>Ads Name </b></th>
                        <th width = 10%><b>Priority </b></th>
                        <th width = 50%><b>Code </b></th>
                        <th width = 10%><b>Status </b></th>
                        <th width = 10%><b>Clickable </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $rewardsOne = $getAndroidAds->rewards_ads_one;
                        $rewardsAdsOne = preg_split('/(\s|#|@)/',$rewardsOne);
                    ?>
                    <tr class="small">
                        <td rowspan="2"><b>Rewards - 1</b></td>
                        <td><?php echo $rewardsAdsOne[0]?> </td>
                        <td class="text-success"><b><?php echo $rewardsAdsOne[1]?> </b></td>
                        <td><?php echo $rewardsAdsOne[2]?> </td>
                        <td><?php echo $rewardsAdsOne[3]?> </td>
                    </tr>
                    <tr class="small">
                        <td><?php echo $rewardsAdsOne[4]?> </td>
                        <td><?php echo $rewardsAdsOne[5]?> </td>
                        <td><?php echo $rewardsAdsOne[6]?> </td>
                        <td><?php echo $rewardsAdsOne[7]?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</main>












