<?php

namespace VgmRates;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Exception;

class SpreadsheetReader
{
    private const RANGE_OF_DATA_RECEPTION_CELLS = 'B13:Q105';

    /**
     * Get tables from XLSX file from worksheet.
     * 
     * @param  string $spreadsheetName spreadsheet file name.
     * @return array table cell range.
     */
    public function getTablesFromXlsx(string $spreadsheetName): array
    {
        try {
            $reader = new Xlsx();
            $reader->setLoadSheetsOnly('Conv');
            $spreadsheet = $reader->load($spreadsheetName);
        } catch (Exception $e) {
            throw new Exception('Unable the get a file to read. Check file info');
        }

        return $spreadsheet->getActiveSheet()->rangeToArray(self::RANGE_OF_DATA_RECEPTION_CELLS, null, true, true, true);
    }
}
