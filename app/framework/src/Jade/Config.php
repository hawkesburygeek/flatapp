<?php

namespace Jade;

class Config {
	

	static public function get($configDirective, $default = NULL) {
		$configDirective = explode('.', $configDirective);
		if (count($configDirective) == 0) {
			return $default;
		} else {
			if (count($configDirective) == 1) {
				return $default;
			} else {
				if (file_exists(__CONFIG_LOCATION.$configDirective[0].'.php') && is_readable(__CONFIG_LOCATION.$configDirective[0].'.php')) {
					$configValues = include __CONFIG_LOCATION.$configDirective[0].'.php';
					if (isset($configValues[$configDirective[1]])) {
						return $configValues[$configDirective[1]];
					} else {
						return $default;
					}
				}
			}
		}
	}

}
