<?php

namespace Taskforcedev\CrudAPI\Http\Controllers;

use Illuminate\Http\Request;
use Taskforcedev\CrudAPI\Models\CrudModel;

class ApiController extends Controller
{
    private $namespace;

    public function __construct()
    {
        $this->namespace = $this->getModelNamespace();
    }

    public function index($model)
    {
        $model = $this->getModel($model);
        
        try {
            $results = $model->all();
            return $results;
        } catch (Exception $e) {
            return response($e->getMessage, 500);
        }
    }

    public function show($model, $id)
    {
        $model = $this->getModel($model);
        try {
            $model->where('id', $id)->firstOrFail();
        } catch (Exception $e) {
            return response('Not Found.', 404);
        }
    }

    public function store($model)
    {
        // TODO
        $model = $this->getModel($model);

        /* Validate Model data */
        if (!method_exists($model, 'validate')) {
            return response('Unable to validate model data', 400);
        }

        $data = Request::all();

        /* Ensure data is valid */
        $valid = $model->validate($data);
        if (!$valid) { return response('Model data is invalid', 400); }

        /* Create the item */
        $model->create($data);
    }

    public function create($model)
    {
        $model = $this->getModel($model);
    }

    private function qualify($model)
    {
        return $this->namespace . '\\' . $model;
    }

    private function getModel($model)
    {
        $model = $this->qualify($model);
        return new $model;
    }
}
