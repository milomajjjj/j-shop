<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>J Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">

<!-- PREMIUM BACKGROUND -->
<div class="aurora-bg">
    <div class="aurora-blob aurora-1"></div>
    <div class="aurora-blob aurora-2"></div>
    <div class="aurora-blob aurora-3"></div>
    <div class="aurora-blob aurora-4"></div>
</div>

<x-nav/>

<main class="flex-fill position-relative">
    {{$slot}}
</main>

<x-footer/>

    <!-- ================= CHATBOT ================= -->

    <!-- Chat Button -->
    <button id="chatToggle" class="btn btn-primary rounded-circle"
      style="position: fixed; bottom: 20px; right: 20px; width: 55px; height: 55px; z-index:1000;">
      💬
    </button>

    <!-- Chat Box -->
    <div id="chatBox" class="card shadow"
      style="position: fixed; bottom: 90px; right: 20px; width: 300px; display: none; z-index:1000;">

      <div class="card-header bg-primary text-white">
        J Shop Assistant
      </div>

      <div id="chatMessages" class="p-3" style="height: 250px; overflow-y: auto;">
        <p><strong>Bot:</strong> Hi! How can I help you? 😊</p>
      </div>

      <div class="p-2 d-flex">
        <input id="chatInput" class="form-control me-2" placeholder="Type..." />
        <button id="sendBtn" class="btn btn-primary">Send</button>
      </div>

    </div>

    <!-- ================= SCRIPTS ================= -->

    <script>
      // ===== DARK MODE =====
      const toggle = document.getElementById('themeToggle');

      function updateIcon() {
        if(toggle){
          toggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
        }
      }

      if(localStorage.getItem('theme') === 'dark'){
        document.body.classList.add('dark-mode');
      }

      updateIcon();

      if(toggle){
        toggle.addEventListener('click', () => {
          document.body.classList.toggle('dark-mode');

          localStorage.setItem('theme',
            document.body.classList.contains('dark-mode') ? 'dark' : 'light'
          );

          updateIcon();
        });
      }


      // ===== CHAT UI =====
      const chatToggle = document.getElementById('chatToggle');
      const chatBox = document.getElementById('chatBox');
      const chatInput = document.getElementById('chatInput');
      const sendBtn = document.getElementById('sendBtn');
      const chatMessages = document.getElementById('chatMessages');

      chatToggle.onclick = () => {
        chatBox.style.display = chatBox.style.display === 'none' ? 'block' : 'none';
      };

      sendBtn.onclick = sendMessage;

      chatInput.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') sendMessage();
      });

      function addMessage(sender, text){
        chatMessages.innerHTML += `<p><strong>${sender}:</strong> ${text}</p>`;
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }

      // ===== AI CONNECTION =====
      async function sendMessage(){
        let msg = chatInput.value.trim();
        if(msg === '') return;

        addMessage('You', msg);
        chatInput.value = '';

        addMessage('Bot', 'Typing...');

        try {
          let response = await fetch('/chatbot', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: msg })
          });

          let data = await response.json();

          chatMessages.lastChild.remove();
          addMessage('Bot', data.reply);

        } catch (error) {
          chatMessages.lastChild.remove();
          addMessage('Bot', 'Error connecting 😢');
        }
      }
    </script>

  </body>
</html>