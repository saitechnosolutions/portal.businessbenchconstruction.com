<option value="" disabled>Select District Code</option>
@foreach ($districtCodes as $key => $districtCode)
    @if ($key == 0)
        <option selected value="{{ $districtCode }}">{{ $districtCode }}</option>
    @else
        <option value="{{ $districtCode }}">{{ $districtCode }}</option>
    @endif
@endforeach
