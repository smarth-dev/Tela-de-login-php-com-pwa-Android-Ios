<?php
header('Service-Worker-Allowed: /');
header('Link: </sw.js>; rel="serviceworker"; scope="/"');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Lupa</title>
  <link rel="icon" href="imagens/logo.png" type="image/x-icon">
  <meta name="theme-color" content="#0657a7">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Lupa">
  <link rel="apple-touch-icon" href="imagens/logo.png">
  
  <link rel="manifest" href="manifest.json">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
  margin: 0;
  min-height: 100vh;
  background: linear-gradient(to bottom, #c0dee9, #61aec9);
  background-attachment: fixed;
}

html {
  height: 100%;
}
    
    .logo {
      width: 70%;
      max-width: 300px;
      height: auto;
    }

    .hidden {
      display: none;
    }

    .login-screen {
      color: #fff;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      overflow-y: auto;
      padding: 20px 0;
      -webkit-overflow-scrolling: touch;
      justify-content: space-between;
    }

    .login-form {
      width: 90%;
      max-width: 400px;
      margin: 20px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      flex-grow: 1; 
      min-height: calc(95vh - 40px);
      position: relative;
      justify-content: space-between;
    }

    .download-pwa {
      position: absolute;
      top: -40px;
      right: -20px;
      width: 60px;
      height: 60px;
      cursor: pointer;
      z-index: 10;
    }

    .login-logo {
      width: 60%;
      max-width: 200px;
      margin-bottom: 30px;
    }

    .input-field {
      width: 100%;
      padding: 15px;
      margin: 5px 0;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      background-color: rgba(255, 255, 255, 0.9);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-entrar {
      background-color: #0657a7;
      color: #fff;
      border: none;
      padding: 15px;
      margin: 20px 0;
      width: 100%;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
    }

    .btn-entrar:active {
      background-color: #054a8a;
      transform: scale(0.98);
    }

    .bottom-section {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: auto; 
      margin-bottom: 20px;
      padding-bottom: 20px; 
    }

    .login-icons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin: 15px 0;
      width: 100%;
    }

    .icon-btn {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 22px;
      cursor: pointer;
      color: white;
      border: none;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
      transition: transform 0.2s;
    }

    .icon-btn:active {
      transform: scale(0.95);
    }

    .phone-btn {
      background-color: #0657a7;
    }

    .google-btn {
      background-color: #EA4335;
    }

    .gov-btn {
      background-color: #419f0e;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background: white;
      padding: 25px;
      width: 90%;
      max-width: 400px;
      border-radius: 10px;
      text-align: center;
      overflow-y: auto;
      max-height: 80vh;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .close {
      color: red;
      font-size: 24px;
      cursor: pointer;
      float: right;
      margin-top: -15px;
      margin-right: -10px;
    }

    .modal-content h2 {
      margin-bottom: 15px;
      color: #333;
    }

    .modal-content p {
      text-align: justify;
      font-size: 15px;
      line-height: 1.5;
      color: #555;
      margin-bottom: 15px;
    }
    

    .terms-privacy {
  font-size: 14px;
  color: #fff;
  text-align: center;
  margin: 20px 0; 
  padding: 0 15px;
  line-height: 1.4;
}

.terms-privacy a {
    color: #fff;
    text-decoration: underline;
    cursor: pointer;
    font-weight: bold;
}

    .install-modal {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: white;
      padding: 20px;
      border-radius: 15px 15px 0 0;
      box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
      z-index: 1001;
      transform: translateY(100%);
      transition: transform 0.3s ease-out;
    }
    
    .install-modal.show {
      transform: translateY(0);
    }
    
    .install-header {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .install-icon {
      width: 40px;
      height: 40px;
      margin-right: 15px;
      border-radius: 8px;
    }
    
    .install-title {
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }
    
    .install-text {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }
    
    .install-buttons {
      display: flex;
      gap: 10px;
    }
    
    .install-btn {
      flex: 1;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
    
    .install-primary {
      background-color: #0657a7;
      color: white;
    }
    
    .install-secondary {
      background-color: #f0f0f0;
      color: #333;
    }
    
    .install-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      display: none;
    }
    
    .install-overlay.show {
      display: block;
    }

    @media (max-width: 480px) {
      .login-form {
        width: 85%;
        gap: 15px;
      }
      
      .login-logo {
        margin-bottom: 25px;
      }
      
      .input-field {
        padding: 14px;
        font-size: 15px;
      }
      
      .btn-entrar {
        padding: 14px;
        font-size: 15px;
        margin: 15px 0;
      }
      
      
      .icon-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
      }
      
      .terms-privacy {
        margin: 25px 0 15px;
        font-size: 13px;
      }
      
      .modal-content {
        padding: 20px;
        width: 95%;
      }

      .install-modal {
        padding: 15px;
      }
      
      .install-title {
        font-size: 16px;
      }
      
      .install-text {
        font-size: 13px;
      }
    }

    @media screen and (-webkit-min-device-pixel-ratio:0) {
      input, textarea {
        font-size: 16px !important;
      }
    }
  </style>
</head>
<body>
  <div id="login-screen" class="login-screen hidden">
    <div class="login-form">
      <img src="imagens/dw.png" alt="Instalar App" class="download-pwa" id="downloadPWA">
      <img src="imagens/logo.png" alt="Logo" class="login-logo">
      <input type="text" class="input-field" placeholder="Email ou Telefone">
      <input type="password" class="input-field" placeholder="Senha">
      <button class="btn-entrar">Entrar</button>
      <div class="bottom-section">
        <div class="login-icons">
          <button class="icon-btn phone-btn"><i class="fa-solid fa-phone"></i></button>
          <button class="icon-btn google-btn"><i class="fa-brands fa-google"></i></button>
          <button class="icon-btn gov-btn"><i class="fa-solid fa-id-card"></i></button>
        </div>
        <div class="terms-privacy">
          Utilizar o nosso aplicativo significa que você concorda com nossos 
          <a href="#" onclick="showModal('termsModal')">Termos de Uso</a> e 
          <a href="#" onclick="showModal('privacyPolicyModal')">Política de Privacidade</a>.
        </div>
      </div>
    </div>
  </div>
  
  <div id="termsModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('termsModal')">&times;</span>
      <h2>Termos de Uso</h2>
      <p>Bem-vindo ao Lupa. Ao utilizar nossos serviços, você concorda com os seguintes termos:</p><br><br>
      <p><strong>1. Uso do Serviço:</strong><br>O aplicativo é destinado para facilitar a busca por informações. Não garantimos que os dados estejam sempre atualizados.</p><br>
      <p><strong>2. Responsabilidades do Usuário:</strong><br>Você é responsável pelo uso adequado da plataforma e não deve utilizá-la para fins ilícitos.</p><br>
      <p><strong>3. Privacidade:</strong><br>Respeitamos sua privacidade conforme descrito na nossa Política de Privacidade.</p><br>
      <p><strong>4. Alterações nos Termos:</strong><br>Podemos modificar estes termos a qualquer momento. Notificaremos você sobre mudanças importantes.</p>
      <p>Se você não concorda com os termos, deve interromper o uso do aplicativo.</p>
    </div>
  </div>

  <div id="privacyPolicyModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('privacyPolicyModal')">&times;</span>
      <h2>Política de Privacidade</h2>
      <p>Descreve como coletamos, usamos e protegemos suas informações.</p><br><br>
      <p><strong>1. Coleta de Informações:</strong><br>Podemos coletar informações fornecidas por você, como nome, e-mail e dados de navegação.</p><br>
      <p><strong>2. Uso das Informações:</strong><br>Utilizamos seus dados para melhorar nossos serviços, personalizar a experiência e fornecer suporte.</p><br>
      <p><strong>3. Compartilhamento:</strong><br>Não vendemos suas informações para terceiros. Podemos compartilhá-las apenas para cumprir exigências legais.</p><br>
      <p><strong>4. Segurança:</strong><br>Adotamos medidas para proteger seus dados, mas não garantimos segurança absoluta.</p><br>
      <p><strong>5. Seus Direitos:</strong><br>Você pode solicitar a exclusão ou correção de seus dados a qualquer momento.</p>
      <p>Se tiver dúvidas, entre em contato conosco.</p>
    </div>
  </div>

  <div id="installOverlay" class="install-overlay"></div>
  <div id="installModal" class="install-modal">
    <div class="install-header">
      <img src="imagens/logo.png" alt="Logo" class="install-icon">
      <div class="install-title">Instalar o aplicativo Lupa</div>
    </div>
    <div class="install-text">
      Gostaria de instalar o aplicativo Lupa para uma melhor experiência?
    </div>
    <div class="install-buttons">
      <button id="installCancelBtn" class="install-btn install-secondary">Agora não</button>
      <button id="installConfirmBtn" class="install-btn install-primary">Instalar</button>
    </div>
  </div>

  <div id="iosInstallModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('iosInstallModal')">&times;</span>
      <h2>Como instalar o Lupa no seu dispositivo</h2>
      <p><strong>Para iPhone/iPad:</strong></p>
      <p>1. Toque no botão <strong>Compartilhar</strong> <i class="fas fa-share-square"></i> no menu do navegador</p>
      <p>2. Selecione <strong>Adicionar à Tela de Início</strong> <i class="fas fa-plus-square"></i></p>
      <p>3. Toque em <strong>Adicionar</strong> no canto superior direito</p>
      <p>4. O aplicativo será instalado na sua tela inicial</p>
      
      <p><strong>Para Android:</strong></p>
      <p>1. Toque no botão "Instalar" na mensagem que apareceu</p>
      <p>2. Confirme a instalação quando solicitado</p>
      <p>3. O aplicativo será instalado no seu dispositivo</p>
      <button class="btn-entrar" onclick="closeModal('iosInstallModal')" style="margin-top:20px">Entendi</button>
    </div>
  </div>

  <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
      navigator.serviceWorker.register('/sw.js', { scope: '/' })
        .then(function(registration) {
          console.log('Service Worker registrado com sucesso:', registration.scope);
        })
        .catch(function(error) {
          console.log('Falha ao registrar Service Worker:', error);
        });
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    const loginScreen = document.getElementById("login-screen");
    const downloadPWA = document.getElementById("downloadPWA");
    const installModal = document.getElementById("installModal");
    const installOverlay = document.getElementById("installOverlay");
    const installConfirmBtn = document.getElementById("installConfirmBtn");
    const installCancelBtn = document.getElementById("installCancelBtn");
    
    let deferredPrompt;
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) || 
                 (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
    const isAndroid = /Android/.test(navigator.userAgent);
    window.addEventListener('beforeinstallprompt', (e) => {
      console.log('Evento beforeinstallprompt disparado');
      e.preventDefault();
      deferredPrompt = e;
    });
    window.addEventListener('appinstalled', () => {
      localStorage.setItem('appInstalled', 'true');
      console.log('App instalado com sucesso');
    });
    downloadPWA.addEventListener('click', () => {
      if (isPWAInstalled()) {
        alert('O aplicativo já está instalado em seu dispositivo!');
        return;
      }
      
      if (isIOS) {
        showModal('iosInstallModal');
      } else if (isAndroid && deferredPrompt) {
        installModal.classList.add('show');
        installOverlay.classList.add('show');
      } else {
        alert('Para instalar o aplicativo, use o menu do navegador e selecione "Adicionar à tela inicial"');
      }
    });
    installConfirmBtn.addEventListener('click', () => {
      if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === 'accepted') {
            localStorage.setItem('appInstalled', 'true');
            console.log('Usuário aceitou instalação');
          } else {
            console.log('Usuário recusou instalação');
          }
          deferredPrompt = null;
        });
      }
      hideInstallPrompt();
    });
    installCancelBtn.addEventListener('click', () => {
      hideInstallPrompt();
    });
    
    installOverlay.addEventListener('click', () => {
      hideInstallPrompt();
    });
    
    function isPWAInstalled() {
      return window.matchMedia('(display-mode: standalone)').matches || 
             navigator.standalone ||
             localStorage.getItem('appInstalled') === 'true';
    }
    
    function hideInstallPrompt() {
      installModal.classList.remove('show');
      installOverlay.classList.remove('show');
    }
  });
  
  function showModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
    document.body.style.overflow = 'auto';
  }

  document.addEventListener('touchstart', function(event) {
    if (event.touches.length > 1) event.preventDefault();
  }, { passive: false });

  let lastTouchEnd = 0;
  document.addEventListener('touchend', function(event) {
    const now = Date.now();
    if (now - lastTouchEnd <= 300) event.preventDefault();
    lastTouchEnd = now;
  }, false);
</script>
</body>
</html>