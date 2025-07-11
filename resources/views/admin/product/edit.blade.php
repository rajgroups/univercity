{{-- resources/views/admin/products/edit.blade.php --}}
@extends('layouts.admin.app')

@section('styles')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
  <style>
    .upload-card {
      max-width: 400px;
      margin: auto;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .upload-preview {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 10px;
      border: 1px solid #dee2e6;
      display: block;
      margin-top: 10px;
    }
    .upload-area {
      padding: 25px;
      text-align: center;
    }
    .upload-label {
      font-weight: 500;
      margin-bottom: 10px;
      display: block;
    }
  </style>
@endsection

@section('content')
  <div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <div>
      <h4 class="fw-bold">Edit Product</h4>
      <small>Update the product details below</small>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
      <i data-feather="arrow-left" class="me-1"></i> Back
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="accordion" id="productAccordion">
      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="headingInfo">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="true">
            <i data-feather="info" class="text-primary me-2"></i> Product Information
          </button>
        </h2>
        <div id="collapseInfo" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input id="productName" name="name" type="text" class="form-control" value="{{ old('name', $product->name) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Slug <span class="text-danger">*</span></label>
                <input id="productSlug" name="slug" type="text" class="form-control" value="{{ old('slug', $product->slug) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select id="categorySelect" name="category_id" class="form-select" required>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Subcategory <span class="text-danger">*</span></label>
                <select id="subCategorySelect" name="sub_category_id" class="form-select" required>
                  @foreach($sub_categories->where('category_id', $product->category_id) as $sub)
                    <option value="{{ $sub->id }}" {{ $sub->id == $product->sub_category_id ? 'selected' : '' }}>{{ $sub->sub_category_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Unit <span class="text-danger">*</span></label>
                <select name="unit_id" class="form-select" required>
                  @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->short_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">SKU <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input id="skuInput" name="sku" type="text" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                  <button type="button" id="generateSku" class="btn btn-outline-secondary">Generate</button>
                </div>
              </div>
              <div class="col-12">
                <label class="form-label">Description</label>
                <textarea id="summernote" name="description">{{ old('description', $product->description) }}</textarea>
                <p class="text-muted mt-1">Max 60 words</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="headingPricing">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePricing">
            <i data-feather="dollar-sign" class="text-primary me-2"></i> Pricing & Stock
          </button>
        </h2>
        <div id="collapsePricing" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Quantity</label>
                <input name="quantity" type="number" class="form-control" min="0" value="{{ old('quantity', $product->quantity) }}">
              </div>
              <div class="col-md-4">
                <label class="form-label">Price <span class="text-danger">*</span></label>
                <input name="price" type="number" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Tax Type <span class="text-danger">*</span></label>
                <select name="tax_type" class="form-select" required>
                  <option value="exclusive" {{ $product->tax_type == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
                  <option value="inclusive" {{ $product->tax_type == 'inclusive' ? 'selected' : '' }}>Inclusive</option>
                </select>
              </div>
              <div class="col-12">
                <div class="form-check form-switch">
                  <input name="status" class="form-check-input" type="checkbox" value="1" {{ $product->status ? 'checked' : '' }}>
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item mb-4">
        <h2 class="accordion-header" id="headingImages">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImages">
            <i data-feather="image" class="text-primary me-2"></i> Image
          </button>
        </h2>
        <div id="collapseImages" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="upload-card">
              <div class="row">
                <div class="col-md-6">
                  <div class="upload-area">
                    <label for="productImageInput" class="upload-label">Choose an image</label>
                    <input id="productImageInput" name="image" class="form-control mb-3" type="file" accept="image/*">
                    @if($product->image)
                      <img id="productImagePreview" src="{{ asset('storage/' . $product->image) }}" class="upload-preview" alt="Product Image">
                    @else
                      <img id="productImagePreview" class="upload-preview" style="display: none;" alt="Preview">
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end mt-4 mb-4">
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
      <button type="submit" class="btn btn-primary">Update Product</button>
    </div>
  </form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
  $(document).ready(function() {
    feather.replace();
    $('#summernote').summernote({
      placeholder: 'Enter product description…',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture']],
        ['view', ['fullscreen', 'codeview']]
      ]
    });
    $('#productName').on('input', function() {
      let slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
      $('#productSlug').val(slug);
    });
    const generatedSkus = new Set();
    $('#generateSku').on('click', function () {
      let sku;
      for (let i = 0; i < 100; i++) {
        sku = 'SKU-' + Math.random().toString(36).substr(2, 8).toUpperCase();
        if (!generatedSkus.has(sku)) {
          generatedSkus.add(sku);
          $('#skuInput').val(sku);
          return;
        }
      }
      alert("Unable to generate a unique SKU. Please try again.");
    });
    $('#productImageInput').on('change', function() {
      const file = this.files[0], $img = $('#productImagePreview');
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => $img.attr('src', e.target.result).show();
        reader.readAsDataURL(file);
      } else {
        $img.hide().attr('src','');
      }
    });
  });
</script>
@endpush
