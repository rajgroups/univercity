<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/admin/courses-by-sectors',
        'POST',
        [
            'sectors' => [1],
            'selected_courses' => [2]
        ]
    )
);
echo $response->getContent();
