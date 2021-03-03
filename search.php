<?php
/**
 * Template Name: Search
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';
function selectFields($name, $selected = null) {
    global $wpdb;
    if($fields = $wpdb->get_results( "SELECT DISTINCT `meta_value` FROM `wp_postmeta` WHERE `meta_key`='$name'" )) {
        foreach ( $fields as $field ) {
            if($field->meta_value != '') {
                $metaForVal = str_replace('', '', $field->meta_value);
                echo ($selected != $metaForVal) ? '<option value="'.$metaForVal.'">'.$field->meta_value.'</option>' : '<option value="'.$metaForVal.'" selected>'.$field->meta_value.'</option>';
            }
        }
    }


}
?>

    <section  id="content" >
        <div class="container">
            <div class="container-white">
                <div class="row">
                    <div class="col-sm-2">
                        <form method="GET" action="/<?php echo $curLang; ?>/" class="filter-container">
                            <div class="filter-title">
                                <?php pll_e('Filter by'); ?>:
                            </div>
                            <div class="form-group">
                                <label for=""><?php pll_e('Site'); ?></label>
                                <?php
                                $terms = get_terms( [
                                    'taxonomy' => 'sites',
                                    'hide_empty' => false,
                                ] );
                                if ($terms) {
                                    $str = pll__('Site');
                                    echo '<select name="filt_by_sites" class="sel2">';
                                    echo ($_GET['filt_by_sites'] && $_GET['filt_by_sites'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    foreach($terms as $term) {
                                        echo ($_GET['filt_by_sites'] && $_GET['filt_by_sites'] == $term->slug) ? '<option value="'.$term->slug.'" selected>'.$term->name.'</option>' : '<option value="'.$term->slug.'">'.$term->name.'</option>';
                                    }
                                    echo '</select>';
                                }

                                ?>
                            </div>
                            <div class="form-group">
                                <label for=""><?php pll_e('Period'); ?></label>
                                <?php
                                $terms = get_terms( [
                                    'taxonomy' => 'periods',
                                    'hide_empty' => false,
                                ] );
                                if ($terms) {
                                    $str = pll__('Period');
                                    echo '<select name="filt_by_periods" class="sel2">';
                                    echo ($_GET['filt_by_periods'] && $_GET['filt_by_periods'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    foreach($terms as $term) {
                                        echo ($_GET['filt_by_periods'] && $_GET['filt_by_periods'] == $term->slug) ? '<option value="'.$term->slug.'" selected>'.$term->name.'</option>' : '<option value="'.$term->slug.'">'.$term->name.'</option>';
                                    }
                                    echo '</select>';
                                }

                                ?>
                            </div>
                            <input type="hidden" name="s" value="<?php echo $_GET['s']; ?>">
                            <div class="form-group">
                                <label for=""><?php pll_e('Object Number'); ?></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="<?php pll_e('from'); ?>" name="filt_by_from" value="<?php echo $_GET['filt_by_from'] ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="<?php pll_e('to'); ?>" name="filt_by_to" value="<?php echo $_GET['filt_by_to'] ?>">
                                    </div>
                                </div><!--row-->
                            </div>
                            <div class="form-group">
                                <label for=""><?php pll_e('Part'); ?></label>
                                <input type="text" class="form-control" value="<?php echo $_GET['item-num_part'] ?>" name="item-num_part">
                            </div>
                            <div class="form-group">
                                <label for=""><?php pll_e('Object Code'); ?></label>
                                <input type="text" class="form-control" value="<?php echo $_GET['item-num_loc'] ?>" name="item-num_loc">
                                <label for=""><?php pll_e('Object Type'); ?></label>
                                <?php
                                $str = pll__('Object Type');
                                echo '<select name="item-type" class="sel2">';
                                echo ($_GET['item-type'] && $_GET['item-type'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                selectFields('item-type', $_GET['item-type']);
                                echo '</select>';
                                ?>
                                <label for=""><?php pll_e('Material'); ?></label>
                                <?php
                                $str = pll__('Material');
                                echo '<select name="item-mat" class="sel2">';
                                echo ($_GET['item-mat'] && $_GET['item-mat'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                selectFields('item-mat', $_GET['item-mat']);
                                echo '</select>';
                                ?>
                                <label for=""><?php pll_e('Rack Number'); ?></label>
                                <?php
                                $str = pll__('Rack Number');
                                echo '<select name="item-rack" class="sel2">';
                                echo ($_GET['item-rack'] && $_GET['item-rack'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                selectFields('item-rack', $_GET['item-rack']);
                                echo '</select>';
                                ?>
                                <label for=""><?php pll_e('Row Number'); ?></label>
                                <?php
                                $str = pll__('Row Number');
                                echo '<select name="item-row" class="sel2">';
                                echo ($_GET['item-row'] && $_GET['item-row'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                selectFields('item-row', $_GET['item-row']);
                                echo '</select>';
                                ?>
                                <label for=""><?php pll_e('Shelf'); ?></label>
                                <?php
                                $str = pll__('Shelf');
                                echo '<select name="item-shelf" class="sel2">';
                                echo ($_GET['item-shelf'] && $_GET['item-shelf'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                selectFields('item-shelf', $_GET['item-shelf']);
                                echo '</select>';
                                ?>
                                <div class="showHide js-showHide" style=" height: 168px; ">
                                    <label class="ft" for="" style="margin-bottom: 10px; width: 100%;"><b><?php pll_e('Dimensions'); ?>:</b></label>
                                    <label class="ft" for=""><b><?php pll_e('Height'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Height');
                                    echo '<select name="item-dim_height" class="sel2">';
                                    echo ($_GET['item-dim_height'] && $_GET['item-dim_height'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_height', $_GET['item-dim_height']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Length'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Length');
                                    echo '<select name="item-dim_length" class="sel2">';
                                    echo ($_GET['item-dim_length'] && $_GET['item-dim_length'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_length', $_GET['item-dim_length']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Width'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Width');
                                    echo '<select name="item-dim_width" class="sel2">';
                                    echo ($_GET['item-dim_width'] && $_GET['item-dim_width'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_width', $_GET['item-dim_width']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Thickness'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Thickness');
                                    echo '<select name="item-dim_thick" class="sel2">';
                                    echo ($_GET['item-dim_thick'] && $_GET['item-dim_thick'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_thick', $_GET['item-dim_thick']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Weight'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Weight');
                                    echo '<select name="item-dim_weight" class="sel2">';
                                    echo ($_GET['item-dim_weight'] && $_GET['item-dim_weight'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_weight', $_GET['item-dim_weight']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Diameter'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Diameter');
                                    echo '<select name="item-dim_diameter" class="sel2">';
                                    echo ($_GET['item-dim_diameter'] && $_GET['item-dim_diameter'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_diameter', $_GET['item-dim_diameter']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Base Diameter'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Base Diameter');
                                    echo '<select name="item-dim_base_diameter" class="sel2">';
                                    echo ($_GET['item-dim_base_diameter'] && $_GET['item-dim_base_diameter'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_base_diameter', $_GET['item-dim_base_diameter']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Mouth Diameter'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Mouth Diameter');
                                    echo '<select name="item-dim_mouth_diameter" class="sel2">';
                                    echo ($_GET['item-dim_mouth_diameter'] && $_GET['item-dim_mouth_diameter'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_mouth_diameter', $_GET['item-dim_mouth_diameter']);
                                    echo '</select>';
                                    ?>
                                    <label class="ft" for=""><b><?php pll_e('Base Type'); ?>:</b></label>
                                    <?php
                                    $str = pll__('Type');
                                    echo '<select name="item-dim_type" class="sel2">';
                                    echo ($_GET['item-dim_type'] && $_GET['item-dim_type'] != 'all') ? '<option value="all">'.$str.'</option>' : '<option value="all" selected>'.$str.'</option>';
                                    selectFields('item-dim_type', $_GET['item-dim_type']);
                                    echo '</select>';
                                    ?>
                                </div>
                                <button type="button" class="showHideBtn js-showHideBtn"><?php pll_e('Show more'); ?></button>
                            </div>
                            <button class="btn btn-primary"><?php pll_e('Update Search'); ?></button>
                            <button class="showHideBtn mt-2 js-clearFilt" ><?php pll_e('Clear filter'); ?></button>
                        </form><!--filter-container-->
                        <div class="filter-container">
                            <div class="filters-checks">
                                <label class="ft" for=""><?php pll_e('Need to Print with'); ?>:</label>
                                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-listShowWith" name="obj_type" checked></span> <?php pll_e('Object Type (Kind)'); ?></label>
                                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-listShowWith" name="row_num" checked></span> <?php pll_e('Row Number'); ?></label>
                                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-listShowWith" name="rack_num" checked></span> <?php pll_e('Rack Number'); ?></label>
                                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-listShowWith" name="shelf" checked></span> <?php pll_e('Shelf'); ?></label>
                                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-listShowWith" name="dim" checked></span> <?php pll_e('Print All'); ?></label>
                            </div>
                        </div>
                    </div><!--col-sm-3-->
                    <div class="col-sm-10">
                        <div class="row mb-40px">
                            <div class="col-sm-8">
                                <div class="filter-top">
                                    <h3><?php pll_e('Search for'); ?>: <?php echo $_GET['item-num_loc']; ?></h3>
                                </div>
                            </div><!--col-sm-8-->
                            <div class="col-sm-4">
                                <div class="bottom-cw">
                                    <a href="#" class="btn btn-primary js-printAll"><?php pll_e('Print All'); ?></a>
                                    <a href="#" class="js-printAll"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/ex.png" alt=""></a>
                                    <a href="#" class="js-printAll"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pdf.png" alt=""></a>
                                </div>
                            </div><!--col-sm-4-->
                        </div><!--row-->
                        <!--<div class="row mb-40px">
                            <div class="col-sm-6">
                                <div class="filters-sort-list">
                                    <div class="fsl-title">
                                        Filters:
                                    </div>
                                    <ul class="list-unstyled">
                                        <li><a href="#">All Objects</a></li>
                                        <li><a href="#">All Sites</a></li>
                                        <li><a href="#">20th</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="view-filter-list">
                                    <div class="vfl-left">
                                        <div class="vfl-title">
                                            View
                                        </div>
                                        <ul class="list-unstyled">
                                            <li><a href="#"><i class="fa fa-th-large"></i></a></li>
                                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="vfl-sort">
                                        <div class="vfl-title">Sort</div>
                                        <select name="" class="sel2">
                                            <option value="">Default</option>
                                            <option value="">Default</option>
                                            <option value="">Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                            <?php
                            $forFilt = array();
                            $filtItt = 0;

                            $forFilt['relation'] = 'OR';
                            foreach($_GET as $key => $value) {
                                if($value != 'all' && $value != '' && strpos($key, 'filt_') === false && $key != 's' && $key != 'item-mat' && $key != 'item-num_part') {
                                    $forFilt[$filtItt.''] = array(
                                        'key' => $key,
                                        'value' => $value
                                    );
                                    $filtItt++;
                                }
                            }
                            if($_GET['filt_by_from'] && $_GET['filt_by_to']) {
                                $filt_from = intval(($_GET['filt_by_from'] && $_GET['filt_by_from'] != 'all') ? $_GET['filt_by_from'] : 0);
                                $filt_to = intval(($_GET['filt_by_to'] && $_GET['filt_by_to'] != 'all') ? $_GET['filt_by_to'] : 0);

                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-num',
                                    'value'   => array( $filt_from, $filt_to ),
                                    'type'    => 'numeric',
                                    'compare' => 'BETWEEN'
                                );
                                $filtItt++;
                            }
                            else if ($_GET['filt_by_from'] || $_GET['filt_by_to']){
                                $filt_from = intval(($_GET['filt_by_from'] && $_GET['filt_by_from'] != 'all') ? $_GET['filt_by_from'] : 0);
                                $filt_to = intval(($_GET['filt_by_to'] && $_GET['filt_by_to'] != 'all') ? $_GET['filt_by_to'] : 0);

                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-num',
                                    'value'   => ($filt_from != 0) ? $filt_from : $filt_to
                                );
                                $filtItt++;
                            }

                            if ($_GET['item-mat'] && $_GET['item-mat'] != 'all' && strlen($_GET['item-mat']) == 1){
                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-mat',
                                    'value'   => '^'.$_GET['item-mat'].'',
                                    'compare' => 'REGEXP'
                                );
                            } else if ($_GET['item-mat'] && $_GET['item-mat'] != 'all' && strlen($_GET['item-mat']) > 1){
                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-mat',
                                    'value'   => $_GET['item-mat']
                                );
                            }

                            if ($_GET['item-num_part'] && str_replace('-', '', $_GET['item-num_part']) != $_GET['item-num_part']){
                                $arr = explode('-', $_GET['item-num_part']);
                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-mat',
                                    'value'   => array($arr[0], $arr[1]),
                                    'compare' => 'BETWEEN'
                                );
                            } else if ($_GET['item-num_part']){
                                $forFilt[$filtItt] = array(
                                    'key'     => 'item-mat',
                                    'value'   => $_GET['item-mat']
                                );
                            }

                            $args = array(
                                'post_type' => 'items',
                                'meta_query' => $forFilt,
                                'posts_per_page' => 10,
                                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                                's' => $_GET['s']
                            );

                            if($_GET['filt_by_sites'] && $_GET['filt_by_sites'] != 'all') {
                                $args['sites'] = $_GET['filt_by_sites'];
                            }
                            if($_GET['filt_by_periods'] && $_GET['filt_by_periods'] != 'all') {
                                $args['periods'] = $_GET['filt_by_periods'];
                            }
                            /*$args = array_merge($args,
                                $wp_query->query
                            );*/

//                            echo '<pre>';
//                            var_dump($args);
//                            echo '</pre>';

                            $wp_query = new WP_Query($args);
                            if ( have_posts() ) :
                                $postArrs = array();
                                $postItt = 0;
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
                                                <div class="check-this">
                                                    <label class="check"><span class="checkbox"><input type="checkbox" name="to_print" class="js-chkSrch" data-id="<?php echo $post->ID; ?>"></span></label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="pb-image">
                                                            <?php the_post_thumbnail('adv-srch-thumb', array('class' => 'img-fluid')); ?>
                                                        </div>
                                                        <div class="">
                                                            <a href="/<?php echo $curLang; ?>/edit/?id=<?php echo $post->ID; ?>" class="showHideBtn mt-2"><?php pll_e('Edit'); ?></a>
                                                            <a href="#" class="showHideBtn mt-2 ml-2 js-modalItem" data-id="<?php echo $post->ID; ?>"><?php pll_e('Details'); ?></a>
                                                        </div>
                                                    </div><!--col-sm-5-->
                                                    <div class="col-sm-6">
                                                        <div class="object-title"><?php pll_e('Object Number'); ?>: <span><?php the_field('item-num_loc'); ?> <?php the_field('item-num'); ?> <?php the_field('item-num_part'); ?></span></div>
                                                        <div class="object-list">
                                                            <ul class="list-unstyled">
                                                                <li><?php pll_e('Object Name'); ?>: <span><?php the_title(); ?></span></li>
                                                                <?php $str = pll__('Row Number'); echo (get_field('item-row')) ? '<li>'.$str.': <span>'.get_field('item-row').'</span></li>' : ''; ?>
                                                                <?php $str = pll__('Object Type'); echo (get_field('item-type')) ? '<li>'.$str.': <span>'.get_field('item-type').'</span></li>' : ''; ?>
                                                                <?php $str = pll__('Rack Number'); echo (get_field('item-rack')) ? '<li>'.$str.': <span>'.get_field('item-rack').'</span></li>' : ''; ?>
                                                                <?php $str = pll__('Shelf'); echo (get_field('item-shelf')) ? '<li>'.$str.': <span>'.get_field('item-shelf').'</span></li>' : ''; ?>
                                                                <?php $str = pll__('Dimensions'); echo (get_field('item-dim')) ? '<li>'.$str.': <span>'.get_field('item-dim').'</span></li>' : ''; ?>
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
                                $nothingMessage = pll__('Nothing found in this category...');
                                echo $nothingMessage;

                            endif;
                            ?>
                            <script>
                                var postIds = <?php echo json_encode($postArrs); ?>;
                            </script>
                        <?php /* ?><div class="breadcrumbs-block new-br">
                            <button class="btn btn-default" type="button">First Page</button>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                            <div class="button-last">
                                <button class="btn btn-default" type="button">Last Page</button>
                            </div>
                        </div><!--breadcrumbs-block--><?php */ ?>
                    </div><!--col-sm-9-->
                </div><!--row-->
            </div><!--container-white-->
            <div class="bottom-cw btn_wrap_rel">
                <a href="#" class="btn btn-primary js-clearAllSrch"><?php pll_e('Clear Selected'); ?></a>
                <a href="#" class="btn btn-primary js-printSelected"><?php pll_e('Print Selected'); ?></a>
                <a href="#" class="js-printSelected"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/ex.png" alt=""/></a>
                <a href="#" class="js-printSelected"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pdf.png" alt=""/></a>
                <a href="#" class="btn btn-primary js-delSelected btn_del_sel" style="background: #c70000;"><?php pll_e('Delete Selected'); ?></a>
            </div><!--bottom-cw-->
        </div><!--container-->
    </section><!--content-->

    <script>
        $('.js-clearAllSrch').click(function(e){
            e.preventDefault();
            console.log($('.js-chkSrch'))
            $('.js-chkSrch').prop('checked', false);
            $('.js-chkSrch').closest('.checked').removeClass('checked');
        });
    </script>
    <style>
        .print-block {
            height: calc(100% - 30px);
        }
    </style>

    <div style="display: none;">
        <div class="box-modal" id="listmodal">

        </div>
    </div>

<?php
get_footer();
