<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jamath</title>

    @include('layouts.admin.dependency.css')
    <!-- Font Awesome 5+ -->

</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

            <!-- sidebar @s -->
            @include('layouts.admin.partition.left-menu')

            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.admin.partition.header')

                <!-- main header @e -->
                <!-- start Page-content -->
                @section('content')

                @show
                <!-- end main content-->

                <!-- footer @s -->
                @include('layouts.admin.partition.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>

    <!-- JAVASCRIPT -->
    @include('layouts.admin.dependency.js')
    @stack('scripts')
    <script>
    function updateImage(event) {
        const imageInput = event.target;
        const currentIcon = document.getElementById('currentIcon');

        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Update the current icon with the new image
                currentIcon.src = e.target.result;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }
</script>
<script>
    function updateImage1(event) {
        const imageInput = event.target;
        const currentIcon = document.getElementById('front_img1');

        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Update the current icon with the new image
                currentIcon.src = e.target.result;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }
</script>
<script>
    function updateImage2(event) {
        const imageInput = event.target;
        const currentIcon = document.getElementById('property_images1');

        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Update the current icon with the new image
                currentIcon.src = e.target.result;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#limit-selection1').select2({
            minimumInputLength: 0 // Disable minimum input length
        });
    });
    </script>

<script>
    document.getElementById('banner_image').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var img = new Image();
        var maxFileSize = 1.5 * 1024 * 1024; // 1.5MB in bytes
        var errorDiv = document.getElementById('imageError');

        // Clear previous error message
        errorDiv.innerHTML = '';

        // Validate file size
        if (file.size > maxFileSize) {
            errorDiv.innerHTML = 'File size must be below 1.5MB.';
            event.target.value = ''; // Clear the file input
            return;
        }

        // Validate image dimensions
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width !== 1280 || img.height !== 850) {
                errorDiv.innerHTML = 'Image dimensions must be 1280px by 850px.';
                event.target.value = ''; // Clear the file input
            }
        };
    });
</script>
<script>
    document.getElementById('front_img').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var img = new Image();
        var maxFileSize = 1.5 * 1024 * 1024; // 1.5MB in bytes
        var errorDiv = document.getElementById('imageError1');

        // Clear previous error message
        errorDiv.innerHTML = '';

        // Validate file size
        if (file.size > maxFileSize) {
            errorDiv.innerHTML = 'File size must be below 1.5MB.';
            event.target.value = ''; // Clear the file input
            return;
        }

        // Validate image dimensions
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width !== 1280 || img.height !== 850) {
                errorDiv.innerHTML = 'Image dimensions must be 1280px by 850px.';
                event.target.value = ''; // Clear the file input
            }
        };
    });
</script>
<script>
    document.getElementById('property_images').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var img = new Image();
        var maxFileSize = 1.5 * 1024 * 1024; // 1.5MB in bytes
        var errorDiv = document.getElementById('imageError2');

        // Clear previous error message
        errorDiv.innerHTML = '';

        // Validate file size
        if (file.size > maxFileSize) {
            errorDiv.innerHTML = 'File size must be below 1.5MB.';
            event.target.value = ''; // Clear the file input
            return;
        }

        // Validate image dimensions
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width !== 1280 || img.height !== 850) {
                errorDiv.innerHTML = 'Image dimensions must be 1280px by 850px.';
                event.target.value = ''; // Clear the file input
            }
        };
    });
</script>
</body>

</html>
