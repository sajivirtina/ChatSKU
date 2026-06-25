<?php
/**
 * ACF field group for the `industry` post type.
 *
 * Fields:
 *  - industry_description  — card description text
 *  - industry_cta_links    — repeater of CTA links (label + url)
 *
 * The card image uses the post's featured thumbnail (no separate ACF image field).
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'      => 'group_chatsku_industry',
	'title'    => 'Industry Content',
	'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'industry' ] ] ],
	'position' => 'normal',
	'style'    => 'default',
	'active'   => true,
	'fields'   => [

		[
			'key'          => 'field_ind_description',
			'label'        => 'Description',
			'name'         => 'industry_description',
			'type'         => 'textarea',
			'rows'         => 3,
			'instructions' => 'One or two sentences shown on the /demos/ listing card.',
		],

		[
			'key'          => 'field_ind_cta_links',
			'label'        => 'CTA Links',
			'name'         => 'industry_cta_links',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Add link',
			'instructions' => 'Add one or more call-to-action links for this industry card.',
			'sub_fields'   => [
				[
					'key'          => 'field_ind_cta_label',
					'label'        => 'Label',
					'name'         => 'cta_label',
					'type'         => 'text',
					'required'     => 1,
					'instructions' => 'e.g. "View Demo", "Explore Catalog"',
					'column_width' => '50',
				],
				[
					'key'          => 'field_ind_cta_url',
					'label'        => 'URL',
					'name'         => 'cta_url',
					'type'         => 'url',
					'required'     => 1,
					'column_width' => '50',
				],
			],
		],

	],
] );
