{* RAJOUT de la feuille de style *}
{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/sommaire-pages.css}


<p>Pour consulter une liste, cliquez sur le nom de la liste.</p>


<h1>Nouvel affichage</h1>
{foreach from=$ResultsDesListes key=Groupe item=ArraySousGroupe}
  <h3>{$Groupe}</h3>
  <div class="page-liste-wrapper">
    {foreach from=$ArraySousGroupe key=SousGroupe item=ArrayLigne}
      <div class="page-liste-box">
      <h4>{$SousGroupe}</h4>
      
      {foreach from=$ArrayLigne key=Numero item=Ligne}
        <a href="{crmURL p="`$Ligne[0]`"}" target="_blank" >
          <div class="page-liste-item">
              {icon icon="$Ligne[1]"}{/icon} {$Ligne[2]}
          </div>
        </a>
      {/foreach}
      </div>
    {/foreach}
  </div>
{/foreach}

<h1>Ancien affichage</h1>
<h3>Groupes</h3>

<h4>Visiteurs</h4>

<ul>
  <li>{icon icon="fa-birthday-cake"}{/icon}<a href="{crmURL p="civicrm/search#/display/Civip_Anniversaires_Plus_75_ans/Civip_Anniversaires_Plus_75_ans_Table"}">Anniversaires des Personnes de plus de 75 ans</a></li>
</ul>

<h4>Jeunesse</h4>

<ul>
  <li>{icon icon="fa-birthday-cake"}{/icon}<a href="{crmURL p="civicrm/search#/display/Civip_Anniversaires_Moins_18_ans/Civip_Anniversaires_Moins_18_ans_Table"}">Anniversaires des Jeunes de moins de 18 ans</a></li>
</ul>


<h3>Membres</h3>

<h4>Paroisse</h4>

<ul>
  <li>{icon icon="fa-road"}{/icon}<a href="{crmURL p="civicrm/search#/display/Civip_Nouveaux_Arrivants/Civip_Nouveaux_Arrivants_Table"}">Liste des Nouveaux Arrivants (15 derniers mois)</a></li>
  <li>{icon icon="fa-envelope-open"}{/icon}<a href="{crmURL p="civicrm/search#/display/Civip_Liste_Electorale/Civip_Liste_Electorale_Table"}">Liste Electorale</a></li>
</ul>






