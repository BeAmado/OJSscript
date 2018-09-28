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
    
/////////// user related /////////////
'UpdateUserDates' => array(
        'query' => 'UPDATE users SET 
                date_last_email = :UpdateUserDates_dateLastEmail, date_registered = :UpdateUserDates_dateRegistered, 
                date_validated = :UpdateUserDates_dateValidated, date_last_login = :UpdateUserDates_dateLastLogin
                WHERE user_id = :UpdateUserDates_userId',

        'params' => array(
                'date_last_email' => ':UpdateUserDates_dateLastEmail', 
                'date_registered' => ':UpdateUserDates_dateRegistered', 
                'date_validated' => ':UpdateUserDates_dateValidated', 
                'date_last_login' => ':UpdateUserDates_dateLastLogin',
                'user_id' => ':UpdateUserDates_userId'
        )
),


/////////// article related ///////////
/**
does not Update the following fields:
        article_id, since it is the primary key
        journal_id
        section_id
        user_id
        submission_file_id
        revised_file_id
        review_file_id
        editor_file_id

*/
'UpdateArticle' => array(
        'query' => 'UPDATE articles
                SET language = :UpdateArticle_language, comments_to_ed = :UpdateArticle_commentsToEd, date_submitted = :UpdateArticle_dateSubmitted, last_modified = :UpdateArticle_lastModified, 
                date_status_modified = :UpdateArticle_dateStatusModified, status = :UpdateArticle_status, submission_progress = :UpdateArticle_submissionProgress, 
                current_round = :UpdateArticle_currentRound, pages = :UpdateArticle_pages, fast_tracked = :UpdateArticle_fastTracked, hide_author = :UpdateArticle_hideAuthor, 
                comments_status = :UpdateArticle_commentsStatus, locale = :UpdateArticle_locale, citations = :UpdateArticle_citations
                WHERE article_id = :UpdateArticle_articleId',

        'params' => array(
                'language' => ':UpdateArticle_language',
                'comments_to_ed' => ':UpdateArticle_commentsToEd',
                'date_submitted' => ':UpdateArticle_dateSubmitted',
                'last_modified' => ':UpdateArticle_lastModified',
                'date_status_modified' => ':UpdateArticle_dateStatusModified',
                'status' => ':UpdateArticle_status',
                'submission_progress' => ':UpdateArticle_submissionProgress', 
                'current_round' => ':UpdateArticle_currentRound', 
                'pages' => ':UpdateArticle_pages', 
                'fast_tracked' => ':UpdateArticle_fastTracked', 
                'hide_author' => ':UpdateArticle_hideAuthor', 
                'comments_status' => ':UpdateArticle_commentsStatus', 
                'locale' => ':UpdateArticle_locale', 
                'citations' => ':UpdateArticle_citations',
                'article_id' => ':UpdateArticle_articleId',
        )
),


'UpdateArticleDates' => array(
        'query' => 'UPDATE articles SET
                date_status_modified = :UpdateArticleDates_dateStatusModified, date_submitted = :UpdateArticleDates_dateSubmitted,
                last_modified = :UpdateArticleDates_lastModified WHERE article_id = :UpdateArticleDates_articleId',

        'params' => array(
                'date_status_modified' => ':UpdateArticleDates_dateStatusModified',
                'date_submitted' => ':UpdateArticleDates_dateSubmitted',
                'last_modified' => ':UpdateArticleDates_lastModified',
                'article_id' => ':UpdateArticleDates_articleId'
        )
),


'UpdateArticle_filesIds' => array(
        'query' => 'UPDATE articles SET 
                submission_file_id = :UpdateArticle_filesIds_submissionFileId, revised_file_id = :UpdateArticle_filesIds_revisedFileId, 
                review_file_id = :UpdateArticle_filesIds_reviewFileId, editor_file_id = :UpdateArticle_filesIds_editorFileId 
                WHERE article_id = :UpdateArticle_filesIds_articleId',

        'params' => array(
                'submission_file_id' => ':UpdateArticle_filesIds_submissionFileId',
                'revised_file_id' => ':UpdateArticle_filesIds_revisedFileId', 
                'review_file_id' => ':UpdateArticle_filesIds_reviewFileId', 
                'editor_file_id' => ':UpdateArticle_filesIds_editorFileId', 
                'article_id' => ':UpdateArticle_filesIds_articleId'
        )
),

'UpdateArticleSetting' => array(
    'query' => 'UPDATE article_settings 
            SET setting_value = :UpdateArticleSetting_settingValue, setting_type = :UpdateArticleSetting_settingType
            WHERE article_id = :UpdateArticleSetting_articleId AND locale = :UpdateArticleSetting_locale AND setting_name = :UpdateArticleSetting_settingName',

    'params' => array(
        'article_id' => ':UpdateArticleSetting_articleId',
        'locale' => ':UpdateArticleSetting_locale',
        'setting_name' => ':UpdateArticleSetting_settingName',
        'setting_value' => ':UpdateArticleSetting_settingValue',
        'setting_type' => ':UpdateArticleSetting_settingType'
    )
),

'UpdateArticleFile' => array(
    'query' => 'UPDATE article_files 
        SET source_revision = :UpdateArticleFile_sourceRevision, file_stage = :UpdateArticleFile_fileStage , viewable = :UpdateArticleFile_viewable, 
                date_uploaded = :UpdateArticleFile_dateUploaded, date_modified = :UpdateArticleFile_dateModified, round = :UpdateArticleFile_round, assoc_id = :UpdateArticleFile_assocId
        WHERE file_id = :UpdateArticleFile_fileId AND revision = :UpdateArticleFile_revision',

    'params' => array(
        'source_revision' => ':UpdateArticleFile_sourceRevision',
        'file_stage' => ':UpdateArticleFile_fileStage',
        'viewable' => ':UpdateArticleFile_viewable',
        'date_uploaded' => ':UpdateArticleFile_dateUploaded',
        'date_modified' => ':UpdateArticleFile_dateModified',
        'round' => ':UpdateArticleFile_round',
        'assoc_id' => ':UpdateArticleFile_assocId',
        'file_id' => ':UpdateArticleFile_fileId',
        'revision' => ':UpdateArticleFile_revision'
    )
),

'UpdateArticleFile_namesAndSourceId' => array(
    'query' => 'UPDATE article_files SET source_file_id = :UpdateArticleFile_namesAndSourceIds_sourceFileId, 
            file_name = :UpdateArticleFile_namesAndSourceIds_fileName, original_file_name = :UpdateArticleFile_namesAndSourceIds_originalFileName 
            WHERE file_id = :UpdateArticleFile_namesAndSourceIds_fileId AND revision = :UpdateArticleFile_namesAndSourceIds_revision',

    'params' => array(
        'source_file_id' => ':UpdateArticleFile_namesAndSourceIds_sourceFileId', 
        'file_name' => ':UpdateArticleFile_namesAndSourceIds_fileName', 
        'original_file_name' => ':UpdateArticleFile_namesAndSourceIds_originalFileName',
        'file_id' => ':UpdateArticleFile_namesAndSourceIds_fileId',
        'revision' => ':UpdateArticleFile_namesAndSourceIds_revision'
    )
),

'UpdateReviewRound' => array(
    'query' => 'UPDATE review_rounds SET 
            stage_id = :UpdateReviewRound_stageId, round = :UpdateReviewRound_round, 
            review_revision = :UpdateReviewRound_reviewRevision, status = :UpdateReviewRound_status
            WHERE review_round_id = :UpdateReviewRound_reviewRoundId',

    'params' => array(
        'stage_id' => ':UpdateReviewRound_stageId', 
        'round' => ':UpdateReviewRound_round', 
        'review_revision' => ':UpdateReviewRound_reviewRevision', 
        'status' => ':UpdateReviewRound_status',
        'review_round_id' => ':UpdateReviewRound_reviewRoundId',
    )
),

'UpdateReviewAssignment' => array(
    'query' => 'UPDATE review_assignments SET
            competing_interests = :UpdateReviewAssignment_competingInterests, regret_message = :UpdateReviewAssignment_regretMessage, 
            recommendation = :UpdateReviewAssignment_recommendation, date_assigned = :UpdateReviewAssignment_dateAssigned, 
            date_notified = :UpdateReviewAssignment_dateNotified, date_confirmed = :UpdateReviewAssignment_dateConfirmed, 
            date_completed = :UpdateReviewAssignment_dateCompleted, date_acknowledged = :UpdateReviewAssignment_dateAcknowledged, 
            date_due = :UpdateReviewAssignment_dateDue, last_modified = :UpdateReviewAssignment_lastModified, reminder_was_automatic = :UpdateReviewAssignment_reminderWasAutomatic, 
            declined = :UpdateReviewAssignment_declined, replaced = :UpdateReviewAssignment_replaced, cancelled = :UpdateReviewAssignment_cancelled, 
            reviewer_file_id = :UpdateReviewAssignment_reviewerFileId, date_rated = :UpdateReviewAssignment_dateRated, date_reminded = :UpdateReviewAssignment_dateReminded, 
            quality = :UpdateReviewAssignment_quality, review_round_id = :UpdateReviewAssignment_reviewRoundId, stage_id = :UpdateReviewAssignment_stageId,
            review_method = :UpdateReviewAssignment_reviewMethod, round = :UpdateReviewAssignment_round, step = :UpdateReviewAssignment_step, 
            review_form_id = :UpdateReviewAssignment_reviewFormId, unconsidered = :UpdateReviewAssignment_unconsidered
            WHERE review_id = :UpdateReviewAssignment_reviewId',

    'params' => array(
        'competing_interests' => ':UpdateReviewAssignment_competingInterests',
        'regret_message' => ':UpdateReviewAssignment_regretMessage', 
        'recommendation' => ':UpdateReviewAssignment_recommendation',
        'date_assigned' => ':UpdateReviewAssignment_dateAssigned', 
        'date_notified' => ':UpdateReviewAssignment_dateNotified', 
        'date_confirmed' => ':UpdateReviewAssignment_dateConfirmed', 
        'date_completed' => ':UpdateReviewAssignment_dateCompleted', 
        'date_acknowledged' => ':UpdateReviewAssignment_dateAcknowledged', 
        'date_due' => ':UpdateReviewAssignment_dateDue', 
        'last_modified' => ':UpdateReviewAssignment_lastModified', 
        'reminder_was_automatic' => ':UpdateReviewAssignment_reminderWasAutomatic', 
        'declined' => ':UpdateReviewAssignment_declined', 
        'replaced' => ':UpdateReviewAssignment_replaced',
        'cancelled' => ':UpdateReviewAssignment_cancelled', 
        'reviewer_file_id' => ':UpdateReviewAssignment_reviewerFileId',
        'date_rated' => ':UpdateReviewAssignment_dateRated', 
        'date_reminded' => ':UpdateReviewAssignment_dateReminded', 
        'quality' => ':UpdateReviewAssignment_quality', 
        'review_round_id' => ':UpdateReviewAssignment_reviewRoundId', 
        'stage_id' => ':UpdateReviewAssignment_stageId',
        'review_method' => ':UpdateReviewAssignment_reviewMethod', 
        'round' => ':UpdateReviewAssignment_round', 
        'step' => ':UpdateReviewAssignment_step', 
        'review_form_id' => ':UpdateReviewAssignment_reviewFormId', 
        'unconsidered' => ':UpdateReviewAssignment_unconsidered',
        'review_id' => ':UpdateReviewAssignment_reviewId'
    )
),


////// review_forms related //////
'UpdateReviewForm' => array(
    'query' => 'UPDATE review_forms SET 
            seq = :UpdateReviewForm_seq, is_active = :UpdateReviewForm_isActive
            WHERE review_form_id = :UpdateReviewForm_reviewFormId',

    'params' => array(
        'seq' => ':UpdateReviewForm_seq',
        'is_active' => ':UpdateReviewForm_isActive',
        'review_form_id' => ':UpdateReviewForm_reviewFormId' 
    )
),

'UpdateReviewFormElement' => array (
    'query' => 'UPDATE review_form_elements SET
            seq = :UpdateReviewFormElement_seq, element_type = :UpdateReviewFormElement_elementType,
            required = :UpdateReviewFormElement_required, included = :UpdateReviewFormElement_included
            WHERE review_form_element = :UpdateReviewFormElement_reviewFormElementId',

    'params' => array(
        'seq' => ':UpdateReviewFormElement_seq', 
        'element_type' => ':UpdateReviewFormElement_elementType',
        'required' => ':UpdateReviewFormElement_required', 
        'included' => ':UpdateReviewFormElement_included',
        'review_form_element' => ':UpdateReviewFormElement_reviewFormElementId',
    )
),

);