<?php

namespace Taskforcedev\CrudApi\Helpers;

/**
 * Class Field
 *
 * @package Taskforcedev\CrudApi\Helpers
 */
class Field
{
    public $crudApi;

    /**
     * Field constructor.
     *
     * @param CrudApi $crudApi
     */
    public function __construct(CrudApi $crudApi)
    {
        $this->crudApi = $crudApi;
    }

    public function isIdField($field)
    {
        return strpos($field, '_id') === false ? false : true;
    }
}