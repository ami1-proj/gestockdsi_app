<div class="form-group row {{ $errors->has('nom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="nom">Nom</label>
    <div class="col-sm-10">
        <input name="nom" type="text" class="form-control" placeholder="nom" value="{{ $stocklieu->nom ?? '' }}"/>
        <small class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <select name="statut_id" class="form-control" id="statut_id" required>
            @foreach($statuts as $id => $display)
                <option value="{{ $id }}" {{ (isset($stocklieus->statut_id) && $id === $stocklieus->statut_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>


@csrf