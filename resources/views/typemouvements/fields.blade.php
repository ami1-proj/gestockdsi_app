<div class="form-group row {{ $errors->has('libelle') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Libelle</label>
    <div class="col-sm-10">
      <input name="libelle" type="text" class="form-control" placeholder="Libellé du Type de Mouvement" value="{{  old('libelle', $typemouvement->libelle ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Par Défaut ?</label>
    <div class="col-sm-10">
      <input type="checkbox" name="is_default" class="switch-input" value="1" {{ old('is_default', $typemouvement->is_default) ? 'checked="checked" disabled readonly' : '' }}/>
      <small class="text-danger">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
      <select name="statut_id" class="form-control" id="statut_id" required>
          @foreach($statuts as $id => $display)
            @if (old('statut_id') == $id)
              <option value="{{ $id }}" selected>{{ $display }}</option>
            @else
              <option value="{{ $id }}" {{ (isset($typemouvement->statut_id) && $id === $typemouvement->statut_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endif
          @endforeach
      </select>
      <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
