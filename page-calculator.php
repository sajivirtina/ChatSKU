<?php
/**
 * Template Name: Revenue Calculator
 *
 * "Revenue Left on the Table" calculator — with WPForms lead-capture form.
 *
 * Setup checklist:
 *  1. Create a WPForms form (see plan for field list) and set $calc_form_id below
 *  2. Configure WPForms notifications (admin + user copy) and confirmation message
 *  (Pricing estimator UI is served from assets/pricing-estimator.html and loaded into the modal iframe by URL)
 *
 * Based on: chatsku-revenue-left-calculator.html
 *
 * @package ChatSKU
 */

get_header();

// ── WPForms form ID ────────────────────────────────────────────────────────────
// Must match the Calendly entry-id-only filter in functions.php (chatsku_calendly_redirect_url),
// which fires only for form 253. Keep this in sync so the redirect passes ONLY ?a1={entry_id}.
$calc_form_id = 253;

// ── Pricing Estimator ─────────────────────────────────────────────────────────
// The estimator UI lives in assets/pricing-estimator.html and loads into the modal
// iframe by URL — no per-request base64 of ~26KB of HTML.
$estimator_url = get_template_directory_uri() . '/assets/pricing-estimator.html';

// ── March of Commerce image ────────────────────────────────────────────────────
// Renders the March of Commerce graphic from theme assets when present.
// Ensure assets/images/march-of-commerce.png is included in the deployed theme.
$moc_asset_path = get_template_directory() . '/assets/images/march-of-commerce.png';
$moc_image_src  = '';

if ( file_exists( $moc_asset_path ) ) {
    $moc_image_src = get_template_directory_uri() . '/assets/images/march-of-commerce.png';
}
?>

<main id="main" class="chatsku-main chatsku-calculator-main">

<style>
/* ══════════════════════════════════════════════════════════════════════════════
   ChatSKU Revenue Calculator (page-calculator.php)
   All styles from chatsku-revenue-left-calculator.html, verbatim.
   ══════════════════════════════════════════════════════════════════════════════ */
:root{
  --navy-900:#07182E; --navy-800:#0B2545; --navy-700:#103257;
  --amber:#44d3c1; --gold:#F4B324; --amber-soft:#FFC94D; --green:#7BD389;
  --ink:#F2F4F8; --slate:#9FC0E8; --muted:#7E99BC;
  --line:rgba(159,192,232,.16);
  --sans:'Archivo',system-ui,sans-serif; --mono:'IBM Plex Mono',monospace;
}

/* ── Layout ──────────────────────────────────────────────────────────────────── */
.chatsku-calculator-main{
  font-family:var(--sans); color:var(--ink);
  background:radial-gradient(140% 120% at 15% 0%, #103257 0%, #0B2545 45%, #06121F 100%);
  background-attachment:fixed; min-height:100vh; line-height:1.45; padding:38px 22px 60px;
}
.calc-wrap{max-width:980px;margin:0 auto; padding-top: 80px;}
.kicker{font-family:var(--mono);font-size:12px;letter-spacing:5px;color:var(--amber);text-transform:uppercase;font-weight:600;}
.calc-wrap h1{font-size:clamp(30px,5vw,52px);font-weight:800;letter-spacing:-1.2px;line-height:1.02;margin:12px 0 10px;}
.calc-wrap h1 .yel{color:var(--amber);}
.calc-sub{color:var(--slate);max-width:640px;font-size:16px;}
.calc-brand{float:right;font-family:var(--mono);font-size:12px;letter-spacing:2px;color:var(--muted);border:1px solid var(--line);padding:7px 12px;border-radius:8px;}

.c-panel{background:rgba(11,37,69,.55);border:1px solid var(--line);border-radius:16px;backdrop-filter:blur(4px);}
.c-pad{padding:26px 28px;margin-top:30px;}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:26px;}
.grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
.grid4{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;}
.divider{height:1px;background:var(--line);margin:24px 0;}

.ctl label{display:block;font-family:var(--mono);font-size:12px;letter-spacing:1.5px;color:var(--slate);text-transform:uppercase;margin-bottom:10px;}
.slider-val{font-family:var(--mono);color:var(--amber);font-weight:600;float:right;}
.rev-input,.select-wrap,.cost-input{display:flex;align-items:center;gap:8px;background:var(--navy-900);border:1px solid var(--line);border-radius:11px;padding:12px 14px;}
.rev-input span{font-family:var(--mono);font-size:26px;color:var(--amber);font-weight:600;}
.rev-input input{flex:1;background:none;border:none;outline:none;color:var(--ink);font-family:var(--mono);font-size:26px;font-weight:600;width:100%;}
.select-wrap{padding:0;position:relative;}
select{-webkit-appearance:none;appearance:none;width:100%;background:none;border:none;outline:none;color:var(--ink);font-family:var(--sans);font-weight:700;font-size:19px;padding:15px 44px 15px 14px;cursor:pointer;}
select option{background:var(--navy-800);color:var(--ink);}
.select-wrap::after{content:"\25BE";position:absolute;right:16px;top:50%;transform:translateY(-50%);color:var(--amber);pointer-events:none;font-size:14px;}
.hint{font-size:12px;color:var(--muted);margin-top:11px;line-height:1.4;}
.cost-input{padding:11px 13px;}
.cost-input span{color:var(--amber);font-family:var(--mono);font-size:19px;font-weight:600;}
.cost-input input{font-family:var(--mono);font-size:19px;color:var(--ink);font-weight:600;background:none;border:none;outline:none;width:100%;}
.cost-input .per{color:var(--muted);font-size:13px;}
.cost-input.is-custom span{display:none;}
.cost-input.is-custom input{color:var(--amber);font-weight:700;cursor:pointer;}

.result{padding:30px 32px;margin-top:18px;}
.rhead{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap;border-bottom:1px solid var(--line);padding-bottom:22px;margin-bottom:6px;}
.rstages{font-family:var(--mono);font-size:11px;letter-spacing:2px;color:var(--muted);text-transform:uppercase;}
.rname{font-size:30px;font-weight:800;letter-spacing:-.5px;margin-top:6px;}
.rnum{text-align:right;}
.rbig{font-family:var(--mono);font-weight:700;font-size:clamp(38px,7vw,62px);color:var(--gold);letter-spacing:-2px;line-height:1;}
.rbig small{font-size:20px;color:var(--slate);font-weight:500;letter-spacing:0;}
.rpct{font-family:var(--mono);font-size:18px;color:var(--slate);margin-top:8px;}
.rmulti{font-family:var(--mono);font-size:18px;color:var(--muted);margin-top:4px;}
.rmulti b{color:var(--amber-soft);     font-size: 24px;}
.steps-h{font-family:var(--mono);font-size:11px;letter-spacing:2px;color:var(--amber);text-transform:uppercase;margin:24px 0 4px;}
.steps-sub{color:var(--slate);font-size:14px;margin-bottom:14px;}
.steps-sub b{color:var(--ink);}
.step{display:grid;grid-template-columns:240px 1fr 150px;gap:16px;align-items:center;padding:13px 0;border-top:1px solid var(--line);}
.step:first-of-type{border-top:none;}
.step .slabel{font-size:14px;}
.step .slabel small{display:block;color:var(--muted);font-family:var(--mono);font-size:11px;margin-top:2px;}
.bar{height:12px;border-radius:6px;background:rgba(159,192,232,.14);overflow:hidden;}
.bar i{display:block;height:100%;border-radius:6px;background:linear-gradient(90deg,#2f6aa3,#5a93c9);transition:width .5s cubic-bezier(.2,.7,.2,1);}
.step .sval{font-family:var(--mono);font-weight:600;text-align:right;font-size:16px;}
.step.final{border-top:2px solid var(--amber);margin-top:6px;}
.step.final .bar i{background:linear-gradient(90deg,var(--amber),var(--amber-soft));}
.step.final .slabel{font-weight:800;}
.step.final .sval{color:var(--amber);font-size:22px;}
.why{margin-top:22px;padding:16px 18px;background:rgba(7,24,46,.6);border-left:3px solid var(--amber);border-radius:8px;font-size:14px;color:var(--slate);}
.why b{color:var(--ink);}
/* Revenue at Risk title (left of the risk card) */
.rleft{display:flex;flex-direction:column;}
.rtitle{font-weight:700;font-size:clamp(28px,4vw,40px);letter-spacing:-1px;line-height:1;color:var(--coral);margin-bottom:10px;}
/* Reasoning accordion */
.steps{margin:24px 0 0;}
.steps>summary{list-style:none;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:12px;font-family:var(--mono);font-size:18px;letter-spacing:2px;color:var(--amber);text-transform:uppercase;margin:0 0 4px;}
.steps>summary::-webkit-details-marker{display:none;}
.steps>summary::after{content:'+';font-size:24px;line-height:1;color:var(--amber);}
.steps[open]>summary::after{content:'\2212';}
/* Recoverable section title + single value */
.recover-title{font-weight:700;font-size: clamp(24px, 3.4vw, 40px);letter-spacing:-.6px;color:#00c9b1;margin:0 0 18px;}
.recover-rev{display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.rr-label{font-weight:700;font-size:clamp(24px,3.4vw,40px);color:var(--green);letter-spacing:-.6px;line-height:1.05;}
.rr-right{text-align:right;}
.rr-year{font-family:var(--mono);font-weight:700;font-size:clamp(40px,6vw,58px);color:var(--coral);letter-spacing:-2px;line-height:1;}
.rr-year small{font-size:18px;color:var(--slate);font-weight:500;letter-spacing:0;}
.rr-life{font-family:var(--mono);font-size:16px;color:var(--muted);margin-top:6px;}
.rr-life #recRevLife{color:var(--coral);font-weight:700;}
/* Recovery controls: two across now that the cost fields are hidden */
.recover .grid4{grid-template-columns:1fr 1fr;}
@media(max-width:560px){.recover .grid4{grid-template-columns:1fr;}}
/* Free-plan note in the CTA */
.cta-free{color:var(--amber);font-size:18px;margin-top:14px;}

.recover{padding:24px 28px;margin-top:18px;}
.out .ol{font-family:var(--mono);font-size:11px;letter-spacing:1.5px;color:var(--slate);text-transform:uppercase;}
.out .ov{font-family:var(--mono);font-weight:700;font-size:24px;color:var(--slate);margin-top:6px;letter-spacing:-1px;}
.out.amber .ov{color:var(--amber);}
.out.hero .ov{font-size:38px;color:var(--green);}
.out .ov.green{color:var(--gold);     font-size: clamp(38px, 7vw, 62px);    line-height: normal;}
.out .osub{font-family:var(--mono);font-size:11px;color:var(--muted);margin-top:5px;}
.grid4.center {
    align-items: center;
}
input[type=range] {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #d63637 var(--p, 40%), rgba(159, 192, 232, .30) var(--p, 40%));
    box-shadow: inset 0 0 0 1px rgba(159,192,232,.18);
    outline: none;
    margin-top: 18px;
    cursor: pointer;
}

input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 16px;
    height: 24px;
    border-radius: 7px;
    background: #fff;
    border: 2px solid var(--amber);
    box-shadow: 0 2px 6px rgba(0,0,0,.35),0 0 0 1px var(--navy-900);
    cursor: pointer;
    transition: transform .12s,box-shadow .12s;
}

input[type=range]::-webkit-slider-thumb:hover {
    transform: scale(1.08);
    box-shadow: 0 2px 10px rgba(68,211,193,.5),0 0 0 1px var(--navy-900);
}

input[type=range]::-moz-range-thumb {
    width: 14px;
    height: 22px;
    border-radius: 7px;
    background: #fff;
    border: 2px solid var(--amber);
    box-shadow: 0 2px 6px rgba(0,0,0,.35);
    cursor: pointer;
}

input[type=range]:focus-visible {
    outline: 2px solid var(--amber);
    outline-offset: 3px;
}

.calc-foot{margin-top:26px;font-family:var(--mono);font-size:11.5px;color:var(--muted);line-height:1.7;}
.calc-foot b{color:var(--slate);}

/* Info popovers */
.ctl{position:relative;}
.info{display:inline-flex;align-items:center;justify-content:center;width:15px;height:15px;border-radius:50%;border:1px solid var(--muted);color:var(--slate);font-family:Georgia,serif;font-size:10px;font-weight:700;font-style:italic;cursor:pointer;vertical-align:middle;margin:0 3px;transition:.15s;user-select:none;}
.info:hover{border-color:var(--amber);color:var(--amber);}
.range-ends{display:flex;justify-content:space-between;font-family:var(--mono);font-size:10.5px;color:var(--muted);margin-top:8px;letter-spacing:.5px;}
.pop{display:none;position:absolute;z-index:40;top:36px;left:0;width:272px;max-width:86vw;background:var(--navy-900);border:1px solid var(--amber);border-radius:10px;padding:13px 15px;font-size:12.5px;line-height:1.52;color:var(--slate);box-shadow:0 18px 40px -14px rgba(0,0,0,.75);}
.pop.open{display:block;}
.pop b{color:var(--ink);}
.pop .rng{display:block;font-family:var(--mono);color:var(--amber);font-size:10.5px;letter-spacing:1px;text-transform:uppercase;margin-bottom:7px;}

.c-panel{position:relative;}
.c-panel.c-pad{z-index:30;}
.c-panel.result{z-index:20;}
.c-panel.recover{z-index:10;}

/* Pricing estimator CTA button */
.pe-cta{display:block;width:100%;margin-top:18px;background:rgba(244,179,36,.08);border:1px dashed rgba(244,179,36,.55);color:var(--gold);font-family:var(--sans);font-weight:700;font-size:18px;padding:13px 14px;border-radius:11px;cursor:pointer;transition:.15s;}
.pe-cta:hover{background:rgba(244,179,36,.16);}

/* Pricing Estimator modal */
.pe-backdrop{position:fixed;inset:0;z-index:1000;display:none;align-items:center;justify-content:center;padding:22px;background:rgba(3,9,18,.74);backdrop-filter:blur(6px);opacity:0;transition:opacity .2s;}
.pe-backdrop.open{display:flex;opacity:1;}
.pe-modal{width:96%;max-width:1140px;height:92vh;max-height:860px;min-height:520px;display:flex;flex-direction:column;background:var(--navy-800);border:1px solid var(--line);border-radius:18px;overflow:hidden;box-shadow:0 40px 100px -30px rgba(0,0,0,.8);transform:translateY(10px) scale(.99);transition:transform .2s;}
.pe-backdrop.open .pe-modal{transform:none;}
.pe-head{display:flex;align-items:center;justify-content:space-between;padding:15px 22px;border-bottom:1px solid var(--line);}
.pe-title{font-family:var(--mono);font-size:12px;letter-spacing:2.5px;text-transform:uppercase;color:var(--amber);}
.pe-x{background:none;border:none;color:var(--slate);font-size:26px;line-height:1;cursor:pointer;padding:0 4px;}
.pe-x:hover{color:var(--ink);}
.pe-body{flex:1;min-height:0;overflow:hidden;}
.pe-body iframe{width:100%;height:100%;border:none;display:block;}
.pe-foot{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:13px 22px;border-top:1px solid var(--line);background:rgba(7,24,46,.55);flex-wrap:wrap;}
.pe-foot-lbl{font-family:var(--mono);font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);display:block;}
.pe-summary{font-family:var(--mono);font-size:17px;color:var(--ink);margin-top:3px;display:block;}
.pe-foot-r{display:flex;gap:10px;}
.pe-btn{font-family:var(--sans);font-weight:700;font-size:14px;padding:11px 18px;border-radius:10px;cursor:pointer;border:1px solid var(--line);}
.pe-btn.ghost{background:none;color:var(--slate);}
.pe-btn.ghost:hover{color:var(--ink);border-color:var(--slate);}
.pe-btn.primary{background:var(--gold);color:var(--navy-900);border-color:var(--gold);}
.pe-btn.primary:hover{background:var(--amber);}

/* March of Commerce modal */
.moc-link{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;letter-spacing:.5px;color:var(--amber);cursor:pointer;border:1px solid rgba(244,179,36,.45);border-radius:6px;padding:2px 8px;margin-left:9px;text-transform:none;vertical-align:middle;transition:.15s;}
.moc-link:hover{background:rgba(244,179,36,.14);}
.moc-backdrop{position:fixed;inset:0;z-index:1100;display:none;align-items:center;justify-content:center;padding:26px;background:rgba(3,9,18,.86);backdrop-filter:blur(6px);opacity:0;transition:opacity .2s;}
.moc-backdrop.open{display:flex;opacity:1;}
.moc-box{position:relative;display:flex;flex-direction:column;align-items:center;max-width:96vw;max-height:94vh;transform:scale(.985);transition:transform .2s;}
.moc-backdrop.open .moc-box{transform:none;}
.moc-box img{max-width:96vw;max-height:86vh;width:auto;height:auto;border-radius:12px;border:1px solid var(--line);box-shadow:0 40px 110px -30px rgba(0,0,0,.85);background:#fff;}
.moc-x{position:absolute;top:-15px;right:-15px;width:38px;height:38px;border-radius:50%;background:var(--navy-800);border:1px solid var(--line);color:var(--ink);font-size:22px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;}
.moc-x:hover{border-color:var(--amber);color:var(--amber);}
.moc-cap{font-family:var(--mono);font-size:10.5px;color:var(--slate);text-align:center;margin-top:13px;letter-spacing:1.5px;text-transform:uppercase;}

/* CTA Panel */
.cta-panel{padding:42px 34px;text-align:center;background:linear-gradient(180deg,rgba(244,179,36,.07),rgba(11,37,69,.55));border:1px solid rgba(244,179,36,.32);margin-top:18px;}
.cta-h{font-size:clamp(24px,3.6vw,34px);font-weight:800;letter-spacing:-.6px;line-height:1.08;}
.cta-h .yel{color:var(--amber);}
.cta-sub{color:var(--slate);font-size:16px;max-width:540px;margin:13px auto 26px;}
.cta-btn{display:inline-flex;align-items:center;gap:9px;background:var(--amber);color:var(--navy-900);font-family:var(--sans);font-weight:800;font-size:16px;letter-spacing:-.2px;padding:15px 30px;border-radius:12px;text-decoration:none;border:1px solid var(--amber);cursor:pointer;transition:.15s;}
.cta-btn:hover{background:var(--amber-soft);border-color:var(--amber-soft);transform:translateY(-1px);}

/* Lead Capture Form Section */
.cta-form-panel{padding:42px 34px;margin-top:18px;border:1px solid rgba(244,179,36,.2);border-radius:16px;background:rgba(11,37,69,.55);backdrop-filter:blur(4px);}
.cta-form-panel__inner{max-width:560px;margin:0 auto;text-align:center;}
.cta-form-panel .cta-h{margin-bottom:8px;}
.cta-form-panel .cta-sub{margin-bottom:28px;}

/* WPForms dark theme overrides */
.chatsku-calc-form .wpforms-form .wpforms-field-label,
.chatsku-calc-form .wpforms-form .wpforms-field-sublabel{
  color:#9FC0E8 !important; font-size:12px !important;
  font-family:'IBM Plex Mono',monospace !important;
  letter-spacing:1.5px !important; text-transform:uppercase !important;
  margin-bottom:8px !important; display:block !important;
}
.chatsku-calc-form .wpforms-form input[type="text"],
.chatsku-calc-form .wpforms-form input[type="email"]{
  background:var(--navy-900) !important;
  border:1px solid var(--line) !important;
  border-radius:10px !important;
  color:var(--ink) !important;
  font-family:'IBM Plex Mono',monospace !important;
  font-size:16px !important; font-weight:600 !important;
  padding:12px 14px !important; width:100% !important;
  transition:border-color .15s !important;
}
.chatsku-calc-form .wpforms-form input:focus{
  border-color:var(--amber) !important;
  box-shadow:0 0 0 3px rgba(244,179,36,.15) !important;
  outline:none !important;
}
.chatsku-calc-form .wpforms-form input::placeholder{
  color:var(--muted) !important;
}
.chatsku-calc-form .wpforms-field-container{text-align:left;}
.chatsku-calc-form .wpforms-submit-container{margin-top:20px !important;}
.chatsku-calc-form .wpforms-form .wpforms-submit{
  display:inline-flex !important; align-items:center !important; justify-content:center !important;
  background:var(--amber) !important; color:var(--navy-900) !important;
  border:none !important; border-radius:12px !important;
  font-family:var(--sans) !important; font-size:16px !important; font-weight:800 !important;
  letter-spacing:-.2px !important; padding:15px 30px !important;
  cursor:pointer !important; width:100% !important; transition:.15s !important;
}
.chatsku-calc-form .wpforms-form .wpforms-submit:hover{ background:var(--amber-soft) !important; }
.chatsku-calc-form .wpforms-confirmation-container-full{
  background:rgba(244,179,36,.08) !important;
  border:1px solid rgba(244,179,36,.4) !important;
  border-radius:12px !important; color:var(--ink) !important;
  padding:24px !important; font-size:15px !important; line-height:1.6 !important;
  text-align:center !important;
}
.chatsku-calc-form .wpforms-error{
  color:#FF6B5A !important; font-size:12px !important; margin-top:4px !important;
}
.chatsku-calc-form .wpforms-has-error input{ border-color:#FF6B5A !important; }
.wpforms-submit-container button.wpforms-submit, button[id^="wpforms-submit-"] {
    background: var(--gold) !important;
    padding: 0 31px !important;
    height: 55px !important;
    color: #000 !important;
}
.change-below {
    font-size: 15px;
    margin-top: 10px;
    color: #00c9b1;
}
span.recRevYrsFull {
    color: var(--amber-soft);
}
span#recRecoverablelity {
    color: var(--amber-soft);
}
/* Responsive */
@media(max-width:820px){
  .grid2,.grid3{grid-template-columns:1fr;gap:20px;}
  .grid4{grid-template-columns:1fr 1fr;gap:18px;}
  .step{grid-template-columns:1fr 90px;} .step .bar{display:none;}
  .calc-brand{display:none;}
  .rhead{flex-direction:column;align-items:flex-start;} .rnum{text-align:left;}
}
@media(max-width:560px){
  .cta-panel,.cta-form-panel{padding:32px 20px;}
  .grid4{grid-template-columns:1fr;}
  .out.hero .ov{font-size:30px;}
  .cta-h{font-size:25px;}
  .cta-btn{width:100%;justify-content:center;padding:15px 14px;font-size:15px;}
  .moc-link{margin-left:0;margin-top:7px;}
  .moc-backdrop{padding:0;align-items:flex-start;justify-content:flex-start;overflow:auto;-webkit-overflow-scrolling:touch;}
  .moc-box{max-width:none;max-height:none;padding:56px 14px 30px;}
  .moc-box img{max-width:none;max-height:none;width:720px;}
  .moc-x{position:fixed;top:12px;right:12px;z-index:1200;}
  .moc-cap{width:auto;}
  .pe-foot{flex-direction:column;align-items:stretch;}
  .pe-foot-r{justify-content:flex-end;}
}
</style>

<!-- Google Fonts for calculator (Archivo + IBM Plex Mono) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="calc-wrap">
  <div class="calc-brand">CHATSKU &middot; B2B CHATCOMMERCE</div>
  <div class="kicker">The March of Commerce &middot; Revenue Model</div>
  <h1>Revenue Left <span class="yel">on the Table</span></h1>
  <p class="calc-sub">Pick where the catalog sits on the maturity curve, set the assumptions, and see the revenue at risk, the cost to fix it, and the net gain.</p>

  <!-- CONTROLS -->
  <div class="c-panel c-pad">
    <div class="grid2">
      <div class="ctl">
        <label>Annual Revenue</label>
        <div class="rev-input"><span>$</span><input id="rev" type="text" inputmode="numeric" value="10,000,000"></div>
        <div class="hint">Total annual sales for the business you are modeling.</div>
      </div>
      <div class="ctl">
        <label>Stage <span class="moc-link" id="mocOpen" role="button" tabindex="0">View the March of Commerce &#8599;</span></label>
        <div class="select-wrap">
          <select id="stage">
            <option value="pdf">PDF Catalog (Stages 01 to 03)</option>
            <option value="html">HTML + RFQ (Stages 04 to 05)</option>
            <option value="plat">Platform / eCommerce (Stages 06 to 08)</option>
          </select>
        </div>
        <div class="hint">Where the prospect's buying experience sits today.</div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="grid3">
      <div class="ctl">
        <label>Contestable Share <span class="info">i</span> <span class="slider-val" id="conV">40%</span></label>
        <input type="range" id="con" min="15" max="70" value="70">
        <div class="range-ends"><span>15%</span><span>70%</span></div>
        <div class="hint">New acquisition plus competitively shoppable orders. Not locked contracts or habitual reorders.</div>
        <div class="pop"><span class="rng">Range 15% to 70%</span><b>How much of your revenue is genuinely in play.</b> The low end is a business that is mostly locked contracts and habitual reorders. The high end is heavy on new accounts and orders a competitor could win. Set it to your share of contestable business.</div>
      </div>
      <div class="ctl">
        <label>Self-Serve Buyers <span class="info">i</span> <span class="slider-val" id="ssV">70%</span></label>
        <input type="range" id="ss" min="40" max="90" value="90">
        <div class="range-ends"><span>40%</span><span>90%</span></div>
        <div class="hint">Share who prefer a rep-free path. Gartner 67 to 70%, LinkedIn 75%.</div>
        <div class="pop"><span class="rng">Range 40% to 90%</span><b>Buyers who prefer to research and buy without a rep.</b> Gartner puts this at 67 to 70%, LinkedIn at 75%. Lower it for relationship-heavy categories, raise it for digitally mature buyers. Above 75% goes past the published figures.</div>
      </div>
      <div class="ctl">
        <label>Stage Leakage <span class="info">i</span> <span class="slider-val" id="leakV">22%</span></label>
        <input type="range" id="leak" min="2" max="35" value="35">
        <div class="range-ends"><span>2%</span><span>35%</span></div>
        <div class="hint">Share of self-serve demand lost at this stage. Each stage carries its own default.</div>
        <div class="pop"><span class="rng">Range 2% to 35%</span><b>The share of self-serve demand a stage loses</b> to dead ends, abandonment, and no answers. It is set per stage and rises the further the experience falls behind the buyer: a PDF sits near the top, a working platform near the bottom. Anchored by 75% who switch for a better experience and 41% who cannot locate products.</div>
      </div>
    </div>
  </div>

  <!-- RESULT -->
  <div class="c-panel result" id="result"></div>

  <!-- RECOVERY + COST -->
  <div class="c-panel recover">
    <div class="recover-rev">
      <div class="rr-label">Recoverable Revenue</div>
      <div class="rr-right">
        <div class="rr-year"><span id="recRevYr">$1.32M</span> <small>per year</small></div>
        <div class="rr-life">Over a <span class="recRevYrsFull"><span id="recRevYrs">4</span>-year</span> at <span id="recRecoverablelity">70%</span> Recoverability</div>
        <div class="change-below">Change Below</div>
      </div>
    </div>
    <div class="divider"></div>
    <h2 class="recover-title">Recoverable</h2>
    <div class="grid4">
      <div class="ctl">
        <label>Recoverable <span class="info">i</span> <span class="slider-val" id="recV">70%</span></label>
        <input type="range" id="rec" min="10" max="100" value="70">
        <div class="range-ends"><span>10%</span><span>100%</span></div>
        <div class="hint">Share of the leak ChatSKU closes.</div>
        <div class="pop"><span class="rng">Range 10% to 100%</span><b>The share of the leak ChatSKU recovers</b> by answering buyers from your existing catalog. Higher for stages starting from zero self-serve, like a PDF, where the jump is largest. A directional estimate, tune it to real results.</div>
      </div>
      <div class="ctl">
        <label>Customer Lifetime <span class="slider-val" id="yrsV">4 yrs</span></label>
        <input type="range" id="yrs" min="1" max="8" value="4">
        <div class="hint">A recovered buyer reorders for years. B2B accounts run 3 to 7.</div>
      </div>
      <div class="ctl" style="display:none">
        <label style="color: var(--gold)">Setup Cost</label>
        <div class="cost-input"><span>$</span><input id="setup" type="text" inputmode="numeric" value="2,500"></div>
        <div class="hint">One-time onboarding fee.</div>
      </div>
      <div class="ctl" style="display:none">
        <label style="color: var(--gold)">Monthly Cost</label>
        <div class="cost-input"><span>$</span><input id="mo" type="text" inputmode="numeric" value="750"><span class="per">/mo</span></div>
        <div class="hint">Recurring subscription.</div>
      </div>
    </div>
    <button type="button" class="pe-cta" id="peOpen" style="display:none">Not sure of your ChatSKU cost? Calculate it &rarr;</button>
    
  </div>

  <!-- CTA -->
  <div class="c-panel cta-panel">
    <div class="cta-h">Stop estimating the leak. <span class="yel">Start the Recovery.</span></div>
    <p class="cta-sub">Every month the catalog stays static, that revenue keeps walking.</p>
    <!-- <a class="cta-btn" id="ctaBook" href="https://chatsku.com/book" target="_blank" rel="noopener">Book a 15-minute walkthrough &rarr;</a> -->
    <?php if ( $calc_form_id > 0 ) : ?>
        <?php echo do_shortcode( '[wpforms id="' . intval( $calc_form_id ) . '" title="false"]' ); ?>
      <?php else : ?>
        <div style="background:rgba(244,179,36,.1);border:1px dashed rgba(244,179,36,.5);border-radius:10px;padding:18px 20px;color:var(--slate);font-family:'IBM Plex Mono',monospace;font-size:12px;line-height:1.7;text-align:left;">
          <strong style="color:var(--amber);display:block;margin-bottom:8px;">⚙ Developer note: WPForms form not connected yet</strong>
          1. Create a WPForms form named "Calculator Lead Capture" (see plan for field list).<br>
          2. Set <code style="color:var(--amber);">$calc_form_id</code> in <code>page-calculator.php</code> to the form's ID.<br>
          3. Configure admin + user notifications and the confirmation message.
        </div>
      <?php endif; ?>
    <p class="cta-free">Free plan upto 100 products for 3 months or first quote, which our earlier</p>
  </div>

  <!-- LEAD CAPTURE FORM -->


  <div class="calc-foot">
    <b>Method.</b> Annual revenue at risk = Revenue &times; Contestable share &times; Self-serve buyers &times; Stage leakage. That leak recurs yearly and a recovered buyer keeps reordering, so lifetime value recovered = annual recovered &times; customer lifetime. Lifetime cost = setup + monthly &times; 12 &times; lifetime. Net gain = recovered minus cost, over the same horizon.<br>
    <b>Sources.</b> LinkedIn, The Trust Advantage (2026) &middot; Gartner B2B buyer surveys (2026): 67% rep-free, 70% fully self-service &middot; Sana Commerce B2B Buyer Report (2025): 75% would switch for a better experience, 91% among US buyers, 41% of manufacturing buyers cannot locate products &middot; Atwix B2B conversion benchmarks (2026).<br>
    <b>Note.</b> A modeled, directional estimate for illustration, not a guarantee. Replace the cost fields with real ChatSKU pricing and adjust the assumptions to fit the business.
  </div>
</div>

<!-- ═══ PRICING ESTIMATOR MODAL ════════════════════════════════════════════════ -->
<div class="pe-backdrop" id="peBackdrop">
  <div class="pe-modal" role="dialog" aria-modal="true" aria-label="ChatSKU Pricing Estimator">
    <div class="pe-head">
      <div class="pe-title">ChatSKU Pricing Estimator</div>
      <button class="pe-x" id="peClose" aria-label="Close">&times;</button>
    </div>
    <div class="pe-body"><iframe id="peFrame" title="ChatSKU Pricing Estimator"></iframe></div>
    <div class="pe-foot">
      <div>
        <span class="pe-foot-lbl">Estimated ChatSKU price</span>
        <span class="pe-summary" id="peSummary">adjust your usage in the calculator</span>
      </div>
      <div class="pe-foot-r">
        <button class="pe-btn ghost" id="peCancel">Cancel</button>
        <button class="pe-btn primary" id="peApply">Apply to ROI &rarr;</button>
      </div>
    </div>
  </div>
</div>

<!-- ═══ MARCH OF COMMERCE MODAL ════════════════════════════════════════════════ -->
<div class="moc-backdrop" id="mocBackdrop">
  <div class="moc-box">
    <button class="moc-x" id="mocClose" aria-label="Close">&times;</button>
    <?php if ( $moc_image_src ) : ?>
      <img src="<?php echo esc_url( $moc_image_src ); ?>" alt="The March of Commerce — B2B Commerce Evolution">
    <?php else : ?>
      <div style="background:#0B2545;border-radius:12px;padding:60px 40px;text-align:center;color:#9FC0E8;font-family:'IBM Plex Mono',monospace;font-size:13px;min-width:480px;">
        <strong style="color:#F4B324;display:block;margin-bottom:12px;">Image not yet extracted</strong>
        Upload march-of-commerce.png to the theme's assets/images/ folder.
      </div>
    <?php endif; ?>
    <div class="moc-cap">The March of Commerce &middot; B2B Commerce Evolution</div>
  </div>
</div>

<script>
/* ── Calculator state ────────────────────────────────────────────────────────── */
const BUCKETS={
  pdf:{n:'PDF Catalog', stages:'Stages 01 to 03 · Paper, PDF, Flipbook', leak:35,
    why:'<b>No self-serve buying experience at all.</b> The catalog is a document, not a transaction. Nearly every rep-free buyer hits a wall, and 75% say they would switch for a better experience (91% among US buyers). This stage is the most exposed in the market.'},
  html:{n:'HTML + RFQ', stages:'Stages 04 to 05 · HTML Catalog, RFQ Form', leak:25,
    why:'<b>Buyers can browse but cannot transact or get answers.</b> They fill a form and wait. After-hours demand and impatient self-serve buyers leak to a competitor who responds first. Partial coverage lowers the rate, but the gap is still wide.'},
  plat:{n:'Platform / eCommerce', stages:'Stages 06 to 08 · Portal, eCommerce, Chat', leak:15,
    why:'<b>A working store exists, but discovery and expert answers still fail.</b> 41% of manufacturing buyers cannot locate the products they need even on web stores, and dumb support chat is not commerce. Lowest leak of the three, but far from zero.'}
};
let state={rev:10000000, con:70, ss:90, sel:'pdf', rec:70, yrs:4, setup:2500, mo:750};
let customPricing=false;
let reasoningOpen=false;

const num=v=>v.toLocaleString('en-US');
const money=v=>'$'+Math.round(v).toLocaleString('en-US');
const moneyK=v=>{v=Math.round(v); if(v>=1e6)return '$'+(v/1e6).toFixed(2).replace(/\.?0+$/,'')+'M'; if(v>=1e3)return '$'+Math.round(v/1e3)+'K'; return '$'+v;};
const parseNum=s=>parseInt((s||'').toString().replace(/[^0-9]/g,''))||0;
const fill=(id,val,min,max)=>{const e=document.getElementById(id); if(e) e.style.setProperty('--p',((val-min)/(max-min)*100)+'%');};
// Null-safe text write — a removed/renamed element must never abort the script (which would kill the modals).
const setTxt=(id,val)=>{const e=document.getElementById(id); if(e) e.textContent=val;};

function renderResult(){
  const b=BUCKETS[state.sel];
  const contest=state.rev*(state.con/100);
  const selfserve=contest*(state.ss/100);
  const leak=selfserve*(b.leak/100);
  const pct=state.rev?(leak/state.rev*100):0;
  const max=state.rev||1; const w=v=>Math.max(2,(v/max*100))+'%';
  document.getElementById('result').innerHTML=`
    <div class="rhead">
      <div class="rleft"><div class="rtitle">Revenue at Risk</div><div class="rstages">${b.stages}</div><div class="rname">${b.n}</div></div>
      <div class="rnum">
        <div class="rbig">${pct.toFixed(1)}% / ${moneyK(leak)}</div>
        <div class="rpct">per year</div>
        <div class="rmulti">Over a ${state.yrs}-year relationship: <b>${moneyK(leak*state.yrs)}</b></div>
      </div>
    </div>
    <details class="steps" ${reasoningOpen?'open':''}>
    <summary class="steps-h">The Details</summary>
    <p class="steps-sub">How <b>${money(state.rev)}</b> in revenue narrows to the demand the <b>${b.n}</b> stage puts at risk each year.</p>
    <div class="step"><div class="slabel">Annual revenue<small>the full base</small></div><div class="bar"><i style="width:100%"></i></div><div class="sval">${money(state.rev)}</div></div>
    <div class="step"><div class="slabel">&times; Contestable share &middot; ${state.con}%<small>new + shoppable, not locked-in</small></div><div class="bar"><i style="width:${w(contest)}"></i></div><div class="sval">${money(contest)}</div></div>
    <div class="step"><div class="slabel">&times; Self-serve buyers &middot; ${state.ss}%<small>want a rep-free path</small></div><div class="bar"><i style="width:${w(selfserve)}"></i></div><div class="sval">${money(selfserve)}</div></div>
    <div class="step final"><div class="slabel">&times; Stage leakage &middot; ${b.leak}%<small>lost to defection, abandonment, no-answer</small></div><div class="bar"><i style="width:${w(leak)}"></i></div><div class="sval">${money(leak)}</div></div>
    <div class="why">${b.why}</div>
    </details>`;
  return leak;
}

function renderRecovery(leak){
  const recYr=leak*(state.rec/100);
  const recLife=recYr*state.yrs;
  setTxt('recRevYr', moneyK(recYr));
  setTxt('recRevLife', moneyK(recLife));
  setTxt('recRevYrs', state.yrs);
}

function applyCustomPricing(on){
  customPricing = on;
  const sWrap = setupEl.closest('.cost-input'), mWrap = moEl.closest('.cost-input');
  if (on) {
    sWrap.classList.add('is-custom'); mWrap.classList.add('is-custom');
    setupEl.value='Custom'; setupEl.readOnly=true;
    moEl.value='Custom';    moEl.readOnly=true;
  } else {
    sWrap.classList.remove('is-custom'); mWrap.classList.remove('is-custom');
    setupEl.readOnly=false; moEl.readOnly=false;
    setupEl.value=num(state.setup); moEl.value=num(state.mo);
  }
}

function renderAll(){
  setTxt('conV', state.con+'%');
  setTxt('ssV', state.ss+'%');
  setTxt('recV', state.rec+'%');
  setTxt('recRecoverablelity', state.rec+'%');
  setTxt('yrsV', state.yrs+' yrs');
  setTxt('leakV', BUCKETS[state.sel].leak+'%');
  fill('con',state.con,15,70); fill('ss',state.ss,40,90);
  fill('rec',state.rec,10,100); fill('yrs',state.yrs,1,8);
  fill('leak',BUCKETS[state.sel].leak,2,35);
  renderRecovery(renderResult());
}

/* ── Input event wiring ──────────────────────────────────────────────────────── */
const rev=document.getElementById('rev');
rev.addEventListener('input',()=>{state.rev=parseNum(rev.value);rev.value=state.rev?num(state.rev):'';renderAll();});
document.getElementById('stage').addEventListener('change',e=>{
  state.sel=e.target.value;
  document.getElementById('leak').value=BUCKETS[state.sel].leak;
  renderAll();
});
document.getElementById('con').addEventListener('input',e=>{state.con=+e.target.value;renderAll();});
document.getElementById('ss').addEventListener('input',e=>{state.ss=+e.target.value;renderAll();});
document.getElementById('leak').addEventListener('input',e=>{BUCKETS[state.sel].leak=+e.target.value;renderAll();});
document.getElementById('rec').addEventListener('input',e=>{state.rec=+e.target.value;renderAll();});
document.getElementById('yrs').addEventListener('input',e=>{state.yrs=+e.target.value;renderAll();});
const setupEl=document.getElementById('setup');
setupEl.addEventListener('input',()=>{state.setup=parseNum(setupEl.value);setupEl.value=state.setup?num(state.setup):'';renderAll();});
const moEl=document.getElementById('mo');
moEl.addEventListener('input',()=>{state.mo=parseNum(moEl.value);moEl.value=state.mo?num(state.mo):'';renderAll();});
/* Clicking a cost field while Custom is applied restores editable numbers */
[setupEl, moEl].forEach(function(el){
  el.addEventListener('focus',function(){
    if(customPricing){ applyCustomPricing(false); renderAll(); setTimeout(function(){ el.select(); },0); }
  });
});

/* ── Info popover buttons ──────────────────────────────────────────────────────── */
document.querySelectorAll('.info').forEach(b=>{
  b.addEventListener('click',e=>{
    e.stopPropagation();
    const pop=b.closest('.ctl').querySelector('.pop');
    const open=pop.classList.contains('open');
    document.querySelectorAll('.pop.open').forEach(p=>p.classList.remove('open'));
    if(!open)pop.classList.add('open');
  });
});
document.querySelectorAll('.pop').forEach(p=>p.addEventListener('click',e=>e.stopPropagation()));
document.addEventListener('click',()=>document.querySelectorAll('.pop.open').forEach(p=>p.classList.remove('open')));

renderAll();

/* Keep the reasoning accordion's open/closed state across slider re-renders */
document.getElementById('result').addEventListener('toggle', function(e){
  if(e.target && e.target.classList && e.target.classList.contains('steps')) reasoningOpen = e.target.open;
}, true);

/* ── Pricing Estimator modal ───────────────────────────────────────────────────── */
// Declared at top level so the WPForms bridge (below) can read it
var latestEstimatorInputs = null;

(function(){
  var ESTIMATOR_URL = '<?php echo esc_url( $estimator_url ); ?>';
  var backdrop=document.getElementById('peBackdrop');
  var frame=document.getElementById('peFrame');
  var summary=document.getElementById('peSummary');
  var loaded=false, latest=null; // latestEstimatorInputs declared globally above

  function openModal(){
    if(!loaded){ frame.src=ESTIMATOR_URL; loaded=true; }
    backdrop.classList.add('open');
    document.body.style.overflow='hidden';
  }
  function closeModal(){ backdrop.classList.remove('open'); document.body.style.overflow=''; }

  document.getElementById('peOpen').addEventListener('click',openModal);
  document.getElementById('peClose').addEventListener('click',closeModal);
  document.getElementById('peCancel').addEventListener('click',closeModal);
  backdrop.addEventListener('click',function(e){ if(e.target===backdrop) closeModal(); });
  document.addEventListener('keydown',function(e){ if(e.key==='Escape' && backdrop.classList.contains('open')) closeModal(); });

  window.addEventListener('message',function(e){
    var d=e.data; if(!d || d.type!=='chatsku-price') return;
    latest=d;
    if(d.catalog) latestEstimatorInputs=d;
    summary.innerHTML = d.over
      ? 'Custom range &middot; from <b>'+money(d.monthly)+'/mo</b>'
      : '<b>'+money(d.monthly)+'/mo</b> &nbsp;+&nbsp; <b>$'+Math.round(d.setup).toLocaleString('en-US')+'</b> setup';
  });

  document.getElementById('peApply').addEventListener('click',function(){
    if(latest){
      state.mo=Math.round(latest.monthly);
      state.setup=Math.round(latest.setup);
      applyCustomPricing(!!latest.over);
      renderAll();
    }
    closeModal();
  });
})();

/* ── March of Commerce modal ───────────────────────────────────────────────────── */
(function(){
  var bd=document.getElementById('mocBackdrop'), op=document.getElementById('mocOpen');
  function open(){ bd.classList.add('open'); document.body.style.overflow='hidden'; }
  function close(){ bd.classList.remove('open'); document.body.style.overflow=''; }
  op.addEventListener('click',open);
  op.addEventListener('keydown',function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); open(); } });
  document.getElementById('mocClose').addEventListener('click',close);
  bd.addEventListener('click',function(e){ if(e.target===bd) close(); });
  document.addEventListener('keydown',function(e){ if(e.key==='Escape' && bd.classList.contains('open')) close(); });
})();

/* ── WPForms bridge → Calendly A1–A10 ──────────────────────────────────────────
   A1–A5 : main calculator values (always available on page load)
   A6–A10: pricing estimator popup values (populated when user opens the popup)
   CSS class convention on wrapper div: chatsku-field-a1 ... chatsku-field-a10
   Runs immediately (script is at bottom of page — DOM is already ready).
   ──────────────────────────────────────────────────────────────────────────────── */
(function(){
  var wpForm = document.querySelector('form.wpforms-form'); // works regardless of wrapper class
  if (!wpForm) return;

  function fmt(n){ return Math.round(n).toLocaleString('en-US'); }
  function setField(cls, value){
    // WPForms applies CSS classes to the wrapper <div>, not the <input>
    var wrapper = wpForm.querySelector('.chatsku-field-' + cls);
    var el = wrapper ? wrapper.querySelector('input') : null;
    if (el) el.value = value;
  }

  wpForm.addEventListener('submit', function(){
    // A1–A5: main calculator state
    setField('a1', state.con + '%');
    setField('a2', state.ss + '%');
    setField('a3', BUCKETS[state.sel].leak + '%');
    setField('a4', state.rec + '%');
    setField('a5', state.yrs + ' years');

    // A6–A10: pricing estimator popup inputs (only if user opened the popup)
    if (latestEstimatorInputs) {
      var c = latestEstimatorInputs.catalog;
      setField('a6', fmt(c.pages)+' pages · '+fmt(c.products)+' products · '+c.images+' imgs/product · '+c.variants+' variants');
      setField('a7', fmt(latestEstimatorInputs.traffic.visitors)+' chatbot visitors/mo');
      var cm = latestEstimatorInputs.commerce;
      setField('a8', fmt(cm.quotes)+' quotes/mo · '+fmt(cm.orders)+' orders/mo');
      var s = latestEstimatorInputs.syncs;
      setField('a9', fmt(s.osync)+' order syncs · '+fmt(s.qsync)+' quote syncs');
      var pr = latestEstimatorInputs.premium;
      setField('a10', fmt(pr.image)+' image searches · '+fmt(pr.voice)+' voice searches');
    }
  });
})(); // run immediately — DOM is ready
</script>

</main>

<!-- ═══ ROI Calculator — first-time guided tour + persistent Guide button ═══ -->
<style id="roi-tour-css">
.roi-guide-btn{position:fixed;left:20px;bottom:20px;z-index:9000;display:inline-flex;align-items:center;gap:8px;background:#0B2545;color:#F2F4F8;border:1px solid rgba(159,192,232,.28);border-radius:999px;padding:10px 15px;font-family:'IBM Plex Mono',monospace;font-size:12.5px;font-weight:600;letter-spacing:.3px;cursor:pointer;box-shadow:0 10px 28px rgba(0,0,0,.45);transition:border-color .15s,color .15s,transform .12s;}
.roi-guide-btn:hover{border-color:#F4B324;color:#fff;transform:translateY(-1px);}
.roi-guide-btn svg{width:16px;height:16px;color:#F4B324;flex:none;}
.roi-tour[hidden]{display:none;}
.roi-tour__spot{position:fixed;z-index:100000;border-radius:10px;box-shadow:0 0 0 9999px rgba(7,24,46,.82);border:2px solid #F4B324;pointer-events:none;transition:top .25s ease,left .25s ease,width .25s ease,height .25s ease;}
.roi-tour__pop{position:fixed;z-index:100001;width:330px;max-width:calc(100vw - 24px);background:#0B2545;border:1px solid rgba(159,192,232,.28);border-radius:12px;padding:18px 18px 16px;box-shadow:0 24px 60px -16px rgba(0,0,0,.7);font-family:'Archivo',system-ui,sans-serif;color:#F2F4F8;}
.roi-tour__x{position:absolute;top:9px;right:11px;background:none;border:none;color:#7E99BC;font-size:21px;line-height:1;cursor:pointer;padding:2px 6px;}
.roi-tour__x:hover{color:#fff;}
.roi-tour__step{font-family:'IBM Plex Mono',monospace;font-size:10.5px;letter-spacing:1.5px;text-transform:uppercase;color:#F4B324;margin-bottom:8px;}
.roi-tour__title{font-size:17px;font-weight:800;margin:0 0 6px;color:#fff;letter-spacing:-.2px;}
.roi-tour__body{font-size:13.5px;line-height:1.55;color:#9FC0E8;margin:0 0 16px;}
.roi-tour__nav{display:flex;align-items:center;justify-content:space-between;gap:10px;}
.roi-tour__nav-r{display:flex;gap:8px;}
.roi-tour__skip{background:none;border:none;color:#7E99BC;font-size:12.5px;cursor:pointer;padding:6px 4px;font-family:inherit;}
.roi-tour__skip:hover{color:#cdd9ea;}
.roi-tour__back{background:none;border:1px solid rgba(159,192,232,.3);color:#cdd9ea;border-radius:8px;padding:7px 14px;font-size:12.5px;font-weight:600;cursor:pointer;font-family:inherit;}
.roi-tour__back[disabled]{opacity:.4;cursor:not-allowed;}
.roi-tour__next{background:#F4B324;border:none;color:#07182E;border-radius:8px;padding:7px 16px;font-size:12.5px;font-weight:700;cursor:pointer;font-family:inherit;}
.roi-tour__next:hover{background:#FFC94D;}
@media(max-width:560px){.roi-guide-btn span{display:none;}.roi-guide-btn{padding:12px;}}
</style>

<button type="button" class="roi-guide-btn" id="roiGuideBtn" aria-label="Open the ROI calculator guide">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
  <span>User Guide</span>
</button>

<div class="roi-tour" id="roiTour" hidden>
  <div class="roi-tour__spot" id="roiTourSpot" aria-hidden="true"></div>
  <div class="roi-tour__pop" id="roiTourPop" role="dialog" aria-modal="false" aria-labelledby="roiTourTitle">
    <button type="button" class="roi-tour__x" id="roiTourClose" aria-label="Close guide">&times;</button>
    <div class="roi-tour__step" id="roiTourStep"></div>
    <h4 class="roi-tour__title" id="roiTourTitle"></h4>
    <p class="roi-tour__body" id="roiTourBody"></p>
    <div class="roi-tour__nav">
      <button type="button" class="roi-tour__skip" id="roiTourSkip">Skip</button>
      <div class="roi-tour__nav-r">
        <button type="button" class="roi-tour__back" id="roiTourBack">Back</button>
        <button type="button" class="roi-tour__next" id="roiTourNext">Next</button>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  var KEY='chatsku_roi_tour_v1';
  var STEPS=[
    {sel:'#rev',   title:'Annual Revenue',    body:"Enter or adjust your company's annual revenue to get a more accurate ROI estimate."},
    {sel:'#stage', title:'Stage',             body:'Select the sales stage that best matches your current customer journey.'},
    {sel:'#con',   title:'Contestable Share', body:'Adjust the percentage of revenue that can potentially be influenced or captured through ChatSKU.'},
    {sel:'#ss',    title:'Self-Serve Buyers', body:'Estimate the percentage of customers who prefer to research and purchase without speaking to a sales representative.'},
    {sel:'#leak',  title:'Stage Leakage',     body:'Set the percentage of potential customers lost during the selected sales stage.'},
    {sel:'#rec',   title:'Recoverable',       body:'Use the slider to estimate how much of the lost revenue could be recovered with improved buyer engagement and support.'},
    {sel:'#yrs',   title:'Customer Lifetime', body:'Select the average customer lifetime to calculate the long-term revenue impact and ROI.'}
  ];
  var tour=document.getElementById('roiTour'); if(!tour) return;
  var spot=document.getElementById('roiTourSpot'), pop=document.getElementById('roiTourPop');
  var elStep=document.getElementById('roiTourStep'), elTitle=document.getElementById('roiTourTitle'), elBody=document.getElementById('roiTourBody');
  var btnBack=document.getElementById('roiTourBack'), btnNext=document.getElementById('roiTourNext');
  var i=0, active=false, curTarget=null, rafId=null;

  function targetEl(n){ var b=document.querySelector(STEPS[n].sel); return b ? (b.closest('.ctl')||b) : null; }
  function position(){
    if(!curTarget) return;
    var r=curTarget.getBoundingClientRect(), pad=8;
    spot.style.top=(r.top-pad)+'px'; spot.style.left=(r.left-pad)+'px';
    spot.style.width=(r.width+pad*2)+'px'; spot.style.height=(r.height+pad*2)+'px';
    var pw=pop.offsetWidth, ph=pop.offsetHeight, vw=window.innerWidth, vh=window.innerHeight, m=12;
    var top=r.bottom+14; if(top+ph>vh-m) top=r.top-ph-14; if(top<m) top=m;
    var left=r.left; if(left+pw>vw-m) left=vw-m-pw; if(left<m) left=m;
    pop.style.top=top+'px'; pop.style.left=left+'px';
  }
  function onScroll(){ if(!active) return; if(rafId) cancelAnimationFrame(rafId); rafId=requestAnimationFrame(position); }
  function show(n){
    if(n<0) n=0; if(n>STEPS.length-1) n=STEPS.length-1; i=n;
    var t=targetEl(i);
    if(!t){ if(i<STEPS.length-1){ show(i+1); } else { end(true); } return; }
    curTarget=t;
    elStep.textContent='Step '+(i+1)+' of '+STEPS.length;
    elTitle.textContent=STEPS[i].title;
    elBody.textContent=STEPS[i].body;
    btnBack.disabled=(i===0);
    btnNext.textContent=(i===STEPS.length-1)?'Finish':'Next';
    try{ t.scrollIntoView({behavior:'smooth',block:'center'}); }catch(e){ t.scrollIntoView(); }
    position(); setTimeout(position,360);
  }
  function start(){ active=true; tour.hidden=false; show(0); }
  function end(seen){ active=false; tour.hidden=true; curTarget=null; if(seen){ try{ localStorage.setItem(KEY,'1'); }catch(e){} } }

  btnNext.addEventListener('click', function(){ if(i<STEPS.length-1) show(i+1); else end(true); });
  btnBack.addEventListener('click', function(){ if(i>0) show(i-1); });
  document.getElementById('roiTourSkip').addEventListener('click', function(){ end(true); });
  document.getElementById('roiTourClose').addEventListener('click', function(){ end(true); });
  document.getElementById('roiGuideBtn').addEventListener('click', function(){ start(); });
  window.addEventListener('scroll', onScroll, true);
  window.addEventListener('resize', onScroll);
  document.addEventListener('keydown', function(e){
    if(!active) return;
    if(e.key==='Escape'){ end(true); }
    else if(e.key==='ArrowRight'){ if(i<STEPS.length-1) show(i+1); else end(true); }
    else if(e.key==='ArrowLeft'){ if(i>0) show(i-1); }
  });

  var seen=false; try{ seen=!!localStorage.getItem(KEY); }catch(e){}
  if(!seen){ setTimeout(start,900); }
})();
</script>

<?php get_footer(); ?>
