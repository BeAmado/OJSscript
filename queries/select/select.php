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

return array (

/////////// user related queries ///////////////////
'SelectUsernameCount' => array(
    'query' => 
        'SELECT COUNT(*) as count ' . 
        'FROM users ' .
        'WHERE username = :SelectUsernameCount_username',
    
    'params' => array('username' => ':SelectUsernameCount_username')
),

'SelectUserByEmail' => array(
    'query' => 
        'SELECT * ' . 
        'FROM users ' . 
        'WHERE email = :SelectUserByEmail_email',
    
    'params' => array('email' => ':SelectUserByEmail_email')
),

'SelectUserById' => array(
    'query' => 
        'SELECT * ' . 
        'FROM users ' . 
        'WHERE user_id = :SelectUserById_userId',
    
    'params' => array('user_id' => ':SelectUserById_userId'),
),

'SelectUserSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM user_settings ' .
        'WHERE user_id = :SelectUserSettings_userId',
    
    'params' => array('user_id', ':SelectUserSettings_userId'),
),

'SelectUserRoles' => array(
    'query' => 
        'SELECT * ' .
        'FROM roles ' .
        'WHERE journal_id = :SelectUserRoles_journalId AND ' . 
                 'user_id = :SelectUserRoles_userId',
    
    'params' => array(
        'journal_id' => ':SelectUserRoles_journalId',
        'user_id' => ':SelectUserRoles_userId'
    )
),

'SelectUserInterests' => array(
    'query' => 
        'SELECT ' . 
            't.setting_value AS interest, ' .
            'u_int.controlled_vocab_entry_id AS controlled_vocab_entry_id '.
        'FROM user_interests AS u_int ' .
        'INNER JOIN controlled_vocab_entry_settings AS t ' .
            'ON u_int.controlled_vocab_entry_id = ' .
                   't.controlled_vocab_entry_id ' .
        'WHERE u_int.user_id = :SelectUserInterests_userId',

    'params' => array('user_id' => ':SelectUserInterests_userId'),
),

'SelectInterestControlledVocabId' => array(
    'query' => 
        'SELECT * ' . 
        'FROM controlled_vocabs ' .
        'WHERE symbolic = "interest"',

    'params' => null,
),

'SelectLastControlledVocabEntry' => array(
    'query' => 
        'SELECT * ' .
        'FROM controlled_vocab_entries ' .
        'ORDER BY controlled_vocab_entry_id DESC ' .
        'LIMIT 1',

    'params' => null,
),


////////// article related queries //////////////////
'SelectPublishedArticles' => array(
    'query' => 
        'SELECT ' . 
            'art.*, ' . 
            'pub_art.* ' .
        'FROM published_articles AS pub_art ' .
        'INNER JOIN articles AS art ' . 
            'ON art.article_id = pub_art.article_id ' .
        'WHERE art.journal_id = :SelectPublishedArticles_journalId',

    'params' => array('journal_id' => ':SelectPublishedArticles_journalId'),
),

'SelectPublishedArticleBySetting' => array(
    'query' => 
        'SELECT ' . 
            'art.*, ' . 
            'sett.*, ' . 
            'pub.*  ' . 
        'FROM article_settings AS sett ' .
        'INNER JOIN articles AS art ' .
            'ON art.article_id = sett.article_id ' .
        'INNER JOIN published_articles AS pub ' .
            'ON pub.article_id = sett.article_id ' .
        'WHERE ' .
           'art.journal_id = :SelectPublishedArticleBySetting_journalId AND' .
              'sett.locale = :SelectPublishedArticleBySetting_locale AND ' .
        'sett.setting_name = :SelectPublishedArticleBySetting_settingName AND '.
       'sett.setting_value = :SelectPublishedArticleBySetting_settingValue',

    'params' => array(
        'journal_id' => ':SelectPublishedArticleBySetting_journalId',
        'locale' => ':SelectPublishedArticleBySetting_locale',
        'setting_name' => ':SelectPublishedArticleBySetting_settingName',
        'setting_value' => ':SelectPublishedArticleBySetting_settingValue',
    ),
),

'countPublishedArticleBySetting' => array(
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
),

'SelectUnpublishedArticles' => array(
    'query' => 
        'SELECT * ' .
        'FROM articles ' .
        'WHERE article_id IN (' .
            'SELECT article_id ' .
            'FROM articles ' .
            'WHERE article_id NOT IN (' .
                'SELECT article_id FROM published_articles' .
            ') AND journal_id = :SelectUnpublishedArticles_journalId' .
        ')',

    'params' => array('journal_id' => ':SelectUnpublishedArticles_journalId'),
),

'SelectArticles' => array(
    'query' => 
        'SELECT ' . 
            'art.*, ' . 
            'pub_art.* ' . 
        'FROM articles AS art ' .
        'LEFT JOIN published_articles AS pub_art ' .
            'ON pub_art.article_id = art.article_id ' .
        'WHERE art.journal_id = :SelectArticles_journalId',

    'params' => array('journal_id' => ':SelectArticles_journalId'),
),

'SelectAuthors' => array(
    'query' => 
        'SELECT * ' . 
        'FROM authors ' .
        'WHERE submission_id = :SelectAuthors_submissionId',
    
    'params' => array('submission_id' => ':SelectAuthors_submissionId'),
),

'SelectAuthorByEmail' => array(
    'query' => 
        'SELECT * ' . 
        'FROM authors ' . 
        'WHERE email = :SelectAuthorByEmail_email',
    
    'params' => array('email' => ':SelectAuthorByEmail_email'),
),

'SelectAuthorSettings' => array(
    'query' => 
        'SELECT * ' .
        'FROM author_settings ' .
        'WHERE author_id = :SelectAuthorSettings_authorId',
    
    'params' => array('author_id' => ':SelectAuthorSettings_authorId'),
),

'SelectArticleSettings' => array(
    'query' => 
        'SELECT * ' .
        'FROM article_settings ' . 
        'WHERE article_id = :SelectArticleSettings_articleId',
    
    'params' => array('article_id' => ':SelectArticleSettings_articleId'),
),

'SelectArticleFiles' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_files ' . 
        'WHERE article_id = :SelectArticleFiles_articleId',
    
    'params' => array('article_id' => ':SelectArticleFiles_articleId'),
),

'SelectArticleSupplementaryFiles' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_supplementary_files ' . 
        'WHERE article_id = :SelectArticleSupplementaryFiles_articleId',
    
    'params' => array('article_id' => 
        ':SelectArticleSupplementaryFiles_articleId'),
),

'SelectArticleSuppFileSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_supp_file_settings ' . 
        'WHERE supp_id = :SelectArticleSuppFileSettings_suppId',
    
    'params' => array('supp_id' => ':SelectArticleSuppFileSettings_suppId'),
),

'SelectArticleComments' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_comments ' . 
        'WHERE article_id = :SelectArticleComments_articleId',
    
    'params' => array('article_id' => ':SelectArticleComments_articleId'),
),

'SelectArticleGalleys' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_galleys ' . 
        'WHERE article_id = :SelectArticleGalleys_articleId',
    
    'params' => array('article_id' => ':SelectArticleGalleys_articleId'),
),

'SelectArticleGalleySettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_galley_settings ' . 
        'WHERE galley_id = :SelectArticleGalleySettings_galleyId',
    'params' => array('galley_id' => ':SelectArticleGalleySettings_galleyId'),
),

'SelectArticleXmlGalleys' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_xml_galleys ' . 
        'WHERE ' . 
            'galley_id = :SelectArticleXmlGalleys_galleyId AND ' . 
           'article_id = :SelectArticleXmlGalleys_articleId',
    
    'params' => array(
        'galley_id' => ':SelectArticleXmlGalleys_galleyId',
        'article_id' => ':SelectArticleXmlGalleys_articleId',
    )
),

'SelectHtmlGalleyImages' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_html_galley_images ' . 
        'WHERE galley_id = :SelectHtmlGalleyImages_galleyId',
    
    'params' => array('galley_id' => ':SelectHtmlGalleyImages_galleyId'),
),

'SelectArticleSearchKeywordLists' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_search_keyword_list ' . 
        'WHERE keyword_id = :SelectArticleSearchKeywordLists_keywordId',
    
    'params' => array('keyword_id' => 
        ':SelectArticleSearchKeywordLists_keywordId'),
),

'SelectArticleSearchObjectKeywords' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_search_object_keywords ' . 
        'WHERE object_id = :SelectArticleSearchObjectKeywords_objectId',
    
    'params' => array('object_id' => 
        ':SelectArticleSearchObjectKeywords_objectId'),
),

'SelectArticleSearchObjects' => array(
    'query' => 
        'SELECT * ' . 
        'FROM article_search_objects ' . 
        'WHERE article_id = :SelectArticleSearchObjects_articleId',
    
    'params' => array('article_id' => ':SelectArticleSearchObjects_articleId'),
),

'SelectEditDecisions' => array(
    'query' => 
        'SELECT * ' . 
        'FROM edit_decisions ' . 
        'WHERE article_id = :SelectEditDecisions_articleId',
    
    'params' => array('article_id' => ':SelectEditDecisions_articleId'),
),

'SelectEditAssignments' => array(
    'query' => 
        'SELECT * ' . 
        'FROM edit_assignments ' . 
        'WHERE article_id = :SelectEditAssignments_articleId',
    
    'params' => array('article_id' => ':SelectEditAssignments_articleId'),
),

'SelectReviewAssignments' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_assignments ' . 
        'WHERE submission_id = :SelectReviewAssignments_submissionId',
    
    'params' => array('submission_id' => 
        ':SelectReviewAssignments_submissionId'),
),

'SelectReviewRounds' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_rounds ' . 
        'WHERE submission_id = :SelectReviewRounds_submissionId',
    
    'params' => array('submission_id' => ':SelectReviewRounds_submissionId'),
),

//review_form_responses
'SelectReviewFormResponses' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_form_responses ' . 
        'WHERE review_id = :SelectReviewFormResponses_reviewId',
    
    'params' => array('review_id' => ':SelectReviewFormResponses_reviewId'),
),


////////// section related //////////////
'SelectSections' => array(
    'query' => 
        'SELECT * ' . 
        'FROM sections ' . 
        'WHERE journal_id = :SelectSections_journalId',
    
    'params' => array('journal_id' => ':SelectSections_journalId'),
),

'SelectSectionSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM section_settings ' . 
        'WHERE section_id = :SelectSectionSettings_sectionId',
    
    'params' => array('section_id' => ':SelectSectionSettings_sectionId'),
),

'SelectSectionTitlesAndAbbrevs' => array(
    'query' => 
        'SELECT ' . 
            'section_id, ' . 
            'setting_name, ' . 
            'setting_value, ' . 
            'locale ' . 
        'FROM section_settings ' . 
        'WHERE ' . 
            'section_id = :SelectSectionTitlesAndAbbrevs_sectionId AND ' . 
            'setting_name IN ("title", "abbrev")',

    'params' => array('section_id' => 
        ':SelectSectionTitlesAndAbbrevs_sectionId'),
),


////// announcements related //////////////
'SelectAnnouncements' => array(
    'query' => 
        'SELECT * ' . 
        'FROM announcements ' . 
        'WHERE assoc_id = :SelectAnnouncements_journalId',
    
    'params' => array('assoc_id' => ':SelectAnnouncements_journalId'),
),

'SelectAnnouncementSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM announcement_settings ' . 
        'WHERE announcement_id = :SelectAnnouncementSettings_announcementId',
        
    'params' => array('announcement_id' => 
        ':SelectAnnouncementSettings_announcementId'),
),


//////// groups related  ////////////////////
'SelectGroups' => array(
    'query' => 
        'SELECT * ' . 
        'FROM groups ' . 
        'WHERE assoc_id = :SelectGroups_journalId',
    
    'params' => array('assoc_id' => ':SelectGroups_journalId'),
),

'SelectGroupSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM group_settings ' . 
        'WHERE group_id = :SelectGroupSettings_groupId',
    
    'params' => array('group_id' => ':SelectGroupSettings_groupId'),
),

'SelectGroupMemberships' => array(
    'query' => 
        'SELECT * ' . 
        'FROM group_memberships ' . 
        'WHERE group_id = :SelectGroupMemberships_groupId',
        
    'params' => array('group_id' => ':SelectGroupMemberships_groupId'),
),


//////// review_forms related //////////////
'SelectReviewForms' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_forms ' . 
        'WHERE assoc_id = :SelectReviewForms_assocId',
    
    'params' => array('assoc_id' => ':SelectReviewForms_assocId'),
),

'SelectReviewFormSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_form_settings ' . 
        'WHERE review_form_id = :SelectReviewFormSettings_reviewFormId',
    
    'params' => array('review_form_id' => 
        ':SelectReviewFormSettings_reviewFormId'),
),

'SelectReviewFormElements' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_form_elements ' . 
        'WHERE review_form_id = :SelectReviewFormElements_reviewFormId',
    
    'params' => array('review_form_id' => 
        ':SelectReviewFormElements_reviewFormId'),
),

'SelectReviewFormElementSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM review_form_element_settings ' . 
        'WHERE review_form_element_id = ' . 
              ':SelectReviewFormElementSettings_reviewFormElementId',
    
    'params' => array('review_form_element_id' => 
        ':SelectReviewFormElementSettings_reviewFormElementId'),
),

//the review_form_response queries are at the final of the 
//article related Select queries



/////////////  issues related  //////////////////////
'SelectIssues' => array(
    'query' => 
        'SELECT * ' . 
        'FROM issues ' . 
        'WHERE journal_id = :SelectIssues_journalId',
    
    'params' => array('journal_id' => ':SelectIssues_journalId'),
),

'SelectIssueSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM issue_settings ' . 
        'WHERE issue_id = :SelectIssueSettings_issueId',
    
    'params' => array('issue_id' => ':SelectIssueSettings_issueId'),
),

'SelectCustomIssueOrders' => array(
    'query' => 
        'SELECT * ' . 
        'FROM custom_issue_orders ' . 
        'WHERE ' . 
            'journal_id = :SelectCustomIssueOrders_journalId AND ' . 
              'issue_id = :SelectCustomIssueOrders_issueId',
    
    'params' => array(
        'journal_id' => ':SelectCustomIssueOrders_journalId',
        'issue_id' => ':SelectCustomIssueOrders_issueId',
    ),
),

'SelectCustomSectionOrders' => array(
    'query' => 
        'SELECT * ' . 
        'FROM custom_section_orders ' . 
        'WHERE issue_id = :SelectCustomSectionOrders_issueId',
    
    'params' => array('issue_id' => ':SelectCustomSectionOrders_issueId'),
),


////////// plugin_settings ////////////
'SelectPluginSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM plugin_settings ' . 
        'WHERE journal_id = :SelectPluginSettings_journalId',
    
    'params' => array('journal_id' => ':SelectPluginSettings_journalId'),
),


////////// event_log /////////////////

'SelectEventLogs' => array(
    'query' => 
        'SELECT * ' . 
        'FROM event_log ' . 
        'WHERE assoc_id = :SelectEventLogs_articleId',
    
    'params' => array('assoc_id' => ':SelectEventLogs_assocId'),
),

'SelectEventLogSettings' => array(
    'query' => 
        'SELECT * ' . 
        'FROM event_log_settings ' . 
        'WHERE log_id = :SelectEventLogSettings_logId',

    'params' => array('log_id' => ':SelectEventLogSettings_logId'),
),

////////// email_log /////////////////////

'SelectEmailLogs' => array(
    'query' => 
        'SELECT * ' . 
        'FROM email_log ' . 
        'WHERE assoc_id = :SelectEmailLogs_assocId',
    
    'params' => array('assoc_id' => ':SelectEmailLogs_assocId'),
),

'SelectEmailLogUsers' => array(
    'query' => 
        'SELECT * ' . 
        'FROM email_log_users ' . 
        'WHERE email_log_id = :SelectEmailLogUsers_emailLogId',
    
    'params' => array('email_log_id' => ':SelectEmailLogUsers_emailLogId'),
),

); //end of the array to be returned