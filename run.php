<?php
/**
 * CSV Reader
 *
 * @author Ryan Marshall <rmarsh000@gmail.com>
 */
require_once 'CSVReader.php';

$reader = new CSVReader('data.csv');
foreach ($reader as $data) {
    var_dump($data);
}
?>