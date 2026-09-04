<?php

namespace App\View\Components;

use Illuminate\View\Component;
class AppLayout extends Component
{
	public $layout;
	public $breadcrumbs;
	public $title; // Remove after all localization refactor done

	public $action;
	public $module;

	public function __construct(
		string $layout = '',
		array $breadcrumbs = [],
		string $title = '',  // Remove after all localization refactor done
	) {
		$this->layout = $layout;
		$this->breadcrumbs = $breadcrumbs;
		$this->title = $title;
	}

	public function render()
	{
		return match ($this->layout) {
			'guest' => view('layouts.app'),
			default => view('layouts.main'),
		};
	}
}
