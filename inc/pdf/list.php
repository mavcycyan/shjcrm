<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

require_once '../html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


$html2pdf = new HTML2PDF('P', 'A4', 'en');

function getPdfData($dataPost) {
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

    $id = '';
    $params = '';
    $cat_id = '';
    $from_search = false;

    if($dataPost['type'] && $dataPost['type'] != '') {
        $cat_type = $dataPost['type'];
    }

    if($dataPost['id'] && $dataPost['id'] != '') {
        $id = explode(',', $dataPost['id']);
        $from_search = true;
        $params = explode(',', $dataPost['params']);
    }
    else if($dataPost['cat_id'] || $dataPost['cat_id'] != '') {
        $cat_id = $dataPost['cat_id'];
    }

    $args = array(
        'post_type' => 'items',
        'posts_per_page' => -1
    );

    if($id != '') {
        $args['post__in'] = $id;
    }
    if($cat_id != '') {
        $args[$cat_type] = $cat_id;
    }
    $fields = '';
    global $wp_query;
    $wp_query = new WP_Query($args);

    if ( have_posts() ) :
        $itt = 0;
        $isClosed = true;
        while ( have_posts() ) :
            the_post();
            $title = get_the_title();
            $img = get_the_post_thumbnail_url( $post->ID, 'pdf-list');

            if($itt % 2 == 0) {
                $isClosed = false;
                $fields .= '<tr>';
            }
            $fields .= "<td style='width: 50%;'><div style='
                border: 1px solid #9d8c7d;
                    border-radius: 5px;
                    padding: 10px;
                    font-weight: 700;
                    font-size: 15px;
                    margin: 0 5px 10px;
                '
                >";

            $fields .= "<table><tr>
                <td style='width: 50%;'><img src='$img' height='180px' style='width: 100px;'></td>
                <td style='width: 50%;'><b style='text-align: center; font-size: 18px'>$title</b><br><br>
            ";


            if(in_array('row_num', $params) == '' && $from_search):
            else :
                $str = pll__('Row Number');
                $fields .= (get_field('item-row')) ? '<b>'.$str.':</b> '.get_field('item-row').'<br>' : '';
            endif;

            if(in_array('obj_type', $params) == '' && $from_search):
            else :
                $str = pll__('Object Type');
                $fields .= (get_field('item-type')) ? '<b>'.$str.':</b> '.get_field('item-type').'<br>' : '';
            endif;

            if(in_array('rack_num', $params) == '' && $from_search):
            else :
                $str = pll__('Rack Number');
                $fields .= (get_field('item-rack')) ? '<b>'.$str.':</b> '.get_field('item-rack').'<br>' : '';
            endif;

            if(in_array('shelf', $params) == '' && $from_search):
            else :
                $str = pll__('Shelf');
                $fields .= (get_field('item-shelf')) ? '<b>'.$str.':</b> '.get_field('item-shelf').'<br>' : '';
            endif;

            if(in_array('dim', $params) == '' && $from_search):
            else :
                $str = pll__('Dimensions');
                $fields .= (get_field('item-dim')) ? '<b>'.$str.':</b> '.get_field('item-dim').'<br>' : '';
            endif;
            $fields .= '</td></tr></table>';
            $fields .= '</div></td>';

            $itt++;
            if($itt % 2 == 0) {
                $isClosed = true;
                $fields .= '</tr>';
            }
        endwhile;
            if(!$isClosed) {
                $fields .= '</tr>';
            }
    endif;

    $data = "
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        p {margin: 0;}
    </style>
    <page backtop='0' backbottom='0' backleft='0' backright='0'>  
        <table style='width:100%;'>
           $fields
        </table>
    </page>
        ";
    return $data;
}

$data = trim(getPdfData($_POST));
$data = str_replace(['\n'], '', $data);


//echo $data;
$html2pdf->writeHTML($data);
$html2pdf->output();

?>