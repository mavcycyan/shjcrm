<?php
/**
 * Template Name: Print single
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();

$id = '';
if($_GET['id'] && $_GET['id'] != '') {
    $id = $_GET['id'];
    $current_post = get_post( $id );
} else {
    header('Location: /');
    exit;
}

$current_post = get_post( $id );

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';
?>
    <section  id="content" >
        <div class="container">
            <?php /* ?><div class="big-title">
                <div class="bt"><?php pll_e('Print Page A4 size'); ?></div>
            </div><?php */ ?>
            <div class="container-white">
                <div class="row">
                    <div class="offset-sm-4 col-sm-4">
                        <?php if($thumb = get_the_post_thumbnail( $id, 'full', array('class' => 'img-fluid') )) : ?>
                            <div class="print-image" style="text-align:center;">
                                <?php echo $thumb; ?>
                            </div><!--print-image-->
                        <?php endif; ?>
                        <div class="pr-img-title">
                            <?php echo $current_post->post_title; ?>
                        </div><!--pr-img-title-->
                    </div><!--col-sm-4-->
                </div><!--row-->
                <div class="info-group mb-30px">
                    <label for=""><?php pll_e('Description'); ?></label>
                    <div class="info-cont">
                        <div class="descr-text">
                            <?php echo apply_filters('the_content', get_post($id)->post_content ); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                <!--        <div class="info-group js-printCheckWrap">
                            <div class="print-check-wrap">
                                <label for="">Object name</label>
                                <input type="checkbox" id="item-name" name="item-name" class="js-printCheck" style="display: none;" checked />
                                <label for="item-name" class="print-check"></label>
                            </div>
                            <div class="info-cont">
                                Object Name
                            </div>
                        </div>-->
                        <?php if ($type = get_field('item-type', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Object Type (Kind)'); ?></label>
                                    <input type="checkbox" id="item-type" name="item-type" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $type; ?>" />
                                    <label for="item-type" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $type; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($mat = get_field('item-mat', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Material'); ?></label>
                                    <input type="checkbox" id="item-mat" name="item-mat" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $mat; ?>"  />
                                    <label for="item-mat" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $mat; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        $sites = get_the_terms( $id, 'sites' );
                        if( $sites ) :
                            $site = array_shift( $sites );
                            ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Site'); ?></label>
                                    <input type="checkbox" id="item-site" name="item-site" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $site->name; ?>"  />
                                    <label for="item-site" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $site->name; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                        <?php
                        $periods = get_the_terms( $id, 'periods' );
                        if( $periods ) :
                            $period = array_shift( $periods );
                        ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Period'); ?></label>
                                    <input type="checkbox" id="item-period" name="item-period" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $period->name; ?>"  />
                                    <label for="item-period" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $period->name; ?>
                                </div>
                            </div>
                            <?php
                            endif;
                        ?>
                        <?php if ($num = get_field('item-num', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Object Number'); ?></label>
                                    <input type="checkbox" id="item-num" name="item-num" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $num; ?>"  />
                                    <label for="item-num" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $num; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($loc = get_field('item-num_loc', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Object Code'); ?></label>
                                    <input type="checkbox" id="item-num_loc" name="item-num_loc" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $loc; ?>"  />
                                    <label for="item-num_loc" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $loc; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div><!--col-sm-6-->
                    <div class="col-sm-6">
                        <?php if ($part = get_field('item-part', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Part'); ?></label>
                                    <input type="checkbox" id="item-part" name="item-part" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $part; ?>" />
                                    <label for="item-part" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $part; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php if ($rack = get_field('item-rack', $id)): ?>
                                <div class="col-sm-6 js-printCheckWrap">
                                    <div class="info-group">
                                        <div class="print-check-wrap">
                                            <label for=""><?php pll_e('Rack Number'); ?></label>
                                            <input type="checkbox" id="item-rack" name="item-rack" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $rack; ?>" />
                                            <label for="item-rack" class="print-check"></label>
                                        </div>
                                        <div class="info-cont">
                                            <?php echo $rack; ?>
                                        </div>
                                    </div>
                                </div><!--col-sm-6-->
                            <?php endif; ?>
                            <?php if ($row = get_field('item-row', $id)): ?>
                                <div class="col-sm-6 js-printCheckWrap">
                                    <div class="info-group">
                                        <div class="print-check-wrap">
                                            <label for=""><?php pll_e('Row Number'); ?></label>
                                            <input type="checkbox" id="item-row" name="item-row" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $row; ?>" />
                                            <label for="item-row" class="print-check"></label>
                                        </div>
                                        <div class="info-cont">
                                            <?php echo $row; ?>
                                        </div>
                                    </div>
                                </div><!--col-sm-6-->
                            <?php endif; ?>
                        </div><!--row-->
                        <?php if ($shelf = get_field('item-shelf', $id)): ?>
                            <div class="info-group js-printCheckWrap">
                                <div class="print-check-wrap">
                                    <label for=""><?php pll_e('Shelf'); ?></label>
                                    <input type="checkbox" id="item-shelf" name="item-shelf" class="js-printCheck" style="display: none;" checked data-xls="<?php echo $shelf; ?>" />
                                    <label for="item-shelf" class="print-check"></label>
                                </div>
                                <div class="info-cont">
                                    <?php echo $shelf; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="info-group js-printCheckWrap">
                            <div class="print-check-wrap">
                                <label for=""><?php pll_e('Dimension (All Dimension)'); ?></label>
                                <input type="checkbox" id="item-dim" name="item-dim" class="js-printCheck" style="display: none;" checked data-xls="" />
                                <label for="item-dim" class="print-check"></label>
                            </div>
                            <div class="row">
                                <?php if ($dim_height = get_field('item-dim_height', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Height'); ?></label>
                                        <div class="info-cont text-center mb-15px "><?php echo $dim_height; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_length = get_field('item-dim_length', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Length'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_length; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_width = get_field('item-dim_width', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Width'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_width; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_thick = get_field('item-dim_thick', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Thickness'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_thick; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_weight = get_field('item-dim_weight', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Weight'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_weight; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_diameter = get_field('item-dim_diameter', $id)): ?>
                                    <div class="col-sm-3">
                                        <label for=""><?php pll_e('Diameter'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_diameter; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_base_diameter = get_field('item-dim_base_diameter', $id)): ?>
                                    <div class="col-sm-6">
                                        <label for=""><?php pll_e('Base Diameter'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_base_diameter; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_mouth_diameter = get_field('item-dim_mouth_diameter', $id)): ?>
                                    <div class="col-sm-6">
                                        <label for=""><?php pll_e('Mouth Diameter'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_mouth_diameter; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                                <?php if ($dim_type = get_field('item-dim_type', $id)): ?>
                                    <div class="col-sm-6">
                                        <label for=""><?php pll_e('Type'); ?></label>
                                        <div class="info-cont text-center mb-15px"><?php echo $dim_type; ?></div>
                                    </div><!--col-sm-3-->
                                <?php endif; ?>
                            </div><!--row-->
                        </div>
                  <!--      <div class="info-group js-printCheckWrap">
                            <div class="print-check-wrap">
                                <label for=""><?php pll_e('Object Remarks'); ?></label>
                                <input type="checkbox" id="item-rem" name="item-rem" class="js-printCheck" style="display: none;" checked />
                                <label for="item-rem" class="print-check"></label>
                            </div>
                            <div class="info-cont">
                                Object Remarks
                            </div>
                        </div>-->
                    </div><!--col-sm-6-->
                </div><!--row-->
            </div><!--container-white-->
            <div class="bottom-cw">
                <a href="#" class="btn btn-primary js-printClear"><?php pll_e('Clear Selected'); ?></a>
                <a href="#" class="btn btn-primary js-printSubm"><?php pll_e('Print Selected'); ?></a>
                <a href="#" class="btn btn-primary js-printSubmAll"><?php pll_e('Print All'); ?></a>
                <a href="#" class="js-xls"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/ex.png" alt=""/></a>
                <a href="#" class="js-pdf"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pdf.png" alt=""/></a>
            </div><!--bottom-cw-->
        </div><!--container-->
    </section><!--content-->
    <form action="/wp-content/themes/sharjahsystem/inc/xls/single.php" method="post" class="js-xlsForm" style="display: none;">
        <input type="hidden" name="img" value="<?php echo get_the_post_thumbnail_url( $id, 'full'); ?>" />
        <input type="hidden" name="img_height" value="" class="js-getImgHeight" />
        <input type="hidden" name="name" value="<?php echo $current_post->post_title; ?>" />
        <input type="hidden" name="descr" value="<?php echo apply_filters('the_content', get_post($id)->post_content ); ?>" />
        <input type="hidden" name="item-type" value="<?php echo $type; ?>" />
        <input type="hidden" name="item-mat" value="<?php echo $mat; ?>" />
        <input type="hidden" name="item-site" value="<?php echo $site->name; ?>" />
        <input type="hidden" name="item-period" value="<?php echo $period->name; ?>" />
        <input type="hidden" name="item-num" value="<?php echo $num; ?>" />
        <input type="hidden" name="item-num_loc" value="<?php echo $loc; ?>" />
        <input type="hidden" name="item-part" value="<?php echo $part; ?>" />
        <input type="hidden" name="item-rack" value="<?php echo $rack; ?>" />
        <input type="hidden" name="item-row" value="<?php echo $row; ?>" />
        <input type="hidden" name="item-shelf" value="<?php echo $shelf; ?>" />
        <input type="hidden" name="item-dim" value="<?php echo $dim_height . ' ' . $dim_length . ' ' . $dim_width . ' ' . $dim_thick . ' ' . $dim_weight . ' ' . $dim_diameter . ' ' . $dim_base_diameter . ' ' . $dim_mouth_diameter . ' ' . $dim_type; ?>" />
    </form>
    <form action="/wp-content/themes/sharjahsystem/inc/pdf/single.php" method="post" class="js-pdfForm" style="display: none;">
        <input type="hidden" name="img" value="<?php echo get_the_post_thumbnail_url( $id, 'full'); ?>" />
        <input type="hidden" name="img_height" value="" class="js-getImgHeight" />
        <input type="hidden" name="name" value="<?php echo $current_post->post_title; ?>" />
        <input type="hidden" name="descr" value="<?php echo apply_filters('the_content', get_post($id)->post_content ); ?>" />
        <input type="hidden" name="item-type" value="<?php echo $type; ?>" />
        <input type="hidden" name="item-mat" value="<?php echo $mat; ?>" />
        <input type="hidden" name="item-site" value="<?php echo $site->name; ?>" />
        <input type="hidden" name="item-period" value="<?php echo $period->name; ?>" />
        <input type="hidden" name="item-num" value="<?php echo $num; ?>" />
        <input type="hidden" name="item-num_loc" value="<?php echo $loc; ?>" />
        <input type="hidden" name="item-part" value="<?php echo $part; ?>" />
        <input type="hidden" name="item-rack" value="<?php echo $rack; ?>" />
        <input type="hidden" name="item-row" value="<?php echo $row; ?>" />
        <input type="hidden" name="item-shelf" value="<?php echo $shelf; ?>" />
        <input type="hidden" name="item-dim" value="<?php echo $dim_height . ' ' . $dim_length . ' ' . $dim_width . ' ' . $dim_thick . ' ' . $dim_weight . ' ' . $dim_diameter . ' ' . $dim_base_diameter . ' ' . $dim_mouth_diameter . ' ' . $dim_type; ?>" />
        <input type="hidden" name="lang" value="<?php echo $curLang; ?>" />
    </form>
<?php
get_footer();
