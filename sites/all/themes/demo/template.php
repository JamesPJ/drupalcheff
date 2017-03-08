<?php
/**
 * Variables preprocess function for the "page" theming hook.
 */
function demo_preprocess_page(&$vars) {
   global $user;

  // Do we have a node?
  if (isset($vars['node'])) {
    
    // Ref suggestions cuz it's stupid long.
    $suggests = &$vars['theme_hook_suggestions'];

    // Get path arguments.
    $args = arg();
    // Remove first argument of "node".
    unset($args[0]);
    
    if (!empty($user->roles)) {
    foreach ($user->roles as $role) {
      $filter = '![^abcdefghijklmnopqrstuvwxyz0-9-_]+!s';
      $string_clean = preg_replace($filter, '-', drupal_strtolower($role));
      
      
    // Set type and role.
    $type = "page__type_{$vars['node']->type}__{$string_clean}";
      
    // Bring it all together.
    $suggests = array_merge(
      $suggests,
      array($type),
      theme_get_suggestions($args, $type)
    );

      // looks for page--[role].tpl.php in your theme directory
      // ex: page--administrator.tpl.php
      $variables['theme_hook_suggestions'][] =  'page__' . $string_clean;
      
      // if the url is: 'http://domain.com/node/123/edit'
      // and node type is 'blog'..
      // 
      // This will be the suggestions:
      //
      // - page__node__administrator
      // - page__node__administrator__%
      // - page__node__administrator__123
      // - page__node__administrator__edit
      // - page__type_blog__administrator
      // - page__type_blog__administrator__%
      // - page__type_blog__administrator__123
      // - page__type_blog__administrator__edit
      // 
      // Which connects to these templates:
      //
      // - page--node--administrator.tpl.php
      // - page--node---administrator-%.tpl.php
      // - page--node--administrator--123.tpl.php
      // - page--node--administrator--edit.tpl.php
      // - page--type-blog--administrator.tpl.php  
      // - page--type-blog--administrator--%.tpl.php
      // - page--type-blog--administrator--123.tpl.php
      // - page--type-blog--administrator--edit.tpl.php

      //And similarly other roles
    }
  }    
    
    // Set type.
    $type = "page__type_{$vars['node']->type}";

    // Bring it all together.
    $suggests = array_merge(
      $suggests,
      array($type),
      theme_get_suggestions($args, $type)
    );

    // - page__node
    // - page__node__%
    // - page__node__123
    // - page__node__edit
    // - page__type_blog
    // - page__type_blog__%
    // - page__type_blog__123
    // - page__type_blog__edit
    // 
    // Which connects to these templates:
    //
    // - page--node.tpl.php
    // - page--node--%.tpl.php
    // - page--node--123.tpl.php
    // - page--node--edit.tpl.php
    // - page--type-blog.tpl.php  
    // - page--type-blog--%.tpl.php
    // - page--type-blog--123.tpl.php
    // - page--type-blog--edit.tpl.php
    // 
    // Latter items take precedence.
    //dpm($suggests);
  }
}