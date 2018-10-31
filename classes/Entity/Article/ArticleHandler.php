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
//use OJSscript\Statement\StatementRegistry;

/**
 * Description of ArticleHandler
 *
 * @author bernardo
 */
class ArticleHandler
{
    /**
     * Fetches the articles of the specified journal
     * 
     * @param integer $journalId
     * @return array - An array of Entity (articles)
     */
    public static function fetchArticles($journalId)
    {
        StatementHandler::bindSingleParam(
            'SelectArticles',
            'journal_id',
            $journalId
        );
        
        $articles = array();
        
        /* @var $arrArticle array */
        while ($arrArticle = StatementHandler::fetchNext('SelectArticles')) {
            $article = new Article();
            $article->loadArray($arrArticle);
            
            //get the associated entities
            //########################
            ////////////////////////////
            
            $articles[] = $article;
        }
        
        return $articles;
        
    }
}
