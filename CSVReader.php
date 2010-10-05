<?php
require_once 'CSVIterator.php';

/**
 * CSV Reader
 *
 * @author Ryan Marshall <rmarsh000@gmail.com>
 */
class CSVReader extends CSVIterator
{
    /**
     * This will hold our unparsed CSV
     *
     * @var string
     */
    private $_csvRaw = null;

    /**
     * array of each line in file
     *
     * @var array
     */
    private $_lines = array();

    /**
     * array of each csv field
     *
     * @var array
     */
    protected $_fields = array();

    /**
     * CSV data
     *
     * @var array
     */
    protected $_data = array();

    /**
     * initialize and parse contents in valid
     *
     * @param string $csv
     *
     * @return null
     */
    public function __construct($csv)
    {
        if (!is_file($csv)) {
            throw new Exception("You passed an invalid file.");
        }
        $this->_csvRaw = file_get_contents($csv);
        $this->_lines  = $this->parseLines();
        $this->_fields = $this->parseFields();
        $this->_data   = $this->parseData();
    }

    /**
     * Parse CSV into newline array
     *
     * @return array
     */
    private function parseLines()
    {
        return explode("\n", $this->_csvRaw);
    }

    /**
     * Parse CSV for Fields
     *
     * @return array
     */
    private function parseFields()
    {
        $headers = explode(",", $this->_lines[0]);
        if (count($headers) != 4) {
            throw new Exception("CSV file does not have the correct amount of fields.");
        }
        return $headers;
    }

    /**
     * Parse all data in CSV
     *
     * @return array
     */
    private function parseData()
    {
        $data   = $this->_lines;
        $result = array();
        unset($data[0]);

        foreach ($data as $line) {
            $parsed = explode(",", $line);
            if (count($parsed) == 4) {
                $ass_array = array();
                foreach ($parsed as $key => $value) {
                    $ass_array[$this->_fields[$key]] = $value;
                }
                $result[] = $ass_array;
            }
        }
        return $result;
    }
}