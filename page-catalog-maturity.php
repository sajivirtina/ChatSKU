<?php
/**
 * Template Name: Catalog Maturity Index
 *
 * "Catalog Maturity Index" self-assessment — 7 sliders, scored 0–100,
 * with a WPForms soft-gate email capture and CTA to the Revenue Calculator.
 *
 * Setup checklist:
 *  1. Import WPForms JSON (form ID 188, "Catalog Maturity") via WPForms → Tools → Import.
 *  2. Create a WP page: template "Catalog Maturity Index", slug "catalog-maturity".
 *  3. WPForms notifications: update admin notification; add user confirmation to {field_id="17"}.
 *  4. Update $pillar_url below once the pillar page is live.
 *
 * Based on: chatsku-catalog-maturity-index.html
 *
 * @package ChatSKU
 */

get_header();

// ── WPForms form ID ─────────────────────────────────────────────────────────────
$cmi_form_id = 188;

// ── Pillar page URL (update once live) ──────────────────────────────────────────
$pillar_url = '/b2b-catalog-trigger-events/';

// ── Revenue Calculator link ──────────────────────────────────────────────────────
$roi_calc_url = '/roi-calculator/';
?>

<main id="main" class="chatsku-main chatsku-cmi-main">

<style>
/* ══════════════════════════════════════════════════════════════════════════════
   ChatSKU Catalog Maturity Index (page-catalog-maturity.php)
   All styles from chatsku-catalog-maturity-index.html, scoped to .chatsku-cmi-main
   ══════════════════════════════════════════════════════════════════════════════ */
.chatsku-cmi-main{
  font-family:'Archivo',system-ui,sans-serif; color:#F2F4F8;
  background:radial-gradient(140% 120% at 15% 0%, #103257 0%, #0B2545 45%, #06121F 100%);
  background-attachment:fixed; min-height:100vh; line-height:1.45; padding:38px 22px 60px;
}
.chatsku-cmi-main *{margin:0;padding:0;box-sizing:border-box;}
.cmi-wrap{max-width:980px;margin:0 auto; padding-top:60px;}
.chatsku-cmi-main .kicker{font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:5px;color:#F4B324;text-transform:uppercase;font-weight:600;}
.chatsku-cmi-main h1{font-size:clamp(30px,5vw,52px);font-weight:800;letter-spacing:-1.2px;line-height:1.02;margin:12px 0 10px;}
.chatsku-cmi-main h1 .yel{color:#F4B324;}
.chatsku-cmi-main .sub{color:#9FC0E8;max-width:660px;font-size:16px;}
.chatsku-cmi-main .brand{float:right;font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:2px;color:#7E99BC;border:1px solid rgba(159,192,232,.16);padding:7px 12px;border-radius:8px;}

.chatsku-cmi-main .panel{background:rgba(11,37,69,.55);border:1px solid rgba(159,192,232,.16);border-radius:16px;backdrop-filter:blur(4px);position:relative;}
.chatsku-cmi-main .pad{padding:26px 28px;margin-top:30px;}

.chatsku-cmi-main .qhead{display:flex;justify-content:space-between;align-items:baseline;gap:14px;margin-bottom:4px;}
.chatsku-cmi-main .qhead .qlabel{font-weight:700;font-size:17px;letter-spacing:-.2px;}
.chatsku-cmi-main .qhead .qval{font-family:'IBM Plex Mono',monospace;color:#F4B324;font-weight:600;font-size:15px;white-space:nowrap;}
.chatsku-cmi-main .ctl{padding:18px 0;border-top:1px solid rgba(159,192,232,.16);position:relative;}
.chatsku-cmi-main .ctl:first-of-type{border-top:none;padding-top:4px;}
.chatsku-cmi-main input[type=range]{-webkit-appearance:none;appearance:none;width:100%;height:5px;border-radius:6px;background:linear-gradient(90deg,#F4B324 var(--p,50%),rgba(159,192,232,.2) var(--p,50%));outline:none;margin:14px 0 10px;}
.chatsku-cmi-main input[type=range]::-webkit-slider-thumb{-webkit-appearance:none;height:20px;width:20px;border-radius:50%;background:#F4B324;cursor:pointer;border:3px solid #07182E;box-shadow:0 0 0 1px #F4B324;}
.chatsku-cmi-main input[type=range]::-moz-range-thumb{height:18px;width:18px;border-radius:50%;background:#F4B324;cursor:pointer;border:3px solid #07182E;}
.chatsku-cmi-main .ends{display:flex;justify-content:space-between;font-family:'IBM Plex Mono',monospace;font-size:11.5px;color:#7E99BC;letter-spacing:.3px;}
.chatsku-cmi-main .ends .lo{max-width:46%;} .chatsku-cmi-main .ends .hi{max-width:46%;text-align:right;}
.chatsku-cmi-main .info{display:inline-flex;align-items:center;justify-content:center;width:15px;height:15px;border-radius:50%;border:1px solid #7E99BC;color:#9FC0E8;font-family:Georgia,serif;font-size:10px;font-weight:700;font-style:italic;cursor:pointer;vertical-align:middle;margin-left:6px;transition:.15s;user-select:none;flex:none;}
.chatsku-cmi-main .info:hover{border-color:#F4B324;color:#F4B324;}
.chatsku-cmi-main .pop{display:none;position:absolute;z-index:40;top:34px;left:0;width:300px;max-width:86vw;background:#07182E;border:1px solid #F4B324;border-radius:10px;padding:13px 15px;font-size:12.5px;line-height:1.55;color:#9FC0E8;box-shadow:0 18px 44px -14px rgba(0,0,0,.75);}
.chatsku-cmi-main .pop.open{display:block;}

/* RESULT */
.chatsku-cmi-main .result{padding:30px 32px;margin-top:18px;overflow:hidden;}
.chatsku-cmi-main .score-row{display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;}
.chatsku-cmi-main .score-big{font-family:'IBM Plex Mono',monospace;font-weight:700;font-size:clamp(52px,10vw,86px);letter-spacing:-3px;line-height:.9;color:#F4B324;}
.chatsku-cmi-main .score-big small{font-size:22px;color:#9FC0E8;font-weight:500;letter-spacing:0;}
.chatsku-cmi-main .score-cap{font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:2px;color:#7E99BC;text-transform:uppercase;margin-top:8px;}
.chatsku-cmi-main .stage-name{font-size:26px;font-weight:800;letter-spacing:-.5px;text-align:right;}
.chatsku-cmi-main .stage-stages{font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:1.5px;color:#7E99BC;text-transform:uppercase;text-align:right;margin-top:5px;}

/* maturity curve */
.chatsku-cmi-main .curve{margin:30px 0 6px;}
.chatsku-cmi-main .curve-track{position:relative;height:62px;border-radius:12px;overflow:hidden;display:flex;border:1px solid rgba(159,192,232,.16);}
.chatsku-cmi-main .zone{flex:1;display:flex;flex-direction:column;justify-content:flex-end;padding:9px 12px;position:relative;}
.chatsku-cmi-main .zone.z1{background:linear-gradient(180deg,rgba(159,192,232,.05),rgba(159,192,232,.12));}
.chatsku-cmi-main .zone.z2{background:linear-gradient(180deg,rgba(244,179,36,.06),rgba(244,179,36,.14));}
.chatsku-cmi-main .zone.z3{background:linear-gradient(180deg,rgba(123,211,137,.06),rgba(123,211,137,.16));}
.chatsku-cmi-main .zone .zname{font-weight:700;font-size:13px;letter-spacing:-.2px;}
.chatsku-cmi-main .zone .zsub{font-family:'IBM Plex Mono',monospace;font-size:10px;color:#7E99BC;letter-spacing:.5px;margin-top:1px;}
.chatsku-cmi-main .zone+.zone{border-left:1px solid rgba(159,192,232,.16);}
.chatsku-cmi-main .marker{position:absolute;top:-6px;bottom:-6px;width:3px;background:#F2F4F8;border-radius:3px;transition:left .55s cubic-bezier(.2,.7,.2,1);box-shadow:0 0 0 4px rgba(7,24,46,.6);z-index:3;}
.chatsku-cmi-main .marker::after{content:"";position:absolute;top:-7px;left:50%;transform:translateX(-50%);width:13px;height:13px;border-radius:50%;background:#F2F4F8;box-shadow:0 0 0 4px rgba(7,24,46,.6);}
.chatsku-cmi-main .marker-label{position:absolute;top:-34px;left:50%;transform:translateX(-50%);font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:1px;color:#F2F4F8;background:#103257;border:1px solid rgba(159,192,232,.16);padding:3px 8px;border-radius:6px;white-space:nowrap;text-transform:uppercase;}
.chatsku-cmi-main .curve-wrap{position:relative;padding-top:36px;}

.chatsku-cmi-main .diag{margin-top:24px;padding:16px 18px;background:rgba(7,24,46,.6);border-left:3px solid #F4B324;border-radius:8px;font-size:15px;color:#9FC0E8;line-height:1.5;}
.chatsku-cmi-main .diag b{color:#F2F4F8;}

.chatsku-cmi-main .exp-h{font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:2px;color:#F4B324;text-transform:uppercase;margin:26px 0 4px;}
.chatsku-cmi-main .exp-sub{color:#9FC0E8;font-size:14px;margin-bottom:16px;}
.chatsku-cmi-main .exp-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.chatsku-cmi-main .exp-card{background:#07182E;border:1px solid rgba(159,192,232,.16);border-radius:12px;padding:16px 16px 14px;}
.chatsku-cmi-main .exp-card .ecname{font-weight:700;font-size:15px;margin-bottom:10px;letter-spacing:-.2px;}
.chatsku-cmi-main .exp-mini{height:7px;border-radius:5px;background:rgba(159,192,232,.14);overflow:hidden;margin-bottom:14px;}
.chatsku-cmi-main .exp-mini i{display:block;height:100%;border-radius:5px;background:linear-gradient(90deg,#c9554a,#e08b3c);}
.chatsku-cmi-main .exp-trig{font-family:'IBM Plex Mono',monospace;font-size:11.5px;color:#9FC0E8;line-height:1.7;letter-spacing:.2px;}
.chatsku-cmi-main .exp-trig span{color:#F4B324;}
.chatsku-cmi-main .exp-trig a{color:#9FC0E8;text-decoration:none;border-bottom:1px solid transparent;transition:.15s;}
.chatsku-cmi-main .exp-trig a:hover{color:#F2F4F8;border-bottom-color:#F4B324;}
.chatsku-cmi-main .exp-bench{margin-top:12px;padding-top:12px;border-top:1px solid rgba(159,192,232,.16);}
.chatsku-cmi-main .ebstat{font-family:'IBM Plex Mono',monospace;font-size:22px;font-weight:700;color:#F4B324;letter-spacing:-.5px;}
.chatsku-cmi-main .eblabel{font-size:12px;color:#9FC0E8;margin-top:3px;line-height:1.45;}
.chatsku-cmi-main .ebsrc{font-family:'IBM Plex Mono',monospace;font-size:10px;color:#7E99BC;margin-top:5px;letter-spacing:.3px;}
.chatsku-cmi-main .guide-link{display:inline-flex;align-items:center;gap:7px;margin-top:20px;font-family:'IBM Plex Mono',monospace;font-size:12.5px;letter-spacing:.5px;color:#F4B324;text-decoration:none;border-bottom:1px solid transparent;transition:.15s;}
.chatsku-cmi-main .guide-link:hover{border-bottom-color:#F4B324;}

/* SOFT-GATE CAPTURE */
.chatsku-cmi-main .capture{padding:24px 30px;margin-top:18px;}
.chatsku-cmi-main .cap-h{font-size:19px;font-weight:800;letter-spacing:-.3px;}
.chatsku-cmi-main .cap-s{color:#9FC0E8;font-size:14px;margin-top:5px;max-width:620px;line-height:1.5;}
.chatsku-cmi-main .cap-s b{color:#F2F4F8;}
.chatsku-cmi-main .cap-note{font-family:'IBM Plex Mono',monospace;font-size:11px;color:#7E99BC;letter-spacing:.5px;margin-top:11px;}

/* CTA */
.chatsku-cmi-main .cta{margin-top:18px;padding:26px 30px;display:flex;align-items:center;justify-content:space-between;gap:22px;flex-wrap:wrap;background:linear-gradient(120deg,rgba(244,179,36,.1),rgba(11,37,69,.4));border:1px solid rgba(244,179,36,.3);}
.chatsku-cmi-main .cta-txt .ct-h{font-size:19px;font-weight:800;letter-spacing:-.3px;}
.chatsku-cmi-main .cta-txt .ct-s{color:#9FC0E8;font-size:14px;margin-top:4px;max-width:520px;}
.chatsku-cmi-main .cta-btn{font-family:'Archivo',system-ui,sans-serif;font-weight:700;font-size:15px;color:#07182E;background:#F4B324;border:none;border-radius:10px;padding:14px 22px;cursor:pointer;text-decoration:none;white-space:nowrap;transition:.15s;}
.chatsku-cmi-main .cta-btn:hover{background:#FFC94D;}

.chatsku-cmi-main .foot{margin-top:26px;font-family:'IBM Plex Mono',monospace;font-size:11.5px;color:#7E99BC;line-height:1.7;}
.chatsku-cmi-main .foot b{color:#9FC0E8;}

/* WPForms dark theme overrides */
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form .wpforms-field-label,
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form .wpforms-field-sublabel{
  color:#9FC0E8 !important; font-size:12px !important;
  font-family:'IBM Plex Mono',monospace !important;
  letter-spacing:1.5px !important; text-transform:uppercase !important;
  margin-bottom:8px !important; display:block !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form input[type="text"],
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form input[type="email"]{
  background:#07182E !important;
  border:1px solid rgba(159,192,232,.16) !important;
  border-radius:10px !important;
  color:#F2F4F8 !important;
  font-family:'IBM Plex Mono',monospace !important;
  font-size:16px !important; font-weight:600 !important;
  padding:12px 14px !important; width:100% !important;
  transition:border-color .15s !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form input:focus{
  border-color:#F4B324 !important;
  box-shadow:0 0 0 3px rgba(244,179,36,.15) !important;
  outline:none !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form input::placeholder{
  color:#7E99BC !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-field-container{text-align:left;}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-submit-container{margin-top:16px !important;}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form .wpforms-submit{
  display:inline-flex !important; align-items:center !important; justify-content:center !important;
  background:#F4B324 !important; color:#07182E !important;
  border:none !important; border-radius:10px !important;
  font-family:'Archivo',system-ui,sans-serif !important; font-size:15px !important; font-weight:700 !important;
  padding:13px 22px !important; cursor:pointer !important; transition:.15s !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-form .wpforms-submit:hover{ background:#FFC94D !important; }
.chatsku-cmi-main .chatsku-cmi-form .wpforms-confirmation-container-full{
  background:rgba(244,179,36,.08) !important;
  border:1px solid rgba(244,179,36,.4) !important;
  border-radius:12px !important; color:#F2F4F8 !important;
  padding:24px !important; font-size:15px !important; line-height:1.6 !important;
  text-align:center !important; margin-top:16px !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-error{
  color:#FF6B5A !important; font-size:12px !important; margin-top:4px !important;
}
.chatsku-cmi-main .chatsku-cmi-form .wpforms-has-error input{ border-color:#FF6B5A !important; }
.chatsku-cmi-main .chatsku-cmi-form .wpforms-confirmation-container-full p {
    color: #fff;
}

@media(max-width:760px){
  .chatsku-cmi-main .exp-grid{grid-template-columns:1fr;}
  .chatsku-cmi-main .score-row,.chatsku-cmi-main .cta{flex-direction:column;align-items:flex-start;}
  .chatsku-cmi-main .stage-name,.chatsku-cmi-main .stage-stages{text-align:left;}
  .chatsku-cmi-main .brand{display:none;}
  .chatsku-cmi-main .zone .zname{font-size:11px;} .chatsku-cmi-main .zone .zsub{display:none;}
}
</style>

<div class="cmi-wrap">
  <div class="brand">CHATSKU &middot; B2B CHATCOMMERCE</div>
  <div class="kicker">The March of Commerce &middot; Maturity Assessment</div>
  <h1>Catalog Maturity <span class="yel">Index</span></h1>
  <p class="sub">Rate where your buying experience sits on seven dimensions. In two minutes you&rsquo;ll see your stage on the maturity curve and the trigger events you&rsquo;re most exposed to.</p>

  <!-- SLIDERS -->
  <div class="panel pad" id="sliders"></div>

  <!-- RESULT -->
  <div class="panel result" id="result"></div>

  <!-- SOFT GATE: WPForms captures email + slider scores -->
  <div class="panel capture">
    <div class="cap-txt">
      <div class="cap-h">Want this to keep?</div>
      <div class="cap-s">Email yourself your scorecard and the full guide, <b>The 18 Moments a B2B Buyer Decides Your Catalog Isn&rsquo;t Enough</b>, with every trigger you&rsquo;re exposed to and how to spot it.</div>
    </div>
    <div class="chatsku-cmi-form" style="margin-top:16px;">
      <?php if ( $cmi_form_id > 0 ) : ?>
        <?php echo do_shortcode( '[wpforms id="' . intval( $cmi_form_id ) . '" title="false"]' ); ?>
      <?php else : ?>
        <div style="background:rgba(244,179,36,.1);border:1px dashed rgba(244,179,36,.5);border-radius:10px;padding:18px 20px;color:#9FC0E8;font-family:'IBM Plex Mono',monospace;font-size:12px;line-height:1.7;text-align:left;">
          <strong style="color:#F4B324;display:block;margin-bottom:8px;">&#9881; Developer note: WPForms form not connected yet</strong>
          Import the WPForms JSON export (form 188) and set <code style="color:#F4B324;">$cmi_form_id = 188</code> in this template.
        </div>
      <?php endif; ?>
    </div>
    <p class="cap-note">No spam. Your scorecard and the guide, once.</p>
  </div>

  <!-- CTA -->
  <div class="panel cta">
    <div class="cta-txt">
      <div class="ct-h">Now put a number on it.</div>
      <div class="ct-s">You know where you sit. The Revenue Leak Calculator shows what these gaps cost you per year and the net gain from closing them.</div>
    </div>
    <a class="cta-btn" id="calcLink" href="<?php echo esc_url( $roi_calc_url ); ?>">Open the Revenue Leak Calculator &rarr;</a>
  </div>

  <div class="foot">
    <b>Method.</b> Each slider scores one dimension of catalog maturity from 0 to 10. The Index is the average across all seven, scaled to 100. Below 34 places you in the PDF / Document stage, 34 to 66 in HTML + RFQ, and 67 and up in Platform / Self-Serve. Your lowest-scoring dimensions surface the trigger events you&rsquo;re most exposed to.<br>
    <b>Note.</b> A directional self-assessment for orientation, not a precise audit. The honest signal is which dimensions you rate lowest.
  </div>
</div>

<script>
// ── Config ────────────────────────────────────────────────────────────────────
var PILLAR_URL = '<?php echo esc_url( $pillar_url ); ?>';
function triggerHref(n){ return PILLAR_URL + '#trigger-' + n; }

// ── Dimension definitions ─────────────────────────────────────────────────────
var DIMS=[
  {key:'answer', label:'Getting a product answer',
   lo:'Must call or email and wait', hi:'Instant answer on the site',
   tip:'When a buyer has a question about a product, how fast can they get an answer on your site without calling or emailing a person?',
   triggers:['1 · The loyal customer who slipped away','8 · The question the site can’t take','10 · The quote that lost the deal'],
   stat:'75%', statLabel:'of distributor buyers would switch suppliers for a better, faster buying experience', statSrc:'Sana Commerce B2B Buyer Report 2025'},
  {key:'reps', label:'What your reps spend the day on',
   lo:'Mostly repeat questions', hi:'Mostly selling',
   tip:'How much of your sales team’s time goes to answering the same product questions over and over, versus actually selling?',
   triggers:['2 · The closers who became a help desk','11 · The growth target with no new budget'],
   stat:'28–30%', statLabel:'of a sales rep’s week is actually spent selling; the rest is admin and lookups', statSrc:'Salesforce State of Sales'},
  {key:'hours', label:'Buying after hours',
   lo:'Nothing happens after 5', hi:'Self-serve around the clock',
   tip:'Can a buyer get answers and move an order forward outside business hours, on nights and weekends, with no rep available?',
   triggers:['3 · The orders that die after the lights go off'],
   stat:'21×', statLabel:'drop in the odds of qualifying a lead when first response slips from 5 minutes to 30', statSrc:'MIT / InsideSales Lead Response study'},
  {key:'find', label:'Finding the right product',
   lo:'Hard to find, dead ends', hi:'Found in seconds',
   tip:'How easily can a buyer find the exact product they need on your site, by search or by browsing?',
   triggers:['4 · The migration that broke search','13 · The leads the funnel couldn’t hold'],
   stat:'41%', statLabel:'of manufacturing buyers can’t locate the products they need on a vendor’s site', statSrc:'Sana Commerce manufacturing buyer research'},
  {key:'spec', label:'Will it fit, is it safe',
   lo:'Buried in PDFs or a rep’s head', hi:'Answerable on demand',
   tip:'Can buyers get fitment, spec, install, and safety answers on their own, or are those answers locked in documents and people?',
   triggers:['17 · The fitment question that needs a human','18 · The safety check that holds up the sale','5 · The expansion the catalog couldn’t carry'],
   stat:'41%', statLabel:'of manufacturing buyers can’t find the product information they need, most of it buried in documents', statSrc:'Sana Commerce manufacturing buyer research'},
  {key:'know', label:'Where product knowledge lives',
   lo:'In people’s heads', hi:'Captured and reachable',
   tip:'Is the product knowledge that closes deals captured in your catalog and documents, or does it live mostly in a few veterans’ heads?',
   triggers:['12 · The expertise that wasn’t written down','6 · The system change that scattered the data','7 · The migration that exposed the foundation'],
   stat:'6–9 mo', statLabel:'to ramp a new B2B rep, stretching to 12–18 for complex selling, much of it spent learning product knowledge', statSrc:'DePaul Center for Sales Leadership'},
  {key:'serve', label:'How buying actually happens',
   lo:'Phone, email, fax', hi:'Mostly self-serve',
   tip:'What share of your orders run through a self-serve digital path versus phone, email, and fax?',
   triggers:['9 · The buyer who grew up self-serve','15 · The rival who made buying easy','16 · The mandate from the people who pay you'],
   stat:'67%', statLabel:'of B2B buyers now prefer a rep-free buying experience', statSrc:'Gartner, 2026'}
];

// Realistic default profile (mid-curve, mixed)
var state={answer:5, reps:4, hours:3, find:6, spec:3, know:5, serve:4};

var STAGES=[
  {name:'PDF / Document', stages:'Stages 01 to 03', min:0, max:33,
   diag:'<b>Your catalog is a document, not a buying experience.</b> Buyers who want to help themselves hit a wall almost everywhere, and this is the most exposed position on the whole curve. Nearly every gap below is wide open.'},
  {name:'HTML + RFQ', stages:'Stages 04 to 05', min:34, max:66,
   diag:'<b>Buyers can browse, but they can’t transact or get answers on their own.</b> They fill a form and wait. The exposure is concentrated exactly where buyers want to act and can’t, and a faster competitor picks up what slips through.'},
  {name:'Platform / Self-Serve', stages:'Stages 06 to 08', min:67, max:100,
   diag:'<b>You have a working store, but discovery and expert answers still fail in places.</b> The leak is smaller than it is upstream, but it isn’t zero, and the weakest dimensions below are where it still drains.'}
];

function stageFor(score){ return STAGES.find(function(s){ return score>=s.min && score<=s.max; }) || STAGES[STAGES.length-1]; }

function buildSliders(){
  var c=document.getElementById('sliders');
  c.innerHTML=DIMS.map(function(d){ return '<div class="ctl">'+
    '<div class="qhead">'+
      '<div class="qlabel">'+d.label+'<span class="info" data-k="'+d.key+'">i</span></div>'+
      '<div class="qval" id="v_'+d.key+'"></div>'+
    '</div>'+
    '<input type="range" id="s_'+d.key+'" min="0" max="10" value="'+state[d.key]+'">'+
    '<div class="ends"><span class="lo">'+d.lo+'</span><span class="hi">'+d.hi+'</span></div>'+
    '<div class="pop" id="p_'+d.key+'">'+d.tip+'</div>'+
  '</div>'; }).join('');

  DIMS.forEach(function(d){
    var s=document.getElementById('s_'+d.key);
    s.addEventListener('input',function(e){ state[d.key]=+e.target.value; render(); });
  });

  document.querySelectorAll('.info').forEach(function(b){
    b.addEventListener('click',function(e){
      e.stopPropagation();
      var pop=document.getElementById('p_'+b.dataset.k);
      var open=pop.classList.contains('open');
      document.querySelectorAll('.pop.open').forEach(function(p){ p.classList.remove('open'); });
      if(!open) pop.classList.add('open');
    });
  });
  document.querySelectorAll('.pop').forEach(function(p){ p.addEventListener('click',function(e){ e.stopPropagation(); }); });
  document.addEventListener('click',function(){ document.querySelectorAll('.pop.open').forEach(function(p){ p.classList.remove('open'); }); });
}

function render(){
  // Slider visuals
  DIMS.forEach(function(d){
    var v=state[d.key];
    document.getElementById('v_'+d.key).textContent=v+' / 10';
    document.getElementById('s_'+d.key).style.setProperty('--p',(v/10*100)+'%');
  });

  // Score
  var sum=DIMS.reduce(function(a,d){ return a+state[d.key]; },0);
  var score=Math.round(sum/DIMS.length*10);
  var st=stageFor(score);

  // Weakest three dimensions
  var ranked=DIMS.map(function(d,i){ return {d:d,v:state[d.key],i:i}; })
    .sort(function(a,b){ return a.v-b.v || a.i-b.i; }).slice(0,3);

  var expSub = score<=33
    ? 'These are the dimensions you rated lowest. Each one maps to specific trigger events from the guide.'
    : score<=66
      ? 'Your weakest three dimensions, and the trigger events they expose you to right now.'
      : 'Even at this stage, these are your relatively weakest dimensions and the triggers still in play.';

  document.getElementById('result').innerHTML=
    '<div class="score-row">'+
      '<div>'+
        '<div class="score-big">'+score+'<small>/100</small></div>'+
        '<div class="score-cap">Catalog Maturity Index</div>'+
      '</div>'+
      '<div>'+
        '<div class="stage-name">'+st.name+'</div>'+
        '<div class="stage-stages">'+st.stages+' on the curve</div>'+
      '</div>'+
    '</div>'+
    '<div class="curve">'+
      '<div class="curve-wrap">'+
        '<div class="curve-track">'+
          '<div class="zone z1"><div class="zname">PDF / Document</div><div class="zsub">01–03</div></div>'+
          '<div class="zone z2"><div class="zname">HTML + RFQ</div><div class="zsub">04–05</div></div>'+
          '<div class="zone z3"><div class="zname">Platform / Self-Serve</div><div class="zsub">06–08</div></div>'+
          '<div class="marker" style="left:'+score+'%"><div class="marker-label">You are here</div></div>'+
        '</div>'+
      '</div>'+
    '</div>'+
    '<div class="diag">'+st.diag+'</div>'+
    '<div class="exp-h">Where you’re most exposed</div>'+
    '<div class="exp-sub">'+expSub+'</div>'+
    '<div class="exp-grid">'+
      ranked.map(function(r){
        return '<div class="exp-card">'+
          '<div class="ecname">'+r.d.label+'</div>'+
          '<div class="exp-mini"><i style="width:'+Math.max(6,r.v/10*100)+'%"></i></div>'+
          '<div class="exp-trig">'+r.d.triggers.map(function(t){
            var parts=t.split(' · ');
            return '<a href="'+triggerHref(parts[0].trim())+'"><span>'+parts[0]+'</span> '+parts[1]+'</a>';
          }).join('<br>')+'</div>'+
          '<div class="exp-bench">'+
            '<div class="ebstat">'+r.d.stat+'</div>'+
            '<div class="eblabel">'+r.d.statLabel+'</div>'+
            '<div class="ebsrc">'+r.d.statSrc+'</div>'+
          '</div>'+
        '</div>';
      }).join('')+
    '</div>'+
    '<a class="guide-link" href="'+PILLAR_URL+'">Read the full guide: the 18 trigger events in depth &rarr;</a>';
}

buildSliders();
render();

/* ── WPForms bridge ────────────────────────────────────────────────────────────
   Populates the hidden WPForms fields with the current slider values and the
   computed Catalog Maturity Index score before / on form submit.
   CSS class convention (matches the WPForms form export):
     chatsku-field-a1 … chatsku-field-a7  → the 7 dimension slider values
     chatsku-maturity-index               → computed 0–100 score
   ─────────────────────────────────────────────────────────────────────────────── */
(function(){
  var wpForm = document.querySelector('.chatsku-cmi-form form.wpforms-form');
  if (!wpForm) return;

  var FIELD_MAP = [
    ['chatsku-field-a1', function(){ return state.answer + ' / 10'; }],
    ['chatsku-field-a2', function(){ return state.reps   + ' / 10'; }],
    ['chatsku-field-a3', function(){ return state.hours  + ' / 10'; }],
    ['chatsku-field-a4', function(){ return state.find   + ' / 10'; }],
    ['chatsku-field-a5', function(){ return state.spec   + ' / 10'; }],
    ['chatsku-field-a6', function(){ return state.know   + ' / 10'; }],
    ['chatsku-field-a7', function(){ return state.serve  + ' / 10'; }],
  ];

  function setField(cls, value){
    var wrapper = wpForm.querySelector('.' + cls);
    var el = wrapper ? wrapper.querySelector('input') : null;
    if (el) el.value = value;
  }

  function fillAll(){
    FIELD_MAP.forEach(function(m){ setField(m[0], m[1]()); });
    var sum = DIMS.reduce(function(a,d){ return a + state[d.key]; }, 0);
    setField('chatsku-maturity-index', Math.round(sum / DIMS.length * 10));
  }

  // Repopulate whenever a slider moves
  DIMS.forEach(function(d){
    var s = document.getElementById('s_' + d.key);
    if (s) s.addEventListener('input', fillAll);
  });

  // Safety net: also fill on submit
  wpForm.addEventListener('submit', fillAll);

  fillAll(); // seed on page load
})();
</script>

</main>

<?php get_footer(); ?>
