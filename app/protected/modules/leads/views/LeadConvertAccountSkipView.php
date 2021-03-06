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
     * The view for lead conversion, no account, just shows a complete
     * conversion button.
     */
    class LeadConvertAccountSkipView extends MetadataView
    {
        protected $controllerId;

        protected $moduleId;

        public function __construct($controllerId, $moduleId, $modelId)
        {
            $this->controllerId   = $controllerId;
            $this->moduleId       = $moduleId;
            $this->modelId        = $modelId;
        }

        /**
         * Renders content for a view.
         * @return A string containing the element's content.
         */
        protected function renderContent()
        {
            $content = '<div class="wide form">';
            $clipWidget = new ClipWidget();
            list($form, $formStart) = $clipWidget->renderBeginWidget(
                                                                'NoRequiredsActiveForm',
                                                                array('id' => static::getFormId(),
                                                                      'enableAjaxValidation' => false,
                                                                      'htmlOptions' => $this->resolveFormHtmlOptions())
                                                            );
            $content .= $formStart;
            $content .= $this->renderFormLayout($form);
            $formEnd  = $clipWidget->renderEndWidget();
            $content .= $formEnd;
            $content .= '</div>';
            return $content;
        }

        protected function renderFormLayout($form = null)
        {
            $content  = '<table>';
            $content .= '<colgroup>';
            $content .= '<col style="width:100%" />';
            $content .= '</colgroup>';
            $content .= '<tbody>';
            $content .= '<tr>';
            $content .= '<th>' . Zurmo::t('LeadsModule', 'Complete LeadsModuleSingularLowerCaseLabel conversion without ' .
                                                   'selecting or creating an AccountsModuleSingularLowerCaseLabel.',
                                                   LabelUtil::getTranslationParamsForAllModules()) . '</th>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
            $cancelLink = new CancelConvertLinkActionElement($this->controllerId, $this->moduleId, $this->modelId);
            $content .= '<div class="view-toolbar-container clearfix"><div class="form-toolbar">';
            $content .= $cancelLink->render() . '&#160;';
            $element  =   new SaveButtonActionElement($this->controllerId, $this->moduleId,
                                                      null,
                                                      array('htmlOptions' =>
                                                          array('name'   => 'AccountSkip', 'id' => 'AccountSkip',
                                                                'params' => array('AccountSkip' => true)),
                                                                'label'  => Zurmo::t('LeadsModule', 'Complete Conversion')));
            $content .= $element->render();
            $content .= '</div></div>';
            return $content;
        }

        protected static function getFormId()
        {
            return 'account-skip-form';
        }

        protected function resolveFormHtmlOptions()
        {
            $data = array('onSubmit' => 'js:return attachLoadingOnSubmit("' . static::getFormId() . '")');
            return $data;
        }
    }
?>
