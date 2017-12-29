<?php

namespace ModularityChecklist;

class Module extends \Modularity\Module
{
    public $slug = 'checklist';
    public $supports = array('editor');

    public function init()
    {
        $this->nameSingular = __('Checklist', 'modularity-checklist');
        $this->namePlural = __('Checklists', 'modularity-checklist');
        $this->description = __('Outputs a checklist', 'modularity-checklist');
    }

    public function data() : array
    {
        $data = get_fields($this->ID);
        $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', array('box', 'box-panel'), $this->post_type, $this->args));
        return $data;
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}