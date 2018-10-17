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
    'name' => 'InsertArticleNote',
    
    'query' => 
        'INSERT INTO article_notes '
      .    '(article_id, '
      .     'user_id, '
      .     'date_created, '
      .     'date_modified, '
      .     'title, '
      .     'note, '
      .     'file_id) '
      . 'VALUES '
      .    '(:InsertArticleNote_articleId, '
      .     ':InsertArticleNote_userId, '
      .     ':InsertArticleNote_dateCreated, '
      .     ':InsertArticleNote_dateModified, '
      .     ':InsertArticleNote_title, '
      .     ':InsertArticleNote_note, '
      .     ':InsertArticleNote_fileId)',

    'params' => array(
        'article_id'    => ':InsertArticleNote_articleId',
        'user_id'       => ':InsertArticleNote_userId',
        'date_created'  => ':InsertArticleNote_dateCreated',
        'date_modified' => ':InsertArticleNote_dateModified',
        'title'         => ':InsertArticleNote_title',
        'note'          => ':InsertArticleNote_note',
        'file_id'       => ':InsertArticleNote_fileId',
    ),
);
