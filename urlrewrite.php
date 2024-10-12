<?php
$arUrlRewrite=array (
  7 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'bitrix:catalog.section',
    'PATH' => '/local/templates/colorit/components/bitrix/catalog.element/detail_item/template.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/prod/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/prod/index.php',
    'SORT' => 100,
  ),
);
