<?php

set_time_limit(0);

require_once __DIR__ . '/vendor/autoload.php';

use VgmRates\SpreadsheetReader;
use VgmRates\TablesReader;

try {
    $spreadsheetName = $argv[1];

    $spreadsheet = new SpreadsheetReader();
    $sheetData = $spreadsheet->getTablesFromXlsx($spreadsheetName);

    $tablesReader = new TablesReader($sheetData);
    $results = $tablesReader->getResults();

    if (!file_put_contents(__DIR__ . '/results/rates-' . date('Y-m-d') . '.json', json_encode($results, JSON_PRETTY_PRINT))) {
        throw new Exception('Unable to generate JSON file.');
    }
} catch (Exception $e) {
    exit('Caught exception: ' . $e->getMessage());
}
