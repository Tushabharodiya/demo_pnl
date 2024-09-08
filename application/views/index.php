<main role="main" class="container">
    <?php if(!empty($this->session->userdata['user_role'])) { ?>
        <?php if($this->session->userdata['user_role'] == "Administrator") { ?>
            <div class="row mt-4">
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-primary" role="alert">
                        <h6 class="m-0"><b>Applications</b></h6>
                        <hr>
                        <p class="m-0 small"><?php if($developmentAppCount != null){ echo $developmentAppCount ?> <?php } else { ?> 0 <?php } ?> - Development / <?php if($publishAppCount != null){ echo $publishAppCount ?> <?php } else { ?> 0 <?php } ?> - Published</p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-primary" role="alert">
                        <h6 class="m-0"><b>Versions</b></h6>
                        <hr>
                        <p class="m-0 small"><?php if($versionCount != null){ echo $versionCount ?> <?php } else { ?> 0 <?php } ?> - Versions</p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-primary" role="alert">
                        <h6 class="m-0"><b>Banners</b></h6>
                        <hr>
                        <p class="m-0 small"><?php if($bannerCount != null){ echo $bannerCount ?> <?php } else { ?> 0 <?php } ?> - Banners</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Mods Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryModsPublishCount != null){ echo $categoryModsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryModsUnpublishCount != null){ echo $categoryModsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($modsPublishCount != null){ echo $modsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($modsUnpublishCount != null){ echo $modsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Addons Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryAddonsPublishCount != null){ echo $categoryAddonsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryAddonsUnpublishCount != null){ echo $categoryAddonsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($addonsPublishCount != null){ echo $addonsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($addonsUnpublishCount != null){ echo $addonsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Maps Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryMapsPublishCount != null){ echo $categoryMapsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryMapsUnpublishCount != null){ echo $categoryMapsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($mapsPublishCount != null){ echo $mapsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($mapsUnpublishCount != null){ echo $mapsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Seeds Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categorySeedsPublishCount != null){ echo $categorySeedsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categorySeedsUnpublishCount != null){ echo $categorySeedsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($seedsPublishCount != null){ echo $seedsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($seedsUnpublishCount != null){ echo $seedsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Textures Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryTexturesPublishCount != null){ echo $categoryTexturesPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryTexturesUnpublishCount != null){ echo $categoryTexturesUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($texturesPublishCount != null){ echo $texturesPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($texturesUnpublishCount != null){ echo $texturesUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Shaders Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryShadersPublishCount != null){ echo $categoryShadersPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryShadersUnpublishCount != null){ echo $categoryShadersUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($shadersPublishCount != null){ echo $shadersPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($shadersUnpublishCount != null){ echo $shadersUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Skin Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categorySkinPublishCount != null){ echo $categorySkinPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categorySkinUnpublishCount != null){ echo $categorySkinUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($skinPublishCount != null){ echo $skinPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($skinUnpublishCount != null){ echo $skinUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
            </div>
        <?php } else if($this->session->userdata['user_role'] == "Editor"){ ?>
            <div class="row mt-4">
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Mods Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryModsPublishCount != null){ echo $categoryModsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryModsUnpublishCount != null){ echo $categoryModsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($modsPublishCount != null){ echo $modsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($modsUnpublishCount != null){ echo $modsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Addons Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryAddonsPublishCount != null){ echo $categoryAddonsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryAddonsUnpublishCount != null){ echo $categoryAddonsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($addonsPublishCount != null){ echo $addonsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($addonsUnpublishCount != null){ echo $addonsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Maps Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryMapsPublishCount != null){ echo $categoryMapsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryMapsUnpublishCount != null){ echo $categoryMapsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($mapsPublishCount != null){ echo $mapsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($mapsUnpublishCount != null){ echo $mapsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Seeds Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categorySeedsPublishCount != null){ echo $categorySeedsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categorySeedsUnpublishCount != null){ echo $categorySeedsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($seedsPublishCount != null){ echo $seedsPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($seedsUnpublishCount != null){ echo $seedsUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Textures Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryTexturesPublishCount != null){ echo $categoryTexturesPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryTexturesUnpublishCount != null){ echo $categoryTexturesUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($texturesPublishCount != null){ echo $texturesPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($texturesUnpublishCount != null){ echo $texturesUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Shaders Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categoryShadersPublishCount != null){ echo $categoryShadersPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categoryShadersUnpublishCount != null){ echo $categoryShadersUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($shadersPublishCount != null){ echo $shadersPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($shadersUnpublishCount != null){ echo $shadersUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
                <div class="col col-sm-6 col-md-4 mt-2">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="m-0"><b>Skin Data</b></h6>
                        <hr>
                        <p class="m-0 small"><h6 class="small">Category : <?php if($categorySkinPublishCount != null){ echo $categorySkinPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($categorySkinUnpublishCount != null){ echo $categorySkinUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6>
                        <h6 class="small">Data : <?php if($skinPublishCount != null){ echo $skinPublishCount ?> <?php } else { ?> 0 <?php } ?> - <?php if($skinUnpublishCount != null){ echo $skinUnpublishCount ?> <?php } else { ?> 0 <?php } ?></h6></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</main>
