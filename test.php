<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
config(['filesystems.disks.cloudinary.url' => 'cloudinary://key:secret@cloudname']);
var_dump(\Illuminate\Support\Facades\Storage::disk('cloudinary')->url('test'));
