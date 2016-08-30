<?php
/**
 * Copyright 2015 OpenStack Foundation
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
 * Interface IRSVP
 */
interface IRSVP extends IEntity {

    const SeatTypeRegular  = 'Regular';
    const SeatTypeWaitList = 'WaitList';
    /**
     * @return IAnswer[]
     */
    public function getAnswers();

    /**
     * @param IRSVPAnswer $new_answer
     * @return void
     */
    public function addAnswer(IRSVPAnswer $new_answer);

    /**
     * @return IRSVPTemplate
     */
    public function template();

    /**
     * @return ICommunityMember
     */
    public function submittedBy();

    /**
     * @return bool
     */
    public function isEmailSent();

    /**
     * @param IMessageSenderService $service
     * @throws EntityValidationException
     */
    public function sentEmail(IMessageSenderService $service);

    /**
     * @param IRSVPQuestionTemplate $question
     * @return IRSVPAnswer
     */
    public function findAnswerByQuestion(IRSVPQuestionTemplate $question);

}