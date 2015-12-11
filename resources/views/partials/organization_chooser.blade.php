<select name="organization" class="chosen-select">
@foreach ($organizations as $organization)
	<option value="{{ $organization->id }}">{{ $organization->name }}</option>
@endforeach
</select>