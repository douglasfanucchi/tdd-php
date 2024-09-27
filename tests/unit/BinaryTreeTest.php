<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TDD\BinaryTree;
use TDD\BTNode;
use TDD\EmptyTreeException;
use TDD\TreeElementNotFoundException;

final class BinaryTreeTest extends TestCase
{
    protected BinaryTree $tree;

    protected function setUp(): void
    {
        $this->tree = new BinaryTree();
    }

    public function testShouldCreateEmptyBinaryTree()
    {
        $this->assertTrue($this->tree->isEmpty());
    }

    public function testShouldInsertElementIntoBinaryTree()
    {
        $this->tree->insert(1);

        $this->assertFalse($this->tree->isEmpty());
        $this->assertTrue($this->tree->hasElement(1));
    }

    public function testShouldnsertMultipleElementsIntoBinaryTree()
    {
        $this->tree->insert(2);
        $this->tree->insert(1);
        $this->tree->insert(3);
        $expected = new BTNode(2, new BTNode(1), new BTNode(3));

        $result = $this->tree->getNode(2);

        $this->assertTrue($this->tree->hasElement(2));
        $this->assertTrue($this->tree->hasElement(1));
        $this->assertTrue($this->tree->hasElement(3));
        $this->assertObjectEquals($expected, $result);
    }

    public function testShouldSearchForUnexistingElement()
    {
        $this->tree->insert(1);

        $result = $this->tree->hasElement(2);

        $this->assertFalse($result);
    }

    public function testShouldSearchForElementInAnEmptyTree()
    {
        $this->expectException(EmptyTreeException::class);
        $this->tree->hasElement(1);
    }

    public function testShouldDeleteAnElement()
    {
        $this->tree->insert(1);

        $this->tree->delete(1);

        $this->assertTrue($this->tree->isEmpty());
    }

    public function testShouldDeleteRootFromACompleteNodeBinaryTree()
    {
        $this->tree->insert(2);
        $this->tree->insert(1);
        $this->tree->insert(3);
        $expectedRoot = new BTNode(1, null, new BTNode(3));

        $this->tree->delete(2);
        $root = $this->tree->getNode(1);

        $this->assertFalse($this->tree->isEmpty());
        $this->assertObjectEquals($expectedRoot, $root);
    }

    public function testShouldDeleteUnexistingElement()
    {
        $this->tree->insert(1);

        $this->expectException(TreeElementNotFoundException::class);
        $this->tree->delete(2);
    }

    public function testShouldGetNodeFromTree()
    {
        $this->tree->insert(1);
        $expected = new BTNode(1);

        $node = $this->tree->getNode(1);

        $this->assertObjectEquals($expected, $node);
    }

    public function testShouldGetANonExistingNodeFromTree()
    {
        $this->tree->insert(1);
        
        $this->expectException(TreeElementNotFoundException::class);
        $this->tree->getNode(2);
    }

    public function testShouldGetNodeFromAnEmptyTree()
    {
        $this->expectException(EmptyTreeException::class);
        $this->tree->getNode(1);
    }
}
