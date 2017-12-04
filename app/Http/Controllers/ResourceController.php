<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ResourceController extends Controller {

  protected $model;
  protected $resources;
  protected $resource;
  protected $view_space;

  public function __construct(Model $model, $resources, $view_space = 'admin') {
    parent::__construct();

    $this->model = $model;
    $this->resources = $resources;
    $this->resource = strtolower(current(array_slice(explode('\\', get_class($this->model)), -1)));
    $this->view_space = $view_space;
  }

  public function index(Request $request) {
    ${$this->resources} = $this->model->orderBy('created_at', 'DESC')->paginate(10);

    return view($this->view_space . '.' . $this->resources . '.index', compact($this->resources));
  }

  public function create() {
    return view($this->view_space .'.'. $this->resources .'.create');
  }

  public function store(Request $request) {
    $fillable_data = array_only($request->all(), $this->model->getFillable());
    $this->{$this->resource} = $this->model->create($fillable_data);
    $this->saveFiles($request);

    return redirect(route($this->view_space .'.'. $this->resources .'.index'))
    ->with('success', trans('errors.messages.success'));
  }

  public function edit($id) {
    ${$this->resource} = $this->model->findOrFail($id);

    return view($this->view_space .'.'. $this->resources .'.edit', compact($this->resource));
  }

  public function update(Request $request, $id) {
    $this->{$this->resource} = $this->model->findOrFail($id);

    $fillable_data = array_only($request->all(), $this->model->getFillable());
    // Save the translated description
    $current_locale = app()->getLocale();
    app()->setLocale(getContentLanguage());
    $this->{$this->resource}->update($fillable_data);
    app()->setLocale($current_locale);
    $this->saveFiles($request);

    return redirect(route($this->view_space . '.' . $this->resources . '.index'))
    ->with('success', trans('errors.messages.success'));
  }

  public function show($id) {
    ${$this->resource} = $this->model->findOrFail($id);

    return view($this->view_space . '.' . $this->resources . '.show', compact($this->resource));
  }

  public function destroy($id) {
    $this->model->destroy($id);

    return redirect(route($this->view_space . '.' . $this->resources . '.index'))
    ->with('success', trans('errors.messages.success'));
  }

  protected function saveFiles(Request $request) {
    $files = $this->model->getFiles();

    foreach ($files as $file) {
      handleFileUpload($file, $this->{$this->resource}, $request, $file);
    }
  }

  public function order(Request $request) {
    ${$this->resources} = $this->model
    ->published()
    ->orderBy('weight', 'ASC')
    ->get();

    return view('admin.' . $this->resources . '.order')
    ->with($this->resources, ${$this->resources});
  }
}
