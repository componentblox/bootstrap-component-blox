<?php
/** Dependency-free contract checks, including legacy and missing plugin paths. */
$enabled = false; $filters = array(); $actions = array(); $enqueued = array(); $rendered = array();
function current_theme_supports($feature) { global $enabled; return $enabled && $feature === 'bcb-ui-v1'; }
function add_filter($name, $callback) { global $filters; $filters[$name] = $callback; }
function add_action($name, $callback, $priority = 10) { global $actions; $actions[$name] = $callback; }
function wp_get_theme($name) { return new class { function get($key) { return '2.9.0'; } }; }
function get_template() { return 'bootstrap-component-blox'; }
function get_template_directory_uri() { return '/parent'; }
function wp_enqueue_style(...$args) { global $enqueued; $enqueued[]=$args; }
function wp_enqueue_script(...$args) { global $enqueued; $enqueued[]=$args; }
function get_template_part(...$args) { global $rendered; $rendered[]=$args; }
function check($condition, $message) { if (!$condition) { fwrite(STDERR, $message . "\n"); exit(1); } }
require dirname(__DIR__) . '/inc/ui.php';
check($filters['body_class'](array('legacy')) === array('legacy'), 'Legacy classes changed');
$actions['wp_enqueue_scripts'](); check(!$enqueued, 'Legacy enqueues changed');
bcb_language_switcher(); check(!$rendered, 'Legacy language markup changed');
include dirname(__DIR__) . '/templates/post-confirmation.php';
check($rendered === array(array('template-parts/confirmation/confirmation', 'legacy')), 'Legacy template path changed');
$rendered = array(); $enabled = true;
bcb_language_switcher(); check(!$rendered, 'Missing plugin must emit nothing');
$actions['wp_enqueue_scripts'](); check(count($enqueued)===2, 'Expected shared CSS and JS');
check(in_array('bcb-ui-v1', $filters['body_class'](array()), true), 'Opt-in class absent');
eval('function trp_custom_language_switcher() { global $languages; return $languages; }');
$languages = array('en_US'=>array()); bcb_language_switcher(); check(!$rendered, 'One language must emit nothing');
$languages['es_ES']=array(); $TRP_LANGUAGE='es_ES'; bcb_language_switcher();
check(count($rendered)===1 && $rendered[0][2]['current']==='es_ES', 'Language adapter failed');
echo "UI opt-in, legacy template, plugin absence and language contracts passed\n";
