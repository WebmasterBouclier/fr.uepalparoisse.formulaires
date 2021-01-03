<?php

use CRM_Formulaires_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Formulaires_Form_FormulaireFoyer extends CRM_Core_Form {
  public function buildQuickForm() {

// Foyer
	// Nom du foyer
	$this->add(
		'text',
		'household_name',
		ts('Nom du foyer'),
		TRUE);

	// Adresses
	$this->add(
		'text',
		'street_address',
		ts('Adresse ligne 1'));

	$this->add(
		'text',
		'supplemental_address_1',
		ts('Adresse ligne 2'));

	$this->add(
		'text',
		'supplemental_address_2',
		ts('Adresse ligne 3'));

	// Code Postal
	$this->add(
		'text',
		'postal_code',
		ts('Code Postal'));

	// Ville
	$this->add(
		'text',
		'city',
		ts('Ville'));

	//Departement
	// RAJOUTER valeur par défaut (67, 68, 57)
	// Restreindre sur France ?
	$stateProvince = array('' => ts('- any state/province -')) + CRM_Core_PseudoConstant::stateProvince( );
	$this->add(
		'select',
		'state_province_id',
		ts('Departement'),
		$stateProvince);

	//Pays
	$country = array('' => ts('- any country -')) + CRM_Core_PseudoConstant::country( );
	$this->add(
		'select',
		'country_id',
		ts('Pays'),
		$country);

	// Téléphone Fixe Domicile
	$this->add(
		'text',
		'phone',
		ts('Téléphone Fixe Domicile'));

// A TRAVAILLER (changer le ID)
 	// Quartier
	$this->addEntityRef(
		'quartier',
		ts('Quartier (distribution, visiteurs, ...)'),
		['entity' => 'OptionValue',
		'api' => [
			'params' => ['option_group_id' => '100'],
			],
		]);	

 $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Save'),
        'isDefault' => TRUE,
      ),
	  // ??? Nécessaire ?? Ou dans le .tpl ?
	  array(
        'type' => 'reset',
        'name' => E::ts('Reset'),
        'isDefault' => FALSE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }




  public function postProcess() {

	$this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1'); // Destination après validation du formulaire

    $values = $this->exportValues(); // récupération des valeurs envoyés par le formulaire

	$ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
    foreach ($values as $key => $data) {
      if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
        $params[$key] = $data; // création du tableau avec les valeurs à créer
      }
    }

	// création du Foyer
    try {
      $newHousehold = civicrm_api3('Contact', 'create', [
		'contact_type' => "Household",
		'household_name' => $params['household_name'],
		]);
      CRM_Core_Session::setStatus(' Household in database saved', ' Household saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Household in database', 'NOT Saved Household', 'error');
    }	

$newHousehold_id = $newHousehold['id'];
$famille['household_id'] = $newHousehold['id'];

	// création de l'adresse du Foyer
    try {
      $newHouseholdAdress = civicrm_api3('Address', 'create', [
		'contact_id' => $newHousehold_id,
		'location_type_id' => 1,
        'is_primary' => 1,
		'street_address' => $params['street_address'],
		'supplemental_address_1' => $params['supplemental_address_1'],
		'supplemental_address_2' => $params['supplemental_address_2'],
		'postal_code' => $params['postal_code'],
		'city' => $params['city'],
		'state_province_id' => $params['state_province_id'],
		'country_id' => $params['country_id'],
		'custom_31' => $params['quartier'], // A changer		
		]);
      CRM_Core_Session::setStatus(' Household adresse in database saved', ' Adresse saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Household adresse in database', 'NOT Saved Adresse', 'error');
    }	

$famille['household_adress_id'] = $newHouseholdAdress['id'];

	// création du téléphone fixe du Foyer
    try {
      $newHouseholdPhone = civicrm_api3('Phone', 'create', [
		'contact_id' => $newHousehold_id,
		'location_type_id' => 1, // domicile
        'is_primary' => 1,
		'phone_type_id' => 1, // fixe
		'phone' => $params['phone'],
		]);
      CRM_Core_Session::setStatus(' Household Phone in database saved', ' Phone saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Household Phone in database', 'NOT Saved Phone', 'error');
    }	

$famille['household_phone_id'] = $newHouseholdPhone['id'];
	
	
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
	// NOTHING TO CHANGE IN THIS FUNCTION
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
