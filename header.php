<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sharjahsystem
 */
$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';
if(!is_user_logged_in() && !is_page(23)) {
    wp_redirect( '/'.$curLang.'/user-login/', 302 );
    exit;
}

$current_user = wp_get_current_user();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=1200px">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="ICON" href="/favicon.ico" />

	<?php wp_head(); ?>

    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <?php if($curLang == 'ar'): ?>
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <?php endif; ?>
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/jquery.rateyo.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
<!--    <link href="--><?php //bloginfo( 'template_url' ); ?><!--/assets/css/select2.css" rel="stylesheet">-->
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/iconmoon.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/swiper.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/jquery-simple-mobilemenu.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/jquery.arcticmodal-0.3.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/slick.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/style.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/print.css" rel="stylesheet" type="text/css" media="print" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script>
        var translates = {
            error : "<?php pll_e('Error'); ?>",
            del_success : "<?php pll_e('Item deleted successfully'); ?>",
            img_upl_success : "<?php pll_e('Image uploaded successfully'); ?>",
            img_upl_fail : "<?php pll_e('Uploading failed!'); ?>",
            nothing_sel : "<?php pll_e('Nothing was selected'); ?>",
            sure_del_item : "<?php pll_e('Are you sure you want to delete this item?'); ?>",
            sure_del : "<?php pll_e('Are you sure ?'); ?>",
        }
    </script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery.fancybox.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery-simple-mobilemenu.min.js"></script>
    <script src="https://kit.fontawesome.com/e1d2ed61f1.js" crossorigin="anonymous"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/owl.carousel.min.js"></script>
<!--    <script src="--><?php //bloginfo( 'template_url' ); ?><!--/assets/js/select2.min.js"></script>-->
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/scripts.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/slick.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/main.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <?php if ($post->ID == 2 || 154) : ?>
        <header id="header">
            <div class="container">
                <div class="offset-sm-3 col-sm-6">
                    <a href="/" class="logo"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/logo.png" alt="" class="img-fluid"></a>
                </div><!--col-sm-6-->
            </div><!--container-->
        </header>
    <?php else: ?>
        <header id="header">
            <div class="container">
                <div class="offset-sm-4 col-sm-4">
                    <a href="/" class="logo mb-35px"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/logo.png" alt="" class="img-fluid"></a>
                    <div class="text-center">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <div class="subtitle"><?php echo ($curLang == 'en') ? get_field('h-txt', 'options') : get_field('h-txt_ar', 'options'); ?></div>
                    </div>
                </div><!--col-sm-6-->
            </div><!--container-->
        </header>
    <?php endif; ?>
    <div class="header-menu-container">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-5">
                    <div class="header-search-container">
                        <?php get_search_form(); ?>
                        <a href="<?php echo ($curLang == 'en') ? get_the_permalink(43) : get_the_permalink(203); ?>" class="search-link"><?php echo ($curLang == 'en') ? 'Advanced Search' : 'البحث المتقدم'; ?></a>
                        <?php if($curLang == 'en'): ?>
                            <a href="/ar/" class="search-link">عربى</a>
                        <?php else: ?>
                            <a href="/en/" class="search-link">EN</a>
                        <?php endif; ?>
                    </div><!--header-search-container-->
                </div><!--col-sm-5-->
                <div class="col-sm-7">
                    <div class="header-nav">
                        <ul class="list-unstyled">
                            <li>
                                <a href="/">
                                    <span class="icon-jar"></span>
                                    <?php echo ($curLang == 'en') ? 'Home' : 'الصفحة الرئيسية'; ?>
                                </a>
                            </li>
                            <li>
                                <a href="/<?php echo $curLang; ?>/add/">
                                    <span class="icon-jar"></span>
                                    <?php echo ($curLang == 'en') ? 'Add Items' : 'إضافة عناصر'; ?>
                                </a>
                            </li>
                            <li class="dropd">
                                <a href="#">
                                    <span class="icon-user"></span>
                                    <?php echo $current_user->display_name; ?>
                                </a>
                                <div class="dropd-block">
                                    <button class="js-logout"><?php pll_e('Logout'); ?></button>
                                </div>
                            </li>
                        </ul>
                    </div><!--header-nav-->
                </div><!--col-sm-7-->
            </div><!--row-->
        </div><!--container-->
    </div><!--header-menu-container-->
