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
 * Represents an OJS article which might have the following properties
 *  
 * @author bernardo
 */
class Article extends Entity implements LoadFromArray
{
    /**
     * An array containing the names of the tables of the entities that might be 
     * associated with an article.
     * 
     * @var array
     */
    private $associatedEntitiesNames;
    
    public function __construct()
    {
        parent::__construct('articles', true, true);
        $this->associatedEntitiesNames = array(
        //      OJS 2.x                         OJS 3.x
            'article_comments',            'submission_comments',
            'article_files',               'submission_files',
            'article_galleys',             'submission_galleys',
            'article_search_objects',      'submission_search_objects',
            'article_supplementary_files', 'submission_supplementary_files',
                                           'submission_tombstones',
        );
    }

    /**
     * Loads the article info from an array.
     * 
     * @param array $array - The array containing the article's informations.
     * 
     * @return boolean
     */
    public function loadArray($array)
    {
       
    }

}
