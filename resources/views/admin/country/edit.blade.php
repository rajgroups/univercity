@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Country</h4>
                <h6>Update Country Details</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse">
                    <i class="ti ti-chevron-up"></i>
                </a>
            </li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.country.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.country.update', $country->id) }}" method="POST" class="add-product-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="add-product">
            <div class="accordions-items-seperate" id="accordionSpacingExample">
                <div class="accordion-item border mb-4">
                    <h2 class="accordion-header" id="headingSpacingOne">
                        <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                            data-bs-target="#SpacingOne">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                    <i class="feather feather-info text-primary me-2"></i>
                                    <span>Country Information</span>
                                </h5>
                            </div>
                        </div>
                    </h2>

                    <div id="SpacingOne" class="accordion-collapse collapse show">
                        <div class="accordion-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name', $country->name) }}" placeholder="Enter country name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Region <span class="text-danger">*</span></label>
                                        <select name="region_id" class="form-select @error('region_id') is-invalid @enderror">
                                            <option value="">Select Region</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}" {{ old('region_id', $country->region_id) == $region->id ? 'selected' : '' }}>
                                                    {{ $region->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('region_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Subregion</label>
                                        <select name="subregion_id" class="form-select @error('subregion_id') is-invalid @enderror">
                                            <option value="">Select Subregion</option>
                                            @foreach($subregions as $subregion)
                                                <option value="{{ $subregion->id }}" {{ old('subregion_id', $country->subregion_id) == $subregion->id ? 'selected' : '' }}>
                                                    {{ $subregion->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subregion_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">ISO2 Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            name="code" value="{{ old('code', $country->iso2) }}" placeholder="Ex: IN, US" required maxlength="2">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">ISO3 Code</label>
                                        <input type="text" class="form-control @error('iso3') is-invalid @enderror"
                                            name="iso3" value="{{ old('iso3', $country->iso3) }}" placeholder="Ex: IND, USA" maxlength="3">
                                        @error('iso3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Numeric Code</label>
                                        <input type="text" class="form-control @error('numeric_code') is-invalid @enderror"
                                            name="numeric_code" value="{{ old('numeric_code', $country->numeric_code) }}" placeholder="Ex: 356" maxlength="3">
                                        @error('numeric_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Code</label>
                                        <input type="text" class="form-control @error('phonecode') is-invalid @enderror"
                                            name="phonecode" value="{{ old('phonecode', $country->phonecode) }}" placeholder="Ex: 91">
                                        @error('phonecode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Capital</label>
                                        <input type="text" class="form-control @error('capital') is-invalid @enderror"
                                            name="capital" value="{{ old('capital', $country->capital) }}" placeholder="Ex: New Delhi">
                                        @error('capital')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Currency Code</label>
                                        <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                            name="currency" value="{{ old('currency', $country->currency) }}" placeholder="Ex: INR">
                                        @error('currency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Currency Name</label>
                                        <input type="text" class="form-control @error('currency_name') is-invalid @enderror"
                                            name="currency_name" value="{{ old('currency_name', $country->currency_name) }}" placeholder="Ex: Indian Rupee">
                                        @error('currency_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Currency Symbol</label>
                                        <input type="text" class="form-control @error('currency_symbol') is-invalid @enderror"
                                            name="currency_symbol" value="{{ old('currency_symbol', $country->currency_symbol) }}" placeholder="Ex: ₹">
                                        @error('currency_symbol')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">TLD</label>
                                        <input type="text" class="form-control @error('tld') is-invalid @enderror"
                                            name="tld" value="{{ old('tld', $country->tld) }}" placeholder="Ex: .in">
                                        @error('tld')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Native Name</label>
                                        <input type="text" class="form-control @error('native') is-invalid @enderror"
                                            name="native" value="{{ old('native', $country->native) }}" placeholder="Ex: भारत">
                                        @error('native')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nationality</label>
                                        <input type="text" class="form-control @error('nationality') is-invalid @enderror"
                                            name="nationality" value="{{ old('nationality', $country->nationality) }}" placeholder="Ex: Indian">
                                        @error('nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                            name="latitude" value="{{ old('latitude', $country->latitude) }}" placeholder="Ex: 20.5937">
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                            name="longitude" value="{{ old('longitude', $country->longitude) }}" placeholder="Ex: 78.9629">
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">WikiData ID</label>
                                        <input type="text" class="form-control @error('wikiDataId') is-invalid @enderror"
                                            name="wikiDataId" value="{{ old('wikiDataId', $country->wikiDataId) }}" placeholder="Ex: Q668">
                                        @error('wikiDataId')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Emoji</label>
                                        <input type="text" class="form-control @error('emoji') is-invalid @enderror"
                                            name="emoji" value="{{ old('emoji', $country->emoji) }}" placeholder="Ex: 🇮🇳">
                                        @error('emoji')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">EmojiU</label>
                                        <input type="text" class="form-control @error('emojiU') is-invalid @enderror"
                                            name="emojiU" value="{{ old('emojiU', $country->emojiU) }}" placeholder="Ex: U+1F1EE U+1F1F3">
                                        @error('emojiU')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="1" {{ old('status', $country->status) == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $country->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Country Flag</label>
                                        <input type="file" 
                                            class="form-control @error('image') is-invalid @enderror" 
                                            name="image" 
                                            id="imageInput" 
                                            accept="image/*"
                                            onchange="previewImage(event)">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2">
                                            @if($country->image)
                                                <img src="{{ asset('uploads/countries/' . $country->image) }}" 
                                                    alt="Country Flag" 
                                                    style="max-width: 150px; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                                            @endif
                                            <img id="imagePreview" src="#" alt="Preview" 
                                                style="max-width: 150px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('admin.country.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Country</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
