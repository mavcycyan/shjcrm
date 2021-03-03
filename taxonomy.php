<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();
?>

    <section  id="content" >
        <div class="container">
            <div class="filter-container">
                <div class="row">
                    <div class="offset-sm-3 col-sm-6">
                        <a href="#" class="filter-btn btn">By Sites</a>
                        <a href="#" class="filter-btn btn dropdown-toggle" data-toggle="dropdown">By Objects</a>
                        <div class="dropdown-menu filter-drop">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="filter-list">
                                        <ul class="list-unstyled">
                                            <li><a href="#">Jar</a></li>
                                            <li><a href="#">Weapon</a></li>
                                            <li><a href="#">Ornament</a></li>
                                            <li><a href="#">Coin</a></li>
                                            <li><a href="#">Weapon</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="filter-list">
                                        <ul class="list-unstyled">
                                            <li><a href="#">Jar</a></li>
                                            <li><a href="#">Weapon</a></li>
                                            <li><a href="#">Ornament</a></li>
                                            <li><a href="#">Coin</a></li>
                                            <li><a href="#">Weapon</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <a href="#" class="filter-btn btn">By Period</a>
                    </div><!--col-sm-6-->
                    <div class="col-sm-3">
                        <div class="site-button">
                            <a href="#" class="btn filter-btn add-site"><i class="fa fa-plus"></i> Add Site</a>
                        </div>
                    </div><!--col-sm-3-->
                </div><!--row-->
            </div><!--filter-container-->

            <?php if ( have_posts() ) : ?>

                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <div class="single-block cat-block">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="<?php the_permalink(); ?>" class="cat-image">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            </div><!--col-sm-4-->
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="cat-title"><?php the_title(); ?></div>
                                    </div><!--col-sm-6-->
                                    <div class="col-sm-4">
                                        <div class="cat-info">
                                            <a href="#">Edit</a>
                                            <a href="#">Print</a>
                                        </div><!--cat-info-->
                                    </div><!--col-sm-4-->
                                </div><!--row-->
                                <div class="upload-by">
                                    Upload By: <?php the_author(); ?>  | Date: <?php echo get_the_date('m/d/Y'); ?>
                                </div>
                                <div class="cat-content">
                                    <p>industry's standard dummy text ever since the 1500s, when an industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and </p>
                                </div>
                                <hr/>
                                <div class="sb-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <div class="sb-items">
                                                <span class="icon-rock"></span>
                                                301 items
                                            </div>
                                        </div><!--col-sm-6-->
                                        <div class="col-sm-6">
                                            <div class="sb-buttons">
                                                <a href="#" class="btn btn-default">Views All Items</a>
                                            </div>
                                        </div><!--col-sm-6-->
                                    </div><!--row-->
                                </div><!--sb-bottom-->
                            </div><!--col-sm-8-->
                        </div><!--row-->
                    </div><!--single-block-->
                    <?php
                endwhile;
                the_posts_navigation();

            else :

                echo 'Nothing found in this category...';

            endif;
            ?>
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
        </div><!--container-->
    </section><!--content-->

<?php
get_footer();
