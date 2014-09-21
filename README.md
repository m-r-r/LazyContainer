Lazy Container
==============

Usage
-----

```php
require __DIR__ . '/vendor/autoload.php';

use LazyContainer\Container;

class Foo
{
    public $name;

    function __construct($name)
    {
        echo "Instance of Foo created with name \"$name\".\n";
    }
}

class Bar
{
    public $foo;
    function __construct(Container $c)
    {
        echo "Instance of Bar created.\n";
        $this->foo = $c->foo;
    }
}


class Baz
{
    public $foo;
    public $bar;

    function __construct(Container $c)
    {
        echo "Instance of Baz created.\n";
        $this->bar = $c->bar;
        $this->foo = $c->foo;
    }
}


$cont = new Container;

$cont->foo = function($self, $cfg) {
    return new Foo($self->fooName);
};

$cont->bar = function($self) {
    return new Bar($self);
};

$cont->baz = function($self) {
    return new Baz($self);
};

$cont->fooName = 'Quux';

// Later:
var_dump($cont->baz instanceOf Baz
         && $cont->baz->bar === $cont->bar
         && $cont->baz->foo === $cont->bar->foo);

```
This program would print:


    Instance of Baz created.
    Instance of Bar created.
    Instance of Foo created with name "Quux".
    bool(true)

