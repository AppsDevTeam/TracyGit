<?php

namespace ADT\TracyGit;

class Git {

	protected $config;

	public function __construct($config) {
		$this->config = $config;
	}

	public function getInfo() {
		switch ($this->config['provider']) {
			case DI\TracyGitExtension::PROVIDER_JSON:
				return file_exists($this->config['file'])
					? \Nette\Utils\Json::decode(file_get_contents($this->config['file']))
					: NULL;

			default:
				throw new DI\TracyGitException('Unknown provider specified');
		}
	}

}
