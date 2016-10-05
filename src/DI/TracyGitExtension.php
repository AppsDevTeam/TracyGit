<?php

namespace ADT\TracyGit\DI;


use Nette;

class TracyGitExtension extends \Nette\DI\CompilerExtension {

	const PROVIDER_JSON = 'json';
	const PROVIDERS = [
		self::PROVIDER_JSON
	];

	public function loadConfiguration() {
		$config = $this->getConfig();

		if (empty($config['provider'])) {
			throw new TracyGitException('Provider not specified');
		}

		$provider = $config['provider'];
		if (!in_array($provider, static::PROVIDERS, TRUE)) {
			throw new TracyGitException('Unknown provider specified');
		}

		switch ($provider) {
			case static::PROVIDER_JSON:
				if (empty($config['file'])) {
					throw new TracyGitException('JSON provider must have file specified');
				}
				break;
		}
	}

	public function afterCompile(Nette\PhpGenerator\ClassType $class) {
		$initMethod = $class->methods['initialize'];
		$initMethod->addBody('$this->getService(?)->addPanel(new ' . \ADT\TracyGit\GitPanel::class . '(?));', [ 'tracy.bar', $this->config ]);
	}


}

class TracyGitException extends \Nette\InvalidStateException { }