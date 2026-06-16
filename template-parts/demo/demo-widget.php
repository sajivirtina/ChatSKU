<?php
/**
 * Reusable ChatSKU demo widget block (ACF-driven).
 *
 * Renders: project header → search tips → questions (with optional EN/ES toggle)
 * → live ChatSKU widget (Inline/Bubble). Used by single-demo.php and the
 * [chatsku_demo_widget] shortcode.
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

$demo_id = get_the_ID();

$f = function ( $key, $fallback = '' ) use ( $demo_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}
	$v = get_field( $key, $demo_id );
	return ( $v !== null && $v !== '' && $v !== false ) ? $v : $fallback;
};

$project    = get_the_title( $demo_id );
$subhead    = $f( 'demo_subheading' );
$accent     = $f( 'demo_accent_color', '#00C9B1' );
$api_key    = $f( 'widget_api_key' );
$widget_src = $f( 'widget_src', 'https://app.chatsku.com/widget/widget.js' );

$mic_svg = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>';

// Build tips — the template owns the fixed sentence; ACF holds only the editable example(s).
// trim() guards against stray whitespace in the field so the injected query stays clean.
$tips = [];

$sp_term = trim( (string) $f( 'tip_spelling_text' ) ); // misspelled word, e.g. "Plexiclass"
if ( $sp_term ) {
	$h = '<strong>Spelling correction:</strong> Type <code>' . esc_html( $sp_term ) . '</code>';
	$sp_ok = trim( (string) $f( 'tip_spelling_correct' ) ); // correct word, e.g. "Plexiglass"
	if ( $sp_ok ) {
		$h .= ' instead of ' . esc_html( $sp_ok );
	}
	$tips[] = [ 'cls' => 'spelling', 'icon' => 'Aa', 'html' => $h, 'query' => $sp_term ];
}

$vc = trim( (string) $f( 'tip_voice_text' ) ); // phrase to say, e.g. "Acrylic Tubes"
if ( $vc ) {
	$tips[] = [
		'cls'      => 'voice',
		'icon'     => $mic_svg,
		'html'     => '<strong>Voice Input:</strong> Click the mic and say <em>' . esc_html( $vc ) . '</em>',
		'fallback' => $vc,
	];
}

$sy_term = trim( (string) $f( 'tip_synonyms_text' ) ); // synonym to type, e.g. "pipes"
if ( $sy_term ) {
	$h = '<strong>Synonyms:</strong> Type <code>' . esc_html( $sy_term ) . '</code>';
	$sy_note = trim( (string) $f( 'tip_synonyms_note' ) ); // parenthetical note, e.g. "the demo store has only hoses"
	if ( $sy_note ) {
		$h .= ' (' . esc_html( $sy_note ) . ')';
	}
	$tips[] = [ 'cls' => 'synonym', 'icon' => '&asymp;', 'html' => $h, 'query' => $sy_term ];
}

// Questions + detect any Spanish
$questions = $f( 'demo_questions', [] );
$has_es    = false;
if ( is_array( $questions ) ) {
	foreach ( $questions as $q ) {
		if ( ! empty( $q['q_text_es'] ) || ! empty( $q['q_query_es'] ) ) {
			$has_es = true;
			break;
		}
	}
}

$print_assets = empty( $GLOBALS['cdw_assets_printed'] );
$GLOBALS['cdw_assets_printed'] = true;
?>

<?php if ( $print_assets ) : ?>
<style>
.cdw { --cdw-accent: #00C9B1; padding: 56px 0; }
.cdw__inner { max-width: 1200px; margin: 0 auto; padding: 0 var(--space-6, 1.5rem); }
.cdw__grid { display: grid; grid-template-columns: 1fr 1.05fr; gap: 40px; align-items: start; }
.cdw__title { font-size: clamp(1.5rem, 3.5vw, 2.25rem); font-weight: 800; color: var(--color-text-primary, #f8fafc); letter-spacing: -0.02em; margin: 0 0 8px; line-height: 1.15; }
.cdw__sub { font-size: 0.95rem; color: var(--color-text-muted, #94a3b8); line-height: 1.6; margin: 0 0 4px; }
.cdw__tips { background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 12px; padding: 20px 22px; margin-top: 24px; }
.cdw__tips-lead { font-size: 13px; font-weight: 700; color: var(--color-text-primary, #f8fafc); margin: 0 0 14px; }
.cdw__tips-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 14px; }
.cdw__tip { display: flex; align-items: flex-start; justify-content: space-between; gap: 14px; }
.cdw__tip-label { flex: 1 1 auto; min-width: 0; display: flex; gap: 10px; align-items: flex-start; font-size: 13px; color: var(--color-text-secondary, #cbd5e1); line-height: 1.5; }
.cdw__tip-label code { background: rgba(0,201,177,0.12); color: var(--cdw-accent); font-family: var(--font-mono, monospace); font-size: 12px; padding: 1px 6px; border-radius: 3px; }
.cdw__tip-label em { color: var(--cdw-accent); font-style: italic; font-weight: 700; }
.cdw__tip-icon { flex-shrink: 0; width: 26px; height: 26px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 900; color: var(--cdw-accent); background: rgba(0,201,177,0.12); border: 1px solid rgba(0,201,177,0.25); }
.cdw__tip-btn { flex: 0 0 auto; background: transparent; color: var(--cdw-accent); border: 1.5px solid var(--cdw-accent); border-radius: 7px; padding: 6px 14px; font-family: var(--font-sans, sans-serif); font-size: 12px; font-weight: 700; cursor: pointer; transition: background .15s, color .15s; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap; }
.cdw__tip-btn:hover { background: var(--cdw-accent); color: #0d1117; }
.cdw-mic-btn.is-listening { background: var(--cdw-accent); color: #0d1117; }
.cdw__lang { display: inline-flex; gap: 2px; background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 999px; padding: 3px; margin: 24px 0 0; }
.cdw__lang-btn { background: none; border: none; padding: 5px 14px; font-family: var(--font-sans, sans-serif); font-size: 12px; font-weight: 700; color: var(--color-text-muted, #94a3b8); border-radius: 999px; cursor: pointer; }
.cdw__lang-btn.is-active { background: var(--cdw-accent); color: #0d1117; }
.cdw__qlist { display: flex; flex-direction: column; gap: 10px; margin-top: 16px; }
.cdw__q { display: block; width: 100%; text-align: left; background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-left: 3px solid var(--cdw-accent); border-radius: 8px; padding: 13px 16px; font-family: var(--font-sans, sans-serif); font-size: 13.5px; color: var(--color-text-secondary, #cbd5e1); line-height: 1.5; cursor: pointer; transition: border-color .15s, box-shadow .15s, transform .1s; }
.cdw__q:hover { border-color: var(--cdw-accent); transform: translateX(2px); }
.cdw__q-label { display: block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--cdw-accent); margin-bottom: 4px; }
.cdw__q-text { display: block; }
.cdw__right { position: sticky; top: 92px; }
.cdw__mode { display: inline-flex; gap: 4px; background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 8px; padding: 4px; margin-bottom: 14px; }
.cdw__mode-btn { background: none; border: none; padding: 7px 18px; font-family: var(--font-sans, sans-serif); font-size: 12.5px; font-weight: 700; color: var(--color-text-muted, #94a3b8); border-radius: 5px; cursor: pointer; }
.cdw__mode-btn.is-active { background: var(--cdw-accent); color: #0d1117; }
.cdw__card { position: relative; background: var(--color-bg-secondary, #1e293b); border: 1px solid var(--color-border, rgba(255,255,255,0.08)); border-radius: 12px; overflow: hidden; min-height: 520px; box-shadow: 0 10px 40px rgba(0,0,0,0.25); }
.cdw__spinner { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 14px; background: var(--color-bg-secondary, #1e293b); z-index: 2; color: var(--color-text-muted, #94a3b8); font-size: 13px; font-weight: 700; }
.cdw__spinner.is-hidden { display: none; }
.cdw__spin { width: 36px; height: 36px; border: 3px solid rgba(0,201,177,0.2); border-top-color: var(--cdw-accent); border-radius: 50%; animation: cdw-spin .8s linear infinite; }
@keyframes cdw-spin { to { transform: rotate(360deg); } }
@media (max-width: 900px) { .cdw__grid { grid-template-columns: 1fr; gap: 28px; } .cdw__right { position: static; } }
</style>
<?php endif; ?>

<section class="cdw" data-api-key="<?php echo esc_attr( $api_key ); ?>" data-widget-src="<?php echo esc_url( $widget_src ); ?>" style="--cdw-accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="cdw__inner">
		<div class="cdw__grid">

			<div class="cdw__left">
				<h2 class="cdw__title"><?php echo esc_html( $project ); ?></h2>
				<?php if ( $subhead ) : ?><p class="cdw__sub"><?php echo esc_html( $subhead ); ?></p><?php endif; ?>

				<?php if ( $tips ) : ?>
				<div class="cdw__tips">
					<p class="cdw__tips-lead">Try searching like your customers would:</p>
					<ul class="cdw__tips-list">
						<?php foreach ( $tips as $tip ) : ?>
						<li class="cdw__tip">
							<span class="cdw__tip-label">
								<span class="cdw__tip-icon cdw__tip-icon--<?php echo esc_attr( $tip['cls'] ); ?>"><?php echo $tip['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted hardcoded icon markup ?></span>
								<span><?php echo wp_kses_post( $tip['html'] ); ?></span>
							</span>
							<?php if ( 'voice' === $tip['cls'] ) : ?>
								<button class="cdw__tip-btn cdw-mic-btn" type="button" aria-label="Start voice search" data-fallback="<?php echo esc_attr( $tip['fallback'] ?? '' ); ?>"><?php echo $mic_svg; // phpcs:ignore ?> Speak</button>
							<?php elseif ( ! empty( $tip['query'] ) ) : ?>
								<button class="cdw__tip-btn cdw-try" type="button" data-query="<?php echo esc_attr( $tip['query'] ); ?>">Try It</button>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php if ( $questions ) : ?>
					<?php if ( $has_es ) : ?>
					<div class="cdw__lang" role="group" aria-label="Question language">
						<button type="button" class="cdw__lang-btn is-active" data-lang="en" aria-pressed="true">English</button>
						<button type="button" class="cdw__lang-btn" data-lang="es" aria-pressed="false">Español</button>
					</div>
					<?php endif; ?>
					<div class="cdw__qlist">
						<?php
						foreach ( $questions as $q ) :
							$qt  = $q['q_text'] ?? '';
							$qq  = ! empty( $q['q_query'] ) ? $q['q_query'] : $qt;
							$qte = ! empty( $q['q_text_es'] ) ? $q['q_text_es'] : $qt;
							$qqe = ! empty( $q['q_query_es'] ) ? $q['q_query_es'] : $qq;
						?>
						<button class="cdw__q cdw-try" type="button"
							data-query-en="<?php echo esc_attr( $qq ); ?>"
							data-query-es="<?php echo esc_attr( $qqe ); ?>"
							data-query="<?php echo esc_attr( $qq ); ?>">
							<?php if ( ! empty( $q['q_label'] ) ) : ?>
							<span class="cdw__q-label"><?php echo esc_html( $q['q_label'] ); ?></span>
							<?php endif; ?>
							<span class="cdw__q-text" data-en="<?php echo esc_attr( $qt ); ?>" data-es="<?php echo esc_attr( $qte ); ?>"><?php echo esc_html( $qt ); ?></span>
						</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="cdw__right">
				<div class="cdw__mode" aria-label="Widget display mode">
					<button class="cdw__mode-btn is-active" type="button" data-mode="inline">Inline</button>
					<button class="cdw__mode-btn" type="button" data-mode="bubble">Bubble</button>
				</div>
				<div class="cdw__card" id="cdw-card">
					<div class="cdw__spinner" id="cdw-spinner" role="status" aria-label="Loading widget">
						<div class="cdw__spin"></div><span>Loading&hellip;</span>
					</div>
					<div id="chatsku-widget" style="width:100%;height:560px;"></div>
				</div>
			</div>

		</div>
	</div>
</section>

<?php if ( $print_assets ) : ?>
<script>
(function () {
	var root = document.querySelector('.cdw');
	if (!root) return;
	var WIDGET_SRC = root.getAttribute('data-widget-src') || 'https://app.chatsku.com/widget/widget.js';
	var WIDGET_API_KEY = root.getAttribute('data-api-key') || '';
	var activeMode = 'inline';
	var bodySnapshot = null;

	function loadWidget(containerId, mode, spinnerId) {
		[window.ChatSKU, window.chatsku, window.ImpelHub, window.impelhub].forEach(function (api) {
			if (api) {
				['destroy', 'unmount', 'teardown'].forEach(function (m) { if (typeof api[m] === 'function') { try { api[m](); } catch (e) {} } });
			}
		});
		document.querySelectorAll('script[data-chatsku-widget]').forEach(function (s) { s.parentNode.removeChild(s); });
		if (bodySnapshot) {
			Array.from(document.body.children).forEach(function (el) { if (!bodySnapshot.has(el)) { el.parentNode && el.parentNode.removeChild(el); } });
		}
		var c = document.getElementById(containerId); if (c) c.innerHTML = '';
		var sp = document.getElementById(spinnerId); if (sp) sp.classList.remove('is-hidden');
		var s = document.createElement('script');
		s.src = WIDGET_SRC;
		s.setAttribute('data-api-key', WIDGET_API_KEY);
		s.setAttribute('data-embed', mode);
		s.setAttribute('data-container', containerId);
		s.setAttribute('data-chatsku-widget', '1');
		s.async = true;
		s.onload = function () { setTimeout(function () { if (sp) sp.classList.add('is-hidden'); }, 1500); };
		s.onerror = function () { if (sp) sp.classList.add('is-hidden'); };
		document.body.appendChild(s);
	}

	function injectTextIntoWidget(query) {
		var roots = [document.getElementById('chatsku-widget'), document], input = null;
		for (var i = 0; i < roots.length; i++) {
			var r = roots[i]; if (!r) continue;
			var cand = r.querySelector('#ciq-input') || r.querySelector('input[type="text"]') || r.querySelector('textarea');
			if (cand) { input = cand; break; }
			var fr = r.querySelectorAll('iframe');
			for (var j = 0; j < fr.length; j++) {
				try {
					var d = fr[j].contentDocument || fr[j].contentWindow.document;
					cand = d.querySelector('#ciq-input') || d.querySelector('input[type="text"]') || d.querySelector('textarea');
					if (cand) { input = cand; break; }
				} catch (e) {}
				if (input) break;
			}
			if (input) break;
		}
		if (!input) return;
		var setter = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value') || Object.getOwnPropertyDescriptor(window.HTMLTextAreaElement.prototype, 'value');
		if (setter && setter.set) { setter.set.call(input, query); } else { input.value = query; }
		input.dispatchEvent(new Event('input', { bubbles: true }));
		input.dispatchEvent(new Event('change', { bubbles: true }));
		input.focus();
	}

	root.addEventListener('click', function (e) {
		var btn = e.target.closest('.cdw-try'); if (!btn) return;
		var q = btn.getAttribute('data-query'); if (q) injectTextIntoWidget(q);
	});

	root.querySelectorAll('.cdw-mic-btn').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var SR = window.SpeechRecognition || window.webkitSpeechRecognition;
			var fb = btn.getAttribute('data-fallback') || '';
			if (!SR) { if (fb) injectTextIntoWidget(fb); return; }
			var rec = new SR(); rec.lang = 'en-US'; rec.interimResults = false; rec.maxAlternatives = 1;
			btn.classList.add('is-listening');
			rec.onresult = function (ev) { var t = ev.results && ev.results[0] && ev.results[0][0] && ev.results[0][0].transcript; if (t) injectTextIntoWidget(t); };
			rec.onerror = function () { if (fb) injectTextIntoWidget(fb); };
			rec.onend = function () { btn.classList.remove('is-listening'); };
			try { rec.start(); } catch (e) { btn.classList.remove('is-listening'); if (fb) injectTextIntoWidget(fb); }
		});
	});

	root.querySelectorAll('.cdw__mode-btn').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var m = btn.getAttribute('data-mode'); if (m === activeMode) return;
			activeMode = m;
			root.querySelectorAll('.cdw__mode-btn').forEach(function (b) { b.classList.remove('is-active'); });
			btn.classList.add('is-active');
			loadWidget('chatsku-widget', activeMode, 'cdw-spinner');
		});
	});

	function setLang(lang) {
		var S = lang === 'es' ? 'es' : 'en';
		root.querySelectorAll('.cdw__q').forEach(function (q) {
			var t = q.querySelector('.cdw__q-text');
			if (t && t.dataset[S]) t.textContent = t.dataset[S];
			q.dataset.query = q.getAttribute('data-query-' + S) || q.getAttribute('data-query-en');
		});
		root.querySelectorAll('.cdw__lang-btn').forEach(function (b) {
			var on = b.dataset.lang === S;
			b.classList.toggle('is-active', on);
			b.setAttribute('aria-pressed', on ? 'true' : 'false');
		});
	}
	root.querySelectorAll('.cdw__lang-btn').forEach(function (b) { b.addEventListener('click', function () { setLang(b.dataset.lang); }); });
	setLang('en');

	bodySnapshot = new Set(Array.from(document.body.children));
	loadWidget('chatsku-widget', activeMode, 'cdw-spinner');
})();
</script>
<?php endif; ?>
