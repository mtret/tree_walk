<?php
//data structure representation 
$menu = [
    ['id' => 0, 'name' => '', 'parent_id' => null],
    ['id' => 1, 'name' => '', 'parent_id' => 0],
    ['id' => 2, 'name' => '', 'parent_id' => 0],
    ['id' => 3, 'name' => '', 'parent_id' => 1],
    ['id' => 4, 'name' => '', 'parent_id' => 1],
    ['id' => 5, 'name' => '', 'parent_id' => 1],
    ['id' => 6, 'name' => '', 'parent_id' => 3],
    ['id' => 7, 'name' => '', 'parent_id' => 5],
];

const TAB_SIZE = 4;

//indexing -> make it accessible by key
function buildTree($menu) {
    $tree = [];
    foreach ($menu as $item) {
        $tree[$item['parent_id']][] = $item;
    }

    // sort the level to be safe
    foreach ($tree as $parentId => &$children) {
        usort($children, function($a, $b) {
            return $a['id'] <=> $b['id'];
        });
    }

    return $tree;
}

// recursive traversal
function printTree($tree, $parentId = null, $indent = 0) {
if (isset($tree[$parentId])) {
        foreach ($tree[$parentId] as $item) {
            echo str_repeat(' ', $indent * TAB_SIZE) . $item['id'] . PHP_EOL;
            printTree($tree, $item['id'], $indent + 1);
        }
    }
}

$tree = buildTree($menu);
printTree($tree);
