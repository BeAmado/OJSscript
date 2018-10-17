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
    'name' => 'InsertArticleGalley',
    
    'query' => 
        'INSERT INTO article_galleys '
      .    '(locale, '
      .     'article_id, '
      .     'file_id, '
      .     'label, '
      .     'html_galley, '
      .     'style_file_id, '
      .     'seq, '
      .     'remote_url) '
      . 'VALUES '
      .    '(:InsertArticleGalley_locale, '
      .     ':InsertArticleGalley_articleId, '
      .     ':InsertArticleGalley_fileId, '
      .     ':InsertArticleGalley_label, '
      .     ':InsertArticleGalley_htmlGalley, '
      .     ':InsertArticleGalley_styleFileId, '
      .     ':InsertArticleGalley_seq, '
      .     ':InsertArticleGalley_remoteUrl)',

    'params' => array(
        'locale'        => ':InsertArticleGalley_locale',
        'article_id'    => ':InsertArticleGalley_articleId',
        'file_id'       => ':InsertArticleGalley_fileId',
        'label'         => ':InsertArticleGalley_label',
        'html_galley'   => ':InsertArticleGalley_htmlGalley',
        'style_file_id' => ':InsertArticleGalley_styleFileId',
        'seq'           => ':InsertArticleGalley_seq',
        'remote_url'    => ':InsertArticleGalley_remoteUrl',
    ),
);
