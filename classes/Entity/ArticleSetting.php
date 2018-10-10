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

namespace OJSscript\Entity;
use OJSscript\Interfaces\ExtraPropertiesIndicator;

/**
 * Represents an OJS article_setting, which do not have any property other than:
 * 1 - article_id
 * 2 - locale
 * 3 - setting_name
 * 4 - setting_value
 * 5 - setting_type
 * 
 * @author bernardo
 */
class ArticleSetting extends EntitySetting implements ExtraPropertiesIndicator
{
    
    public function __construct()
    {
        parent::__construct('article');
    }
    
    /**
     * Always returns false, since article_settings do not have extra 
     * properties.
     * @return boolean
     */
    public function hasExtraProperties()
    {
        return false;
    }
    
    public function getArticleId()
    {
        return $this->id;
    }
    
    public function setArticleId($id)
    {
        return $this->setId($id);
    }
}
