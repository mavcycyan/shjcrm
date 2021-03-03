<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
require_once '../html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$dataPost = $_POST;
$fieldLeft = '';
$fieldRight = '';


$html2pdf = new HTML2PDF('P', 'A4', 'en');


$dictionary = array(
    'item-type' => pll__('Object Type (Kind)'),
    'item-mat' => pll__('Material'),
    'item-site' => pll__('Site'),
    'item-period' => pll__('Period'),
    'item-num' => pll__('Object Number'),
    'item-num_loc' => pll__('Object Code'),
    'item-part' => pll__('Part'),
    'item-rack' => pll__('Rack Number'),
    'item-row' => pll__('Row Number'),
    'item-shelf' => pll__('Shelf'),
    'item-dim' => pll__('Dimension (All Dimension)')
);

foreach($dataPost as $key => $value) {
    if($value != ''){
        if ($key != 'name' && $key != 'img' && $key != 'img_height' && $key != 'descr' && $key != 'lang') {
            $fieldRight .= "<b>".$dictionary[$key]."</b><br><br>";
            $fieldRight .= "<div style='border: 1px solid #9d8c7d; border-radius: 5px; padding: 10px; font-size: 15px; margin-bottom: 20px; '>$value</div>";
        }
    }
}

$title = $dataPost['name'];
$description = $dataPost['descr'];
$description_ttl = pll__('Description');
$img = $dataPost['img'];
$img_height = $dataPost['img_height']*1+10;
$data = "
<style>
    * { font-family: DejaVu Sans, sans-serif; }
    p {margin: 0;}
</style>
<page backtop='0' backbottom='0' backleft='0' backright='0'>   
       <div style='
            margin-bottom: 20px;
            border: 1px solid #606060;
            text-align: center;
        '
       >
           <img src='$img' alt=''>
       </div>
       <div style='
            font-weight: 700;
            font-size: 30px;
            text-align: center;
            color: #353b3e;
            margin-bottom: 40px;
        '
       ><b>$title</b> </div>
       <b>$description_ttl</b><br><br>
       <div style='
            border: 1px solid #9d8c7d;
            border-radius: 5px;
            padding: 10px;
            font-size: 15px;
            margin-bottom: 20px;
        '
       >$description</div>
       $fieldRight
       

</page>
";

//echo $data;
$html2pdf->writeHTML($data);
$html2pdf->output();

?>