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
use OJSscript\Statement\StatementHandler;
use OJSscript\Entity\Abstraction\Entity;
use OJSscript\Entity\Abstraction\EntityHandler;
//use OJSscript\Statement\StatementRegistry;

/**
 * Description of ArticleHandler
 *
 * @author bernardo
 */
class ArticleHandler extends EntityHandler
{
    /**
     *
     * @var integer
     */
    private $journalId;
    
    /**
     * 
     * @return integer
     */
    public function getJournalId()
    {
        return $this->journalId;
    }

    /**
     * 
     * @param integer $journalId
     */
    public function setJournalId($journalId)
    {
        $this->journalId = $journalId;
    }

        
    /**
     * 
     * @param integer $journalId
     */
    public function __construct($journalId)
    {
        $this->setJournalId($journalId);
    }
    
    /**
     * Fetches the articles of the journal
     * 
     * @return array - An array of Entity (articles)
     */
    public function fetch()
    {
        StatementHandler::bindSingleParam(
            'SelectArticles',
            'journal_id',
            $this->getJournalId()
        );
        
        /* @var $executed boolean */
        $executed = StatementHandler::execute('SelectArticles');
        
        if (!$executed) {
            //THROW EXCEPTION
            return false;
        }
        
        $articles = array();
        
        /* @var $arrArticle array */
        while ($arrArticle = StatementHandler::fetchNext('SelectArticles')) {
            $article = new Entity('articles', true, true);
            $article->loadArray($arrArticle);
            
            //get the associated entities
            //########################
            ////////////////////////////
            
            $articles[] = $article;
        }
        
        return $articles;
    }

}
