<?php
global $base_path;
/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
//echo "<pre>";
//var_export($content);
global $language;
$type = 'member_state';

$query = db_select('node', 'n');
$query->join('field_data_field_display_order', 'd', 'n.nid = d.entity_id');
    $query->fields('n', array('nid'))
    ->condition('n.type', $type)
	 ->condition('n.language', $language->language)
	->orderBy('d.field_display_order_value', 'ASC')//ORDER BY created
    ->condition('n.status', 1);
$nids = $query->execute()->fetchCol();
$nodes = node_load_multiple($nids);

$countryval = isset($_GET['country']) ? $_GET['country'] : '';
$typecomp = 'investment_company_detail';
$querycomp = db_select('node', 'n');
$querycomp->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval);

$nidscomp = $querycomp->execute()->fetchCol();
$nodescomp = node_load_multiple($nidscomp);


$typepro = 'trunkey_project';
$querypro = db_select('node', 'n');
$querypro->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval);

$nidspro = $querypro->execute()->fetchCol();
$nodespro = node_load_multiple($nidspro);


//foreach($nodescomp as $n){
//echo "<pre>";
//var_export($nodescomp);
//}
//die;
$cont = (array)$content['body'];
//$companydetail = array();


//Mauritania
if($language->language =='ar'){	
$countryval1='موروتانيا';
} else {
$countryval1='Mauritania';
}
$querycomp1 = db_select('node', 'n');
$querycomp1->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp1->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval1);

$nidscompMauritania = $querycomp1->execute()->fetchCol();
$nodescompMauritania = node_load_multiple($nidscompMauritania);
   foreach ($nodescompMauritania as $nMauritania) {
            $nodeurlMauritania = url('node/' . $nMauritania->nid);
            if (!empty($nMauritania->title)) {
                $companydetailMauritania .= '<a href="' . $nodeurlMauritania . '">' . $nMauritania->title . '</a><br/>';
            }
        } 
$querypro1 = db_select('node', 'n');
$querypro1->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro1->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval1);

$nidsproMauritania = $querypro1->execute()->fetchCol();
$nodesproMauritania = node_load_multiple($nidsproMauritania);

 foreach ($nodesproMauritania as $npMauritania) {
            $nodepurlMauritania = url('node/' . $npMauritania->nid);
            if (!empty($npMauritania->title)) {
                $projectdetailMauritania .= '<a href="' . $nodepurlMauritania . '">' . $npMauritania->title . '</a><br/>';
            }
        } 
 //Tunisia
  if($language->language =='ar'){	
$countryval2='تونس';
} else {
$countryval2='Tunisia';
}
$querycomp2 = db_select('node', 'n');
$querycomp2->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp2->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval2);

$nidscompTunisia = $querycomp2->execute()->fetchCol();
$nodescompTunisia = node_load_multiple($nidscompTunisia);
   foreach ($nodescompTunisia as $nTunisia) {
            $nodeurlTunisia = url('node/' . $nTunisia->nid);
            if (!empty($nTunisia->title)) {
                $companydetailTunisia .= '<a href="' . $nodeurlTunisia . '">' . $nTunisia->title . '</a><br/>';
            }
        } 
$querypro2 = db_select('node', 'n');
$querypro2->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro2->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval2);

$nidsproTunisia = $querypro2->execute()->fetchCol();
$nodesproTunisia = node_load_multiple($nidsproTunisia);

 foreach ($nodesproTunisia as $npTunisia) {
            $nodepurlTunisia = url('node/' . $npTunisia->nid);
            if (!empty($npTunisia->title)) {
                $projectdetailTunisia .= '<a href="' . $nodepurlTunisia . '">' . $npTunisia->title . '</a><br/>';
            }
        } 
 //Morocco
 if($language->language =='ar'){	
$countryval3='المغرب';
} else {
$countryval3='Morocco';
}
$querycomp3 = db_select('node', 'n');
$querycomp3->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp3->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval3);

$nidscompMorocco = $querycomp3->execute()->fetchCol();
$nodescompMorocco = node_load_multiple($nidscompMorocco);
   foreach ($nodescompMorocco as $nMorocco) {
            $nodeurlMorocco = url('node/' . $nMorocco->nid);
            if (!empty($nMorocco->title)) {
                $companydetailMorocco .= '<a href="' . $nodeurlMorocco . '">' . $nMorocco->title . '</a><br/>';
            }
        }	
$querypro3 = db_select('node', 'n');
$querypro3->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro3->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval3);

$nidsproMorocco = $querypro3->execute()->fetchCol();
$nodesproMorocco = node_load_multiple($nidsproMorocco);

 foreach ($nodesproMorocco as $npMorocco) {
            $nodepurlMorocco = url('node/' . $npMorocco->nid);
            if (!empty($npMorocco->title)) {
                $projectdetailMorocco .= '<a href="' . $nodepurlMorocco . '">' . $npMorocco->title . '</a><br/>';
            }
        } 
//Egypt	
if($language->language =='ar'){	
$countryval4='مصر';
} else {
$countryval4='Egypt';	
}
$querycomp4 = db_select('node', 'n');
$querycomp4->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp4->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval4);

$nidscompEgypt = $querycomp4->execute()->fetchCol();
$nodescompEgypt = node_load_multiple($nidscompEgypt);
   foreach ($nodescompEgypt as $nEgypt) {
            $nodeurlEgypt = url('node/' . $nEgypt->nid);
            if (!empty($nEgypt->title)) {
                $companydetailEgypt .= '<a href="' . $nodeurlEgypt . '">' . $nEgypt->title . '</a><br/>';
            }
        }
$querypro4 = db_select('node', 'n');
$querypro4->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro4->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval4);

$nidsproEgypt = $querypro4->execute()->fetchCol();
$nodesproEgypt = node_load_multiple($nidsproEgypt);

 foreach ($nodesproEgypt as $npEgypt) {
            $nodepurlEgypt = url('node/' . $npEgypt->nid);
            if (!empty($npEgypt->title)) {
                $projectdetailEgypt .= '<a href="' . $nodepurlEgypt . '">' . $npEgypt->title . '</a><br/>';
            }
        } 		
//Sudan	
if($language->language =='ar'){	
$countryval5='السودان';
} else {
$countryval5='Sudan';	
}
$querycomp5 = db_select('node', 'n');
$querycomp5->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp5->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval5);

$nidscompSudan = $querycomp5->execute()->fetchCol();
$nodescompSudan = node_load_multiple($nidscompSudan);
   foreach ($nodescompSudan as $nSudan) {
            $nodeurlSudan = url('node/' . $nSudan->nid);
            if (!empty($nSudan->title)) {
                $companydetailSudan .= '<a href="' . $nodeurlSudan . '">' . $nSudan->title . '</a><br/>';
            }
        }
$querypro5 = db_select('node', 'n');
$querypro5->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro5->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval5);

$nidsproSudan = $querypro5->execute()->fetchCol();
$nodesproSudan = node_load_multiple($nidsproSudan);

 foreach ($nodesproSudan as $npSudan) {
            $nodepurlSudan = url('node/' . $npSudan->nid);
            if (!empty($npSudan->title)) {
                $projectdetailSudan .= '<a href="' . $nodepurlSudan . '">' . $npSudan->title . '</a><br/>';
            }
        } 		
//Syria	
if($language->language =='ar'){	
$countryval6='سوريا';
} else {
$countryval6='Syria';	
}
$querycomp6 = db_select('node', 'n');
$querycomp6->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp6->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval6);

$nidscompSyria = $querycomp6->execute()->fetchCol();
$nodescompSyria = node_load_multiple($nidscompSyria);
   foreach ($nodescompSyria as $nSyria) {
            $nodeurlSyria = url('node/' . $nSyria->nid);
            if (!empty($nSyria->title)) {
                $companydetailSyria .= '<a href="' . $nodeurlSyria . '">' . $nSyria->title . '</a><br/>';
            }
        }	
$querypro6 = db_select('node', 'n');
$querypro6->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro6->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval6);

$nidsproSyria = $querypro6->execute()->fetchCol();
$nodesproSyria = node_load_multiple($nidsproSyria);

 foreach ($nodesproSyria as $npSyria) {
            $nodepurlSyria = url('node/' . $npSyria->nid);
            if (!empty($npSyria->title)) {
                $projectdetailSyria .= '<a href="' . $nodepurlSyria . '">' . $npSyria->title . '</a><br/>';
            }
        } 		
//Iraq
if($language->language =='ar'){	
$countryval7='العراق';
} else {
$countryval7='Iraq';	
}
$querycomp7 = db_select('node', 'n');
$querycomp7->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp7->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval7);

$nidscompIraq = $querycomp7->execute()->fetchCol();
$nodescompIraq = node_load_multiple($nidscompIraq);
   foreach ($nodescompIraq as $nIraq) {
            $nodeurlIraq = url('node/' . $nIraq->nid);
            if (!empty($nIraq->title)) {
                $companydetailIraq .= '<a href="' . $nodeurlIraq . '">' . $nIraq->title . '</a><br/>';
            }
        }
$querypro7 = db_select('node', 'n');
$querypro7->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro7->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval7);

$nidsproIraq = $querypro7->execute()->fetchCol();
$nodesproIraq = node_load_multiple($nidsproIraq);

 foreach ($nodesproIraq as $npIraq) {
            $nodepurlIraq = url('node/' . $npIraq->nid);
            if (!empty($npIraq->title)) {
                $projectdetailIraq .= '<a href="' . $nodepurlIraq . '">' . $npIraq->title . '</a><br/>';
            }
        } 		
//Kuwait
if($language->language =='ar'){	
$countryval8='الكويت';
} else {
$countryval8='Kuwait';	
}
$querycomp8 = db_select('node', 'n');
$querycomp8->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp8->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval8);

$nidscompKuwait = $querycomp8->execute()->fetchCol();
$nodescompKuwait = node_load_multiple($nidscompKuwait);
   foreach ($nodescompKuwait as $nKuwait) {
            $nodeurlKuwait = url('node/' . $nKuwait->nid);
            if (!empty($nKuwait->title)) {
                $companydetailKuwait .= '<a href="' . $nodeurlKuwait . '">' . $nKuwait->title . '</a><br/>';
            }
        }
$querypro8 = db_select('node', 'n');
$querypro8->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro8->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval8);

$nidsproKuwait = $querypro8->execute()->fetchCol();
$nodesproKuwait = node_load_multiple($nidsproKuwait);

 foreach ($nodesproKuwait as $npKuwait) {
            $nodepurlKuwait = url('node/' . $npKuwait->nid);
            if (!empty($npKuwait->title)) {
                $projectdetailKuwait .= '<a href="' . $nodepurlKuwait . '">' . $npKuwait->title . '</a><br/>';
            }
        } 				
//Qatar
if($language->language =='ar'){	
$countryval9='دولة قطر';
} else {
$countryval9='Qatar';	
}
$querycomp9 = db_select('node', 'n');
$querycomp9->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp9->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval9);

$nidscompQatar = $querycomp9->execute()->fetchCol();
$nodescompQatar = node_load_multiple($nidscompQatar);
   foreach ($nodescompQatar as $nQatar) {
            $nodeurlQatar = url('node/' . $nQatar->nid);
            if (!empty($nQatar->title)) {
                $companydetailQatar .= '<a href="' . $nodeurlQatar . '">' . $nQatar->title . '</a><br/>';
            }
        }
$querypro9 = db_select('node', 'n');
$querypro9->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro9->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval9);

$nidsproQatar = $querypro9->execute()->fetchCol();
$nodesproQatar = node_load_multiple($nidsproQatar);

 foreach ($nodesproQatar as $npQatar) {
            $nodepurlQatar = url('node/' . $npQatar->nid);
            if (!empty($npQatar->title)) {
                $projectdetailQatar .= '<a href="' . $nodepurlQatar . '">' . $npQatar->title . '</a><br/>';
            }
        } 				
//UAE
if($language->language =='ar'){	
$countryval10='الإمارات';
} else {
$countryval10='UAE';	
}
$querycomp10 = db_select('node', 'n');
$querycomp10->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp10->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval10);

$nidscompUAE = $querycomp10->execute()->fetchCol();
$nodescompUAE = node_load_multiple($nidscompUAE);
   foreach ($nodescompUAE as $nUAE) {
            $nodeurlUAE = url('node/' . $nUAE->nid);
            if (!empty($nUAE->title)) {
                $companydetailUAE .= '<a href="' . $nodeurlUAE . '">' . $nUAE->title . '</a><br/>';
            }
        }
$querypro10 = db_select('node', 'n');
$querypro10->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro10->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval10);

$nidsproUAE = $querypro10->execute()->fetchCol();
$nodesproUAE = node_load_multiple($nidsproUAE);

 foreach ($nodesproUAE as $npUAE) {
            $nodepurlUAE = url('node/' . $npUAE->nid);
            if (!empty($npUAE->title)) {
                $projectdetailUAE .= '<a href="' . $nodepurlUAE . '">' . $npUAE->title . '</a><br/>';
            }
        } 						
//KSA
if($language->language =='ar'){	
$countryval11='السعودية';
} else {
$countryval11='KSA';	
}
$querycomp11 = db_select('node', 'n');
$querycomp11->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp11->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval11);

$nidscompKSA = $querycomp11->execute()->fetchCol();
$nodescompKSA = node_load_multiple($nidscompKSA);
   foreach ($nodescompKSA as $nKSA) {
            $nodeurlKSA = url('node/' . $nKSA->nid);
            if (!empty($nKSA->title)) {
                $companydetailKSA .= '<a href="' . $nodeurlKSA . '">' . $nKSA->title . '</a><br/>';
            }
        }	
$querypro11 = db_select('node', 'n');
$querypro11->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro11->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval11);

$nidsproKSA = $querypro11->execute()->fetchCol();
$nodesproKSA = node_load_multiple($nidsproKSA);

 foreach ($nodesproKSA as $npKSA) {
            $nodepurlKSA = url('node/' . $npKSA->nid);
            if (!empty($npKSA->title)) {
                $projectdetailKSA .= '<a href="' . $nodepurlKSA . '">' . $npKSA->title . '</a><br/>';
            }
        } 
//Oman
if($language->language =='ar'){	
$countryval12='عــمان';
} else {
$countryval12='Oman';	
}
$querycomp12 = db_select('node', 'n');
$querycomp12->join('field_data_field_investment_location', 'l', 'n.nid = l.entity_id');
$querycomp12->fields('n', array('nid'))
 ->condition('n.language', $language->language)
    ->condition('n.type', $typecomp)
    ->condition('n.status', 1)
    ->condition('l.field_investment_location_value', $countryval12);

$nidscompOman = $querycomp12->execute()->fetchCol();
$nodescompOman = node_load_multiple($nidscompOman);
   foreach ($nodescompOman as $nOman) {
            $nodeurlOman = url('node/' . $nOman->nid);
            if (!empty($nOman->title)) {
                $companydetailOman .= '<a href="' . $nodeurlOman . '">' . $nOman->title . '</a><br/>';
            }
        }	
$querypro12 = db_select('node', 'n');
$querypro12->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro12->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval12);

$nidsproOman = $querypro12->execute()->fetchCol();
$nodesproOman = node_load_multiple($nidsproOman);

 foreach ($nodesproOman as $npOman) {
            $nodepurlOman = url('node/' . $npOman->nid);
            if (!empty($npOman->title)) {
                $projectdetailOman .= '<a href="' . $nodepurlOman . '">' . $npOman->title . '</a><br/>';
            }
        } 
//Algeria
if($language->language =='ar'){	
$countryval13='الجزائر';
} else {
$countryval13='Algeria';	
}
$querypro13 = db_select('node', 'n');
$querypro13->join('field_data_field_project_location', 'l', 'n.nid = l.entity_id');
$querypro13->fields('n', array('nid'))
    ->condition('n.type', $typepro)
	 ->condition('n.language', $language->language)
    ->condition('n.status', 1)
    ->condition('l.field_project_location_value', $countryval13);

$nidsproAlgeria = $querypro13->execute()->fetchCol();
$nodesproAlgeria = node_load_multiple($nidsproAlgeria);

 foreach ($nodesproAlgeria as $npAlgeria) {
            $nodepurlAlgeria = url('node/' . $npAlgeria->nid);
            if (!empty($npAlgeria->title)) {
                $projectdetailAlgeria .= '<a href="' . $nodepurlAlgeria . '">' . $npAlgeria->title . '</a><br/>';
            }
        } 
?>
<section class="member-main">
 
        <?php foreach ($cont as $value) {
            if (!empty($value->body['und'][0]['value'])) {
                Print $value->body['und'][0]['value'];
                //Print $value->field_member_map_detail['und'][0]['value'];
            }
        } ?>
        <?php foreach ($nodescomp as $n) {
            $nodeurl = url('node/' . $n->nid);
            if (!empty($n->title)) {
                $companydetail .= '<a href="' . $nodeurl . '">' . $n->title . '</a><br/>';
            }
        } ?>
        <?php

        if ($mapLat == '' && $mapLong == '') {
            // Get lat long from google
            $latlong = get_lat_long($countryval); // create a function with the name "get_lat_long" given as below
            $map = explode(',', $latlong);
            $mapLat = $map[0];
            $mapLong = $map[1];
        }

        // function to get  the address
        function get_lat_long($countryval)
        {

            $address = str_replace(" ", "+", $countryval);

            $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$countryval");
            $json = json_decode($json);

            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            return $lat . ',' . $long;
        }

        if (!empty($_GET['country']) && false) {
		//echo 'testing';
            ?>

           <figure>
                <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCHtOCtZwkJ3mlleqrPGT_LQiLsBwBeCEQ'></script>
                <div style="overflow:hidden;height:350px;width:100%;">
                    <div id="gmap_canvas" style="height:350px;width:100%;">&nbsp;</div>
                    <style type="text/css">#gmap_canvas img {
                            max-width: none !important;
                            background: none !important
                        }
                    </style>
                </div>
                <script type='text/javascript'
                        src='https://embedmaps.com/google-maps-authorization/script.js?id=2a199b8960f834f08af58e0c64d5a13fad685619'></script>
                <script type='text/javascript'>
                    function init_map() {
                        var myOptions = {
                            zoom: 8,
                            center: new google.maps.LatLng(<?php print $mapLat; ?>,<?php Print $mapLong; ?>),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);

                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(<?php print $mapLat; ?>,<?php Print $mapLong; ?>)
                        });
                        infowindow = new google.maps.InfoWindow({content: '<?php Print $companydetail; ?>'});
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.open(map, marker);
                        });
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>
            </figure>
        <?php } else { 
				?>


           <figure>
                <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAfYIazTNVuvilRh3Zq6Gepe-GQRGK0BJw'></script>
                <div style="overflow:hidden;height:350px;width:100%;">
                    <div id="gmap_canvas" style="height:350px;width:100%;">&nbsp;</div>
                    <style type="text/css">#gmap_canvas img {
                            max-width: none !important;
                            background: none !important
                        }
                    </style>
                </div>
                <br/>
                <div class="row" style="padding:8px;">
				<p <?php if (!empty($_GET['country'])){ ?>  class="request-text" <?php } ?>><?php if($language->language =='ar'){ ?>الرجاء الضغط على العلامات الموضحة لرؤية شركات الهيئة<?php } else { ?>Please click on the respective legends to view the respective AAAID companies.<?php } ?></p>
                 <?php if (!empty($_GET['country'])){    
				 foreach ($cont as $value1) {
            if (!empty($value1->field_map_text['und'][0]['value'])) {
			 if($language->language =='ar'){ 	
           echo  '<div class="map-text-arabic"><a href="اour-member-states">' .$value1->field_map_text['und'][0]['value'].'</a></div>';
			} else {
			  echo  '<div class="map-text"><a href="our-member-states-0">' .$value1->field_map_text['und'][0]['value'].'</a></div>';	
			}
                //Print $value->field_member_map_detail['und'][0]['value'];
            }
        }
				 }		?>
				  <div class="col-md-6"><img src="<?php Print $base_path; ?><?php print $directory; ?>/images/marker-green.png"/> <a
                            href="javascript:void(0)" onclick="initialize(1);"><?php if($language->language =='ar'){ ?>الفرص الاستثمارية في المشاريع الحالية<?php } else { ?>
Investment Opportunities in Current AAAID
                            Affiliated Companies<?php } ?></a></div>
                    <div class="col-md-6"><img src="<?php Print $base_path; ?><?php print $directory; ?>/images/marker-gray.png"/> <a
                            href="javascript:void(0)" onclick="initialize(2);"><?php if($language->language =='ar'){ ?>الفرص الاستثمارية في المشاريع الجديدة<?php } else { ?>Investment Opportunities in New Turnkey 
                            Projects <?php } ?></a></div>
                </div>
                <script type='text/javascript'
                        src='https://embedmaps.com/google-maps-authorization/script.js?id=2a199b8960f834f08af58e0c64d5a13fad685619'></script>
                <script type='text/javascript'>
					
					countryIndex=false;

                    function initialize(marker_type) {

                        var featureOpts = [
                            {
                                featureType: "all",
                                elementType: "labels",
                                stylers: [
                                    {visibility: "off"}
                                ]
                            },
                            {
                                featureType: "administrative.country",
                                elementType: "geometry.stroke",
                                stylers: [
                                    {visibility: "off"}
                                ]
                            }
                        ];
<?php if($language->language =='ar'){ ?>
                        // companies Markers
                        var markers = [
                            ['موروتانيا', 21.00789, -10.940835],
                            ['تونس', 33.886917, 9.537499],
                            ['المغرب', 31.791702, -7.09262],
                            ['مصر', 26.820553, 30.802498],
                            ['السودان', 12.862807, 30.217636],
                            ['سوريا', 34.802075, 38.996815],
                            ['العراق', 33.223191, 43.679291],
                            ['الكويت', 29.31166, 47.481766],
                            ['قطر', 25.354826, 51.183884],
                            ['الإمارات', 23.424076, 53.847818],
                            ['السعودية', 22.384658, 44.877410],
                            ['عــمان', 21.512583, 55.923255],

                        ];
<?php } else { ?>

  var markers = [
                            ['Mauritania', 21.00789, -10.940835],
                            ['Tunisia', 33.886917, 9.537499],
                            ['Morocco', 31.791702, -7.09262],
                            ['Egypt', 26.820553, 30.802498],
                            ['Sudan', 12.862807, 30.217636],
                            ['Syria', 34.802075, 38.996815],
                            ['Iraq', 33.223191, 43.679291],
                            ['Kuwait', 29.31166, 47.481766],
                            ['Qatar', 25.354826, 51.183884],
                            ['UAE', 23.424076, 53.847818],
                            ['KSA', 22.384658, 44.877410],
                            ['Oman', 21.512583, 55.923255],

                        ];

<?php } 
 
		?>

                      
 // Info Window Content
                        var infoWindowContent = [
                            // Addresses with violet dots
                            //Mauritania
                            ['<?php Print $companydetailMauritania; ?>'],
                            //Tunisia
                            ['<?php Print $companydetailTunisia; ?>'],
                            //Morocco
                            ['<?php Print $companydetailMorocco; ?>'],
                            //Egypt
                            ['<?php Print $companydetailEgypt; ?>'],
                            //Sudan
                            ['<?php Print $companydetailSudan; ?>'],
                            //Syria
                            ['<?php Print $companydetailSyria; ?>'],
                            //Iraq
                            ['<?php Print $companydetailIraq; ?>'],
                            //Kuwait
                            ['<?php Print $companydetailKuwait; ?>'],
                            //Qatar
                            ['<?php Print $companydetailQatar; ?>'],
                            //UAE
                            ['<?php Print $companydetailUAE; ?>'],
                            //KSA
                            ['<?php Print $companydetailKSA; ?>'],
                            //Oman
                            ['<?php Print $companydetailOman; ?>']

                        ];
<?php if($language->language =='ar'){ ?>
						// Turnkey Projects
                        var markers2 = [
						 ['موروتانيا', 21.00789, -10.940835],
                            ['تونس', 33.886917, 9.537499],
                            ['المغرب', 31.791702, -7.09262],
                            ['مصر', 26.820553, 30.802498],
                            ['السودان', 12.862807, 30.217636],
                          //  ['Syria', 34.802075, 38.996815],
                            //['Iraq', 33.223191, 43.679291],
                            ['الكويت', 29.31166, 47.481766],
                          //  ['Qatar', 25.354826, 51.183884],
                            ['الإمارات', 23.424076, 53.847818],
                          //  ['KSA', 22.384658, 44.877410],
                            ['عــمان', 21.512583, 55.923255],
							['الجزائر', 28.0339, 1.6596],

                         

                        ];
<?php } else { ?>

  var markers2 = [
                           ['Mauritania', 21.00789, -10.940835],
                            ['Tunisia', 33.886917, 9.537499],
                            ['Morocco', 31.791702, -7.09262],
                            ['Egypt', 26.820553, 30.802498],
                            ['Sudan', 12.862807, 30.217636],
                          //  ['Syria', 34.802075, 38.996815],
                            //['Iraq', 33.223191, 43.679291],
                            ['Kuwait', 29.31166, 47.481766],
                          //  ['Qatar', 25.354826, 51.183884],
                            ['UAE', 23.424076, 53.847818],
                          //  ['KSA', 22.384658, 44.877410],
                            ['Oman', 21.512583, 55.923255],
							['Algeria', 28.0339, 1.6596],   
                        ];
<?php } ?>


                        // Info Window Content
                        var infoWindowContent2 = [
                            // Addresses with violet dots
                            //Mauritania
                            ['<?php Print $projectdetailMauritania; ?>'],
                            //Tunisia
                            ['<?php Print $projectdetailTunisia; ?>'],
                            //Morocco
                             ['<?php Print $projectdetailMorocco; ?>'],
                            //Egypt
                            ['<?php Print $projectdetailEgypt; ?>'],
                            //Sudan
                           ['<?php Print $projectdetailSudan; ?>'],
                            //Syria
                          //   ['<?php Print $projectdetailSyria; ?>'],
                            //Iraq
                           // ['<?php Print $projectdetailIraq; ?>'],
                            //Kuwait
                            ['<?php Print $projectdetailKuwait; ?>'],
                            //Qatar
                           // ['<?php Print $projectdetailQatar; ?>'],
                            //UAE
                            ['<?php Print $projectdetailUAE; ?>'],
                            //KSA
                          //   ['<?php Print $projectdetailKSA; ?>'],
                            //Oman
                            ['<?php Print $projectdetailOman; ?>'],
							//Algeria
                           ['<?php Print $projectdetailAlgeria; ?>'],

                        ];

  var countryIndex = 'undefined';
                        var predefinedCountry = "<?php echo $countryval; ?>";
					//	alert(countryIndex);
						//alert(predefinedCountry);
                        for (var i = 0; i < markers.length; i++) {
                            if (markers[i][0] === predefinedCountry) {
						//	alert(predefinedCountry);
                                countryIndex = i;
								//alert(countryIndex);
                                break;
                            }
                        }
                        var map;
                        var bounds = new google.maps.LatLngBounds();
                        var mapOptions = {
                           zoom: 4,
                           scaleControl: false,
                          draggable: true,
                         scrollwheel: true,

                           mapTypeControlOptions: {
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                           }
                        };

                        // Display a map on the page
                       // map = new google.maps.Map(document.getElementById("gmap_canvas"), mapOptions);
                    //  map.setTilt(245);

                        var iconBase = '<?php Print $base_path; ?><?php print $directory; ?>/images/';


                        // Display multiple markers on a map
                        var infoWindow = new google.maps.InfoWindow(), marker, i;

                        if (marker_type == 1) {
					 if(countryIndex !='undefined' ){
						
							console.log(markers);
                                var position = new google.maps.LatLng(markers[countryIndex][1], markers[countryIndex][2]);
								
                                bounds.extend(position);
                                marker = new google.maps.Marker({
                                    position: position,
                                    map: map,
							
                                    title: markers[countryIndex][0],
                                    icon: iconBase + 'marker-green.png',
                                });
							
                                //Allow each marker to have an info window
                                google.maps.event.addListener(marker, 'click', (function (marker, countryIndex) {
                                    return function () {
								
                                        infoWindow.setContent(infoWindowContent[countryIndex][0]);
                                        infoWindow.open(map, marker);
                                    }
                                })(marker, countryIndex));
                                map.fitBounds(bounds);
                            }else{
						
                                // Loop through our array of markers & place each one on the map
                                for (i = 0; i < markers.length; i++) {
                                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
									//alert(position);
                                    bounds.extend(position);
                                    marker = new google.maps.Marker({
                                        position: position,
										
                                        map: map,
                                        title: markers[i][0],
                                        icon: iconBase + 'marker-green.png',
                                    });
                                    //Allow each marker to have an info window
                                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                        return function () {
                                            infoWindow.setContent(infoWindowContent[i][0]);
                                            infoWindow.open(map, marker);
                                        }
                                    })(marker, i));
                                    map.fitBounds(bounds);
                                }
                            }

                        } else {
                            //if(countryIndex!=false){
							 if(countryIndex !='undefined' ){
							//alert(countryIndex);
								console.log(markers2);
                                var position = new google.maps.LatLng(markers2[countryIndex][1], markers2[countryIndex][2]);
                                bounds.extend(position);
                                marker = new google.maps.Marker({
                                    position: position,
                                    map: map,
                                    title: markers2[countryIndex][0],
                                    icon: iconBase + 'marker-gray.png',
                                });
                                //Allow each marker to have an info window
                                google.maps.event.addListener(marker, 'click', (function (marker, countryIndex) {
                                    return function () {
								//	alert(countryIndex);
                                        infoWindow.setContent(infoWindowContent2[countryIndex][0]);
                                        infoWindow.open(map, marker);
                                    }
                                })(marker, countryIndex));
                                map.fitBounds(bounds);
                            }else{
                                // Loop through our array of markers & place each one on the map
                                for (i = 0; i < markers2.length; i++) {
                                    var position = new google.maps.LatLng(markers2[i][1], markers2[i][2]);
                                    bounds.extend(position);
                                    marker = new google.maps.Marker({
                                        position: position,
                                        map: map,
                                        title: markers2[i][0],
                                        icon: iconBase + 'marker-gray.png',
                                    });
                                    //Allow each marker to have an info window
                                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                        return function () {
                                            infoWindow.setContent(infoWindowContent2[i][0]);
                                            infoWindow.open(map, marker);
                                        }
                                    })(marker, i));
                                    map.fitBounds(bounds);
                                }
                            }
                        }

                        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)

                        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
						this.setZoom(4);
                        google.maps.event.removeListener(boundsListener);
                        });
						

                    }
				
				
				initialize(1);
			
				
				//initialize(1);
				setTimeout(function(){initialize(1);},500);
				
				</script>
            </figure>


        <?php } ?>
        <ul class="member-list">
            <?php foreach ($nodes as $n) {
                $nodeurl = url('node/' . $n->nid);
                if (!empty($n->field_flag_image['und'][0]['filename'])) { 
				 $flagname = str_replace( "public://","", $n->field_flag_image['und'][0]['uri']);?>
                    <li>
                        <div class="shadow-boxes">
                           
                                <figure><?php if(!empty($n->field_url_country['und'][0]['value'])){?>
								<a href="?country=<?php print $n->field_url_country['und'][0]['value']; ?>"> <?php } ?>
								<img src="<?php Print $base_path; ?>sites/default/files/<?php print $flagname; ?>" alt="<?php print $n->field_country_['und'][0]['value']; ?>"
								title="<?php print $n->field_country_['und'][0]['value']; ?>"><?php if(!empty($n->field_url_country['und'][0]['value'])){?></a><?php } ?></figure>
                                <h6><?php print $n->field_country_['und'][0]['value']; ?></h6>
                                <span><?php print $n->field_country_share['und'][0]['value']; ?>
				<span class="country-pcntg">%<?php Print $n->field_percentage_share['und'][0]['value']; ?></span></span>
                           
                        </div>
                    </li>
                <?php }
            } ?>

        </ul>
        <div class="clearfix"></div>
        <?php foreach ($cont as $value1) {
            if (!empty($value1->field_member_share_detail['und'][0]['value'])) {
                Print $value1->field_member_share_detail['und'][0]['value'];
				
            }
        } ?>
   
</section>



