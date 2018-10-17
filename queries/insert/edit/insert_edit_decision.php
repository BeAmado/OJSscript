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
    'name' => 'InsertEditDecision',
    
    'query' => 
        'INSERT INTO edit_decisions '
      .    '(article_id, '
      .     'round, '
      .     'editor_id, '
      .     'decision, '
      .     'date_decided) '
      . 'VALUES '
      .    '(:InsertEditDecision_articleId, '
      .     ':InsertEditDecision_round, '
      .     ':InsertEditDecision_editorId, '
      .     ':InsertEditDecision_decision, '
      .     ':InsertEditDecision_dateDecided)',

    'params' => array(
        'article_id'   => ':InsertEditDecision_articleId',
        'round'        => ':InsertEditDecision_round',
        'editor_id'    => ':InsertEditDecision_editorId',
        'decision'     => ':InsertEditDecision_decision',
        'date_decided' => ':InsertEditDecision_dateDecided',
    ),
);