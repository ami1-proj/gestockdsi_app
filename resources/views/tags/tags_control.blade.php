<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="form-group row {{ $errors->has('tag') ? 'has-error' : '' }}">
            <label class="col-form-label col-md-2" for="tag">Tag</label>
            <div class="col-sm-10">
              <select class="form-control" name="tags[]" id="tag" style="width:100%" multiple="multiple">
                @if(isset($selectedtags))
                  @forelse ($selectedtags as $id => $display)
                      <option value="{{ $id }}" selected>{{ $display }}</option>
                  @empty
                  @endforelse
                @endif
              </select>
              <small class="text-danger">{{ $errors->has('tag') ? $errors->first('tag') : '' }}</small>
            </div>
        </div>

    </div>
</div>
