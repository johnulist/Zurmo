<?php
    /*********************************************************************************
     * Zurmo is a customer relationship management program developed by
     * Zurmo, Inc. Copyright (C) 2012 Zurmo Inc.
     *
     * Zurmo is free software; you can redistribute it and/or modify it under
     * the terms of the GNU General Public License version 3 as published by the
     * Free Software Foundation with the addition of the following permission added
     * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
     * IN WHICH THE COPYRIGHT IS OWNED BY ZURMO, ZURMO DISCLAIMS THE WARRANTY
     * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
     *
     * Zurmo is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
     * details.
     *
     * You should have received a copy of the GNU General Public License along with
     * this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact Zurmo, Inc. with a mailing address at 113 McHenry Road Suite 207,
     * Buffalo Grove, IL 60089, USA. or at email address contact@zurmo.com.
     ********************************************************************************/

    /**
     * View for upgrade.
     */
    class UpgradeStartCompleteView extends View
    {
        private $controlerId;

        private $moduleId;

        public function __construct($controllerId, $moduleId)
        {
            assert('is_string($controllerId) && $controllerId != ""');
            assert('is_string($moduleId) && $moduleId != ""');
            $this->controllerId = $controllerId;
            $this->moduleId     = $moduleId;
        }

        protected function renderContent()
        {
            $cs = Yii::app()->getClientScript();
            $cs->registerScriptFile($cs->getCoreScriptUrl() . '/jquery.min.js', CClientScript::POS_END);
            $zurmoUpgradeStepOneUrl = Yii::app()->createUrl($this->moduleId . '/' . $this->controllerId . '/stepOne/');

            $content  = '<div class="MetadataView">';
            $content .= '<table><tr><td>';
            $content .= '<div id="upgrade-step-two">';
            $content .= '<table><tr><td>';
            $content .= Zurmo::t('InstallModule', 'This is the Zurmo upgrade process. Please backup all files and the database before you continue.');
            $content .= '<br/>';
            $content .= Zurmo::t('InstallModule', 'Copy upgrade file to app/protected/runtime/upgrade folder and start upgrade process.');
            $content .= '<br/><br/>';
            $content .= ZurmoHtml::link(Zurmo::t('InstallModule', 'Click here to start upgrade'), $zurmoUpgradeStepOneUrl);
            $content .= '</td></tr></table>';
            $content .= '</div>';
            $content .= '</td></tr></table>';
            $content .= '</div>';
            return $content;
        }
    }
?>
