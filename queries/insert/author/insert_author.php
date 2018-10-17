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
    'name' => 'InsertAuthor',
    
    'query' => 
        'INSERT INTO authors '
      .     '(submission_id, '
      .      'primary_contact, '
      .      'seq, '
      .      'first_name, '
      .      'middle_name, '
      .      'last_name, '
      .      'country, '
      .      'email, '
      .      'url, '
      .      'suffix) '
      . 'VALUES '
      .     '(:InsertAuthor_submissionId, '
      .      ':InsertAuthor_primaryContact, '
      .      ':InsertAuthor_seq, '
      .      ':InsertAuthor_firstName, '
      .      ':InsertAuthor_middleName, '
      .      ':InsertAuthor_lastName, '
      .      ':InsertAuthor_country, '
      .      ':InsertAuthor_email, '
      .      ':InsertAuthor_url, '
      .      ':InsertAuthor_suffix)',

    'params' => array(
          'submission_id' => ':InsertAuthor_submissionId',
        'primary_contact' => ':InsertAuthor_primaryContact',
                    'seq' => ':InsertAuthor_seq',
             'first_name' => ':InsertAuthor_firstName',
            'middle_name' => ':InsertAuthor_middleName',
              'last_name' => ':InsertAuthor_lastName',
                'country' => ':InsertAuthor_country',
                  'email' => ':InsertAuthor_email',
                    'url' => ':InsertAuthor_url',
                 'suffix' => ':InsertAuthor_suffix',
    ),
);
