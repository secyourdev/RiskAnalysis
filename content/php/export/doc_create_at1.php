<?php
session_start();
$id_projet = $_SESSION['id_projet'];

require_once '../../bootstrap.php';
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;
include("../php/bdd/connexion_sqli.php");

function doc_create(){
  global $id_projet;

  // //include
   include("tab_create.php");
   include("selection_export.php");
  ////////////////////////////////////////////////////////////////////////////////

  $template = new \PhpOffice\PhpWord\TemplateProcessor('..\..\templates\Template_rapport_at1.docx');
/*****************    Atelier 1.1.1*********************************************************************/
$rq_titre = mysqli_query($connect,"SELECT nom_projet FROM F_projet WHERE id_projet = $id_projet");
$rq_version_for_1a = mysqli_query($connect,"SELECT num_version FROM ZC_version WHERE id_projet= $id_projet");

$nom_projet = mysqli_fetch_all($rq_titre, MYSQLI_NUM)[0][0];
$projet = mysqli_fetch_assoc($rq_donnees_principales_res);
$respo = mysqli_fetch_row($rq_respo_res);
$version = mysqli_fetch_row($rq_version_for_1a);


$titre_rapport = mysqli_fetch_all($rq_titre_rapport_tab);
$nom_soci = mysqli_fetch_all($rq_nom_soci_rapport_tab);
$adresse_rapport = mysqli_fetch_all ($rq_adresse_rapport_tab);
$tel_soci = mysqli_fetch_all($rq_tel_soci_rapport_tab);
$site_soci = mysqli_fetch_all($rq_site_soci_rapport_tab);
$reference_rapport = mysqli_fetch_all($rq_reference_rapport_tab);

//echo '<pre>'; print_r($projet);echo '</pre>';
$template -> setValue('Titre', $titre_rapport[0][0]);
$template -> setValue('Société', $nom_soci[0][0]);
$template -> setValue('Adresse société', $adresse_rapport[0][0]);
$template -> setValue('Téléphone société', $tel_soci[0][0]);
$template -> setValue('Site', $site_soci[0][0]);
$template -> setValue('Ref', $reference_rapport[0][0]);
$template -> setValue('Titre', $nom_projet);
$template -> setValue('HEADER', $titre_rapport[0][0]);


$date_pub = date('d/m/y');
$template -> setValue('Date_pub', $date_pub);


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
$template -> setValue('nv_conf',strtoupper($projet['confidentialite']));
$template -> setValue('version', $version[0]);
$template -> setValue('ver', $version[0]);
$template -> setValue('responsable', $respo[0]);

  /*********************Seuils*******************************************************************/

$rq_seuils = mysqli_query($connect, "SELECT seuil_danger,seuil_controle, seuil_veille FROM Q_seuil WHERE id_projet = $id_projet ");
$row_seuil = mysqli_fetch_assoc($rq_seuils);//, MYSQLI_ASSOC);
$template -> setValue('danger', $row_seuil['seuil_danger'][0]);
$template -> setValue('contrôle', $row_seuil['seuil_controle'][0]);
$template -> setValue('veille', $row_seuil['seuil_veille'][0]);



/****************************************Tableaux**********************************************/
  ///atelier1*************************************************************************
  //1.a//////////////////////////////////////////////////////////
  $tab_acteurs = genere_tableau_rapport($rq_tab_acteurs);
  $tab_raci = tab_raci($rq_first_tab, $rq_atelier_raci_tab, $rq_raci_tab);

  //1.b/////////////////////////////////////////////////////////
  $tab_vm = genere_tableau_rapport($rq_vm_tab);
  $tab_biens = genere_tableau_rapport($rq_biens_tab);
  $tab_mission = genere_tableau_rapport($rq_mission_tab);

  //1.c/////////////////////////////////////////////////////////////

  $tab_echelle = genere_tableau_rapport($rq_echelle_tab);
  $tab_niveau  = genere_tableau_rapport($rq_niveau_tab);

  $tab_evred = tab_dyn1c_3b_4b($rq_evred_tab);

  //1.d///////////////////////////////////////////////////////////////
  $tab_socle_sec = tab_dyn_1d($rq_socle_sec_tab);
  $tab_regle = genere_tableau_rapport($rq_regle_tab);

  ////inclusion tableaux
  ///1.a
  $template->setComplexBlock('acteurs', $tab_acteurs);
  $template->setComplexBlock('h_raci', $tab_raci);
  ///1.b
  $template->setComplexBlock('j_valeur_metier', $tab_vm);
  $template->setComplexBlock('k_bien_support', $tab_biens);
  $template->setComplexBlock('i_mission', $tab_mission);

  ///1.c
  $template->setComplexBlock('da_echelle', $tab_echelle);
  $template->setComplexBlock('da_niveau', $tab_niveau);

  ///1.d
  $template->setComplexBlock('n_socle_de_securite', $tab_socle_sec);
  $template->setComplexBlock('o_regle', $tab_regle);
  // $template->setComplexBlock('n_socle_de_securite',$tab_socle_1_d);
  /////sauvegarder fichier

  $date = date('d_m_y');
  $template -> saveAS('report_export\Rapport_at1'.$_SESSION['id_projet'].'_'.$_SESSION['id_utilisateur'].$date.'.docx');
  

}


if($_POST['action'] == 'gene_at1') {
  doc_create();
  //echo $_POST['test0'];
}
  ?>

