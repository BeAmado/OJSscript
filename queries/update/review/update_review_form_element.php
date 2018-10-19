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

return array (
    'name' => 'UpdateReviewFormElement',
    
    'query' => 
        'UPDATE review_form_elements '
      . 'SET '
      .                    'seq = :UpdateReviewFormElement_seq, '
      .           'element_type = :UpdateReviewFormElement_elementType, '
      .               'required = :UpdateReviewFormElement_required, '
      .               'included = :UpdateReviewFormElement_included '
      . 'WHERE '
      .    'review_form_element = :UpdateReviewFormElement_reviewFormElementId',

    'params' => array(
        'seq'                 => ':UpdateReviewFormElement_seq',
        'element_type'        => ':UpdateReviewFormElement_elementType',
        'required'            => ':UpdateReviewFormElement_required',
        'included'            => ':UpdateReviewFormElement_included',
        'review_form_element' => ':UpdateReviewFormElement_reviewFormElementId',
    ),
);
