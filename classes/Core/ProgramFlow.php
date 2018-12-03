<?php

/*
 * Copyright (C) 2018 bernardo
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OJSscript\Core;
use OJSscript\Entity\Abstraction\Entity;

/**
 * Description of ProgramFlow
 *
 * @author bernardo
 */
class ProgramFlow
{
    /**
     * The directory where the generated files will be saved.
     * 
     * @var string
     */
    private $generatedFilesDir;
    
    /**
     * Constructor of the class ProgramFlow.
     * 
     * @param string $generatedFilesDir
     */
    public function __construct($generatedFilesDir = null)
    {
        if ($generatedFilesDir === null) {
            $this->generatedFilesDir = BASE_DIR . '/genfiles';
        } else if (substr($generatedFilesDir, 0, 1) !== '/') {
            $this->generatedFilesDir = BASE_DIR . $generatedFilesDir;
        } else {
            $this->generatedFilesDir = $generatedFilesDir;
        }
    }
    
    /**
     * Creates the directory in which the generated files will be stored.
     * 
     * @return boolean
     */
    public function createDirForGeneratedFiles()
    {
        return mkdir($this->generatedFilesDir, 0755);
    }
    
    /**
     * If the filename is a relative path, i.e. does not begin with a slash "/",
     * make it an absolute path with the generated files directory's path 
     * prepended to its name.
     * 
     * @param string $filename
     */
    private function formFileFullpath(&$filename)
    {
        if (substr($filename, 0, 1) !== '/') {
            $filename = $this->generatedFilesDir . '/' . $filename;
        }
    }
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    private function formValidArray($data)
    {
        if (!is_array($data)) {
            return false;
        }
        
        /* @var $parseableArray array */
        $parseableArray = array();
        
        /* @var $entity Entity */
        foreach ($data as $entity) {
            $parseableArray[] = $entity->asArray();
        }
        
        return $parseableArray;
    }
    
    /**
     * Saves a JSON file in the generated files directory.
     * 
     * @param string $filename - The name the saved file must have.
     * 
     * @param array $data - Array to be converted into JSON.
     * @param boolean $prettyPrint - If true formats the string to be more 
     * readable.
     * 
     * @return boolean
     */
    public function saveJsonFile($filename, $data, $prettyPrint = false)
    {
        /* @var $jsonData string */
        $jsonData = null;
        
        if ($prettyPrint) {
            $jsonData = json_encode(
                $this->formValidArray($data),
                JSON_PRETTY_PRINT
            );
        } else {
            $jsonData = json_encode($this->formValidArray($data));
        }
        
        $this->formFileFullpath($filename);
        
        if (json_decode($jsonData) === null) {
            echo "\n\nThe json data is invalid!\n\n";
        } elseif (file_put_contents($filename, $jsonData)) {
            echo "\n\nSuccessfully saved the file '$filename'\n\n";
            return true;
        }
        
        return false;

    }
    
    /**
     * Reads a JSON file an return it as an associative array
     * 
     * @param string $filename
     * 
     * @param boolean $associative
     * 
     * @return array
     */
    public function readJsonFile($filename)
    {
        $this->formFileFullpath($filename);
        
        /* @var $content string */
        $content = file_get_contents($filename);
        
        /* @var $data array */
        $data = json_decode($content, true);
        
        return $data;
    }
}
