<?php

namespace Statamic\Extend;

use Illuminate\Support\Collection;

abstract class Filter extends Addon implements FilterInterface
{
    use HasParameters;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $context;

    /**
     * @param \Illuminate\Support\Collection $collection
     * @param array                          $context
     * @param array                          $parameters
     */
    public function __construct(Collection $collection, array $context = [], array $parameters = [])
    {
        parent::__construct();

        $this->collection = $collection;
        $this->context = $context;
        $this->parameters = $parameters;
    }
}
