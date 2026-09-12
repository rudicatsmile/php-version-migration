<?php
/**
 * Unit Test Suite for Developer Mode File Inspector (DevBar)
 */

require_once dirname(__DIR__) . '/autoload.php';

use App\Dev\DevBar;

echo "=== TEST DEVELOPER MODE FILE INSPECTOR (DevBar) ===\n\n";

// 1. Uji Autoloading & Class Exists
assert(class_exists('App\Dev\DevBar'), "Class App\\Dev\\DevBar harus dapat di-autoload");
echo "[PASS] Test 1: Class DevBar berhasil dimuat via PSR-4.\n";

// 2. Uji Status Aktif di Mode Development
DevBar::init('development', true);
assert(DevBar::isEnabled() === true, "DevBar harus aktif saat mode development dan forceState true");
echo "[PASS] Test 2: DevBar aktif di lingkungan development.\n";

// 3. Uji Keamanan: Mode Production Wajib Non-aktif (Hard-Disabled)
// Reset status melalui refleksi untuk pengujian terisolasi
$refClass = new ReflectionClass(DevBar::class);
$propInit = $refClass->getProperty('initialized');
$propInit->setValue(null, false);

DevBar::init('production');
assert(DevBar::isEnabled() === false, "DevBar WAJIB non-aktif di lingkungan production!");
echo "[PASS] Test 3: DevBar otomatis non-aktif penuh di lingkungan production (Zero Leak).\n";

// 4. Uji Penempelan (Injection) pada Dokumen HTML
$propInit->setValue(null, false);
DevBar::init('development', true);

$dummyHtml = "<html><head><title>Test Simbada</title></head><body><h1>Form Transaksi</h1><p>Konten Form</p></body></html>";
$resultHtml = DevBar::handleBuffer($dummyHtml);

assert(strpos($resultHtml, 'SIMBADA DEVELOPER MODE FILE INSPECTOR') !== false, "HTML hasil buffer harus memuat komentar DevBar");
assert(strpos($resultHtml, 'Simbada Developer Inspector') !== false, "HTML harus memuat judul inspector drawer");
assert(strpos($resultHtml, '⚡') !== false, "HTML harus memuat ikon petir DevBar");
assert(strpos($resultHtml, '</body>') !== false, "Tag </body> harus tetap utuh di akhir");
echo "[PASS] Test 4: DevBar berhasil disuntikkan ke dalam dokumen HTML sebelum </body>.\n";

// 5. Uji Penanganan Non-HTML (JSON / Binary Protection)
$dummyJson = json_encode(['status' => 'success', 'data' => [1, 2, 3]]);
$resultJson = DevBar::handleBuffer($dummyJson);
assert($resultJson === $dummyJson, "Response non-HTML/JSON tidak boleh diubah atau disuntikkan DevBar!");
echo "[PASS] Test 5: Response non-HTML/JSON terlindungi dan tidak disentuh.\n";

// 6. Uji Rendering HTML DevBar secara Mandiri
$rendered = DevBar::renderBarHtml();
assert(!empty($rendered), "Output renderBarHtml tidak boleh kosong");
assert(strpos($rendered, 'devbar_') !== false, "Elemen harus memiliki unique identifier yang terisolasi");
echo "[PASS] Test 6: renderBarHtml menghasilkan markup CSS & JS yang terisolasi.\n";

echo "\n>>> SELURUH 6 PENGUJIAN DEVBAR BERHASIL 100% <<<\n";
