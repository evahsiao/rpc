<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 14:46:12
 * @Last Modified by:   xml
 * @Last Modified time: 2019-03-30 14:47:14
 */

namespace src\Rpc;

class Test {
	public function hehe()
	{
		return 'lllllll';
	}

	public function hehe2($params)
	{
		return json_encode($params);
	}
}