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
    'name' => 'InsertReviewFormResponse',
    
    'query' => 
        'INSERT INTO review_form_responses '
      .    '(review_form_element_id, '
      .     'review_id, '
      .     'response_type, '
      .     'response_value) '
      . 'VALUES '
      .    '(:InsertReviewFormResponse_reviewFormElementId, '
      .     ':InsertReviewFormResponse_reviewId, '
      .     ':InsertReviewFormResponse_responseType, '
      .     ':InsertReviewFormResponse_reponseValue)',

    'params' => array(
        'review_form_element_id' => 
                            ':InsertReviewFormResponse_reviewFormElementId',
        'review_id'              => ':InsertReviewFormResponse_reviewId',
        'response_type'          => ':InsertReviewFormResponse_responseType',
        'response_value'         => ':InsertReviewFormResponse_reponseValue',
    ),
);
