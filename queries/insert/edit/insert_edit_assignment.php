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
    'name' => 'InsertEditAssignment',
    
    'query' => 
        'INSERT INTO edit_assignments '
      .    '(article_id, '
      .     'editor_id, '
      .     'can_edit, '
      .     'can_review, '
      .     'date_assigned, '
      .     'date_notified, '
      .     'date_underway) '
      . 'VALUES '
      .    '(:InsertEditAssignment_articleId, '
      .     ':InsertEditAssignment_editorId, '
      .     ':InsertEditAssignment_canEdit, '
      .     ':InsertEditAssignment_canReview, '
      .     ':InsertEditAssignment_dateAssigned, '
      .     ':InsertEditAssignment_dateNotified, '
      .     ':InsertEditAssignment_dateUnderway)',

    'params' => array(
        'article_id'    => ':InsertEditAssignment_articleId',
        'editor_id'     => ':InsertEditAssignment_editorId',
        'can_edit'      => ':InsertEditAssignment_canEdit',
        'can_review'    => ':InsertEditAssignment_canReview',
        'date_assigned' => ':InsertEditAssignment_dateAssigned',
        'date_notified' => ':InsertEditAssignment_dateNotified',
        'date_underway' => ':InsertEditAssignment_dateUnderway',
    )
);
