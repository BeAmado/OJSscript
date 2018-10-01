<?php

/* 
 * Copyright (C) 2018 Bernardo Amado
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
    'name' => 'SelectPublishedArticleBySetting',
    
    'query' => 
        'SELECT '
      .     'art.*, '
      .     'sett.*, '
      .     'pub.*  '
      . 'FROM article_settings AS sett '
      . 'INNER JOIN articles AS art '
      .     'ON art.article_id = sett.article_id '
      . 'INNER JOIN published_articles AS pub '
      .     'ON pub.article_id = sett.article_id '
      . 'WHERE '
      .     'art.journal_id = :SelectPublishedArticleBySetting_journalId AND'
      .        'sett.locale = :SelectPublishedArticleBySetting_locale AND '
      .  'sett.setting_name = :SelectPublishedArticleBySetting_settingName AND '
      . 'sett.setting_value = :SelectPublishedArticleBySetting_settingValue',

    'params' => array(
           'journal_id' => ':SelectPublishedArticleBySetting_journalId',
               'locale' => ':SelectPublishedArticleBySetting_locale',
         'setting_name' => ':SelectPublishedArticleBySetting_settingName',
        'setting_value' => ':SelectPublishedArticleBySetting_settingValue',
    ),
);
