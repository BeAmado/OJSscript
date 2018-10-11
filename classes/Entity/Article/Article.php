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

/**
 * Represents an OJS article which might have the following properties
 *  1 - article_id              NULL -> No
 *  2 - locale                  NULL -> Yes
 *  3 - user_id                 NULL -> No
 *  4 - journal_id              NULL -> No
 *  5 - section_id              NULL -> Yes
 *  6 - language                NULL -> Yes
 *  7 - comments_to_ed          NULL
 *  8 - citations               NULL
 *  9 - date_submitted          NULL
 * 10 - last_modified           NULL
 * 11 - date_status_modified    NULL
 * 12 - status                  NULL
 * 13 - submission_progress     NULL
 * 14 - current_round           NULL
 * 15 - submission_file_id      NULL
 * 16 - revised_file_id         NULL
 * 17 - review_file_id          NULL
 * 18 - editor_file_id          NULL
 * 19 - pages                   NULL
 * 20 - fast_tracked            NULL
 * 21 - hide_author             NULL
 * 22 - comments_status         NULL
 *
 * @author bernardo
 */
class Article extends Entity
{
    public function getArticleId()
    {
        return $this->getProperty('article_id');
    }
    
    public function setArticleId($id)
    {
        if (is_numeric($id)) {
            $id = (int) $id;
        }
        
        return $this->setProperty('article_id', $id, 'integer');
    }
    
    public function getLocale()
    {
        return $this->getProperty('locale');
    }
    
    public function setLocale($locale)
    {
        if ($locale === null) {
            return $this->setProperty('locale', null);
        } else {
            return $this->setProperty('locale', $locale, 'string');
        }
    }
}
