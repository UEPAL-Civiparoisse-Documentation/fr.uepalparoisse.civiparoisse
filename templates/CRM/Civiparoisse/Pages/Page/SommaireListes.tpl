{* RAJOUT de la feuille de style *}
{crmStyle ext="fr.uepalparoisse.civiparoisse" file="css/sommaire-pages.css"}

<p>Pour consulter une liste, cliquez sur le nom de la liste.</p>

{foreach from=$ResultsDesListes key=Groupe item=ArraySousGroupe}
  <h3>{$Groupe}</h3>
  <div class="page-liste-wrapper">
    {foreach from=$ArraySousGroupe key=SousGroupe item=ArrayLigne}
      <div class="page-liste-box">
      <h4>{$SousGroupe}</h4>
      
      {foreach from=$ArrayLigne key=Numero item=Ligne}
        <a href="{crmURL p="`$Ligne[0]`"}" target="_blank" >
          <div class="page-liste-item">
              {icon icon="`$Ligne[1]`"}{/icon} {$Ligne[2]}
          </div>
        </a>
      {/foreach}
      </div>
    {/foreach}
  </div>
{/foreach}
