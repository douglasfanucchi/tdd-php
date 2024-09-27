<?php

namespace TDD;

use Exception;

class BTNode {
    public $left, $right, $value;

    public function __construct(mixed $value, BTNode $left = null, BTNode $right = null)
    {
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
    }

    public function equals(BTNode $node) : bool
    {
        return $node->value == $this->value
                && $node->left == $this->left
                && $node->right == $this->right;
    }
}

class EmptyTreeException extends Exception
{}

class TreeElementNotFoundException extends Exception
{}

class BinaryTree
{
    protected mixed $root = null;

    public function isEmpty() : bool
    {
       return $this->root == null;
    }

    public function insert(mixed $element) : void
    {
        if ($this->isEmpty()) {
            $this->root = new BTNode($element);
            return;
        }
        $this->insertRecursive($element, $this->root);
    }

    protected function insertRecursive($element, BTNode &$root) {
        if ($element < $root->value) {
            if ($root->left == null) {
                $root->left = new BTNode($element);
                return;
            }
            return $this->insertRecursive($element, $root->left);
        }
        if ($root->right == null) {
            $root->right = new BTNode($element);
            return;
        }
        $this->insertRecursive($element, $root->right);
    }

    public function hasElement(mixed $element) : bool
    {
        try {
            $this->getNode($element);
            return true;
        } catch(TreeElementNotFoundException $e) {
            return false;
        }
    }

    public function delete(mixed $element) : void
    {
        if (!$this->hasElement($element)) {
            throw new TreeElementNotFoundException("element not found");
        }
        $this->root = null;
    }

    protected function search(mixed $element, BTNode|null $root) : BTNode
    {
        if (!$root) {
            throw new TreeElementNotFoundException("not found");
        }
        if ($element == $root->value) {
            return $root;
        }
        if ($element < $root->value) {
            return $this->search($element, $root->left);
        }
        return $this->search($element, $root->right);
    }

    public function getNode(mixed $element) : BTNode
    {
        if ($this->isEmpty()) {
            throw new EmptyTreeException("empty tree");
        }
        return $this->search($element, $this->root);
    }
}
