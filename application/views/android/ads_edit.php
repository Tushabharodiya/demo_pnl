<main role="main" class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="span border border-gray bg-light p-3">
                <h5 class="d-inline-block m-0"> Ads </h5>
                <small class="text-left ml-1"> Edit Ads </small>
                <?php if(!empty($this->session->userdata['user_role'])) { ?>
                    <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have all permission.  </p>
                        <?php } else { ($this->session->userdata['user_role'] == "Editor")  ?>
                        <p class="card-text text-success small mt-2">Hey! <b><?php if(!empty($this->session->userdata['user_name'])){ echo $this->session->userdata['user_name'];  ?> <?php } ?></b> You have only Editor permission.  </p>
                    <?php } ?>
                <?php } ?>
            </div>    
            
            <div class="overflow-none">
                <div class="border p-3 mt-3">
                    <div class="border p-3">
                        <label class="small"><b>Banner Ads One Primary</b></label>    
                        <div class="row small">
                            <?php
                                $bannerOne = $androidAdsData->banner_ads_one;
                                $bannerAdsOne = preg_split('/(\s|#|@)/',$bannerOne);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="<?php echo $bannerAdsOne[0]; ?>"><?php echo $bannerAdsOne[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_one[]" class="form-control" value="<?php echo $bannerAdsOne[1]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="<?php echo $bannerAdsOne[2]; ?>"><?php echo $bannerAdsOne[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="<?php echo $bannerAdsOne[3]; ?>"><?php echo $bannerAdsOne[3]; ?></option>
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
                                    <option value="<?php echo $bannerAdsOne[4]; ?>"><?php echo $bannerAdsOne[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_one[]" class="form-control" value="<?php echo $bannerAdsOne[5]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="<?php echo $bannerAdsOne[6]; ?>"><?php echo $bannerAdsOne[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_one[]" class="form-control">
                                    <option value="<?php echo $bannerAdsOne[7]; ?>"><?php echo $bannerAdsOne[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Banner Ads Two Primary</b></label>    
                        <div class="row small">
                            <?php
                                $bannerTwo = $androidAdsData->banner_ads_two;
                                $bannerAdsTwo = preg_split('/(\s|#|@)/',$bannerTwo);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="<?php echo $bannerAdsTwo[0]; ?>"><?php echo $bannerAdsTwo[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_two[]" class="form-control" value="<?php echo $bannerAdsTwo[1]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="<?php echo $bannerAdsTwo[2]; ?>"><?php echo $bannerAdsTwo[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="<?php echo $bannerAdsTwo[3]; ?>"><?php echo $bannerAdsTwo[3]; ?></option>
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
                                    <option value="<?php echo $bannerAdsTwo[4]; ?>"><?php echo $bannerAdsTwo[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_two[]" class="form-control" value="<?php echo $bannerAdsTwo[5]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="<?php echo $bannerAdsTwo[6]; ?>"><?php echo $bannerAdsTwo[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                             <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_two[]" class="form-control">
                                    <option value="<?php echo $bannerAdsTwo[7]; ?>"><?php echo $bannerAdsTwo[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Banner Ads Three Primary</b></label>    
                        <div class="row small">
                            <?php
                                $bannerThree = $androidAdsData->banner_ads_three;
                                $bannerAdsThree = preg_split('/(\s|#|@)/',$bannerThree);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="<?php echo $bannerAdsThree[0]; ?>"><?php echo $bannerAdsThree[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_three[]" class="form-control" value="<?php echo $bannerAdsThree[1]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="<?php echo $bannerAdsThree[2]; ?>"><?php echo $bannerAdsThree[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="<?php echo $bannerAdsThree[3]; ?>"><?php echo $bannerAdsThree[3]; ?></option>
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
                                    <option value="<?php echo $bannerAdsThree[4]; ?>"><?php echo $bannerAdsThree[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_three[]" class="form-control" value="<?php echo $bannerAdsThree[5]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="<?php echo $bannerAdsThree[6]; ?>"><?php echo $bannerAdsThree[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_three[]" class="form-control">
                                    <option value="<?php echo $bannerAdsThree[7]; ?>"><?php echo $bannerAdsThree[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Banner Ads Four Primary</b></label>    
                        <div class="row small">
                            <?php
                                $bannerFour = $androidAdsData->banner_ads_four;
                                $bannerAdsFour = preg_split('/(\s|#|@)/',$bannerFour);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFour[0]; ?>"><?php echo $bannerAdsFour[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_four[]" class="form-control" value="<?php echo $bannerAdsFour[1];; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFour[2]; ?>"><?php echo $bannerAdsFour[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFour[3]; ?>"><?php echo $bannerAdsFour[3]; ?></option>
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
                                    <option value="<?php echo $bannerAdsFour[4]; ?>"><?php echo $bannerAdsFour[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_four[]" class="form-control" value="<?php echo $bannerAdsFour[5];; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFour[6]; ?>"><?php echo $bannerAdsFour[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_four[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFour[7]; ?>"><?php echo $bannerAdsFour[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Banner Ads Five Primary</b></label>    
                        <div class="row small">
                            <?php
                                $bannerFive = $androidAdsData->banner_ads_five;
                                $bannerAdsFive = preg_split('/(\s|#|@)/',$bannerFive);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFive[0]; ?>"><?php echo $bannerAdsFive[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_five[]" class="form-control" value="<?php echo $bannerAdsFive[1];; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFive[2]; ?>"><?php echo $bannerAdsFive[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFive[3]; ?>"><?php echo $bannerAdsFive[3]; ?></option>
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
                                    <option value="<?php echo $bannerAdsFive[4]; ?>"><?php echo $bannerAdsFive[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="banner_ads_five[]" class="form-control" value="<?php echo $bannerAdsFive[5]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFive[6]; ?>"><?php echo $bannerAdsFive[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="banner_ads_five[]" class="form-control">
                                    <option value="<?php echo $bannerAdsFive[7]; ?>"><?php echo $bannerAdsFive[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border p-3">
                        <label class="small"><b>Native Ads One Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeOne = $androidAdsData->native_ads_one;
                                $nativeAdsOne = preg_split('/(\s|#|@)/',$nativeOne);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="<?php echo $nativeAdsOne[0]; ?>"><?php echo $nativeAdsOne[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_one[]" class="form-control" value="<?php echo $nativeAdsOne[1]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="<?php echo $nativeAdsOne[2]; ?>"><?php echo $nativeAdsOne[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="<?php echo $nativeAdsOne[3]; ?>"><?php echo $nativeAdsOne[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsOne[4]; ?>"><?php echo $nativeAdsOne[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_one[]" class="form-control" value="<?php echo $nativeAdsOne[5]; ?>"placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="<?php echo $nativeAdsOne[6]; ?>"><?php echo $nativeAdsOne[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_one[]" class="form-control">
                                    <option value="<?php echo $nativeAdsOne[7]; ?>"><?php echo $nativeAdsOne[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">  
                        <label class="small"><b>Native Ads Two Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeTwo = $androidAdsData->native_ads_two;
                                $nativeAdsTwo = preg_split('/(\s|#|@)/',$nativeTwo);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTwo[0]; ?>"><?php echo $nativeAdsTwo[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_two[]" class="form-control" value="<?php echo $nativeAdsTwo[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTwo[2]; ?>"><?php echo $nativeAdsTwo[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTwo[3]; ?>"><?php echo $nativeAdsTwo[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsTwo[4]; ?>"><?php echo $nativeAdsTwo[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_two[]" class="form-control" value="<?php echo $nativeAdsTwo[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTwo[6]; ?>"><?php echo $nativeAdsTwo[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_two[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTwo[7]; ?>"><?php echo $nativeAdsTwo[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Three Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeThree = $androidAdsData->native_ads_three;
                                $nativeAdsThree = preg_split('/(\s|#|@)/',$nativeThree);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="<?php echo $nativeAdsThree[0]; ?>"><?php echo $nativeAdsThree[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_three[]" class="form-control" value="<?php echo $nativeAdsThree[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="<?php echo $nativeAdsThree[2]; ?>"><?php echo $nativeAdsThree[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="<?php echo $nativeAdsThree[3]; ?>"><?php echo $nativeAdsThree[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsThree[4]; ?>"><?php echo $nativeAdsThree[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_three[]" class="form-control" value="<?php echo $nativeAdsThree[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="<?php echo $nativeAdsThree[6]; ?>"><?php echo $nativeAdsThree[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_three[]" class="form-control">
                                    <option value="<?php echo $nativeAdsThree[7]; ?>"><?php echo $nativeAdsThree[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Four Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeFour = $androidAdsData->native_ads_four;
                                $nativeAdsFour = preg_split('/(\s|#|@)/',$nativeFour);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFour[0];  ?>"><?php echo $nativeAdsFour[0];  ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_four[]" class="form-control" value="<?php echo $nativeAdsFour[1];  ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFour[2];  ?>"><?php echo $nativeAdsFour[2];  ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFour[3];  ?>"><?php echo $nativeAdsFour[3];  ?></option>
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
                                    <option value="<?php echo $nativeAdsFour[4];  ?>"><?php echo $nativeAdsFour[4];  ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_four[]" class="form-control" value="<?php echo $nativeAdsFour[5];  ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFour[6];  ?>"><?php echo $nativeAdsFour[6];  ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_four[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFour[7];  ?>"><?php echo $nativeAdsFour[7];  ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Five Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeFive = $androidAdsData->native_ads_five;
                                $nativeAdsFive = preg_split('/(\s|#|@)/',$nativeFive);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFive[0]; ?>"><?php echo $nativeAdsFive[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_five[]" class="form-control" value="<?php echo $nativeAdsFive[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFive[2]; ?>"><?php echo $nativeAdsFive[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFive[3]; ?>"><?php echo $nativeAdsFive[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsFive[4]; ?>"><?php echo $nativeAdsFive[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_five[]" class="form-control" value="<?php echo $nativeAdsFive[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFive[6]; ?>"><?php echo $nativeAdsFive[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_five[]" class="form-control">
                                    <option value="<?php echo $nativeAdsFive[7]; ?>"><?php echo $nativeAdsFive[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Six Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeSix = $androidAdsData->native_ads_six;
                                $nativeAdsSix = preg_split('/(\s|#|@)/',$nativeSix);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSix[0]; ?>"><?php echo $nativeAdsSix[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_six[]" class="form-control" value="<?php echo $nativeAdsSix[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSix[2]; ?>"><?php echo $nativeAdsSix[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSix[3]; ?>"><?php echo $nativeAdsSix[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsSix[4]; ?>"><?php echo $nativeAdsSix[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_six[]" class="form-control" value="<?php echo $nativeAdsSix[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSix[6]; ?>"><?php echo $nativeAdsSix[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_six[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSix[7]; ?>"><?php echo $nativeAdsSix[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Seven Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeSeven = $androidAdsData->native_ads_seven;
                                $nativeAdsSeven = preg_split('/(\s|#|@)/',$nativeSeven);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSeven[0]; ?>"><?php echo $nativeAdsSeven[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_seven[]" class="form-control" value="<?php echo $nativeAdsSeven[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSeven[2]; ?>"><?php echo $nativeAdsSeven[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSeven[3]; ?>"><?php echo $nativeAdsSeven[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsSeven[4]; ?>"><?php echo $nativeAdsSeven[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_seven[]" class="form-control" value="<?php echo $nativeAdsSeven[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSeven[6]; ?>"><?php echo $nativeAdsSeven[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_seven[]" class="form-control">
                                    <option value="<?php echo $nativeAdsSeven[7]; ?>"><?php echo $nativeAdsSeven[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Eight Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeEight = $androidAdsData->native_ads_eight;
                                $nativeAdsEight = preg_split('/(\s|#|@)/',$nativeEight);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="<?php echo $nativeAdsEight[0]; ?>"><?php echo $nativeAdsEight[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_eight[]" class="form-control" value="<?php echo $nativeAdsEight[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="<?php echo $nativeAdsEight[2]; ?>"><?php echo $nativeAdsEight[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="<?php echo $nativeAdsEight[3]; ?>"><?php echo $nativeAdsEight[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsEight[4]; ?>"><?php echo $nativeAdsEight[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_eight[]" class="form-control" value="<?php echo $nativeAdsEight[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="<?php echo $nativeAdsEight[6]; ?>"><?php echo $nativeAdsEight[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_eight[]" class="form-control">
                                    <option value="<?php echo $nativeAdsEight[7]; ?>"><?php echo $nativeAdsEight[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Nine Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeNine = $androidAdsData->native_ads_nine;
                                $nativeAdsNine = preg_split('/(\s|#|@)/',$nativeNine);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="<?php echo $nativeAdsNine[0]; ?>"><?php echo $nativeAdsNine[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_nine[]" class="form-control" value="<?php echo $nativeAdsNine[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="<?php echo $nativeAdsNine[2]; ?>"><?php echo $nativeAdsNine[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="<?php echo $nativeAdsNine[3]; ?>"><?php echo $nativeAdsNine[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsNine[4]; ?>"><?php echo $nativeAdsNine[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_nine[]" class="form-control" value="<?php echo $nativeAdsNine[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="<?php echo $nativeAdsNine[6]; ?>"><?php echo $nativeAdsNine[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_nine[]" class="form-control">
                                    <option value="<?php echo $nativeAdsNine[7]; ?>"><?php echo $nativeAdsNine[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Native Ads Ten Primary</b></label>    
                        <div class="row small">
                            <?php
                                $nativeTen = $androidAdsData->native_ads_ten;
                                $nativeAdsTen = preg_split('/(\s|#|@)/',$nativeTen);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTen[0]; ?>"><?php echo $nativeAdsTen[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_ten[]" class="form-control" value="<?php echo $nativeAdsTen[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTen[2]; ?>"><?php echo $nativeAdsTen[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTen[3]; ?>"><?php echo $nativeAdsTen[3]; ?></option>
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
                                    <option value="<?php echo $nativeAdsTen[4]; ?>"><?php echo $nativeAdsTen[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="native_ads_ten[]" class="form-control" value="<?php echo $nativeAdsTen[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTen[6]; ?>"><?php echo $nativeAdsTen[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="native_ads_ten[]" class="form-control">
                                    <option value="<?php echo $nativeAdsTen[7]; ?>"><?php echo $nativeAdsTen[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border p-3"> 
                        <label class="small"><b>Interstitial Ads One Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialOne = $androidAdsData->interstitial_ads_one;
                                $interstitialAdsOne = preg_split('/(\s|#|@)/',$interstitialOne);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsOne[0]; ?>"><?php echo $interstitialAdsOne[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_one[]" class="form-control" value="<?php echo $interstitialAdsOne[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsOne[2]; ?>"><?php echo $interstitialAdsOne[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsOne[3]; ?>"><?php echo $interstitialAdsOne[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsOne[4]; ?>"><?php echo $interstitialAdsOne[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_one[]" class="form-control" value="<?php echo $interstitialAdsOne[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsOne[6]; ?>"><?php echo $interstitialAdsOne[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_one[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsOne[7]; ?>"><?php echo $interstitialAdsOne[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Two Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialTwo = $androidAdsData->interstitial_ads_two;
                                $interstitialAdsTwo = preg_split('/(\s|#|@)/',$interstitialTwo);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTwo[0]; ?>"><?php echo $interstitialAdsTwo[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_two[]" class="form-control" value="<?php echo $interstitialAdsTwo[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTwo[2]; ?>"><?php echo $interstitialAdsTwo[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTwo[3]; ?>"><?php echo $interstitialAdsTwo[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsTwo[4]; ?>"><?php echo $interstitialAdsTwo[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_two[]" class="form-control" value="<?php echo $interstitialAdsTwo[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTwo[6]; ?>"><?php echo $interstitialAdsTwo[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_two[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTwo[7]; ?>"><?php echo $interstitialAdsTwo[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Three Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialThree = $androidAdsData->interstitial_ads_three;
                                $interstitialAdsThree = preg_split('/(\s|#|@)/',$interstitialThree);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsThree[0]; ?>"><?php echo $interstitialAdsThree[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_three[]" class="form-control" value="<?php echo $interstitialAdsThree[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsThree[2]; ?>"><?php echo $interstitialAdsThree[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsThree[3]; ?>"><?php echo $interstitialAdsThree[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsThree[4]; ?>"><?php echo $interstitialAdsThree[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_three[]" class="form-control" value="<?php echo $interstitialAdsThree[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsThree[6]; ?>"><?php echo $interstitialAdsThree[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_three[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsThree[7]; ?>"><?php echo $interstitialAdsThree[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Four Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialFour = $androidAdsData->interstitial_ads_four;
                                $interstitialAdsFour = preg_split('/(\s|#|@)/',$interstitialFour);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFour[0]; ?>"><?php echo $interstitialAdsFour[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_four[]" class="form-control" value="<?php echo $interstitialAdsFour[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFour[2]; ?>"><?php echo $interstitialAdsFour[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFour[3]; ?>"><?php echo $interstitialAdsFour[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsFour[4]; ?>"><?php echo $interstitialAdsFour[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_four[]" class="form-control" value="<?php echo $interstitialAdsFour[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFour[6]; ?>"><?php echo $interstitialAdsFour[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_four[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFour[7]; ?>"><?php echo $interstitialAdsFour[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Five Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialFive = $androidAdsData->interstitial_ads_five;
                                $interstitialAdsFive = preg_split('/(\s|#|@)/',$interstitialFive);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFive[0]; ?>"><?php echo $interstitialAdsFive[0] ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_five[]" class="form-control" value="<?php echo $interstitialAdsFive[1] ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFive[2] ?>"><?php echo $interstitialAdsFive[2] ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFive[3] ?>"><?php echo $interstitialAdsFive[3] ?></option>
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
                                    <option value="<?php echo $interstitialAdsFive[4]; ?>"><?php echo $interstitialAdsFive[4] ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_five[]" class="form-control" value="<?php echo $interstitialAdsFive[5] ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFive[6] ?>"><?php echo $interstitialAdsFive[6] ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_five[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsFive[7] ?>"><?php echo $interstitialAdsFive[7] ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Six Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialSix = $androidAdsData->interstitial_ads_six;
                                $interstitialAdsSix = preg_split('/(\s|#|@)/',$interstitialSix);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSix[0]; ?>"><?php echo $interstitialAdsSix[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_six[]" class="form-control" value="<?php echo $interstitialAdsSix[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSix[2]; ?>"><?php echo $interstitialAdsSix[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSix[3]; ?>"><?php echo $interstitialAdsSix[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsSix[4]; ?>"><?php echo $interstitialAdsSix[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_six[]" class="form-control" value="<?php echo $interstitialAdsSix[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSix[6]; ?>"><?php echo $interstitialAdsSix[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_six[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSix[7]; ?>"><?php echo $interstitialAdsSix[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Seven Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialSeven = $androidAdsData->interstitial_ads_seven;
                                $interstitialAdsSeven = preg_split('/(\s|#|@)/',$interstitialSeven);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSeven[0]; ?>"><?php echo $interstitialAdsSeven[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_seven[]" class="form-control" value="<?php echo $interstitialAdsSeven[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSeven[2]; ?>"><?php echo $interstitialAdsSeven[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSeven[3]; ?>"><?php echo $interstitialAdsSeven[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsSeven[4]; ?>"><?php echo $interstitialAdsSeven[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_seven[]" class="form-control" value="<?php echo $interstitialAdsSeven[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSeven[6]; ?>"><?php echo $interstitialAdsSeven[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_seven[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsSeven[7]; ?>"><?php echo $interstitialAdsSeven[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Eight Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialEight = $androidAdsData->interstitial_ads_eight;
                                $interstitialAdsEight = preg_split('/(\s|#|@)/',$interstitialEight);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsEight[0]; ?>"><?php echo $interstitialAdsEight[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_eight[]" class="form-control" value="<?php echo $interstitialAdsEight[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsEight[2]; ?>"><?php echo $interstitialAdsEight[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsEight[3]; ?>"><?php echo $interstitialAdsEight[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsEight[4]; ?>"><?php echo $interstitialAdsEight[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_eight[]" class="form-control" value="<?php echo $interstitialAdsEight[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsEight[6]; ?>"><?php echo $interstitialAdsEight[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_eight[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsEight[7]; ?>"><?php echo $interstitialAdsEight[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Nine Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialNine = $androidAdsData->interstitial_ads_nine;
                                $interstitialAdsNine = preg_split('/(\s|#|@)/',$interstitialNine);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsNine[0]; ?>"><?php echo $interstitialAdsNine[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_nine[]" class="form-control" value="<?php echo $interstitialAdsNine[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsNine[2]; ?>"><?php echo $interstitialAdsNine[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsNine[3]; ?>"><?php echo $interstitialAdsNine[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsNine[4]; ?>"><?php echo $interstitialAdsNine[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_nine[]" class="form-control" value="<?php echo $interstitialAdsNine[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsNine[6]; ?>"><?php echo $interstitialAdsNine[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_nine[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsNine[7]; ?>"><?php echo $interstitialAdsNine[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border p-3 mt-3">
                        <label class="small"><b>Interstitial Ads Ten Primary</b></label>    
                        <div class="row small">
                            <?php
                                $interstitialTen = $androidAdsData->interstitial_ads_ten;
                                $interstitialAdsTen = preg_split('/(\s|#|@)/',$interstitialTen);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTen[0]; ?>"><?php echo $interstitialAdsTen[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_ten[]" class="form-control" value="<?php echo $interstitialAdsTen[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTen[2]; ?>"><?php echo $interstitialAdsTen[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTen[3]; ?>"><?php echo $interstitialAdsTen[3]; ?></option>
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
                                    <option value="<?php echo $interstitialAdsTen[4]; ?>"><?php echo $interstitialAdsTen[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="interstitial_ads_ten[]" class="form-control" value="<?php echo $interstitialAdsTen[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTen[6]; ?>"><?php echo $interstitialAdsTen[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="interstitial_ads_ten[]" class="form-control">
                                    <option value="<?php echo $interstitialAdsTen[7]; ?>"><?php echo $interstitialAdsTen[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border p-3">
                        <label class="small"><b>Open Ads One Primary</b></label>    
                        <div class="row small">
                            <?php
                                $openOne = $androidAdsData->open_ads_one;
                                $openAdsOne = preg_split('/(\s|#|@)/',$openOne);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="<?php echo $openAdsOne[0]; ?>"><?php echo $openAdsOne[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="open_ads_one[]" class="form-control" value="<?php echo $openAdsOne[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="<?php echo $openAdsOne[2]; ?>"><?php echo $openAdsOne[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="<?php echo $openAdsOne[3]; ?>"><?php echo $openAdsOne[3]; ?></option>
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
                                    <option value="<?php echo $openAdsOne[4]; ?>"><?php echo $openAdsOne[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="open_ads_one[]" class="form-control" value="<?php echo $openAdsOne[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="<?php echo $openAdsOne[6]; ?>"><?php echo $openAdsOne[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="open_ads_one[]" class="form-control">
                                    <option value="<?php echo $openAdsOne[7]; ?>"><?php echo $openAdsOne[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="border p-3 mt-3">
                    <div class="border p-3">
                        <label class="small"><b>Rewards Ads One Primary</b></label>    
                        <div class="row small">
                            <?php
                                $rewardsOne = $androidAdsData->rewards_ads_one;
                                $rewardsAdsOne = preg_split('/(\s|#|@)/',$rewardsOne);
                            ?>
                            <div class="form-group col-md-2">
                                <label>Ads Priority *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="<?php echo $rewardsAdsOne[0]; ?>"><?php echo $rewardsAdsOne[0]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="rewards_ads_one[]" class="form-control" value="<?php echo $rewardsAdsOne[1]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="<?php echo $rewardsAdsOne[2]; ?>"><?php echo $rewardsAdsOne[2]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="<?php echo $rewardsAdsOne[3]; ?>"><?php echo $rewardsAdsOne[3]; ?></option>
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
                                    <option value="<?php echo $rewardsAdsOne[4]; ?>"><?php echo $rewardsAdsOne[4]; ?></option>
                                    <option value="google">Google</option>
                                    <option value="facebook">Facebook</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Ads Code *</label>
                                <input type="text" name="rewards_ads_one[]" class="form-control" value="<?php echo $rewardsAdsOne[5]; ?>" placeholder="Enter Ads Code">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Status *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="<?php echo $rewardsAdsOne[6]; ?>"><?php echo $rewardsAdsOne[6]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ads Clickable *</label>
                                <select name="rewards_ads_one[]" class="form-control">
                                    <option value="<?php echo $rewardsAdsOne[7]; ?>"><?php echo $rewardsAdsOne[7]; ?></option>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Update" class="btn btn-primary mt-3">
        </div>
    </form>
</main>    

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

 



