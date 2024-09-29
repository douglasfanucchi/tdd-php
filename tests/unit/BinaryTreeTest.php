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

    public function testShouldInsertMultipleElementsIntoBinaryTree()
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

    public function testShouldDeleteRootFromNonCompleteBinaryTreeThatHasRightSubtree()
    {
        $this->tree->insert(1);
        $this->tree->insert(2);
        $expectedRoot = new BTNode(2);

        $this->tree->delete(1);
        $root = $this->tree->getNode(2);

        $this->assertObjectEquals($expectedRoot, $root);
    }

    public function testDeleteElementFromASubtree()
    {
        $this->tree->insert(3);
        $this->tree->insert(4);
        $this->tree->insert(2);
        $this->tree->insert(0);
        $this->tree->insert(1);
        $expected = new BTNode(1);

        $this->tree->delete(0);

        $node = $this->tree->getNode(2);
        $this->assertEquals($expected, $node->left);
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

    public function testShouldTraverseBinaryTreeWithSingleNode()
    {
        $this->tree->insert(1);
        $expectedOrder = [1];
        
        $this->assertTraverse('inOrder', $expectedOrder);
    }

    public function testShouldTraverseACompleteBinaryTreeWith3Element()
    {
        $this->tree->insert(2);
        $this->tree->insert(1);
        $this->tree->insert(3);
        $expectedOrder = [1, 2, 3];

        $this->assertTraverse('inOrder', $expectedOrder);
    }

    public function testShouldTraverseABinaryTreeWithTwoElementsBeingTheSecondNodeTheLeftOne()
    {
        $this->tree->insert(2);
        $this->tree->insert(1);
        $expectedOrder = [1, 2];

        $this->assertTraverse('inOrder', $expectedOrder);
    }

    public function testShouldTraverseABinaryTreeWithTwoElementsBeingTheSecondNodeTheRightOne()
    {
        $this->tree->insert(2);
        $this->tree->insert(3);
        $expectedOrder = [2, 3];

        $this->assertTraverse('inOrder', $expectedOrder);
    }

    public function testShouldTraverseABinaryTreeWithSubtrees()
    {
        $this->tree->insert(3);
        $this->tree->insert(4);
        $this->tree->insert(2);
        $this->tree->insert(0);
        $this->tree->insert(1);
        $expectedOrder = [0, 1, 2, 3, 4];

        $this->assertTraverse('inOrder', $expectedOrder);
    }

    public function testShouldPreorderTraverseAnEmptyBinaryTree()
    {
        $this->expectException(EmptyTreeException::class);
        $this->assertTraverse('preOrder', []);
    }

    public function testShouldPreorderTraverseAOneNodeBinaryTree()
    {
        $this->tree->insert(1);
        $expectedOrder = [1];

        $this->assertTraverse('preOrder', $expectedOrder);
    }

    public function testShouldPreOrderTraverseABinaryTreeWithRootAndLeftNode()
    {
        $this->tree->insert(2);
        $this->tree->insert(1);
        $expectedOrder = [2, 1];

        $this->assertTraverse('preOrder', $expectedOrder);
    }

    public function testShouldPreorderTraverseABinaryTreeWithRootAndRightNode()
    {
        $this->tree->insert(2);
        $this->tree->insert(3);
        $expectedOrder = [2, 3];

        $this->assertTraverse('preOrder', $expectedOrder);
    }

    public function testShouldPreorderTraverseABinaryTreeWithSubtrees()
    {
        $this->tree->insert(3);
        $this->tree->insert(2);
        $this->tree->insert(4);
        $this->tree->insert(0);
        $this->tree->insert(1);
        $expectedOrder = [3, 2, 0, 1, 4];

        $this->assertTraverse('preOrder', $expectedOrder);
    }

    public function testShouldPostorderTraverseAnEmptyBinaryTree()
    {
        $this->expectException(EmptyTreeException::class);
        $this->assertTraverse('postOrder', []);
    }

    protected function assertTraverse(string $traverseOrder, array $expectedOrder)
    {
        $index = 0;
        $this->tree->$traverseOrder(function($element) use(&$index, $expectedOrder) {
            $this->assertEquals($expectedOrder[$index], $element);
            $index++;
        });
        $this->assertEquals(count($expectedOrder), $index);
    }
}
