<td>{{ $currval->intitule }}</td>
<td>{{ $currval->parent ? $currval->parent->chemin_complet : '' }}</td>
<td>{{ $currval->employeResponsable ? $currval->employeResponsable->nom_complet : '' }}</td>
<td>{{ $currval->typedepartement->intitule }}</td>
<td>{{ $currval->statut->libelle }}</td>
