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

// 7. Uji Anti-Leak: JS String Literal yang memuat </body> atau </html>
$jsHtml = "<html><head><script>var txt = '<html><body>popup</body></html>'; function test() { alert('ok'); }</script></head><body><h1>Main Page</h1></body></html>";
$resJsHtml = DevBar::handleBuffer($jsHtml);
assert(strpos($resJsHtml, "function test() { alert('ok'); }</script>") !== false, "Script tag tidak boleh terputus oleh DevBar!");
$scriptEndPos = strpos($resJsHtml, '</script>');
$devBarPos = strpos($resJsHtml, 'SIMBADA DEVELOPER MODE FILE INSPECTOR');
assert($devBarPos > $scriptEndPos, "DevBar HARUS disuntikkan setelah penutup </script>, bukan di dalam string script!");
echo "[PASS] Test 7: Anti-Leak berhasil, tag </body> di dalam script/style diabaikan.\n";

// 8. Uji Pengecualian Frame Header Atas (FileHeader.php)
$_SERVER['SCRIPT_FILENAME'] = 'd:/xampp/htdocs/migration-php-v2/admin/FileHeader.php';
$dummyHeaderHtml = "<html><head><title>Simbada</title></head><body><div id=\"header\">Header Content</div></body></html>";
$resHeader = DevBar::handleBuffer($dummyHeaderHtml);
assert($resHeader === $dummyHeaderHtml, "DevBar WAJIB tidak disuntikkan ke FileHeader.php agar header atas tetap bersih!");
assert(strpos($resHeader, 'SIMBADA DEVELOPER MODE FILE INSPECTOR') === false, "FileHeader.php tidak boleh memuat DevBar");
echo "[PASS] Test 8: Pengecualian FileHeader.php berhasil (Header atas tetap bersih 100%).\n";

// 9. Uji Penambahan Skrip Pengecualian Kustom via excludeScript()
$_SERVER['SCRIPT_FILENAME'] = 'd:/xampp/htdocs/migration-php-v2/admin/CustomPage.php';
DevBar::excludeScript('CustomPage.php');
$dummyCustom = "<html><head><title>Custom</title></head><body><p>Content</p></body></html>";
$resCustom = DevBar::handleBuffer($dummyCustom);
assert($resCustom === $dummyCustom, "excludeScript() harus berhasil mengecualikan CustomPage.php dari DevBar");
echo "[PASS] Test 9: excludeScript() berhasil mengecualikan skrip kustom.\n";

// 10. Uji Method DevBar::disable()
$_SERVER['SCRIPT_FILENAME'] = 'd:/xampp/htdocs/migration-php-v2/admin/NormalPage.php';
DevBar::disable();
assert(DevBar::isEnabled() === false, "DevBar::disable() harus membuat status isEnabled() menjadi false");
$dummyNormal = "<html><head><title>Normal</title></head><body><p>Content</p></body></html>";
$resDisabled = DevBar::handleBuffer($dummyNormal);
assert($resDisabled === $dummyNormal, "handleBuffer harus mengembalikan raw buffer saat DevBar di-disable");
echo "[PASS] Test 10: Method DevBar::disable() berhasil menonaktifkan runtime DevBar secara terprogram.\n";

echo "\n>>> SELURUH 10 PENGUJIAN DEVBAR BERHASIL 100% <<<\n";

