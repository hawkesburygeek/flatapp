<?php

namespace Jade;

interface IPlugin {
	
	public function setHooks();
	public function pluginInfo();
	public function deactivate();

}