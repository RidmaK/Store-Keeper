<div class="form-group">
  <select class="form-control" id="stage_{{ $pns->id }}" name="stage_{{ $pns->id }}" onchange="setStage({{ $pns->id }})">
      @foreach (config('constants.stages') as $key => $stage)
      <option value="{{ $key }}" {{ $pns->stage == $key ? 'selected' : '' }}>{{ $stage }}</option>
      @endforeach
  </select>
</div>
