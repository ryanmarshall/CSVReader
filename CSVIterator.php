<?php
/**
 * CSV Reader
 *
 * @author Ryan Marshall <rmarsh000@gmail.com>
 */
abstract class CSVIterator implements Iterator
{
    /**
     * Iterator index
     *
     * @var int
     */
    private $_index = 0;

    /**
     * current data
     *
     * @return array
     */
    public function current()
    {
        return $this->_data[$this->_index];
    }

    /**
     * current key
     *
     * @return int
     */
    public function key()
    {
        $keys = array_keys($this->_data);
        return $keys[$this->_index];
    }

    /**
     * Next in array
     *
     * @return array
     */
    public function next()
    {
        if (isset($this->_data[++$this->_index])) {
            return $this->_data[$this->_index];
        }
        return false;
    }

    /**
     * check if current is valid
     *
     * @return boolean
     */
    public function valid()
    {
        return isset($this->_data[$this->_index]);
    }

    /**
     * rewind
     *
     * @return null
     */
    public function rewind()
    {
        $this->_index = 0;
    }
}