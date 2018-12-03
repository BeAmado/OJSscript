<?php

/*
 * Copyright (C) 2018 Bernardo Amado
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

namespace OJSscript\Entity\Abstraction;
use OJSscript\Interfaces\Cloneable;
use OJSscript\Interfaces\ArrayRepresentation;
use OJSscript\Interfaces\LoadFromArray;
use OJSscript\Core\InputValidator;
use OJSscript\Core\Registry;


/**
 * Generic class to encapsulate an object properties. This class is to be 
 * extended by all of the classes that represent OJS data.
 *
 * @author bernardo
 */
class Entity implements Cloneable, ArrayRepresentation, LoadFromArray
{
    /**
     * The name of the table that the Entity represents.
     * 
     * @var string
     */
    private $tableName;
    
    /**
     * Array that encapsulates the object's properties.
     * 
     * @var array
     */
    private $properties;
    
    /**
     * Array that encapsulates the Entities, or array of Entities, that are 
     * associated with the object. 
     * 
     * For example: if the Entity is an article then the associatedEntities 
     * would be array of article_files, 
     * array of article_galleys(array) and so on...
     * 
     * @var array
     */
    private $associatedEntities;
    
    /**
     * The entity's settings, if exist.
     * 
     * @var array
     */
    private $settings;

    /**
     * Initializes the entity's properties with as an empty array.
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public function __construct(
        $tableName,
        $hasSettings = false, 
        $hasAssociatedEntities = false
    ) {
        if (InputValidator::validate($tableName, 'string')) {
            $this->tableName = $tableName;
        } else {
            $message = 'The name of the table that the entity represents is '
                . 'expected to be a "string" and not null.';
            throw new \Exception($message);
        }
        
        $this->properties = array();
        if ($hasSettings) {
            $this->settings = array();
        }
        
        if ($hasAssociatedEntities) {
            $this->associatedEntities = array();
        }
    }
    
    /**
     * Returns the name of the table that the Entity represents.
     * 
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }
    
    /**
     * Returns the type of the entity.
     * 
     * For example: "article", "user", "issue", "article_search_object"
     * 
     * @return string
     */
    public function getEntityType()
    {
        $tableName = $this->getTableName();
        if (substr($tableName, -3) === 'ies') {
            return substr($tableName, 0, -1) . 'y';
        }
        elseif (substr($tableName, -1) === 's') {
            return substr($tableName, 0, -1);
        }
        else {
            return $tableName;
        }
    }
    
    /**
     * Checks if the Entity has settings.
     * 
     * @return boolean
     */
    public function hasSettings()
    {
        return is_array($this->settings);
    }
    
    /**
     * Returns the array with the entity's settings. If the entity does not 
     * have settings the return value will be false.
     * 
     * @return mixed
     */
    public function getSettings()
    {
        if ($this->hasSettings()) {
            return $this->settings;
        } else {
            return false;
        }
    }
    
    /**
     * Checks whether or not the Entity has associated entities in it.
     * 
     * @return boolean
     */
    public function hasAssociatedEntities()
    {
        return is_array($this->associatedEntities);
    }
    
    /**
     * Returns the array with the associated entities. If the entity does not 
     * have associated entities the return value is false;
     * 
     * @return mixed
     */
    public function getAssociatedEntitites()
    {
        if ($this->hasAssociatedEntities()) {
            return $this->associatedEntities;
        } else {
            return false;
        }
    }
    
    /**
     * Checks if the entity has the specified property.
     * 
     * @param string $propertyName - The name of the property being searched.
     * @return boolean
     */
    public function hasProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->properties);
    }
    
    
    
    /**
     * Get the specified entity's property. If the property does not exist
     * returns false.
     * 
     * @param string $propertyName
     * @return mixed
     */
    public function getProperty($propertyName)
    {
        if ($this->hasProperty($propertyName)) {
            return $this->properties[$propertyName];
        } else {
            return false;
        }
    }
    
    /**
     * Sets the specified entity's property.
     * 
     * @param string $propertyName
     * @param mixed $propertyValue
     */
    public function setProperty(
        $propertyName,
        $propertyValue
    ) {
        /* @var $entityValidatorRegistry EntityValidatorRegistry */
        $entityValidatorRegistry = Registry::get('EntityValidatorRegistry');
        
        /* @var $validator EntityValidator */
        $validator = $entityValidatorRegistry->get($this->getTableName());
        
        //echo "Validator class: " . get_class($validator) . PHP_EOL; exit();
        
        $validator->validateProperty($propertyName, $propertyValue);
        
        $this->properties[$propertyName] = $propertyValue;
    }
    
    /**
     * Deletes the specified property.
     * 
     * @param string $propertyName
     */
    public function unsetProperty($propertyName)
    {
        if ($this->hasProperty($propertyName)) {
            unset($this->properties[$propertyName]);
        }
    }
    
    /**
     * Adds the setting.
     * 
     * @param \OJSscript\Entity\Abstraction EntitySetting $setting
     * 
     * @return boolean
     */
    public function addSetting($setting)
    {
        if ($this->hasSettings()) {
            /* @var $entityValidatorRegistry EntityValidatorRegistry */
            $entityValidatorRegistry = Registry::get('EntityValidatorRegistry');

            /* @var $validator EntityValidator */
            $validator = $entityValidatorRegistry->get($this->getTableName());
            $validator->validateSetting($setting);

            $this->settings[] = $setting;
        }
    }
    
    /**
     * Adds an Entity to the associatedEntities array.
     * 
     * @param Entity $entity
     * 
     * @return boolean
     */
    public function addAssociatedEntity($entity)
    {
        if ($this->hasAssociatedEntities()) {
            /* @var $entityValidatorRegistry EntityValidatorRegistry */
            $entityValidatorRegistry = Registry::get('EntityValidatorRegistry');

            /* @var $validator EntityValidator */
            $validator = $entityValidatorRegistry->get($this->getTableName());
            $validator->validateEntity($entity);

            $this->associatedEntities[$entity->getTableName()][] = $entity;
        }
    }

    /**
     * Returns a new instance with the same data.
     * 
     * @return Entity
     */
    public function cloneInstance()
    {
        $clone = new Entity(
            $this->tableName,
            $this->hasSettings(),
            $this->hasAssociatedEntities()
        );
        
        foreach ($this->properties as $propertyName => $propertyValue) {
            $clone->setProperty($propertyName, $propertyValue);
        }
        
        if ($this->hasSettings()) {
            /* @var $setting EntitySetting */
            foreach ($this->settings as $setting) {
                $clone->addSetting($setting->cloneInstance());
            }
        }
        
        if ($this->hasAssociatedEntities()) {
            /* @var $assocEntity Entity */
            foreach ($this->associatedEntities as $assocEntity) {
                $clone->addAssociatedEntity($assocEntity->cloneInstance());
            }
        }
        
        return $clone;
    }
    
    /**
     * Clones the Entity.
     * 
     * @return Entity
     */
    public function __clone()
    {
        return $this->cloneInstance();
    }
    
    /**
     * Returns an array representation of the entity settings.
     * 
     * @return array
     */
    private function getSettingsAsArray()
    {
        $settings = array();
            
        /* @var $setting EntitySetting */
        foreach ($this->settings as $setting) {
            $settings[] = $setting->asArray();
        }
        
        return $settings;
    }
    
    /**
     * Returns an array containing the array representations of the associated 
     * entities.
     * 
     * @param array $arrayToAppend - The array into which append the entities.
     * 
     * @return array
     */
    private function getAssociatedEntitiesAsArray(&$arrayToAppend) 
    {
        /* @var $associatedEntity Entity */
        foreach ($this->associatedEntities as $associatedEntity) {
            $arrayToAppend[$associatedEntity->getTableName()][] = 
                $associatedEntity->asArray();
        }
        
    }
    
    /**
     * Array representation of the Entity
     * 
     * @return array
     */
    public function asArray()
    {
        /* @var $arrReturn array */
        $arrReturn = array();
        foreach ($this->properties as $propertyName => $propertyValue) {
            if (is_a($propertyValue,
                '\OJSscript\Entity\Abstraction\Entity')
            ) {
                /* @var $propertyValue Entity */
                $arrReturn[$propertyName] = $propertyValue->asArray();
                
            } else {
                $arrReturn[$propertyName] = $propertyValue;
            }
        }
        
        if ($this->hasSettings()) {
            $arrReturn['settings'] = $this->getSettingsAsArray();
        }
        
        if ($this->hasAssociatedEntities()) {
            $assocEntities = array();
            $this->getAssociatedEntitiesAsArray($assocEntities);
            $arrReturn['associatedEntities'] = $assocEntities;
        }
        
        return $arrReturn;
    }
    
    /**
     * 
     * @param array $settingsArray
     */
    private function loadSettingsArray($settingsArray)
    {
        /* @var $arrSetting array*/
        foreach ($settingsArray as $arrSetting) {
            $setting = new EntitySetting(
                $this->getEntityType(),
                array_key_exists('extraProperties', $arrSetting)
            );
            
            $setting->loadArray($arrSetting);
            
            $this->addSetting($setting);
        }
    }
    
    /**
     * 
     * @param array $assocEntititesArray
     */
    private function loadAssociatedEntititesArray($assocEntititesArray)
    {
        /* @var $tableName string */
        /* @var $array array */
        foreach ($assocEntititesArray as $tableName => $array) {
            $entity = new Entity(
                $tableName,
                array_key_exists('settings', $array), 
                array_key_exists('associatedEntities', $array)
            );
            
            $entity->loadArray($array);
            $this->addAssociatedEntity($entity);
        }
    }

    /**
     * 
     * @param array $array
     */
    public function loadArray($array)
    {
        /* @var $entityDescriptionRegistry EntityDescriptionRegistry */
        $entityDescriptionRegistry = Registry::get('EntityDescriptionRegistry');
        
        /* @var $entityDescription EntityDescription */
        $entityDescription = $entityDescriptionRegistry->get(
            $this->getTableName()
        );
        
        /* @var $key string */
        /* @var $value mixed */
        foreach ($array as $key => $value) {
            if ($entityDescription->propertyBelongs($key)) {
                $this->setProperty($key, $value);
            } elseif ($key === 'settings') {
                $this->loadSettingsArray($value);
            } elseif ($key === 'associatedEntities') {
                $this->loadAssociatedEntititesArray($value);
            }
        }
    }

}
