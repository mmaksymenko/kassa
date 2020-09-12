<?php

declare(strict_types=1);

namespace Kassa;

class Node
{
    protected array $leaves = [];

    protected array $children = [];

    /**
     * Add the node to the end of the children array.
     */
    public function addChild(Node $node): self
    {
        array_push($this->children, $node);

        return $this;
    }

    /**
     * Add the leaf to the end of the leaves array.
     */
    public function addLeaf(Leaf $leaf): self
    {
        array_push($this->leaves, $leaf);

        return $this;
    }

    public function sort(int $w): void
    {
        if ($w <= 0) {
            throw new \LogicException('The weight must be greater than zero.', 400);
        }

        /* @var Node $child */
        // We go around the whole tree.
        foreach ($this->children as $child) {
            $child->sort($w);
        }

        Sort::usort($this->leaves, function (Leaf $leaf1, Leaf $leaf2) {
            return $leaf1->getValue() <=> $leaf2->getValue();
        });

        // Check the weight of the leaves.
        $this->balanceLeaves($w);
    }

    private function balanceLeaves(int $w): void
    {
        $sum = 0;
        /* @var Leaf $leaf */
        foreach ($this->leaves as $key => $leaf) {
            // If the sum is less than the weight,
            if ($sum < $w) {
                // add the current leaf weight to the sum and check again.
                $sum += $leaf->getValue();
                if ($sum <= $w) {
                    continue;
                }
            }

            // We are full then delete the leaf from this node,
            unset($this->leaves[$key]);
            // and if this node has children then add the leaf to the left child.
            if (!empty($this->children)) {
                $this->children[0]->addLeaf($leaf);
            }
        }
    }
}
