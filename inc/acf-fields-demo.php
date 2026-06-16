<?php
/**
 * ACF field group for the `demo` post type.
 *
 * Requires ACF Pro (the Questions list uses a Repeater field).
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'      => 'group_chatsku_demo',
	'title'    => 'Demo Content',
	'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'demo' ] ] ],
	'position' => 'normal',
	'style'    => 'default',
	'active'   => true,
	'fields'   => [

		// ── Project ──────────────────────────────────────────────────────────
		[ 'key' => 'field_demo_tab_project', 'type' => 'tab', 'label' => 'Project' ],
		[
			'key'         => 'field_demo_subheading',
			'label'       => 'Subheading',
			'name'        => 'demo_subheading',
			'type'        => 'text',
			'instructions'=> 'Short line shown under the project name in the widget block.',
		],
		[
			'key'   => 'field_demo_summary',
			'label' => 'Listing summary',
			'name'  => 'demo_summary',
			'type'  => 'textarea',
			'rows'  => 2,
			'instructions' => 'One or two lines shown on the internal demo listing card.',
		],
		[
			'key'           => 'field_demo_accent_color',
			'label'         => 'Accent color',
			'name'          => 'demo_accent_color',
			'type'          => 'color_picker',
			'default_value' => '#00C9B1',
		],

		// ── Search tips ──────────────────────────────────────────────────────
		// The template owns the fixed sentence (e.g. "Spelling correction: Type … instead of …").
		// Enter ONLY the example word(s) below — the instructional text is added automatically.
		[ 'key' => 'field_demo_tab_tips', 'type' => 'tab', 'label' => 'Search tips' ],
		[ 'key' => 'field_tip_spelling_text', 'label' => 'Spelling — misspelled word (typed & injected)', 'name' => 'tip_spelling_text', 'type' => 'text', 'instructions' => 'Just the misspelled word, e.g. Plexiclass. Shown as "Type <code>Plexiclass</code>" and injected on Try It. Leave blank to hide this tip.' ],
		[ 'key' => 'field_tip_spelling_correct', 'label' => 'Spelling — correct word', 'name' => 'tip_spelling_correct', 'type' => 'text', 'instructions' => 'The correct spelling shown after "instead of", e.g. Plexiglass. Optional.' ],
		[ 'key' => 'field_tip_voice_text', 'label' => 'Voice — phrase to say (also the Speak fallback)', 'name' => 'tip_voice_text', 'type' => 'text', 'instructions' => 'Just the phrase, e.g. Acrylic Tubes. Shown as "say <em>Acrylic Tubes</em>" and injected if the browser has no microphone / speech support. Leave blank to hide this tip.' ],
		[ 'key' => 'field_tip_synonyms_text', 'label' => 'Synonyms — word to type (injected)', 'name' => 'tip_synonyms_text', 'type' => 'text', 'instructions' => 'Just the word, e.g. pipes. Shown as "Type <code>pipes</code>" and injected on Try It. Leave blank to hide this tip.' ],
		[ 'key' => 'field_tip_synonyms_note', 'label' => 'Synonyms — note', 'name' => 'tip_synonyms_note', 'type' => 'text', 'instructions' => 'Parenthetical note shown after the word, e.g. the demo store has only hoses. Optional.' ],

		// ── Questions (Repeater — ACF Pro) ───────────────────────────────────
		[ 'key' => 'field_demo_tab_questions', 'type' => 'tab', 'label' => 'Questions' ],
		[
			'key'          => 'field_demo_questions',
			'label'        => 'Questions',
			'name'         => 'demo_questions',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add question',
			'sub_fields'   => [
				[ 'key' => 'field_q_label',   'label' => 'Label',          'name' => 'q_label',   'type' => 'text', 'instructions' => 'e.g. "Researcher asks"' ],
				[ 'key' => 'field_q_text',    'label' => 'Question (shown)','name' => 'q_text',    'type' => 'text', 'required' => 1 ],
				[ 'key' => 'field_q_query',   'label' => 'Query (sent to widget)', 'name' => 'q_query', 'type' => 'textarea', 'rows' => 2, 'instructions' => 'Full question sent to the chat. Leave blank to use the shown text.' ],
				[ 'key' => 'field_q_text_es', 'label' => 'Question — Spanish (optional)', 'name' => 'q_text_es', 'type' => 'text' ],
				[ 'key' => 'field_q_query_es','label' => 'Query — Spanish (optional)', 'name' => 'q_query_es', 'type' => 'textarea', 'rows' => 2 ],
					[ 'key' => 'field_q_text_fr', 'label' => 'Question — French (optional)', 'name' => 'q_text_fr', 'type' => 'text' ],
					[ 'key' => 'field_q_query_fr','label' => 'Query — French (optional)', 'name' => 'q_query_fr', 'type' => 'textarea', 'rows' => 2 ],
			],
		],

		// ── Widget ───────────────────────────────────────────────────────────
		[ 'key' => 'field_demo_tab_widget', 'type' => 'tab', 'label' => 'Widget' ],
		[ 'key' => 'field_widget_api_key', 'label' => 'Widget API key', 'name' => 'widget_api_key', 'type' => 'text', 'required' => 1, 'instructions' => 'ChatSKU widget data-api-key for this project.' ],
		[ 'key' => 'field_widget_src', 'label' => 'Widget script URL', 'name' => 'widget_src', 'type' => 'url', 'default_value' => 'https://app.chatsku.com/widget/widget.js' ],

		// ── Listing / link ───────────────────────────────────────────────────
		[ 'key' => 'field_demo_tab_listing', 'type' => 'tab', 'label' => 'Listing / link' ],
		[ 'key' => 'field_landing_page_url', 'label' => 'Landing page URL', 'name' => 'landing_page_url', 'type' => 'url', 'instructions' => 'If set, the listing card button opens this. Leave blank to open the demo page itself.' ],

		// ── Layout ───────────────────────────────────────────────────────────
		[ 'key' => 'field_demo_tab_layout', 'type' => 'tab', 'label' => 'Layout' ],
		[
			'key'           => 'field_widget_placement',
			'label'         => 'Widget placement',
			'name'          => 'widget_placement',
			'type'          => 'select',
			'choices'       => [
				'auto'   => 'Auto — render the widget block above the Elementor content',
				'manual' => 'Manual — I will place [chatsku_demo_widget] in Elementor',
			],
			'default_value' => 'auto',
			'return_format' => 'value',
		],
	],
] );
