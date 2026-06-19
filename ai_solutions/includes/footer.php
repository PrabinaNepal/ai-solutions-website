<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col footer-brand">
            <div class="footer-logo">
                <div class="logo-circle small"><span>AI</span></div>
                <span>AI-Solutions</span>
            </div>
            <p>Innovating the future of digital workplaces with AI-Powered solutions.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="/ai_solutions/index.php">Home</a></li>
                <li><a href="/ai_solutions/solutions.php">Solutions</a></li>
                <li><a href="/ai_solutions/insights.php">Insights</a></li>
                <li><a href="/ai_solutions/testimonials.php">Testimonials</a></li>
                <li><a href="/ai_solutions/gallery.php">Gallery</a></li>
                <li><a href="/ai_solutions/contact.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Solutions</h4>
            <ul>
                <li><a href="#">AI Automation</a></li>
                <li><a href="#">Data Intelligence</a></li>
                <li><a href="#">Employee Experience</a></li>
                <li><a href="#">Workflow Optimisation</a></li>
                <li><a href="#">Custom Integration</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contact Us</h4>
            <ul class="contact-list">
                <li><i class="fas fa-map-marker-alt"></i> Sunderland, UK</li>
                <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                <li><i class="fas fa-envelope"></i> info@ai-solution.com</li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Newsletter</h4>
            <p>Subscribe to our newsletter for latest updates.</p>
            <div class="newsletter-form">
                <input type="email" placeholder="Enter your email">
                <button><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 AI-Solution. All rights reserved.</p>
    </div>
</footer>

<script src="/ai_solutions/assets/js/main.js"></script>

<<!-- Chatbot Widget -->
<div class="chatbot-container">
    <div class="chatbot-icon" id="chatbotIcon">
        <div class="chat-icon">
            <i class="fas fa-robot"></i>
        </div>
        <span class="chat-badge">1</span>
    </div>

    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <i class="fas fa-robot" style="color: #1a73e8;"></i>
                <span>AI Assistant</span>
                <span class="online-status">● Online</span>
            </div>
            <button class="chatbot-close" id="closeChat">&times;</button>
        </div>
        
        <div class="chatbot-body" id="chatbotBody">
            <div class="chat-message bot">
                <div class="message-bubble">
                    <i class="fas fa-robot"></i> Hello! 👋 Welcome to AI-Solutions. How can I assist you today?
                </div>
            </div>
        </div>
        
        <div class="chatbot-footer">
            <input type="text" id="chatbotInput" placeholder="Type your message...">
            <button id="sendChatBtn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>

.chatbot-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
}

.chatbot-icon {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(26,115,232,0.4);
    transition: transform 0.3s;
    position: relative;
}

.chatbot-icon:hover {
    transform: scale(1.05);
}

.chat-icon {
    font-size: 24px;
    color: white;
}

.chat-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc2626;
    color: white;
    font-size: 10px;
    font-weight: bold;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-window {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 330px;
    height: 460px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-window.open {
    display: flex;
}

/* Header */
.chatbot-header {
    background: white;
    padding: 14px 16px;
    border-bottom: 1px solid #eef2f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-header-info {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 14px;
    color: #1a1a2e;
}

.chatbot-header-info i {
    font-size: 16px;
}

.online-status {
    font-size: 10px;
    color: #10b981;
    font-weight: normal;
}

.chatbot-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #999;
    transition: color 0.3s;
}

.chatbot-close:hover {
    color: #dc2626;
}

/* Body */
.chatbot-body {
    flex: 1;
    padding: 16px;
    overflow-y: auto;
    background: #ffffff;
}

/* Messages */
.chat-message {
    margin-bottom: 16px;
    display: flex;
}

.chat-message.user {
    justify-content: flex-end;
}

.chat-message.bot {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 90%;
    padding: 10px 14px;
    border-radius: 18px;
    font-size: 13px;
    line-height: 1.45;
}

.chat-message.bot .message-bubble {
    background: #f0f2f5;
    color: #1e1e2e;
    border-bottom-left-radius: 4px;
}

.chat-message.user .message-bubble {
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    color: white;
    border-bottom-right-radius: 4px;
}

.chat-message.bot .message-bubble i {
    margin-right: 6px;
    font-size: 12px;
    color: #1a73e8;
}

/* Quick Replies */
.quick-replies {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 12px 0 8px;
}

.quick-reply-btn {
    background: #f0f2f5;
    border: none;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
    color: #333;
    font-weight: 500;
}

.quick-reply-btn:hover {
    background: #1a73e8;
    color: white;
}

/* Typing Indicator */
.typing-indicator {
    display: flex;
    gap: 4px;
    padding: 10px 14px;
    background: #f0f2f5;
    border-radius: 18px;
    width: fit-content;
}

.typing-indicator span {
    width: 6px;
    height: 6px;
    background: #999;
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.5; }
    30% { transform: translateY(-8px); opacity: 1; }
}

/* Footer */
.chatbot-footer {
    padding: 12px 16px;
    border-top: 1px solid #eef2f6;
    display: flex;
    gap: 10px;
    background: white;
}

.chatbot-footer input {
    flex: 1;
    padding: 10px 14px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    outline: none;
    font-size: 13px;
    transition: border-color 0.2s;
}

.chatbot-footer input:focus {
    border-color: #1a73e8;
}

.chatbot-footer button {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #1a73e8, #1557b0);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    transition: transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-footer button:hover {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 480px) {
    .chatbot-window {
        width: 300px;
        height: 430px;
        right: -10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotIcon = document.getElementById('chatbotIcon');
    const chatbotWindow = document.getElementById('chatbotWindow');
    const closeChat = document.getElementById('closeChat');
    const chatInput = document.getElementById('chatbotInput');
    const sendBtn = document.getElementById('sendChatBtn');
    const chatBody = document.getElementById('chatbotBody');
    
    let isTyping = false;
    
    // Open Chatbot
    if (chatbotIcon) {
        chatbotIcon.onclick = function() {
            chatbotWindow.classList.add('open');
            chatbotIcon.style.display = 'none';
            chatInput.focus();
        };
    }
    
    // Close Chatbot
    if (closeChat) {
        closeChat.onclick = function() {
            chatbotWindow.classList.remove('open');
            chatbotIcon.style.display = 'flex';
        };
    }
    
    // Add message to chat
    function addMessage(message, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message ' + (isUser ? 'user' : 'bot');
        const bubble = document.createElement('div');
        bubble.className = 'message-bubble';
        if (!isUser) {
            bubble.innerHTML = '<i class="fas fa-robot"></i> ' + message;
        } else {
            bubble.textContent = message;
        }
        messageDiv.appendChild(bubble);
        chatBody.appendChild(messageDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }
    
    // Show typing indicator
    function showTyping() {
        isTyping = true;
        const typingDiv = document.createElement('div');
        typingDiv.className = 'chat-message bot';
        typingDiv.id = 'typingIndicator';
        typingDiv.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';
        chatBody.appendChild(typingDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }
    
    // Hide typing indicator
    function hideTyping() {
        const typing = document.getElementById('typingIndicator');
        if (typing) typing.remove();
        isTyping = false;
    }
    
    // Get bot response
    function getBotResponse(msg) {
        const lower = msg.toLowerCase();
        if (lower.match(/hello|hi|hey|greetings/)) {
            return "Hello! 👋 Welcome to AI-Solutions. How can I assist you today?";
        }
        if (lower.match(/solution|service|offer|product/)) {
            return "We offer several AI solutions:\n\n• 🤖 AI Virtual Assistant\n• ⚡ Rapid Prototyping\n• 📊 Data Intelligence\n• 👥 Employee Experience\n\nWhich one interests you?";
        }
        if (lower.match(/price|cost|pricing|how much/)) {
            return "For pricing details, please contact our sales team at sales@ai-solution.com or call +44 (123) 456-7890. They'll provide a custom quote based on your needs.";
        }
        if (lower.match(/contact|reach|email|phone|call/)) {
            return "You can reach us at:\n\n📧 Email: info@ai-solution.com\n📞 Phone: +44 (123) 456-7890\n📍 Location: Sunderland, UK\n\nOr fill out the contact form on our website!";
        }
        if (lower.match(/demo|schedule|appointment/)) {
            return "I'd love to help you schedule a demo! Please visit our Contact page and fill out the form, or email us directly at sales@ai-solution.com";
        }
        if (lower.match(/about|company|mission/)) {
            return "AI-Solutions is a leading provider of AI-powered digital workplace solutions. Our mission is to innovate, promote, and deliver the future of employee experience worldwide.";
        }
        return "Thank you for your message! 💬 I'll connect you with our team. Please visit our Contact page or fill out the form for more information.";
    }
    
    // Quick reply messages (like your friend's)
    const quickMessages = [
        "Tell me about your solutions",
        "I need help with a project",
        "Request a demo",
        "Pricing information"
    ];
    
    // Add quick reply buttons
    function addQuickReplies() {
        const existing = document.querySelector('.quick-replies');
        if (existing) existing.remove();
        
        const div = document.createElement('div');
        div.className = 'quick-replies';
        quickMessages.forEach(msg => {
            const btn = document.createElement('button');
            btn.textContent = msg;
            btn.className = 'quick-reply-btn';
            btn.onclick = () => {
                addMessage(msg, true);
                showTyping();
                setTimeout(() => {
                    hideTyping();
                    addMessage(getBotResponse(msg), false);
                    addQuickReplies();
                }, 500);
            };
            div.appendChild(btn);
        });
        chatBody.appendChild(div);
        chatBody.scrollTop = chatBody.scrollHeight;
    }
    
    // Send message function
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message === '' || isTyping) return;
        
        addMessage(message, true);
        chatInput.value = '';
        showTyping();
        
        setTimeout(() => {
            hideTyping();
            const reply = getBotResponse(message);
            addMessage(reply, false);
            addQuickReplies();
        }, 800);
    }
    
    // Event listeners
    if (sendBtn) sendBtn.onclick = sendMessage;
    if (chatInput) chatInput.onkeypress = function(e) { 
        if (e.key === 'Enter') sendMessage(); 
    };
    
    // Add quick replies after initial bot messages
    setTimeout(addQuickReplies, 500);
});
</script>
</body>
</html>