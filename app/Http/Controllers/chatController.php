<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatController extends Controller {
	public function index() {
		$data['session_id'] = 'SMARTWORK_DEMO_'.time();
		$data['flow_name'] = 'Wexplore_Smartworking_Demo';
    	return view('smartworking_chat', $data);
	}

	public function iframe() {
		$data['session_id'] = 'SMARTWORK_DEMO_'.time();
		$data['flow_name'] = 'Wexplore_Smartworking_Demo';
		return view('smartworking_iframe', $data);
	}
}
