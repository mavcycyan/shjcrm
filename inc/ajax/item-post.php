<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); ?>
<?php
    $id = $_POST['id'];
    $idPrev = $_POST['idPrev'];
    $idNext = $_POST['idNext'];
    $current_post = get_post( $id );
?>

<div class="box-container" style="position: relative;">
    <div class="box-modal_close arcticmodal-close"><i class="fa fa-close"></i></div>
    <?php if($idPrev != '') : ?>
        <div class="box-left js-postChange" data-id="<?php echo $idPrev; ?>"><span class="icon-left-arrow"></span></div>
    <?php endif; ?>
    <?php if($idNext != '') : ?>
        <div class="box-right js-postChange" data-id="<?php echo $idNext; ?>"><span class="icon-right-arrow"></span></div>
    <?php endif; ?>

    <?php if($thumb = get_the_post_thumbnail( $id, 'full', array('class' => 'img-fluid') )) : ?>
        <?php if($gal = get_field('item-gal', $id)) : ?>
            <div class="box-slider js-modlSlider">
                <div class="box-slide">
                    <?php echo $thumb; ?>
                </div>
                <?php foreach($gal as $img) : ?>
                    <div class="box-slide">
                        <img src="<?php echo $img['img']['url'] ?>" class="img-fluid" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="box-image">
                <?php echo $thumb; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="box-title"><?php echo $current_post->post_title; ?></div>
    <div><?php echo apply_filters('the_content', get_post($id)->post_content ); ?></div>
    <div class="row">
        <div class="offset-sm-2 col-sm-8">
            <div class="row">
                <?php if ($disc = get_field('item-disc', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-margnifier-complex"></span> <?php pll_e('Place Discovered'); ?></div>
                            <div class="box-text"><?php echo $disc; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($date_disc = get_field('item-date_disc', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-calendar"></span> <?php pll_e('Date Discovered'); ?></div>
                            <div class="box-text"><?php echo $date_disc; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($dim = get_field('item-dim', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Dimension'); ?></div>
                            <div class="box-text"><?php echo $dim; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($mat = get_field('item-mat', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Material'); ?></div>
                            <div class="box-text"><?php echo $mat; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>

                <?php if ($var = get_field('item-num_loc', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Location code'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-num', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Object number'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($dim = get_field('item-num_part', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Object part'); ?></div>
                            <div class="box-text"><?php echo $dim; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-row', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Row number'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($dim = get_field('item-type', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Object type'); ?></div>
                            <div class="box-text"><?php echo $dim; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-rack', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Rack number'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($dim = get_field('item-shelf', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Shelf'); ?></div>
                            <div class="box-text"><?php echo $dim; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-date_photo_taken', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Date (When the Photo was Taken)'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($dim = get_field('item-place_photo_taken', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-sizes"></span> <?php pll_e('Place (When the Photo was Taken)'); ?></div>
                            <div class="box-text"><?php echo $dim; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-photo_taken_by', $id)): ?>
                    <div class="col-sm-6">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Photo Taken By'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
                <?php if ($var = get_field('item-rem', $id)): ?>
                    <div class="col-sm-12">
                        <div class="box-block">
                            <div class="box-label"><span class="icon-materials"></span> <?php pll_e('Object remarks'); ?></div>
                            <div class="box-text"><?php echo $var; ?></div>
                        </div><!--box-block-->
                    </div>
                <?php endif; ?>
            </div><!--row-->
        </div><!--col-sm-8-->
    </div><!--row-->
    <div class="box-hidden-spinner-wrap js-spinnerPost" style="display: none;">
        <div class="box-hidden-spinner">
            <i class="fas fa-spinner-third"></i>
        </div>
    </div>
</div>