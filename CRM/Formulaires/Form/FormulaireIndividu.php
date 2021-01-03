<?php

/* TO DO
// ATTENTION : changer name ligne 383 en Instruments avant diffusion
Changer le cheminement après enregistrement
Travailler les Custom Fields, Option Lists
Séparer Formulaire Bouclier et autre
Travailler les règles de validation
Récupérer les données venant du formulaire Foyer
Séparer Parent d'Enfant
"Activer" l'adresse
Ecrire le fichier .tpl
Simplifier...
Passer le nom de famille en Majuscule
*/

use CRM_Formulaires_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Formulaires_Form_FormulaireIndividu extends CRM_Core_Form {
  public function buildQuickForm() {

// Flag pour les premières paroisses. Permet de changer les Option Listes.
	//  Bouclier = $flagBouclier
	$flagBouclier = FALSE; // réinitialisation de la variable
	
	$getFlagChurch = civicrm_api3('Domain', 'get', [
		'sequential' => 1,
		'return' => ["name"],
		]);// recherche du nom de la paroisse
	
	$flagChurch=$getFlagChurch['values'][0]['name'];
	
	switch ($flagChurch) {
		case "Eglise réformée du Bouclier":
			$flagBouclier = TRUE;
			break;
		default:
			break;
	}


/////////////////////////
// Champs pour Individu/loca/
/////////////////////////
	// Foyer de rattachement
	$this->addEntityRef('household_link', ts('Choisir le Foyer d\'appartenance'), [
		'api' => [
			'params' => ['contact_type' => 'Household'],
		],
		'select' => ['minimumInputLength' => 0],
	],
	TRUE);

	// Statut
	$this->addRadio('statutIndividu', ts("Statut Individu"), array (
		'adulte' => 'Adulte',
		'enfant' => 'Enfant'),
		NULL,
		'&nbsp;&nbsp;&nbsp;',
		TRUE
		);

	// Lien Paroisse
	$membership = CRM_Member_PseudoConstant::membershipType();
	$this->addRadio('membership', ts("Lien avec la Paroisse"), $membership, NULL, NULL, TRUE);

	// Nom des parents (en cas d'enfants)
	$this->addEntityRef(
		'parents',
		ts('Nom des parents'),
		[
		'entity' => 'contact',
		'api' => [
			'params' => ['contact_type' => 'Individual'],
			],
		'select' => ['minimumInputLength' => 0],
		'multiple' => TRUE,
		]);
	
	// Nom des frères et soeurs
	$this->addEntityRef(
		'freres_soeurs',
		ts('Nom des frères et soeurs'),
		[
		'entity' => 'contact',
		'api' => [
			'params' => ['contact_type' => 'Individual'],
			],
		'select' => ['minimumInputLength' => 0],
		'multiple' => TRUE,
		]);
	
	// Civilité
/* Ancienne façon
	$civilite = civicrm_api3('Contact', 'getoptions', [
		'field' => 'prefix_id',
		]);
		foreach ($civilite['values'] as $key => $var) {
		$civiliteOptions[$key] = HTML_QuickForm::createElement('radio', null, ts('Civilité'), $var, $key);
		}
		$this->addGroup($civiliteOptions, 'prefix_id', ts('Civilité'),'<br>');	
*/
	$civilite = civicrm_api3('Contact', 'getoptions', [
		'field' => 'prefix_id',
		]);
    $this->addRadio('prefix_id', ts("Civilité"), $civilite['values'], NULL, '&nbsp;&nbsp;&nbsp;', TRUE);
	
	// Genre
	$gender = civicrm_api3('Contact', 'getoptions', [
		'field' => 'gender_id',
		]);
    $this->addRadio('gender_id', ts("Gender"), $gender['values'], NULL, '&nbsp;&nbsp;&nbsp;', TRUE);

/*Ancienne méthode
	foreach ($gender['values'] as $key => $var) {
		$genderOptions[$key] = HTML_QuickForm::createElement('radio', null, ts('Gender'), $var, $key);
		}
	$this->addGroup($genderOptions, 'gender_id', ts('Gender'),'<br>');
*/
	// Prénom
 	$this->add(
		'text',
		'first_name',
		ts('Prénom'));
	
	// Nom
 	$this->add(
		'text',
		'last_name',
		ts('Nom de famille'));

	// Nom de Jeune fille
 	$this->add(
		'text',
		'nom_naissance',
		ts('Nom de jeune fille')); 		

	// Date de naissance
 	$this->add(
		'datepicker',
		'birth_date',
		ts('Date de naissance'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

	// Lieu de naissance
 	$this->add(
		'text',
		'lieu_naissance',
		ts('Lieu de naissance'));
		
 	// Date des obsèques
 	$this->add(
		'datepicker',
		'date_obseques',
		ts('Date des obsèques'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

 	// Paroisse d'enterrement
	$this->addEntityRef(
		'paroisse_enterrement',
		ts('Paroisse d\'enterrement'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => '96'],
			],
		]);	

	// Nom Conjoint / Partenaire
	$this->addEntityRef('nom_conjoint', ts('Sélectionner le conjoint ou partenaire'), [
		'api' => [
			'params' => ['contact_type' => 'Individual'],
		],
		'select' => ['minimumInputLength' => 0],
	]);
		// Lien Conjoint / Partenaire
	$this->addRadio('relationConjoint', ts("Type de relation"), array (
		'conjoint' => 'Conjoint de',
		'partenaire' => 'Partenaire de'),
		NULL,
		'&nbsp;&nbsp;&nbsp;',
		FALSE
		);

	// Date du mariage
 	$this->add(
		'datepicker',
		'date_mariage',
		ts('Date du mariage'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

	// Date de la bénédiction nuptiale
 	$this->add(
		'datepicker',
		'date_benediction_nuptiale',
		ts('Date de la bénediction nuptiale'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

	// Paroisse de mariage
		$this->addEntityRef(
		'paroisse_mariage',
		ts('Paroisse de mariage'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => '96'],
			],
		]);	

 	// Verset de mariage
 	$this->add(
		'textarea',
		'verset_mariage',
		ts('Verset de mariage'));		
	
	// Divorcé ?
	$this->addYesNo('divorce', ts('Divorcé ?'));	

	// Date de divorce
 	$this->add(
		'datepicker',
		'date_divorce',
		ts('Date de divorce'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

	// Date de veuvage
 	$this->add(
		'datepicker',
		'date_veuvage',
		ts('Date de veuvage'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);	

	// Téléphone portable
	$this->add(
		'text',
		'phone_mobile',
		ts('Téléphone Portable Personnel'));

	// Téléphone travail
	$this->add(
		'text',
		'phone_work',
		ts('Téléphone Professionnel'));

	// Courriel Domicile
	$this->add(
		'text',
		'email_home',
		ts('Courriel Personnel'));

	// Courriel Travail
	$this->add(
		'text',
		'email_work',
		ts('Courriel Professionnel'));
	
	
	// Métier
 	$this->add(
		'text',
		'job_title',
		ts('Métier'));		

	// Musicien du Choeur (information non stocké dans la base, sert à l'affichage. A revoir ?
	$this->addYesNo('customfield8', ts('Musicien du Choeur ?'));		

	// Numéro de Sécurité Sociale
 	$this->add(
		'text',
		'securite_sociale',
		ts('Numéro de Sécurité Sociale'));		

	// Numéro Guso
 	$this->add(
		'text',
		'guso',
		ts('Numéro Guso'));		

	// Fonctionnaire?
	$this->addYesNo('fonctionnaire', ts('Fonctionnaire ?'));		
	
	
	// Groupes
/* A retravailler pour afficher le nom des groupes en checkbox
	$groups = civicrm_api3('Group', 'get', [
		'return' => ["id", "title"],
			'is_active' => 1,
		'options' => ['limit' => 0],
		'is_hidden' => 0,
		]);
	$this->addCheckbox('groups', ts("Groupe(s)"), $groups['values'], NULL, NULL, FALSE, NULL, '&nbsp;&nbsp;&nbsp;');
	// EXEMPLES et DOCUMENTATION addCheckbox : https://doc.symbiotic.coop/dev/civicrm/v47/phpdoc/CRM_Report_Form_Member_ContributionDetail.html et https://github.com/civicrm/civicrm-core/blob/master/CRM/Admin/Form/PaymentProcessor.php
	*/
	$this->addEntityRef(
		'groups',
		ts('Groupe(s)'),
		[
		'entity' => 'group',
		'select' => ['minimumInputLength' => 0],
		'multiple' => TRUE,
		]);

	
	// Etiquettes
/* A retravailler pour afficher le nom des groupes en checkbox
	$tags = civicrm_api3('Tag', 'get', [
		'return' => ["id", "name"],
		'options' => ['limit' => 0],
		]);
	
	$this->addCheckbox('tags', ts("Etiquette(s)"), $tags['values'], NULL, NULL, FALSE, NULL, '&nbsp;&nbsp;&nbsp;');
*/	

	$this->addEntityRef(
		'tags',
		ts('Etiquette(s)'),
		[
		'entity' => 'tag',
		'select' => ['minimumInputLength' => 0],
		'multiple' => TRUE,
		]);	

	// Compétence Musique Instrument
	/* Récupération de l'ID de la musique */
	if($flagBouclier == TRUE){
		$optionMusique = civicrm_api3('OptionGroup', 'get', [
			'name' => "musique_20160320222023",
		]);
	}
	else {
		$optionMusique = civicrm_api3('OptionGroup', 'get', [
			'name' => "instruments",
		]);
	}
	
// ATTENTION : changer name ci-dessus en Instruments avant diffusion

	/* Affichage de la liste des instruments */
	$this->addEntityRef(
		'musique_instrument',
		ts('Compétence Musique : instrument'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => $optionMusique['id']],
			],
		'select' => ['minimumInputLength' => 0],
		'multiple' => TRUE,	
		]);

// A TRAVAILLER	pour afficher en checkbox	
	// Compétence Musique Voix
	/* Récupération de l'ID de la voix */
	if($flagBouclier == TRUE){
		$optionVoix = civicrm_api3('OptionGroup', 'get', [
			'name' => "musique_voix_20181230192344",
		]);
	}
	else {
		$optionVoix = civicrm_api3('OptionGroup', 'get', [
			'name' => "voix_chant",
		]);
	}
		
	/* Affichage de la liste des voix */
	$this->addEntityRef(
		'musique_chant',
		ts('Compétence Musique : voix'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => $optionVoix['id']],
			],
		]);

// A TRAVAILLER	pour afficher en checkbox
	// Religion
	/* Récupération de l'ID de la religion */
	if($flagBouclier == TRUE){
		$optionReligion = civicrm_api3('OptionGroup', 'get', [
			'name' => "religion_20160215223238",
		]);
	}
	else {
		$optionReligion = civicrm_api3('OptionGroup', 'get', [
			'name' => "religion",
		]);
	}
	
	/* Affichage de la liste des religions */
	$this->addEntityRef(
		'religion',
		ts('Religion'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => $optionReligion['id']],
			],
		]);	


	// Date de présentation
 	$this->add(
		'datepicker',
		'date_presentation',
		ts('Date de présentation'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);		

// A TRAVAILLER	
	// Paroisse de présentation
	/* Récupération de l'ID des paroisses */
	if($flagBouclier == TRUE){
		$optionParoisses = NULL;
	}
	else {
		$optionParoisses = civicrm_api3('OptionGroup', 'get', [
			'name' => "liste_paroisses",
		]);
		
		/* Affichage de la liste des paroisses */
		$this->addEntityRef(
			'paroisse_presentation',
			ts('Paroisse de présentation'),
			['entity' => 'OptionValue',
			'api' => [
				'params' => ['option_group_id' => $optionParoisses['id']],
				],
			]);	
	}	
		
	// Date de baptême
 	$this->add(
		'datepicker',
		'date_bapteme',
		ts('Date de baptême'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);		
	
	// Paroisse de baptême
	/* Récupération de l'ID des paroisses */
	if($flagBouclier == TRUE){
		$optionParoisses = NULL;
	}
	else {
		$optionParoisses = civicrm_api3('OptionGroup', 'get', [
			'name' => "liste_paroisses",
		]);
		
		/* Affichage de la liste des paroisses */
		$this->addEntityRef(
			'paroisse_bapteme',
			ts('Paroisse de baptême'),
			['entity' => 'OptionValue',
			'api' => [
				'params' => ['option_group_id' => $optionParoisses['id']],
				],
			]);	
	}	

	// Verset de baptême
 	$this->add(
		'textarea',
		'verset_bapteme',
		ts('Verset de baptême'));		

	// Date de confirmation
 	$this->add(
		'datepicker',
		'date_confirmation',
		ts('Date de confirmation'),
		array('class' => 'some-css-class'),
		FALSE,
		array('time' => FALSE,
			'date' => 'dd-mm-yy',
			'yearRange' => '-120:+1')
		);		
	
// A TRAVAILLER
	// Paroisse de confirmation
/*		$this->addSelect(
			'custom_20',
			array(
				'entity' => 'OptionValue',
				'api' => [
					'params' => ['option_group_id' => '95'],
					],
				'label' => ts('Paroisse de confirmation')
				),
			);
*/
	/* Récupération de l'ID des paroisses */
	if($flagBouclier == TRUE){
		$optionParoisses = NULL;
	}
	else {
		$optionParoisses = civicrm_api3('OptionGroup', 'get', [
			'name' => "liste_paroisses",
		]);
		
		/* Affichage de la liste des paroisses */
		$this->addEntityRef(
			'paroisse_confirmation',
			ts('Paroisse de confirmation'),
			['entity' => 'OptionValue',
			'api' => [
				'params' => ['option_group_id' => $optionParoisses['id']],
				],
			]);	
	}	

	// Verset de confirmation
 	$this->add(
		'textarea',
		'verset_confirmation',
		ts('Verset de confirmation'));		
	
	
	
	
// AJOUT DES BOUTONS 	
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Save'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {

	$this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1'); // Destination après validation du formulaire

    $values = $this->exportValues(); // récupération des valeurs envoyées par le formulaire

	$ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
    foreach ($values as $key => $data) {
      if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
        $params[$key] = $data; // création du tableau avec les valeurs à créer
      }
    }
	

///////////////////////////////////////
// CREATION DE L'INDIVIDU DANS L'API //
///////////////////////////////////////

// Flag pour les premières paroisses. Permet de changer les Custom Fields.
	//  Bouclier = $flagBouclier
	$flagBouclier = FALSE; // réinitialisation de la variable
	
	$getFlagChurch = civicrm_api3('Domain', 'get', [
		'sequential' => 1,
		'return' => ["name"],
		]);// recherche du nom de la paroisse
	
	$flagChurch=$getFlagChurch['values'][0]['name'];
	
	switch ($flagChurch) {
		case "Eglise réformée du Bouclier":
			$flagBouclier = TRUE;
			break;
		default:
			break;
	}

// création de l'Individu //
////////////////////////////

	/* Récupération des ID des Custom Fields */
	$listCustomFields = array();	

	$getListCustomFields = civicrm_api3('CustomField', 'get', [
		'sequential' => 1,
		'return' => ["name"],
		'options' => ['limit' => 0],
		]); 
	
	/* transformation de la liste pour avoir le nom en premier et l'id derrière */
	for($i=0; $i<($getListCustomFields['count']);$i++) {
		$j = $getListCustomFields['values'][$i]['name'];
		$listCustomFields[$j] = 'custom_'.$getListCustomFields['values'][$i]['id'];
	} 

	/* Création du contenu pour API3 Contact (contenu de base) */
	$createIndividual = array (
			'contact_type' => "Individual",
			'prefix_id' => $params['prefix_id'],
			'gender_id' => $params['gender_id'],
			'first_name' => $params['first_name'],
			'last_name' => $params['last_name'],
			'birth_date' => $params['birth_date'],
			'job_title' => $params['job_title'],
			// Rajouter Source "Formulaire de saisie"
		); 
	/* Rajout du contenu pour API3 Contact (contenu dédié Bouclier) */
	if ($flagBouclier == TRUE){
		$createIndividual += array (
			$listCustomFields["Lieu_de_naissance"] => $params['lieu_naissance'],
			$listCustomFields["Date_de_mariage"] => $params['date_mariage'],
			$listCustomFields["Date_de_divorce"] => $params['date_divorce'],
			$listCustomFields["Divorc_e_"] => $params['divorce'],
			$listCustomFields["Date_de_veuvage"] => $params['date_veuvage'],
			$listCustomFields["Date_d_enterrement"] => $params['date_obseques'],
			$listCustomFields["Num_ro_de_S_curit_Sociale"] => $params['securite_sociale'],
			$listCustomFields["Num_ro_GUSO"] => $params['guso'],
			$listCustomFields["Fonctionnaire_"] => $params['fonctionnaire'],
			$listCustomFields["Date_de_pr_sentation"] => $params['date_presentation'],
			$listCustomFields["Date_de_bapt_me"] => $params['date_bapteme'],
			$listCustomFields["Date_de_confirmation"] => $params['date_confirmation'],
			//$listCustomFields["Musique"] => $params['musique_instrument'],
			$listCustomFields["Musique_voix"] => $params['musique_chant'],
			// Rajouter Nom de jeune fille
			// Rajouter Paroisse de Mariage, Paroisse de présentation, paroisse de baptême, paroisse de confirmation
			// Rajouter date bénediction nuptiale
			// Rajouter versets 
			//A	CONTINUER - Groupes et Etiquettes
		); 
	}
	/* Rajout du contenu pour API3 Contact (contenu autres paroisses) */
	else{
		$createIndividual += array(
			$listCustomFields["nom_naissance"] => $params['nom_naissance'],
			$listCustomFields["lieu_naissance"] => $params['lieu_naissance'],
			$listCustomFields["date_mariage"] => $params['date_mariage'],
			$listCustomFields["date_benediction_nuptiale"] => $params['date_benediction_nuptiale'],
			$listCustomFields["paroisse_mariage"] => $params['paroisse_mariage'],
			$listCustomFields["verset_mariage"] => $params['verset_mariage'],
			$listCustomFields["date_divorce"] => $params['date_divorce'],
			$listCustomFields["divorce"] => $params['divorce'],
			$listCustomFields["date_veuvage"] => $params['date_veuvage'],
			$listCustomFields["date_obseques"] => $params['date_obseques'],
			$listCustomFields["paroisse_enterrement"] => $params['paroisse_enterrement'],
			$listCustomFields["securite_sociale"] => $params['securite_sociale'],
			$listCustomFields["guso"] => $params['guso'],
			$listCustomFields["fonctionnaire"] => $params['fonctionnaire'],
			//$listCustomFields["musique_instrument"] => $params['musique_instrument'],
			$listCustomFields["musique_chant"] => $params['musique_chant'],
			$listCustomFields["religion"] => $params['religion'],
			$listCustomFields["date_presentation"] => $params['date_presentation'],
			$listCustomFields["paroisse_presentation"] => $params['paroisse_presentation'],
			$listCustomFields["date_bapteme"] => $params['date_bapteme'],
			$listCustomFields["paroisse_bapteme"] => $params['paroisse_bapteme'],
			$listCustomFields["verset_bapteme"] => $params['verset_bapteme'],
			$listCustomFields["date_confirmation"] => $params['date_confirmation'],
			$listCustomFields["paroisse_confirmation"] => $params['paroisse_confirmation'],
			$listCustomFields["verset_confirmation"] => $params['verset_confirmation'],	
			// Rajouter Paroisse de Mariage
			//A	CONTINUER - Groupes et Etiquettes
		); 
	}

	/* Injection des données dans l'API */
	try {
		$newIndividual = civicrm_api3('Contact', 'create', $createIndividual);
		CRM_Core_Session::setStatus(' Individual in database saved', ' Individual saved', 'success');
		}
	catch (CiviCRM_API3_Exception $ex) {
			CRM_Core_Session::setStatus('Error saving Individual in database', 'NOT Saved Individual', 'error');
			}	

	/* Récupération du nouveau numéro ID pour utilisation dans les autres API */
	$newIndividual_id = $newIndividual['id'];

	/* Récupération de l'ID Adresse du Foyer */
	$AddressIdHousehold = civicrm_api3('Address', 'get', [
		'contact_id' => $params['household_link'],
		]);

// création de l'adresse de l'Individu //
/////////////////////////////////////////
	try {
		$newIndividualAdress = civicrm_api3('Address', 'create', [
			'contact_id' => $newIndividual_id, //$famille['household_id'],
			'master_id' => $AddressIdHousehold['id'],
			'location_type_id' => 1,
		]);
		CRM_Core_Session::setStatus(' Individual adresse in database saved', ' Adresse saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Individual adresse in database', 'NOT Saved Adresse', 'error');
    }	
// création du téléphone portable de l'Individu //
//////////////////////////////////////////////////
	// A RETRAVAILLER pour codifier les type_id

	if(!empty($params['phone_mobile'])) {
		try {
			$newIndividualMobilePhone = civicrm_api3('Phone', 'create', [
				'contact_id' => $newIndividual_id,
				'phone' => $params['phone_mobile'], 
				'is_primary' => 1,
				'location_type_id' => 1, // domicile
				'phone_type_id' => 2, // portable
			]);
			CRM_Core_Session::setStatus(' Individual Mobile Phone in database saved', ' Phone saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Individual mobile phone in database', 'NOT Saved Phone', 'error');
		}	
	}

// création du téléphone professionel de l'Individu //
//////////////////////////////////////////////////////
	// A RETRAVAILLER pour codifier les type_id
	if(!empty($params['phone_work'])) {
		try {
			$newIndividualWorkPhone = civicrm_api3('Phone', 'create', [
				'contact_id' => $newIndividual_id,
				'phone' => $params['phone_work'], 
				'is_primary' => 0,
				'location_type_id' => 2, // travail
				'phone_type_id' => 1, // fixe
			]);
			CRM_Core_Session::setStatus(' Individual Work Phone in database saved', ' Phone saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Individual Work phone in database', 'NOT Saved Phone', 'error');
		}	
	}

// création du courriel privé de l'Individu //
//////////////////////////////////////////////
	// A RETRAVAILLER pour codifier les type_id

	if (!empty($params['email_home'])) {
		try {
			$newIndividualHomeMail = civicrm_api3('Email', 'create', [
				'contact_id' => $newIndividual_id,
				'email' => $params['email_home'], 
				'is_primary' => 1,
				'location_type_id' => 1, // domicile
			]);
			CRM_Core_Session::setStatus(' Individual Home Mail in database saved', ' Mail saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Individual Home Mail in database', 'NOT Saved Mail', 'error');
		}
	}		


// création du courriel professionnel de l'Individu //
//////////////////////////////////////////////////////
	// A RETRAVAILLER pour codifier les type_id
	if (!empty($params['email_work'])) {
		try {
			$newIndividualHomeWork = civicrm_api3('Email', 'create', [
				'contact_id' => $newIndividual_id,
				'email' => $params['email_work'], 
				'is_primary' => 0,
				'location_type_id' => 2, // travail
			]);
			CRM_Core_Session::setStatus(' Individual Work Mail in database saved', ' Mail saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Individual Work Mail in database', 'NOT Saved Mail', 'error');
		}
	}

// création des instruments de musique //
/////////////////////////////////////////
	if (!empty($params['musique_instrument'])){
		$getInstruments = explode( ',', $params['musique_instrument']);
		
		/* Valeur différente selon Eglises */
		if ($flagBouclier == TRUE) {
			$idInputMusique = $listCustomFields["Musique"];
		}
		else {
			$idInputMusique = $listCustomFields["musique_instrument"];
		}
		
		/* Création de l'instrument */
		$setInstrument = civicrm_api3('Contact', 'create', [
			'id' => $newIndividual_id,
			$idInputMusique => $getInstruments,
			]);
	}

// création des groupes de l'individu //
////////////////////////////////////////	
	if (!empty($params['groups'])) {
	
		$getoptionsGroups = explode( ',', $params['groups']);
		
		try {
			$newIndividualGroups = civicrm_api3('GroupContact', 'create', [
				'contact_id' => $newIndividual_id,
				'group_id' => $getoptionsGroups,
				]);
			CRM_Core_Session::setStatus('Groups in database saved', 'Groups saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Groups in database', 'NOT Saved Groups', 'error');
		}
	}

// création des etiquettes de l'individu //
///////////////////////////////////////////
	if (!empty($params['tags'])) {
	
		$getoptionsTags = explode( ',', $params['tags']);
		
		try {
			$newIndividualTags = civicrm_api3('EntityTag', 'create', [
				'entity_table' => 'civicrm_contact',
				'entity_id' => $newIndividual_id,
				'tag_id' => $getoptionsTags,
				]);
			CRM_Core_Session::setStatus('Tags in database saved', 'Tags saved', 'success');
		}
		catch (CiviCRM_API3_Exception $ex) {
		  CRM_Core_Session::setStatus('Error saving Tags in database', 'NOT Saved Tags', 'error');
		}
	}

// création de l'adhésion de l'individu //
//////////////////////////////////////////
	try {
		$newIndividualMembership = civicrm_api3('Membership', 'create', [
			'contact_id' => $newIndividual_id,
			'membership_type_id' => $params['membership'], 
		]);
		CRM_Core_Session::setStatus('Membership in database saved', ' Membership saved', 'success'); 
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Membership in database', 'NOT Saved Membership', 'error'); 
    }	

// création des relations de l'individu //
//////////////////////////////////////////

// A FAIRE
	/* Récupération des ID des relations*/
	$getListRelationTypes = civicrm_api3('RelationshipType', 'get', [
		'return' => ["name_a_b"],
		'options' => ['limit' => 0],
	]);

	/* transformation de la liste pour avoir le nom en premier et l'id derrière */
	for($i=0; $i<($getListRelationTypes['count']);$i++) {
		if (!empty($getListRelationTypes['values'][$i])) {
			$j = $getListRelationTypes['values'][$i]['name_a_b'];
			$listRelationTypes[$j] = $getListRelationTypes['values'][$i]['id'];
		}
	} 

	

	/* Mise en place des relations pour les adultes */	
	if($params['statutIndividu'] == 'adulte'){
		/* Relation Chef de Foyer */
		$setRelationshipChefFoyer = civicrm_api3('Relationship', 'create', [
			'contact_id_a' => $newIndividual_id,
			'contact_id_b' => $params['household_link'],
			'relationship_type_id' => $listRelationTypes['Head of Household for'],
		]);
		/* Détermination de la Relation Conjoint */
		if (!empty($params['relationConjoint'])) {
		
			switch ($params['relationConjoint']){
				case "conjoint":
					$flagRelationTypeConjoint = $listRelationTypes['Spouse of'];
					break;
				case "partenaire":
					$flagRelationTypeConjoint = $listRelationTypes['Partner of'];
					break;
				default:
					break;
			}		
			/* Relation au Conjoint */
			$setRelationshipConjoint = civicrm_api3('Relationship', 'create', [
				'contact_id_a' => $newIndividual_id,
				'contact_id_b' => $params['nom_conjoint'],
				'relationship_type_id' => $flagRelationTypeConjoint,
			]);		
			//??? NE MARCHE PAS break;	
		}
	}
	/* Mise en place des relations pour les enfants */
	elseif($params['statutIndividu'] == 'enfant') {
		/* Relation Enfants de / Parents de */
		$getIdParent = explode( ',', $params['parents']);
		foreach ($getIdParent as $id_b_parent) {
			$setRelationshipParents = civicrm_api3('Relationship', 'create', [
				'contact_id_a' => $newIndividual_id,
				'contact_id_b' => $id_b_parent,
				'relationship_type_id' => $listRelationTypes['Child of'],
			]);
		}
		
		/* Relation Freres/Soeurs de*/
		if (!empty($params['freres_soeurs'])){
			$getIdFreresSoeurs = explode( ',', $params['freres_soeurs']);
			foreach ($getIdFreresSoeurs as $id_b_freres_soeurs) {
				$setRelationshipFreresSoeurs = civicrm_api3('Relationship', 'create', [
					'contact_id_a' => $newIndividual_id,
					'contact_id_b' => $id_b_freres_soeurs,
					'relationship_type_id' => $listRelationTypes['Sibling of'],
				]);
			}
		}
		
	}
	

    parent::postProcess();
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
	// RIEN A CHANGER DANS CETTE FUNCTION
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
