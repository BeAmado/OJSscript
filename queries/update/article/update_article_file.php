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
    'name' => 'UpdateArticleFile',
    
    'query' => 
        'UPDATE article_files '
      . 'SET '
      .    'source_revision = :UpdateArticleFile_sourceRevision, '
      .         'file_stage = :UpdateArticleFile_fileStage, '
      .           'viewable = :UpdateArticleFile_viewable, '
      .      'date_uploaded = :UpdateArticleFile_dateUploaded, '
      .      'date_modified = :UpdateArticleFile_dateModified, '
      .              'round = :UpdateArticleFile_round, '
      .           'assoc_id = :UpdateArticleFile_assocId '
      . 'WHERE '
      .            'file_id = :UpdateArticleFile_fileId AND '
      .           'revision = :UpdateArticleFile_revision',

    'params' => array(
        'source_revision' => ':UpdateArticleFile_sourceRevision',
        'file_stage'      => ':UpdateArticleFile_fileStage',
        'viewable'        => ':UpdateArticleFile_viewable',
        'date_uploaded'   => ':UpdateArticleFile_dateUploaded',
        'date_modified'   => ':UpdateArticleFile_dateModified',
        'round'           => ':UpdateArticleFile_round',
        'assoc_id'        => ':UpdateArticleFile_assocId',
        'file_id'         => ':UpdateArticleFile_fileId',
        'revision'        => ':UpdateArticleFile_revision',
    ),
);
