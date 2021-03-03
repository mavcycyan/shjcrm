<?php
/**
 * Template Name: Print all
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();

$id = '';
$params = '';
$cat_id = '';
$cat_type = 'sites';
$from_search = false;

if($_GET['type'] && $_GET['type'] != '') {
    $cat_type = $_GET['type'];
}

if($_GET['id'] && $_GET['id'] != '') {
    $id = explode(',', $_GET['id']);
    $from_search = true;
    $params = explode(',', $_GET['params']);
}
else if($_GET['cat_id'] || $_GET['cat_id'] != '') {
    $cat_id = $_GET['cat_id'];
    $params = explode(',', $_GET['params']);
}
else {
    header('Location: /');
    exit;
}

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';

?>
    <section  id="content" >
        <div class="container">
        <?php /* ?><div class="big-title">
                <div class="bt"><?php pll_e('Print Page A4 size'); ?></div>
            </div><?php */ ?>
            <div class="container-white">

                <?php
                $args = array(
                    'post_type' => 'items',
                    'posts_per_page' => -1
                );

                if($id != '') {
                    $args['post__in'] = $id;
                }
                if($cat_id != '') {
                    $args[$cat_type] = $cat_id;
                }

                $wp_query = new WP_Query($args);
                if ( have_posts() ) :
                    ?>
                    <div class="row">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            $postArrs[$postItt] = array(
                                'id' => $post->ID,
                                'activated' => false
                            );
                            ?>

                            <div class="col-sm-6">
                                <div class="print-block">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="pb-image">
                                                <?php the_post_thumbnail('adv-srch-thumb', array('class' => 'img-fluid')); ?>
                                            </div>
                                        </div><!--col-sm-5-->
                                        <div class="col-sm-6">
                                            <div class="object-title"><?php pll_e('Object Number'); ?>: <span><?php the_field('item-num_loc'); ?> <?php the_field('item-num'); ?> <?php the_field('item-num_part'); ?></span></div>
                                            <div class="object-list">
                                                <ul class="list-unstyled">
                                                    <li><?php pll_e('Object Name'); ?>: <span><?php the_title(); ?></span></li>

                                                    <?php if(in_array('obj_type', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Object Type'); ?>
                                                        <?php echo (get_field('item-type')) ? '<li>'.$str.': <span>'.get_field('item-type').'</span></li>' : ''; ?>
                                                    <?php endif; ?>

                                                    <?php if(in_array('obj_type', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Object Location'); ?>
                                                        <?php echo (get_field('obj-loc')) ? '<li>'.$str.': <span>'.get_field('item-type').'</span></li>' : ''; ?>
                                                    <?php endif; ?>

                                                    <?php if(in_array('row_num', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Row Number'); ?>
                                                        <?php echo (get_field('item-row')) ? '<li>'.$str.': <span>'.get_field('item-row').'</span></li>' : ''; ?>
                                                    <?php endif; ?>

                                                    <?php if(in_array('rack_num', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Rack Number'); ?>
                                                        <?php echo (get_field('item-rack')) ? '<li>'.$str.': <span>'.get_field('item-rack').'</span></li>' : ''; ?>
                                                    <?php endif; ?>

                                                    <?php if(in_array('shelf', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Shelf'); ?>
                                                        <?php echo (get_field('item-shelf')) ? '<li>'.$str.': <span>'.get_field('item-shelf').'</span></li>' : ''; ?>
                                                    <?php endif; ?>

                                                    <?php if(in_array('dim', $params) == ''): ?>
                                                    <?php else : ?>
                                                        <?php $str = pll__('Dimensions'); ?>
                                                        <?php echo (get_field('item-dim')) ? '<li>'.$str.': <span>'.get_field('item-dim').'</span></li>' : ''; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div><!--col-sm-7-->
                                    </div><!--row-->
                                </div><!--print-block-->
                            </div><!--col-sm-6-->
                            <?php
                            $postItt++;
                        endwhile;
                        ?>
                    </div><!--row-->
                    <div class="breadcrumbs-block new-br">
                        <?php wp_pagenavi(); ?>
                    </div>
                    <?php
                else :

                    echo 'Nothing found in this category...';

                endif;
                ?>
            </div><!--container-white-->
            <div class="bottom-cw">
                <a href="#" class="btn btn-primary js-printSubm"><?php pll_e('Print'); ?></a>
                <a href="#" class="js-xlsFormBtn"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/ex.png" alt=""/></a>
                <a href="#" class="js-pdfFormBtn"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pdf.png" alt=""/></a>
            </div><!--bottom-cw-->
        </div><!--container-->
    </section><!--content-->
    <form action="/wp-content/themes/sharjahsystem/inc/xls/list.php" method="post" class="js-xlsFormList" style="display: none;">
        <input type="hidden" name="id" value="" class="js-formListId" />
        <input type="hidden" name="params" value="" class="js-formListParams" />
        <input type="hidden" name="type" value="" class="js-formListCat" />
        <input type="hidden" name="cat_id" value="" class="js-formListCatVal" />
    </form>
    <form action="/wp-content/themes/sharjahsystem/inc/pdf/list.php" method="post" class="js-pdfFormList" style="display: none;">
        <input type="hidden" name="id" value="" class="js-formListId" />
        <input type="hidden" name="params" value="" class="js-formListParams" />
        <input type="hidden" name="type" value="" class="js-formListCat" />
        <input type="hidden" name="cat_id" value="" class="js-formListCatVal" />
        <input type="hidden" name="lang" value="<?php echo $curLang; ?>" />
    </form>
<?php
get_footer();
