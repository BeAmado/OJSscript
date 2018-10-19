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
    'name' => 'UpdateReviewRound',
    
    'query' => 
        'UPDATE review_rounds '
      . 'SET '
      .           'stage_id = :UpdateReviewRound_stageId, '
      .              'round = :UpdateReviewRound_round, '
      .    'review_revision = :UpdateReviewRound_reviewRevision, '
      .             'status = :UpdateReviewRound_status '
      . 'WHERE '
      .    'review_round_id = :UpdateReviewRound_reviewRoundId',

    'params' => array(
        'stage_id'        => ':UpdateReviewRound_stageId',
        'round'           => ':UpdateReviewRound_round',
        'review_revision' => ':UpdateReviewRound_reviewRevision',
        'status'          => ':UpdateReviewRound_status',
        'review_round_id' => ':UpdateReviewRound_reviewRoundId',
    ),
);
