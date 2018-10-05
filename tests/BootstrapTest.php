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

namespace OJSscript\Tests;
require_once '../includes/bootstrap.php';

/**
 * Description of BootstrapTest
 *
 * @author bernardo
 */
class BootstrapTest extends \PHPUnit\Framework\TestCase
{
    public function testConstants()
    {
        //test if BASE_DIR is a directory
        $this->assertTrue(is_dir(BASE_DIR));
        
        //test if LINKS_DIR is a directory
        $this->assertTrue(is_dir(LINKS_DIR));
    }
}
