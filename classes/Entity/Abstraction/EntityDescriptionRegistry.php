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

namespace OJSscript\Entity\Abstraction;
use OJSscript\Core\NonStaticRegistry;

/**
 * Description of EntityDescriptionRegistry
 *
 * @author bernardo
 */
class EntityDescriptionRegistry extends NonStaticRegistry
{
    public function set($key, $value)
    {
        if (!is_a($value, '\OJSscript\Entity\Abstraction\EntityDescription')) {
            throw new \Exception('Raised exception when trying to register an '
                . 'EntityDescription. The value must be of class '
                . '"\OJSscript\Entity\Abstraction\EntityDescription". '
                . 'Instead it was "' . get_class($value) . '".');
        }
        parent::set($key, $value);
    }
}
