# vgm-rates-parser

PHP version: 7.4

Данный рабочий проект предназначен для считывания информации из множества таблиц вида 20x4.

## About

This script launches a parser that reads data from an `xlsx` file. When launched, the name of the `xlsx` file is passed to the parser as input. At the output, the parser generates data in JSON format.

## Dependency

### PhpSpreadsheet

To read the `xlsx` file, the [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) library is used. Installation into this project:
```
composer install
```

## Parser launch example

The downloaded `xlsx` files are in the folder: `spreedsheets`.

The parser is launched from the console:
```
php index.php spreedsheets/spreedsheet-example.xlsx
```
The parsing results in the format JSON is in the folder: `results`.
