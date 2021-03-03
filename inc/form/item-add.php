<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); ?>
<?php
$postParams = $_POST;

$postTaxes = array();

if ($postParams['site'] && $postParams['site'] != '') {
    $postTaxes['sites'] = array($postParams['site']);
}
if ($postParams['period'] && $postParams['period'] != '') {
    $postTaxes['periods'] = array($postParams['period']);
}
if ($postParams['object'] && $postParams['object'] != '') {
    $postTaxes['objects'] = array($postParams['object']);
}

$meta_post = array(
    'item-num' => $postParams['number'],
    'item-num_loc' => $postParams['code'],
    'item-type' => $postParams['type'],
    'item-num_part' => $postParams['part'],
    'item-mat' => $postParams['material'],
    'item-rack' => $postParams['rack'],
    'item-row' => $postParams['row'],
    'item-shelf' => $postParams['shelf'],
    'item-dim_height' => $postParams['item-dim_height'],
    'item-dim_length' => $postParams['item-dim_length'],
    'item-dim_width' => $postParams['item-dim_width'],
    'item-dim_thick' => $postParams['item-dim_thick'],
    'item-dim_weight' => $postParams['item-dim_weight'],
    'item-dim_diameter' => $postParams['item-dim_diameter'],
    'item-dim_base_diameter' => $postParams['item-dim_base_diameter'],
    'item-dim_mouth_diameter' => $postParams['item-dim_mouth_diameter'],
    'item-dim_type' => $postParams['item-dim_type'],
    'item-date_photo_taken' => $postParams['item-date_photo_taken'],
    'item-place_photo_taken' => $postParams['item-place_photo_taken'],
    'item-photo_taken_by' => $postParams['item-photo_taken_by'],
    'item-rem' => $postParams['item-rem']
);

$galArr = array();
$lastItt = 0;
for ($i = 0; $i < 50; $i++) {
    if ($postParams['image-arr-'.$i]) {
        $galArr['item-gal_'.$i.'_img'] = $postParams['image-arr-'.$i];
        $galArr['_item-gal_'.$i.'_img'] = 'field_5fd4b88450d80';
        $lastItt++;
    }
}
$galArr['item-gal'] = $lastItt;
$galArr['_item-gal'] = 'field_5fd4b87450d7f';

if (!empty($galArr)) {
    $meta_post = array_merge($meta_post, $galArr);
}


$post = array(
    'ID'             => $postParams['id'],
	'post_author'    => $postParams['author'],
	'post_content'   => $postParams['description'],
	'post_status'    => 'publish',
	'post_title'     => $postParams['name'],
	'post_type'      => 'items',
	'tax_input'      => $postTaxes,
	'meta_input'     => $meta_post,
    'post_date'      => ($postParams['item-date']) ? $postParams['item-date'] : ''
);

$post_id = wp_insert_post( $post);

if( is_wp_error($post_id) ){
    echo $post_id->get_error_message();
}
else {
    set_post_thumbnail( $post_id, $postParams['image-id'] );
    if ($postParams['is_cont'] == 'cont') {
        header("Location: /add/");
    } else {
        header("Location: /");
    }
}
?>
