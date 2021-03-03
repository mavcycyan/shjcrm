<?php
function getXlsData($dataPost) {
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

        while ( have_posts() ) :
            the_post();
            $title = get_the_title();
            $img = get_the_post_thumbnail_url( $post->ID, 'xls-list');
            $fields .= "
                        <table style='border-bottom: 2px solid #000;border-top: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000;'  width='400'>
                <tr>
                    <td colspan='2' height='190'><img src='$img' height='180px'></td>
                </tr>
                <tr>
                    <td colspan='2'><b><center style='font-size: 20px'>$title</center></b></td>
                </tr>
            ";


            if(in_array('row_num', $params) == '' && $from_search):
            else :
                $str = pll__('Row Number');
                $fields .= (get_field('item-row')) ? '<tr><td><b>'.$str.':</b></td> <td>'.get_field('item-row').'</td></tr>' : '';
            endif;

            if(in_array('obj_type', $params) == '' && $from_search):
            else :
                $str = pll__('Object Type');
                $fields .= (get_field('item-type')) ? '<tr><td><b>'.$str.':</b></td> <td>'.get_field('item-type').'</td></tr>' : '';
            endif;

            if(in_array('rack_num', $params) == '' && $from_search):
            else :
                $str = pll__('Rack Number');
                $fields .= (get_field('item-rack')) ? '<tr><td><b>'.$str.':</b></td> <td>'.get_field('item-rack').'</td></tr>' : '';
            endif;

            if(in_array('shelf', $params) == '' && $from_search):
            else :
                $str = pll__('Shelf');
                $fields .= (get_field('item-shelf')) ? '<tr><td><b>'.$str.':</b></td> <td>'.get_field('item-shelf').'</td></tr>' : '';
            endif;

            if(in_array('dim', $params) == '' && $from_search):
            else :
                $str = pll__('Dimensions');
                $fields .= (get_field('item-dim')) ? '<tr><td><b>'.$str.':</b></td> <td>'.get_field('item-dim').'</td></tr>' : '';
            endif;

            $fields .= "
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            <table width='400'>
                <tr>
                    <td>
                        <table></table>
                    </td>
                    <td>
                        <table></table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table></table>
                    </td>
                    <td>
                        <table></table>
                    </td>
                </tr>
            </table>
                ";
        endwhile;
    endif;

    $data = "<html xmlns:x='urn:schemas-microsoft-com:office:excel'>
        <head>
            <!--[if gte mso 9]>
            <xml>
                <x:ExcelWorkbook>
                    <x:ExcelWorksheets>
                        <x:ExcelWorksheet>
                            <x:Name>Sheet 1</x:Name>
                            <x:WorksheetOptions>
                                <x:Print>
                                    <x:ValidPrinterInfo/>
                                </x:Print>
                            </x:WorksheetOptions>
                        </x:ExcelWorksheet>
                    </x:ExcelWorksheets>
                </x:ExcelWorkbook>
            </xml>
            <![endif]-->
        </head>
        
        <body>
           $fields
        </body>
        </html>";
    return $data;
}

$data = trim(getXlsData($_POST));
$data = str_replace(['\n'], '', $data);

$data = chr(255) . chr(254) . mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');

header('Content-Encoding: UTF-16LE');
header('Content-type: text/csv; charset=UTF-16LE');
$filename = 'group.xls';
header('Content-Disposition: attachment; filename='.$filename);

echo $data;

?>