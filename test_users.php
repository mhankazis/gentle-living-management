<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;

echo "Master Users:\n";
foreach (MasterUser::all() as $user) {
    echo "ID: {$user->user_id}, Email: {$user->email}, Name: {$user->name}\n";
}
