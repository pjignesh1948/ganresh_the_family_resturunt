@php
    $staffModel = $staff ?? null;
    $states = config('india_locations.states', []);
    $citiesByState = config('india_locations.cities', []);
    $selectedState = old('state', $staffModel->state ?? 'Gujarat');
    $selectedCity = old('city', $staffModel->city ?? '');
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $staffModel->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Role</label>
        <input type="text" name="role" class="form-control" value="{{ old('role', $staffModel->role ?? '') }}" placeholder="e.g. Chef, Waiter">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $staffModel->phone ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $staffModel->email ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">State</label>
        <select name="state" id="staffState" class="form-select">
            <option value="">Select State</option>
            @foreach($states as $state)
                <option value="{{ $state }}" {{ $selectedState === $state ? 'selected' : '' }}>{{ $state }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">City</label>
        <select name="city" id="staffCity" class="form-select">
            <option value="">Select City</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Joining Date</label>
        <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', isset($staffModel->joining_date) ? $staffModel->joining_date?->format('Y-m-d') : '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Monthly Salary</label>
        <input type="number" name="monthly_salary" class="form-control" value="{{ old('monthly_salary', $staffModel->monthly_salary ?? 0) }}" step="0.01" min="0">
    </div>
    <div class="col-md-6">
        <label class="form-label">Aadhar Card Number</label>
        <input type="text" name="aadhar_number" class="form-control" value="{{ old('aadhar_number', $staffModel->aadhar_number ?? '') }}" maxlength="12" pattern="[0-9]{12}" inputmode="numeric" placeholder="12 digit number">
    </div>
    <div class="col-md-6">
        <label class="form-label">Staff Photo</label>
        @if(!empty($staffModel?->photo))
            <div class="mb-2">
                <img src="@media($staffModel->photo)" height="80" class="rounded object-fit-cover" alt="{{ $staffModel->name }}" onerror="this.src='{{ asset('images/logo-icon.png') }}'">
            </div>
        @endif
        <input type="file" name="photo" class="form-control" accept="image/*">
    </div>
    <div class="col-md-6">
        <label class="form-label">Aadhar Card Image</label>
        @if(!empty($staffModel?->aadhar_card))
            <div class="mb-2">
                <img src="@media($staffModel->aadhar_card)" height="80" class="rounded object-fit-cover" alt="Aadhar card" onerror="this.src='{{ asset('images/logo-icon.png') }}'">
            </div>
        @endif
        <input type="file" name="aadhar_card" class="form-control" accept="image/*">
    </div>
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $staffModel->notes ?? '') }}</textarea>
    </div>
    <div class="col-12 form-check">
        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $staffModel->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>
</div>

@push('scripts')
<script>
(function(){
    const citiesByState = @json($citiesByState);
    const stateSelect = document.getElementById('staffState');
    const citySelect = document.getElementById('staffCity');
    const selectedCity = @json($selectedCity);

    function fillCities(keepSelected) {
        if (!stateSelect || !citySelect) return;
        const state = stateSelect.value;
        const cities = citiesByState[state] || ['Other'];
        citySelect.innerHTML = '<option value="">Select City</option>';
        cities.forEach(function(city) {
            const opt = document.createElement('option');
            opt.value = city;
            opt.textContent = city;
            if (keepSelected && city === selectedCity) opt.selected = true;
            citySelect.appendChild(opt);
        });
        if (keepSelected && selectedCity && !cities.includes(selectedCity)) {
            const custom = document.createElement('option');
            custom.value = selectedCity;
            custom.textContent = selectedCity;
            custom.selected = true;
            citySelect.appendChild(custom);
        }
    }

    stateSelect?.addEventListener('change', function(){
        fillCities(false);
    });

    fillCities(true);
})();
</script>
@endpush
