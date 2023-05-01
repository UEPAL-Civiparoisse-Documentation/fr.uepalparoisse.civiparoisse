{crmStyle ext=fr.uepalparoisse.civiparoisse file=css/sommaire-civiparoisse.css}

<div class="page-sommaire-wrapper">
	{foreach from=$PageSommaireCiviParoisse key=k item=row}
	<div class ="page-sommaire-box">
		<a href="{crmURL p="`$row.URL`"}">
			<div><img src="{crmResURL ext=fr.uepalparoisse.civiparoisse file=$row.Logo}" alt="{$row.Titre}" /></div>
			<div>{$row.Titre}</div>
		</a>
	</div>
	{/foreach}
</div>



