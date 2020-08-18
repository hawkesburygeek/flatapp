<?php

namespace Jade;

class Plugins {

	private static $plugins = array();
	private static $hooks = array();
	private static $plugin_count = 0;
	private static $hook_count = 0;

	public static $pluginInstance;

	static public function createInstance() {
		self::$pluginInstance = new \Jade\Plugins();
	}

	public function __construct() {
		$pluginDirectory = opendir(__PLUGIN_LOCATION);
		while (($filename = readdir($pluginDirectory)) !== FALSE) {
			if (stripos($filename, '.php') === FALSE || strcmp($filename, 'IPlugin.php') == 0) {
				continue;
			}

			$name = str_replace('.php', '', $filename);
			array_push(self::$plugins, array(
					'name' => $name,
					'filename' => $filename,
					'filepath' => __PLUGIN_LOCATION.$filename
				)
			);
			self::$plugin_count++;
			self::addHook($name, TRUE);
		}
	}

	static public function addHook($name, $activate) {
		$hooks = self::$hooks;
		$length = count($hooks);
		for ($i = 0; $i < $length; $i++) {
			if (in_array($name, $hooks[$i]) == TRUE) {
				if ($hooks[$i]['name'] !== $name) {
					continue;
				}
				self::$hooks[$i]['activate'] = 1;
				self::$hook_count++;
				return;
			}
		}

		array_push(self::$hooks, array(
				'name' => $name,
				'activate' => $activate
			)
		);
		self::$hook_count++;
	}

	static public function removeHook($name) {
		$hooks = self::$hooks;
		$length = count($hooks);
		$name = str_replace('.php', '', $name);
		for ($i = 0; $i < $length; $i++) {
			if ($hooks[$i]['name'] !== $name) {
				continue;
			}
			self::$hook_count--;
			self::$hooks[$i]['activate'] = 0;
		}
	}

	static public function runHooks($hook) {
		$plugins = self::$plugins;
		$hooks = self::$hooks;
		for ($i = 0; $i < count($hooks); $i++) {
			$plugin = self::getPlugin($hooks[$i]['name']);

			if ($hooks[$i]['activate'] == 0) {
				$hook_defunc = 'un_'.$hook;
				$func = is_callable(array($plugin, $hook_defunc));
				if (!$func) {
					$plugin->deactivate();
				} else {
					$plugin->$hook_defunc();
					continue;
				}
			}

			$plugin_hooks = count($plugin->setHooks());
			for ($i2 = 0; $i2 < $plugin_hooks; $i2++) {
				if (strcasecmp($plugin_hooks[$i2], $hook) != 0) {
					$continue;
				}
			}

			$hook_func = 'on_'.$hook;
			$func = is_callable(array($plugin, $hook_func));
			if (!$func) {
				$plugin->deactivate();
			} else {
				$plugin->$hook_func();
			}

		}
	}

	static public function getPlugin($name) {
		$plugins = self::$plugins;
		$plugin_count = count($plugins);
		for ($i = 0; $i < $plugin_count; $i++) {
			if ($plugins[$i]['name'] !== $name) {
				continue;
			}
			return new $plugins[$i]['name']();
		}
		return null;
	}

	static public function getPluginCount() {
		return self::$plugin_count;
	}

	static public function getHookCount() {
		return self::$hook_count;
	}

	static public function getPlugins() {
		return self::$plugins;
	}

	static public function getHooks() {
		return self::$hooks;
	}

}