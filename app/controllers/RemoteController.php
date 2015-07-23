<?php

class RemoteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(['md5' => md5_file(app_path().'/views/reveal.blade.php')]);
	}

}
