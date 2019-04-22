<?php

/**
 * @Author: xml
 * @Date:   2019-04-22 16:47:24
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 16:49:14
 */

namespace src\Service;

class Services
{
	public function __construct()
	{

	}

	public function getDetail($id)
	{
		return [
			'id' => $id,
			'name' => "jack",
			"age" => 18,
			'sex' => "F",
			"email" => "jack@gmail.com"
		];
	}
}
