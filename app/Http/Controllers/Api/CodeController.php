<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class CodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

	/**
	 * Gets multiple code information, to display/download them.
	 * @return array [JSON with multiple code information]
	 */
	public function getCodes($user_id = null) {

		if ($user_id !== null) {
			$codes = File::where('user_id' , $user_id)->where('type', 'code')->where('public', true)->get();
		} else {
			$codes = File::where('type', 'code')->where('public', true)->get();
		}

		$codeInfos = array();
		foreach ($codes as $codes => $codes) {
			$info = array(
				'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $code->id,
				'id' => $code->id,
				'name' => $code->name,
				);
			array_push($codeInfos, $info);
		}
		return $codeInfos;
	}

	/**
	 * Gets a single Files information of type code, to display/download them.
	 * @param  File   $file [Should be type code]
	 * @return array [JSON with single code information]
	 */
    public function getCode(File $file) {

    	if ($file->type === 'code') {

    		$code = $file;

    		$codeInfo = array(
    			'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $code->id,
    			'id' => $code->id,
    			'name' => $code->name,
			);
				
    		return $codeInfo;
    	} else {
    		return []; //if not type code
    	}
    }
}
