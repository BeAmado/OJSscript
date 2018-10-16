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
 *  1 - article_id              NULL -> No    bigint(20)                   (PK)
 *  2 - locale                  NULL -> Yes   varchar(5)    default NULL
 *  3 - user_id                 NULL -> No    bigint(20)
 *  4 - journal_id              NULL -> No    bigint(20)
 *  5 - section_id              NULL -> Yes   bigint(20)    default NULL
 *  6 - language                NULL -> Yes   varchar(10)   default "en"
 *  7 - comments_to_ed          NULL -> Yes   text          default NULL
 *  8 - citations               NULL -> Yes   text          default NULL
 *  9 - date_submitted          NULL -> Yes   datetime      default NULL
 * 10 - last_modified           NULL -> Yes   datetime      default NULL
 * 11 - date_status_modified    NULL -> Yes   datetime      default NULL
 * 12 - status                  NULL -> No    tinyint(4)    default 1
 * 13 - submission_progress     NULL -> No    tinyint(4)    default 1
 * 14 - current_round           NULL -> No    tinyint(4)    default 1
 * 15 - submission_file_id      NULL -> Yes   bigint(20)    default NULL
 * 16 - revised_file_id         NULL -> Yes   bigint(20)    default NULL
 * 17 - review_file_id          NULL -> Yes   bigint(20)    default NULL
 * 18 - editor_file_id          NULL -> Yes   bigint(20)    default NULL
 * 19 - pages                   NULL -> Yes   varchar(255)  default NULL
 * 20 - fast_tracked            NULL -> No    tinyint(4)    default 0
 * 21 - hide_author             NULL -> No    tinyint(4)    default 0
 * 22 - comments_status         NULL -> No    tinyint(4)    default 0
 *
 * @author bernardo
 */
class Article extends Entity implements LoadFromArray
{
    public function setArticleId($id)
    {
        return $this->setProperty('article_id', $id, 'integer');
    }
    
    public function setLocale($locale)
    {
        return $this->setProperty('locale', $locale, 'string', true);
    }
    
    public function setUserId($id)
    {
        return $this->setProperty('user_id', $id, 'integer');
    }
    
    public function setJournalId($id)
    {
        return $this->setProperty('journal_id', $id, 'integer');
    }
    
    public function setSectionId($id)
    {
        return $this->setProperty('section_id', $id, 'integer', true);
    }
    
    public function setLanguage($language)
    {
        return $this->setProperty('language', $language, 'string', true, 10);
    }
    
    public function setCommentsToEd($comments)
    {
        return $this->setProperty('comments_to_ed', $comments, 'string', true);
    }
    
    public function setCitations($citations)
    {
        return $this->setProperty('citations', $citations, 'string', true);
    }
    
    public function setDateSubmitted($date)
    {
        return $this->setProperty('date_submitted', $date, 'string', true);
    }
    
    public function setLastModified($date)
    {
        return $this->setProperty('last_modified', $date, 'string', true);
    }
    
    public function setDateStatusModified($date)
    {
        return $this->setProperty(
            'date_status_modified',
            $date,
            'string',
            true
        );
    }
    
    public function setStatus($status)
    {
        return $this->setProperty('status', $status, 'integer');
    }
    
    public function setSubmissionProgress($progress)
    {
        return $this->setProperty('submission_progress', $progress, 'integer');
    }
    
    public function setCurrentRound($round)
    {
        return $this->setProperty('current_round', $round, 'integer');
    }
    
    public function setSubmissionFileId($id)
    {
        return $this->setProperty('submission_file_id', $id, 'integer', true);
    }
    
    public function setRevisedFileId($id)
    {
        return $this->setProperty('revised_file_id', $id, 'integer', true);
    }
    
    public function setReviewFileId($id)
    {
        return $this->setProperty('review_file_id', $id, 'integer', true);
    }
    
    public function setEditorFileId($id)
    {
        return $this->setProperty('editor_file_id', $id, 'integer', true);
    }
    
    public function setPages($pages)
    {
        return $this->setProperty('pages', $pages, 'string', true, 255);
    }
    
    public function setFastTracked($fastTracked)
    {
        return $this->setProperty('fast_tracked', $fastTracked, 'integer');
    }
    
    public function setHideAuthor($hideAuthor)
    {
        return $this->setProperty('hide_author', $hideAuthor, 'integer');
    }
    
    public function setCommentsStatus($status)
    {
        return $this->setProperty('comments_status', $status, 'integer');
    }
    
    /**
     * 
     * @param array $array
     * @return boolean
     */
    protected function arrayIsValid($array)
    {
        if (!is_array($array) || empty($array)) {
            return false;
        }
        
        $requiredFields = array(
            'article_id',    'user_id',         'journal_id',
            'status',        'comments_status', 'submission_progress', 
            'current_round', 'fast_tracked',    'hide_author', 
        );
        
        $fields = array_keys($array);
        
        $intersection = array_intersect($requiredFields, $fields);
        
        if (count($intersection) === count($requiredFields)) {
            return true;
        } else {
            return false;
        }
        
    }

    public function loadArray($array)
    {
        if (!$this->arrayIsValid($array)) {
            return false;
        }
        
        $this->setArticleId($array['article_id']);
        $this->setUserId($array['user_id']);
        $this->setJournalId($array['journal_id']);
    }

}
