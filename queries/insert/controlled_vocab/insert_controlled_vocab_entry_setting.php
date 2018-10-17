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
    'name' => 'InsertControlledVocabEntrySetting',
    
    'query' => 
        'INSERT INTO controlled_vocab_entry_settings '
      .     '( controlled_vocab_entry_id, '
      .       'locale, '
      .       'setting_name, '
      .       'setting_value, '
      .       'setting_type ) '
      . 'VALUES '
      .     '( :InsertControlledVocabEntrySetting_controlledVocabEntryId, '
      .       ':InsertControlledVocabEntrySetting_locale, '
      .       ':InsertControlledVocabEntrySetting_settingName, '
      .       ':InsertControlledVocabEntrySetting_settingValue, '
      .       ':InsertControlledVocabEntrySetting_settingType )',

    'params' => array(
        'controlled_vocab_entry_id' => 
                    ':InsertControlledVocabEntrySetting_controlledVocabEntryId',
        'locale' => ':InsertControlledVocabEntrySetting_locale',
  'setting_name' => ':InsertControlledVocabEntrySetting_settingName',
 'setting_value' => ':InsertControlledVocabEntrySetting_settingValue',
  'setting_type' => ':InsertControlledVocabEntrySetting_settingType',
    ),
);
