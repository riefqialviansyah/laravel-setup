<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function test_dependencyInjection()
    {
        self::markTestSkipped("Tes case ini jalan kalau belum make providers");
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function test_bind()
    {
        $this->app->bind(Person::class, function($app){
            return new Person("Riefqi", "Alviansyah");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Riefqi", $person1->firstName);
        self::assertEquals("Riefqi", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function test_singleton()
    {
        $this->app->singleton(Person::class, function($app){
            return new Person("Dwi", "Alviansyah");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Dwi", $person1->firstName);
        self::assertEquals("Dwi", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function test_instance()
    {
        $person = new Person("Riefqi", "Alviansyah");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Riefqi", $person1->firstName);
        self::assertEquals("Riefqi", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function test_dependencyInjection2()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertEquals("Foo and Bar", $bar->bar());
        self::assertSame($foo, $bar->foo);
    }

    public function test_dependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);
    }

}
