<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\StringInput('tinker'),
    new Symfony\Component\Console\Output\BufferedOutput
);

$app = require __DIR__ . '/bootstrap/app.php';

use App\Models\Mentoring;
use Carbon\Carbon;

Mentoring::create([
    'pengajar_id' => 2,
    'tanggal' => Carbon::now()->addDay()->format('Y-m-d'),
    'jam' => '14:00',
    'status' => 'Belum',
    'zoom_link' => 'https://zoom.us/j/123456789'
]);

Mentoring::create([
    'pengajar_id' => 9,
    'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
    'jam' => '15:30',
    'status' => 'Sudah',
    'zoom_link' => 'https://zoom.us/j/987654321'
]);

Mentoring::create([
    'pengajar_id' => 10,
    'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
    'jam' => '10:00',
    'status' => 'Belum',
    'zoom_link' => 'https://zoom.us/j/555666777'
]);

echo "Sample mentoring data created successfully!\n";
