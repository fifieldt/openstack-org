<?php

/**
 * Copyright 2017 OpenStack Foundation
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 **/

/**
 * Class SurveyNumericQuestionTemplateUIBuilder
 */
class SurveyNumericQuestionTemplateUIBuilder extends SurveyTextBoxQuestionTemplateUIBuilder
{
    /**
     * @param string $name
     * @param string $label
     * @return TextField
     */
    protected function buildField($name, $label){
        return new HTML5NumericField($name, $label);
    }

    /**
     * @param ISurveyStep $current_step
     * @param ISurveyQuestionTemplate $question
     * @param ISurveyAnswer $answer
     * @return FormField
     */
    public function build(ISurveyStep $current_step, ISurveyQuestionTemplate $question, ISurveyAnswer $answer)
    {
        $field = parent::build($current_step, $question, $answer);
        $field->addExtraClass('number-input');
        $field->addExtraClass('text');
        $field->setAttribute('data-rule-digits','true');
        return $field;
    }
}