<td>{{ $currval->nom_complet }}</td>
<td>{{ $currval->matricule }}</td>
<td>{{ $currval->fonction->intitule }}</td>
<td class="">{{ $currval->departement ? $currval->departement->chemin_complet : '' }}</td>
<td style="width:1px; whithe-space:nowrap">
  <span class="badge label-primary">{{ $currval->phonenums->first()->numero }}</span>
</td>
<td style="width:1px; whithe-space:nowrap">
  <span class="badge label-primary">{{ $currval->adresseemails->first()->email }}</span>
</td>
