<?php

include_once $CFG->dirroot.'/mod/customlabel/locallib.php';

$classes = customlabel_get_classes();
$roles = get_records_menu ('role', '', '', 'name', 'id,name') ;

$settings->add(new admin_setting_heading('storage', get_string('storage', 'customlabel'), ''));

$settings->add(new admin_setting_configcheckbox('usesafestorage', get_string('usesafestorage', 'customlabel'), get_string('configusesafestorage', 'customlabel'), 0));

$settings->add(new admin_setting_heading('regeneration', get_string('regeneration', 'customlabel'), "<a href=\"{$CFG->wwwroot}/mod/customlabel/admin_updateall.php\">".get_string('regenerate', 'customlabel')."</a>"));

$settings->add(new admin_setting_heading('classification', get_string('classification', 'customlabel'), "<a href=\"{$CFG->wwwroot}/mod/customlabel/adminmetadata.php\">".get_string('classification', 'customlabel')."</a>"));

$settings->add(new admin_setting_heading('roleaccesstoelements', get_string('roleaccesstoelements', 'customlabel'), ''));

foreach($classes as $class){
    $description = get_string('hiddenrolesfor', 'customlabel') . ' ' . get_string($class->id, 'customlabel');
    $parmname = "customlabel_{$class->id}_hiddenfor";
    $selection = split(',', @$CFG->$parmname);
    $settings->add (new admin_setting_configmultiselect("list_$parmname", "customlabel_{$class->id}_hiddenfor", $description, $selection, $roles));
}


