<?php
/**
 * ACF Field Groups — Programmatic Registration
 *
 * These field groups are registered via PHP as a fallback and for portability.
 * ACF will prefer the JSON files in /acf-json/ if they exist and are newer.
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

// ═══════════════════════════════════════════════════════════════════════════════
// 1. GLOBAL OPTIONS PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'      => 'group_chatsku_options',
    'title'    => 'ChatSKU Global Settings',
    'fields'   => [
        // Header
        [
            'key'   => 'field_site_logo',
            'label' => 'Site Logo',
            'name'  => 'site_logo',
            'type'  => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
        [
            'key'   => 'field_site_logo_dark',
            'label' => 'Site Logo (Dark variant)',
            'name'  => 'site_logo_dark',
            'type'  => 'image',
            'return_format' => 'array',
            'instructions'  => 'White/light version for dark backgrounds.',
        ],
        [
            'key'   => 'field_header_cta_text',
            'label' => 'Header CTA Button Text',
            'name'  => 'header_cta_text',
            'type'  => 'text',
            'default_value' => 'Get Started',
        ],
        [
            'key'   => 'field_header_cta_url',
            'label' => 'Header CTA Button URL',
            'name'  => 'header_cta_url',
            'type'  => 'url',
        ],
        // Global URLs
        [
            'key'   => 'field_external_app_url',
            'label' => 'External App URL',
            'name'  => 'external_app_url',
            'type'  => 'url',
            'instructions' => 'The URL of the ChatSKU app (e.g. https://app.chatsku.com)',
            'default_value' => 'https://app.chatsku.com',
        ],
        [
            'key'   => 'field_login_url',
            'label' => 'Login URL',
            'name'  => 'login_url',
            'type'  => 'url',
            'default_value' => 'https://app.chatsku.com/login',
        ],
        [
            'key'   => 'field_register_url',
            'label' => 'Register / Sign Up URL',
            'name'  => 'register_url',
            'type'  => 'url',
            'default_value' => 'https://app.chatsku.com/register',
        ],
        // Footer
        [
            'key'   => 'field_footer_tagline',
            'label' => 'Footer Tagline',
            'name'  => 'footer_tagline',
            'type'  => 'textarea',
            'rows'  => 2,
        ],
        [
            'key'   => 'field_footer_columns',
            'label' => 'Footer Link Columns',
            'name'  => 'footer_columns',
            'type'  => 'repeater',
            'min'   => 0,
            'max'   => 6,
            'layout' => 'block',
            'sub_fields' => [
                [
                    'key'   => 'field_footer_col_heading',
                    'label' => 'Column Heading',
                    'name'  => 'column_heading',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_footer_col_links',
                    'label' => 'Links',
                    'name'  => 'column_links',
                    'type'  => 'repeater',
                    'layout' => 'table',
                    'sub_fields' => [
                        [
                            'key'   => 'field_footer_link_text',
                            'label' => 'Link Text',
                            'name'  => 'link_text',
                            'type'  => 'text',
                        ],
                        [
                            'key'   => 'field_footer_link_url',
                            'label' => 'Link URL',
                            'name'  => 'link_url',
                            'type'  => 'url',
                        ],
                    ],
                ],
            ],
        ],
        [
            'key'   => 'field_footer_copyright',
            'label' => 'Footer Copyright Text',
            'name'  => 'footer_copyright',
            'type'  => 'text',
            'default_value' => '© ' . date('Y') . ' ChatSKU. All rights reserved.',
        ],
        [
            'key'   => 'field_footer_social_links',
            'label' => 'Social Links',
            'name'  => 'footer_social_links',
            'type'  => 'repeater',
            'layout' => 'table',
            'sub_fields' => [
                [
                    'key'   => 'field_social_platform',
                    'label' => 'Platform',
                    'name'  => 'social_platform',
                    'type'  => 'select',
                    'choices' => [
                        'twitter'  => 'X (Twitter)',
                        'linkedin' => 'LinkedIn',
                        'github'   => 'GitHub',
                        'youtube'  => 'YouTube',
                        'facebook' => 'Facebook',
                    ],
                ],
                [
                    'key'   => 'field_social_url',
                    'label' => 'URL',
                    'name'  => 'social_url',
                    'type'  => 'url',
                ],
            ],
        ],
    ],
    'location' => [
        [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'chatsku-settings' ] ],
    ],
    'menu_order' => 0,
    'style'      => 'seamless',
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 2. HOME PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_home',
    'title' => 'Home Page Content',
    'fields' => [
        // ── Hero ──────────────────────────────────────────────────────────
        [ 'key' => 'field_hero_tab', 'label' => 'Hero Section', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_hero_eyebrow',           'label' => 'Eyebrow Badge Text',  'name' => 'hero_eyebrow',           'type' => 'text',     'default_value' => 'AI-Powered B2B eCommerce' ],
        [ 'key' => 'field_hero_headline',          'label' => 'Main Headline',       'name' => 'hero_headline',          'type' => 'text' ],
        [ 'key' => 'field_hero_subheadline',       'label' => 'Sub Headline',        'name' => 'hero_subheadline',       'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_hero_primary_cta_text',  'label' => 'Primary CTA Text',    'name' => 'hero_primary_cta_text',  'type' => 'text',     'default_value' => 'Start Free Trial' ],
        [ 'key' => 'field_hero_primary_cta_url',   'label' => 'Primary CTA URL',     'name' => 'hero_primary_cta_url',   'type' => 'url' ],
        [ 'key' => 'field_hero_secondary_cta_text','label' => 'Secondary CTA Text',  'name' => 'hero_secondary_cta_text','type' => 'text',     'default_value' => 'See Demo' ],
        [ 'key' => 'field_hero_secondary_cta_url', 'label' => 'Secondary CTA URL',   'name' => 'hero_secondary_cta_url', 'type' => 'url' ],
        [ 'key' => 'field_hero_image',             'label' => 'Hero Image / Mockup', 'name' => 'hero_image',             'type' => 'image',    'return_format' => 'array' ],
        [ 'key' => 'field_hero_stats',             'label' => 'Hero Stats Bar',      'name' => 'hero_stats',             'type' => 'repeater', 'layout' => 'table', 'max' => 4,
            'sub_fields' => [
                [ 'key' => 'field_stat_value', 'label' => 'Value', 'name' => 'stat_value', 'type' => 'text' ],
                [ 'key' => 'field_stat_label', 'label' => 'Label', 'name' => 'stat_label', 'type' => 'text' ],
            ]
        ],

        // ── Features Grid ─────────────────────────────────────────────────
        [ 'key' => 'field_features_tab', 'label' => 'Features Grid', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_features_heading',    'label' => 'Section Heading',    'name' => 'features_heading',    'type' => 'text' ],
        [ 'key' => 'field_features_subheading', 'label' => 'Section Subheading', 'name' => 'features_subheading', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_features_cards', 'label' => 'Feature Cards', 'name' => 'features_cards', 'type' => 'repeater', 'min' => 1, 'max' => 12, 'layout' => 'block',
            'sub_fields' => [
                [ 'key' => 'field_card_icon_svg',   'label' => 'Icon (SVG code)',   'name' => 'card_icon_svg',   'type' => 'textarea', 'rows' => 4, 'instructions' => 'Paste inline SVG markup.' ],
                [ 'key' => 'field_card_title',       'label' => 'Card Title',        'name' => 'card_title',       'type' => 'text' ],
                [ 'key' => 'field_card_description', 'label' => 'Card Description',  'name' => 'card_description', 'type' => 'textarea', 'rows' => 3 ],
                [ 'key' => 'field_card_accent',      'label' => 'Accent Color (hex)','name' => 'card_accent',      'type' => 'color_picker', 'default_value' => '#00C9B1' ],
            ]
        ],

        // ── 3 Steps ───────────────────────────────────────────────────────
        [ 'key' => 'field_steps_tab', 'label' => '3 Steps to Live', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_steps_heading',    'label' => 'Section Heading',    'name' => 'steps_heading',    'type' => 'text', 'default_value' => '3 Steps to Live.' ],
        [ 'key' => 'field_steps_subheading', 'label' => 'Section Subheading', 'name' => 'steps_subheading', 'type' => 'text' ],
        [ 'key' => 'field_steps_items', 'label' => 'Steps', 'name' => 'steps_items', 'type' => 'repeater', 'min' => 1, 'max' => 6, 'layout' => 'block',
            'sub_fields' => [
                [ 'key' => 'field_step_number',      'label' => 'Step Number',      'name' => 'step_number',      'type' => 'text', 'default_value' => 'Step 1' ],
                [ 'key' => 'field_step_title',       'label' => 'Step Title',       'name' => 'step_title',       'type' => 'text' ],
                [ 'key' => 'field_step_description', 'label' => 'Step Description', 'name' => 'step_description', 'type' => 'textarea', 'rows' => 3 ],
                [ 'key' => 'field_step_icon_svg',    'label' => 'Step Icon (SVG)',  'name' => 'step_icon_svg',    'type' => 'textarea', 'rows' => 3 ],
            ]
        ],
        [ 'key' => 'field_steps_embed_code', 'label' => 'Embed Code Snippet (displayed in section)', 'name' => 'steps_embed_code', 'type' => 'textarea', 'rows' => 3 ],

        // ── B2B Value Props ───────────────────────────────────────────────
        [ 'key' => 'field_b2b_tab', 'label' => 'B2B Value Props', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_b2b_heading',    'label' => 'Section Heading',    'name' => 'b2b_heading',    'type' => 'text' ],
        [ 'key' => 'field_b2b_subheading', 'label' => 'Section Subheading', 'name' => 'b2b_subheading', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_b2b_props', 'label' => 'Value Props', 'name' => 'b2b_props', 'type' => 'repeater', 'min' => 1, 'max' => 8, 'layout' => 'block',
            'sub_fields' => [
                [ 'key' => 'field_b2b_icon',        'label' => 'Icon (SVG)',    'name' => 'prop_icon',        'type' => 'textarea', 'rows' => 3 ],
                [ 'key' => 'field_b2b_title',       'label' => 'Title',         'name' => 'prop_title',       'type' => 'text' ],
                [ 'key' => 'field_b2b_description', 'label' => 'Description',   'name' => 'prop_description', 'type' => 'textarea', 'rows' => 2 ],
            ]
        ],
        [ 'key' => 'field_b2b_image', 'label' => 'B2B Section Image / Screenshot', 'name' => 'b2b_image', 'type' => 'image', 'return_format' => 'array' ],

        // ── Pricing ───────────────────────────────────────────────────────
        [ 'key' => 'field_hp_tab', 'label' => 'Pricing', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_hp_eyebrow', 'label' => 'Eyebrow', 'name' => 'pricing_eyebrow', 'type' => 'text', 'default_value' => 'Pricing' ],
        [ 'key' => 'field_hp_heading', 'label' => 'Heading', 'name' => 'pricing_heading', 'type' => 'text', 'default_value' => 'Simple pricing that scales with your catalog' ],
        [ 'key' => 'field_hp_intro', 'label' => 'Intro paragraph', 'name' => 'pricing_intro', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Every plan includes every feature. Plans differ only by catalog size and support — not by what the assistant can do.' ],
        [ 'key' => 'field_hp_includes_heading', 'label' => '"Every plan includes" heading', 'name' => 'pricing_includes_heading', 'type' => 'text', 'default_value' => 'Every plan includes' ],
        [ 'key' => 'field_hp_includes_sub', 'label' => '"Every plan includes" subtext', 'name' => 'pricing_includes_sub', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_hp_features', 'label' => 'Every plan includes — shared features (3-column panel)', 'name' => 'pricing_features', 'type' => 'repeater', 'min' => 0, 'max' => 20, 'layout' => 'table', 'button_label' => 'Add feature',
            'sub_fields' => [
                [ 'key' => 'field_hp_feature_text', 'label' => 'Feature', 'name' => 'feature_text', 'type' => 'text' ],
            ]
        ],
        [ 'key' => 'field_hp_plans', 'label' => 'Plans', 'name' => 'pricing_plans', 'type' => 'repeater', 'min' => 0, 'max' => 4, 'layout' => 'block', 'button_label' => 'Add plan',
            'sub_fields' => [
                [ 'key' => 'field_hp_plan_name', 'label' => 'Plan name', 'name' => 'plan_name', 'type' => 'text' ],
                [ 'key' => 'field_hp_plan_tagline', 'label' => 'Tagline', 'name' => 'plan_tagline', 'type' => 'textarea', 'rows' => 2 ],
                [ 'key' => 'field_hp_plan_price_label', 'label' => 'Price label', 'name' => 'plan_price_label', 'type' => 'text', 'instructions' => 'e.g. Free / Flat monthly / Custom' ],
                [ 'key' => 'field_hp_plan_price_note', 'label' => 'Price note', 'name' => 'plan_price_note', 'type' => 'textarea', 'rows' => 2 ],
                [ 'key' => 'field_hp_plan_featured', 'label' => 'Featured (highlight card)', 'name' => 'plan_featured', 'type' => 'true_false', 'ui' => 1 ],
                [ 'key' => 'field_hp_plan_badge', 'label' => 'Badge text', 'name' => 'plan_badge', 'type' => 'text', 'instructions' => 'e.g. Most popular. Leave blank for none.' ],
                [ 'key' => 'field_hp_plan_cta_text', 'label' => 'Button text', 'name' => 'plan_cta_text', 'type' => 'text' ],
                [ 'key' => 'field_hp_plan_cta_url', 'label' => 'Button URL', 'name' => 'plan_cta_url', 'type' => 'text' ],
                [ 'key' => 'field_hp_plan_features', 'label' => 'Plan features (this plan only)', 'name' => 'plan_features', 'type' => 'repeater', 'min' => 0, 'max' => 12, 'layout' => 'table', 'button_label' => 'Add feature',
                    'sub_fields' => [
                        [ 'key' => 'field_hp_plan_feature_text', 'label' => 'Feature', 'name' => 'feature_text', 'type' => 'text' ],
                    ]
                ],
            ]
        ],
        [ 'key' => 'field_hp_note_text', 'label' => 'Footnote text', 'name' => 'pricing_note_text', 'type' => 'text', 'default_value' => 'Not sure which plan fits?' ],
        [ 'key' => 'field_hp_note_l1_text', 'label' => 'Footnote link 1 — text', 'name' => 'pricing_note_link1_text', 'type' => 'text' ],
        [ 'key' => 'field_hp_note_l1_url', 'label' => 'Footnote link 1 — URL', 'name' => 'pricing_note_link1_url', 'type' => 'text' ],
        [ 'key' => 'field_hp_note_l2_text', 'label' => 'Footnote link 2 — text', 'name' => 'pricing_note_link2_text', 'type' => 'text' ],
        [ 'key' => 'field_hp_note_l2_url', 'label' => 'Footnote link 2 — URL', 'name' => 'pricing_note_link2_url', 'type' => 'text' ],

        // ── Trust / Credibility ───────────────────────────────────────────
        [ 'key' => 'field_ht_tab', 'label' => 'Trust / Credibility', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_ht_eyebrow', 'label' => 'Eyebrow', 'name' => 'trust_eyebrow', 'type' => 'text', 'default_value' => 'Why suppliers trust ChatSKU' ],
        [ 'key' => 'field_ht_heading', 'label' => 'Heading', 'name' => 'trust_heading', 'type' => 'text', 'default_value' => 'Backed by 14 years of B2B commerce experience' ],
        [ 'key' => 'field_ht_intro', 'label' => 'Intro paragraph', 'name' => 'trust_intro', 'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_ht_stats', 'label' => 'Stats strip', 'name' => 'trust_stats', 'type' => 'repeater', 'min' => 0, 'max' => 4, 'layout' => 'table', 'button_label' => 'Add stat',
            'sub_fields' => [
                [ 'key' => 'field_ht_stat_value', 'label' => 'Value', 'name' => 'stat_value', 'type' => 'text' ],
                [ 'key' => 'field_ht_stat_label', 'label' => 'Label', 'name' => 'stat_label', 'type' => 'text' ],
            ]
        ],
        [ 'key' => 'field_ht_cards', 'label' => 'Cards', 'name' => 'trust_cards', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => 'Add card',
            'sub_fields' => [
                [ 'key' => 'field_ht_card_title', 'label' => 'Title', 'name' => 'card_title', 'type' => 'text' ],
                [ 'key' => 'field_ht_card_body', 'label' => 'Body', 'name' => 'card_body', 'type' => 'textarea', 'rows' => 3 ],
            ]
        ],

        // ── Bottom CTA ────────────────────────────────────────────────────
        [ 'key' => 'field_cta_tab', 'label' => 'Bottom CTA', 'name' => '', 'type' => 'tab', 'placement' => 'left' ],
        [ 'key' => 'field_cta_heading',    'label' => 'CTA Heading',    'name' => 'cta_heading',    'type' => 'text' ],
        [ 'key' => 'field_cta_subheading', 'label' => 'CTA Subheading', 'name' => 'cta_subheading', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_cta_card1_eyebrow',  'label' => 'Card 1 — Eyebrow',     'name' => 'cta_card1_eyebrow',  'type' => 'text', 'default_value' => 'Ready to go' ],
        [ 'key' => 'field_cta_card1_title',    'label' => 'Card 1 — Title',       'name' => 'cta_card1_title',    'type' => 'text' ],
        [ 'key' => 'field_cta_card1_body',     'label' => 'Card 1 — Body',        'name' => 'cta_card1_body',     'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_cta_card1_btn_text', 'label' => 'Card 1 — Button text', 'name' => 'cta_card1_btn_text', 'type' => 'text', 'default_value' => 'Start Free — No Credit Card' ],
        [ 'key' => 'field_cta_card1_btn_url',  'label' => 'Card 1 — Button URL',  'name' => 'cta_card1_btn_url',  'type' => 'text' ],
        [ 'key' => 'field_cta_card2_eyebrow',  'label' => 'Card 2 — Eyebrow',     'name' => 'cta_card2_eyebrow',  'type' => 'text', 'default_value' => 'Want to see it first' ],
        [ 'key' => 'field_cta_card2_title',    'label' => 'Card 2 — Title',       'name' => 'cta_card2_title',    'type' => 'text' ],
        [ 'key' => 'field_cta_card2_body',     'label' => 'Card 2 — Body',        'name' => 'cta_card2_body',     'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_cta_card2_btn_text', 'label' => 'Card 2 — Button text', 'name' => 'cta_card2_btn_text', 'type' => 'text', 'default_value' => 'See Live Demo' ],
        [ 'key' => 'field_cta_card2_btn_url',  'label' => 'Card 2 — Button URL',  'name' => 'cta_card2_btn_url',  'type' => 'text' ],
    ],
    'location' => [
        [ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ],
    ],
    'menu_order' => 0,
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 3. PRICING PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_pricing',
    'title' => 'Pricing Page Content',
    'fields' => [
        // ── Hero ──────────────────────────────────────────────────────────────
        [ 'key' => 'field_pricing_headline',       'label' => 'Page Headline',        'name' => 'pricing_headline',       'type' => 'text',     'default_value' => 'Priced for How You Actually Use It' ],
        [ 'key' => 'field_pricing_headline_accent','label' => 'Headline Accent Text', 'name' => 'pricing_headline_accent','type' => 'text',     'default_value' => 'Actually Use It', 'instructions' => 'This portion of the headline will be rendered in teal accent color.' ],
        [ 'key' => 'field_pricing_subheadline',    'label' => 'Page Subheadline',     'name' => 'pricing_subheadline',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Flat monthly fee covers your catalog. SKUBits cover your AI-powered features. Use more, top up. Use less, pay nothing extra.' ],
        // Trust Badges repeater managed by chatsku-pricing-meta plugin
        // ── Billing Toggle ────────────────────────────────────────────────────
        [ 'key' => 'field_pricing_toggle_monthly', 'label' => 'Monthly Toggle Label', 'name' => 'pricing_toggle_monthly', 'type' => 'text', 'default_value' => 'Monthly' ],
        [ 'key' => 'field_pricing_toggle_annual',  'label' => 'Annual Toggle Label',  'name' => 'pricing_toggle_annual',  'type' => 'text', 'default_value' => 'Annual' ],
        [ 'key' => 'field_pricing_annual_badge',   'label' => 'Annual Discount Badge','name' => 'pricing_annual_badge',   'type' => 'text', 'default_value' => '1 MONTH FREE' ],
        // Pricing Plans repeater managed by chatsku-pricing-meta plugin
        // ── SKUBit Explainer ──────────────────────────────────────────────────
        [ 'key' => 'field_skubit_title',       'label' => 'SKUBit Section Title', 'name' => 'pricing_skubit_title',  'type' => 'text',     'default_value' => 'What is a SKUBit?' ],
        [ 'key' => 'field_skubit_body',        'label' => 'SKUBit Explanation',   'name' => 'pricing_skubit_body',   'type' => 'textarea', 'rows' => 5, 'default_value' => "SKUBits are ChatSKU's usage currency for AI-powered Premium features. Your flat monthly fee includes a bundle of SKUBits. When you use Premium features — image search, voice queries, order sync — SKUBits are consumed at a fixed rate.\n\nBase features like text search (up to 50K/mo), support chat, quotes, and emails are fully covered by your flat fee. SKUBits only apply when you go beyond." ],
        [ 'key' => 'field_skubit_anchor',      'label' => 'Anchor Rate Label',    'name' => 'pricing_skubit_anchor', 'type' => 'text',     'default_value' => '1 SKUBit = $0.0001' ],
        // SKUBit Rates repeater managed by chatsku-pricing-meta plugin
        // ── Calculator ────────────────────────────────────────────────────────
        [ 'key' => 'field_calc_heading',  'label' => 'Calculator Heading',  'name' => 'pricing_calc_heading',  'type' => 'text', 'default_value' => 'Estimate Your Monthly Cost' ],
        [ 'key' => 'field_calc_subtitle', 'label' => 'Calculator Subtitle', 'name' => 'pricing_calc_subtitle', 'type' => 'text', 'default_value' => 'Enter your catalog and traffic details. Your recommended plan updates in real time.' ],
        // FAQ repeater managed by chatsku-pricing-meta plugin
        // ── Bottom CTA ────────────────────────────────────────────────────────
        [ 'key' => 'field_pricing_cta_heading', 'label' => 'CTA Heading',     'name' => 'pricing_cta_heading', 'type' => 'text', 'default_value' => 'Ready to see it in action?' ],
        [ 'key' => 'field_pricing_cta_sub',     'label' => 'CTA Subtitle',    'name' => 'pricing_cta_sub',     'type' => 'text', 'default_value' => 'Start your free trial — no credit card needed, no developer required.' ],
        [ 'key' => 'field_pricing_cta_btn',     'label' => 'CTA Button Text', 'name' => 'pricing_cta_btn',     'type' => 'text', 'default_value' => 'Get Started Free' ],
        [ 'key' => 'field_pricing_cta_url',     'label' => 'CTA Button URL',  'name' => 'pricing_cta_url2',    'type' => 'url' ],
    ],
    'location' => [
        [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-pricing.php' ] ],
    ],
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 4. FAQ PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_faq',
    'title' => 'FAQ Page Content',
    'fields' => [
        [ 'key' => 'field_faq_headline',    'label' => 'Page Headline',    'name' => 'faq_headline',    'type' => 'text' ],
        [ 'key' => 'field_faq_subheadline', 'label' => 'Page Subheadline', 'name' => 'faq_subheadline', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_faq_categories', 'label' => 'FAQ Categories', 'name' => 'faq_categories', 'type' => 'repeater', 'min' => 1, 'layout' => 'block',
            'sub_fields' => [
                [ 'key' => 'field_faq_category_name', 'label' => 'Category Name', 'name' => 'category_name', 'type' => 'text' ],
                [ 'key' => 'field_faq_items', 'label' => 'FAQ Items', 'name' => 'category_items', 'type' => 'repeater', 'min' => 1, 'layout' => 'block',
                    'sub_fields' => [
                        [ 'key' => 'field_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
                        [ 'key' => 'field_faq_answer',   'label' => 'Answer',   'name' => 'answer',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0 ],
                    ]
                ],
            ]
        ],
        [ 'key' => 'field_faq_cta_heading', 'label' => 'Bottom CTA Heading', 'name' => 'faq_cta_heading', 'type' => 'text', 'default_value' => 'Still have questions?' ],
        [ 'key' => 'field_faq_cta_text',    'label' => 'Bottom CTA Text',    'name' => 'faq_cta_text',    'type' => 'text', 'default_value' => 'Contact Us' ],
        [ 'key' => 'field_faq_cta_url',     'label' => 'Bottom CTA URL',     'name' => 'faq_cta_url',     'type' => 'url' ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'faq' ] ],
    ],
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 5. FEATURES PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_features',
    'title' => 'Features Page Content',
    'fields' => [
        [ 'key' => 'field_feat_headline',    'label' => 'Page Headline',    'name' => 'feat_headline',    'type' => 'text' ],
        [ 'key' => 'field_feat_subheadline', 'label' => 'Page Subheadline', 'name' => 'feat_subheadline', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_features_sections', 'label' => 'Feature Sections', 'name' => 'features_sections', 'type' => 'flexible_content',
            'button_label' => 'Add Feature Section',
            'layouts' => [
                'feature_left' => [
                    'key'        => 'layout_feature_left',
                    'name'       => 'feature_left',
                    'label'      => 'Image Left / Text Right',
                    'display'    => 'block',
                    'sub_fields' => [
                        [ 'key' => 'field_fl_headline',    'label' => 'Headline',    'name' => 'section_headline',    'type' => 'text' ],
                        [ 'key' => 'field_fl_description', 'label' => 'Description', 'name' => 'section_description', 'type' => 'textarea', 'rows' => 4 ],
                        [ 'key' => 'field_fl_image',       'label' => 'Image',       'name' => 'section_image',       'type' => 'image', 'return_format' => 'array' ],
                        [ 'key' => 'field_fl_bullets', 'label' => 'Bullet Points', 'name' => 'section_bullets', 'type' => 'repeater', 'layout' => 'table',
                            'sub_fields' => [
                                [ 'key' => 'field_fl_bullet', 'label' => 'Bullet', 'name' => 'bullet_text', 'type' => 'text' ],
                            ]
                        ],
                    ],
                ],
                'feature_right' => [
                    'key'        => 'layout_feature_right',
                    'name'       => 'feature_right',
                    'label'      => 'Text Left / Image Right',
                    'display'    => 'block',
                    'sub_fields' => [
                        [ 'key' => 'field_fr_headline',    'label' => 'Headline',    'name' => 'section_headline',    'type' => 'text' ],
                        [ 'key' => 'field_fr_description', 'label' => 'Description', 'name' => 'section_description', 'type' => 'textarea', 'rows' => 4 ],
                        [ 'key' => 'field_fr_image',       'label' => 'Image',       'name' => 'section_image',       'type' => 'image', 'return_format' => 'array' ],
                        [ 'key' => 'field_fr_bullets', 'label' => 'Bullet Points', 'name' => 'section_bullets', 'type' => 'repeater', 'layout' => 'table',
                            'sub_fields' => [
                                [ 'key' => 'field_fr_bullet', 'label' => 'Bullet', 'name' => 'bullet_text', 'type' => 'text' ],
                            ]
                        ],
                    ],
                ],
                'feature_full' => [
                    'key'        => 'layout_feature_full',
                    'name'       => 'feature_full',
                    'label'      => 'Full Width Showcase',
                    'display'    => 'block',
                    'sub_fields' => [
                        [ 'key' => 'field_ff_headline',    'label' => 'Headline',    'name' => 'section_headline',    'type' => 'text' ],
                        [ 'key' => 'field_ff_description', 'label' => 'Description', 'name' => 'section_description', 'type' => 'textarea', 'rows' => 3 ],
                        [ 'key' => 'field_ff_image',       'label' => 'Full Width Image', 'name' => 'section_image',  'type' => 'image', 'return_format' => 'array' ],
                    ],
                ],
            ],
        ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'features' ] ],
    ],
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 6. DEMO WIDGET PAGE FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_demo_widget',
    'title' => 'Demo Widget Page Content',
    'fields' => [
        [ 'key' => 'field_dw_headline',    'label' => 'Page Headline',    'name' => 'dw_headline',    'type' => 'text', 'default_value' => 'See ChatSKU in action' ],
        [ 'key' => 'field_dw_subheadline', 'label' => 'Page Subheadline', 'name' => 'dw_subheadline', 'type' => 'textarea', 'rows' => 2 ],
        [ 'key' => 'field_dw_embed_type',  'label' => 'Embed Type',       'name' => 'dw_embed_type',  'type' => 'select',
            'choices' => [ 'iframe' => 'iFrame', 'script' => 'Script Tag', 'image' => 'Static Image' ],
            'default_value' => 'iframe',
        ],
        [ 'key' => 'field_dw_iframe_url',    'label' => 'iFrame URL',            'name' => 'dw_iframe_url',    'type' => 'url',
            'conditional_logic' => [ [ [ 'field' => 'field_dw_embed_type', 'operator' => '==', 'value' => 'iframe' ] ] ]
        ],
        [ 'key' => 'field_dw_script_code',   'label' => 'Script Embed Code',     'name' => 'dw_script_code',   'type' => 'textarea', 'rows' => 5,
            'conditional_logic' => [ [ [ 'field' => 'field_dw_embed_type', 'operator' => '==', 'value' => 'script' ] ] ]
        ],
        [ 'key' => 'field_dw_fallback_image','label' => 'Fallback / Static Image','name' => 'dw_fallback_image','type' => 'image', 'return_format' => 'array' ],
        [ 'key' => 'field_dw_instructions', 'label' => 'Search Tips / Instructions', 'name' => 'dw_instructions', 'type' => 'repeater', 'layout' => 'table',
            'sub_fields' => [
                [ 'key' => 'field_dw_tip', 'label' => 'Tip', 'name' => 'instruction_text', 'type' => 'text' ],
            ]
        ],
        [ 'key' => 'field_dw_sample_queries', 'label' => 'Sample Query Buttons', 'name' => 'dw_sample_queries', 'type' => 'repeater', 'layout' => 'table',
            'sub_fields' => [
                [ 'key' => 'field_dw_query', 'label' => 'Query', 'name' => 'query_text', 'type' => 'text' ],
            ]
        ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'demo-widget' ] ],
    ],
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 7. AUTH PAGES FIELDS (Login + Register)
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_auth',
    'title' => 'Auth Page Content',
    'fields' => [
        [ 'key' => 'field_auth_headline',      'label' => 'Page Headline',       'name' => 'auth_headline',      'type' => 'text' ],
        [ 'key' => 'field_auth_subheadline',   'label' => 'Page Subheadline',    'name' => 'auth_subheadline',   'type' => 'text' ],
        [ 'key' => 'field_auth_form_action',   'label' => 'Form Action URL',     'name' => 'auth_form_action',   'type' => 'url', 'instructions' => 'External app URL where the form submits.' ],
        [ 'key' => 'field_auth_alt_link_text', 'label' => 'Alternate Link Text', 'name' => 'auth_alt_link_text', 'type' => 'text' ],
        [ 'key' => 'field_auth_alt_link_url',  'label' => 'Alternate Link URL',  'name' => 'auth_alt_link_url',  'type' => 'url' ],
        [ 'key' => 'field_auth_brand_image',   'label' => 'Side Panel Image',    'name' => 'auth_brand_image',   'type' => 'image', 'return_format' => 'array' ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'login' ] ],
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'register' ] ],
    ],
] );

// ═══════════════════════════════════════════════════════════════════════════════
// 8. BLOG POST FIELDS
// ═══════════════════════════════════════════════════════════════════════════════
acf_add_local_field_group( [
    'key'   => 'group_chatsku_post',
    'title' => 'Blog Post Extra Fields',
    'fields' => [
        [ 'key' => 'field_post_hero_image',  'label' => 'Post Hero Image',       'name' => 'post_hero_image',  'type' => 'image', 'return_format' => 'array' ],
        [ 'key' => 'field_post_author_bio',  'label' => 'Author Bio Override',   'name' => 'post_author_bio',  'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_post_cta_heading', 'label' => 'In-Article CTA Heading','name' => 'post_cta_heading', 'type' => 'text' ],
        [ 'key' => 'field_post_cta_url',     'label' => 'In-Article CTA URL',    'name' => 'post_cta_url',     'type' => 'url' ],
        [ 'key' => 'field_post_related',     'label' => 'Related Posts',         'name' => 'post_related',     'type' => 'relationship',
            'post_type' => [ 'post' ], 'max' => 3,
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ],
    ],
] );
