{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/sommaire-pages.css}

<h4>Comment utiliser cette page ?</h4>
<div><i class="crm-i fa-stethoscope fa-2x" aria-hidden="true"></i>Cette page vous indique les <strong>vérifications à mener</strong> pour améliorer la qualité de votre base de données. Si vous pouvez obtenir ces renseignements, ils  contribueront à une optimisation de votre base de données.</div>
<p></p>
<div><i class="crm-i fa-ambulance fa-2x" aria-hidden="true"></i>Une autre page, qui liste les <strong>corrections</strong> qu'il serait nécessaire de faire dans votre base, est <a href="{crmURL p='civicrm/controle-qualite'}" target="_blank">consultable en cliquant ici.</a></div>

{foreach from=$ResultsDesAmeliorations key=categorie item=row}
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
