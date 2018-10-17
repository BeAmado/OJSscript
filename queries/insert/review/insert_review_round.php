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
    'name' => 'InsertReviewRound',
    
    'query' => 
        'INSERT INTO review_rounds '
      .    '(submission_id, '
      .     'stage_id, '
      .     'round, '
      .     'review_revision, '
      .     'status) '
      . 'VALUES '
      .    '(:InsertReviewRound_submissionId, '
      .     ':InsertReviewRound_stageId, '
      .     ':InsertReviewRound_round, '
      .     ':InsertReviewRound_reviewRevision, '
      .     ':InsertReviewRound_status)',

    'params' => array(
        'submission_id'   => ':InsertReviewRound_submissionId',
        'stage_id'        => ':InsertReviewRound_stageId',
        'round'           => ':InsertReviewRound_round',
        'review_revision' => ':InsertReviewRound_reviewRevision',
        'status'          => ':InsertReviewRound_status',
    ),
);
