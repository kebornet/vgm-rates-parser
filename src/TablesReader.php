<?php

namespace VgmRates;

use Exception;

class TablesReader
{
    private const HEADER_ROWS_NUMBERS = [13, 37, 61, 84];
    private const HEADER_COLUMNS_LETTERS = ['B', 'F', 'J', 'N'];

    private array $sheetData;

    public function __construct(array $sheetData)
    {
        $this->sheetData = $sheetData;
    }

    /**
     * Get info about conventional products and pricing.
     * 
     * @return array info about conventional products and pricing.
     */
    public function getResults(): array
    {
        $results = [];

        TableReader::setSheetData($this->sheetData);

        foreach (self::HEADER_ROWS_NUMBERS as $tableHeaderRowNumber) {
            foreach (self::HEADER_COLUMNS_LETTERS as $tableHeaderColumnLetter) {

                if (!isset($this->sheetData[$tableHeaderRowNumber][$tableHeaderColumnLetter])) {
                    throw new Exception("Unable to get header table for row number $tableHeaderRowNumber and column $tableHeaderColumnLetter");
                }
                $headerTable = trim($this->sheetData[$tableHeaderRowNumber][$tableHeaderColumnLetter]);

                $tableReader = new TableReader($tableHeaderColumnLetter, $tableHeaderRowNumber);
                $results[$headerTable] = $tableReader->getValues();
            }
        }

        return $results;
    }
}
