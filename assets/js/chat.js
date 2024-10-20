// Seleciona os elementos necessários
const messageInput = document.getElementById('message-input');
const sendButton = document.getElementById('send-button');
const chatBody = document.querySelector('.chat-body');

// Função para enviar mensagem
function sendMessage() {
    const messageText = messageInput.value.trim();  // Captura o valor digitado e remove espaços extras
    
    if (messageText !== '') {  // Verifica se o input não está vazio
        // Cria um novo elemento de mensagem do usuário
        const userMessage = document.createElement('div');
        userMessage.classList.add('chat-res');  // Adiciona a classe para mensagem do usuário
        userMessage.innerText = messageText;  // Insere o texto digitado
        
        // Adiciona a mensagem do usuário ao chat
        chatBody.appendChild(userMessage);
        
        // Rola automaticamente para a última mensagem
        chatBody.scrollTop = chatBody.scrollHeight;
        
        // Limpa o input para uma nova mensagem
        messageInput.value = '';

        // Chama o bot para responder após um pequeno atraso
        setTimeout(() => {
            botReply(messageText);
        }, 1000);  // Atraso de 1 segundo para a resposta do bot
    }
}

// Função de resposta automática do "bot"
function botReply(userMessage) {
    let botMessageText = '';

    // Aqui você define as respostas do bot com base na mensagem do usuário
    if (userMessage.toLowerCase().includes('olá') || userMessage.toLowerCase().includes('oi')) {
        botMessageText = 'Olá! Como posso te ajudar?';
    } else if (userMessage.toLowerCase().includes('adotar')) {
        botMessageText = 'Claro! Para adotar, você precisa seguir alguns passos simples.';
    } else if (userMessage.toLowerCase().includes('idade')) {
        botMessageText = 'Qual a sua idade?';
    } else if (userMessage.toLowerCase().includes('20')) {
        botMessageText = 'Você está dentro da faixa etária permitida para adoção!';
    } else {
        botMessageText = 'Desculpe, não entendi. Pode repetir?';
    }

    // Cria um novo elemento de mensagem do bot
    const botMessage = document.createElement('div');
    botMessage.classList.add('chat-res1');  // Adiciona a classe para mensagem do bot
    botMessage.innerText = botMessageText;  // Insere o texto da resposta do bot

    // Adiciona a mensagem do bot ao chat
    chatBody.appendChild(botMessage);

    // Rola automaticamente para a última mensagem
    chatBody.scrollTop = chatBody.scrollHeight;
}

// Evento de clique no botão "Enviar"
sendButton.addEventListener('click', sendMessage);

// Permitir envio de mensagem ao pressionar "Enter"
messageInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
