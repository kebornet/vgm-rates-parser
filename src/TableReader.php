<?php

namespace VgmRates;

use Exception;

class TableReader
{
    private const COUNT_OF_COLUMNS = 4;
    private const FIRST_COLUMN = 0;
    private const COUNT_OF_ROWS_BEFORE_COLUMN_HEADING = 1;
    private const COUNT_OF_ROWS_BEFORE_FIRST_ROW_VALUES = 2;
    private const COUNT_OF_ROWS_BEFORE_LAST_ROW_VALUES = 21;

    private static array $sheetData;
    private string $columnLetter;
    private int $rowNumber;

    public function __construct(string $columnLetter, int $rowNumber)
    {
        $this->columnLetter = $columnLetter;
        $this->rowNumber = $rowNumber;
    }

    public static function setSheetData(array $sheetData): void
    {
        self::$sheetData = $sheetData;
    }

    /**
     * Get table values.
     * 
     * @return array values table.
     */
    public function getValues(): array
    {
        $values = [];

        $rowHeaderColumn = $this->rowNumber + self::COUNT_OF_ROWS_BEFORE_COLUMN_HEADING;

        for ($column = self::FIRST_COLUMN; $column < self::COUNT_OF_COLUMNS; $column++) {
            $columnValues = $this->getColumnValues();

            if (!isset(self::$sheetData[$rowHeaderColumn][$this->columnLetter])) {
                throw new Exception("Unable to get value header column for row number $this->rowNumber and column $this->columnLetter");
            }
            $headerColumn = trim(self::$sheetData[$rowHeaderColumn][$this->columnLetter]);

            $values[$headerColumn] = $columnValues;
            ++$this->columnLetter;
        }

        return $values;
    }

    /**
     * Get table column values.
     * 
     * @return array column values.
     */
    private function getColumnValues(): array
    {
        $columnValues = [];

        $firstRow = $this->rowNumber + self::COUNT_OF_ROWS_BEFORE_FIRST_ROW_VALUES;
        $lastRow = $this->rowNumber + self::COUNT_OF_ROWS_BEFORE_LAST_ROW_VALUES;

        for ($row = $firstRow; $row <= $lastRow; $row++) {
            if (!isset(self::$sheetData[$row][$this->columnLetter])) {
                throw new Exception("Unable to get value cell for row number $row and column $this->columnLetter");
            }
            $columnValues[] = self::$sheetData[$row][$this->columnLetter];
        }

        return $columnValues;
    }
}
