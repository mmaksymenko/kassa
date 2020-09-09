<?php

declare(strict_types=1);

namespace Tests\Kassa;

use Kassa\Leaf;
use Kassa\Node;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testTaskTree()
    {
        $expectedTree =
            (new Node())
                ->addLeaf(new Leaf(2))
                ->addLeaf(new Leaf(4))
                ->addLeaf(new Leaf(3))
                ->addLeaf(new Leaf(1))
                ->addChild(new Node())
                ->addChild(new Node())
                ->addChild(new Node());
        $expectedTree->sort(3);

        $actualTree =
            (new Node())
                ->addLeaf(new Leaf(1))
                ->addLeaf(new Leaf(2))
                ->addChild(
                    (new Node())
                        ->addLeaf(new Leaf(3))
                        ->addLeaf(new Leaf(4))
                )
                ->addChild(new Node())
                ->addChild(new Node());

        $this->assertEquals($expectedTree, $actualTree);
    }

    public function testRandomTree()
    {
        $expectedTree =
            (new Node())
                ->addLeaf(new Leaf(2))
                ->addLeaf(new Leaf(4))
                ->addLeaf(new Leaf(3))
                ->addLeaf(new Leaf(1))
                ->addChild(new Node())
                ->addChild(
                    (new Node())
                        ->addChild(new Node())
                        ->addLeaf(new Leaf(9))
                        ->addLeaf(new Leaf(2))
                        ->addLeaf(new Leaf(1))
                )
                ->addChild(
                    (new Node())
                        ->addLeaf(new Leaf(9))
                        ->addLeaf(new Leaf(8))
                );
        $expectedTree->sort(6);

        $actualTree =
            (new Node())
                ->addLeaf(new Leaf(1))
                ->addLeaf(new Leaf(2))
                ->addLeaf(new Leaf(3))
                ->addChild(
                    (new Node())
                        ->addLeaf(new Leaf(4))
                )
                ->addChild(
                    (new Node())
                        ->addChild(
                            (new Node())
                                ->addLeaf(new Leaf(9))
                        )
                        ->addLeaf(new Leaf(1))
                        ->addLeaf(new Leaf(2))
                )
                ->addChild(new Node());

        $this->assertEquals($expectedTree, $actualTree);
    }

    public function testWrongLeafWeight(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionCode(400);
        (new Node())
            ->addLeaf(new Leaf(-2))
            ->addChild(new Node());
    }

    public function testWrongTreeWeight(): void
    {
        $tree =
            (new Node())
                ->addLeaf(new Leaf(2))
                ->addLeaf(new Leaf(4))
                ->addChild(new Node());
        $this->expectException(\LogicException::class);
        $this->expectExceptionCode(400);
        $tree->sort(-2);
    }
}
