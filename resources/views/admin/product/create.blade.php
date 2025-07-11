{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.admin.app')

@section('styles')
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <!-- Summernote CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css"
    rel="stylesheet"
  />

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
      display: none;
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
      <h4 class="fw-bold">Create Product</h4>
      <small>Fill in the details below</small>
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
  <form action="{{ route('products.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="add-product-form">
    @csrf

    <div class="accordion" id="productAccordion">
      {{-- Product Information --}}
      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="headingInfo">
          <button class="accordion-button" type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseInfo"
                  aria-expanded="true">
            <i data-feather="info" class="text-primary me-2"></i>
            Product Information
          </button>
        </h2>
        <div id="collapseInfo" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input id="productName" name="name" type="text" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Slug <span class="text-danger">*</span></label>
                <input id="productSlug" name="slug" type="text" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select id="categorySelect" name="category_id" class="form-select" required>
                  <option value="">-- Select Category --</option>
                  @foreach($categories as $cat)
                    <option class="text-dark" value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Subcategory <span class="text-danger">*</span></label>
                <select id="subCategorySelect" name="sub_category_id" class="form-select" required>
                    <option value="">-- Select Sub Category --</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Unit <span class="text-danger">*</span></label>
                <select name="unit_id" class="form-select" required>
                    <option value="">-- Select Unit --</option>
                    @foreach($units as $unit)
                    <option class="text-dark" value="{{ $unit->id }}">{{ $unit->short_name }}</option>
                  @endforeach
                </select>
              </div>




              <div class="col-md-6">
                <label class="form-label">SKU <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input id="skuInput" name="sku" type="text" class="form-control" required>
                  <button type="button" id="generateSku" class="btn btn-outline-secondary">
                    Generate
                  </button>
                </div>
              </div>
              <div class="col-12">
                <label class="form-label">Description</label>
                <div id="summernote"></div>
                <textarea name="description" id="description" style="display:none;"></textarea>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      {{-- Pricing & Stock --}}
      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="headingPricing">
          <button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapsePricing">
            <i data-feather="dollar-sign" class="text-primary me-2"></i>
            Pricing & Stock
          </button>
        </h2>
        <div id="collapsePricing" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Quantity</label>
                <input name="quantity" type="number" class="form-control" min="0" value="0">
              </div>
              <div class="col-md-4">
                <label class="form-label">Price <span class="text-danger">*</span></label>
                <input name="price" type="number" class="form-control" step="0.01" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Tax Type <span class="text-danger">*</span></label>
                <select name="tax_type" class="form-select" required>
                  <option value="exclusive">Exclusive</option>
                  <option value="inclusive">Inclusive</option>
                </select>
              </div>
              <div class="col-12">
                <div class="form-check form-switch">
                  <input name="status" class="form-check-input" type="checkbox" value="1" checked>
                  <label class="form-check-label">Active</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Image Upload --}}
      <div class="accordion-item mb-4">
        <h2 class="accordion-header" id="headingImages">
          <button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseImages">
            <i data-feather="image" class="text-primary me-2"></i>
            Image
          </button>
        </h2>
        <div id="collapseImages" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="upload-card">
              <div class="row">
                <div class="col-md-6">
                    <div class="upload-area">
                        <label for="productImageInput" class="upload-label">Choose an image</label>
                        <input id="productImageInput" name="image" class="form-control mb-3"
                               type="file" accept="image/*">
                        <img id="productImagePreview" class="upload-preview" alt="Preview">
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end mt-4 mb-4">
      <a href="#"
         class="btn btn-outline-secondary me-2">Cancel</a>
      <button type="submit" class="btn btn-primary">Add Product</button>
    </div>
  </form>
@endsection

@push('scripts')
  <!-- jQuery first -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <!-- Summernote JS -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <script>
    $(document).ready(function() {
      // 1) Feather icons
      feather.replace();

      // 2) Auto-fill slug
      $('#productName').on('input', function() {
        let slug = $(this).val().toLowerCase()
                      .replace(/[^a-z0-9]+/g,'-')
                      .replace(/(^-|-$)/g,'');
        $('#productSlug').val(slug);
      });

      // 3) Load subcategories via AJAX
      $('#categorySelect').on('change', function() {
        let catId = this.value,
            $sub = $('#subCategorySelect').empty()
                        .append('<option class="text-dark" value=\"\">-- Select Subcategory --</option>');

        if (!catId) return;
        $.get("{{ route('subcategories') }}", { category_id: catId })
         .done(data => {
           data.forEach(sc => {
             $sub.append(`<option value=\"${sc.id}\">${sc.name}</option>`);
           });
         });
      });

      // 4) Summernote init
      $('#summernote').summernote({
        placeholder: 'Enter product description…',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['font',['bold','italic','underline','clear']],
          ['para',['ul','ol','paragraph']],
          ['insert',['link','picture']],
          ['view',['fullscreen','codeview']]
        ]
      });

      // 5) SKU generator
        //   $('#generateSku').on('click', function() {
        //     const sku = 'SKU-' + Math.random().toString(36).substr(2,8).toUpperCase();
        //     $('#skuInput').val(sku);
        //   });

      // Store previously generated SKUs in a Set
        const generatedSkus = new Set();

        $('#generateSku').on('click', function () {
            let sku;

            // Try until we get a truly new SKU (up to 100 attempts)
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

      // 6) Image preview
      $('#productImageInput').on('change', function() {
        const file = this.files[0],
              $img = $('#productImagePreview');
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
  <script>
    // Convert all subcategories from PHP to JavaScript
    const allSubCategories = @json($sub_categories);
  </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const categorySelect = document.getElementById('categorySelect');
      const subCategorySelect = document.getElementById('subCategorySelect');

      categorySelect.addEventListener('change', function () {
        const selectedCategoryId = this.value;

        // Clear subcategory options
        subCategorySelect.innerHTML = '<option class="text-dark" value="">-- Select Subcategory --</option>';

        if (!selectedCategoryId) return;

        // Filter subcategories where category_id matches
        const filtered = allSubCategories.filter(sub => sub.category_id == selectedCategoryId);

        // Add filtered subcategories as options
        filtered.forEach(sub => {
          const option = document.createElement('option');
          option.value = sub.id;
          option.textContent = sub.sub_category_name;
          subCategorySelect.appendChild(option);
        });
      });
    });
  </script>

  
@endpush
