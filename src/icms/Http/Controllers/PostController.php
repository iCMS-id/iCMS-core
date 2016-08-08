<?php
namespace ICMS\Http\Controllers;

class PostController extends Controller {
	public function index()
	{
		return view('admin.post.index');
	}
}