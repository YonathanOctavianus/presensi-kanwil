<?php
// api/migrate.php - Database Migration Script for Vercel
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

echo "<!DOCTYPE html>";
echo "<html lang='id'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Database Migration - PresensiKu</title>";
echo "<style>";
echo "body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #07213D, #0A2A4D); color: white; padding: 20px; }";
echo ".container { max-width: 800px; margin: 0 auto; background: rgba(255,255,255,0.1); padding: 30px; border-radius: 15px; border: 1px solid rgba(238,191,99,0.3); }";
echo ".success { color: #10B981; background: rgba(16,185,129,0.1); padding: 10px; border-radius: 5px; margin: 10px 0; }";
echo ".error { color: #EF4444; background: rgba(239,68,68,0.1); padding: 10px; border-radius: 5px; margin: 10px 0; }";
echo ".info { color: #3B82F6; background: rgba(59,130,246,0.1); padding: 10px; border-radius: 5px; margin: 10px 0; }";
echo "h1 { color: #EEBF63; text-align: center; }";
echo ".btn { display: inline-block; background: #EEBF63; color: #07213D; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-top: 20px; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<h1>🔄 Database Migration - PresensiKu</h1>";

try {
    // 1. Test database connection
    echo "<div class='info'>🔧 Testing database connection...</div>";
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "<div class='success'>✅ Connected to PostgreSQL database successfully!</div>";
    
    echo "<div class='info'>📊 Database Info:</div>";
    echo "<ul>";
    echo "<li>Host: " . env('DB_HOST') . "</li>";
    echo "<li>Database: " . env('DB_DATABASE') . "</li>";
    echo "<li>Driver: " . \Illuminate\Support\Facades\DB::connection()->getDriverName() . "</li>";
    echo "</ul>";
    
    // 2. Run migrations
    echo "<div class='info'>🔄 Running migrations...</div>";
    $app->make(Illuminate\Contracts\Console\Kernel::class)
        ->call('migrate', ['--force' => true]);
    echo "<div class='success'>✅ Database migrations completed!</div>";
    
    // 3. Check existing tables
    echo "<div class='info'>📋 Checking database tables...</div>";
    $tables = \Illuminate\Support\Facades\DB::select("
        SELECT table_name 
        FROM information_schema.tables 
        WHERE table_schema = 'public' 
        ORDER BY table_name
    ");
    
    if (count($tables) > 0) {
        echo "<div class='success'>✅ Found " . count($tables) . " table(s):</div>";
        echo "<ul>";
        foreach ($tables as $table) {
            $count = \Illuminate\Support\Facades\DB::table($table->table_name)->count();
            echo "<li>{$table->table_name} ({$count} records)</li>";
        }
        echo "</ul>";
    } else {
        echo "<div class='info'>📭 No tables found (fresh database)</div>";
    }
    
    // 4. Create default pegawai table if not exists
    echo "<div class='info'>👥 Setting up pegawai table...</div>";
    if (!\Illuminate\Support\Facades\Schema::hasTable('pegawai')) {
        \Illuminate\Support\Facades\DB::statement("
            CREATE TABLE pegawai (
                id SERIAL PRIMARY KEY,
                nip VARCHAR(20) UNIQUE NOT NULL,
                nama VARCHAR(100) NOT NULL,
                jabatan VARCHAR(100),
                unit_kerja VARCHAR(100),
                email VARCHAR(100),
                no_hp VARCHAR(15),
                foto VARCHAR(255),
                status VARCHAR(20) DEFAULT 'aktif',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
        echo "<div class='success'>✅ Created 'pegawai' table</div>";
    } else {
        echo "<div class='success'>✅ 'pegawai' table already exists</div>";
    }
    
    // 5. Create default presensi table if not exists
    echo "<div class='info'>📝 Setting up presensi table...</div>";
    if (!\Illuminate\Support\Facades\Schema::hasTable('presensi')) {
        \Illuminate\Support\Facades\DB::statement("
            CREATE TABLE presensi (
                id SERIAL PRIMARY KEY,
                nip VARCHAR(20) NOT NULL,
                nama VARCHAR(100),
                jenis_presensi VARCHAR(50),
                waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                metode VARCHAR(20) DEFAULT 'qr_code',
                status VARCHAR(20) DEFAULT 'hadir',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
        echo "<div class='success'>✅ Created 'presensi' table</div>";
    } else {
        echo "<div class='success'>✅ 'presensi' table already exists</div>";
    }
    
    // 6. Insert sample data if table is empty
    $pegawaiCount = \Illuminate\Support\Facades\DB::table('pegawai')->count();
    if ($pegawaiCount == 0) {
        echo "<div class='info'>📝 Inserting sample data...</div>";
        \Illuminate\Support\Facades\DB::table('pegawai')->insert([
            [
                'nip' => '198001012001011001',
                'nama' => 'Dr. Ahmad Wijaya, M.Si',
                'jabatan' => 'Kepala Dinas',
                'unit_kerja' => 'Sekretariat',
                'email' => 'ahmad.wijaya@instansi.go.id',
                'no_hp' => '081234567890',
                'status' => 'aktif'
            ],
            [
                'nip' => '198102022002022002',
                'nama' => 'Drs. Bambang Sutrisno',
                'jabatan' => 'Sekretaris Dinas',
                'unit_kerja' => 'Sekretariat',
                'email' => 'bambang.sutrisno@instansi.go.id',
                'no_hp' => '081234567891',
                'status' => 'aktif'
            ],
            [
                'nip' => '198203032003033003',
                'nama' => 'Ir. Citra Dewi, MT',
                'jabatan' => 'Kepala Bidang',
                'unit_kerja' => 'Bidang Teknis',
                'email' => 'citra.dewi@instansi.go.id',
                'no_hp' => '081234567892',
                'status' => 'aktif'
            ]
        ]);
        echo "<div class='success'>✅ Inserted 3 sample pegawai records</div>";
    }
    
    echo "<div class='success' style='text-align: center; padding: 20px; margin-top: 20px;'>";
    echo "🎉 <strong>Database setup completed successfully!</strong><br>";
    echo "Aplikasi PresensiKu siap digunakan dengan PostgreSQL database.";
    echo "</div>";
    
    echo "<div style='text-align: center; margin-top: 30px;'>";
    echo "<a href='/' class='btn'>🏠 Go to Dashboard</a> ";
    echo "<a href='/scan' class='btn'>📱 Go to Scanner</a>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    echo "<div class='info'>🔧 Debug Info:</div>";
    echo "<pre style='background: rgba(0,0,0,0.3); padding: 10px; border-radius: 5px; overflow-x: auto;'>";
    echo "Error Type: " . get_class($e) . "\n";
    echo "File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n";
    echo "Trace:\n" . $e->getTraceAsString();
    echo "</pre>";
    
    echo "<div class='info'>💡 Troubleshooting Tips:</div>";
    echo "<ol>";
    echo "<li>Check Environment Variables in Vercel</li>";
    echo "<li>Verify Neon.tech database is running</li>";
    echo "<li>Ensure PostgreSQL credentials are correct</li>";
    echo "<li>Check database connection from Neon.tech dashboard</li>";
    echo "</ol>";
}

echo "</div>"; // Close container
echo "</body>";
echo "</html>";