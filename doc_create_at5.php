<?php
session_start();
$id_projet = $_SESSION['id_projet'];

require_once 'content/bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;
include("content/php/bdd/connexion_sqli.php");

function doc_create(){
  global $id_projet;

  // //include
   include("tab_create.php");
   include("content/php/export/selection_export.php");
  ////////////////////////////////////////////////////////////////////////////////

  $template = new \PhpOffice\PhpWord\TemplateProcessor('Template_rapport_at5.docx');
/*****************    Atelier 1.1.1*********************************************************************/
  $rq_titre = mysqli_query($connect,"SELECT nom_projet FROM F_projet WHERE id_projet = $id_projet");
  $rq_version_for_1a = mysqli_query($connect,"SELECT num_version FROM ZC_version WHERE id_projet= $id_projet");

  $nom_projet = mysqli_fetch_all($rq_titre, MYSQLI_NUM)[0][0];
  $projet = mysqli_fetch_assoc($rq_donnees_principales_res);
  $respo = mysqli_fetch_row($rq_respo_res);
  $version = mysqli_fetch_row($rq_version_for_1a);
  //echo '<pre>'; print_r($projet);echo '</pre>';

  $template -> setValue('Titre', $nom_projet);
  $template -> setValue('nomProjet', $projet['nom_projet']);
  $template -> setValue('Objectif', $projet['objectif_projet']);
  $template -> setValue('jj/mm/aaaa1', date("d-m-Y",strtotime($projet['cadre_temporel'])));
  $template -> setValue('jj/mm/aaaa2', date("d-m-Y",strtotime($projet['cadre_temporel_etape_2'])));
  $template -> setValue('jj/mm/aaaa3', date("d-m-Y",strtotime($projet['cadre_temporel_etape_3'])));
  $template -> setValue('jj/mm/aaaa4', date("d-m-Y",strtotime($projet['cadre_temporel_etape_4'])));
  $template -> setValue('jj/mm/aaaa5', date("d-m-Y",strtotime($projet['cadre_temporel_etape_5'])));
  $template -> setValue('dure1',$projet['duree_strategique']);// stratégique
  $template -> setValue('dure2',$projet['duree_operationnel']);// opérationnel
  $template -> setValue('niveauConfidentialite',$projet['confidentialite']);
  $template -> setValue('version', $version[0]);
  $template -> setValue('responsable', $respo[0]);

  /*********************Seuils*******************************************************************/

$rq_seuils = mysqli_query($connect, "SELECT seuil_danger,seuil_controle, seuil_veille FROM Q_seuil WHERE id_projet = $id_projet ");
$row_seuil = mysqli_fetch_assoc($rq_seuils);//, MYSQLI_ASSOC);
$template -> setValue('danger', $row_seuil['seuil_danger'][0]);
$template -> setValue('contrôle', $row_seuil['seuil_controle'][0]);
$template -> setValue('veille', $row_seuil['seuil_veille'][0]);



/****************************************Tableaux**********************************************/
  ///atelier 5*************************************************************
  $tab_carto5a = tab_carto1($rq_carto_tab);
  //5.b/////////////////////////////////////////////////
  $tab_plan_amelio = genere_tableau_rapport($rq_plan_amelio_tab);
  $tab_carto5b = tab_carto_couleurs($rq_carto_tab2,$rq_couleurs_tab);

  //5.c/////////////////////////////////////////////////
  $tab_eval_risk_resi = genere_tableau_rapport($qr_eval_risk_resi_tab);


  ////inclusion tableaux
///5.a
  $template -> setComplexBlock('cartographie5', $tab_carto5a);
  //5.b
  $template -> setComplexBlock('cartographie6', $tab_carto5b);



  /////sauvegarder fichier

  $template -> saveAS('Rapport_at5.docx');
  // $filename = "Rapport.docx";
  // header('Content-Description: File Transfer');
  // header('Content-type: application/force-download');
  // header('Content-Disposition: attachment; filename='.basename($filename));
  // header('Content-Transfer-Encoding: binary');
  // header('Content-Length: '.filesize($filename));
  // readfile($filename);

}


if($_POST['action'] == 'gene_at5') {
  doc_create();
  //echo $_POST['test0'];
}
  ?>
