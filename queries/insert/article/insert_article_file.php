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
    'name' => 'InsertArticleFile',
    
    'query' => 
        'INSERT INTO article_files '
      .     '(revision, '
      .      'source_revision, '
      .      'article_id, '
      .      'file_name, '
      .      'file_type, '
      .      'file_size, '
      .      'original_file_name, '
      .      'file_stage, '
      .      'viewable, '
      .      'date_uploaded, '
      .      'date_modified, '
      .      'round, '
      .      'assoc_id) '
      . 'VALUES '
      .     '(:InsertArticleFile_revision, '
      .      ':InsertArticleFile_sourceRevision, '
      .      ':InsertArticleFile_articleId, '
      .      ':InsertArticleFile_fileName, '
      .      ':InsertArticleFile_fileType, '
      .      ':InsertArticleFile_fileSize, '
      .      ':InsertArticleFile_originalFileName, '
      .      ':InsertArticleFile_fileStage, '
      .      ':InsertArticleFile_viewable, '
      .      ':InsertArticleFile_dateUploaded, '
      .      ':InsertArticleFile_dateModified, '
      .      ':InsertArticleFile_round, '
      .      ':InsertArticleFile_assocId)',

    'params' => array(
        'revision'           => ':InsertArticleFile_revision',
        'source_revision'    => ':InsertArticleFile_sourceRevision',
        'article_id'         => ':InsertArticleFile_articleId',
        'file_name'          => ':InsertArticleFile_fileName',
        'file_type'          => ':InsertArticleFile_fileType',
        'file_size'          => ':InsertArticleFile_fileSize',
        'original_file_name' => ':InsertArticleFile_originalFileName',
        'file_stage'         => ':InsertArticleFile_fileStage',
        'viewable'           => ':InsertArticleFile_viewable',
        'date_uploaded'      => ':InsertArticleFile_dateUploaded',
        'date_modified'      => ':InsertArticleFile_dateModified',
        'round'              => ':InsertArticleFile_round',
        'assoc_id'           => ':InsertArticleFile_assocId',
    ),
);
