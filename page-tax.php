<?php
/**
 * Template Name: Taxonomy list
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
            <div class="filter-container">
                <div class="row">
                    <?php $tax_name = (get_field('tax_name')) ? get_field('tax_name') : 'sites'; ?>
                    <div class="offset-sm-3 col-sm-6 rtl-filt-cont-wrap">
                        <a href="/<?php echo $curLang; ?>/sites/" class="filter-btn btn <?php echo ($tax_name == 'sites') ? 'active' : ''; ?>"><?php echo ($curLang == 'en') ? 'By Sites' : 'حسب المواقع'; ?></a>
                        <div class="objBtn">
                            <a href="/<?php echo $curLang; ?>/objects/" class="filter-btn btn <?php echo ($tax_name == 'objects') ? 'active' : ''; ?>"><?php echo ($curLang == 'en') ? 'By Objects' : 'حسب الكائنات'; ?></a>
                            <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'objects',
                                'hide_empty' => false
                            ) );

                            if( $terms && ! is_wp_error($terms) ):
                                ?>
                                <div class="objWrap">
                                    <div class="objDrop filter-drop" style="width: 400px; width: max-content;">
                                        <div class="row">
                                            <?php
                                            foreach($terms as $term) :
                                                ?>
                                                <div class="col-sm-6">
                                                    <div class="filter-list">
                                                        <ul class="list-unstyled">
                                                            <li><a href="/<?php echo $curLang; ?>/items/?type=objects&slug=<?php echo $term->slug; ?>&post_id=<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                        <a href="/<?php echo $curLang; ?>/periods/" class="filter-btn btn <?php echo ($tax_name == 'periods') ? 'active' : ''; ?>"><?php echo ($curLang == 'en') ? 'By Period' : 'حسب الفترة'; ?></a>
                    </div><!--col-sm-6-->
                    <div class="col-sm-3 rtl-filt-cont-wrap2">
                        <div class="site-button">
                            <?php
                                $tax_sing = '';
                                if($tax_name == 'sites'){
                                    $tax_sing = pll__('Add site');
                                }
                                if($tax_name == 'objects'){
                                    $tax_sing = pll__('Add object');
                                }
                                if($tax_name == 'periods'){
                                    $tax_sing = pll__('Add period');
                                }
                            ?>
                            <a href="/<?php echo $curLang; ?>/categ-add/?taxonomy=<?php echo $tax_name; ?>" class="btn filter-btn add-site"><i class="fa fa-plus"></i> <?php echo $tax_sing; ?></a>
                        </div>
                    </div><!--col-sm-3-->
                </div><!--row-->
            </div><!--filter-container-->

            <?php
            $terms = get_terms( array(
                'taxonomy' => $tax_name,
                'hide_empty' => false
            ) );
            ?>
            <?php if($terms): ?>
                <?php foreach($terms as $term): ?>
                    <div class="single-block cat-block">
                        <div class="row">
                            <div class="col-sm-4">
                                <?php if ($catImg = get_field('cat-img', $tax_name.'_'.$term->term_id)): ?>
                                    <a href="/<?php echo $curLang; ?>/items/?type=<?php echo $tax_name; ?>&slug=<?php echo $term->slug; ?>&post_id=<?php echo $term->term_id; ?>" class="cat-image">
                                        <img src="<?php echo $catImg['url']; ?>" alt="" class="img-fluid" />
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
                                            <a href="<?php echo $link; ?>"><?php pll_e('Edit'); ?></a>
                                            <a href="/<?php echo $curLang; ?>/print-list/?type=<?php echo $tax_name; ?>&cat_id=<?php echo $term->slug; ?>" data-type="<?php echo $tax_name; ?>" data-catid="<?php echo $term->slug; ?>" class="js-printForMdl"><?php pll_e('Print'); ?></a>
                                            <a href="#" class="js-catDel" data-id="<?php echo $term->term_id; ?>" data-taxonomy="<?php echo $tax_name; ?>"><?php pll_e('Remove'); ?></a>
                                        </div><!--cat-info-->
                                    </div><!--col-sm-4-->
                                </div><!--row-->
                                <div class="upload-by">
                                    <?php pll_e('Upload By'); ?>: <?php the_author(); /* ?>  | <?php pll_e('Date'); ?>: <?php echo get_the_date('m/d/Y'); */ ?>
                                </div>
                                <div class="cat-content">
                                    <p>
                                        <?php the_field('cat-intro', $tax_name.'_'.$term->term_id); ?>
                                    </p>
                                </div>
                                <hr/>
                                <div class="sb-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <div class="sb-items">
                                                <span class="icon-rock"></span>
                                                <?php echo $term->count; ?> <?php pll_e('items'); ?>
                                            </div>
                                        </div><!--col-sm-6-->
                                        <div class="col-sm-6">
                                            <div class="sb-buttons">
                                                <a href="/<?php echo $curLang; ?>/items/?type=<?php echo $tax_name; ?>&slug=<?php echo $term->slug; ?>&post_id=<?php echo $term->term_id; ?>" class="btn btn-default"><?php pll_e('View all items'); ?></a>
                                            </div>
                                        </div><!--col-sm-6-->
                                    </div><!--row-->
                                </div><!--sb-bottom-->
                            </div><!--col-sm-8-->
                        </div><!--row-->
                    </div><!--single-block-->
                <?php endforeach; ?>
            <?php endif;?>
            <?php /* ?>
            <div class="breadcrumbs-block">
                <div class="row align-items-center">
                    <div class="col-sm-3">
                        <button class="btn btn-default" type="button">First Page</button>
                    </div><!--col-sm-3-->
                    <div class="col-sm-6">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-sm-3">
                        <div class="button-last">
                            <button class="btn btn-default" type="button">Last Page</button>
                        </div>
                    </div>
                </div><!--row-->
            </div><!--breadcrumbs-block-->
            <?php */ ?>
        </div><!--container-->
    </section><!--content-->


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
