<?php
/**
 * Template Name: Category Add/Edit
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();

$addEditUrl = '/wp-content/themes/sharjahsystem/inc/form/categ-add.php';
$id = '';
$type = 'sites';
if($_GET['taxonomy'] && $_GET['taxonomy'] != '') {
    $type = $_GET['taxonomy'];
}
if($_GET['id'] && $_GET['id'] != '') {
    $id = $_GET['id'];
    $current_term = get_term( $id, $type );
}

$img = (get_field('cat-img', $type.'_'.$id)) ? get_field('cat-img', $type.'_'.$id) : null;

?>
    <section  id="content" >
        <div class="container">
            <h1><?php
                switch($type) {
                    case 'sites':
                        pll_e('Add site');
                        break;
                    case 'objects':
                        pll_e('Add object');
                        break;
                    case 'periods':
                        pll_e('Add period');
                        break;
                }

            ?></h1>
            <form action="<?php echo $addEditUrl; ?>" method="post" class="js-addForm single-block cat-block">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="type" value="<?php echo $type; ?>">
                <input type="hidden" name="is_cont" class="js-isCont" value="">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Image file'); ?></label>
                            <span class="js-imageCatPic imgPic">
								<?php if($img['url'] && $img['url'] != ''): ?><img src="<?php echo $img['url']; ?>" alt="" class="img-fluid"><?php endif; ?>
							</span>
                            <span class="d-block mt-2 text-center js-imgWrap">
								<label for="img" class="btn btn-primary"><?php pll_e('Upload'); ?></label>
								<input type="file" id="img" name="image" style="display: none;" class="js-imageCatUpload" placeholder="Image file" value="" accept=".jpg, .jpeg, .png">
								<input type="hidden" name="image-id" class="js-imageCatID" placeholder="Image file" value="<?php echo $img['ID']; ?>" >
							</span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="info-group mb-10px">
                                    <label for=""><?php pll_e('Title'); ?></label>
                                    <input type="text" name="name" placeholder="<?php pll_e('Title'); ?>" value="<?php echo $current_term->name; ?>" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Description'); ?></label>
                            <textarea name="description" id="description" placeholder="<?php pll_e('Description'); ?>" class="form-control"><?php the_field('cat-intro', $type.'_'.$id); ?></textarea>
                        </div>
                        <div class="sb-bottom">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <div class="">
                                        <button type="submit" data-iscont="cont" class="btn btn-default"><?php pll_e('Save and continue'); ?></button>
                                    </div>
                                </div><!--col-sm-6-->
                                <div class="col-sm-6">
                                    <div class="sb-buttons">
                                        <button type="submit" data-iscont="exit" class="btn btn-default"><?php pll_e('Save and exit'); ?></button>
                                    </div>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <style>
        #content input, #content textarea, #content select {
            width: 100%;
            margin-bottom: 30px;
        }
    </style>
    <script>
        $('.js-addForm [type="submit"]').click(function(e){
            e.preventDefault();
            $('.js-isCont').val($(this).attr('data-iscont'))
            console.log($('.js-isCont').val())
            $(this).closest('.js-addForm').submit();
        })
    </script>

<?php
get_footer();
