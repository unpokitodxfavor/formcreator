<?php
/**
 * ---------------------------------------------------------------------
 * Formcreator is a plugin which allows creation of custom forms of
 * easy access.
 * ---------------------------------------------------------------------
 * LICENSE
 *
 * This file is part of Formcreator.
 *
 * Formcreator is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Formcreator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Formcreator. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 * @author    Thierry Bugier
 * @author    Jérémy Moreau
 * @copyright Copyright © 2011 - 2018 Teclib'
 * @license   GPLv3+ http://www.gnu.org/licenses/gpl.txt
 * @link      https://github.com/pluginsGLPI/formcreator/
 * @link      https://pluginsglpi.github.io/formcreator/
 * @link      http://plugins.glpi-project.org/#/plugin/formcreator
 * ---------------------------------------------------------------------
 */

include ('../../../inc/includes.php');
Session::checkRight("entity", UPDATE);

if (!isset($_REQUEST['plugin_formcreator_questions_id'])) {
   exit;
}
$questionId = (int) $_REQUEST['plugin_formcreator_questions_id'];
if ($questionId == 0) {
   $formId = (int) $_REQUEST['plugin_formcreator_forms_id'];
} else {
   $form = new PluginFormcreatorForm();
   $form->getByQuestionId($questionId);
   $formId = $form->getID();
}

if (isset($_REQUEST['_empty'])) {
   // get an empty condition HTML table row
   $form = new PluginFormcreatorForm();
   $form->getByQuestionId($questionId);
   $questionCondition = new PluginFormcreatorQuestion_Condition();
   echo $questionCondition->getConditionHtml($formId, $questionId);
}