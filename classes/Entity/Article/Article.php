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
 *
 * @author bernardo
 */
class Article extends Entity implements LoadFromArray
{
    /**
     * Sets the article id.
     * 
     * @param int $id - The id of the article, which cannot be null.
     * @return boolean
     */
    public function setArticleId($id)
    {
        return $this->setProperty('article_id', $id, 'integer');
    }
    
    /**
     * Sets the article's locale.
     * 
     * @param string $locale - The article's locale, which must have a maximum 
     * length of 5 and might be null.
     * 
     * @return boolean
     */
    public function setLocale($locale)
    {
        return $this->setProperty('locale', $locale, 'string', true);
    }
    
    /**
     * Represents the id of the user that owns the article.
     * 
     * @param int $id - The id of the user, which cannot be null.
     * @return boolean
     */
    public function setUserId($id)
    {
        return $this->setProperty('user_id', $id, 'integer');
    }
    
    /**
     * Represents the id of the journal on which the article was submitted. The 
     * id must be an integer and cannot be null.
     * 
     * @param int $id - The id of the journal, which cannot be null.
     * @return boolean
     */
    public function setJournalId($id)
    {
        return $this->setProperty('journal_id', $id, 'integer');
    }
    
    /**
     * Represents the id of the journal section to which the article belongs. 
     * 
     * @param int $id - The id of the section, which might be null.
     * @return boolean
     */
    public function setSectionId($id)
    {
        return $this->setProperty('section_id', $id, 'integer', true);
    }
    
    /**
     * The language in which the article was written.
     * 
     * @param string $language - The article's language, which must have a 
     * maximum length of 10 and might be null.
     * 
     * @return boolean
     */
    public function setLanguage($language)
    {
        return $this->setProperty('language', $language, 'string', true, 10);
    }
    
    /**
     * Commentaries to the editor.
     * 
     * @param string $comments - Text with unlimited length, might be null.
     * @return boolean
     */
    public function setCommentsToEd($comments)
    {
        return $this->setProperty('comments_to_ed', $comments, 'string', true);
    }
    
    /**
     * The article's citations.
     * 
     * @param string $citations - Text with unlimited length, might be null.
     * @return boolean
     */
    public function setCitations($citations)
    {
        return $this->setProperty('citations', $citations, 'string', true);
    }
    
    /**
     * The exact date and time the article was submitted.
     * 
     * @param string $date - Datetime
     * @return boolean
     */
    public function setDateSubmitted($date)
    {
        return $this->setProperty('date_submitted', $date, 'string', true);
    }
    
    /**
     * The exact date and time the article suffered its last modification.
     * 
     * @param string $date - Datetime
     * @return boolean
     */
    public function setLastModified($date)
    {
        return $this->setProperty('last_modified', $date, 'string', true);
    }
    
    /**
     * The exact date and time the article changed status.
     * 
     * @param string $date - Datetime
     * @return boolean
     */
    public function setDateStatusModified($date)
    {
        return $this->setProperty(
            'date_status_modified',
            $date,
            'string',
            true
        );
    }
    
    /**
     * The article's status.
     * 
     * @param int $status - The integer number representing the status.
     * @return boolean
     */
    public function setStatus($status)
    {
        return $this->setProperty('status', $status, 'integer');
    }
    
    /**
     * The article's submission progress.
     * 
     * @param int $progress - The integer number representing the submission's 
     * progress.
     * *_CANNOT_ be null*
     * 
     * @return boolean
     */
    public function setSubmissionProgress($progress)
    {
        return $this->setProperty('submission_progress', $progress, 'integer');
    }
    
    /**
     * The article's current revision round.
     * 
     * @param int $round - The integer number representing the revision round 
     * of the article.
     * *_CANNOT_ be null*
     * 
     * @return boolean
     */
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
    
    /**
     * Sets whether or not the article is fast tracked.
     * 
     * @param int $fastTracked - 1 represents that the article *IS* 
     *  _fast tracked_, whilst 0 represents that it *IS NOT*.
     * *_CANNOT_ be null*.
     * 
     * @return boolean
     */
    public function setFastTracked($fastTracked)
    {
        return $this->setProperty('fast_tracked', $fastTracked, 'integer');
    }
    
    /**
     * Sets whether or not the article's author should be hidden.
     * 
     * 
     * @param int $hideAuthor - 1 represents that the author *MUST* be hidden,
     * whilst 0 represents that the author *MUST NOT* be hidden. 
     * *_CANNOT_ be null*.
     * 
     * @return boolean
     */
    public function setHideAuthor($hideAuthor)
    {
        return $this->setProperty('hide_author', $hideAuthor, 'integer');
    }
    
    /**
     * Sets the commentary status for the article.
     * 
     * @param int $status - *_CANNOT_ be null*
     * @return boolean
     */
    public function setCommentsStatus($status)
    {
        return $this->setProperty('comments_status', $status, 'integer');
    }
    
    /**
     * Check if the array is valid for loading the article's information.
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
    
    /**
     * Load the article required fields, i.e. those that must not be null.
     * 
     * Required fields:
     *  1 - article_id
     *  2 - user_id                 
     *  3 - journal_id              
     *  4 - status                  
     *  5 - submission_progress     
     *  6 - current_round           
     *  7 - fast_tracked            
     *  8 - hide_author             
     *  9 - comments_status 
     * 
     * 
     * @param array $array
     * 
     * @return void
     */
    protected function loadRequiredFields($array)
    {
        // 1 - article_id
        $this->setArticleId($array['article_id']);
        
        // 2 - user_id
        $this->setUserId($array['user_id']);
        
        // 3 - journal_id
        $this->setJournalId($array['journal_id']);
        
        // 4 - status
        $this->setStatus($array['status']);
        
        // 5 - submission_progress
        $this->setSubmissionProgress($array['submission_progress']);
        
        // 6 - current_round
        $this->setCurrentRound($array['current_round']);
        
        // 7 - fast_tracked
        $this->setFastTracked($array['fast_tracked']);
        
        // 8 - hide_author
        $this->setHideAuthor($array['hide_author']);
        
        // 9 - comments_status
        $this->setCommentsStatus($array['comments_status']);
    }
    
    /**
     * Loads the not required fields for the article, i.e. those fields 
     * that might be null.
     * 
     * Not required fields:
     *  1 - locale                  
     *  2 - section_id              
     *  3 - language                
     *  4 - comments_to_ed          
     *  5 - citations               
     *  6 - date_submitted          
     *  7 - last_modified           
     *  8 - date_status_modified    
     *  9 - submission_file_id      
     * 10 - revised_file_id         
     * 11 - review_file_id          
     * 12 - editor_file_id          
     * 13 - pages
     *         
     * @param array $array
     * 
     * @return void
     */
    protected function loadNonRequiredFields($array)
    {
        // 1 - locale
        if (array_key_exists('locale', $array)) {
            $this->setLocale($array['locale']);
        }
        
        // 2 - section_id
        if (array_key_exists('section_id', $array)) {
            $this->setSectionId($array['section_id']);
        }
        
        // 3 - language
        if (array_key_exists('language', $array)) {
            $this->setLanguage($array['language']);
        }
        
        // 4 - comments_to_ed
        if (array_key_exists('comments_to_ed', $array)) {
            $this->setCommentsToEd($array['comments_to_ed']);
        }
        
        // 5 - citations
        if (array_key_exists('citations', $array)) {
            $this->setCitations($array['citations']);
        }
        
        // 6 - date_submitted
        if (array_key_exists('date_submitted', $array)) {
            $this->setDateSubmitted($array['sate_submitted']);
        }
        
        // 7 - last_modified
        if (array_key_exists('last_modified', $array)) {
            $this->setLastModified($array['last_modified']);
        }
        
        // 8 - date_status_modified
        if (array_key_exists('date_status_modified', $array)) {
            $this->setDateStatusModified($array['date_status_modified']);
        }
        
        // 9 - submission_file_id
        if (array_key_exists('submission_file_id', $array)) {
            $this->setSubmissionFileId($array['submission_file_id']);
        }
        
        // 10 - revised_file_id
        if (array_key_exists('revised_file_id', $array)) {
            $this->setRevisedFileId($array['revised_file_id']);
        }
        
        // 11 - review_file_id
        if (array_key_exists('review_file_id', $array)) {
            $this->setReviewFileId($array['review_file_id']);
        }
        
        // 12 - editor_file_id
        if (array_key_exists('editor_file_id', $array)) {
            $this->setEditorFileId($array['editor_file_id']);
        }
        
        // 13 - pages
        if (array_key_exists('pages', $array)) {
            $this->setPages($array['pages']);
        }
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
        if (!$this->arrayIsValid($array)) {
            return false;
        }
        
        //Load the required fields, i.e those that MUST NOT be null
        $this->loadRequiredFields($array);
        
        //Load the article required fields, i.e. those that MIGHT be null
        $this->loadNonRequiredFields($array);
        
        return true;
    }

}
