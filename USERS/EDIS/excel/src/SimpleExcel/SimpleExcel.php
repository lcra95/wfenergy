<?php
/**
 * Simple Excel
 * 
 * A PHP library with simplistic approach
 * Easily parse/convert/write between Microsoft Excel XML/CSV/TSV/HTML/JSON/etc formats
 *  
 * Copyright (c) 2011-2013 Faisalman <fyzlman@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @author      Faisalman
 * @copyright   2011-2013 (c) Faisalman
 * @license     http://www.opensource.org/licenses/mit-license
 * @link        http://github.com/faisalman/simple-excel-php
 * @package     SimpleExcel
 * @version     0.3.15
 */
interface IParser
{
    public function getCell($row_num, $col_num, $val_only);
    public function getColumn($col_num, $val_only);
    public function getRow($row_num, $val_only);
    public function getField($val_only);
    public function isCellExists($row_num, $col_num);
    public function isColumnExists($col_num);
    public function isRowExists($row_num);
    public function isFieldExists();
    public function isFileReady($file_path);
    public function loadFile($file_path);
    public function loadString($str);
}
abstract class BaseParser implements IParser
{
    /**
    * Holds the parsed result
    * 
    * @access   private
    * @var      array
    */
    protected $table_arr;
    
    /**
    * Defines valid file extension
    * 
    * @access   protected
    * @var      string
    */
    protected $file_extension = '';

    /**
    * @param    string  $file_url   Path to file (optional)
    */
    public function __construct($file_url = NULL) {
        if(isset($file_url)) {
            $this->loadFile($file_url);
        }
    }

    /**
    * Get value of the specified cell
    * 
    * @param    int $row_num    Row number
    * @param    int $col_num    Column number
    * @param    int $val_only
    * @return   array
    * @throws   Exception       If the cell identified doesn't exist.
    */
    public function getCell($row_num, $col_num, $val_only = true) {
        // check whether the cell exists
        if (!$this->isCellExists($row_num, $col_num)) {
            throw new Exception('Cell '.$row_num.','.$col_num.' doesn\'t exist', SimpleExcelException::CELL_NOT_FOUND);
        }
        return $this->table_arr[$row_num-1][$col_num-1];
    }

    /**
    * Get data of the specified column as an array
    * 
    * @param    int     $col_num    Column number
    * @param    bool    $val_only
    * @return   array
    * @throws   Exception           If the column requested doesn't exist.
    */
    public function getColumn($col_num, $val_only = TRUE) {
        $col_arr = array();

        if(!$this->isColumnExists($col_num)){
            throw new Exception('Column '.$col_num.' doesn\'t exist', SimpleExcelException::COLUMN_NOT_FOUND);
        }

        // get the specified column within every row
        foreach($this->table_arr as $row){
            array_push($col_arr, $row[$col_num-1]);
        }

        // return the array
        return $col_arr;
    }

    /**
    * Get data of all cells as an array
    * 
    * @param    bool    $val_only
    * @return   array
    * @throws   Exception   If the field is not set.
    */
    public function getField($val_only = TRUE) {
        if(!$this->isFieldExists()){
            throw new Exception('Field is not set', SimpleExcelException::FIELD_NOT_FOUND);
        }
        
        // return the array
        return $this->table_arr;
    }

    /**
    * Get data of the specified row as an array
    * 
    * @param    int     $row_num    Row number
    * @param    bool    $val_only
    * @return   array
    * @throws   Exception           When a row is requested that doesn't exist.
    */
    public function getRow($row_num, $val_only = TRUE) {
        if(!$this->isRowExists($row_num)){
            throw new Exception('Row '.$row_num.' doesn\'t exist', SimpleExcelException::ROW_NOT_FOUND);
        }

        // return the array
        return $this->table_arr[$row_num-1];
    }

    /**
    * Check whether cell with specified row & column exists
    * 
    * @param    int     $row_num    Row number
    * @param    int     $col_num    Column number
    * @return   bool
    */
    public function isCellExists($row_num, $col_num){
        return $this->isRowExists($row_num) && $this->isColumnExists($col_num);
    }
    
    /**
    * Check whether a specified column exists
    * 
    * @param    int     $col_num    Column number
    * @return   bool
    */
    public function isColumnExists($col_num){
        $exist = false;
        foreach($this->table_arr as $row){
            if(array_key_exists($col_num-1, $row)){
                $exist = true;
            }
        }
        return $exist;
    }
    
    /**
    * Check whether a specified row exists
    * 
    * @param    int     $row_num    Row number
    * @return   bool
    */
    public function isRowExists($row_num){
        return array_key_exists($row_num-1, $this->table_arr);
    }
    
    /**
    * Check whether table exists
    * 
    * @return   bool
    */
    public function isFieldExists(){
        return isset($this->table_arr);
    }
    
    /**
    * Check whether file exists, valid, and readable
    * 
    * @param    string  $file_path  Path to file
    * @return   bool
    * @throws   Exception           If file being loaded doesn't exist
    * @throws   Exception           If file extension doesn't match
    * @throws   Exception           If error reading the file
    */
    public function isFileReady($file_path) {
    
        // file exists?
        if (!file_exists($file_path)) {
        
            throw new Exception('File '.$file_path.' doesn\'t exist', SimpleExcelException::FILE_NOT_FOUND);
        
        // extension valid?
        } else if (strtoupper(pathinfo($file_path, PATHINFO_EXTENSION))!= strtoupper($this->file_extension)){

            throw new Exception('File extension '.strtoupper(pathinfo($file_path, PATHINFO_EXTENSION)).' doesn\'t match with '.$this->file_extension, SimpleExcelException::FILE_EXTENSION_MISMATCH);
        
        // file readable?
        } else if (($handle = fopen($file_path, 'r')) === FALSE) {            
        
            throw new Exception('Error reading the file in'.$file_path, SimpleExcelException::ERROR_READING_FILE);
            fclose($handle);

        // okay then
        } else {
            
            return TRUE;
        }
    }
}

include 'excel/src/SimpleExcel/Exception/SimpleExcelException.php';


/**
 * SimpleExcel main class
 * 
 * @author Faisalman
 * @package SimpleExcel
 */
class SimpleExcel
{
    /**
    * 
    * @var CSVParser | TSVParser | XMLParser | HTMLParser | JSONParser
    */
    public $parser;

    /**
    * 
    * @var CSVWriter | TSVWriter | XMLWriter | HTMLWriter | JSONWriter
    */
    public $writer;
    
    /**
    * 
    * @var array
    */    
    protected $validParserTypes = array('XML', 'CSV', 'TSV', 'HTML', 'JSON');
    protected $validWriterTypes = array('XML', 'CSV', 'TSV', 'HTML', 'JSON');

    /**
    * SimpleExcel constructor method
    * 
    * @param    string  $filetype   Set the filetype of the file which will be parsed (XML/CSV/TSV/HTML/JSON)
    * @return   void
    */
    public function __construct($filetype = 'XML'){
        $this->constructParser($filetype);
        $this->constructWriter($filetype);
    }

    /**
    * Construct a SimpleExcel Parser
    * 
    * @param    string  $filetype   Set the filetype of the file which will be parsed (XML/CSV/TSV/HTML/JSON)
    * @throws   Exception           If filetype is neither XML/CSV/TSV/HTML/JSON
    */
    public function constructParser($filetype){
        $filetype = strtoupper($filetype);
        if(!in_array($filetype, $this->validParserTypes)){
            throw new Exception('Filetype '.$filetype.' is not supported', SimpleExcelException::FILETYPE_NOT_SUPPORTED);
        }
        $parser_class = $filetype.'Parser';
        $this->parser = new $parser_class();
    }

    /**
    * Construct a SimpleExcel Writer
    * 
    * @param    string  $filetype   Set the filetype of the file which will be written (XML/CSV/TSV/HTML/JSON)
    * @return   bool
    * @throws   Exception           If filetype is neither XML/CSV/TSV/HTML/JSON
    */
    public function constructWriter($filetype){
        $filetype = strtoupper($filetype);

        if(!in_array($filetype, $this->validWriterTypes)){
            throw new Exception('Filetype '.$filetype.' is not supported', SimpleExcelException::FILETYPE_NOT_SUPPORTED);
        }
        $writer_class = 'SimpleExcel\\Writer\\'.$filetype.'Writer';
        $this->writer = new $writer_class();
    }
    
    /**
    * Change writer type to convert to another format
    * 
    * @param    string  $filetype   Set the filetype of the file which will be written (XML/CSV/TSV/HTML/JSON)
    */
    public function convertTo($filetype){
        $this->constructWriter($filetype);
        $this->writer->setData($this->parser->getField());
    }
}


class CSVParser extends BaseParser implements IParser
{    
 /**
    * Defines delimiter character
    * 
    * @access   protected
    * @var      string
    */
    protected $delimiter;
    
    /**
    * Defines valid file extension
    * 
    * @access   protected
    * @var      string
    */
    protected $file_extension = 'csv';

    /**
    * Load the CSV file to be parsed
    * 
    * @param    string  $file_path  Path to CSV file
    */
    public function loadFile($file_path){
    
        if (!$this->isFileReady($file_path)) {
            return;
        }

        $this->loadString(file_get_contents($file_path));
    }
    
    /**
    * Load the string to be parsed
    * 
    * @param    string  $str    String with CSV format
    */
    public function loadString($str){
        $this->table_arr = array();
        
    // 1. Split into lines by newline http://stackoverflow.com/questions/3997336/explode-php-string-by-new-line 
        $pattern = "/\r\n|\n|\r/";
        $lines   = preg_split($pattern, $str, -1, PREG_SPLIT_NO_EMPTY);
        $total   = count($lines);
        
        // There are no lines to parse
        if ($total == 0) {
            return;
        }
        
        // 2. Guess delimiter if none set
        $line = $lines[0];
        if (!isset($this->delimiter)) {
            // do guess work
            $separators = array(';' => 0, ',' => 0);
            foreach ($separators as $sep => $count) {
                $args  = str_getcsv($sep, $line);
                $count = count($args);
                
                $separators[$sep] = $count;
            }
            
            $sep = ',';
            if (($separators[';'] > $separators[','])) {
                $sep = ';';
            }
            
            $this->delimiter = $sep;
        }
        
        // 3. Parse the lines into rows,cols
        $max  = 0;
        $min  = PHP_INT_MAX;
        $cols = 0;
        $sep  = $this->delimiter;
        $rows = array(); 
        foreach ($lines as $line) {
            $args   = str_getcsv($line, $sep);
            $rows[] = $args;
            
            $cols = count($args);
            if ($cols > $max) {
                $max = $cols;
            }
            if ($cols < $min) {
                $min = $cols;
            }
        }
        
        // 4. Expand those rows which have less cols than max cols found
        if ($min != $max) {
            foreach ($rows as $i => $row) {
                $c = count($row);
                while ($c < $max) {
                    $row[] = ""; // fill with empty strings
                    $c += 1;
                }
                $rows[$i] = $row;
            }
        }
        $this->table_arr = $rows;
    }
    
    /**
    * Set delimiter that should be used to parse CSV document
    * 
    * @param    string  $delimiter   Delimiter character
    */
    public function setDelimiter($delimiter){
        $this->delimiter = $delimiter;
    }
}
