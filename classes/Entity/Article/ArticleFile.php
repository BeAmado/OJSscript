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

namespace OJSscript\Entity\Article;
use OJSscript\Entity\Abstraction\Entity;
use OJSscript\Interfaces\LoadFromArray;

/**
 * Representation of OJS article file
 * 
 *  1 - file_id              Null -> No      bigint(20)   (PK)
 *  2 - revision             Null -> No      bigint(20)   (PK)
 *  3 - source_file_id       Null -> Yes     bigint(20)   
 *  4 - source_revision      Null -> Yes     bigint(20)   
 *  5 - article_id           Null -> No      bigint(20)   
 *  6 - file_name            Null -> No      varchar(90)  
 *  7 - file_type            Null -> No      varchar(255) 
 *  8 - file_size            Null -> No      bigint(20)   
 *  9 - original_file_name   Null -> Yes     varchar(127) 
 * 10 - file_stage           Null -> No      bigint(20)   
 * 11 - viewable             Null -> Yes     tinyint(4)  
 * 12 - date_uploaded        Null -> No      datetime     
 * 13 - date_modified        Null -> No      datetime     
 * 14 - round                Null -> No      tinyint(4)   
 * 15 - assoc_id             Null -> Yes     bigint(20)  
 *
 * @author bernardo
 */
class ArticleFile extends Entity implements LoadFromArray
{
    /**
     * Sets the id of the article file.
     * 
     * The file id *MUST NOT* be _null_ and *MUST* be _greater than 0_. 
     * If a numeric string is passed, it will be coerced into an integer.
     * 
     * @param integer|string $id - The id of the file. 
     * 
     * @return boolean
     */
    public function setFileId($id)
    {
        if ($id > 0) {
            return $this->setProperty('file_id', $id, 'integer');
        } else {
            return false;
        }
    }
    
    /**
     * Sets the article file revision number.
     * 
     * The revision number *MUST NOT* be _null_ and *MUST* be _greater than 0_.
     * If a numeric string is passed, it will be coerced into an integer.
     * 
     * @param integer|string $revision - The article revision number
     * @return boolean
     */
    public function setRevision($revision)
    {
        if ($revision > 0) {
            return $this->setProperty('revision', $revision, 'integer');
        } else {
            return false;
        }
    }
    
    /**
     * Loads the article file data from an array.
     * 
     * @param array $array
     */
    public function loadArray($array)
    {
        
    }

}
