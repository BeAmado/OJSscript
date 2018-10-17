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
    'name' => 'InsertReviewAssignment',
    
    'query' => 
        'INSERT INTO review_assignments '
      .    '(submission_id, '
      .     'reviewer_id, '
      .     'competing_interests, '
      .     'regret_message, '
      .     'recommendation, '
      .     'date_assigned, '
      .     'date_notified, '
      .     'date_confirmed, '
      .     'date_completed, '
      .     'date_acknowledged, '
      .     'date_due, '
      .     'last_modified, '
      .     'reminder_was_automatic, '
      .     'declined, '
      .     'replaced, '
      .     'cancelled, '
      .     'reviewer_file_id, '
      .     'date_rated, '
      .     'date_reminded, '
      .     'quality, '
      .     'review_round_id, '
      .     'stage_id, '
      .     'review_method, '
      .     'round, '
      .     'step, '
      .     'review_form_id, '
      .     'unconsidered) '
      . 'VALUES '
      .    '(:InsertReviewAssignment_submissionId, '
      .     ':InsertReviewAssignment_reviewerId, '
      .     ':InsertReviewAssignment_competingInterests, '
      .     ':InsertReviewAssignment_regretMessage, '
      .     ':InsertReviewAssignment_recommendation, '
      .     ':InsertReviewAssignment_dateAssigned, '
      .     ':InsertReviewAssignment_dateNotified, '
      .     ':InsertReviewAssignment_dateConfirmed, '
      .     ':InsertReviewAssignment_dateCompleted, '
      .     ':InsertReviewAssignment_dateAcknowledged, '
      .     ':InsertReviewAssignment_dateDue, '
      .     ':InsertReviewAssignment_lastModified, '
      .     ':InsertReviewAssignment_reminderAuto, '
      .     ':InsertReviewAssignment_declined, '
      .     ':InsertReviewAssignment_replaced, '
      .     ':InsertReviewAssignment_cancelled, '
      .     ':InsertReviewAssignment_reviewerFileId, '
      .     ':InsertReviewAssignment_dateRated, '
      .     ':InsertReviewAssignment_dateReminded, '
      .     ':InsertReviewAssignment_quality, '
      .     ':InsertReviewAssignment_reviewRoundId, '
      .     ':InsertReviewAssignment_stageId, '
      .     ':InsertReviewAssignment_reviewMethod, '
      .     ':InsertReviewAssignment_round, '
      .     ':InsertReviewAssignment_step, '
      .     ':InsertReviewAssignment_reviewFormId, '
      .     ':InsertReviewAssignment_unconsidered)',

    'params' => array(
      'submission_id'          => ':InsertReviewAssignment_submissionId',
      'reviewer_id'            => ':InsertReviewAssignment_reviewerId',
      'competing_interests'    => ':InsertReviewAssignment_competingInterests',
      'regret_message'         => ':InsertReviewAssignment_regretMessage',
      'recommendation'         => ':InsertReviewAssignment_recommendation',
      'date_assigned'          => ':InsertReviewAssignment_dateAssigned',
      'date_notified'          => ':InsertReviewAssignment_dateNotified',
      'date_confirmed'         => ':InsertReviewAssignment_dateConfirmed',
      'date_completed'         => ':InsertReviewAssignment_dateCompleted',
      'date_acknowledged'      => ':InsertReviewAssignment_dateAcknowledged',
      'date_due'               => ':InsertReviewAssignment_dateDue',
      'last_modified'          => ':InsertReviewAssignment_lastModified',
      'reminder_was_automatic' => ':InsertReviewAssignment_reminderAuto',
      'declined'               => ':InsertReviewAssignment_declined',
      'replaced'               => ':InsertReviewAssignment_replaced',
      'cancelled'              => ':InsertReviewAssignment_cancelled',
      'reviewer_file_id'       => ':InsertReviewAssignment_reviewerFileId',
      'date_rated'             => ':InsertReviewAssignment_dateRated',
      'date_reminded'          => ':InsertReviewAssignment_dateReminded',
      'quality'                => ':InsertReviewAssignment_quality',
      'review_round_id'        => ':InsertReviewAssignment_reviewRoundId',
      'stage_id'               => ':InsertReviewAssignment_stageId',
      'review_method'          => ':InsertReviewAssignment_reviewMethod',
      'round'                  => ':InsertReviewAssignment_round',
      'step'                   => ':InsertReviewAssignment_step',
      'review_form_id'         => ':InsertReviewAssignment_reviewFormId',
      'unconsidered'           => ':InsertReviewAssignment_unconsidered',
    ),
);
