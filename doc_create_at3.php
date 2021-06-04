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

  $template = new \PhpOffice\PhpWord\TemplateProcessor('Template_rapport_at3.docx');
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
  ///atelier 3************************************************************
  //3.a/////////////////////////////////////
  $tab_partie = tab_dyn2b_3a_3c($rq_partie_tab);

  //3.b //////////////////////////////////////

  $tab_cidt = tab_dyn1c_3b_4b($rq_cidt_tab);
  $tab_srov4 = genere_tableau_rapport($rq_srov4_tab);
  $tab_scenar_strat1 = genere_tableau_rapport($rq_scenar_strat3b_tab);
  $tab_chemin_attaque = genere_tableau_rapport($rq_chemin_attaque_tab);
  $tab_eval_vrai = tab_dyn1c_3b_4b($rq_eval_vrai_tab);
  $tab_plan_amelio = genere_tableau_rapport($rq_plan_amelio_tab);
  $tab_eval_risk_resi = genere_tableau_rapport($qr_eval_risk_resi_tab);

  //3.c////////////////////////////////////////////////
  $tab_partie2 = tab_dyn2b_3a_3c($rq_partie2_tab);
  $tab_scenar_strat = genere_tableau_rapport($rq_scenar_strat_tab);

  ////inclusion tableaux
  ///3a
  $template->setComplexBlock('r_partie_prenante1', $tab_partie);



  $template->setComplexBlock('p_srov4', $tab_srov4);
  $template -> setComplexBlock('s_scenario_strategique1', $tab_scenar_strat1);

  //3.b
  $template->setComplexBlock('m_evenement_redoute2', $tab_cidt);
  $template->setComplexBlock('eval_vrai', $tab_eval_vrai);
  $template->setComplexBlock('za_traitement_de_securite', $tab_plan_amelio);
  $template->setComplexBlock('last_table', $tab_eval_risk_resi);
  $template->setComplexBlock('t_chemin_d_attaque_strategique', $tab_chemin_attaque);

  ///3.c
  $template->setComplexBlock('r_partie_prenante2', $tab_partie2);
  //TO DO Mesure de sécurité
  // TO DO Evaluation

  /////sauvegarder fichier

  $template -> saveAS('Rapport_at3.docx');
  // $filename = "Rapport.docx";
  // header('Content-Description: File Transfer');
  // header('Content-type: application/force-download');
  // header('Content-Disposition: attachment; filename='.basename($filename));
  // header('Content-Transfer-Encoding: binary');
  // header('Content-Length: '.filesize($filename));
  // readfile($filename);

}


if($_POST['action'] == 'gene_at3') {
  doc_create();
  //echo $_POST['test0'];
}
  ?>
