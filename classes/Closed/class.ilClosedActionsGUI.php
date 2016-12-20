<?php

use \CaT\Plugins\AutomaticUserAdministration\Closed;

class ilClosedActionsGUI
{
	const CMD_CLOSED_ACTIONS = "closedActions";

	/**
	 * @var \ilCtrl
	 */
	protected $gCtrl;

	/**
	 * @var \ilTemplate
	 */
	protected $gTpl;

	/**
	 * @var \CaT\Plugins\AutomaticUserAdministration\ilActions
	 */
	protected $actions;

	/**
	 * @var \ilAutomaticUserAdministrationr
	 */
	protected $parent_object;

	/**
	 * @var \ilAutomaticUserAdministrationPlugin
	 */
	protected $plugin_object;

	public function __construct(\ilAutomaticUserAdministrationConfigGUI $parent_object, \ilAutomaticUserAdministrationPlugin $plugin_object, \CaT\Plugins\AutomaticUserAdministration\ilActions $actions)
	{
		global $ilCtrl, $tpl;

		$this->gCtrl = $ilCtrl;
		$this->gTpl = $tpl;

		$this->parent_object = $parent_object;
		$this->plugin_object = $plugin_object;
		$this->actions = $actions;
	}

	public function executeCommand()
	{
		$cmd = $this->gCtrl->getCmd(self::CMD_CLOSED_ACTIONS);

		switch ($cmd) {
			case self::CMD_CLOSED_ACTIONS:
				$this->$cmd();
				break;
			default:
				throw new \Exception(__METHOD__.": unkown command ".$cmd);
		}
	}

	/**
	 * Show open actions
	 *
	 * @return null
	 */
	protected function closedActions()
	{
		$table = new Closed\ilClosedActionsTableGUI($this, $this->plugin_object);
		$table->setData($this->actions->getOpenActions());
		$this->gTpl->setContent($table->getHtml());
	}
}