{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/formulaires.css}

{* HEADER *}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

<h3>Saisie des informations sur l'Entreprise (ou l'Organisation)</h3>
	<div class="form-pretexte">Saisir en MAJUSCULES l'ensemble du nom</div>
	<div class="crm-section">
		<div class="label">{$form.organization_name.label}</div>
		<div class="content">{$form.organization_name.html}</div>
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

	<div class="form-pretexte">Saisir en respectant le format international (exemple : +33 3 88 89 90 91). Mettre des espaces entre les numéros, et pas des points. SI BESOIN de saisir d'autres numéros, le faire après la création de la fiche, en allant la modifier.</div>
	<div class="crm-section">
		<div class="label">{$form.phone.label}</div>
		<div class="content">{$form.phone.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.fax.label}</div>
		<div class="content">{$form.fax.html}</div>
		<div class="clear"></div>
	</div>

	<div class="form-pretexte">Saisir le mail générique de l'Entreprise / l'Organisation (ex. contact@entreprise.com). Les adresses mails personnalisées (ex. prenom.nom@entreprise.com) sont à saisir au niveau de l'Individu.</div>
	<div class="crm-section">
		<div class="label">{$form.email_work.label}</div>
		<div class="content">{$form.email_work.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.web_site.label}</div>
		<div class="content">{$form.web_site.html}</div>
		<div class="clear"></div>
	</div>

	<div class="crm-section">
		<div class="label">{$form.tags.label}</div>
		<div class="content">{$form.tags.html}</div>
		<div class="clear"></div>
	</div>

	<div>Après avoir cliqué sur le bouton "Enregistrer", vous serez dirigé vers le formulaire de saisie des Individus, où vous pourrez créer chaque Individu rattaché à l'Entreprise (ou Organisation).</div>


{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
