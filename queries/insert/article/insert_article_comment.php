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
    'name' => 'InsertArticleComment',
    
    'query' => 
        'INSERT INTO article_comments '
      .    '(comment_type, '
      .     'role_id, '
      .     'article_id, '
      .     'assoc_id, '
      .     'author_id, '
      .     'comment_title, '
      .     'comments, '
      .     'date_posted, '
      .     'date_modified, '
      .     'viewable) '
      . 'VALUES '
      .    '(:InsertArticleComment_commentType, '
      .     ':InsertArticleComment_roleId, '
      .     ':InsertArticleComment_articleId, '
      .     ':InsertArticleComment_assocId, '
      .     ':InsertArticleComment_authorId, '
      .     ':InsertArticleComment_commentTitle, '
      .     ':InsertArticleComment_comments, '
      .     ':InsertArticleComment_datePosted, '
      .     ':InsertArticleComment_dateModified, '
      .     ':InsertArticleComment_viewable)',

    'params' => array(
        'comment_type'  => ':InsertArticleComment_commentType',
        'role_id'       => ':InsertArticleComment_roleId',
        'article_id'    => ':InsertArticleComment_articleId',
        'assoc_id'      => ':InsertArticleComment_assocId',
        'author_id'     => ':InsertArticleComment_authorId',
        'comment_title' => ':InsertArticleComment_commentTitle',
        'comments'      => ':InsertArticleComment_comments',
        'date_posted'   => ':InsertArticleComment_datePosted',
        'date_modified' => ':InsertArticleComment_dateModified',
        'viewable'      => ':InsertArticleComment_viewable',
    ),
);
