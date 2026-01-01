<?php 
// api/migrate.php 
require __DIR__.'/../vendor/autoload.php'; 
 
$app = require_once __DIR__.'/../bootstrap/app.php'; 
 
try { 
    echo "🔄 Starting database migration...\<br\>"; 
 
    // Run migrations 
    $app->make(Illuminate\Contracts\Console\Kernel::class) 
        ->call('migrate', ['--force' =; 
 
    echo "✅ Migration completed successfully!\<br\>\<br\>"; 
 
    // Test connection 
    echo "🔧 Testing database connection...\<br\>"; 
    \Illuminate\Support\Facades\DB::connection()->getPdo(); 
    echo "✅ Database connected successfully!\<br\>"; 
 
    echo "\<br\>🎉 Aplikasi Presensi siap digunakan dengan PostgreSQL database!"; 
 
} catch (Exception $e) { 
    echo "❌ Error: " . $e->getMessage() . "\<br\>"; 
    echo "📋 Details: \<pre\>" . $e->getTraceAsString() . "\</pre\>"; 
} 
