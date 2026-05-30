<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $count = App\Helpers\SampQueryAPI::getServerPlayerCount();
    echo json_encode(['online' => $count, 'status' => $count >= 0]);
} catch (Throwable $e) {
    echo json_encode(['online' => -1, 'status' => false]);
}
