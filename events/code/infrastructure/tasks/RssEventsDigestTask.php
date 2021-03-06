<?php
/**
 * Copyright 2014 Openstack Foundation
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
 * Class RssEventsDigestTask
 */

final class RssEventsDigestTask extends CronTask {
    function run(){

        try{

            $repository = new SapphireEventRepository();
            $tx_manager = SapphireTransactionManager::getInstance();
            $event_manager = new EventManager(
                $repository,
                new EventRegistrationRequestFactory,
                null,
                new SapphireEventPublishingService,
                new EventValidatorFactory,
                $tx_manager
            );

            $rss_events = $event_manager->rssEvents(10000);
            $events_array = $event_manager->rss2events($rss_events);
            $event_manager->saveRssEvents($events_array);

            // purge events that no longer come in the xml
            if (count($events_array) > 0) {
                $events_to_purge = $repository->getRssForPurge($events_array);

                foreach($events_to_purge as $event) {
                    $event_manager->deleteEvent($event->ID);
                }
            }

            return 'OK';
        }
        catch(Exception $ex){
            SS_Log::log($ex,SS_Log::ERR);
            echo $ex->getMessage();
        }
    }
}