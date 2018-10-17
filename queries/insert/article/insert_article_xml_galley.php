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

return array(
    'name' => 'InsertArticleXmlGalley',
    
    'query' => 
        'INSERT INTO article_xml_galleys '
      .    '(galley_id, '
      .     'article_id, '
      .     'label, '
      .     'galley_type, '
      .     'views) '
      . 'VALUES '
      .    '(:InsertArticleXmlGalley_galleyId, '
      .     ':InsertArticleXmlGalley_articleId, '
      .     ':InsertArticleXmlGalley_label, '
      .     ':InsertArticleXmlGalley_galleyType, '
      .     ':InsertArticleXmlGalley_views)',

    'params' => array(
        'galley_id'   => ':InsertArticleXmlGalley_galleyId',
        'article_id'  => ':InsertArticleXmlGalley_articleId',
        'label'       => ':InsertArticleXmlGalley_label',
        'galley_type' => ':InsertArticleXmlGalley_galleyType',
        'views'       => ':InsertArticleXmlGalley_views',
    ),
);
