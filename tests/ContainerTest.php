<?php

namespace Tests;

use StdClass;
use System\Container\Container;
use PHPUnit\Framework\TestCase;
use System\Container\ContainerException;

class ContainerTest extends TestCase
{
    public function testGetObject()
    {
        self::assertInstanceOf(MyClassStd::class, Container::get(MyClassStd::class));
    }

    public function testSet()
    {
        $class = new MyClassStd;
        Container::set('std', $class);
        self::assertEquals($class, Container::get('std'));
        Container::set('std', $class);
        self::assertEquals($class, Container::get('std'));
    }

    public function testNotExistsClassInContainer()
    {
        $this->expectException(ContainerException::class);
        Container::get('NotExists');
    }

    public function testSetClosure()
    {
        Container::set('closure', function () {
            return new MyClassStd;
        });

        self::assertInstanceOf(MyClassStd::class, Container::get('closure'));
    }

    public function testResolveDependencies()
    {
        $baz = Container::get(Baz::class);
        self::assertInstanceOf(Baz::class, $baz);
    }

    public function testExceptionUnableToInstance()
    {
        $this->expectException(ContainerException::class);
        $instance = Container::get(Privat::class);
    }

    public function testExceptionUnableToInstanceInstance()
    {
        $this->expectException(ContainerException::class);
        $instance = Container::get(InstancePrivate::class);
    }

    public function testEqualsContainerClasses()
    {
        Container::set('foo', function () {
            return new Foo();
        });

        $foo = Container::get('foo');

        self::assertSame($foo, Container::get('foo'));
    }

    public function testConstructWithDefaultValue()
    {
        $default = Container::get(DefaultValue::class);

        self::assertSame($default->d, 'default');
    }
}

class MyClassStd extends StdClass {}
class Foo {}
class DefaultValue{ public $d; public function __construct($d = 'default'){$this->d=$d;}}
class Bar { public function __construct(Foo $foo) {} }
class Baz { public function __construct(Bar $bar) {} }

class Privat { private function __construct() {} }
class InstancePrivate { public function __construct(Privat $privat) {} }