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
    'name' => 'UpdateArticleFileNamesAndSourceId',
    
    'query' => 
  'UPDATE article_files '
. 'SET '
.       'source_file_id = :UpdateArticleFileNamesAndSourceIds_sourceFileId, '
.            'file_name = :UpdateArticleFileNamesAndSourceIds_fileName, '
.   'original_file_name = :UpdateArticleFileNamesAndSourceIds_originalFileName '
. 'WHERE '
.              'file_id = :UpdateArticleFileNamesAndSourceIds_fileId AND '
.             'revision = :UpdateArticleFileNamesAndSourceIds_revision',

    'params' => array(
     'source_file_id' => ':UpdateArticleFileNamesAndSourceIds_sourceFileId',
          'file_name' => ':UpdateArticleFileNamesAndSourceIds_fileName',
 'original_file_name' => ':UpdateArticleFileNamesAndSourceIds_originalFileName',
            'file_id' => ':UpdateArticleFileNamesAndSourceIds_fileId',
           'revision' => ':UpdateArticleFileNamesAndSourceIds_revision',
    ),
);
