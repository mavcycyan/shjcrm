<?php
/**
 * The template for displaying front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
            <h1><?php the_title(); ?></h1>
            <div>
                <?php the_content(); ?>
            </div>
            <?php $block = get_field('main-block_sites'); ?>
            <?php $count = 0; $count2 = 0; $terms = get_terms( array('taxonomy' => 'sites', 'hide_empty' => false) ); ?>
            <?php if($terms): ?>
                <?php foreach($terms as $term): ?>
                    <?php $count += $term->count; ?>
                    <?php $count2 ++; ?>
                <?php endforeach; ?>
            <?php endif;?>
            <div class="single-block">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/sites/" class="sb-image">
                            <img src="<?php echo $block['img']['url']; ?>" alt="" class="img-fluid" />
                            <div class="sb-icon">
                                <span class="icon-map"></span>
                            </div>
                        </a>
                    </div><!--col-sm-4-->
                    <div class="col-sm-8">
                        <div class="sb-title"><?php echo $block['ttl'] ?></div>
                        <p><?php echo $block['txt'] ?></p>
                        <hr/>
                        <div class="sb-bottom">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-map"></span>
                                        <?php echo $count2; ?> <?php pll_e('sites'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-map"></span>
                                        <?php echo $count; ?> <?php pll_e('items'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <div class="sb-buttons">
                                        <a href="/<?php echo $curLang; ?>/sites/" class="btn btn-default"><?php pll_e('View'); ?></a>
                                    </div>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div><!--sb-bottom-->
                    </div><!--col-sm-8-->
                </div><!--row-->
            </div><!--single-block-->
            <?php $block = get_field('main-block_objects'); ?>
            <?php $count = 0; $count2 = 0; $terms = get_terms( array('taxonomy' => 'objects', 'hide_empty' => false) ); ?>
            <?php if($terms): ?>
                <?php foreach($terms as $term): ?>
                    <?php $count += $term->count; ?>
                    <?php $count2 ++; ?>
                <?php endforeach; ?>
            <?php endif;?>
            <div class="single-block">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/objects/" class="sb-image">
                            <img src="<?php echo $block['img']['url']; ?>" alt="" class="img-fluid" />
                            <div class="sb-icon">
                                <span class="icon-jar"></span>
                            </div>
                        </a>
                    </div><!--col-sm-4-->
                    <div class="col-sm-8">
                        <div class="sb-title"><?php echo $block['ttl'] ?></div>
                        <p><?php echo $block['txt'] ?></p>
                        <hr/>
                        <div class="sb-bottom">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-jar"></span>
                                        <?php echo $count2; ?> <?php pll_e('objects'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-jar"></span>
                                        <?php echo $count; ?> <?php pll_e('items'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <div class="sb-buttons">
                                        <a href="/<?php echo $curLang; ?>/objects/" class="btn btn-default"><?php pll_e('View'); ?></a>
                                    </div>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div><!--sb-bottom-->
                    </div><!--col-sm-8-->
                </div><!--row-->
            </div><!--single-block-->
            <?php $block = get_field('main-block_period'); ?>
            <?php $count = 0; $count2 = 0; $terms = get_terms( array('taxonomy' => 'periods', 'hide_empty' => false) ); ?>
            <?php if($terms): ?>
                <?php foreach($terms as $term): ?>
                    <?php $count += $term->count; ?>
                    <?php $count2 ++; ?>
                <?php endforeach; ?>
            <?php endif;?>
            <div class="single-block">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/<?php echo $curLang; ?>/periods/" class="sb-image">
                            <img src="<?php echo $block['img']['url']; ?>" alt="" class="img-fluid" />
                            <div class="sb-icon">
                                <span class="icon-rock"></span>
                            </div>
                        </a>
                    </div><!--col-sm-4-->
                    <div class="col-sm-8">
                        <div class="sb-title"><?php echo $block['ttl'] ?></div>
                        <p><?php echo $block['txt'] ?></p>
                        <hr/>
                        <div class="sb-bottom">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-rock"></span>
                                        <?php echo $count2; ?> <?php pll_e('period'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <div class="sb-items">
                                        <span class="icon-rock"></span>
                                        <?php echo $count; ?> <?php pll_e('items'); ?>
                                    </div>
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <div class="sb-buttons">
                                        <a href="/<?php echo $curLang; ?>/periods/" class="btn btn-default"><?php pll_e('View'); ?></a>
                                    </div>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div><!--sb-bottom-->
                    </div><!--col-sm-8-->
                </div><!--row-->
            </div><!--single-block-->
        </div><!--container-->
    </section><!--content-->

<?php

get_footer();
