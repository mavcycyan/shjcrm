<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();
$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';
?>

    <section  id="content" >
        <div class="container">
            <?php

                $getParam = '';
                foreach ($_GET as $key => $array) {
                    if($key == 'type') {
                        $getParam[0] = $array;
                    }
                    if($key == 'slug') {
                        $getParam[1] = $array;
                    }
                    if($key == 'post_id') {
                        $getParam[2] = $array;
                    }
                }

                if(!$getParam[0] || $getParam[0] == '') {
                    $getParam[0] = 'sites';
                }

                $term = get_term( $getParam[2], $getParam[0] );
                $catImg = get_field('cat-img', $getParam[0].'_'.$term->term_id);

            ?>
            <?php
                $terms = get_terms( array(
                    'taxonomy' => $getParam[0],
                    'hide_empty' => false
                ) );
                $prevTerm = '';
                $nextTerm = '';
//                var_dump($terms);
                if( $terms && ! is_wp_error($terms) ){
                    for($i = 0; $i < count($terms); $i++){
                        if($terms[$i]->term_id == $getParam[2]) {
                            $prevTerm = ($i != 0) ? $terms[$i-1] : '';
                            $nextTerm = ($i+1 < count($terms)) ? $terms[$i+1] : '';
                            break;
                        }
                    }

                }
            ?>
            <div class="navigation-top">
                <?php if ($prevTerm) : ?>
                    <a href="/<?php echo $curLang; ?>/items/?type=<?php echo $getParam[0]; ?>&slug=<?php echo $prevTerm->slug; ?>&post_id=<?php echo $prevTerm->term_id; ?>" class="control-t"><span class="icon-left-arrow"></span><?php pll_e('Previous Site'); ?></a>
                <?php endif; ?>
                <a href="/<?php echo $curLang; ?>/items/?type=<?php echo $getParam[0]; ?>" class="nav-all"><?php pll_e('View All'); ?></a>
                <?php if ($nextTerm) : ?>
                    <a href="/<?php echo $curLang; ?>/items/?type=<?php echo $getParam[0]; ?>&slug=<?php echo $nextTerm->slug; ?>&post_id=<?php echo $nextTerm->term_id; ?>" class="control-t"><?php pll_e('Next Site'); ?> <span class="icon-right-arrow"></span></a>
                <?php endif; ?>
            </div><!--navigation-top-->
            <div class="new-grey-block">
                <?php if ($catImg) : ?>
                <div class="single-block cat-block">
                    <div class="row">
                        <div class="col-sm-4">
                            <?php if ($catImg['url']) : ?>
                                <a href="#" class="cat-image">
                                    <img src="<?php echo $catImg['url']; ?>" alt="" class="img-fluid">
                                </a>
                            <?php endif; ?>
                        </div><!--col-sm-4-->
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="cat-title"><?php echo $term->name; ?></div>
                                </div><!--col-sm-6-->
                                <div class="col-sm-4">
                                    <?php
                                    $link = "/$curLang/categ-add/?taxonomy=$tax_name&id=$term->term_id";
                                    ?>
                                    <div class="cat-info">
                                        <a href="<?php echo $link; ?>" target="_blank"><?php pll_e('Edit'); ?></a>
                                        <a href="/<?php echo $curLang; ?>/print-list/?type=<?php echo $tax_name; ?>&cat_id=<?php echo $term->slug; ?>" data-type="<?php echo $tax_name; ?>" data-catid="<?php echo $term->slug; ?>" class="js-printForMdl"><?php pll_e('Print'); ?></a>
                                    </div><!--cat-info-->
                                </div><!--col-sm-4-->
                            </div><!--row-->
                            <div class="upload-by">
                                <?php pll_e('Upload By'); ?>: <?php the_author(); ?>  | <?php pll_e('Date'); ?>: <?php echo get_the_date('m/d/Y'); ?>
                            </div>
                            <div >
                                <p><?php the_field('cat-intro', $getParam[0].'_'.$term->term_id); ?></p>
                            </div>
                            <hr>
                            <div class="sb-bottom">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <div class="sb-items">
                                            <span class="icon-rock"></span>
                                            <?php echo $term->count; ?> <?php pll_e('items'); ?>
                                        </div>
                                    </div><!--col-sm-6-->

                                </div><!--row-->
                            </div><!--sb-bottom-->
                        </div><!--col-sm-8-->
                    </div><!--row-->
                </div>
                <?php endif; ?>
                <div class="new-container-list">
                    <div class="new-dropdown">
                        <div class="nd-text"><?php pll_e('Items Displayed'); ?>:</div>
                        <div class="dropdown">
                            <select name="post_count" id="" class="sel2 js-postCount" style="margin-bottom: 0">
                                <option value="9" <?php echo (!$_GET['post_count'] || $_GET['post_count'] == 9)? 'selected' : ''; ?>>9</option>
                                <option value="18" <?php echo ($_GET['post_count'] == 18)? 'selected' : ''; ?>>18</option>
                                <option value="27" <?php echo ($_GET['post_count'] == 27)? 'selected' : ''; ?>>27</option>
                                <option value="36" <?php echo ($_GET['post_count'] == 36)? 'selected' : ''; ?>>36</option>
                            </select>
                            <?php /* ?>
                            <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" query-url="<?php echo $url10; ?>">
                                10
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" query-url="<?php echo $url20; ?>">20</button>
                                <button class="dropdown-item" type="button" query-url="<?php echo $url30; ?>">30</button>
                                <button class="dropdown-item" type="button" query-url="<?php echo $url40; ?>">40</button>
                            </div>
                            <?php */ ?>
                        </div>
                    </div>
                    <div class="new-list">
                        <?php
                        $args = array();
                        if ($getParam[1] && $getParam[1] != '') {
                            $args[$getParam[0]] = $getParam[1];
                        } else {
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy' => $getParam[0],
                                    'operator' => 'EXISTS',
                                )
                            );
                        }

                        $args['posts_per_page'] = ($_GET['post_count']) ? $_GET['post_count'] : 9;
                        $args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;
                        $wp_query = new WP_Query($args, $wp_query->query);
                        if ( have_posts() ) :
                            $postArrs = array();
                            $postItt = 0;
                            ?>
                            <div class="row">
                                <?php
                                while ( have_posts() ) :
                                    the_post();
                                    $postArrs[$postItt] = $post->ID;
                                    ?>
                                    <div class="col-sm-4">
                                        <div class="nl-block js-item">
                                            <div class="nl-bottom">
                                                <a href="/<?php echo $curLang; ?>/edit/?id=<?php echo $post->ID; ?>"><?php pll_e('Edit'); ?></a>
                                                <a href="#" class="js-itemDel" data-id="<?php echo $post->ID; ?>"><?php pll_e('Remove'); ?></a>
                                                <a href="/<?php echo $curLang; ?>/print/?id=<?php echo $post->ID; ?>"><?php pll_e('Print'); ?></a>
                                            </div><!--nl-bottom-->
                                            <a href="#" class="add-new js-modalItem" data-id="<?php echo $post->ID; ?>"><i class="fas fa-plus"></i></a>
                                            <div class="nl-image">
                                                <a href="#" class="js-modalItem" data-id="<?php echo $post->ID; ?>">
                                                    <?php the_post_thumbnail('item-thumb', array('class' => 'img-fluid')); ?>
                                                </a>
                                            </div>
                                            <div class="nl-cont">

                                                <div class="nl-top-text"><?php pll_e('Object N0.'); ?>: <?php the_field('item-num_loc'); ?> <?php the_field('item-num'); ?> <?php the_field('item-num_part'); ?></div>
                                                <div class="nl-title"><?php the_title(); ?></div>
                                                <div class="nl-city"><?php the_field('item-disc'); ?></div>

                                            </div><!--nl-cont-->
                                        </div><!--nl-block-->
                                    </div><!--col-sm-4-->
                                    <?php
                                    $postItt++;
                                endwhile;
                                ?>
                            </div>
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
                    </div><!--new-list-->
                </div>
            </div>
        </div>
    </section>
    <style>
		.nl-block {
			height: calc(100% - 30px);
		}
        .box-hidden-spinner-wrap {
            position: absolute;
            z-index: 2;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .box-hidden-spinner {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
        }

        .box-hidden-spinner i {
            color: #b58556;
            font-size: 60px;
            animation: spinner-rotate 1s infinite linear;
        }

        @keyframes spinner-rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div style="display: none;">
        <div class="box-modal" id="listmodal">

        </div>
    </div>
    <div style="display: none;">
        <div class="box-modal" id="checkprint" style="background: #fff;max-width: 300px;padding: 20px;">
            <div class="filters-checks">
                <label class="ft" for=""><?php pll_e('Need to Print with'); ?>:</label>
                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-forpar" name="forpar" value="obj_type" checked></span> <?php pll_e('Object Type (Kind)'); ?></label>
                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-forpar" name="forpar" value="row_num" checked></span> <?php pll_e('Row Number'); ?></label>
                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-forpar" name="forpar" value="rack_num" checked></span> <?php pll_e('Rack Number'); ?></label>
                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-forpar" name="forpar" value="shelf" checked></span> <?php pll_e('Shelf'); ?></label>
                <label class="check checked"><span class="checkbox"><input type="checkbox" class="js-forpar" name="forpar" value="dim" checked></span> <?php pll_e('Dimensions'); ?></label>
                <form action="/<?php echo $curLang; ?>/print-list/">
                    <input type="hidden" class="js-printToMdlType" name="type">
                    <input type="hidden" class="js-printToMdlId" name="cat_id">
                    <input type="hidden" class="js-printParams" name="params" value="obj_type,row_num,rack_num,shelf,dim">
                    <button type="submit" class="btn btn-primary"><?php pll_e('Print'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php
get_footer();
