<?php
/**
 * Template Name: Demo — BioSignal²
 * Template Post Type: page
 *
 * Standalone, BioSignal²-branded ChatSKU demo page (mirrors biosignal2.com).
 * Canvas template — no theme header/footer (the demo ships its own nav + footer).
 * Adds a live interactive widget section: left = clickable sample questions,
 * right = the live ChatSKU chat widget (same mechanism as page-demo.php).
 *
 * To clone for another company: copy this file, swap the brand CSS/content and the
 * WIDGET_API_KEY, then add a child page under "Demo" with this template.
 *
 * @package ChatSKU
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ChatSKU Demo — BioSignal² Inc</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet" />
  <?php wp_head(); ?>
  <style>
    /* ── BIOSIGNAL² BRAND TOKENS ── */
    :root {
      --blue:       #2563A8;   /* primary brand blue — hero panel, nav hover */
      --blue-dk:    #1A4A80;
      --blue-lt:    #EBF3FB;
      --blue-mid:   #4A89C8;
      --blue-teal:  #2B9FD4;   /* ENLIGHT italic accent */
      --red:        #CC2200;   /* red bead accent */
      --red-lt:     #FFF0EE;
      --gray-bg:    #F2F2F2;   /* card background */
      --gray-rule:  #DDDDDD;
      --gray-md:    #888888;
      --near-black: #333333;
      --body-txt:   #555555;
      --white:      #FFFFFF;
      --green:      #2E7D32;
      --font-body:  'Lato', sans-serif;
      --font-serif: 'Merriweather', Georgia, serif;
      --r:          4px;
      --r-lg:       8px;
      --shadow:     0 2px 8px rgba(37,99,168,0.10);
      --shadow-md:  0 4px 20px rgba(37,99,168,0.14);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body.chatsku-demo-biosignal2 { font-family: var(--font-body) !important; background: var(--white) !important; color: var(--body-txt) !important; overflow-x: hidden; line-height: 1.65; font-size: 15px; }

    /* ── DEMO NOTICE ── */
    .demo-bar { background: #FFF8E6; border-bottom: 1px solid #F0D060; text-align: center; padding: 9px 20px; font-size: 12.5px; color: #7A5000; font-weight: 700; font-family: var(--font-body); letter-spacing: 0.02em; }

    /* ── NAV ── */
    nav { background: var(--white); border-bottom: 1px solid var(--gray-rule); position: sticky; top: 0; z-index: 900; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
    .nav-inner { max-width: 1200px; margin: 0 auto; padding: 0 32px; height: 72px; display: flex; align-items: center; gap: 28px; }
    /* Logo recreation */
    .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0; }
    .logo-icon { position: relative; width: 52px; height: 52px; flex-shrink: 0; }
    .logo-icon .ring { width: 48px; height: 48px; border: 4px solid var(--blue-mid); border-radius: 50%; position: absolute; top: 0; left: 0; }
    .logo-icon .ring-inner { width: 28px; height: 28px; border: 3px solid var(--blue-teal); border-radius: 50%; position: absolute; top: 8px; left: 8px; }
    .logo-icon .ball { width: 18px; height: 18px; background: radial-gradient(circle at 35% 35%, #FF5533, var(--red)); border-radius: 50%; position: absolute; bottom: 2px; right: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    .logo-text .main { font-family: var(--font-serif); font-size: 16px; font-weight: 700; font-style: italic; color: var(--blue); line-height: 1.15; display: block; letter-spacing: 0.01em; }
    .logo-text .main sup { font-size: 10px; vertical-align: super; }
    .logo-text .sub { font-family: var(--font-body); font-size: 10px; font-weight: 300; color: var(--gray-md); letter-spacing: 0.08em; text-transform: uppercase; display: block; margin-top: 1px; }
    .nav-links { display: flex; gap: 2px; margin-left: 16px; }
    .nav-links a { color: var(--near-black); text-decoration: none; font-size: 14px; font-weight: 400; padding: 6px 14px; border-radius: var(--r); transition: color 0.15s, background 0.15s; }
    .nav-links a:hover { color: var(--blue); background: var(--blue-lt); }
    .nav-right { margin-left: auto; display: flex; gap: 10px; align-items: center; }
    .btn-blue { background: var(--blue); color: #fff; border: none; border-radius: var(--r); padding: 9px 22px; font-family: var(--font-body); font-size: 13.5px; font-weight: 700; text-decoration: none; cursor: pointer; transition: background 0.15s; display: inline-flex; align-items: center; gap: 6px; }
    .btn-blue:hover { background: var(--blue-dk); }
    .btn-outline { background: transparent; color: var(--blue); border: 2px solid var(--blue); border-radius: var(--r); padding: 8px 20px; font-family: var(--font-body); font-size: 13.5px; font-weight: 700; text-decoration: none; cursor: pointer; transition: background 0.15s, color 0.15s; display: inline-flex; align-items: center; }
    .btn-outline:hover { background: var(--blue); color: #fff; }

    /* ── HERO — blue panel over lab photography ── */
    .hero { position: relative; height: 380px; overflow: hidden; background: linear-gradient(110deg, #B8D4F0 0%, #C8E4FF 40%, #D8EEFF 60%, #AACCE8 100%); }
    .hero-bg { position: absolute; inset: 0; }
    .hero-bg::before {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(ellipse 80px 120px at 10% 60%, rgba(100,170,230,0.4) 0%, transparent 70%),
        radial-gradient(ellipse 60px 100px at 25% 70%, rgba(60,130,210,0.3) 0%, transparent 70%),
        radial-gradient(ellipse 50px 90px at 50% 80%, rgba(80,150,220,0.35) 0%, transparent 60%),
        radial-gradient(ellipse 55px 95px at 70% 65%, rgba(100,160,225,0.3) 0%, transparent 60%),
        radial-gradient(ellipse 45px 85px at 87% 72%, rgba(90,155,220,0.3) 0%, transparent 60%),
        radial-gradient(ellipse 200px 200px at 15% 20%, rgba(180,210,240,0.5) 0%, transparent 60%),
        radial-gradient(ellipse 300px 200px at 80% 10%, rgba(200,225,248,0.6) 0%, transparent 60%);
    }
    .hero-bg::after {
      content: '';
      position: absolute; inset: 0;
      background: repeating-linear-gradient(180deg, transparent 0px, transparent 60px, rgba(130,180,230,0.15) 60px, rgba(130,180,230,0.15) 62px);
    }
    .hero-panel {
      position: absolute;
      left: 18%;
      top: 0; bottom: 0;
      width: 340px;
      background: rgba(37,99,168,0.92);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px 40px 40px 44px;
      z-index: 2;
    }
    .hero-panel .tag { font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.55); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .hero-panel .tag::before { content: ''; width: 16px; height: 2px; background: rgba(255,255,255,0.4); display: inline-block; }
    .hero-panel h1 { font-family: var(--font-body); font-weight: 300; font-size: 22px; color: rgba(255,255,255,0.9); line-height: 1.45; margin-bottom: 8px; }
    .hero-panel h1 strong { font-weight: 900; font-size: 30px; color: #fff; display: block; line-height: 1.2; }
    .hero-panel h1 em { font-style: normal; color: #7ECFEE; }
    .hero-panel .hero-sub { font-size: 13.5px; color: rgba(255,255,255,0.65); line-height: 1.65; margin-top: 14px; }
    .hero-panel .hero-btns { display: flex; gap: 10px; margin-top: 24px; flex-wrap: wrap; }
    .hero-btn { background: #fff; color: var(--blue); padding: 10px 20px; border-radius: var(--r); font-weight: 700; font-size: 13px; text-decoration: none; transition: transform 0.1s, box-shadow 0.1s; display: inline-block; }
    .hero-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    .hero-btn.ghost { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.4); }
    .hero-btn.ghost:hover { background: rgba(255,255,255,0.25); }

    /* ── LIVE WIDGET DEMO SECTION (left questions / right live chat) ── */
    .bs-demo-section { background: var(--gray-bg); border-top: 1px solid var(--gray-rule); border-bottom: 1px solid var(--gray-rule); }
    .bs-demo-grid { display: grid; grid-template-columns: 1fr 1.05fr; gap: 40px; align-items: start; }
    .bs-demo-left .lead { margin-bottom: 0; }
    .bs-q-list { display: flex; flex-direction: column; gap: 10px; margin-top: 24px; }
    .demo-try-btn { display: block; width: 100%; text-align: left; background: var(--white); border: 1px solid var(--gray-rule); border-left: 3px solid var(--blue-mid); border-radius: var(--r); padding: 13px 16px; font-family: var(--font-body); font-size: 13.5px; color: var(--near-black); line-height: 1.55; cursor: pointer; transition: border-color 0.15s, box-shadow 0.15s, transform 0.1s; }
    .demo-try-btn:hover { border-color: var(--blue); box-shadow: var(--shadow); transform: translateX(2px); }
    .demo-try-btn .demo-try-label { display: block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--blue-mid); margin-bottom: 4px; }
    .bs-demo-right { position: sticky; top: 92px; }
    .demo-mode-toggle { display: inline-flex; gap: 4px; background: var(--white); border: 1px solid var(--gray-rule); border-radius: var(--r); padding: 4px; margin-bottom: 14px; }
    .demo-mode-btn { background: none; border: none; padding: 7px 18px; font-family: var(--font-body); font-size: 12.5px; font-weight: 700; color: var(--gray-md); border-radius: 3px; cursor: pointer; transition: background 0.15s, color 0.15s; }
    .demo-mode-btn--active { background: var(--blue); color: #fff; }
    .demo-widget-card { position: relative; background: var(--white); border: 1px solid var(--gray-rule); border-radius: var(--r-lg); box-shadow: var(--shadow-md); overflow: hidden; min-height: 520px; }
    .demo-widget-spinner { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 14px; background: var(--white); z-index: 2; color: var(--gray-md); font-size: 13px; font-weight: 700; }
    .demo-widget-spinner.is-hidden { display: none; }
    .demo-spinner { width: 36px; height: 36px; border: 3px solid var(--blue-lt); border-top-color: var(--blue); border-radius: 50%; animation: bs-spin 0.8s linear infinite; }
    @keyframes bs-spin { to { transform: rotate(360deg); } }

    /* ── Search-capability tips (spelling / voice / synonyms) ── */
    .bs-tips { background: var(--white); border: 1px solid var(--gray-rule); border-radius: var(--r-lg); padding: 20px 22px; margin-top: 24px; }
    .bs-tips__lead { font-size: 13px; font-weight: 700; color: var(--near-black); margin-bottom: 14px; }
    .bs-tips__list { list-style: none; display: flex; flex-direction: column; gap: 14px; }
    .bs-tip { display: flex; align-items: flex-start; justify-content: space-between; gap: 14px; }
    .bs-tip__label { flex: 1 1 auto; min-width: 0; display: flex; gap: 10px; align-items: flex-start; font-size: 13px; color: var(--body-txt); line-height: 1.5; }
    .bs-tip__label strong { color: var(--near-black); }
    .bs-tip__label code { background: var(--blue-lt); color: var(--blue-dk); font-family: 'IBM Plex Mono', monospace; font-size: 12px; padding: 1px 6px; border-radius: 3px; }
    .bs-tip__label em { color: var(--blue-teal); font-style: italic; font-weight: 700; }
    .bs-tip__icon { flex-shrink: 0; width: 26px; height: 26px; border-radius: var(--r); display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 900; color: var(--blue); background: var(--blue-lt); border: 1px solid rgba(37,99,168,0.2); }
    .bs-tip__icon--mic { color: var(--blue-teal); }
    .bs-tip__icon--synonym { font-size: 15px; }
    /* width:auto / flex:none override .demo-try-btn's display:block; width:100% (shared class) */
    .bs-tip__btn { flex: 0 0 auto; width: auto; min-width: 0; background: transparent; color: var(--blue); border: 1.5px solid var(--blue); border-radius: var(--r); padding: 6px 14px; margin: 0; font-family: var(--font-body); font-size: 12px; font-weight: 700; line-height: 1.2; text-align: center; cursor: pointer; transition: background 0.15s, color 0.15s; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap; }
    .bs-tip__btn:hover { background: var(--blue); color: #fff; transform: none; box-shadow: none; }
    .demo-mic-btn.is-listening { background: var(--red); border-color: var(--red); color: #fff; animation: bs-mic-pulse 1.2s ease-in-out infinite; }
    @keyframes bs-mic-pulse { 0%,100% { box-shadow: 0 0 0 0 rgba(204,34,0,.45); } 50% { box-shadow: 0 0 0 6px rgba(204,34,0,0); } }

    /* ── SHARED ── */
    section { padding: 64px 0; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 32px; }
    .section-tag { font-size: 11px; font-weight: 700; color: var(--blue-mid); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
    .section-tag::before { content: ''; width: 20px; height: 2px; background: var(--blue-mid); border-radius: 2px; display: inline-block; }
    h2 { font-family: var(--font-body); font-size: clamp(24px, 3vw, 36px); font-weight: 700; color: var(--near-black); line-height: 1.2; margin-bottom: 14px; letter-spacing: -0.01em; }
    h2 em { font-style: normal; color: var(--blue); }
    .lead { font-size: 15.5px; color: var(--body-txt); line-height: 1.75; max-width: 620px; margin-bottom: 14px; }
    .lead strong { color: var(--near-black); }
    .lead a { color: var(--blue); text-decoration: none; font-weight: 700; }

    /* ── HOME CARDS ── */
    .home-cards { background: var(--gray-bg); border-top: 1px solid var(--gray-rule); border-bottom: 1px solid var(--gray-rule); }
    .home-cards-inner { max-width: 1200px; margin: 0 auto; padding: 0 32px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--gray-rule); }
    .hc { background: var(--gray-bg); padding: 36px 32px; }
    .hc h3 { font-family: var(--font-body); font-size: 22px; font-weight: 300; color: var(--near-black); margin-bottom: 14px; letter-spacing: -0.01em; }
    .hc p { font-size: 13.5px; color: var(--body-txt); line-height: 1.75; }
    .hc p em { font-family: var(--font-serif); font-style: italic; font-weight: 400; color: var(--near-black); font-size: 13px; }
    .hc p a { color: var(--blue); text-decoration: none; font-weight: 700; }
    .hc p a:hover { text-decoration: underline; }
    .hc-btn { display: inline-flex; align-items: center; gap: 6px; margin-top: 18px; color: var(--blue); font-size: 13px; font-weight: 700; text-decoration: none; border-bottom: 1px solid transparent; transition: border-color 0.15s; }
    .hc-btn:hover { border-color: var(--blue); }

    /* ── PRODUCT TECHNOLOGIES ── */
    .tech-section { background: var(--white); }
    .tech-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .tech-card { background: var(--gray-bg); border-radius: var(--r-lg); padding: 28px 24px; border: 1px solid var(--gray-rule); transition: border-color 0.15s, box-shadow 0.15s; }
    .tech-card:hover { border-color: var(--blue-mid); box-shadow: var(--shadow); }
    .tech-badge { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px; }
    .tech-ball { width: 18px; height: 18px; border-radius: 50%; flex-shrink: 0; }
    .tech-ball.blue { background: radial-gradient(circle at 35% 35%, var(--blue-teal), var(--blue)); }
    .tech-ball.red { background: radial-gradient(circle at 35% 35%, #FF5533, var(--red)); }
    .tech-ball.teal { background: radial-gradient(circle at 35% 35%, #60D0F0, var(--blue-teal)); }
    .tech-name { font-size: 13px; font-weight: 900; color: var(--near-black); letter-spacing: 0.04em; text-transform: uppercase; }
    .tech-name span { color: var(--blue); }
    .tech-card h3 { font-size: 16px; font-weight: 700; color: var(--near-black); margin-bottom: 10px; }
    .tech-card p { font-size: 13px; color: var(--body-txt); line-height: 1.7; }
    .tech-card ul { font-size: 12.5px; color: var(--body-txt); line-height: 1.7; padding-left: 16px; margin-top: 10px; }

    /* ── PRODUCT CATALOG GRID ── */
    .cat-section { background: var(--gray-bg); border-top: 1px solid var(--gray-rule); border-bottom: 1px solid var(--gray-rule); }
    .cat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
    .cat-card { background: var(--white); border: 1px solid var(--gray-rule); border-radius: var(--r-lg); padding: 20px 18px; transition: border-color 0.15s, box-shadow 0.15s, transform 0.1s; }
    .cat-card:hover { border-color: var(--blue-mid); box-shadow: var(--shadow); transform: translateY(-2px); }
    .cat-card .cat-icon { font-size: 22px; margin-bottom: 10px; display: block; }
    .cat-card h4 { font-size: 13.5px; font-weight: 700; color: var(--near-black); margin-bottom: 5px; }
    .cat-card .cat-id { font-size: 10.5px; font-weight: 700; color: var(--blue-mid); letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 6px; display: block; }
    .cat-card p { font-size: 12px; color: var(--body-txt); line-height: 1.6; }
    .cat-link { display: inline-block; color: var(--blue); font-size: 12px; font-weight: 700; margin-top: 10px; text-decoration: none; }
    .cat-link:hover { text-decoration: underline; }

    /* ── CHATSKU FIT ── */
    .fit-section { background: var(--white); }
    .fit-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
    .fit-reasons { display: flex; flex-direction: column; gap: 20px; }
    .fit-item { display: flex; gap: 16px; align-items: flex-start; background: var(--gray-bg); border: 1px solid var(--gray-rule); border-radius: var(--r-lg); padding: 20px 20px; }
    .fit-icon { width: 36px; height: 36px; background: var(--blue-lt); border: 1px solid rgba(37,99,168,0.2); border-radius: var(--r); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .fit-text h4 { font-size: 14px; font-weight: 700; color: var(--near-black); margin-bottom: 4px; }
    .fit-text p { font-size: 13px; color: var(--body-txt); line-height: 1.65; }

    /* ── SAMPLE QUERIES ── */
    .queries-section { background: var(--blue); padding: 72px 0; }
    .queries-section .section-tag { color: rgba(255,255,255,0.5); }
    .queries-section .section-tag::before { background: rgba(255,255,255,0.3); }
    .queries-section h2 { color: #fff; }
    .queries-section h2 em { color: #7ECFEE; }
    .queries-section .lead { color: rgba(255,255,255,0.7); max-width: 600px; }
    .queries-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-top: 40px; }
    .query-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: var(--r-lg); padding: 0; overflow: hidden; transition: background 0.15s; }
    .query-card:hover { background: rgba(255,255,255,0.12); }
    .query-q { padding: 16px 20px 12px; }
    .query-label { font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.4); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .query-label::before { content: '👤'; font-size: 12px; }
    .query-q p { font-size: 14px; font-weight: 600; color: rgba(255,255,255,0.92); line-height: 1.55; font-style: italic; }
    .query-a { background: rgba(0,0,0,0.15); padding: 12px 20px 16px; border-top: 1px solid rgba(255,255,255,0.1); }
    .query-a-label { font-size: 10px; font-weight: 700; color: #7ECFEE; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .query-a-label::before { content: '🤖'; font-size: 12px; }
    .query-a p { font-size: 13px; color: rgba(255,255,255,0.75); line-height: 1.6; }
    .query-a p strong { color: #7ECFEE; font-weight: 700; }
    .query-a .cat-ref { display: inline-block; background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.85); font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 3px; margin-top: 6px; font-family: monospace; letter-spacing: 0.05em; }

    /* ── BEFORE/AFTER ── */
    .ba-section { background: var(--white); }
    table { width: 100%; border-collapse: collapse; border: 1px solid var(--gray-rule); border-radius: var(--r-lg); overflow: hidden; box-shadow: var(--shadow); }
    thead th { padding: 13px 18px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; text-align: left; }
    thead th:first-child { background: var(--near-black); color: rgba(255,255,255,0.5); width: 36px; }
    thead th:nth-child(2) { background: #4A1A14; color: rgba(255,255,255,0.9); border-right: 1px solid rgba(255,255,255,0.1); }
    thead th:nth-child(3) { background: #1A4A2C; color: rgba(255,255,255,0.9); }
    tbody tr { border-bottom: 1px solid var(--gray-rule); }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--gray-bg); }
    tbody td { padding: 12px 18px; font-size: 13.5px; color: var(--body-txt); vertical-align: top; line-height: 1.55; }
    tbody td:nth-child(2) { border-right: 1px solid var(--gray-rule); }
    tbody td:nth-child(3) { color: var(--near-black); font-weight: 500; }
    .bad { color: var(--red); font-weight: 700; }
    .good { color: var(--green); font-weight: 700; }

    /* ── HOW IT WORKS ── */
    .how-section { background: var(--gray-bg); border-top: 1px solid var(--gray-rule); border-bottom: 1px solid var(--gray-rule); }
    .steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .step-card { background: var(--white); border: 1px solid var(--gray-rule); border-radius: var(--r-lg); padding: 28px 24px; transition: border-color 0.15s, box-shadow 0.15s; }
    .step-card:hover { border-color: var(--blue-mid); box-shadow: var(--shadow); }
    .step-num { width: 38px; height: 38px; background: var(--blue); color: #fff; font-size: 16px; font-weight: 700; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 16px; }
    .step-card h3 { font-size: 16px; font-weight: 700; color: var(--near-black); margin-bottom: 10px; }
    .step-card p { font-size: 13.5px; color: var(--body-txt); line-height: 1.7; margin-bottom: 12px; }
    .step-meta { font-size: 12px; color: var(--green); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }

    /* ── NOTE ── */
    .note-section { background: var(--white); }
    .note-card { background: var(--gray-bg); border: 1px solid var(--gray-rule); border-left: 4px solid var(--blue); border-radius: var(--r-lg); padding: 36px 44px; max-width: 800px; }
    .note-card blockquote { font-size: 16px; line-height: 1.85; color: var(--body-txt); margin-bottom: 22px; font-style: italic; }
    .note-sig { font-size: 14px; font-weight: 700; color: var(--near-black); }
    .note-sig span { color: var(--gray-md); font-weight: 400; }

    /* ── FAQ ── */
    .faq-section { background: var(--gray-bg); border-top: 1px solid var(--gray-rule); }
    .faq-list { max-width: 720px; }
    .faq-item { border-bottom: 1px solid var(--gray-rule); background: var(--white); margin-bottom: 2px; border-radius: var(--r); }
    .faq-q { width: 100%; background: none; border: none; color: var(--near-black); font-family: var(--font-body); font-size: 15px; font-weight: 700; padding: 17px 20px; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: color 0.15s; border-radius: var(--r); }
    .faq-q:hover { color: var(--blue); }
    .faq-ch { font-size: 16px; transition: transform 0.3s; color: var(--blue); flex-shrink: 0; margin-left: 16px; }
    .faq-a { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
    .faq-a p { font-size: 14px; color: var(--body-txt); padding: 0 20px 18px; line-height: 1.75; border-top: 1px solid var(--gray-rule); padding-top: 14px; }
    .faq-item.open .faq-a { max-height: 250px; }
    .faq-item.open .faq-ch { transform: rotate(180deg); }

    /* ── CTA ── */
    .cta-band { background: var(--blue); padding: 72px 32px; text-align: center; }
    .cta-band h2 { color: #fff; margin-bottom: 14px; }
    .cta-band p { color: rgba(255,255,255,0.75); margin-bottom: 36px; font-size: 17px; max-width: 520px; margin-left: auto; margin-right: auto; }
    .btn-white { background: #fff; color: var(--blue); padding: 14px 36px; border-radius: var(--r); font-weight: 700; font-size: 14px; text-decoration: none; display: inline-block; transition: transform 0.12s, box-shadow 0.12s; letter-spacing: 0.02em; }
    .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.18); }

    /* ── FOOTER ── */
    footer { background: var(--near-black); padding: 52px 32px 32px; border-top: 3px solid var(--blue); }
    .foot-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; max-width: 1200px; margin: 0 auto; }
    .foot-brand .name { font-family: var(--font-serif); font-size: 16px; font-weight: 700; font-style: italic; color: #fff; margin-bottom: 4px; display: block; }
    .foot-brand .name sup { font-size: 10px; vertical-align: super; }
    .foot-brand .tagline { font-size: 10px; font-weight: 300; color: rgba(255,255,255,0.4); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 14px; display: block; }
    .foot-brand p { font-size: 13px; color: rgba(255,255,255,0.5); line-height: 1.7; max-width: 280px; }
    .foot-contact { margin-top: 14px; font-size: 12.5px; color: rgba(255,255,255,0.35); line-height: 1.9; }
    .foot-col h4 { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 14px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 8px; }
    .foot-col a { display: block; color: rgba(255,255,255,0.6); text-decoration: none; font-size: 13.5px; margin-bottom: 8px; transition: color 0.15s; }
    .foot-col a:hover { color: #fff; }
    .foot-bottom { max-width: 1200px; margin: 36px auto 0; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: rgba(255,255,255,0.3); }
    .foot-bottom a { color: rgba(255,255,255,0.5); text-decoration: none; }

    /* RESPONSIVE */
    @media (max-width: 960px) {
      .home-cards-inner { grid-template-columns: 1fr; }
      .tech-grid, .steps-grid { grid-template-columns: 1fr; }
      .fit-grid { grid-template-columns: 1fr; }
      .cat-grid { grid-template-columns: repeat(2, 1fr); }
      .queries-grid { grid-template-columns: 1fr; }
      .foot-grid { grid-template-columns: 1fr 1fr; }
      .hero-panel { left: 0; width: 100%; background: rgba(37,99,168,0.88); }
      .nav-links { display: none; }
      .bs-demo-grid { grid-template-columns: 1fr; gap: 28px; }
      .bs-demo-right { position: static; }
    }
  </style>
</head>
<body <?php body_class( 'chatsku-demo-biosignal2' ); ?>>
<?php wp_body_open(); ?>

<!-- DEMO NOTICE -->
<div class="demo-bar">
  ⚗️ ChatSKU Demo — AI Research Assistant preview for BioSignal² Inc. Not the live biosignal2.com site.
</div>

<!-- NAV — mirrors biosignal2.com exactly -->
<nav>
  <div class="nav-inner">
    <a class="nav-logo" href="#">
      <div class="logo-icon">
        <div class="ring"></div>
        <div class="ring-inner"></div>
        <div class="ball"></div>
      </div>
      <div class="logo-text">
        <span class="main">BioSignal<sup>2</sup> Inc</span>
        <span class="sub">Quality &amp; Innovation</span>
      </div>
    </a>
    <div class="nav-links">
      <a href="#">About Us</a>
      <a href="#">Products</a>
      <a href="#">Services</a>
      <a href="#">News</a>
      <a href="#">Contact us</a>
      <a href="#">e-Store</a>
    </div>
    <div class="nav-right">
      <a href="#" class="btn-outline">e-Store</a>
      <a href="mailto:sales@chatsku.com" class="btn-blue">Book a Demo</a>
    </div>
  </div>
</nav>

<!-- HERO — blue panel + lab photography background -->
<div class="hero">
  <div class="hero-bg"></div>
  <div class="hero-panel">
    <div class="tag">ChatSKU — AI Research Assistant Demo</div>
    <h1>
      Quality &amp; Innovative Solutions for your<br>
      <strong>R&amp;D <em>Endeavours</em></strong>
    </h1>
    <p class="hero-sub">ChatSKU gives BioSignal²'s global research customers instant answers on EnLIGHT OMEGA, UniLISA, and TR-FRET reagents — 24/7, with technical depth.</p>
    <div class="hero-btns">
      <a href="#try-chatsku" class="hero-btn">Try ChatSKU Live</a>
      <a href="#how" class="hero-btn ghost">How It Works</a>
    </div>
  </div>
</div>

<!-- ══ LIVE INTERACTIVE WIDGET — left questions / right live chat ══ -->
<section class="bs-demo-section" id="try-chatsku">
  <div class="container">
    <div class="bs-demo-grid">

      <!-- LEFT — clickable sample questions -->
      <div class="bs-demo-left">
        <div class="section-tag">Try it live</div>
        <h2>Ask ChatSKU a Real<br><em>BioSignal² Question.</em></h2>
        <p class="lead">Search the way your customers do — or click a researcher question below. ChatSKU types it into the live assistant on the right and answers instantly from BioSignal²'s product and technical knowledge.</p>

        <!-- Search-capability tips (spelling / voice / synonyms) -->
        <div class="bs-tips" id="bs-search-tips">
          <p class="bs-tips__lead">Try searching like your customers would:</p>
          <ul class="bs-tips__list">
            <li class="bs-tip">
              <span class="bs-tip__label">
                <span class="bs-tip__icon bs-tip__icon--spelling">Aa</span>
                <span><strong>Spelling correction:</strong> Type <code>Streptavadin</code> instead of Streptavidin</span>
              </span>
              <button class="bs-tip__btn demo-try-btn" type="button" data-query="Streptavadin">Try It</button>
            </li>
            <li class="bs-tip">
              <span class="bs-tip__label">
                <span class="bs-tip__icon bs-tip__icon--mic">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                </span>
                <span><strong>Voice Input:</strong> Click the mic and say <em>TNF-alpha detection kit</em></span>
              </span>
              <button class="bs-tip__btn demo-mic-btn" type="button" aria-label="Start voice search" data-fallback="TNF-alpha detection kit">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                Speak
              </button>
            </li>
            <li class="bs-tip">
              <span class="bs-tip__label">
                <span class="bs-tip__icon bs-tip__icon--synonym">≈</span>
                <span><strong>Synonyms:</strong> Type <code>ELISA kit</code> — BioSignal² offers no-wash OMEGA &amp; UniLISA alternatives</span>
              </span>
              <button class="bs-tip__btn demo-try-btn" type="button" data-query="ELISA kit">Try It</button>
            </li>
          </ul>
        </div>

        <div class="bs-q-list">
          <button class="demo-try-btn" type="button" data-query="I have a His-tagged protein and I want to detect its interaction with a biotinylated ligand. Which BioSignal² beads should I use and in what configuration?">
            <span class="demo-try-label">Researcher asks</span>
            Which beads for a His-tagged protein + biotinylated ligand interaction?
          </button>
          <button class="demo-try-btn" type="button" data-query="We want to measure human TNF-alpha in cell culture supernatant using EnLIGHT OMEGA. Do you have a ready-to-use kit? What's the detection range?">
            <span class="demo-try-label">Procurement scientist asks</span>
            Do you have a ready-to-use Human TNF-α EnLIGHT OMEGA kit?
          </button>
          <button class="demo-try-btn" type="button" data-query="We're running a GPCR cAMP HTS campaign. Can I use BioSignal²'s TR-FRET assay in 384-well format? What reader do I need?">
            <span class="demo-try-label">Drug discovery scientist asks</span>
            Can I run the TR-FRET cAMP assay in 384-well HTS? Which reader?
          </button>
          <button class="demo-try-btn" type="button" data-query="What's the difference between EnLIGHT OMEGA and AlphaScreen? Why would I choose OMEGA over AlphaLISA for my protein-protein interaction assay?">
            <span class="demo-try-label">Lab manager asks</span>
            How does EnLIGHT OMEGA compare to AlphaScreen / AlphaLISA?
          </button>
          <button class="demo-try-btn" type="button" data-query="Can your OMEGA assay detect SARS-CoV-2 antibodies in saliva? How do I set it up?">
            <span class="demo-try-label">Biotech researcher asks</span>
            Can OMEGA detect SARS-CoV-2 antibodies in saliva?
          </button>
        </div>
      </div>

      <!-- RIGHT — live ChatSKU chat widget -->
      <div class="bs-demo-right">
        <div class="demo-mode-toggle" aria-label="Widget display mode">
          <button class="demo-mode-btn demo-mode-btn--active" type="button" data-mode="inline">Inline</button>
          <button class="demo-mode-btn" type="button" data-mode="bubble">Bubble</button>
        </div>
        <div class="demo-widget-card" id="demo-widget-card">
          <div class="demo-widget-spinner" id="demo-widget-spinner" role="status" aria-label="Loading widget">
            <div class="demo-spinner"></div>
            <span>Loading ChatSKU…</span>
          </div>
          <div id="chatsku-widget" style="width:100%; height:560px;"></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- HOME CARDS — mirrors their 3-column layout -->
<div class="home-cards">
  <div class="home-cards-inner">
    <div class="hc">
      <h3>Products</h3>
      <p><em>BioSignal²</em> manufactures high quality reagents based on the most performing assay technologies. All reagents undergo stringent quality controls to guarantee they will perform according to your requirements once used in your laboratory.</p>
      <a href="#products" class="hc-btn">Explore the catalog →</a>
    </div>
    <div class="hc">
      <h3>Services</h3>
      <p>We deliver a broad range of services in the pre-clinical space, including: <a href="#">assay development</a>, <a href="#">medium-throughput compound screening</a> and compound profiling on pre-determined target classes.</p>
      <a href="#" class="hc-btn">Learn more →</a>
    </div>
    <div class="hc">
      <h3>ChatSKU Fit</h3>
      <p>Your global customers — research scientists, procurement teams, CROs — need technical answers at 2 AM before a Monday experiment. ChatSKU is how BioSignal² becomes the first vendor to respond, every time.</p>
      <a href="#fit" class="hc-btn">See why it fits →</a>
    </div>
  </div>
</div>

<!-- TECHNOLOGY PLATFORMS -->
<section class="tech-section" id="products">
  <div class="container">
    <div class="section-tag">Technology platforms</div>
    <h2>Three Proprietary Platforms.<br><em>Hundreds of Validated Assays.</em></h2>
    <p class="lead" style="margin-bottom:36px;">BioSignal² has developed three distinct, patented assay technologies — each a powerful ELISA alternative — optimised for homogeneous, no-wash detection of biological targets at ultra-low concentrations.</p>
    <div class="tech-grid">
      <!-- ENLIGHT OMEGA -->
      <div class="tech-card">
        <div class="tech-badge">
          <div class="tech-ball blue"></div>
          <div class="tech-ball red" style="margin-left:-6px;"></div>
          <span class="tech-name"><span>EnLIGHT</span> OMEGA™</span>
        </div>
        <h3>Oxygen-Mediated Bead Proximity Assay</h3>
        <p>OMEGA (Oxygen MEdiated/Gated Assay) uses Sensibeads (donor, excitation 680 nm) and Chemibeads (acceptor, emission 615 nm). Singlet oxygen produced by excited Sensibeads travels up to 200 nm to activate nearby Chemibeads — signal is proportional to bead proximity, which reflects binding interaction strength.</p>
        <ul>
          <li>No-wash, homogeneous format</li>
          <li>200 nm proximity window — suited for bulky proteins, full-length antibodies</li>
          <li>Compatible with: protein-protein, antibody-antigen, cytokine detection, PPI, SARS-CoV-2 serology</li>
          <li>Compatible tags: His, GST, Flag, Biotin, Streptavidin, Anti-IgG</li>
        </ul>
      </div>
      <!-- UniLISA -->
      <div class="tech-card">
        <div class="tech-badge">
          <div class="tech-ball teal"></div>
          <span class="tech-name"><span>Uni</span>LISA™</span>
        </div>
        <h3>Universal Plate-Based Immunoassay</h3>
        <p>UniLISA is a universal plate-coating immunoassay technology offering a flexible ELISA alternative. Designed for researchers who need robust, sensitive immunodetection without the complexity of full custom ELISA development.</p>
        <ul>
          <li>Universal plate coating — adaptable to any antibody pair</li>
          <li>High sensitivity, low background</li>
          <li>Ideal for biomarker measurement in serum, plasma, and cell culture supernatants</li>
          <li>Compatible with standard microplate readers</li>
        </ul>
      </div>
      <!-- TR-FRET -->
      <div class="tech-card">
        <div class="tech-badge">
          <div class="tech-ball teal"></div>
          <span class="tech-name"><span style="color:var(--near-black);">TR-FRET</span></span>
        </div>
        <h3>Time-Resolved Fluorescence Resonance Energy Transfer</h3>
        <p>TR-FRET combines time-resolved fluorescence (TRF) with FRET to deliver low-background, high-sensitivity detection — ideal for HTS campaigns and pharmacological characterisation of GPCRs, kinases, and protein-protein interactions.</p>
        <ul>
          <li>No-wash, homogeneous format</li>
          <li>Lanthanide donor (Eu, Tb) + fluorescent acceptor</li>
          <li>Compatible with 96, 384, and 1536-well plate formats</li>
          <li>Ideal for cAMP, protein-protein interactions, GPCR profiling, compound screening</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- PRODUCT CATALOG -->
<section class="cat-section">
  <div class="container">
    <div class="section-tag">Product catalog</div>
    <h2>EnLIGHT OMEGA Reagents &amp;<br><em>Detection Kit Library</em></h2>
    <p class="lead" style="margin-bottom:32px;">ChatSKU knows every SKU — bead type, capture tag, analyte target, detection wavelength, assay format, and ordering information — and answers in seconds.</p>
    <div class="cat-grid">
      <div class="cat-card">
        <span class="cat-icon">🔵</span>
        <span class="cat-id">OMTB-S6xxx Series</span>
        <h4>Sensibeads 680 (Donor Beads)</h4>
        <p>Donor bead conjugates excited at 680 nm. Available conjugated with Streptavidin, Anti-His, Anti-GST, Anti-Flag, and unconjugated for custom coupling.</p>
        <a href="#" class="cat-link">View reagents →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">🔴</span>
        <span class="cat-id">OMTB-C6xxx Series</span>
        <h4>Chemibeads 615 (Acceptor Beads)</h4>
        <p>Acceptor bead conjugates emitting at 615 nm. Available with Anti-Human IgG Fc, Anti-Mouse IgG, Streptavidin, and unconjugated formats.</p>
        <a href="#" class="cat-link">View reagents →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">🧬</span>
        <span class="cat-id">OMDK-Hxxx Series</span>
        <h4>Human Cytokine Detection Kits</h4>
        <p>Ready-to-use EnLIGHT OMEGA kits for detection of human cytokines including TNF-α (OMDK-HTNFA), IL-1β, IL-2, IL-6, IL-8, IFN-γ in biological samples.</p>
        <a href="#" class="cat-link">View kits →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">🧪</span>
        <span class="cat-id">UniLISA Series</span>
        <h4>UniLISA Plate Coating Kit</h4>
        <p>Universal plate coating reagent system for rapid conversion of any antibody pair into a microplate-based immunoassay. Works with standard ELISA readers.</p>
        <a href="#" class="cat-link">View product →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">💡</span>
        <span class="cat-id">TR-FRET Series</span>
        <h4>TR-FRET Assay Kits</h4>
        <p>Homogeneous TR-FRET assays for cAMP, protein-protein interactions, GPCR signalling, and kinase activity. Compatible with HTRF readers (PerkinElmer, BMG).</p>
        <a href="#" class="cat-link">View kits →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">🦠</span>
        <span class="cat-id">OMEGA Custom</span>
        <h4>Serology &amp; Viral Biomarker Assays</h4>
        <p>EnLIGHT OMEGA assays for serological detection, including SARS-CoV-2 anti-IgG detection in plasma, serum, and saliva using biotinylated protein baits.</p>
        <a href="#" class="cat-link">Learn more →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">⚗️</span>
        <span class="cat-id">Services</span>
        <h4>Assay Development Services</h4>
        <p>Custom assay development for drug discovery: target-specific assay design, medium-throughput screening, compound profiling on pre-defined target classes.</p>
        <a href="#" class="cat-link">Request a quote →</a>
      </div>
      <div class="cat-card">
        <span class="cat-icon">🔬</span>
        <span class="cat-id">Services</span>
        <h4>Compound Screening &amp; Profiling</h4>
        <p>Medium-throughput compound screening services for pre-clinical drug discovery. Partnering with pharma and biotech to accelerate hit identification and optimisation.</p>
        <a href="#" class="cat-link">Partner with us →</a>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHATSKU FITS -->
<section class="fit-section" id="fit">
  <div class="container">
    <div class="fit-grid">
      <div>
        <div class="section-tag">Why ChatSKU fits BioSignal²</div>
        <h2>Life Science Buyers Are<br><em>Technical. Demanding. Global.</em></h2>
        <p class="lead">Research scientists and procurement managers in pharma, biotech, and academia don't just want a catalog — they want a technical expert available at any hour, in any time zone, who can answer very specific questions about assay formats, bead compatibility, and ordering logistics.</p>
        <p class="lead">That's exactly what ChatSKU becomes: a 24/7 research assistant trained on BioSignal²'s full product library, technology platforms, and services portfolio.</p>
        <a href="mailto:sales@chatsku.com?subject=BioSignal2 Demo Request" class="btn-blue" style="margin-top:24px;display:inline-flex;">Book the 20-Minute Demo →</a>
      </div>
      <div class="fit-reasons">
        <div class="fit-item">
          <div class="fit-icon">🌍</div>
          <div class="fit-text">
            <h4>Global customer base, many time zones</h4>
            <p>Research scientists in Europe, Asia, and the US need answers outside Montreal business hours. ChatSKU responds instantly in their language, any time of day.</p>
          </div>
        </div>
        <div class="fit-item">
          <div class="fit-icon">🧬</div>
          <div class="fit-text">
            <h4>Highly technical product questions</h4>
            <p>"Which bead conjugate is compatible with His-tagged proteins?" ChatSKU knows the Sensibead/Chemibead pairing logic, tags, and assay design principles.</p>
          </div>
        </div>
        <div class="fit-item">
          <div class="fit-icon">⚡</div>
          <div class="fit-text">
            <h4>Urgency before experiments</h4>
            <p>Scientists plan experiments ahead of time. A Sunday night question about bead compatibility or kit size needs an answer before Monday morning ordering cutoff.</p>
          </div>
        </div>
        <div class="fit-item">
          <div class="fit-icon">📋</div>
          <div class="fit-text">
            <h4>Complex custom service RFQs</h4>
            <p>Assay development and compound screening inquiries require scoping. ChatSKU collects target, format, throughput, and timeline before routing to your team.</p>
          </div>
        </div>
        <div class="fit-item">
          <div class="fit-icon">🔗</div>
          <div class="fit-text">
            <h4>Multiple ordering channels (e-Store, Coupa, scientist.com)</h4>
            <p>ChatSKU can guide customers to the right purchasing platform — e-Store, Coupa Supplier, or scientist.com — and confirm SKU and kit size before checkout.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SAMPLE QUERIES — example answers -->
<section class="queries-section" id="queries">
  <div class="container">
    <div class="section-tag">Sample interactions</div>
    <h2>What Researchers Ask.<br><em>How ChatSKU Answers.</em></h2>
    <p class="lead">These are real questions BioSignal²'s research customers ask — and exactly how ChatSKU would answer using BioSignal²'s product and technical documentation.</p>
    <div class="queries-grid">

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Researcher asks</div>
          <p>"I have a His-tagged protein and I want to detect its interaction with a biotinylated ligand. Which BioSignal² beads should I use and in what configuration?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>For a His-tagged protein + biotinylated ligand interaction, use <strong>Anti-His Sensibeads 680</strong> as the donor to capture your His-tagged protein, and <strong>Streptavidin Chemibeads 615</strong> as the acceptor to capture the biotinylated ligand. When both proteins interact and bring the beads into proximity (&lt;200 nm), the OMEGA signal at 615 nm is generated. <span class="cat-ref">OMTB-S6HIS + OMTB-C6STREP</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Procurement scientist asks</div>
          <p>"We want to measure human TNF-alpha in cell culture supernatant using EnLIGHT OMEGA. Do you have a ready-to-use kit? What's the detection range?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>Yes — BioSignal² offers the <strong>Human TNF-α EnLIGHT OMEGA Detection Kit</strong>, a homogeneous, no-wash assay validated for cell culture supernatants, serum and plasma. The kit includes pre-titrated Sensibeads and Chemibeads conjugated to anti-TNF-α antibodies. Detection is in the low pg/mL range. <span class="cat-ref">OMDK-HTNFA</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Drug discovery scientist asks</div>
          <p>"We're running a GPCR cAMP HTS campaign. Can I use BioSignal²'s TR-FRET assay in 384-well format? What reader do I need?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>BioSignal²'s <strong>TR-FRET cAMP assay kits</strong> are fully compatible with 96-well, 384-well, and higher-density plate formats for HTS. You'll need a time-resolved fluorescence plate reader with a 337 nm excitation source and dual-emission detection at 620 nm and 665 nm — such as the <strong>PerkinElmer EnVision, BMG PHERAstar</strong>, or equivalent HTRF-compatible reader. <span class="cat-ref">TR-FRET cAMP Series</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Lab manager asks</div>
          <p>"What's the difference between EnLIGHT OMEGA and AlphaScreen? Why would I choose OMEGA over AlphaLISA for my protein-protein interaction assay?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>Both use proximity-based singlet oxygen transfer, but BioSignal²'s <strong>EnLIGHT OMEGA has a 200 nm proximity window</strong> vs ~100 nm for Alpha beads — making OMEGA better suited for larger, bulkier protein complexes like full-length antibodies, trimeric proteins, and viral particles. OMEGA Sensibeads also differ in their photosensitiser chemistry (patent-pending), resulting in a distinct performance profile. <span class="cat-ref">ENLIGHT OMEGA Technology</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Biotech researcher asks</div>
          <p>"I'm looking for a reliable detection kit for human interleukins, what do you have?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>Yes — BioSignal² has demonstrated an <strong>EnLIGHT OMEGA serology assay</strong> for detecting anti-human IgGs specific to SARS-CoV-2 trimeric spike protein in plasma, serum, or saliva. Use <strong>Streptavidin Sensibeads</strong> to capture biotinylated SARS-CoV-2 protein bait, and <strong>Anti-Human IgG Fc Chemibeads</strong> to detect bridging patient IgGs. Signal is proportional to anti-CoV-2 IgG concentration. <span class="cat-ref">OMTB-C6STREP + OMTB-C6AHIFC</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Pharma partner asks</div>
          <p>"We have an existing ELISA for IL-6 but want to convert it to a homogeneous no-wash format for automation. Can BioSignal² help?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>Absolutely. BioSignal² offers <strong>custom assay development services</strong> including ELISA-to-OMEGA conversion using your existing antibody pair. The team will identify bead conjugation strategies, optimise signal-to-background, and validate the homogeneous format for your automation platform. This is part of BioSignal²'s partnering services. I'll route your inquiry to their team now — can you share your antibody pair details and throughput requirements? <span class="cat-ref">Assay Development Services</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Procurement officer asks</div>
          <p>"We're a Coupa-registered institution. Can we order BioSignal² products through Coupa? And is there a first-order discount?"</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>Yes — BioSignal² is a <strong>registered Coupa Supplier</strong>, so you can place orders directly through your Coupa procurement system. BioSignal² products are also available via <strong>scientist.com</strong>. For first-time customers, use promo code <strong>WELCOME25</strong> for a new customer discount on your first order via the e-Store. <span class="cat-ref">Ordering via Coupa · scientist.com · e-Store</span></p>
        </div>
      </div>

      <div class="query-card">
        <div class="query-q">
          <div class="query-label">Research scientist asks</div>
          <p>"What plate reader do I need for EnLIGHT OMEGA? We have a BMG CLARIOstar and a PerkinElmer EnVision in our core facility."</p>
        </div>
        <div class="query-a">
          <div class="query-a-label">ChatSKU answers</div>
          <p>The <strong>PerkinElmer EnVision</strong> is compatible with EnLIGHT OMEGA — it supports AlphaScreen/AlphaLISA mode which uses the same 680 nm excitation / 615 nm emission optical path. The <strong>BMG CLARIOstar</strong> can also run OMEGA assays if configured with a 680 nm laser excitation module and 615 nm emission filter. Contact BioSignal² to confirm reader compatibility before ordering. <span class="cat-ref">EnLIGHT OMEGA Reader Compatibility</span></p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- BEFORE / AFTER -->
<section class="ba-section">
  <div class="container">
    <div class="section-tag">The problem it solves</div>
    <h2>Before &amp; After ChatSKU</h2>
    <p class="lead" style="margin-bottom:32px;">Every unanswered technical question at 11 PM is a researcher who orders from a competitor with better online documentation.</p>
    <table>
      <thead>
        <tr><th></th><th>Without ChatSKU</th><th>With ChatSKU on biosignal2.com</th></tr>
      </thead>
      <tbody>
        <tr><td><span class="bad">✗</span></td><td>"Which beads for my His-tagged PPI assay?" — email, wait 24–48 hrs for a response</td><td><span class="good">✓</span> Bead pair recommendation with catalog numbers, answered in seconds</td></tr>
        <tr><td><span class="bad">✗</span></td><td>European researcher needs assay setup guidance at 8 AM CET — Montreal office is closed</td><td><span class="good">✓</span> Technical guidance delivered instantly in the researcher's time zone</td></tr>
        <tr><td><span class="bad">✗</span></td><td>"How does OMEGA compare to AlphaScreen?" — researcher Googles a competitor's page</td><td><span class="good">✓</span> ChatSKU delivers a clear, BioSignal²-specific competitive comparison, keeping the buyer on-site</td></tr>
        <tr><td><span class="bad">✗</span></td><td>Pharma partner wants assay dev services — fills out a contact form, waits days</td><td><span class="good">✓</span> ChatSKU scopes the project (target, format, timeline) and routes a pre-filled brief to your team</td></tr>
        <tr><td><span class="bad">✗</span></td><td>First-time buyer doesn't know about the promo code or Coupa ordering option</td><td><span class="good">✓</span> ChatSKU mentions WELCOME25 code and Coupa/scientist.com ordering in every relevant conversation</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section" id="how">
  <div class="container">
    <div class="section-tag">Setup</div>
    <h2>Live in <em>One Day.</em></h2>
    <p class="lead" style="margin-bottom:36px;">No IT project. No platform migration. BioSignal²'s team doesn't need developers to get started.</p>
    <div class="steps-grid">
      <div class="step-card">
        <div class="step-num">1</div>
        <h3>Share Your Product Library</h3>
        <p>Send us your product pages, technical datasheets, bead catalog, kit inserts, and any assay design guides. We work with PDFs, URLs, or CSVs.</p>
        <div class="step-meta">Day 1 · 30 minutes of your time</div>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h3>We Train ChatSKU on BioSignal² Data</h3>
        <p>ChatSKU is trained on every product, every technology platform, every bead compatibility rule, and BioSignal²'s assay design principles. You review before go-live.</p>
        <div class="step-meta">Day 1 · Done by end of day</div>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h3>One Script Tag on Your Site</h3>
        <p>Add one line of code to biosignal2.com — or we host a standalone demo page. The popup widget is live and answering researcher questions before your next sales call.</p>
        <div class="step-meta">Day 1 · 2 minutes</div>
      </div>
    </div>
  </div>
</section>

<!-- NOTE -->
<section class="note-section">
  <div class="container">
    <div class="section-tag">A direct note</div>
    <div class="note-card">
      <blockquote>
        "BioSignal² has developed genuinely novel technology — EnLIGHT OMEGA is a real differentiator in the proximity assay space. But when a researcher is evaluating bead platforms at midnight before a Monday order, they're going to choose the vendor whose product they understand. ChatSKU makes sure BioSignal² is the one doing the explaining.<br><br>
        I want to show you ChatSKU running on your full product library — you'll see in 20 minutes exactly how it handles the technical questions your customers actually ask."
      </blockquote>
      <div class="note-sig">Gigi <span>| Founder, ChatSKU · Virtina</span></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq-section">
  <div class="container">
    <div class="section-tag">Common questions</div>
    <h2>Questions About ChatSKU<br><em>for Life Science Companies.</em></h2>
    <div class="faq-list" style="margin-top:36px;">
      <div class="faq-item">
        <button class="faq-q" onclick="faq(this)">Can ChatSKU handle the technical depth of OMEGA/TR-FRET assay questions? <span class="faq-ch">▾</span></button>
        <div class="faq-a"><p>Yes. ChatSKU is trained on BioSignal²'s full technical library — bead conjugation types, assay design logic, tag compatibility (His, GST, Flag, Biotin, Streptavidin), detection wavelengths, reader requirements, and assay troubleshooting guidance. It knows when to escalate complex custom development questions to your scientific team.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="faq(this)">What languages can ChatSKU respond in? <span class="faq-ch">▾</span></button>
        <div class="faq-a"><p>ChatSKU responds fluently in English, French, Spanish, German, Japanese, Chinese, and many other languages — ensuring BioSignal²'s global research customer base gets help in their language, even when your Montreal team is offline.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="faq(this)">Can it handle custom assay development and partnering inquiries? <span class="faq-ch">▾</span></button>
        <div class="faq-a"><p>Yes. ChatSKU collects the key details of a custom assay request — target, detection format, throughput, timeline, matrix (serum, cell lysate, etc.) — and delivers a pre-filled brief to your scientific team. This replaces an unstructured contact form submission with a qualified, scoped inquiry.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="faq(this)">Can ChatSKU integrate with our e-Store and Coupa ordering? <span class="faq-ch">▾</span></button>
        <div class="faq-a"><p>ChatSKU can guide customers to the correct ordering platform (e-Store, Coupa, scientist.com), confirm catalog numbers and kit sizes before ordering, and mention any active promotions — reducing friction in the purchase path without requiring direct integration with your store backend.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="faq(this)">How does ChatSKU stay up to date when BioSignal² launches new products? <span class="faq-ch">▾</span></button>
        <div class="faq-a"><p>When new products or catalog numbers are added to BioSignal²'s product library, we update ChatSKU's training data. This can be triggered by sending us updated product sheets, a revised catalog PDF, or updated product pages — typically a same-day turnaround.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta-band">
  <h2>See ChatSKU on BioSignal²'s<br>Real Product Library.</h2>
  <p>Book a 20-minute demo. We'll run ChatSKU live on BioSignal²'s EnLIGHT OMEGA, UniLISA, and TR-FRET product catalog before the call ends.</p>
  <a href="mailto:sales@chatsku.com?subject=BioSignal2 Demo Request" class="btn-white">Book the 20-Minute Demo →</a>
</div>

<!-- FOOTER -->
<footer>
  <div class="foot-grid">
    <div class="foot-brand">
      <span class="name">BioSignal<sup>2</sup> Inc × ChatSKU</span>
      <span class="tagline">Quality &amp; Innovation · Drug Discovery · Life Sciences</span>
      <p>A ChatSKU demo page built for BioSignal² Inc — Montreal-based life science company developing EnLIGHT OMEGA, UniLISA, and TR-FRET reagents for global drug discovery and biomedical research.</p>
      <div class="foot-contact">Montreal, Quebec, Canada<br>biosignal2.com</div>
    </div>
    <div class="foot-col">
      <h4>Technologies</h4>
      <a href="#">EnLIGHT OMEGA™</a>
      <a href="#">UniLISA™</a>
      <a href="#">TR-FRET</a>
      <a href="#">Sensibeads 680</a>
      <a href="#">Chemibeads 615</a>
    </div>
    <div class="foot-col">
      <h4>Products</h4>
      <a href="#">Cytokine Kits</a>
      <a href="#">Bead Conjugates</a>
      <a href="#">Protein-Protein Interaction</a>
      <a href="#">GPCR / cAMP Assays</a>
      <a href="#">Serology Assays</a>
    </div>
    <div class="foot-col">
      <h4>Services</h4>
      <a href="#">Assay Development</a>
      <a href="#">Compound Screening</a>
      <a href="#">Partnering</a>
      <a href="#">e-Store</a>
      <a href="#">Order via scientist.com</a>
    </div>
  </div>
  <div class="foot-bottom">
    <span>© 2026 BioSignal² Inc — Powered by ChatSKU · Virtina</span>
    <span>Demo only · Not the live site · <a href="https://biosignal2.com">biosignal2.com</a></span>
  </div>
</footer>

<script>
  /* ── FAQ accordion ── */
  function faq(btn) {
    const item = btn.parentElement;
    const open = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
    if (!open) item.classList.add('open');
  }

  /* ── ChatSKU live widget demo (left questions inject into right widget) ── */
  (function () {
    var WIDGET_SRC     = 'https://app.chatsku.com/widget/widget.js';
    var WIDGET_API_KEY = '6151994865af45c041dc1d843d126b2fd0989ddbe0ae74b1ae3b43105b074f62'; // BioSignal²
    var activeMode     = 'inline';
    var bodySnapshot   = null;

    function loadWidget(containerId, mode, spinnerElId) {
      /* Destroy any prior widget instance */
      [window.ChatSKU, window.chatsku, window.ImpelHub, window.impelhub].forEach(function (api) {
        if (api) {
          if (typeof api.destroy  === 'function') { try { api.destroy();  } catch (e) {} }
          if (typeof api.unmount  === 'function') { try { api.unmount();  } catch (e) {} }
          if (typeof api.teardown === 'function') { try { api.teardown(); } catch (e) {} }
        }
      });
      document.querySelectorAll('script[data-chatsku-widget]').forEach(function (s) {
        s.parentNode.removeChild(s);
      });
      /* Remove any body children the widget appended (bubble launchers, overlays, etc.) */
      if (bodySnapshot) {
        Array.from(document.body.children).forEach(function (el) {
          if (!bodySnapshot.has(el)) { el.parentNode && el.parentNode.removeChild(el); }
        });
      }
      var container = document.getElementById(containerId);
      if (container) { container.innerHTML = ''; }
      var spinner = document.getElementById(spinnerElId);
      if (spinner) { spinner.classList.remove('is-hidden'); }

      var script = document.createElement('script');
      script.src = WIDGET_SRC;
      script.setAttribute('data-api-key',   WIDGET_API_KEY);
      script.setAttribute('data-embed',     mode);
      script.setAttribute('data-container', containerId);
      script.setAttribute('data-chatsku-widget', '1');
      script.async = true;
      script.onload  = function () { setTimeout(function () { if (spinner) spinner.classList.add('is-hidden'); }, 1500); };
      script.onerror = function () { if (spinner) spinner.classList.add('is-hidden'); };
      document.body.appendChild(script);
    }

    function injectTextIntoWidget(query) {
      var containers = [ document.getElementById('chatsku-widget'), document ];
      var input = null;
      for (var i = 0; i < containers.length; i++) {
        var root = containers[i];
        if (!root) continue;
        var candidate = root.querySelector('#ciq-input')
                     || root.querySelector('input[type="text"]')
                     || root.querySelector('textarea');
        if (candidate) { input = candidate; break; }
        var iframes = root.querySelectorAll('iframe');
        for (var j = 0; j < iframes.length; j++) {
          try {
            var iframeDoc = iframes[j].contentDocument || iframes[j].contentWindow.document;
            candidate = iframeDoc.querySelector('#ciq-input')
                     || iframeDoc.querySelector('input[type="text"]')
                     || iframeDoc.querySelector('textarea');
            if (candidate) { input = candidate; break; }
          } catch (e) { /* cross-origin iframe — skip */ }
          if (input) break;
        }
        if (input) break;
      }
      if (!input) return;

      var nativeInputSetter = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value')
        || Object.getOwnPropertyDescriptor(window.HTMLTextAreaElement.prototype, 'value');
      if (nativeInputSetter && nativeInputSetter.set) { nativeInputSetter.set.call(input, query); }
      else { input.value = query; }

      input.dispatchEvent(new Event('input',  { bubbles: true }));
      input.dispatchEvent(new Event('change', { bubbles: true }));
      input.focus();
    }

    function initTryItButtons() {
      document.addEventListener('click', function (e) {
        var btn = e.target.closest('.demo-try-btn');
        if (!btn) return;
        var query = btn.getAttribute('data-query');
        if (!query) return;
        injectTextIntoWidget(query);
        var card = document.getElementById('demo-widget-card');
        if (card) { card.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
      });
    }

    function initModeToggle() {
      var modeButtons = document.querySelectorAll('.demo-mode-btn');
      modeButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
          var mode = btn.getAttribute('data-mode');
          if (mode === activeMode) return;
          activeMode = mode;
          modeButtons.forEach(function (b) { b.classList.remove('demo-mode-btn--active'); });
          btn.classList.add('demo-mode-btn--active');
          loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');
        });
      });
    }

    /* Live voice search — Web Speech API; falls back to the example phrase if unsupported */
    function initVoiceInput() {
      var SR = window.SpeechRecognition || window.webkitSpeechRecognition;
      document.querySelectorAll('.demo-mic-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var fallback = btn.getAttribute('data-fallback') || '';
          if (!SR) { if (fallback) injectTextIntoWidget(fallback); return; }
          var rec = new SR();
          rec.lang = 'en-US'; rec.interimResults = false; rec.maxAlternatives = 1;
          btn.classList.add('is-listening');
          rec.onresult = function (e) {
            var t = e.results && e.results[0] && e.results[0][0] && e.results[0][0].transcript;
            if (t) injectTextIntoWidget(t);
          };
          rec.onerror = function () { if (fallback) injectTextIntoWidget(fallback); };
          rec.onend   = function () { btn.classList.remove('is-listening'); };
          try { rec.start(); }
          catch (e) { btn.classList.remove('is-listening'); if (fallback) injectTextIntoWidget(fallback); }
        });
      });
    }

    function init() {
      initTryItButtons();
      initModeToggle();
      initVoiceInput();
      /* Snapshot body children BEFORE the widget loads, so we can clean up on reload */
      bodySnapshot = new Set(Array.from(document.body.children));
      loadWidget('chatsku-widget', activeMode, 'demo-widget-spinner');
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', init);
    } else {
      init();
    }
  })();
</script>

<?php wp_footer(); ?>
</body>
</html>
