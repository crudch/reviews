<?php

namespace Tests;

use System\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @var Request $request
     */
    protected Request $request;

    protected function setUp(): void
    {
        $_GET = ['test' => 'get', 'int' => '1'];
        $_POST = ['test' => 'post', 'int' => '1'];
        $_COOKIE = ['foo' => 'bar'];
        $_SERVER['REQUEST_URI'] = '/index/page?g=1&test2';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REMOTE_ADDR'] = '192.30.253.113';
        $this->request = new Request();
    }

    protected function tearDown(): void
    {
        $_GET = $_POST = [];
    }

    public function testGet()
    {
        self::assertSame($_GET, $this->request->get());
        self::assertSame(['test' => 'post', 'int' => '1'], $this->request->all());
        self::assertSame(['test' => 'get', 'int' => '1'], $this->request->get(['test', 'int']));
        self::assertSame(['test' => 'get'], $this->request->get(['test']));

        self::assertNull($this->request->get('any'));
    }

    public function testPost()
    {
        self::assertSame($_POST, $this->request->post());
        self::assertSame(['test' => 'post', 'int' => '1', 'any' => null], $this->request->post(['test','int','any']));
        self::assertSame([], $this->request->except(['test','int','any']));
        self::assertSame(['int' => '1'], $this->request->except(['test','any']));
        self::assertNull($this->request->post('any'));
    }

    public function testInput()
    {
        self::assertSame(['test' => 'post', 'int' => '1'], $this->request->input());
        self::assertSame(['test' => 'post', 'int' => '1', 'any' => null], $this->request->input(['test','int','any']));
        self::assertNull($this->request->input('any'));
    }

    public function testGetNative()
    {
        $this->request->foo = 'test';
        self::assertSame('test', $this->request->get('foo'));
        self::assertSame('test', $this->request->input('foo'));
        self::assertEquals('test', $this->request->foo);
    }

    public function testSet()
    {
        $this->request->setAttributes('book','123');
        self::assertEquals('123', $this->request->book);
    }

    public function testDeleteAttribute()
    {
        $this->request->deleteAttribute('test');
        self::assertEquals(null, $this->request->input('test'));
        $this->request->deleteAttribute('int', ['get', 'post']);
        self::assertEquals([], $this->request->input());
    }

    public function testSetAttributes()
    {
        $this->request->setAttributes([
            1      => 'test',
            'id'   => 2,
            'name' => 'Vasya',
            '5'    => 'string 5'
        ]);

        self::assertSame(['test' => 'get', 'int' => '1', 'id' => 2, 'name' => 'Vasya'], $this->request->get());
    }

    public function testIsset()
    {
        self::assertTrue(isset($this->request->test));
        self::assertFalse(isset($this->request->f));
    }

    public function testCookie()
    {
        self::assertEquals('bar', $this->request->cookie('foo'));
        self::assertEquals(['foo' => 'bar'], $this->request->cookie(['foo']));
    }

    public function testHeaders()
    {
        self::assertEquals('XMLHttpRequest', $this->request->headers('X_REQUESTED_WITH'));
        self::assertEquals('XMLHttpRequest', $this->request->headers('X-REQUESTED-WITH'));
        self::assertEquals('XMLHttpRequest', $this->request->headers('x-requested-with'));
        self::assertNull($this->request->headers('fix'));
    }

    public function testUri()
    {
        self::assertEquals('index/page', $this->request->uri());
    }

    public function testType()
    {
        self::assertEquals('POST', $this->request->type());
    }

    public function testIsAjax()
    {
        self::assertTrue($this->request->ajax());
    }

    public function testGetClientIp()
    {
        self::assertEquals('192.30.253.113', $this->request->clientIp());
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        self::assertFalse($this->request->clientIp());
    }

    public function testGetClientIp2long()
    {
        self::assertEquals(3223256433, $this->request->clientIp2long());
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        self::assertEquals(0, $this->request->clientIp2long());
    }
    
    public function testFile()
    {
        self::assertFalse($this->request->hasFile('foo'));
        self::assertNull($this->request->file('foo'));
    }
}
