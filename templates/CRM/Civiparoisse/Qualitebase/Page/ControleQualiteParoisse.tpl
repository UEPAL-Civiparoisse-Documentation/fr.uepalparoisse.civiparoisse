{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/sommaire-pages.css}

<h4>Comment utiliser cette page ?</h4>
<div><i class="crm-i fa-ambulance fa-2x" aria-hidden="true"></i>Cette page vous indique les <strong>corrections à effectuer</strong> pour améliorer la qualité de votre base de données. Nous vous conseillons de les effectuer très régulièrement, pour vous assurer une utilisation optimale de CiviParoisse.</div>
<p></p>
<div><i class="crm-i fa-stethoscope fa-2x" aria-hidden="true"></i>Une autre page, qui liste les <strong>améliorations</strong> qu'il serait possible de faire dans votre base, est <a href="{crmURL p='civicrm/amelioration-qualite'}" target="_blank">consultable en cliquant ici.</a></div>

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
