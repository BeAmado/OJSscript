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
    'name' => 'InsertArticleSupplementaryFile',
    
    'query' => 
        'INSERT INTO article_supplementary_files '
      .    '(file_id, '
      .     'article_id, '
      .     'type, '
      .     'language, '
      .     'date_created, '
      .     'show_reviewers, '
      .     'date_submitted, '
      .     'seq, '
      .     'remote_url) '
      . 'VALUES '
      .    '(:InsertArticleSupplementaryFile_fileId, '
      .     ':InsertArticleSupplementaryFile_articleId, '
      .     ':InsertArticleSupplementaryFile_type, '
      .     ':InsertArticleSupplementaryFile_language, '
      .     ':InsertArticleSupplementaryFile_dateCreated, '
      .     ':InsertArticleSupplementaryFile_showReviewers, '
      .     ':InsertArticleSupplementaryFile_dateSubmitted, '
      .     ':InsertArticleSupplementaryFile_seq, '
      .     ':InsertArticleSupplementaryFile_remoteUrl)',

    'params' => array(
        'file_id'        => ':InsertArticleSupplementaryFile_fileId',
        'article_id'     => ':InsertArticleSupplementaryFile_articleId',
        'type'           => ':InsertArticleSupplementaryFile_type',
        'language'       => 'InsertArticleSupplementaryFile_language',
        'date_created'   => ':InsertArticleSupplementaryFile_dateCreated',
        'show_reviewers' => ':InsertArticleSupplementaryFile_showReviewers',
        'date_submitted' => ':InsertArticleSupplementaryFile_dateSubmitted',
        'seq'            => ':InsertArticleSupplementaryFile_seq',
        'remote_url'     => ':InsertArticleSupplementaryFile_remoteUrl',
    ),
);
