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
    'name' => 'SelectPublishedArticleBySettingCount',
    
    'query' => 
        'SELECT COUNT(*) AS count ' . 
        'FROM article_settings AS sett ' .
        'INNER JOIN articles AS art ' .
            'ON art.article_id = sett.article_id ' .
        'INNER JOIN published_articles AS pub ' .
            'ON pub.article_id = sett.article_id '.
        'WHERE ' .
            'art.journal_id = :countPublishedArticleBySetting_journalId AND ' .
               'sett.locale = :countPublishedArticleBySetting_locale AND ' .
         'sett.setting_name = :countPublishedArticleBySetting_settingName AND '.
        'sett.setting_value = :countPublishedArticleBySetting_settingValue',

    'params' => array(
        'journal_id' => ':countPublishedArticleBySetting_journalId',
        'locale' => ':countPublishedArticleBySetting_locale',
        'setting_name' => ':countPublishedArticleBySetting_settingName',
        'setting_value' => ':countPublishedArticleBySetting_settingValue',
    ),
);
