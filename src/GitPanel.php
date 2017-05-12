<?php

namespace ADT\TracyGit;

class GitPanel implements \Tracy\IBarPanel {

	protected $gitInfo;

	public function __construct(Git $git) {
		$this->gitInfo = $git->getInfo();
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

}
