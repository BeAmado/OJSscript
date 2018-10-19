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

return  array(
    'name' => 'UpdateReviewAssignment',
    
    'query' => 
        'UPDATE review_assignments '
      . 'SET '
      .    'competing_interests = :UpdateReviewAssignment_competingInterests, '
      .         'regret_message = :UpdateReviewAssignment_regretMessage, '
      .         'recommendation = :UpdateReviewAssignment_recommendation, '
      .          'date_assigned = :UpdateReviewAssignment_dateAssigned, '
      .          'date_notified = :UpdateReviewAssignment_dateNotified, '
      .         'date_confirmed = :UpdateReviewAssignment_dateConfirmed, '
      .         'date_completed = :UpdateReviewAssignment_dateCompleted, '
      .      'date_acknowledged = :UpdateReviewAssignment_dateAcknowledged, '
      .               'date_due = :UpdateReviewAssignment_dateDue, '
      .          'last_modified = :UpdateReviewAssignment_lastModified, '
      . 'reminder_was_automatic = :UpdateReviewAssignment_reminderWasAutomatic,'
      .              ' declined = :UpdateReviewAssignment_declined, '
      .               'replaced = :UpdateReviewAssignment_replaced, '
      .              'cancelled = :UpdateReviewAssignment_cancelled, '
      .       'reviewer_file_id = :UpdateReviewAssignment_reviewerFileId, '
      .             'date_rated = :UpdateReviewAssignment_dateRated, '
      .          'date_reminded = :UpdateReviewAssignment_dateReminded, '
      .                'quality = :UpdateReviewAssignment_quality, '
      .        'review_round_id = :UpdateReviewAssignment_reviewRoundId, '
      .               'stage_id = :UpdateReviewAssignment_stageId, '
      .          'review_method = :UpdateReviewAssignment_reviewMethod, '
      .                  'round = :UpdateReviewAssignment_round, '
      .                   'step = :UpdateReviewAssignment_step, '
      .         'review_form_id = :UpdateReviewAssignment_reviewFormId, '
      .           'unconsidered = :UpdateReviewAssignment_unconsidered '
      . 'WHERE '
      .              'review_id = :UpdateReviewAssignment_reviewId',

    'params' => array(
        'competing_interests' => ':UpdateReviewAssignment_competingInterests',
        'regret_message'      => ':UpdateReviewAssignment_regretMessage',
        'recommendation'      => ':UpdateReviewAssignment_recommendation',
        'date_assigned'       => ':UpdateReviewAssignment_dateAssigned',
        'date_notified'       => ':UpdateReviewAssignment_dateNotified',
        'date_confirmed'      => ':UpdateReviewAssignment_dateConfirmed',
        'date_completed'      => ':UpdateReviewAssignment_dateCompleted',
        'date_acknowledged'   => ':UpdateReviewAssignment_dateAcknowledged',
        'date_due'            => ':UpdateReviewAssignment_dateDue',
        'last_modified'       => ':UpdateReviewAssignment_lastModified',
     'reminder_was_automatic' => ':UpdateReviewAssignment_reminderWasAutomatic',
        'declined'            => ':UpdateReviewAssignment_declined',
        'replaced'            => ':UpdateReviewAssignment_replaced',
        'cancelled'           => ':UpdateReviewAssignment_cancelled',
        'reviewer_file_id'    => ':UpdateReviewAssignment_reviewerFileId',
        'date_rated'          => ':UpdateReviewAssignment_dateRated',
        'date_reminded'       => ':UpdateReviewAssignment_dateReminded',
        'quality'             => ':UpdateReviewAssignment_quality',
        'review_round_id'     => ':UpdateReviewAssignment_reviewRoundId',
        'stage_id'            => ':UpdateReviewAssignment_stageId',
        'review_method'       => ':UpdateReviewAssignment_reviewMethod',
        'round'               => ':UpdateReviewAssignment_round',
        'step'                => ':UpdateReviewAssignment_step',
        'review_form_id'      => ':UpdateReviewAssignment_reviewFormId',
        'unconsidered'        => ':UpdateReviewAssignment_unconsidered',
        'review_id'           => ':UpdateReviewAssignment_reviewId',
    ),
);
