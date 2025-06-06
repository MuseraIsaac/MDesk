<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2025 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

include('../../inc/includes.php');

use Glpi\ContentTemplates\TemplateManager;
use Glpi\Http\Response;
use Michelf\MarkdownExtra;

// Check mandatory parameter
$preset = $_GET['preset'] ?? null;
if (is_null($preset)) {
    Response::sendError(400, "Missing mandatory 'preset' parameter", Response::CONTENT_TYPE_TEXT_HTML);
}

Html::includeHeader(__("Template variables documentation"));
echo "<body class='documentation-page'>";
echo "<div id='page'>";
echo "<div class='documentation documentation-large'>";

// Parse markdown
$md = new MarkdownExtra();
$md->header_id_func = function ($headerName) {
    return Toolbox::slugify($headerName, '');
};
echo $md->transform(TemplateManager::generateMarkdownDocumentation($preset));

echo "</div>";
echo "</div>";

// Footer closes main and div
echo "<main>";
echo "<div>";
Html::nullFooter();
