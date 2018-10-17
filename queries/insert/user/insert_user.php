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
    'name' => 'InsertUser',
    
    'query' =>
        'INSERT INTO users '
      .     '( username, '
      .       'password, '
      .       'salutation, '
      .       'first_name, '
      .       'middle_name, '
      .       'last_name, '
      .       'gender, '
      .       'initials, '
      .       'email, '
      .       'url, '
      .       'phone, '
      .       'fax, '
      .       'mailing_address, '
      .       'country, '
      .       'locales, '
      .       'date_last_email, '
      .       'date_registered, '
      .       'date_validated, '
      .       'date_last_login, '
      .       'must_change_password, '
      .       'auth_id, '
      .       'disabled, '
      .       'disabled_reason, '
      .       'auth_str, '
      .       'suffix, '
      .       'billing_address, '
      .       'inline_help )' 
      . 'VALUES '
      .     '( :InsertUser_username, '
      .       ':InsertUser_password, '
      .       ':InsertUser_salutation, '
      .       ':InsertUser_firstName, '
      .       ':InsertUser_middleName, '
      .       ':InsertUser_lastName, '
      .       ':InsertUser_gender, '
      .       ':InsertUser_initials, '
      .       ':InsertUser_email, '
      .       ':InsertUser_url, '
      .       ':InsertUser_phone, '
      .       ':InsertUser_fax, '
      .       ':InsertUser_mailingAddress, '
      .       ':InsertUser_country, '
      .       ':InsertUser_locales, '
      .       ':InsertUser_dateLastEmail, '
      .       ':InsertUser_dateRegistered, '
      .       ':InsertUser_dateValidated, '
      .       ':InsertUser_dateLastLogin, '
      .       ':InsertUser_mustChangePassword, '
      .       ':InsertUser_authId, '
      .       ':InsertUser_disabled, '
      .       ':InsertUser_disabledReason, '
      .       ':InsertUser_authStr, '
      .       ':InsertUser_suffix, '
      .       ':InsertUser_billingAddress, '
      .       ':InsertUser_inlineHelp )',
    
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
                 'inline_help' => ':InsertUser_inlineHelp',
    ),
);
