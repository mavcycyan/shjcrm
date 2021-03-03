<?php
/**
 * Template Name: Add/Edit
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sharjahsystem
 */

get_header();

$addEditUrl = '/wp-content/themes/sharjahsystem/inc/form/item-add.php';
$id = '';
if($_GET['id'] && $_GET['id'] != '') {
    $id = $_GET['id'];
    $current_post = get_post( $id );
}


?>
    <section  id="content" >
        <div class="container">
            <form action="<?php echo $addEditUrl; ?>" method="post" class="js-addForm">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="is_cont" class="js-isCont" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Author'); ?></label>
                            <?php if($current_post->post_author): ?>
                                <?php
                                    $user = get_user_by('id', $current_post->post_author);
                                ?>
                                <input type="hidden" name="author" value="<?php echo $current_post->post_author; ?>" disabled class="form-control">
                                <div class="info-cont"><?php echo $user->data->display_name; ?></div>
                            <?php else: ?>
                                <?php
                                    $current_user = wp_get_current_user();
                                ?>
                                <input type="hidden" name="author" value="<?php echo $current_user->ID; ?>" disabled class="form-control">
                                <div class="info-cont"><?php echo $current_user->display_name; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object Name'); ?></label>
                            <input type="text" name="name" placeholder="<?php pll_e('Object Name'); ?>" value="<?php echo $current_post->post_title; ?>" required class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object Type (Kind)'); ?></label>
                            <input type="text" name="type" placeholder="<?php pll_e('Object Type (Kind)'); ?>" value="<?php the_field('item-type', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Material'); ?></label>
                            <input type="text" name="material" placeholder="<?php pll_e('Material'); ?>" value="<?php the_field('item-mat', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Site'); ?></label>
                            <?php
                            $str = pll__('Select site');
                            $terms = get_terms( [
                                'taxonomy' => 'sites',
                                'hide_empty' => false,
                            ] );
                            $term_cur = wp_get_post_terms( $id, 'sites', array('fields' => 'ids') );
                            if ($terms) {
                                echo '<select name="site" id="" class="sel2">';
                                echo (!$term_cur[0] || $term_cur[0] == '') ? '<option value="" disabled selected>'.$str.'</option>' : '<option value="" disabled>'.$str.'</option>';
                                foreach($terms as $term) {
                                    echo ($term_cur[0] == $term->term_id) ? '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>' : '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Period'); ?></label>
                            <?php
                            $str = pll__('Select period');
                            $terms = get_terms( [
                                'taxonomy' => 'periods',
                                'hide_empty' => false,
                            ] );
                            $term_cur = wp_get_post_terms( $id, 'periods', array('fields' => 'ids') );
                            if ($terms) {
                                echo '<select name="period" id="" class="sel2">';
                                echo (!$term_cur[0] || $term_cur[0] == '') ? '<option value="" disabled selected>'.$str.'</option>' : '<option value="" disabled>'.$str.'</option>';
                                foreach($terms as $term) {
                                    echo ($term_cur[0] == $term->term_id) ? '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>' : '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object'); ?></label>
                            <?php
                            $str = pll__('Select object');
                            $terms = get_terms( [
                                'taxonomy' => 'objects',
                                'hide_empty' => false,
                            ] );
                            $term_cur = wp_get_post_terms( $id, 'objects', array('fields' => 'ids') );
                            if ($terms) {
                                echo '<select name="object" id="" class="sel2">';
                                echo (!$term_cur[0] || $term_cur[0] == '') ? '<option value="" disabled selected>'.$str.'</option>' : '<option value="" disabled>'.$str.'</option>';
                                foreach($terms as $term) {
                                    echo ($term_cur[0] == $term->term_id) ? '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>' : '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Date (When the Photo was Taken)'); ?></label>
                            <input type="date" name="item-date_photo_taken" class="form-control" value="<?php the_field('item-date_photo_taken', $id) ?>">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Place (When the Photo was Taken)'); ?></span></label>
                            <input type="text" name="item-place_photo_taken" class="form-control" value="<?php the_field('item-place_photo_taken', $id) ?>">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Photo Taken By'); ?></label>
                            <input type="text" name="item-photo_taken_by" class="form-control" value="<?php the_field('item-photo_taken_by', $id) ?>">
                        </div>
                    </div><!--col-sm-6-->
                    <div class="col-sm-6">
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object Number'); ?></label>
                            <input type="text" name="number" placeholder="<?php pll_e('Object Number'); ?>" value="<?php the_field('item-num', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object Code'); ?></label>
                            <input type="text" name="code" placeholder="<?php pll_e('Object Code'); ?>" value="<?php the_field('item-num_loc', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Date'); ?></label>
                            <input type="datetime-local" name="item-date" class="form-control" value="<?php echo ($id) ? get_the_date('Y-m-d', $id).'T'.get_the_date('H:i', $id) : ''; ?>">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Part'); ?></label>
                            <input type="text" name="part" placeholder="<?php pll_e('Part'); ?>" value="<?php the_field('item-num_part', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="info-group mb-10px">
                                        <label for=""><?php pll_e('Row Number'); ?></label>
                                        <input type="text" name="row" placeholder="<?php pll_e('Row Number'); ?>" value="<?php the_field('item-row', $id) ?>" class="form-control">
                                    </div>
                                </div><!--col-sm-6-->
                                <div class="col-sm-6">
                                    <div class="info-group mb-10px">
                                        <label for=""><?php pll_e('Rack Number'); ?></label>
                                        <input type="text" name="rack" placeholder="<?php pll_e('Rack Number'); ?>" value="<?php the_field('item-rack', $id) ?>" class="form-control">
                                    </div>
                                </div><!--col-sm-6-->
                            </div><!--row-->
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Shelf'); ?></label>
                            <input type="text" name="shelf" placeholder="<?php pll_e('Shelf'); ?>" value="<?php the_field('item-shelf', $id) ?>" class="form-control">
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Dimension (All Dimension)'); ?></label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_height" class="form-control dim" placeholder="<?php pll_e('Height'); ?>" value="<?php the_field('item-dim_height', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_length" class="form-control dim" placeholder="<?php pll_e('Length'); ?>" value="<?php the_field('item-dim_length', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_width" class="form-control dim" placeholder="<?php pll_e('Width'); ?>" value="<?php the_field('item-dim_width', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_thick" class="form-control dim" placeholder="<?php pll_e('Thickness'); ?>" value="<?php the_field('item-dim_thick', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_weight" class="form-control dim" placeholder="<?php pll_e('Weight'); ?>" value="<?php the_field('item-dim_weight', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <input type="text" name="item-dim_diameter" class="form-control dim" placeholder="<?php pll_e('Diameter'); ?>" value="<?php the_field('item-dim_diameter', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <input type="text" name="item-dim_base_diameter" class="form-control dim" placeholder="<?php pll_e('Base Diameter'); ?>" value="<?php the_field('item-dim_base_diameter', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <input type="text" name="item-dim_mouth_diameter" class="form-control dim" placeholder="<?php pll_e('Mouth Diameter'); ?>" value="<?php the_field('item-dim_mouth_diameter', $id) ?>">
                                </div><!--col-sm-3-->
                                <div class="col-sm-6">
                                    <?php $dim_type = get_field('item-dim_type', $id) ?>
                                    <select name="item-dim_type" id="" class="sel2 dim">
                                        <option value="none" <?php echo ($dim_type != 'flat' && $dim_type != 'rounded' ) ? 'checked' : ''; ?>><?php pll_e('Type of Base'); ?></option>
                                        <option value="flat" <?php echo ($dim_type == 'flat' ) ? 'checked' : ''; ?>><?php pll_e('Flat'); ?></option>
                                        <option value="rounded" <?php echo ($dim_type == 'rounded' ) ? 'checked' : ''; ?>><?php pll_e('Rounded'); ?></option>
                                    </select>
                                </div><!--col-sm-3-->
                            </div><!--row-->
                        </div>
                        <div class="info-group mb-10px">
                            <label for=""><?php pll_e('Object Remarks'); ?></label>
                            <input type="text" name="item-rem" class="form-control" value="<?php the_field('item-rem', $id) ?>">
                        </div>
<!--                        <div class="info-group mb-10px">-->
<!--                            <label for="">Object Remarks</label>-->
<!--                            <div class="box">-->
<!--                                <input type="file" name="file-7[]" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple="">-->
<!--                                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> Choose a file…</strong></label>-->
<!--                            </div>-->
<!--                        </div>-->
						<div class="info-group mb-10px">
							<label for=""><?php pll_e('Image file'); ?></label>
							<span class="image js-imgWrap" style="display: block;width: 100%;display: flex;width: 100%;height: calc(1.5em + .75rem + 2px);padding: .375rem .75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
								<span class="path js-imagePath" style="flex: 1; margin-right: 15px; white-space: nowrap; text-overflow: ellipsis; width: calc(100% - 119px); overflow: hidden;"><?php //echo get_the_post_thumbnail_url( $id, 'full' ) ?></span>
								<label for="img" style=" font-family: 'Tajawal',sans-serif; font-weight: 700; font-size: 15px; border-radius: 5px; line-height: 1.4; text-decoration: none; border: 0; display: inline-block; color: #fff; padding: 1px 30px 3px; background: #b58556; white-space: normal; height: 22px; cursor: pointer; "><?php pll_e('Upload'); ?></label>
								<input type="file" id="img" name="image" style="display: none;" class="js-imageUpload" placeholder="Image file" value="" accept=".jpg, .jpeg, .png">
								<input type="hidden" name="image-id" class="js-imageID" placeholder="Image file" value="<?php echo get_post_thumbnail_id( $id ); ?>" >
                                <?php if ($image_arr = get_field('item-gal', $id)) : ?>
                                    <?php $image_itt = 0; ?>
                                    <?php foreach ($image_arr as $img) : ?>
                                        <input type="hidden" name="image-arr-<?php echo $image_itt; ?>" class="js-imageArr" value="<?php echo $img["img"]['id']; ?>" >
                                        <?php $image_itt++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
							</span>
							<span class="js-imagePic imgPic">
								<?php echo get_the_post_thumbnail( $id, 'full', array('class' => 'img-fluid') ) ?>
                                <?php if ($image_arr = get_field('item-gal', $id)) : ?>
                                    <?php foreach ($image_arr as $img) : ?>
                                        <img src="<?php echo $img["img"]['url']; ?>" alt="">
                                    <?php endforeach; ?>
                                <?php endif; ?>
							</span>
						</div>
                    </div><!--col-sm-6-->
                </div><!--row-->
                <div class="info-group mb-30px">
                    <label for=""><?php pll_e('Description'); ?></label>
                    <div class="info-cont" style="background: #fff;">
                        <div class="descr-text">
                            <textarea name="description" id="description" placeholder="<?php pll_e('Description'); ?>" style=" width: 100%; border: 0; background: none; "><?php echo strip_tags(apply_filters('the_content', $current_post->post_content )); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="bottom-cw text-center d-block">
                    <button type="submit" class="btn btn-primary" data-iscont="cont"><?php pll_e('Save and continue'); ?></button>
                    <button type="submit" class="btn btn-primary" data-iscont="exit"><?php pll_e('Save and exit'); ?></button>
                </div>
                <?php /* ?><div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Description"><?php echo strip_tags(apply_filters('the_content', $current_post->post_content )); ?></textarea>
                </div>
                <div>
                    <label for="">Author</label>
                    <select name="author" id="">
                        <option value="" disabled <?php echo (!$current_post->post_author || $current_post->post_author == '') ? 'selected' : '' ?>>Author</option>
                        <?php $authors = getAllAuthors(); ?>
                        <?php foreach($authors as $author): ?>
                            <option value="<?php echo $author->ID ?>" <?php echo ($current_post->post_author == $author->ID) ? 'selected' : '' ?>><?php echo $author->display_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="">Object number</label>
                    <input type="text" name="number" placeholder="Object number" value="<?php the_field('item-num', $id) ?>">
                </div>
                <div>
                    <label for="">Object name</label>
                    <input type="text" name="name" placeholder="Object name" value="<?php echo $current_post->post_title; ?>" required>
                </div>
                <div>
                    <label for="">Object code</label>
                    <input type="text" name="code" placeholder="Object code" value="<?php the_field('item-num_loc', $id) ?>">
                </div>
                <div>
                    <label for="">Object type</label>
                    <input type="text" name="type" placeholder="Object type" value="<?php the_field('item-type', $id) ?>">
                </div>
                <div>
                    <label for="">Part</label>
                    <input type="text" name="part" placeholder="Part" value="<?php the_field('item-num_part', $id) ?>">
                </div>
                <div>
                    <label for="">Material</label>
                    <input type="text" name="material" placeholder="Material" value="<?php the_field('item-mat', $id) ?>">
                </div>
                <div>
                    <label for="">Rack number</label>
                    <input type="text" name="rack" placeholder="Rack number" value="<?php the_field('item-rack', $id) ?>">
                </div>
                <div>
                    <label for="">Row number</label>
                    <input type="text" name="row" placeholder="Row number" value="<?php the_field('item-row', $id) ?>">
                </div>
                <div>
                    <label for="">Site</label>
                    <?php
                    $terms = get_terms( [
                        'taxonomy' => 'sites',
                        'hide_empty' => false,
                    ] );
                    $term_cur = wp_get_post_terms( $id, 'sites', array('fields' => 'ids') );
                    if ($terms) {
                        echo '<select name="site" id="" class="sel2">';
                        echo (!$term_cur[0] || $term_cur[0] != '') ? '<option value="" disabled>Site</option>' : '<option value="" disabled selected>Site</option>';
                        foreach($terms as $term) {
                            echo ($term_cur[0] == $term->term_id) ? '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>' : '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <div>
                    <label for="">Shelf</label>
                    <input type="text" name="shelf" placeholder="Shelf" value="<?php the_field('item-shelf', $id) ?>">
                </div>
                <div>
                    <label for="">Period</label>
                    <?php
                    $terms = get_terms( [
                        'taxonomy' => 'periods',
                        'hide_empty' => false,
                    ] );
                    $term_cur = wp_get_post_terms( $id, 'periods', array('fields' => 'ids') );
                    if ($terms) {
                        echo '<select name="period" id="" class="sel2">';
                        echo (!$term_cur[0] || $term_cur[0] != '') ? '<option value="" disabled>Site</option>' : '<option value="" disabled selected>Period</option>';
                        foreach($terms as $term) {
                            echo ($term_cur[0] == $term->term_id) ? '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>' : '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <div>
                    <label for="">Dimension</label>
                    <input type="text" name="dimension" placeholder="Dimension" value="<?php the_field('item-dim', $id) ?>">
                </div>
                <div>
                    <label for="">Publiched date</label>
                    <input type="date" name="pub-date" placeholder="Publiched date" value="<?php echo $current_post->post_date; ?>">
                </div>
                <div>
                    <label for="">Image file</label>
                    <span class="image" style="display: block;width: 100%;">
                        <span class="path js-imagePath"><?php echo get_the_post_thumbnail_url( $id, 'full' ) ?></span>
                        <label for="img">Upload</label>
                        <input type="file" id="img" name="image" style="display: none;" class="js-imageUpload" placeholder="Image file" value="" accept=".jpg, .jpeg, .png">
                        <input type="hidden" name="image-id" class="js-imageID" placeholder="Image file" value="<?php echo get_post_thumbnail_id( $id ); ?>" >
                    </span>
                    <span class="js-imagePic">
                        <?php echo get_the_post_thumbnail( $id, 'full', array('class' => 'img-fluid') ) ?>
                    </span>
                </div>
                <div>
                    <button type="submit" data-iscont="cont">Save and Continue</button>
                </div>
                <div>
                    <button type="submit" data-iscont="exit">Save and Exit</button>
                </div> <?php */ ?>
            </form>
        </div><!--container-->
    </section><!--content-->
    <style>
        /*#content input, #content textarea, #content .sel2 {*/
            /*width: 100%;*/
            /*margin-bottom: 30px;*/
        /*}*/
        .imgPic img {
            border: 1px solid #b58556;
            padding: 15px;
            width: 110px;
            margin-top: 15px;
        }
    </style>
    <script>
        $('.js-addForm [type="submit"]').click(function(e){
            e.preventDefault();
            $('.js-isCont').val($(this).attr('data-iscont'));
            var _this = $('.js-addForm [type="submit"]')
            var form = _this.closest('.js-addForm');
            $.ajax({
                method: 'POST',
                url: '/wp-content/themes/sharjahsystem/inc/form/check-code.php',
                data: {
                    code : form.find('[name="code"]').val()
                }
            }).done(function(response){
                console.log(response)
                if (response == 'exists') {
                    alert('The item with this object code is already exists!');
                } else {
                    form.submit();
                }
            }).fail(function(error){
                alert(translates.error);
                console.log(error);
            });
        })
    </script>

<?php
get_footer();
