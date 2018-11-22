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
use OJSscript\Entity\Abstraction\EntityDescription;
use OJSscript\Entity\Abstraction\PropertyDescription;
use OJSscript\Entity\Abstraction\EntityDescriptionRegistry;

/**
 * Description of SchemaReader
 *
 * @author bernardo
 */
class SchemaHandler
{
    /**
     * The path of the directory "dbscripts"
     * 
     * @var string
     */
    private $dbscriptsDir;
    
    /**
     * The path of the directory "schema"
     * 
     * @var string
     */
    private $schemaDir;
    
    /**
     * The files that contain the schema of the database tables.
     * 
     * @var array
     */
    private $files;
    
    /**
     * Maps the types 
     * 
     * @var array
     */
    private $typeMapping;
    
    /**
     * The names of the tables that will be used.
     * 
     * @var array
     */
    private $tablesToBeUsed;
    
    /**
     * Sets the path to the directory dbscript.
     * 
     * @param string $dbscriptsDir
     */
    private function setDbscriptDir($dbscriptsDir = null)
    {
        if ($dbscriptsDir === null) {
            $this->dbscriptsDir = BASE_DIR 
                . '/xml_schema/ojs2/dbscripts';
        } else {
            $this->dbscriptsDir = $dbscriptsDir;
        }
    }
    
    /**
     * Sets the path to the schema directory.
     * 
     * @param string $schemaDir
     */
    private function setSchemaDir($schemaDir = null)
    {
        if ($schemaDir === null) {
            $this->schemaDir = BASE_DIR  . '/xml_schema/ojs2/schema';
        } else {
            $this->schemaDir = $schemaDir;
        }
    }
    
    /**
     * Sets the paths of the files that will be used from the "schema" 
     * directory.
     */
    private function setSchemaFiles()
    {
        $this->files['announcements'] = $this->schemaDir . '/announcements.xml';
        $this->files['comments'] = $this->schemaDir . '/comments.xml';
        $this->files['common'] = $this->schemaDir . '/common.xml';
        $this->files['controlledVocab'] = $this->schemaDir 
            . '/controlledVocab.xml';
        //$this->files['gifts'] = $this->schemaDir . '/gifts.xml';
        $this->files['groups'] = $this->schemaDir . '/groups.xml';
        $this->files['log'] = $this->schemaDir . '/log.xml';
        $this->files['metadata'] = $this->schemaDir . '/metadata.xml';
        //$this->files['metrics'] = $this->schemaDir . '/metrics.xml';
        //$this->files['mutex'] = $this->schemaDir . '/mutex.xml';
        $this->files['notes'] = $this->schemaDir . '/notes.xml';
        $this->files['reviewForms'] = $this->schemaDir . '/reviewForms.xml';
        $this->files['reviews'] = $this->schemaDir . '/reviews.xml';
        //$this->files['scheduledTasks'] = $this->schemaDir 
        //    . '/scheduledTasks.xml';
        //$this->files['signoff'] = $this->schemaDir . '/signoff.xml';
        $this->files['submissions'] = $this->schemaDir . '/submissions.xml';
        //$this->files['temporaryFiles'] = $this->schemaDir 
        //    . '/temporaryFiles.xml';
        //$this->files['tombstone'] = $this->schemaDir . '/tombstone.xml';
    }
    
    /**
     * Sets the paths of the files from the dbscripts directory that will be 
     * used.
     */
    private function setDbscriptFiles()
    {
        $this->files['ojs_schema'] = $this->dbscriptsDir 
            . '/xml/ojs_schema.xml';
    }
    
    /**
     * Constructor of the class SchemaHandler.
     * 
     * @param array $tablesToBeUsed
     * @param string $schemaDir - The absolute path of the schema directory.
     * @param string $dbscriptsDir - The absolute path of the dbscripts 
     * directory.
     */
    public function __construct(
        $tablesToBeUsed = array(),
        $schemaDir = null,
        $dbscriptsDir = null
    ) {
        $this->tablesToBeUsed = $tablesToBeUsed;
        $this->setSchemaDir($schemaDir);
        $this->setDbscriptDir($dbscriptsDir);
        
        $this->files = array();
        $this->setSchemaFiles();
        $this->setDbscriptFiles();
        
        $this->typeMapping = array(
            'I1' => 'tinyint(4)',
            'I2' => 'smallint(6)',
            'I4' => 'int(11)',
            'I8' => 'bigint(20)',
            'F' => 'double',
            'C' => 'varchar',
            'D' => 'date',
            'T' => 'datetime',
            'X' => 'text',
        );
    }
    
    /**
     * Gets the information about the field. Its name, type and whether or not 
     * it might be null.
     * 
     * @param \DOMElement $xml
     * @return array
     */
    private function getFieldProperties($xml)
    {
        /* @var $properties array */
        $properties = array();
        
        $properties['name'] = $xml->getAttribute('name');
        
        /* @var $rawType string */
        $rawType = $xml->getAttribute('type');
        
        if ($xml->hasAttribute('size') && substr($rawType, 0, 1) == 'C') {
            $properties['type'] = 'varchar(' . $xml->getAttribute('size') . ')';
        } else {
            $properties['type'] = $this->typeMapping[$rawType];
        }
        
        $properties['nullable'] = true;
        
        /* @var $childNode \DOMNode */
        foreach ($xml->childNodes as $childNode) {
            if ($childNode->nodeName == 'NOTNULL') {
                $properties['nullable'] = false;
            }
        }
        
        return $properties;
    }
    
    /**
     * Creates an instance of EntityDescription, configures and registers it.
     * 
     * @param \DOMElement $xml
     */
    private function makeAndRegisterEntityDescription($xml)
    {
        /* @var $tableName string */
        $tableName = $xml->getAttribute('name');
        
        $entityDescription = new EntityDescription($tableName);
        
        /* @var $fields \DOMNodeList */
        $fields = $xml->getElementsByTagName('field');
        
        /* @var $field \DOMElement */
        foreach ($fields as $field) {
            /* @var $fieldProperties array */
            $fieldProperties = $this->getFieldProperties($field);

            $propertyDescription = new PropertyDescription(
                $fieldProperties['name'],
                $fieldProperties['type'],
                $fieldProperties['nullable']
            );

            $entityDescription->addPropertyDescription($propertyDescription);
        }
        
        EntityDescriptionRegistry::set($tableName, $entityDescription);
    }
    
    /**
     * Creates and registers objects from class EntityDescription based on the 
     * xml schema present in the specified file.
     * 
     * @param string $filename
     */
    private function makeEntitiesDescriptionsFromFile($filename)
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->load($filename);
        
        /* @var $tables \DOMNodeList */
        $tables = $xml->getElementsByTagName('table');
        
        /* @var $table \DOMElement */
        foreach ($tables as $table) {
            if (empty($this->tablesToBeUsed) ||
                in_array($table->getAttribute('name'), $this->tablesToBeUsed)
            ) {
                $this->makeAndRegisterEntityDescription($table);
            }
        }
    }
    
    /**
     * Reads the database tables schema, creates EntityDescription objects and 
     * register them in the EntityDescriptionRegistry.
     */
    public function registerEntitiesDescriptions()
    {
        /* @var $filename string */
        foreach ($this->files as $filename) {
            $this->makeEntitiesDescriptionsFromFile($filename); 
        }
    }
}
