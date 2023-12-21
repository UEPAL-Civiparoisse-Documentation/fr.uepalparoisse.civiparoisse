{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/sommaire-pages.css}

<h4>Comment utiliser cette page ?</h4>
<div><i class="crm-i fa-ambulance fa-2x" aria-hidden="true"></i>Cette page vous indique les <strong>corrections à effectuer</strong> pour améliorer la qualité de votre base de données. Nous vous conseillons de les effectuer très régulièrement, pour vous assurer une utilisation optimale de CiviParoisse.</div>
<p></p>
<div><i class="crm-i fa-stethoscope fa-2x" aria-hidden="true"></i>Une autre page, qui liste les <strong>améliorations</strong> qu'il serait possible de faire dans votre base, est <a href="{crmURL p='civicrm/amelioration-qualite'}" target="_blank">consultable en cliquant ici.</a></div>
<p></p>


<h1>Nouvelle méthode d'affichage</h1>
{foreach from=$ResultsDesControles key=categorie item=row}
  <h4>{$categorie}</h4>
  <div class="page-qualite-wrapper">
    {foreach from=$row item=ligne}
      {if $ligne[1] > 0}
        <div class ="page-qualite-box resultat-qualite-ko">
      {else}
        <div class ="page-qualite-box resultat-qualite-ok"> 
      {/if}      
        <a href="{crmURL p="`$ligne[0]`"}" target="_blank" >
          <div class="page-qualite-resultat">{$ligne[1]}</div>
          <div class="page-qualite-item">{$ligne[2]}</div>
        </a>
      </div>
    {/foreach}
  </div>
{/foreach}


<h1>Ancienne méthode d'affichage</h1>
<h3>Corrections sur les fiches Individus</h3>

<!-- Affichage des Individus sans Genre -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus sans Genre ({$IndividuSansGenre|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches sont créées sans indication du genre de l’Individu</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Erreurs de ciblage</li>
        <li>Mauvais renseignement sur la personne</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Editer les Données Démographiques, pour renseigner le genre</li>
        <li>Sauvegarder</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
        <tr>
          <th>Identifiant CiviCRM</th>
          <th>Nom et Prénom</th>
        </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuSansGenre item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Individus sans Civilité -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus sans Civilité ({$IndividuSansCivilite|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches sont créées sans indication de la civilité de l’Individu</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Mauvaise indication de la civilité sur les communications écrites</li>
        <li>Erreurs de ciblage</li>
        <li>Mauvais renseignement sur la personne</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur Modifier</li>
        <li>Dans la partie Fiche Contact, renseigner le bon choix dans la Civilité</li>
        <li>Sauvegarder</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuSansCivilite item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Individus sans Statut Membre -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus sans Statut Membre ({$IndividuSansStatutMembre|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches sont créées sans indication du Statut Membre</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Pas d'indication sur le lien avec la Paroisse</li>
        <li>Erreurs de ciblage lors des communications</li>
        <li>Mauvaise connaissance de la personne</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Adhesion</li>
        <li>Cliquer sur Ajouter une Adhesion</li>
        <li>Dans la fenêtre Créer Adhésion, choisir un des statuts Membre</li>
        <li>Indiquer une date de début de l'adhesion</li>
        <li>Enregistrer</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuSansStatutMembre item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Individus sans Lien Foyer ou Organisation -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">

	<div class="crm-accordion-header">Individus sans lien avec un Foyer ou une Organisation ({$IndividuSansLienFoyerOrganisation|@count} fiches à contrôler)</div>
	<div class="crm-accordion-body">
		<h5>Contexte</h5>
			<ul>
				<li>Certaines fiches Individus sont créées sans Relation avec un Foyer ou une Organisation</li>
			</ul>
		<h5>Risques</h5>
			<ul>
				<li>Pas d'indication d'une Relation de l'Individu avec d'autres Foyers ou Organisations</li>
				<li>Erreurs de ciblage</li>
				<li>Erreurs dans les Rapports</li>
				<li>Mauvais renseignement sur la personne</li>
			</ul>
		<h5>Actions à mener</h5>
			<ul>
				<li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
				<li>Cliquer sur l'onglet Relations</li>
				<li>Cliquer sur Ajouter une Relation</li>
				<li>Dans la fenêtre Ajouter une Relation, choisir un Type de Relation (avec un Foyer ou une Organisation)</li>
				<li>Choisir le Contact avec lequel mettre la Relation en place</li>
				<li>Enregistrer</li>
			</ul>
		<h5>Liste des individus concernés</h5>
			<table class="report-layout display">
				<thead>
					<tr>
						<th>Identifiant CiviCRM</th>
						<th>Nom et Prénom</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$IndividuSansLienFoyerOrganisation item=row}
						<tr class="{cycle values="odd-row,even-row"}">
							<td>{$row[0]}</td>
							<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
	</div>
</div>

<!-- Affichage des Individus de plus de 18 ans ayant le Statut Inscrit Enfant -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus de plus de 18 ans ayant encore le Statut 'Inscrit Enfant' ({$IndividuEncoreStatutEnfant|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines Individus ont encore un statut "Enfant" alors qu'ils ont atteint leur majorité</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Erreurs de ciblage</li>
        <li>Erreur sur le lien avec la Paroisse</li>
        <li>Mauvais renseignement sur la personne</li>
        <li>Erreurs sur la composition de la liste électorale</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Adhesion</li>
        <li>Cliquer sur Modifier sur la ligne de l'adhésion en cours</li>
        <li>Mémoriser la date "Membre depuis"</li>
        <li>Dans Date d'expiration de l'adhésion, indiquer la date d'aujourd'hui</li>
        <li>Enregistrer</li>
        <li>Cliquer sur Ajouter une Adhesion</li>
        <li>Dans la fenêtre Créer Adhésion, choisir le statut Membre approprié à la situation de l'Individu</li>
        <li>Pour la date Membre depuis, reprendre la date mémorisée ci-dessus</li>
        <li>Indiquer une date de début de l'adhesion</li>
        <li>Enregistrer</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuEncoreStatutEnfant item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Individus ayant le Statut Enfant (ou l'âge) et une Relation Chef de Famille -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus Enfant ayant une Relation Chef de Famille ({$IndividuEnfantChefFamille|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches ont un Statut Enfant et une Relation Chef de Famille, ce qui est incompatible</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Erreurs de ciblage</li>
        <li>Mauvais renseignement sur la personne</li>
        <li>Erreur de composition de la liste Electorale</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Adhesion</li>
        <li>Cliquer sur Modifier sur la ligne de l'adhésion en cours</li>
        <li>Mémoriser la date "Membre depuis"</li>
        <li>Dans Date d'expiration de l'adhésion, indiquer la date d'aujourd'hui</li>
        <li>Enregistrer</li>
        <li>Cliquer sur Ajouter une Adhesion</li>
        <li>Dans la fenêtre Créer Adhésion, choisir le statut Membre approprié à la situation de l'Individu</li>
        <li>Pour la date Membre depuis, reprendre la date mémorisée ci-dessus</li>
        <li>Indiquer une date de début de l'adhesion</li>
        <li>Enregistrer</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuEnfantChefFamille item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Individus de plus de 27 ans encore rattaché au Foyer de leurs parents -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Individus de plus de 27 ans encore rattaché au Foyer de leurs parents ({$IndividuDansFoyerParents|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines personnes, âgées de plus de 27 ans, sont encore rattachées au foyer de leurs parents</li>
        <li>A cette âge-là, il est fort probable qu'ils n'habitent plus chez leurs parents</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Erreurs de ciblage</li>
        <li>Mauvais renseignement sur la personne</li>
        <li>Erreur de composition des Foyers</li>
        <li>Mauvais suivi du jeune</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Relation</li>
        <li>Sur la ligne "Membre du foyer", cliquer sur 'Plus' puis sur 'Desactiver'</li>
        <li>Confirmer la désactivation</li>
        <li>IMPORTANT : il faut ensuite créer un nouveau Foyer au nom de la personne, et rattacher la ficher Invididu à ce nouveau Foyer.</li>
        <li>Pour créer le nouveau Foyer, utiliser le formulaire de création d'une nouvelle fiche Foyer</li>
        <li>Puis aller sur la fiche Individu, et cliquer sur l'onglet Relation</li>
        <li>Cliquer sur Ajouter une relation</li>
        <li>Choisir le type de relation "Membre du Foyer"</li>
        <li>A la ligne Contacts, choisir le nouveau Foyer crée précédemment.</li>
        <li>Enregistrer</li>
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
            <th>Date de naissance</th>
            <th>Foyer d'appartenance</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$IndividuDansFoyerParents item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
              <td>{$row[2]|date_format:"%d %B %Y "}</td>
              <td>{$row[3]}</td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>


<p> </p>

<h3>Corrections sur les fiches Foyers</h3>

<!-- Affichage des Foyers ayant un Statut Membre -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Foyers ayant le statut Membre ({$FoyerAvecMembre|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Le statut de Membre est parfois mis par erreur sur une fiche Foyer</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Comptabilisation erronée des Membres</li>
        <li>Oubli du statut Membre sur les fiches Individu</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Adhésion de la fiche</li>
        <li>Cliquer sur Renouveler sur la liste déroulante, et choisir Supprimer</li>
        <li>Par précaution, vérifier que toutes les fiches Individus du Foyer aient bien un statut Membre</li>
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
          {foreach from=$FoyerAvecMembre item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>


<!-- Affichage des Foyers n'ayant pas de relations -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Foyers n'ayant pas de relations ({$FoyerSansRelation|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches Foyer n'ont pas de Relations Chef de famille ou Membre du Foyer*</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Pas de lien entre les Individus et leur Foyer</li>
        <li>Erreurs de ciblage</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Relation de la fiche</li>
        <li>Cliquer sur Ajouter une Relation</li>
        <li>Choisir le Type de Relation 'a pour Chef de famille' ou 'a pour Membre du Foyer'</li>
        <li>Dans l'entrée Contacts, choisir la (les) Individu(s) concernée(s)</li>
        <li>Cliquer sur Enregistrer la relation</li>
        <li>Ajouter autant de relations qu'il y a d'Individus dans le Foyer</li>
        <li>RAPPEL : un Individu 'Chef de Famille' doit aussi être enregistré comme 'Membre du Foyer'</li>
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
          {foreach from=$FoyerSansRelation item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Foyers n'ayant pas de relation Chef de Famille -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Foyers n'ayant pas de relation Chef de Famille ({$FoyerSansChefFamille|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches Foyer n'ont pas de Relations Chef de famille</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Pas de lien clair entre les Individus et leur Foyer</li>
        <li>Pas d'identification claire sur la composition du Foyer</li>
        <li>Erreurs de ciblage</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Relation de la fiche</li>
        <li>Cliquer sur Ajouter une Relation</li>
        <li>Choisir le Type de Relation 'a pour Chef de famille'</li>
        <li>Dans l'entrée Contacts, choisir la (les) Individu(s) concernée(s)</li>
        <li>Cliquer sur Enregistrer la relation</li>
        <li>Ajouter autant de relations qu'il y a d'Individus dans le Foyer</li>
        <li>RAPPEL : un Individu 'Chef de Famille' doit aussi être enregistré comme 'Membre du Foyer'</li>
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
          {foreach from=$FoyerSansChefFamille item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<!-- Affichage des Foyers n'ayant pas de relation Membre du Foyer -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Foyers n'ayant pas de relation Membre du Foyer ({$FoyerSansMembreFoyer|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches Foyer n'ont pas de Relations Membre du Foyer</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Pas de lien clair entre les Individus et leur Foyer</li>
        <li>Pas d'identification claire sur la composition du Foyer</li>
        <li>Erreurs de ciblage</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Relation de la fiche</li>
        <li>Cliquer sur Ajouter une Relation</li>
        <li>Choisir le Type de Relation 'a pour Membre du Foyer'</li>
        <li>Dans l'entrée Contacts, choisir la (les) Individu(s) concernée(s)</li>
        <li>Cliquer sur Enregistrer la relation</li>
        <li>Ajouter autant de relations qu'il y a d'Individus dans le Foyer</li>
        <li>RAPPEL : un Individu 'Membre du Foyer' doit aussi être enregistré comme 'Chef de Famille'</li>
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
          {foreach from=$FoyerSansMembreFoyer item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>


<!-- Affichage des Foyers n'ayant pas de Mode de distribution du Journal renseigné -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Foyers n'ayant pas de Mode de distribution du journal ({$FoyerModeDistribution|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Certaines fiches Foyer n'ont pas de renseignements sur le mode de distribution du journal</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Incertitude sur le souhait du Foyer quand à la réception du journal</li>
        <li>Erreurs de ciblage et de distributions</li>
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
          {foreach from=$FoyerModeDistribution item=row}
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


<h3>Corrections sur les fiches Organisations</h3>

<!-- Affichage des Organisations ayant un Statut Membre -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">Organisations ayant le statut Membre ({$OrganisationAvecMembre|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>Le statut de Membre est parfois mis par erreur sur une fiche Organisation</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Comptabilisation erronée des Membres</li>
        <li>Oubli du statut Membre sur les fiches Individu</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Cliquer sur l'onglet Adhésion de la fiche</li>
        <li>Cliquer sur Renouveler sur la liste déroulante, et choisir Supprimer</li>
        <li>Par précaution, et si nécessaire, vérifier que toutes les fiches Individus de l'Organisation aient un statut Membre</li>
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
          {foreach from=$OrganisationAvecMembre item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>      
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>

<h3>Corrections sur les adresses mails</h3>

<!-- Affichage des Emails en statut Erreur -->
<div class="crm-accordion-wrapper crm-ajax-accordion collapsed">
  <div class="crm-accordion-header">E-mails en statut Erreurs ({$EMailErreurs|@count} fiches à contrôler)</div>
  <div class="crm-accordion-body">
    <h5>Contexte</h5>
      <ul>
        <li>A CHANGER Certains mails sont indiqués comme erronés ou bloqués dans la base de données.</li>
        <li>Cela fait suite soit à un problème sur l'adresse mail, soit à une action de la personne pour ne plus recevoir nos mails</li>
      </ul>
    <h5>Risques</h5>
      <ul>
        <li>Non réception des communications envoyées par la paroisse</li>
        <li>Absence d'information sur les activités proposeés</li>
        <li>Perte de contact avec la personne</li>
        <li>Sentiment de non-appartenance à la communauté</li>
      </ul>
    <h5>Actions à mener</h5>
      <ul>
        <li>Cliquer sur le lien pour ouvrir la fiche dans un nouvel onglet</li>
        <li>Dans le champ Courriel apparait la raison du blocage</li>
        <li>L'indication "Suspendue - exclusion des mailings" indique que l'Individu ne souhaite plus recevoir les mails de la paroisse. Si cela est avéré, effectuer les actions suivantes</li>
        <ul>
          <li>En cliquant sur Ajouter ou modifier adresse électronique, supprimer l'e-mail</li>
          <li>En cliquant sur Modifier les préférences de communication, cocher la case Ne pas envoyer de courriel</li>
          <li>Eventuellement, si la situation le justifie, supprimer l'ensemble de la fiche Individu, ainsi que le Foyer associé</li>
          <li>Si l'individu souhaite tout de même continuer à recevoir les mails de la paroisse, cliquer sur Ajouter ou modifier adresse électronique, sélectionner le menu déroulant Invalide et cliquer sur la première ligne (- sélectionner-), puis Enregistrer. Puis dans Modifier les préférences de communication, veiller à ce que la ligne Utilisateur s'exclu des mailings ne soit pas cochée</li>
        </ul>
        <li>L'indication "Invalide" indique que l'e-mail n'est plus valable (les causes en sont multiples : boite aux lettres fermée ou pleine, erreur dans l'adresse mail, ...</li>
        <ul>
          <li>En cliquant sur Ajouter ou modifier adresse électronique, inscrire la bonne adresse e-mail</li>
          <li>En cliquant sur Modifier les préférences de communication, cocher la case Ne pas envoyer de courriel</li>
          <li>Eventuellement, si la situation le justifie, supprimer l'ensemble de la fiche Individu, ainsi que le Foyer associé</li>
          <li>Si l'individu souhaite tout de même continuer à recevoir les mails de la paroisse, cliquer sur Ajouter ou modifier adresse électronique, sélectionner le menu déroulant Invalide et cliquer sur la première ligne (- sélectionner-), puis Enregistrer. Puis dans Modifier les préférences de communication, veiller à ce que la ligne Utilisateur s'exclu des mailings ne soit pas cochée</li>
        </ul>       
      </ul>
    <h5>Liste des individus concernés</h5>
      <table class="report-layout display">
        <thead>
          <tr>
            <th>Identifiant CiviCRM</th>
            <th>Nom et Prénom</th>
            <th>Adresse mail en erreur</th>
            <th>Date de l'erreur</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$EMailErreurs item=row}
            <tr class="{cycle values="odd-row,even-row"}">
              <td>{$row[0]}</td>
              <td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row[0]`"}" target="_blank">{$row[1]}</a></td>
              <td>{$row[2]}</td>
              <td>{$row[3]|date_format:"%d %B %Y "}</td>
            </tr>
          {/foreach}
        </tbody>
      </table>
  </div>
</div>