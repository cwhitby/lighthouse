<?php

namespace Nuwave\Relay\Tests\Schema\Generators;

use Nuwave\Relay\Tests\TestCase;
use Nuwave\Relay\Tests\Support\GraphQL\Types\UserType;

class EdgeTypeGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGenerateEdgeType()
    {
        app('graphql')->schema()->type('user', UserType::class);

        $edge = app('graphql')->schema()->edgeInstance('user', UserType::class);
        $this->assertEquals('UserEdge', $edge->name);
        $this->assertContains('node', array_keys($edge->config['fields']));
        $this->assertContains('cursor', array_keys($edge->config['fields']));
        $this->assertSame($edge, app('graphql')->edge('user'));
    }
}