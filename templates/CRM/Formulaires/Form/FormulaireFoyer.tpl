{* HEADER *}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

<h3>Saisie des informations sur le Foyer</h3>
	<h4>Nom du foyer</h4>
	<div class="form-pretexte">NOM DU FOYER : Saisir de la façon suivante, en mettant le nom de famille en majuscules : NOM Prénom, pour un(e) célibataire (exemple : DUPONT Marc) ; NOM Prénom et Prénom, pour un couple portant le même nom de famille (exemple : DUPONT Marc et Sophie) ; NOM Prénom et NOM Prénom, pour un couple ne portant pas le même nom de famille (exemple : DUPONT Marc et DURAND Sophie) </div>
	<div class="crm-section">
		<div class="label">{$form.household_name.label}</div>
		<div class="content">{$form.household_name.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.street_address.label}</div>
		<div class="content">{$form.street_address.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.supplemental_address_1.label}</div>
		<div class="content">{$form.supplemental_address_1.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.supplemental_address_2.label}</div>
		<div class="content">{$form.supplemental_address_2.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.postal_code.label}</div>
		<div class="content">{$form.postal_code.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.city.label}</div>
		<div class="content">{$form.city.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.state_province_id.label}</div>
		<div class="content">{$form.state_province_id.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.country_id.label}</div>
		<div class="content">{$form.country_id.html}</div>
		<div class="clear"></div>
	</div>

	<div>Saisir en respectant le format international (exemple : +33 3 88 89 90 91). Mettre des espaces entre les numéros, et pas des points. SI BESOIN de saisir d'autres numéros, le faire après la création de la fiche, en allant la modifier.</div>
	<div class="crm-section">
		<div class="label">{$form.phone.label}</div>
		<div class="content">{$form.phone.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.quartier.label}</div>
		<div class="content">{$form.quartier.html}</div>
		<div class="clear"></div>
	</div>

	<div>Après avoir cliqué sur le bouton "Enregistrer", vous serez dirigé vers le formulaire de saisie des Individus, où vous pourrez créer chaque Individu du Foyer.</div>

{* FIELD EXAMPLE: OPTION 2 (MANUAL LAYOUT)

  <div>
    <span>{$form.favorite_color.label}</span>
    <span>{$form.favorite_color.html}</span>
  </div>



{* FIELD EXAMPLE: OPTION 1 (AUTOMATIC LAYOUT) *}
{*
{foreach from=$elementNames item=elementName}
  <div class="crm-section ">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}
*}


{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
