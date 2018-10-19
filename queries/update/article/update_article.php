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
    'name' => 'UpdateArticle',
    
    'query' => 
        'UPDATE articles '
      . 'SET '
      .             'language = :UpdateArticle_language, '
      .       'comments_to_ed = :UpdateArticle_commentsToEd, '
      .       'date_submitted = :UpdateArticle_dateSubmitted, '
      .        'last_modified = :UpdateArticle_lastModified, '
      . 'date_status_modified = :UpdateArticle_dateStatusModified, '
      .               'status = :UpdateArticle_status, '
      .  'submission_progress = :UpdateArticle_submissionProgress, '
      .        'current_round = :UpdateArticle_currentRound, '
      .                'pages = :UpdateArticle_pages, '
      .         'fast_tracked = :UpdateArticle_fastTracked, '
      .          'hide_author = :UpdateArticle_hideAuthor, '
      .      'comments_status = :UpdateArticle_commentsStatus, '
      .               'locale = :UpdateArticle_locale, '
      .            'citations = :UpdateArticle_citations '
      . 'WHERE '
      .           'article_id = :UpdateArticle_articleId',

    'params' => array(
        'language'             => ':UpdateArticle_language',
        'comments_to_ed'       => ':UpdateArticle_commentsToEd',
        'date_submitted'       => ':UpdateArticle_dateSubmitted',
        'last_modified'        => ':UpdateArticle_lastModified',
        'date_status_modified' => ':UpdateArticle_dateStatusModified',
        'status'               => ':UpdateArticle_status',
        'submission_progress'  => ':UpdateArticle_submissionProgress',
        'current_round'        => ':UpdateArticle_currentRound',
        'pages'                => ':UpdateArticle_pages',
        'fast_tracked'         => ':UpdateArticle_fastTracked',
        'hide_author'          => ':UpdateArticle_hideAuthor',
        'comments_status'      => ':UpdateArticle_commentsStatus',
        'locale'               => ':UpdateArticle_locale',
        'citations'            => ':UpdateArticle_citations',
        'article_id'           => ':UpdateArticle_articleId',
    ),
);
