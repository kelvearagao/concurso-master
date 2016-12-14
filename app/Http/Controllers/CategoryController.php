<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\Question;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = [];
		foreach( Category::all() as $category )
		{
			$categories[] = (object) [
				'name' => $category->name,
				'amount' => $category->questions()->count()
			];
		}

		return view('category.index', [
			'categories' => $categories
		]);
	}
}