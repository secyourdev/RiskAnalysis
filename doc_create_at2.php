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

  $template = new \PhpOffice\PhpWord\TemplateProcessor('Template_rapport_at2.docx');
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
  ///atelier2*******************************************************************************
  //2.a/////////////////////////////////////////////////////////////////
  $tab_srov = genere_tableau_rapport($rq_srov_tab);


  //2.b///////////////////////////////////////////////////////////////
  $tab_srov2 = tab_dyn2b_3a_3c($rq_srov2_tab);

  //2.c///////////////////////////

  $tab_srov3 = genere_tableau_rapport($rq_srov3_tab);

  ////inclusion tableaux
  ///2.a
  $template->setComplexBlock('p_srov1', $tab_srov);

  ///2.b
  $template->setComplexBlock('p_srov2', $tab_srov2);


  //2.c
  $template->setComplexBlock('p_srov3', $tab_srov3);

  $tab_evred = tab_dyn1c_3b_4b($rq_evred_tab);
  $template->setComplexBlock('m_evenement_redoute', $tab_evred);

  /////sauvegarder fichier

  $date = date('d_m_y');
  $template -> saveAS('Rapport_at2'.$_SESSION['id_projet'].' '.$_SESSION['id_utilisateur'].$date.'.docx');
  // $filename = "Rapport.docx";
  // header('Content-Description: File Transfer');
  // header('Content-type: application/force-download');
  // header('Content-Disposition: attachment; filename='.basename($filename));
  // header('Content-Transfer-Encoding: binary');
  // header('Content-Length: '.filesize($filename));
  // readfile($filename);

}


if($_POST['action'] == 'gene_at2') {
  doc_create();
  // echo $_POST['action'];
}
  ?>
