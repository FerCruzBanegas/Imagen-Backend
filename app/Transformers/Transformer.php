<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

abstract class Transformer
{
    protected $resourceName = 'data';

    public function collection(Collection $data)
    {
        return [
            str_plural($this->resourceName) => $data->map([$this, 'transform'])
        ];
    }

    public function collection2(Collection $data)
    {
        return [
            str_plural($this->resourceName) => $data->map([$this, 'listTransform'])
        ];
    }

    public function collection3(Collection $data, $method)
    {
        return [
            str_plural($this->resourceName) => $data->map([$this, $method])
        ];
    }

    public function item($data)
    {
        return [
            $this->resourceName => $this->transform($data)
        ];
    }

    public function customItem($method, $data)
    {
        return [
            $this->resourceName => $this->{$method}($data)
        ];
    }

    public abstract function transform($data);
}