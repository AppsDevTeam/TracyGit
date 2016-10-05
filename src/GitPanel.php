<?php

namespace ADT\TracyGit;

class GitPanel implements \Tracy\IBarPanel {

	protected $gitInfo;

	public function __construct($config) {
		$this->gitInfo = $this->getGitInfo($config);
	}

	public function getTab() {
		return $this->renderTemplate('tab');
	}

	public function getPanel() {
		return $this->renderTemplate('panel');
	}

	private function renderTemplate($__templateName) {
		ob_start(function () {
		});
		require __DIR__ . '/templates/' . $__templateName . '.phtml';
		return ob_get_clean();
	}

	private function getGitInfo($config) {
		switch ($config['provider']) {
			case DI\TracyGitExtension::PROVIDER_JSON:
				return file_exists($config['file'])
					? \Nette\Utils\Json::decode(file_get_contents($config['file']))
					: NULL;

			default:
				throw new DI\TracyGitException('Unknown provider specified');
		}
	}
}
