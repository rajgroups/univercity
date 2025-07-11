<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS - Admin</title>
    @include('layouts.admin.dependency.css')
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Sidebar/Header -->

        <div class="page-wrapper1">
            <div class="content">
                <!-- Page Content -->
                @section('content')
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
                <style>
                    .product-img {
                        width: 40px;
                        height: 40px;
                        object-fit: cover;
                        border-radius: 5px;
                    }
                    .right-panel {
                        background: #ffffff;
                        border-left: 1px solid #dee2e6;
                        padding: 20px;
                        height: 100vh;
                        overflow-y: auto;
                    }
                    .product-item {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .product-item img {
                        max-width: 80px;
                        border-radius: 10px;
                    }
                </style>

                <div class="container-fluid">
                    <div class="row border-bottom bg-white py-2 px-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <img src="{{asset('resource/admin/assets/img/logo.svg')}}" alt="Logo" class=" w-25 me-3">
                            <h5 class="mb-0 fw-bold text-dark">Quick POS</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/admin"><button class="btn btn-danger"> Dashboard <i class="fas fa-arrow-right me-1"></i></button></a>
                            <button class="btn btn-success"><i class="fas fa-shopping-cart me-1"></i> Buy Now ($49)</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Left POS Panel -->
                        <div class="col-lg-9">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-4">New Sale</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Customer Name *</label>
                                            <select class="form-select">
                                                <option selected>Walk-in Customer</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Store / Location *</label>
                                            <select class="form-select">
                                                <option selected>Park City Shop</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Delivery Status *</label>
                                            <select class="form-select">
                                                <option selected>Delivered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Unit</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Discount%</th>
                                                    <th>Tax</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/40" class="product-img me-2"> Apple iPad Pro</td>
                                                    <td><select class="form-select"><option>Box</option></select></td>
                                                    <td><input type="text" class="form-control" value="2016"></td>
                                                    <td><input type="number" class="form-control" value="1"></td>
                                                    <td><input type="number" class="form-control" value="0"></td>
                                                    <td><select class="form-select"><option>Excise taxes (20%)</option></select></td>
                                                    <td>$2,419.20<br><small class="text-muted">Tax: $403.20</small></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/40" class="product-img me-2"> Banana</td>
                                                    <td><select class="form-select"><option>Pieces</option></select></td>
                                                    <td><input type="text" class="form-control" value="0.28"></td>
                                                    <td><input type="number" class="form-control" value="1"></td>
                                                    <td><input type="number" class="form-control" value="0"></td>
                                                    <td><select class="form-select"><option>VAT (20%)</option></select></td>
                                                    <td>$0.34<br><small class="text-muted">Tax: $0.06</small></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row align-items-center mt-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select">
                                                <option selected>Cash</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <p class="mb-1"><strong>Sub Total:</strong> $2,016.28</p>
                                            <p class="mb-1"><strong>Total Tax:</strong> $403.26</p>
                                            <p class="mb-1"><strong>Grand Total:</strong> $2,419.54</p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button class="btn btn-success me-2"><i class="fas fa-check"></i> Save</button>
                                        <button class="btn btn-primary me-2">Save & New</button>
                                        <button class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Product Panel -->
                        <div class="col-lg-3 right-panel">
                            <input type="text" class="form-control mb-3" placeholder="Search by name">
                            <input type="text" class="form-control mb-4" placeholder="Scan Barcode">
                            <div class="row">
                                <div class="col-6 product-item">
                                    <img src="https://via.placeholder.com/80" alt="iPad">
                                    <p class="mt-2">Apple iPad</p>
                                </div>
                                <div class="col-6 product-item">
                                    <img src="https://via.placeholder.com/80" alt="Lotion">
                                    <p class="mt-2">Baby Lotion</p>
                                </div>
                                <div class="col-6 product-item">
                                    <img src="https://via.placeholder.com/80" alt="Banana">
                                    <p class="mt-2">Banana</p>
                                </div>
                                <div class="col-6 product-item">
                                    <img src="https://via.placeholder.com/80" alt="Eggs">
                                    <p class="mt-2">Eggs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @show
                <!-- End Page Content -->
            </div>
            @include('layouts.admin.partition.footer')
        </div>
    </div>

    @include('layouts.admin.dependency.js')
    @stack('scripts')
</body>

</html>
