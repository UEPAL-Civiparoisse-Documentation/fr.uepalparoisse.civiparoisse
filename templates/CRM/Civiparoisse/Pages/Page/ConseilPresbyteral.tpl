<h4>Paroisse de XXXXXX</h4>

<h3>Bureau du Conseil Presbytéral</h3>
	<table class="report-layout display">
    	<thead>
			<tr>
				<th>Rôle</th>
				<th>Identité</th>
				<th>Mandat actuel : début</th>
				<th>Mandat actuel : fin</th>
				<th>Mandats antérieurs</th>
				<th>Courriel</th>
				<th>Téléphone</th>
				<th>Adresse</th>
				<th>Date de naissance</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$CPBureau item=row}
				<tr class="{cycle values="odd-row,even-row"}">
					<td>{$row.role}</td>
					<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row.id`"}" target="_blank">{$row.name}</a></td>
					{if $row.start_date|strstr:"/"}
						<td>{$row.start_date}</td>
					{else}
						<td>{$row.start_date|date_format:"%d %B %Y"}</td>
					{/if}
					{if $row.end_date|strstr:"/"}
						<td>{$row.end_date}</td>
					{else}
						<td>{$row.end_date|date_format:"%d %B %Y"}</td>
					{/if}
					<td>{$row.end_date}</td>
					<td>{$row.ex_relationships}</td>
					<td>{$row.email}</td>
					<td>{$row.phone}</td>
					<td>{$row.address}</td>
					<td>{$row.birth_date|date_format:"%d %B %Y"}</td>
				</tr>
			{/foreach}
		</tbody>
  	</table>
<p>&nbsp;</p>





<h3>Membres de droit</h3>
	<table class="report-layout display">
		<thead>
			<tr>
				<th>Rôle</th>
				<th>Identité</th>
				<th>Mandat actuel : début</th>
				<th>Mandat actuel : fin</th>
				<th>Mandats antérieurs</th>
				<th>Courriel</th>
				<th>Téléphone</th>
      			<th>Adresse</th>
				<th>Date de naissance</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$CPMembreDroit item=row}
				<tr class="{cycle values="odd-row,even-row"}">
					<td>{$row.role}</td>
					<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row.id`"}" target="_blank">{$row.name}</a></td>
					{if $row.start_date|strstr:"/"}
						<td>{$row.start_date}</td>
					{else}
						<td>{$row.start_date|date_format:"%d %B %Y"}</td>
					{/if}
					{if $row.end_date|strstr:"/"}
						<td>{$row.end_date}</td>
					{else}
						<td>{$row.end_date|date_format:"%d %B %Y"}</td>
					{/if}
					<td>{$row.ex_relationships}</td>
					<td>{$row.email}</td>
					<td>{$row.phone}</td>
					<td>{$row.address}</td>
					<td>{$row.birth_date|date_format:"%d %B %Y"}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
<p>&nbsp;</p>



<h3>Membres élus</h3>
	<table class="report-layout display">
		<thead>
			<tr>
				<th>Rôle</th>
				<th>Identité</th>
				<th>Mandat actuel : début</th>
				<th>Mandat actuel : fin</th>
				<th>Mandats antérieurs</th>
				<th>Courriel</th>
				<th>Téléphone</th>
				<th>Adresse</th>
				<th>Date de naissance</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$CPMembreElu item=row}
				<tr class="{cycle values="odd-row,even-row"}">
					<td>{$row.role}</td>
					<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row.id`"}" target="_blank">{$row.name}</a></td>
					{if $row.start_date|strstr:"/"}
						<td>{$row.start_date}</td>
					{else}
						<td>{$row.start_date|date_format:"%d %B %Y"}</td>
					{/if}
					{if $row.end_date|strstr:"/"}
						<td>{$row.end_date}</td>
					{else}
						<td>{$row.end_date|date_format:"%d %B %Y"}</td>
					{/if}
					<td>{$row.ex_relationships}</td>
					<td>{$row.email}</td>
					<td>{$row.phone}</td>
					<td>{$row.address}</td>
					<td>{$row.birth_date|date_format:"%d %B %Y"}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
<p>&nbsp;</p>



<h3>Membres invités</h3>
	<table class="report-layout display">
		<thead>
			<tr>
				<th>Rôle</th>
				<th>Identité</th>
				<th>Mandat actuel : début</th>
				<th>Mandat actuel : fin</th>
				<th>Mandats antérieurs</th>
				<th>Courriel</th>
				<th>Téléphone</th>
				<th>Adresse</th>
				<th>Date de naissance</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$CPMembreInvite item=row}
				<tr class="{cycle values="odd-row,even-row"}">
					<td>{$row.role}</td>
					<td><a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=`$row.id`"}" target="_blank">{$row.name}</a></td>
					{if $row.start_date|strstr:"/"}
						<td>{$row.start_date}</td>
					{else}
						<td>{$row.start_date|date_format:"%d %B %Y"}</td>
					{/if}
					{if $row.end_date|strstr:"/"}
						<td>{$row.end_date}</td>
					{else}
						<td>{$row.end_date|date_format:"%d %B %Y"}</td>
					{/if}
					<td>{$row.ex_relationships}</td>
					<td>{$row.email}</td>
					<td>{$row.phone}</td>
					<td>{$row.address}</td>
					<td>{$row.birth_date|date_format:"%d %B %Y"}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
<p>&nbsp;</p>


<h3>Comment utiliser ce document ?</h3>
	<h4>Quelles informations devraient figurer sur ce document ?</h4>
<div>Sur ce document devrait figurer la composition complète du Conseil Presbytéral :</div>
	<ul>
		<li>Membres du Bureau : Président·e, Vice-Président·e, Secrétaire, Trésorier·ère</li>
		<li>Membres de droit : les pasteurs, vicaires, diacres</li>
		<li>Membres élus : les paroissiens élus</li>
		<li>Membres invités (s'il y en a) : le receveur, les paroissiens invités au CP</li>
	</ul>
<div>Pour chacune de ces personnes, il faut indiquer :</div>
	<ul>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	<p>&nbsp;</p>
	<h4>Que faire s'il manque des informations ?</h4>

	<p>&nbsp;</p>

	<h4>Comment faire pour transmettre les informations au Quai Saint Thomas ?</h4>
	<p>&nbsp;</p>
	
