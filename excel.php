<?php

/** @noinspection ForgottenDebugOutputInspection */

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__ . '../src/SimpleXLSX.php';

echo '<h1>Parse books.xslx</h1><pre>';
if ($xlsx = SimpleXLSX::parse('data.xlsx')) {
    $data = $xlsx->rows();
    foreach ($data as $key => $row) {
        if ($key !== 0) {
            if ($row[4] != "--") {
                $email = $row[4];
                echo $email . "</br>";
            }
        }
    }
} else {
    echo SimpleXLSX::parseError();
}
echo '<pre>';
