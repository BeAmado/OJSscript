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
    public function getName()
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
        $tableName = $this->getName();
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
     * Returns a clone of the EntitySetting.
     * 
     * If the setting does not exist, false is returned.
     * 
     * @param string $settingName
     * @param string $locale
     * @return mixed
     */
    public function getSetting($settingName, $locale)
    {
        /* @var $setting EntitySetting */
        foreach ($this->settings as $setting) {
            if ($setting->getName() === $settingName &&
                $setting->getLocale() === $locale) {
                return $setting->cloneInstance();
            }
        }
        
        return false;
    }
    
    /**
     * Returns an array with clones of the settings.
     * 
     * @return array
     */
    public function getSettings()
    {
        /* @var $clonedSettings array */
        $clonedSettings = array();
        
        /* @var $setting EntitySetting */
        foreach ($this->settings as $setting) {
            $clonedSettings[] = $setting->cloneInstance();
        }
        
        return $clonedSettings;
    }
    
    /**
     * Checks whether or not teh Entity has associated entities in it.
     * 
     * @return boolean
     */
    public function hasAssociatedEntities()
    {
        return is_array($this->associatedEntities);
    }
    
    /**
     * Clones the array of the specified associate Entity.
     * 
     * @return array
     */
    protected function cloneAssociatedEntities($entityName)
    {
        /* @var $clones array */
        $clones = array();
        
        /* @var $entity Entity */
        foreach ($this->associatedEntities[$entityName] as $entity) {
            $clones[] = $entity->cloneInstance();
        }
        
        return $clones;
    }
    
    /**
     * Returns an array of clones of the associated entities.
     * 
     * The parameter "entitiesNames is an array with the names of the entities 
     * to be fetched (cloned).
     * 
     * @param array $entitiesNames
     * @return array
     */
    public function getAssociatedEntities($entitiesNames)
    {
        /* @var $associatedEntities array */
        $associatedEntities = array();
        
        /* @var $entityName string */
        foreach ($entitiesNames as $entityName) {
            
            if (array_key_exists($entityName, $this->associatedEntities)) {
                $associatedEntities[$entityName] = 
                    $this->cloneAssociatedEntities($entityName);
            } else {
                $associatedEntities[$entityName] = 'There is not any '
                    . 'associated entity that corresponds to the name "'
                    . $entityName . '"';
            }
            
        }
        
        return $associatedEntities;
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
     * @return boolean
     */
    public function setProperty(
        $propertyName,
        $propertyValue
    ) {
        /* @var $validator EntityValidator */
        $validator = EntityValidatorRegistry::get($this->getName());
        
        /* @var $result array */
        $result = $validator->validateProperty($propertyName, $propertyValue);
        
        if ($result['isValid']) {
            $this->properties[$propertyName] = $propertyValue;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Adds the setting.
     * 
     * @param EntitySetting $setting
     * 
     * @return boolean
     */
    public function addSetting($setting)
    {
        if (!is_a($setting, '\OJSscript\Entity\Abstraction\EntitySetting')) {
            return false;
        } elseif ($setting->getEntityType() !== $this->getEntityType()) {
            return false;
        } else {
            $this->settings[] = $setting;
            return true;
        }
    }
    
    public function addAssociatedEntity($entity)
    {
        
    }

    /**
     * Returns a new instance with the same properties.
     * @return Entity
     */
    public function cloneInstance()
    {
        $clone = new Entity();
        foreach ($this->properties as $propertyName => $propertyValue) {
            $clone->setProperty($propertyName, $propertyValue);
        }
        return $clone;
    }
    
    /**
     * Clones the Entity
     * @return Entity
     */
    public function __clone()
    {
        return $this->cloneInstance();
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
            $arrReturn['settings'] = array();
            
            /* @var $setting EntitySetting */
            foreach ($this->settings as $setting) {
                $arrReturn['settings'][] = $setting->asArray();
            }
        }
        
        if ($this->hasAssociatedEntities()) {
            
            /* @var $associatedEntity Entity */
            foreach ($this->associatedEntities as $associatedEntity) {
                $arrReturn[$associatedEntity->getName()] = 
                    $associatedEntity->asArray();
            }
        }
        
        return $arrReturn;
    }

    /**
     * Load the entity's data from an array.
     * 
     * @param array $array
     * 
     * @return boolean
     */
    public function loadArray($array)
    {
        /* @var $validator EntityValidator */
        $validator = EntityValidatorRegistry::get($this->getName());
        
        /* @var $result array */
        $validateArray = $validator->validateArray($array);
        
        if (!$validateArray['isValid']) {
            return false;
        } 
        
        /* @var $associatedEntitiesNames array */
        $associatedEntitiesNames = 
            $validator->getAllowedAssociatedEntitiesNames();
        
        foreach ($array as $key => $value) {
            if (in_array($key, $associatedEntitiesNames)) {
                //$this->associatedEntities['key']
            }
            
        }
        
    }

}
