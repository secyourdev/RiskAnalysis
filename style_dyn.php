<?php
require_once 'bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

$template = new \PhpOffice\PhpWord\TemplateProcessor('template_-_Copie.docx');

$connect = mysqli_connect('localhost','root','','bdd');

if(!mysqli_connect_errno() == 0)
{
   echo 'err != 0 '.'<br/>';
}
else
   echo 'err = 0'.'<br/>';


$rq = mysqli_query($connect,"select * from h_raci where id_projet = '14'");

if(!$rq){
    echo "requete echec".'<br/>';
}
else{
    echo "requete ok".'<br/>';
}
$array = mysqli_fetch_all($rq,MYSQLI_NUM);

$nb_row = mysqli_num_rows($rq);
$nb_col = mysqli_num_fields($rq);



echo '<pre>'; print_r($array);echo '</pre>';

$style_table = array(
    'borderColor' => 'black',
    'borderSize' => 6,
    'cellMargin'  => 10,
    //'valign' => 'both',
    'layout' => 'autofit',
    'align'  => 'center'
);

$first_cells_style = array(
    'bgColor' => 'A9A9A9',
    'align'  => 'center'
);

$blue_cell_style = array(
    'bgColor' => '008B8B',
    'align'  => 'center'
);

$cell_style_basic = array(
  'bgColor' => 'white',
  'align'  => 'center'
);

$first_row_style = array(
  'tblHeader' => true
);

// TO DO : Style du texte

//formation du tableau
$table = new Table($style_table);

for($i = -1; $i < $nb_row; $i ++){
  if($i == -1 ){
    $table->addRow(1,$first_row_style);
  }
  else{
    $table->addRow();
  }
    for($j = 0; $j<$nb_col;$j++){
        if($i ==-1){
            $finfo= mysqli_fetch_field_direct($rq,$j);
            $table->addCell(1, $first_cells_style)->addText($finfo->name,array('bold'=> true));

        }


        else{
          if($j == $nb_col-1){
            switch($array[$i][2]){
              case '1.a':
                $table->addCell(1, array('bgColor' => 'green'))->addText($array[$i][$j]);
                break;
              case '1.b':
                $table->addCell(1, array('bgColor' => 'yellow'))->addText($array[$i][$j]);
                break;
              case '1.c':
                $table->addCell(1, array('bgColor' => 'red'))->addText($array[$i][$j]);
                break;
              default:
               $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
            }
            //  $table->addCell(1, $blue_cell_style)->addText($array[$i][$j]);
          }
          else{
                $table->addCell(1, $cell_style_basic)->addText($array[$i][$j]);
          }
        }

    }
}


$template->setComplexBlock('big_tab', $table);
$template->setComplexBlock('tab2', $table);

$template -> saveAs('doc.docx');


?>
