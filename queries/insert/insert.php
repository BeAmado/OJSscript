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
    
///////// user related /////////////
'InsertUser' => array( 
    'query' =>
        'INSERT INTO users ' . 
            '( username, ' . 
              'password, ' . 
              'salutation, ' . 
              'first_name, ' . 
              'middle_name, ' . 
              'last_name, ' . 
              'gender, ' . 
              'initials, ' . 
              'email, ' . 
              'url, ' . 
              'phone, ' . 
              'fax, ' . 
              'mailing_address, ' .
              'country, ' . 
              'locales, ' . 
              'date_last_email, ' . 
              'date_registered, ' . 
              'date_validated, ' . 
              'date_last_login, ' . 
              'must_change_password, ' . 
              'auth_id, ' . 
              'disabled, ' . 
              'disabled_reason, ' . 
              'auth_str, ' . 
              'suffix, ' . 
              'billing_address, ' . 
              'inline_help )' .  
        'VALUES ' .
            '( :InsertUser_username, ' . 
              ':InsertUser_password, ' . 
              ':InsertUser_salutation, ' . 
              ':InsertUser_firstName, ' . 
              ':InsertUser_middleName, ' . 
              ':InsertUser_lastName, ' . 
              ':InsertUser_gender, ' . 
              ':InsertUser_initials, ' . 
              ':InsertUser_email, ' . 
              ':InsertUser_url, ' . 
              ':InsertUser_phone, ' . 
              ':InsertUser_fax, ' . 
              ':InsertUser_mailingAddress, ' . 
              ':InsertUser_country, ' . 
              ':InsertUser_locales, ' .
              ':InsertUser_dateLastEmail, ' . 
              ':InsertUser_dateRegistered, ' . 
              ':InsertUser_dateValidated, ' . 
              ':InsertUser_dateLastLogin, ' . 
              ':InsertUser_mustChangePassword, ' . 
              ':InsertUser_authId, ' . 
              ':InsertUser_disabled, ' .
              ':InsertUser_disabledReason, ' . 
              ':InsertUser_authStr, ' . 
              ':InsertUser_suffix, ' . 
              ':InsertUser_billingAddress, ' . 
              ':InsertUser_inlineHelp )',

    'params' => array(
                    'username' => ':InsertUser_username', 
                    'password' => ':InsertUser_password', 
                  'salutation' => ':InsertUser_salutation', 
                  'first_name' => ':InsertUser_firstName', 
                 'middle_name' => ':InsertUser_middleName', 
                   'last_name' => ':InsertUser_lastName', 
                      'gender' => ':InsertUser_gender', 
                    'initials' => ':InsertUser_initials', 
                       'email' => ':InsertUser_email', 
                         'url' => ':InsertUser_url', 
                       'phone' => ':InsertUser_phone', 
                         'fax' => ':InsertUser_fax',
             'mailing_address' => ':InsertUser_mailingAddress', 
                     'country' => ':InsertUser_country', 
                     'locales' => ':InsertUser_locales', 
             'date_last_email' => ':InsertUser_dateLastEmail',
             'date_registered' => ':InsertUser_dateRegistered', 
              'date_validated' => ':InsertUser_dateValidated', 
             'date_last_login' => ':InsertUser_dateLastLogin', 
        'must_change_password' => ':InsertUser_mustChangePassword', 
                     'auth_id' => ':InsertUser_authId', 
                    'disabled' => ':InsertUser_disabled', 
             'disabled_reason' => ':InsertUser_disabledReason', 
                    'auth_str' => ':InsertUser_authStr', 
                      'suffix' => ':InsertUser_suffix', 
             'billing_address' => ':InsertUser_billingAddress', 
                 'inline_help' => ':InsertUser_inlineHelp'
    ),
), //end of InsertUser

'InsertUserSetting' => array(
    'query' => 
        'INSERT INTO user_settings ' . 
            '( user_id, ' . 
              'locale, ' . 
              'setting_name, ' . 
              'setting_value, ' . 
              'setting_type, ' . 
              'assoc_id, ' . 
              'assoc_type )' . 
        'VALUES ' . 
            '( :InsertUserSetting_userId, ' . 
              ':InsertUserSetting_locale, ' . 
              ':InsertUserSetting_settingName, ' . 
              ':InsertUserSetting_settingValue, ' . 
              ':InsertUserSetting_settingType, ' . 
              ':InsertUserSetting_assocId, ' . 
              ':InsertUserSetting_assocType )',

    'params' => array(
              'user_id' => ':InsertUserSetting_userId',
               'locale' => ':InsertUserSetting_locale',
         'setting_name' => ':InsertUserSetting_settingName',
        'setting_value' => ':InsertUserSetting_settingValue',
         'setting_type' => ':InsertUserSetting_settingType',
             'assoc_id' => ':InsertUserSetting_assocId',
           'assoc_type' => ':InsertUserSetting_assocType',
    ),
), //end of InsertUserSetting

'InsertUserRole' => array(
    'query' => 
        'INSERT INTO roles ' . 
            '( journal_id, ' . 
              'user_id, ' . 
              'role_id ) ' .  
        'VALUES ' . 
            '( :InsertUserRole_journalId, ' . 
              ':InsertUserRole_userId, ' . 
              ':InsertUserRole_roleId )',

    'params' => array(
        'journal_id' => ':InsertUserRole_journalId',
           'user_id' => ':InsertUserRole_userId',
           'role_id' => ':InsertUserRole_roleId',
    )
), //end of InsertUserRole

'InsertControlledVocabEntry' => array(
    'query' => 
        'INSERT INTO controlled_vocab_entries ' . 
            '( controlled_vocab_id, ' . 
              'seq ) ' . 
        'VALUES ' . 
            '( :InsertControlledVocabEntry_controlledVocabId, ' . 
              ':InsertControlledVocabEntry_seq )',

    'params' => array(
        'controlled_vocab_id' => 
                 ':InsertControlledVocabEntry_controlledVocabId',
        'seq' => ':InsertControlledVocabEntry_seq',
    ),
), //end of InsertControlledVocabEntry

'InsertControlledVocabEntrySetting' => array(
    'query' => 
        'INSERT INTO controlled_vocab_entry_settings ' . 
            '( controlled_vocab_entry_id, ' . 
              'locale, ' . 
              'setting_name, ' . 
              'setting_value, ' . 
              'setting_type ) ' .
        'VALUES ' . 
            '( :InsertControlledVocabEntrySetting_controlledVocabEntryId, ' . 
              ':InsertControlledVocabEntrySetting_locale, ' . 
              ':InsertControlledVocabEntrySetting_settingName, ' . 
              ':InsertControlledVocabEntrySetting_settingValue, ' . 
              ':InsertControlledVocabEntrySetting_settingType )',

    'params' => array(
        'controlled_vocab_entry_id' => 
                    ':InsertControlledVocabEntrySetting_controlledVocabEntryId',
        'locale' => ':InsertControlledVocabEntrySetting_locale',
  'setting_name' => ':InsertControlledVocabEntrySetting_settingName',
 'setting_value' => ':InsertControlledVocabEntrySetting_settingValue',
  'setting_type' => ':InsertControlledVocabEntrySetting_settingType',
    ),
), //end of InsertControlledVocabEntrySetting

'InsertUserInterest' => array(
    'query' => 
        'INSERT INTO user_interests ' . 
            '( controlled_vocab_entry_id, ' . 
              'user_id ) ' . 
        'VALUES ' . 
            '( :InsertUserInterest_controlledVocabEntryId, ' . 
              ':InsertUserInterest_userId )',

    'params' => array(
        'controlled_vocab_entry_id' => 
                     ':InsertUserInterest_controlledVocabEntryId',
        'user_id' => ':InsertUserInterest_userId',
    ),
), //end of InsertUserInterest


////////// article related //////////////
'InsertArticle' => array(
    'query' => 
        'INSERT INTO articles ' . 
            '( user_id, ' . 
              'journal_id, ' . 
              'section_id, ' . 
              'language, ' . 
              'comments_to_ed, ' . 
              'date_submitted, ' . 
              'last_modified, ' . 
              'date_status_modified, ' . 
              'status, ' . 
              'submission_progress, ' . 
              'current_round, ' . 
              'pages, ' . 
              'fast_tracked, ' . 
              'hide_author, ' . 
              'comments_status, ' . 
              'locale, ' . 
              'citations ) ' .  
        'VALUES ' . 
            '( :InsertArticle_userId, ' . 
              ':InsertArticle_journalId, ' . 
              ':InsertArticle_sectionId, ' . 
              ':InsertArticle_language, ' . 
              ':InsertArticle_commentsToEd, ' . 
              ':InsertArticle_dateSubmitted, ' . 
              ':InsertArticle_lastModified, ' . 
              ':InsertArticle_dateStatusModified, ' . 
              ':InsertArticle_status, ' . 
              ':InsertArticle_submissionProgress, ' . 
              ':InsertArticle_currentRound, ' . 
              ':InsertArticle_pages, ' . 
              ':InsertArticle_fastTracked, ' . 
              ':InsertArticle_hideAuthor, ' . 
              ':InsertArticle_commentsStatus, ' . 
              ':InsertArticle_locale, ' . 
              ':InsertArticle_citations )',

    'params' => array(
                     'user_id' => ':InsertArticle_userId',
                  'journal_id' => ':InsertArticle_journalId',
                  'section_id' => ':InsertArticle_sectionId',
                    'language' => ':InsertArticle_language',
              'comments_to_ed' => ':InsertArticle_commentsToEd',
              'date_submitted' => ':InsertArticle_dateSubmitted',
               'last_modified' => ':InsertArticle_lastModified',
        'date_status_modified' => ':InsertArticle_dateStatusModified',
                      'status' => ':InsertArticle_status',
         'submission_progress' => ':InsertArticle_submissionProgress',
               'current_round' => ':InsertArticle_currentRound',
                       'pages' => ':InsertArticle_pages',
                'fast_tracked' => ':InsertArticle_fastTracked',
                 'hide_author' => ':InsertArticle_hideAuthor',
             'comments_status' => ':InsertArticle_commentsStatus',
                      'locale' => ':InsertArticle_locale',
                   'citations' => ':InsertArticle_citations',
    ),
), //end of InsertArticle

'InsertArticleSetting' => array(
    'query' => 
        'INSERT INTO article_settings ' . 
            '( article_id, ' . 
              'locale, ' . 
              'setting_name, ' . 
              'setting_value, ' . 
              'setting_type ) ' . 
        'VALUES ' . 
            '( :InsertArticleSetting_articleId, ' . 
              ':InsertArticleSetting_locale, ' . 
              ':InsertArticleSetting_settingName, ' . 
              ':InsertArticleSetting_settingValue, ' . 
              ':InsertArticleSetting_settingType )',

    'params' => array(
           'article_id' => ':InsertArticleSetting_articleId',
               'locale' => ':InsertArticleSetting_locale',
         'setting_name' => ':InsertArticleSetting_settingName',
        'setting_value' => ':InsertArticleSetting_settingValue',
         'setting_type' => ':InsertArticleSetting_settingType',
    ),
),//end of InsertArticleSetting

'InsertAuthor' => array(
        'query' => 'INSERT INTO authors (submission_id, primary_contact, seq, first_name, middle_name, last_name, country, email, url, suffix) 
                VALUES (:InsertAuthor_submissionId, :InsertAuthor_primaryContact, :InsertAuthor_seq, :InsertAuthor_firstName, :InsertAuthor_middleName, 
                :InsertAuthor_lastName, :InsertAuthor_country, :InsertAuthor_email, :InsertAuthor_url, :InsertAuthor_suffix)',

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
        )
),

'InsertAuthorSetting' => array(
        'query' => 'INSERT INTO author_settings (author_id, locale, setting_name, setting_value, setting_type) VALUES (:InsertAuthorSettings_authorId,
                :InsertAuthorSettings_locale, :InsertAuthorSettings_settingName, :InsertAuthorSettings_settingValue, :InsertAuthorSettings_settingType)',

        'params' => array(
                'author_id' => ':InsertAuthorSettings_authorId',
                'locale' => ':InsertAuthorSettings_locale',
                'setting_name' => ':InsertAuthorSettings_settingName',
                'setting_value' => ':InsertAuthorSettings_settingValue',
                'setting_type' => ':InsertAuthorSettings_settingType',
        )
),


'InsertArticleFile' => array(
        'query' => 'INSERT INTO article_files (revision, source_revision, article_id, file_name, file_type, file_size, original_file_name, file_stage, viewable,
                date_uploaded, date_modified, round, assoc_id) VALUES (:InsertArticleFile_revision, :InsertArticleFile_sourceRevision, :InsertArticleFile_articleId, 
                :InsertArticleFile_fileName, :InsertArticleFile_fileType, :InsertArticleFile_fileSize, :InsertArticleFile_originalFileName, :InsertArticleFile_fileStage, 
                :InsertArticleFile_viewable, :InsertArticleFile_dateUploaded, :InsertArticleFile_dateModified, :InsertArticleFile_round, :InsertArticleFile_assocId)',

        'params' => array(
                'revision' => ':InsertArticleFile_revision',
                'source_revision' => ':InsertArticleFile_sourceRevision',
                'article_id' => ':InsertArticleFile_articleId',
                'file_name' => ':InsertArticleFile_fileName',
                'file_type' => ':InsertArticleFile_fileType',
                'file_size' => ':InsertArticleFile_fileSize',
                'original_file_name' => ':InsertArticleFile_originalFileName',
                'file_stage' => ':InsertArticleFile_fileStage',
                'viewable' => ':InsertArticleFile_viewable',
                'date_uploaded' => ':InsertArticleFile_dateUploaded',
                'date_modified' => ':InsertArticleFile_dateModified',
                'round' => ':InsertArticleFile_round',
                'assoc_id' => ':InsertArticleFile_assocId',
        )
),

'InsertArticleRevisedFile' => array(
        'query' => 'INSERT INTO article_files 
                (file_id, revision, source_revision, article_id, file_name, file_type, file_size, original_file_name, file_stage, viewable, date_uploaded, date_modified, round, assoc_id) 
                VALUES (:InsertArticleRevisedFile_fileId, :InsertArticleRevisedFile_revision, :InsertArticleRevisedFile_sourceRevision, :InsertArticleRevisedFile_articleId, 
                :InsertArticleRevisedFile_fileName, :InsertArticleRevisedFile_fileType, :InsertArticleRevisedFile_fileSize, :InsertArticleRevisedFile_originalFileName, 
                :InsertArticleRevisedFile_fileStage, :InsertArticleRevisedFile_viewable, :InsertArticleRevisedFile_dateUploaded, :InsertArticleRevisedFile_dateModified, 
                :InsertArticleRevisedFile_round, :InsertArticleRevisedFile_assocId)',

        'params' => array(
                'file_id' => ':InsertArticleRevisedFile_fileId',
                'revision' => ':InsertArticleRevisedFile_revision',
                'article_id' => ':InsertArticleRevisedFile_articleId',
                'file_name' => ':InsertArticleRevisedFile_fileName',
                'file_type' => ':InsertArticleRevisedFile_fileType',
                'file_size' => ':InsertArticleRevisedFile_fileSize',
                'original_file_name' => ':InsertArticleRevisedFile_originalFileName',
                'file_stage' => ':InsertArticleRevisedFile_fileStage',
                'viewable' => ':InsertArticleRevisedFile_viewable',
                'date_uploaded' => ':InsertArticleRevisedFile_dateUploaded',
                'date_modified' => ':InsertArticleRevisedFile_dateModified',
                'round' => ':InsertArticleRevisedFile_round',
                'assoc_id' => ':InsertArticleRevisedFile_assocId',
        )
),

'InsertArticleSupplementaryFile' => array(
        'query' => 'INSERT INTO article_supplementary_files (file_id, article_id, type, language, date_created, show_reviewers, date_submitted, seq, remote_url) 
                VALUES (:InsertArticleSupplementaryFile_fileId, :InsertArticleSupplementaryFile_articleId, :InsertArticleSupplementaryFile_type, 
                :InsertArticleSupplementaryFile_language, :InsertArticleSupplementaryFile_dateCreated, :InsertArticleSupplementaryFile_showReviewers, 
                :InsertArticleSupplementaryFile_dateSubmitted, :InsertArticleSupplementaryFile_seq, :InsertArticleSupplementaryFile_remoteUrl)',

        'params' => array(
                'file_id' => ':InsertArticleSupplementaryFile_fileId',
                'article_id' => ':InsertArticleSupplementaryFile_articleId',
                'type' => ':InsertArticleSupplementaryFile_type',
                'language' => 'InsertArticleSupplementaryFile_language',
                'date_created' => ':InsertArticleSupplementaryFile_dateCreated',
                'show_reviewers' => ':InsertArticleSupplementaryFile_showReviewers',
                'date_submitted' => ':InsertArticleSupplementaryFile_dateSubmitted',
                'seq' => ':InsertArticleSupplementaryFile_seq',
                'remote_url' => ':InsertArticleSupplementaryFile_remoteUrl',
        )
),

'InsertArticleSuppFileSetting' => array(
        'query' => 'INSERT INTO article_supp_file_settings (supp_id, locale, setting_name, setting_value, setting_type) VALUES (:InsertArticleSuppFileSetting_suppId,
                :InsertArticleSuppFileSetting_locale, :InsertArticleSuppFileSetting_settingName, :InsertArticleSuppFileSetting_settingValue, :InsertArticleSuppFileSetting_settingType)',

        'params' => array(
                'supp_id' => ':InsertArticleSuppFileSetting_suppId',
                'locale' => ':InsertArticleSuppFileSetting_locale',
                'setting_name' => ':InsertArticleSuppFileSetting_settingName',
                'setting_value' => ':InsertArticleSuppFileSetting_settingValue',
                'setting_type' => ':InsertArticleSuppFileSetting_settingType',
        )
),

'InsertArticleNote' => array(
        'query' => 'INSERT INTO article_notes (article_id, user_id, date_created, date_modified, title, note, file_id) VALUES (:InsertArticleNote_articleId, :InsertArticleNote_userId,
                :InsertArticleNote_dateCreated, :InsertArticleNote_dateModified, :InsertArticleNote_title, :InsertArticleNote_note, :InsertArticleNote_fileId)',

        'params' => array(
                'article_id' => ':InsertArticleNote_articleId',
                'user_id' => ':InsertArticleNote_userId',
                'date_created' => ':InsertArticleNote_dateCreated',
                'date_modified' => ':InsertArticleNote_dateModified',
                'title' => ':InsertArticleNote_title',
                'note' => ':InsertArticleNote_note',
                'file_id' => ':InsertArticleNote_fileId',
        )
),

'InsertArticleComment' => array(
        'query' => 'INSERT INTO article_comments (comment_type, role_id, article_id, assoc_id, author_id, comment_title, comments, date_posted, date_modified, viewable) 
                VALUES (:InsertArticleComment_commentType, :InsertArticleComment_roleId, :InsertArticleComment_articleId, :InsertArticleComment_assocId, :InsertArticleComment_authorId, 
                :InsertArticleComment_commentTitle, :InsertArticleComment_comments, :InsertArticleComment_datePosted, :InsertArticleComment_dateModified, :InsertArticleComment_viewable)',

        'params' => array(
                'comment_type' => ':InsertArticleComment_commentType',
                'role_id' => ':InsertArticleComment_roleId',
                'article_id' => ':InsertArticleComment_articleId',
                'assoc_id' => ':InsertArticleComment_assocId',
                'author_id' => ':InsertArticleComment_authorId',
                'comment_title' => ':InsertArticleComment_commentTitle',
                'comments' => ':InsertArticleComment_comments',
                'date_posted' => ':InsertArticleComment_datePosted',
                'date_modified' => ':InsertArticleComment_dateModified',
                'viewable' => ':InsertArticleComment_viewable',
        )
),

'InsertArticleGalley' => array(
        'query' => 'INSERT INTO article_galleys (locale, article_id, file_id, label, html_galley, style_file_id, seq, remote_url) 
                VALUES (:InsertArticleGalley_locale, :InsertArticleGalley_articleId, :InsertArticleGalley_fileId, :InsertArticleGalley_label, 
                :InsertArticleGalley_htmlGalley, :InsertArticleGalley_styleFileId, :InsertArticleGalley_seq, :InsertArticleGalley_remoteUrl)',

        'params' => array(
                'locale' => ':InsertArticleGalley_locale',
                'article_id' => ':InsertArticleGalley_articleId',
                'file_id' => ':InsertArticleGalley_fileId',
                'label' => ':InsertArticleGalley_label',
                'html_galley' => ':InsertArticleGalley_htmlGalley',
                'style_file_id' => ':InsertArticleGalley_styleFileId',
                'seq' => ':InsertArticleGalley_seq',
                'remote_url' => ':InsertArticleGalley_remoteUrl',
        )
),

'InsertArticleGalleySetting' => array(
        'query' => 'INSERT INTO article_galley_settings (galley_id, locale, setting_name, setting_value, setting_type) VALUES (:InsertArticleGalleySetting_galleyId,
                :InsertArticleGalleySetting_locale, :InsertArticleGalleySetting_settingName, :InsertArticleGalleySetting_settingValue, :InsertArticleGalleySetting_settingType)',

        'params' => array(
                'galley_id' => ':InsertArticleGalleySetting_galleyId',
                'locale' => ':InsertArticleGalleySetting_locale',
                'setting_name' => ':InsertArticleGalleySetting_settingName',
                'setting_value' => ':InsertArticleGalleySetting_settingValue',
                'setting_type' => ':InsertArticleGalleySetting_settingType',
        )
),

'InsertArticleXmlGalley' => array(
        'query' => 'INSERT INTO article_xml_galleys (galley_id, article_id, label, galley_type, views) VALUES (:InsertArticleXmlGalley_galleyId, 
                :InsertArticleXmlGalley_articleId, :InsertArticleXmlGalley_label, :InsertArticleXmlGalley_galleyType, :InsertArticleXmlGalley_views)',

        'params' => array(
                'galley_id' => ':InsertArticleXmlGalley_galleyId',
                'article_id' => ':InsertArticleXmlGalley_articleId',
                'label' => ':InsertArticleXmlGalley_label',
                'galley_type' => ':InsertArticleXmlGalley_galleyType',
                'views' => ':InsertArticleXmlGalley_views',
        )
),

'InsertArticleHtmlGalleyImage' => array(
        'query' => 'INSERT INTO article_html_galley_images (galley_id, file_id) VALUES (:InsertArticleHtmlGalleyImage_galleyId, :InsertArticleHtmlGalleyImage_fileId)',
        'params' => array(
                'galley_id' => ':InsertArticleHtmlGalleyImage_galleyId',
                'file_id' => ':InsertArticleHtmlGalleyImage_fileId',
        )
),

'InsertArticleSearchKeywordList' => array(
        'query' => 'INSERT INTO article_search_keyword_list (keyword_text) VALUES (:InsertArticleSearchKeywordList_keywordText)',
        'params' => array('keyword_text' => ':InsertArticleSearchKeywordList_keywordText')
),

'InsertArticleSearchObjectKeyword' => array(
        'query' => 'INSERT INTO article_search_object_keywords (object_id, keyword_id, pos) VALUES (:InsertArticleSearchObjectKeyword_objectId,
                :InsertArticleSearchObjectKeyword_keywordId, :InsertArticleSearchObjectKeyword_pos)',

        'params' => array(
                'object_id' => ':InsertArticleSearchObjectKeyword_objectId',
                'keyword_id' => ':InsertArticleSearchObjectKeyword_keywordId',
                'pos' => ':InsertArticleSearchObjectKeyword_pos',
        )
),

'InsertArticleSearchObject' => array(
        'query' => 'INSERT INTO article_search_objects (article_id, type, assoc_id) 
                VALUES (:InsertArticleSearchObject_articleId, :InsertArticleSearchObject_type, :InsertArticleSearchObject_assocId)',

        'params' => array(
                'article_id' => ':InsertArticleSearchObject_articleId',
                'type' => ':InsertArticleSearchObject_type',
                'assoc_id' => ':InsertArticleSearchObject_assocId',
        )
),

'InsertEditDecision' => array(
        'query' => 'INSERT INTO edit_decisions (article_id, round, editor_id, decision, date_decided) VALUES (:InsertEditDecision_articleId, 
                :InsertEditDecision_round, :InsertEditDecision_editorId, :InsertEditDecision_decision, :InsertEditDecision_dateDecided)',

        'params' => array(
                'article_id' => ':InsertEditDecision_articleId',
                'round' => ':InsertEditDecision_round',
                'editor_id' => ':InsertEditDecision_editorId',
                'decision' => ':InsertEditDecision_decision',
                'date_decided' => ':InsertEditDecision_dateDecided',
        )
),

'InsertEditAssignment' => array(
        'query' => 'INSERT INTO edit_assignments (article_id, editor_id, can_edit, can_review, date_assigned, date_notified, date_underway) 
                VALUES (:InsertEditAssignment_articleId, :InsertEditAssignment_editorId, :InsertEditAssignment_canEdit, :InsertEditAssignment_canReview, 
                :InsertEditAssignment_dateAssigned, :InsertEditAssignment_dateNotified, :InsertEditAssignment_dateUnderway)',

        'params' => array(
                'article_id' => ':InsertEditAssignment_articleId',
                'editor_id' => ':InsertEditAssignment_editorId',
                'can_edit' => ':InsertEditAssignment_canEdit',
                'can_review' => ':InsertEditAssignment_canReview',
                'date_assigned' => ':InsertEditAssignment_dateAssigned',
                'date_notified' => ':InsertEditAssignment_dateNotified',
                'date_underway' => ':InsertEditAssignment_dateUnderway',
        )
),

'InsertReviewRound' => array(
        'query' => 'INSERT INTO review_rounds (submission_id, stage_id, round, review_revision, status) VALUES (:InsertReviewRound_submissionId,
                :InsertReviewRound_stageId, :InsertReviewRound_round, :InsertReviewRound_reviewRevision, :InsertReviewRound_status)',

        'params' => array(
                'submission_id' => ':InsertReviewRound_submissionId',
                'stage_id' => ':InsertReviewRound_stageId',
                'round' => ':InsertReviewRound_round',
                'review_revision' => ':InsertReviewRound_reviewRevision',
                'status' => ':InsertReviewRound_status',
        )
),

'InsertReviewAssignment' => array(
        'query' => 'INSERT INTO review_assignments (submission_id, reviewer_id, competing_interests, regret_message, recommendation, date_assigned, date_notified, date_confirmed, 
                date_completed, date_acknowledged, date_due, last_modified, reminder_was_automatic, declined, replaced, cancelled, reviewer_file_id, date_rated,
                date_reminded, quality, review_round_id, stage_id, review_method, round, step, review_form_id, unconsidered) 
                VALUES (:InsertReviewAssignment_submissionId, :InsertReviewAssignment_reviewerId, :InsertReviewAssignment_competingInterests, :InsertReviewAssignment_regretMessage, 
                :InsertReviewAssignment_recommendation, :InsertReviewAssignment_dateAssigned, :InsertReviewAssignment_dateNotified, :InsertReviewAssignment_dateConfirmed, 
                :InsertReviewAssignment_dateCompleted, :InsertReviewAssignment_dateAcknowledged, :InsertReviewAssignment_dateDue, :InsertReviewAssignment_lastModified, 
                :InsertReviewAssignment_reminderAuto, :InsertReviewAssignment_declined, :InsertReviewAssignment_replaced, :InsertReviewAssignment_cancelled, 
                :InsertReviewAssignment_reviewerFileId, :InsertReviewAssignment_dateRated, :InsertReviewAssignment_dateReminded, :InsertReviewAssignment_quality, 
                :InsertReviewAssignment_reviewRoundId, :InsertReviewAssignment_stageId, :InsertReviewAssignment_reviewMethod, :InsertReviewAssignment_round, 
                :InsertReviewAssignment_step, :InsertReviewAssignment_reviewFormId, :InsertReviewAssignment_unconsidered)',

        'params' => array(
                'submission_id' => ':InsertReviewAssignment_submissionId',
                'reviewer_id' => ':InsertReviewAssignment_reviewerId',
                'competing_interests' => ':InsertReviewAssignment_competingInterests',
                'regret_message' => ':InsertReviewAssignment_regretMessage',
                'recommendation' => ':InsertReviewAssignment_recommendation',
                'date_assigned' => ':InsertReviewAssignment_dateAssigned',
                'date_notified' => ':InsertReviewAssignment_dateNotified',
                'date_confirmed' => ':InsertReviewAssignment_dateConfirmed',
                'date_completed' => ':InsertReviewAssignment_dateCompleted',
                'date_acknowledged' => ':InsertReviewAssignment_dateAcknowledged',
                'date_due' => ':InsertReviewAssignment_dateDue',
                'last_modified' => ':InsertReviewAssignment_lastModified',
                'reminder_was_automatic' => ':InsertReviewAssignment_reminderAuto',
                'declined' => ':InsertReviewAssignment_declined',
                'replaced' => ':InsertReviewAssignment_replaced',
                'cancelled' => ':InsertReviewAssignment_cancelled',
                'reviewer_file_id' => ':InsertReviewAssignment_reviewerFileId',
                'date_rated' => ':InsertReviewAssignment_dateRated',
                'date_reminded' => ':InsertReviewAssignment_dateReminded',
                'quality' => ':InsertReviewAssignment_quality',
                'review_round_id' => ':InsertReviewAssignment_reviewRoundId',
                'stage_id' => ':InsertReviewAssignment_stageId',
                'review_method' => ':InsertReviewAssignment_reviewMethod',
                'round' => ':InsertReviewAssignment_round',
                'step' => ':InsertReviewAssignment_step',
                'review_form_id' => ':InsertReviewAssignment_reviewFormId',
                'unconsidered' => ':InsertReviewAssignment_unconsidered',
        )
),

'InsertReviewFormResponse' => array(
        'query' => 'INSERT INTO review_form_responses (review_form_element_id, review_id, response_type, response_value) 
                VALUES (:InsertReviewFormResponse_reviewFormElementId, :InsertReviewFormResponse_reviewId, :InsertReviewFormResponse_responseType, :InsertReviewFormResponse_reponseValue)',

        'params' => array(
                'review_form_element_id' => ':InsertReviewFormResponse_reviewFormElementId',
                'review_id' => ':InsertReviewFormResponse_reviewId',
                'response_type' => ':InsertReviewFormResponse_responseType',
                'response_value' => ':InsertReviewFormResponse_reponseValue',
        )
),

);