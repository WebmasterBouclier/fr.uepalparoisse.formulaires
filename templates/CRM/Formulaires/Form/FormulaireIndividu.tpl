{* HEADER *}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

<h2>Saisie des informations sur l'Individu</h3>
	<h3>Nom du foyer</h3>
	<div class="crm-section">
		<div class="label">{$form.household_link.label}</div>
		<div class="content">{$form.household_link.html}</div>
		<div class="clear"></div>
	</div>
	
	<h3>Statut de l'individu</h3>
	
	<div class="crm-section">
		<div class="label">{$form.statutIndividu.label}</div>
		<div class="content">{$form.statutIndividu.html}</div>
		<div class="clear"></div>
		<div class="form-pretexte">Indiquer si l'Individu est un enfant ou un adulte (dans le Foyer).</div>
	</div>
		
	<h3>Pour les enfants uniquement</h3>
	<div class="crm-section">
		<div class="label">{$form.parents.label}</div>
		<div class="content">{$form.parents.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.freres_soeurs.label}</div>
		<div class="content">{$form.freres_soeurs.html}</div>
		<div class="clear"></div>
	</div>

	<h3>Civilité</h3>
	<div class="crm-section">
		<div class="label">{$form.prefix_id.label}</div>
		<div class="content">{$form.prefix_id.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.gender_id.label}</div>
		<div class="content">{$form.gender_id.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.first_name.label}</div>
		<div class="content">{$form.first_name.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.last_name.label}</div>
		<div class="content">{$form.last_name.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.nom_naissance.label}</div>
		<div class="content">{$form.nom_naissance.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.birth_date.label}</div>
		<div class="content">{$form.birth_date.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.lieu_naissance.label}</div>
		<div class="content">{$form.lieu_naissance.html}</div>
		<div class="clear"></div>
	</div>
	
	<div class="crm-section">
		<div class="label">{$form.date_obseques.label}</div>
		<div class="content">{$form.date_obseques.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.paroisse_enterrement.label}</div>
		<div class="content">{$form.paroisse_enterrement.html}</div>
		<div class="clear"></div>
	</div>

	<h3>Informations de contact</h3>
	<div class="crm-section">
		<div class="label">{$form.phone_mobile.label}</div>
		<div class="content">{$form.phone_mobile.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.phone_work.label}</div>
		<div class="content">{$form.phone_work.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.email_home.label}</div>
		<div class="content">{$form.email_home.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.email_work.label}</div>
		<div class="content">{$form.email_work.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.job_title.label}</div>
		<div class="content">{$form.job_title.html}</div>
		<div class="clear"></div>
	</div>

	<h3>Lien avec la paroisse</h3>
	<div class="crm-section">
		<div class="label">{$form.membership.label}</div>
		<div class="content">{$form.membership.html}</div>
		<div class="clear"></div>
	</div>

	
	<div class="crm-section">
		<div class="label">{$form.groups.label}</div>
		<div class="content">{$form.groups.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.tags.label}</div>
		<div class="content">{$form.tags.html}</div>
		<div class="clear"></div>
	</div>
	
	<h3>Informations sur le couple</h3>
	<div class="crm-section">
		<div class="label">{$form.nom_conjoint.label}</div>
		<div class="content">{$form.nom_conjoint.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.relationConjoint.label}</div>
		<div class="content">{$form.relationConjoint.html}</div>
		<div class="clear"></div>
	</div>
	
	<div class="crm-section">
		<div class="label">{$form.date_mariage.label}</div>
		<div class="content">{$form.date_mariage.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_benediction_nuptiale.label}</div>
		<div class="content">{$form.date_benediction_nuptiale.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.paroisse_mariage.label}</div>
		<div class="content">{$form.paroisse_mariage.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.verset_mariage.label}</div>
		<div class="content">{$form.verset_mariage.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.divorce.label}</div>
		<div class="content">{$form.divorce.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_divorce.label}</div>
		<div class="content">{$form.date_divorce.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_veuvage.label}</div>
		<div class="content">{$form.date_veuvage.html}</div>
		<div class="clear"></div>
	</div>

	<h3>Renseignements sur la religion</h3>
	<div class="crm-section">
		<div class="label">{$form.religion.label}</div>
		<div class="content">{$form.religion.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_presentation.label}</div>
		<div class="content">{$form.date_presentation.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.paroisse_presentation.label}</div>
		<div class="content">{$form.paroisse_presentation.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_bapteme.label}</div>
		<div class="content">{$form.date_bapteme.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.paroisse_bapteme.label}</div>
		<div class="content">{$form.paroisse_bapteme.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.verset_bapteme.label}</div>
		<div class="content">{$form.verset_bapteme.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.date_confirmation.label}</div>
		<div class="content">{$form.date_confirmation.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.paroisse_confirmation.label}</div>
		<div class="content">{$form.paroisse_confirmation.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.verset_confirmation.label}</div>
		<div class="content">{$form.verset_confirmation.html}</div>
		<div class="clear"></div>
	</div>
	
	<h3>Renseignements sur les musiciens</h3>
	<div class="crm-section">
		<div class="label">{$form.musique_instrument.label}</div>
		<div class="content">{$form.musique_instrument.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.musique_chant.label}</div>
		<div class="content">{$form.musique_chant.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.securite_sociale.label}</div>
		<div class="content">{$form.securite_sociale.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.guso.label}</div>
		<div class="content">{$form.guso.html}</div>
		<div class="clear"></div>
	</div>
	
	<div class="crm-section">
		<div class="label">{$form.fonctionnaire.label}</div>
		<div class="content">{$form.fonctionnaire.html}</div>
		<div class="clear"></div>
	</div>
	


{* FIELD EXAMPLE: OPTION 1 (AUTOMATIC LAYOUT) *}
{*<h3>Ancien formulaire</h3>
{foreach from=$elementNames item=elementName}
  <div class="crm-section">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}
*}

{* FIELD EXAMPLE: OPTION 2 (MANUAL LAYOUT)

  <div>
    <span>{$form.favorite_color.label}</span>
    <span>{$form.favorite_color.html}</span>
  </div>

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
