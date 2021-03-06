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
interface ISummitAttendeeFactory
{

    /**
     * @param Member $member
     * @param ISummit $summit
     * @param bool $shared_contact_info
     * @return ISummitAttendee
     */
    public function build(Member $member, ISummit $summit, $shared_contact_info = false);

    /**
     * @param int $external_attendee_id
     * @param int $order_external_id
     * @param string $bought_date
     * @param string $changed_date
     * @param ISummitTicketType $ticket_type
     * @return ISummitAttendeeTicket
     */
    public function buildTicket($external_attendee_id , $order_external_id, $bought_date, $changed_date, ISummitTicketType $ticket_type);
}