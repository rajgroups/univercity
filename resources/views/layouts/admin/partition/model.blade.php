<!-- Add Stock -->
<div class="modal fade" id="add-stock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title">
                    <h4>Add Stock</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="https://preadmin.dreamstechnologies.com/html/pos/index.html">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Warehouse <span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Lobar Handy</option>
                                    <option>Quaint Warehouse</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Store <span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Selosy</option>
                                    <option>Logerro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Responsible Person <span
                                        class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Steven</option>
                                    <option>Gravely</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="search-form mb-0">
                                <label class="form-label">Product <span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" placeholder="Select Product">
                                <i data-feather="search" class="feather-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-dark me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-md btn-primary">Add Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Stock -->