<?php

namespace Shiran\EasyExMail;


class EasyExMail
{
    protected $config;
    protected $factory;

    public function __construct(array $config)
    {
        $this->factory = new Factory();
        $this->config = $config;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        return $this->factory::make($name, $this->config);
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __get($name)
    {
        return $this->factory::make($name, $this->config);
    }
}