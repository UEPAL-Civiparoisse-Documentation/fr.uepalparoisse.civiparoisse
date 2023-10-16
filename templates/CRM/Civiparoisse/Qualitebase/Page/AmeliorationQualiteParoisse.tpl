<h4>Comment utiliser cette page ?</h4>
<div>Cette page vous indique les vérifications à mener pour améliorer la qualité de votre base de données.</div>
<div>Dans la mesure où vous arrivez à les obtenir, ces renseignements contribueront à une utilisation de la base de données. Il n'est cependant sans doute pas possible d'obtenir l'ensemble des renseignements demandés ci-dessous.</div>
<div>Une autre page est disponible, qui liste les corrections qu'il serait nécessaire de faire dans votre base. Cette page est <a href="{crmURL p='civicrm/controle-qualite'}">consultable en cliquant ici.</a></div>
<p></p>

<h3>Améliorations sur les fiches Individus</h3>

<!-- Affichage des Individus sans Date de Naissance -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Individus sans Date de Naissance ({$IndividuSansBirthday|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certaines fiches sont créées sans indication de la date de naissance</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Pas d'indication de l'âge sur les listes</li>
				<li>Absence des ciblages pour les actions liées aux anniversaires</li>
				<li>Mauvais renseignement sur la personne</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Cliquer sur Modifier</li>
				<li>Dans la partie Données démographiques, renseigner la date de naissance</li>
				<li>Sauvegarder</li>
			</ul>
		<h5>Liste des individus concernés</h5>
		<div>Fiches classées par date de création (plus récentes en premier)</div>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom et Prénom</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$IndividuSansBirthday item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
	</div>
</div>
<p> </p>

<h3>Améliorations sur les fiches Foyers</h3>

<!-- Affichage des Foyers n'ayant pas d'adresse -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Foyers n'ayant pas d'adresse ({$FoyerSansAdresse|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certaines fiches Foyer n'ont pas d'adresses.</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Impossibilité de communiquer avec les Individus composant le Foyer</li>
				<li>Mauvais renseignements sur le Foyer</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Dans la fiche, cliquer sur Ajouter une adresse</li>
				<li>Renseigner l'adresse du Foyer</li>
				<li>Enregistrer</li>
			</ul>
		<h5>Liste des foyers concernés</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom du Foyer</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$FoyerSansAdresse item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
	</div>
</div>

<!-- Affichage des Foyers ayant participés à un Evenement -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Foyers ayant participés à un Evénement ({$FoyerEvenement|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Un Foyer est parfois enregistré par erreur dans un Evénement, parfois à la place d'un Individu appartenant au Foyer</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Comptage faussée de la participation à l'Evénement</li>
				<li>Mauvaise trace historique de l'activité du Foyer avec la paroisse</li>
				<li>Eventuellement, mauvaise trace historique de l'activité du Foyer avec la paroisse</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Cliquer sur l'onglet Evénement de la fiche</li>
				<li>Cliquer sur le bouton 'Plus' au bout de la ligne de l'événement.</li>
				<li>Cliquer sur Supprimer, et Confirmer la suppression.</li>
				<li>Si besoin, inscrire l'Individu à l'Evénement concerné.</li>
			</ul>
		<h5>Liste des foyers concernés</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom du Foyer</th>
						<th>Evénement</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$FoyerEvenement item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
							<td>{$row[2]}</td>
						</tr>
					{/foreach}
			  </tbody>
			</table>
	</div>
</div>

<!-- Affichage des Foyers dont le Mode de Distribution est Inconnu -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Foyers dont le mode de distribution du Journal est inconnu ({$FoyerDistributionInconnu|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certains Foyers ont un mode de distribution du journal indiqué comme Inconnu</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Incertitude sur le souhait du Foyer quand à la réception du journal</li>
				<li>Erreurs de ciblage et de distributions</li>
				<li>Potentiellement, insatisfaction des paroissiens ne recevant du coup pas les informations sur la paroisse</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Aller en bas de la fiche, dans la partie Informations Supplémentaires</li>
				<li>Cliquer sur la case grise à droite de 'Mode de distribution du journal'</li>
				<li>Choisir dans la liste déroulante le mode de distribution souhaité</li>
				<li>Si le mode de distribution n'est pas connu, cliquer sur 'Inconnu'</li>
				<li>Cliquer sur Enregistrer</li>
			</ul>
		<h5>Liste des foyers concernés</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom du Foyer</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$FoyerDistributionInconnu item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
			  </tbody>
			</table>
	</div>
</div>


<p> </p>




<h3>Améliorations sur les fiches Organisations</h3>

<!-- Affichage des Organisations n'ayant pas d'adresse -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Organisations n'ayant pas d'adresse ({$OrganisationSansAdresse|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certaines fiches Organisation n'ont pas d'adresses.</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Impossibilité de communiquer avec l'Organisation</li>
				<li>Mauvais renseignements sur l'Organisation'</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Dans la fiche, cliquer sur Ajouter une adresse</li>
				<li>Renseigner l'adresse de l'Organisation</li>
				<li>Enregistrer</li>
			</ul>
		<h5>Liste des organisations concernées</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom de l'Organisation</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$OrganisationSansAdresse item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
	</div>
</div>

<!-- Affichage des Organisations n'ayant pas de relation  -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Organisations n'ayant pas de relation ({$OrganisationSansRelation|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certaines fiches Organisations n'ont pas de Relations </li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Pas de lien clair entre les Individus et les Organisations</li>
				<li>Pas d'identification claire sur les Interlocuteurs de l'Organisation</li>
				<li>Erreurs de ciblage</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Cliquer sur l'onglet Relation de la fiche</li>
				<li>Cliquer sur Ajouter une Relation</li>
				<li>Choisir le Type de Relation approprié</li>
				<li>Dans l'entrée Contacts, choisir la (les) Individu(s) concernée(s)</li>
				<li>Cliquer sur Enregistrer la relation</li>
				<li>Ajouter autant de relations qu'il y a d'Individus en contact avec l'Organisationdans le Foyer</li>
			</ul>
		<h5>Liste des organisations concernées</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom de l'Organisation</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$OrganisationSansRelation item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
	</div>
</div>


<!-- Affichage des Organisations ayant participées à un Evenement -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
	<div class="crm-accordion-header">Organisations ayant participées à un Evénement ({$OrganisationEvenement|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Une Organisation est parfois enregistré par erreur dans un Evénement</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Comptage faussée de la participation à l'Evénement</li>
				<li>Mauvaise trace historique de l'activité de l'Organisation avec la paroisse</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Cliquer sur l'onglet Evénement de la fiche</li>
				<li>Cliquer sur le bouton 'Plus' au bout de la ligne de l'événement.</li>
				<li>Cliquer sur Supprimer, et Confirmer la suppression.</li>
			</ul>
		<h5>Liste des organisations concernées</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom de l'Organisation</th>
						<th>Evénement</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$OrganisationEvenement item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
							<td>{$row[2]}</td>
						</tr>
					{/foreach}
			  </tbody>
			</table>
	</div>
</div>
