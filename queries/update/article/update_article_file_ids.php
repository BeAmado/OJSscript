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
    'name' => 'UpdateArticleFileIds',
    
    'query' => 
        'UPDATE articles '
      . 'SET '
      .    'submission_file_id = :UpdateArticleFileIds_submissionFileId, '
      .       'revised_file_id = :UpdateArticleFileIds_revisedFileId, '
      .        'review_file_id = :UpdateArticleFileIds_reviewFileId, '
      .        'editor_file_id = :UpdateArticleFileIds_editorFileId '
      . 'WHERE '
      .            'article_id = :UpdateArticleFileIds_articleId',

    'params' => array(
        'submission_file_id' => ':UpdateArticleFileIds_submissionFileId',
        'revised_file_id'    => ':UpdateArticleFileIds_revisedFileId',
        'review_file_id'     => ':UpdateArticleFileIds_reviewFileId',
        'editor_file_id'     => ':UpdateArticleFileIds_editorFileId',
        'article_id'         => ':UpdateArticleFileIds_articleId'
    ),
);
