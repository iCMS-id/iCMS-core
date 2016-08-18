<?php
namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller {
	public function index()
	{
		return view('admin.post.index');
	}

	public function ajax(Request $request)
	{
		$search = $request->search;
		$data = [];

		if ($search == '') {
			$result = $this->posts;
		} else {
			$result = array_filter($this->posts, function ($value, $key) use ($search) {
				return stripos($key, $search);
			}, ARRAY_FILTER_USE_BOTH);
		}

		foreach ($result as $key => $value) {
			$data['results'][] = ['id' => $value, 'text' => $key];
		}

		return response()->json($data);
	}

	protected $posts = [
		'First post' => 'value1',
		'Second post' => 'value1',
		'Last post' => 'value1',
		'Memories' => 'value1',
		'Fish' => 'value1',
		'Key' => 'value1',
		'Data management' => 'value1',
	];
}