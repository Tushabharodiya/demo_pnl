<main role="main" class="container">
  <div class="my-3 p-4 bg-white rounded box-shadow">
    <div class="span small text-center">
        <img src="<?php echo base_url();?>source/image/nodata.webp" alt="NoData" height="200" width="200">
        <?php if($msg['data_title'] != null) { ?>
        <h5 class="d-block mb-2"><?php echo $msg['data_title'] ?></h5>
        <?php } ?>
        <?php if($msg['data_description'] != null) { ?>
        <p class="d-block mb-3"><?php echo $msg['data_description'] ?></p>
        <?php } ?>
        <?php if($msg['button_text'] != null){ ?>
        <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?><?php echo $msg['button_link'] ?>" class="text-white"> <?php echo $msg['button_text'] ?> </a> </div>
        <?php } ?>
        <?php if(!empty($msg['button_text1'])){ ?>
        <div class="btn btn-primary btn-sm mb-0 mb-md-2"><a href="<?php echo base_url();?><?php echo $msg['button_link1'] ?>" class="text-white"> <?php echo $msg['button_text1'] ?> </a> </div>
        <?php } ?>
    </div> 
  </div>
</main>

