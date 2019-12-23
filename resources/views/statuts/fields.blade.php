<div class="form-group row {{ $errors->has('libelle') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Libelle</label>
    <div class="col-sm-10">
      <input name="libelle" type="text" class="form-control" placeholder="Libellé du Statut" value="{{  old('nom', $statut->libelle ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Par Défaut ?</label>
    <div class="col-sm-10">
      <input type="checkbox" name="is_default" class="switch-input" value="1" {{ old('is_default', $statut->is_default) ? 'checked="checked" disabled readonly' : '' }}/>
      <small class="text-danger">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</small>
    </div>
</div>

@csrf
