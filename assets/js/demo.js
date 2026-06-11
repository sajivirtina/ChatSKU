/**
 * ChatSKU Demo Page Interactive JavaScript
 * Handles: sample query injection, mode toggle, copy embed code
 */
(function () {
    'use strict';

    // ── Sample Query Buttons ──────────────────────────────────────────────
    function initSampleQueries() {
        const queryBtns  = document.querySelectorAll('.demo-query-btn');
        const widgetFrame = document.getElementById('demo-widget-iframe');

        queryBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const query = btn.dataset.query || btn.textContent.trim();

                // Visual feedback
                queryBtns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');

                // If widget is in iframe, try postMessage
                if (widgetFrame && widgetFrame.contentWindow) {
                    try {
                        widgetFrame.contentWindow.postMessage(
                            { type: 'chatsku:inject-query', query: query },
                            '*'
                        );
                    } catch (e) {
                        // Cross-origin — graceful degradation
                    }
                }

                // Update any visible search input on the page
                const demoInput = document.getElementById('demo-search-input');
                if (demoInput) {
                    demoInput.value = query;
                    demoInput.focus();
                    demoInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
            });
        });
    }

    // ── Widget Mode Toggle (Bubble / Inline) ──────────────────────────────
    function initModeToggle() {
        const toggleBtns  = document.querySelectorAll('.demo-mode-btn');
        const bubbleWrap  = document.getElementById('demo-bubble-wrap');
        const inlineWrap  = document.getElementById('demo-inline-wrap');

        toggleBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const mode = btn.dataset.mode;

                toggleBtns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');

                if (mode === 'bubble') {
                    if (bubbleWrap)  bubbleWrap.style.display  = 'block';
                    if (inlineWrap)  inlineWrap.style.display  = 'none';
                } else if (mode === 'inline') {
                    if (bubbleWrap)  bubbleWrap.style.display  = 'none';
                    if (inlineWrap)  inlineWrap.style.display  = 'block';
                }
            });
        });

        // Default to first toggle
        if (toggleBtns[0] && !document.querySelector('.demo-mode-btn.is-active')) {
            toggleBtns[0].click();
        }
    }

    // ── Embed Code Copy ────────────────────────────────────────────────────
    function initCopyButtons() {
        document.querySelectorAll('.embed-code-block__copy').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const block   = btn.closest('.embed-code-block');
                const codeEl  = block ? block.querySelector('.embed-code-block__code') : null;
                const text    = codeEl ? codeEl.textContent : '';

                if (!text) return;

                navigator.clipboard.writeText(text.trim()).then(function () {
                    const original = btn.textContent;
                    btn.textContent = 'Copied!';
                    btn.style.color = 'var(--color-success)';
                    setTimeout(function () {
                        btn.textContent = original;
                        btn.style.color = '';
                    }, 2000);
                }).catch(function () {
                    // Fallback for older browsers
                    const ta = document.createElement('textarea');
                    ta.value = text.trim();
                    ta.style.position = 'fixed';
                    ta.style.opacity  = '0';
                    document.body.appendChild(ta);
                    ta.select();
                    document.execCommand('copy');
                    document.body.removeChild(ta);
                });
            });
        });
    }

    // ── Mock Chat (Static Demo page only) ─────────────────────────────────
    function initMockChat() {
        const chatForm  = document.getElementById('demo-chat-form');
        const chatInput = document.getElementById('demo-chat-input');
        const chatLog   = document.getElementById('demo-chat-log');

        if (!chatForm || !chatInput || !chatLog) return;

        // Pre-defined responses for common queries
        const responses = {
            default: "I found several products matching your request. Let me show you our catalog options with pricing.",
            plexiglass: "Here are our Clear Plexiglass options:\n\n• 1/8\" Clear Acrylic Sheet — $12.50/sq ft\n• 1/4\" Clear Acrylic Sheet — $22.00/sq ft\n• 1/2\" Clear Acrylic Sheet — $38.00/sq ft\n\nWould you like to add any of these to a quote?",
            pipe: "I found our hose and tubing products:\n\n• Clear PVC Tubing — various diameters\n• Poly Tubing — food grade available\n• Industrial Hose — heavy duty\n\nWhat diameter and length do you need?",
            price: "I can provide custom pricing based on your order volume. Please tell me the quantity you're looking for and I'll give you tiered pricing options.",
            quote: "I'd be happy to build a quote for you! Please add the products you're interested in and I'll prepare a formal quote with pricing and availability.",
        };

        function getResponse(query) {
            const q = query.toLowerCase();
            if (q.includes('plex') || q.includes('acrylic'))  return responses.plexiglass;
            if (q.includes('pipe') || q.includes('hose') || q.includes('tube')) return responses.pipe;
            if (q.includes('price') || q.includes('cost'))     return responses.price;
            if (q.includes('quote') || q.includes('rfq'))      return responses.quote;
            return responses.default;
        }

        function appendMessage(text, role) {
            const wrap = document.createElement('div');
            wrap.className = 'chat-message chat-message--' + role;

            const bubble = document.createElement('div');
            bubble.className = 'chat-message__bubble';
            bubble.textContent = text;

            wrap.appendChild(bubble);
            chatLog.appendChild(wrap);
            chatLog.scrollTop = chatLog.scrollHeight;
        }

        function showTyping() {
            const wrap = document.createElement('div');
            wrap.className = 'chat-message chat-message--bot chat-message--typing';
            wrap.id = 'typing-indicator';
            wrap.innerHTML = '<div class="chat-message__bubble"><span></span><span></span><span></span></div>';
            chatLog.appendChild(wrap);
            chatLog.scrollTop = chatLog.scrollHeight;
        }

        function hideTyping() {
            const indicator = document.getElementById('typing-indicator');
            if (indicator) indicator.remove();
        }

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const query = chatInput.value.trim();
            if (!query) return;

            appendMessage(query, 'user');
            chatInput.value = '';
            showTyping();

            setTimeout(function () {
                hideTyping();
                appendMessage(getResponse(query), 'bot');
            }, 800 + Math.random() * 600);
        });
    }

    // ── Init ──────────────────────────────────────────────────────────────
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initSampleQueries();
            initModeToggle();
            initCopyButtons();
            initMockChat();
        });
    } else {
        initSampleQueries();
        initModeToggle();
        initCopyButtons();
        initMockChat();
    }

})();
