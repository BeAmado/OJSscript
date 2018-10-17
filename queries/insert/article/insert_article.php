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
    'name' => 'InsertArticle',
    
    'query' => 
        'INSERT INTO articles '
      .     '( user_id, '
      .       'journal_id, '
      .       'section_id, '
      .       'language, '
      .       'comments_to_ed, '
      .       'date_submitted, '
      .       'last_modified, '
      .       'date_status_modified, '
      .       'status, '
      .       'submission_progress, '
      .       'current_round, '
      .       'pages, '
      .       'fast_tracked, '
      .       'hide_author, '
      .       'comments_status, '
      .       'locale, '
      .       'citations ) '
      . 'VALUES '
      .     '( :InsertArticle_userId, '
      .       ':InsertArticle_journalId, '
      .       ':InsertArticle_sectionId, '
      .       ':InsertArticle_language, '
      .       ':InsertArticle_commentsToEd, '
      .       ':InsertArticle_dateSubmitted, '
      .       ':InsertArticle_lastModified, '
      .       ':InsertArticle_dateStatusModified, '
      .       ':InsertArticle_status, '
      .       ':InsertArticle_submissionProgress, '
      .       ':InsertArticle_currentRound, '
      .       ':InsertArticle_pages, '
      .       ':InsertArticle_fastTracked, '
      .       ':InsertArticle_hideAuthor, '
      .       ':InsertArticle_commentsStatus, '
      .       ':InsertArticle_locale, '
      .       ':InsertArticle_citations )',
    
    'params' => array(
                     'user_id' => ':InsertArticle_userId',
                  'journal_id' => ':InsertArticle_journalId',
                  'section_id' => ':InsertArticle_sectionId',
                    'language' => ':InsertArticle_language',
              'comments_to_ed' => ':InsertArticle_commentsToEd',
              'date_submitted' => ':InsertArticle_dateSubmitted',
               'last_modified' => ':InsertArticle_lastModified',
        'date_status_modified' => ':InsertArticle_dateStatusModified',
                      'status' => ':InsertArticle_status',
         'submission_progress' => ':InsertArticle_submissionProgress',
               'current_round' => ':InsertArticle_currentRound',
                       'pages' => ':InsertArticle_pages',
                'fast_tracked' => ':InsertArticle_fastTracked',
                 'hide_author' => ':InsertArticle_hideAuthor',
             'comments_status' => ':InsertArticle_commentsStatus',
                      'locale' => ':InsertArticle_locale',
                   'citations' => ':InsertArticle_citations',
    ),
);