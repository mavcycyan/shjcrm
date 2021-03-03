<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

$dataPost = $_POST;
$fieldLeft = '';
$fieldRight = '';

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

$trig = 'left';

foreach($dataPost as $key => $value) {
    if($value != ''){
        if ($key != 'name' && $key != 'img' && $key != 'img_height' && $key != 'descr') {
            if ($key == 'item-part' || $key == 'item-rack' || $key == 'item-row' || $key == 'item-shelf' || $key == 'item-dim') {
                $trig = 'right';
            }
            if($trig == 'left') {
                $fieldLeft .= "<tr><td colspan='2'><b>".$dictionary[$key]."</b></td></tr>";
                $fieldLeft .= "<tr><td colspan='2' style='text-align: left;'>$value</td></tr>";
                $fieldLeft .= "<tr><td colspan='2'></td></tr>";
            }
            if ($trig == 'right') {
                $fieldRight .= "<tr><td colspan='2'><b>".$dictionary[$key]."</b></td></tr>";
                $fieldRight .= "<tr><td colspan='2' style='text-align: left;'>$value</td></tr>";
                $fieldRight .= "<tr><td colspan='2'></td></tr>";
            }
        }
    }
}

$title = $dataPost['name'];
$description = $dataPost['descr'];
$img = $dataPost['img'];
$img_height = $dataPost['img_height']*1+10;
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
   <table style='border-bottom: 2px solid #000;border-top: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000;'  width='400'>
       <tr>
           <td colspan='4' height='$img_height'><img src='$img' alt=''></td>
       </tr>
       <tr>
           <td colspan='4'><b><center style='font-size: 20px'>$title</center></b></td>
       </tr>
       <tr>
           <td colspan='4'><center>$description</center></td>
       </tr>
       <tr>
           <td colspan='4'></td>
       </tr>
       <tr>
           <td colspan='2'>
                <table>$fieldLeft</table>
            </td>
            <td colspan='2'>
                <table>$fieldRight</table>
            </td>
        </tr>
   </table>
</body>
</html>";

$data = chr(255) . chr(254) . mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');

header('Content-Encoding: UTF-16LE');
header('Content-type: text/csv; charset=UTF-16LE');
$filename = $title . '.xls';
header('Content-Disposition: attachment; filename='.$filename);

echo $data;

?>