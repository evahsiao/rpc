<?php

/**
 * @Author: xml
 * @Date:   2019-03-30 17:30:10
 * @Last Modified by:   xml
 * @Last Modified time: 2019-04-22 11:16:04
 * Desc: 服务端提供的具体服务实现
 */

namespace src\TestUnit;

public class ServerTest{

	public function detail($id)
	{
		$data = [
			'id' => $id
			'username' => 'july',
			'age' => 16,
			'sex' => 'F',
		];
		return $data;
	}

	public function list()
	{
		$data = [
			[
				'username' => 'july',
				'age' => 16,
				'sex' => 'F',
			],
			[
				'username' => 'Jack',
				'age' => 15,
				'sex' => 'M',
			]
		];
		return $data;
	}
}
