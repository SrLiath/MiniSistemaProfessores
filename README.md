# Mini Sistema de Professores usando CodeIgniter 4, MySQL, jQuery, SweetAlert, CSS e HTML

Este é um mini sistema desenvolvido em CodeIgniter 4, utilizando MySQL como banco de dados e integrando jQuery, SweetAlert, CSS e HTML para proporcionar uma experiência amigável aos usuários. O sistema inclui funcionalidades de login para professores, uma área logada para gerenciamento de mensagens e um formulário a parte para envio de mensagens pelos alunos com um campo separado para verificar a respsota do professor.

## Demonstração
![GIF Animado](https://github.com/SrLiath/MiniSistemaProfessores/blob/3336d3ee6bd61096ec761983b8c9000b7b78d0da/demonstracao.gif)


### 1. Login para Professores
Implementamos um sistema de login seguro utilizando session e criptografia de senha (sha256) para garantir que apenas professores autorizados tenham acesso a área logada.

### 2. Área Logada para Professores
Dentro da área logada, os professores podem:
- Visualizar uma lista de mensagens enviadas por alunos.
- Responder as mensagens.
- Editar mensagens existentes.
- Deletar mensagens enviadas.

### 3. Formulário para Alunos (Fora da Área Logada)
Fora da área logada, os alunos têm acesso a um formulário simples para enviar mensagens aos professores. O formulário inclui:
- Seleção do professor destinatário a partir de uma lista de professores cadastrados.
- Campo para digitar a mensagem.
- Descrição sobre seus dados

## Tecnologias Utilizadas
- CodeIgniter 4 (PHP)
- MySQL
- jQuery
- SweetAlert
- CSS
- HTML

## Instruções de Execução
1. Clone este repositório.
2. Configure o ambiente do CodeIgniter 4 e o banco de dados MySQL(coloque o URL do sistema no app/config/App.php, execute o banco.sql em seu banco para criar os professores de teste, podendo ser editado a sua forma, lembrando, a senha no banco está como sha256).
3. Execute o servidor local.
4. Acesse o sistema pelo navegador.

**Observação:** Certifique-se de ter deixado o base_url e ter executado o banco.sql.
