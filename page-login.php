<?php
/**
 * Template Name: Login
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

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';

if (is_user_logged_in()) {
    header('Location: /');
    exit;
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=1200px">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <?php if($curLang == 'ar'): ?>
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <?php endif; ?>
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/jquery.rateyo.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/select2.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/iconmoon.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/swiper.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/jquery-simple-mobilemenu.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/style.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/css/responsive.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery.fancybox.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/jquery-simple-mobilemenu.min.js"></script>
    <script src="https://kit.fontawesome.com/e1d2ed61f1.js" crossorigin="anonymous"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/select2.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/scripts.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-page">
<?php wp_body_open(); ?>
    <section  id="content" >
        <div class="login-abs">
            <div class="container">
                <div class="row">
                    <div class="offset-sm-2 col-sm-8">
                        <div class="text-center">
                            <a href="/" class="logo"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/logo.png" alt="" class="img-fluid"/></a>
                        </div>
                        <div class="la-page">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="<?php bloginfo( 'template_url' ); ?>/assets/images/tmp/login.jpg" alt="" class="img-fluid" />
                                </div><!--col-sm-6-->
                                <div class="col-sm-6">
                                    <div class="la-title"><?php echo ($curLang == 'en') ? 'Log In' : 'تسجيل الدخول'; ?></div>
                                    <div style="text-align: center;color: red; display:<?php echo ($_GET['auth'] == 'failed') ? 'block' : 'none' ?>;">
                                        <?php echo ($curLang == 'en') ? 'Authentication failed' : 'المصادقة فشلت'; ?>
                                    </div>
                                    <form action="<?php bloginfo( 'template_url' ); ?>/login/login.php" class="login-forms" method="POST">
                                        <div class="form-group">
                                            <span class="icon-user"></span>
                                            <input type="text" class="form-control" placeholder="<?php echo ($curLang == 'en') ? 'Email' : 'البريد الإلكتروني'; ?>" name="login">
                                        </div><!--form-group-->
                                        <div class="form-group mb-30px">
                                            <span class="icon-lock"></span>
                                            <input type="password" class="form-control" placeholder="<?php echo ($curLang == 'en') ? 'Password' : 'كلمه السر'; ?>" name="password">
                                        </div><!--form-group-->
                                        <div class="row mb-50px">
                                            <div class="col-sm-6">
                                                <label class="check checked"><span class="checkbox"><input type="checkbox" name="remember"></span> <?php echo ($curLang == 'en') ? 'Remember Me' : 'تذكرنى'; ?></label>
                                            </div><!---col-sm-6-->
                                            <div class="col-sm-6">
                                                <a href="#" class="link-form"><?php echo ($curLang == 'en') ? 'Forgot Password?' : 'هل نسيت كلمة المرور؟'; ?></a>
                                            </div><!--col-sm-6-->
                                        </div><!--row-->
                                        <div class="button-form">
                                            <button class="btn btn-primary mb-40px"><?php echo ($curLang == 'en') ? 'Log In' : 'تسجيل الدخول'; ?></button>
                                        </div>
                                        <?php /* ?><a href="#" class="create-user"><?php echo ($curLang == 'en') ? 'Create User' : 'إنشاء مستخدم'; ?><?php */ ?>
                                        </a>
                                    </form>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div><!--la-page-->
                    </div><!--col-sm-8-->
                </div><!--row-->
            </div><!--container-->
        </div><!--login-abs-->
    </section><!--content-->
<?php wp_footer(); ?>

</body>
