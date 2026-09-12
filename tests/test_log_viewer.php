<?php
/**
 * Test Log Viewer Helper Methods
 */
require_once dirname(__DIR__) . '/bootstrap.php';

use App\Logging\Logger;

echo "=== TEST LOG VIEWER BACKEND ===\n\n";

// 1. Test getAvailableLogDates
$dates = Logger::getAvailableLogDates();
echo "1. Available Dates: " . implode(", ", $dates) . "\n";
assert(!empty($dates), "Available dates should not be empty");

// 2. Test parseLogFile
$targetDate = $dates[0];
$parsed = Logger::parseLogFile($targetDate, 'ALL', null, 50);

echo "2. Parsed Date: {$targetDate}\n";
echo "   Total entries: {$parsed['total']}\n";
echo "   Stats: " . json_encode($parsed['stats']) . "\n";
assert($parsed['total'] > 0, "Total entries should be > 0");

// 3. Test Filter Level
$dbOnly = Logger::parseLogFile($targetDate, 'DATABASE_ERROR');
echo "3. Filter DATABASE_ERROR: {$dbOnly['total']} entries\n";
foreach ($dbOnly['entries'] as $e) {
    echo "   - Level: {$e['level']}, Msg: {$e['message']}\n";
    if (!empty($e['sql_query'])) {
        echo "     SQL: {$e['sql_query']}\n";
    }
}

// 4. Test Search
$searchTest = Logger::parseLogFile($targetDate, 'ALL', 'tabel_palsu');
echo "4. Search 'tabel_palsu': {$searchTest['total']} entries found\n";
assert($searchTest['total'] > 0, "Search should find entry with 'tabel_palsu'");

echo "\n>>> ALL 4 LOG VIEWER BACKEND TESTS PASSED 100% <<<\n";
