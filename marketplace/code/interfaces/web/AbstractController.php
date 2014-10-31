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
abstract class AbstractController extends Controller {
	/**
	 * Determine if the request is sending JSON.
	 *
	 * @return bool
	 */
	protected function isJson()
	{
		$content_type_header = $this->request->getHeader('Content-Type');
		if(empty($content_type_header)) return false;
		return strpos($content_type_header, '/json')!==false;
	}

} 