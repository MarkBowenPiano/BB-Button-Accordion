<?php

add_filter('fl_builder_register_settings_form', 'zestsms_extend_settings_button', 10, 2);
function zestsms_extend_settings_button( $form, $id ) {
    if($id == 'button') {
	    $new_settings = array(
	    	'general'   => array(
	    	    'sections'  => array(
	    	    	'general'   => array(
	    	    		'fields'    => array(
	    	    			'click_action'  => array(
	    	    				'options'   => array(
	    	    					'collapse'  => __('Collapse', 'zestsms')
						        ),
					            'toggle'    => array(
					            	'collapse'  => array(
					            		'sections'  => array('collapse')
						            )
					            ),
						        'preview'       => array(
							        'type'          => 'none'
						        )
					        )
				        )
			        ),
		            'collapse'  => array(
		            	'title' => __('Collapse', 'zestsms'),
		                'fields'    => array(
		                	'collapse'  => array(
		                		'type'  => 'select',
			                    'label' => __('Collapse', 'zestsms'),
			                    'default'   => 'module',
			                    'options'   => array(
			                    	'module'    => __('Next Module', 'zestsms'),
			                        'column'    => __('Entire Column', 'zestsms')
			                    ),
				                'preview'       => array(
					                'type'          => 'none'
				                )
			                )
		                )
		            )
		        )
		    )
	    );

	    $form = array_merge_recursive( $form, $new_settings );
    }

    return $form;
}

add_filter('fl_builder_module_custom_class', 'zestsms_add_class_button', 10, 2);
function zestsms_add_class_button($classes, $module) {
	if($module->slug == 'button') {
		if($module->settings->click_action == 'collapse') {
			$classes .= ' button-has-collapse collapse-button-'. $module->settings->collapse;
		}
	}

	return $classes;
}