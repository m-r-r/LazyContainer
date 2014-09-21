<?php
namespace LazyContainer;

class Container
{
    private $callbacks = array();
    private $data = null;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function __set($attr, $value)
    {
        if (is_callable($value)) {
            $this->callbacks[$attr] = $value;
        }
        else {
            $this->$attr = $value;
        }
    }

    public function __get($attr)
    {
        if (null === ($v = &$this->$attr)) {
            return ($v = call_user_func($this->callbacks[$attr], $this, $this->data));
        }
    }
}
