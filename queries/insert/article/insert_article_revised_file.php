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
    'name' => 'InsertArticleRevisedFile',
    
    'query' => 
        'INSERT INTO article_files '
      .     '(file_id, '
      .      'revision, '
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
      .     '(:InsertArticleRevisedFile_fileId, '
      .      ':InsertArticleRevisedFile_revision, '
      .      ':InsertArticleRevisedFile_sourceRevision, '
      .      ':InsertArticleRevisedFile_articleId, '
      .      ':InsertArticleRevisedFile_fileName, '
      .      ':InsertArticleRevisedFile_fileType, '
      .      ':InsertArticleRevisedFile_fileSize, '
      .      ':InsertArticleRevisedFile_originalFileName, '
      .      ':InsertArticleRevisedFile_fileStage, '
      .      ':InsertArticleRevisedFile_viewable, '
      .      ':InsertArticleRevisedFile_dateUploaded, '
      .      ':InsertArticleRevisedFile_dateModified, '
      .      ':InsertArticleRevisedFile_round, '
      .      ':InsertArticleRevisedFile_assocId)',
    
    'params' => array(
        'file_id'            => ':InsertArticleRevisedFile_fileId',
        'revision'           => ':InsertArticleRevisedFile_revision',
        'article_id'         => ':InsertArticleRevisedFile_articleId',
        'file_name'          => ':InsertArticleRevisedFile_fileName',
        'file_type'          => ':InsertArticleRevisedFile_fileType',
        'file_size'          => ':InsertArticleRevisedFile_fileSize',
        'original_file_name' => ':InsertArticleRevisedFile_originalFileName',
        'file_stage'         => ':InsertArticleRevisedFile_fileStage',
        'viewable'           => ':InsertArticleRevisedFile_viewable',
        'date_uploaded'      => ':InsertArticleRevisedFile_dateUploaded',
        'date_modified'      => ':InsertArticleRevisedFile_dateModified',
        'round'              => ':InsertArticleRevisedFile_round',
        'assoc_id'           => ':InsertArticleRevisedFile_assocId',
    )
);
