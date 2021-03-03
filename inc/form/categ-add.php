<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); ?>
<?php

$catParams = $_POST;

if ($catParams['id']) {
    $update_data = wp_update_term( $catParams['id'], $catParams['type'], array(
        'name' => $catParams['name'],
    ));
    $results = print_r($catParams, true);

    if( ! is_wp_error($update_data) ) {
        $term_id = $update_data['term_id'];
        $term_tax = $catParams['type'];
        update_term_meta( $term_id, 'cat-intro', $catParams['description'] );
        update_term_meta( $term_id, '_cat-intro', 'field_5fa9986b4bf13' );
        update_term_meta( $term_id, 'cat-img', $catParams['image-id'] );
        update_term_meta( $term_id, '_cat-img', 'field_5fa998954bf16' );
        if ($catParams['is_cont'] == 'cont') {
            header("Location: /categ-edit/?taxonomy=$term_tax&id=$term_id");
        } else {
            header("Location: /");
        }
    }
} else {
    $insert_data = wp_insert_term( $catParams['name'], $catParams['type'], array(
            'name' => $catParams['name'],
        )
    );

    if( ! is_wp_error($insert_data) ) {
        $term_id = $insert_data['term_id'];
        $term_tax = $catParams['type'];
        update_term_meta( $term_id, 'cat-intro', $catParams['description'] );
        update_term_meta( $term_id, '_cat-intro', 'field_5fa9986b4bf13' );
        update_term_meta( $term_id, 'cat-img', $catParams['image-id'] );
        update_term_meta( $term_id, '_cat-img', 'field_5fa998954bf16' );
        if ($catParams['is_cont'] == 'cont') {
            header("Location: /categ-edit/?taxonomy=$term_tax&id=$term_id");
        } else {
            header("Location: /");
        }
    }
}

?>