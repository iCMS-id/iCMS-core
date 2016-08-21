<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Models\Menu;
use ICMS\Http\Requests;

class PageController extends Controller
{
	public function index(Request $request)
	{
		$menu = Menu::find($request->root_id?:2);

		return view('admin.page.index', ['menu' => $menu]);
	}

	public function save(Request $request)
	{
		$root = Menu::find($request->root_id?:2);
		$menu = new Menu;

		switch ($request->type) {
			case 'external':
				$menu->name = $request->name;
				$menu->type = 'url';
				$menu->url = $request->external;
				$menu->target = $request->has('newtab')?'blank':'self';
				$menu->save();
				break;
			case 'empty':
				$menu->name = $request->name;
				$menu->save();
				break;
		}

		$menu->makeChildOf($root);

		return redirect()->to(resolveRoute('admin.page', ['root_id' => $root->id]));
	}

	public function move(Request $request)
	{
		$menu = Menu::find($request->id);
		$move = $request->move;

		if ($menu) {
			if ($move == 'up') {
				$menu->moveLeft();
			} else {
				$menu->moveRight();
			}

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}

	public function ajax(Request $request)
	{
		$rootid = $request->root_id?:2;
		$link = resolveRoute('admin.page') . '?root_id=';
		$data = ['total' => 0, 'data' => []];
		$menu = Menu::find($rootid);

		if ($menu->isChild()) {
			$root = $menu->getRoot();
			$data['data'][] = [
				'menu' => '<a href="'.$link.$root->id.'"><i class="fa fa-arrow-circle-up"></i> Up</a>',
				'action' => ''
			];
		}

		if ($menu) {
			$child = $menu->getDescendants(1);
			$data['total'] = $child->count();
			$child = $child->splice($request->start, $request->length);

			foreach ($child as $key => $value) {
				$menu = '<a href="'.$link.$value->id.'">'.$value->name.'</a>';
				$order = '';
				$action = '';

				if ($key > 0) {
					$order .= '<a class="btn btn-info btn-xs menu up" data-id="'.$value->id.'"><i class="fa fa-arrow-circle-up"></i></a> ';
				} else {
					$order .= '<a class="btn btn-info btn-xs menu up disabled"><i class="fa fa-arrow-circle-up"></i></a> ';
				}

				if ($key < $child->count() - 1) {
					$order .= '<a class="btn btn-info btn-xs menu down" data-id="'.$value->id.'"><i class="fa fa-arrow-circle-down"></i></a> ';
				} else {
					$order .= '<a class="btn btn-info btn-xs menu down disabled"><i class="fa fa-arrow-circle-down"></i></a> ';
				}

				if ($value->isLeaf()) {
					$action .= '<a class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a> ';
					$action .= '<a class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a> ';
				}

				$data['data'][] = [
					'menu' => $menu,
					'order' => $order,
					'action' => $action,
					'key' => $key,
				];
			}
		}

		return response()->json($data);
	}
}
