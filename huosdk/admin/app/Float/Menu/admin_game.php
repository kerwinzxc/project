<?php
return array (
  'app' => 'Admin',
  'model' => 'Game',
  'action' => 'default',
  'data' => '',
  'type' => '1',
  'status' => '1',
  'name' => '游戏管理',
  'icon' => '',
  'remark' => '',
  'listorder' => '0',
  'children' => 
  array (
    array (
      'app' => 'Admin',
      'model' => 'Game',
      'action' => 'versions',
      'data' => '',
      'type' => '1',
      'status' => '0',
      'name' => '游戏版本管理',
      'icon' => '',
      'remark' => '',
      'listorder' => '0',
      'children' => 
      array (
        array (
          'app' => 'Admin',
          'model' => 'Game',
          'action' => 'versionsList',
          'data' => '',
          'type' => '1',
          'status' => '1',
          'name' => '查询数据',
          'icon' => '',
          'remark' => '',
          'listorder' => '0',
        ),
        array (
          'app' => 'Admin',
          'model' => 'Game',
          'action' => 'gamenotice',
          'data' => '',
          'type' => '1',
          'status' => '1',
          'name' => '启动更新',
          'icon' => '',
          'remark' => '',
          'listorder' => '0',
        ),
        array (
          'app' => 'Admin',
          'model' => 'Game',
          'action' => 'cannotice',
          'data' => '',
          'type' => '1',
          'status' => '1',
          'name' => '取消自动更新',
          'icon' => '',
          'remark' => '',
          'listorder' => '0',
        ),
      ),
    ),
  ),
);