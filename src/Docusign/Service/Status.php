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

namespace Docusign\Service;

use Docusign\DocuSignClient;
use Docusign\Resource\Status as StatusResource;

class Status extends Service {

	public $status;

	/**
	* Constructs the internal representation of the DocuSign Status service.
	*
	* @param DocuSignClient $client
	*/
	public function __construct(DocuSignClient $client) {
		parent::__construct($client);
		$this->status = new StatusResource($this);
	}
}
