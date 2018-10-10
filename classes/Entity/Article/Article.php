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
 *  1 - article_id
 *  2 - locale
 *  3 - user_id
 *  4 - journal_id
 *  5 - section_id
 *  6 - language
 *  7 - comments_to_ed
 *  8 - citations
 *  9 - date_submitted
 * 10 - last_modified
 * 11 - date_status_modified
 * 12 - status
 * 13 - submission_progress
 * 14 - current_round
 * 15 - submission_file_id
 * 16 - revised_file_id
 * 17 - review_file_id
 * 18 - editor_file_id
 * 19 - pages
 * 20 - fast_tracked
 * 21 - hide_author
 * 22 - comments_status
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
        return $this->setProperty('article_id', $id);
    }
}
