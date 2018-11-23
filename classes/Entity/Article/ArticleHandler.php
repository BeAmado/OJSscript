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
use OJSscript\Entity\Abstraction\EntitySetting;
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
     * Fetches the article's settings.
     * 
     * @param Entity $article
     */
    private function fetchArticleSettings($article)
    {
        StatementHandler::bindParams('SelectArticleSettings', $article);
        StatementHandler::execute('SelectArticleSettings');
        
        /* @var $arrSetting array */
        while ($arrSetting = 
            StatementHandler::fetchNext('SelectArticleSettings')
        ) {
            $articleSetting = new EntitySetting($article->getEntityType());
            $articleSetting->loadArray($arrSetting);
            
            $article->addSetting($articleSetting);
        }
    }
    
    /**
     * Fetches the unpublished articles from the specified journal.
     * 
     * @param string|integer $journalId
     * 
     * @return array - An array of Entity (articles)
     */
    public function fetchUnpublishedArticles($journalId)
    {
        StatementHandler::bindSingleParam(
            'SelectArticlesFromJournal',
            'journal_id',
            $journalId
        );
        
        StatementHandler::execute('SelectArticlesFromJournal');
        
        $articles = array();
        
        /* @var $arrArticle array */
        while ($arrArticle = 
            StatementHandler::fetchNext('SelectArticlesFromJournal')
        ) {
            
            $article = new Entity('articles', true, true);
            $article->loadArray($arrArticle);
            
            //get the article settings
            $this->fetchArticleSettings($article);
            
            //get the associated entities
            //########################
            ////////////////////////////
            
            $articles[] = $article;
        }
        
        return $articles;
    }

}
