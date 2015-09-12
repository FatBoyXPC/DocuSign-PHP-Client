<?php
/*
 * Copyright 2013 DocuSign Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Docusign\Resource;

use Docusign\Service\Service;

abstract class Resource { 

	protected $service;
	protected $client;
	protected $curl;

	public function __construct(Service $service) {
		$this->service = $service;
		$this->client = $service->getClient();
		$this->curl = $service->getCUrl();
	}
	
}

?>