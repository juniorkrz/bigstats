// Função para obter todos os cookies
function getCookies() {
    return document.cookie;
}

// Função para copiar os cookies para a área de transferência
function copyCookiesToClipboard(c) {
    const cookies = c || getCookies();
    const success = cookies.includes('ds_user_id');
    const color = success ? '#4CAF50' : '#EF2020';

    if (success) {
        const textarea = document.createElement('textarea');
        const sqlInsertCommands = convertCookiesToSQL(cookies);

        textarea.value = sqlInsertCommands;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    }

    // Criar um modal para mostrar a mensagem personalizada
    const modal = document.createElement('div');
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.style.zIndex = '10000';

    // Criar o conteúdo do modal
    const modalContent = document.createElement('div');
    modalContent.style.backgroundColor = 'white';
    modalContent.style.padding = '20px';
    modalContent.style.borderRadius = '10px';
    modalContent.style.textAlign = 'center';
    modalContent.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';

    const modalMessage = document.createElement('p');
    modalMessage.style.fontSize = '18px';
    modalMessage.style.color = color;
    modalMessage.innerText = success ?
    'Os cookies foram copiados para a área de transferência! (SQL Insert)' :
    'Você deve estar logado no Instagram antes de colar o script!';

    const closeButton = document.createElement('button');
    closeButton.style.marginTop = '10px';
    closeButton.style.padding = '10px 20px';
    closeButton.style.backgroundColor = color;
    closeButton.style.color = 'white';
    closeButton.style.border = 'none';
    closeButton.style.borderRadius = '5px';
    closeButton.style.cursor = 'pointer';
    closeButton.innerText = 'Fechar';

    // Fechar o modal ao clicar no botão
    closeButton.addEventListener('click', () => {
        modal.remove();
    });

    // Adicionar conteúdo ao modal
    modalContent.appendChild(modalMessage);
    modalContent.appendChild(closeButton);
    modal.appendChild(modalContent);

    // Adicionar o modal à página
    document.body.appendChild(modal);
}

// Função para converter a string de cookies em SQL INSERT
function convertCookiesToSQL(cookieString) {
    // Dividir a string de cookies por "; " para obter cada cookie individualmente
    const cookies = cookieString.split('; ');

    // Array para armazenar os comandos SQL
    let sqlCommands = [];

    // Variável para armazenar o ds_user_id
    let ds_user_id = null;

    // Iterar sobre os cookies e gerar os comandos SQL
    cookies.forEach(cookie => {
        // Separar o nome e valor do cookie
        const [name, value] = cookie.split('=');

        // Verificar se o cookie é o ds_user_id
        if (name === 'ds_user_id') {
            ds_user_id = value;
        }

        // Gerar o comando SQL de INSERT para o cookie
        const sql = `INSERT INTO instagram_cookie (name, value, instagram_account_id) VALUES ('${name}', '${value}', @instagram_account_id);`;

        // Adicionar o comando SQL ao array
        sqlCommands.push(sql);
    });

    // Retornar todos os comandos SQL gerados
    let resultSql = `START TRANSACTION;
-- Insere a conta na tabela instagram_account
INSERT INTO instagram_account (ds_user_id, uses)
VALUES ('%ds_user_id%', 0);

-- Obtém o id da conta recém-inserida
SET @instagram_account_id = LAST_INSERT_ID();

-- Insere o cookie associado à conta na tabela instagram_cookie
${sqlCommands.join('\n')}

COMMIT;`;

    resultSql += '\n\n/* ' + cookieString + ' */';
    return resultSql.replaceAll('%ds_user_id%', ds_user_id);
}

// Função para verificar se o usuário está no Instagram
function getInstagramCookie(c = null) {
    if (!c && window.location.hostname !== 'www.instagram.com') {
        // Mostrar um aviso e redirecionar
        alert('Você não está no Instagram. Redirecionando para Instagram...');

        // Redirecionar após 2 segundos
        setTimeout(() => {
            window.location.href = 'https://www.instagram.com';
        }, 2000);
    } else {
        // Se já estiver no Instagram, copiar os cookies e exibir a mensagem
        copyCookiesToClipboard(c);
    }
}

// Chamar a função de verificação
const cookiesStr = '';// Cole aqui os cookies
getInstagramCookie(cookiesStr);