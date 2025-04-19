<?php
// Inclui os arquivos necessários da biblioteca PHPMailer
require 'phpmailer/PHPMailer.php';  // Classe principal do PHPMailer
require 'phpmailer/SMTP.php';       // Classe para envio via SMTP
require 'phpmailer/Exception.php';  // Classe para tratamento de exceções


// Define o título da mensagem (assunto do e-mail)
$title = "Contato via formulário do site ";

// Obtém os dados do formulário submetido via POST
$name = $_POST['name'];      // Nome do remetente
$email = $_POST['email'];    // E-mail do remetente
$message = $_POST['message']; // Mensagem do remetente

// Define o assunto do e-mail
$subject = "Nova mensagem recebida";

// Monta o corpo do e-mail com os dados recebidos
// \n cria quebras de linha no texto
$body = "Nome: $name\nEmail: $email\nMensagem:\n$message";

// Cria uma nova instância do PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
  // Configuração do servidor SMTP
  $mail->isSMTP();           // Define que o envio será via SMTP
  $mail->CharSet = "UTF-8";  // Define a codificação de caracteres como UTF-8
  $mail->SMTPAuth = true;    // Habilita autenticação SMTP

  // Configurações do servidor de e-mail
  $mail->Host = 'smtp.gmail.com';     // Endereço do servidor SMTP
  $mail->Username = 'minhacont7@gmail.com'; // Usuário do SMTP ---- SEU EMAIL GMAIL
  $mail->Password = 'koxt pxsa nngo bmnq'; // Senha do SMTP --- SENHA APP GMAIL
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Tipo de criptografia (ssl/tls)
  $mail->Port = 465;                   // Porta do servidor SMTP (geralmente 465 para SSL, 587 para TLS)

  // Configura o remetente
  $mail->setFrom('minhacont7@gmail.com', $title); // E-mail do remetente e nome/título associado

  // Adiciona o destinatário
  $mail->addAddress('andersombad@gmail.com');   // E-mail do destinatário

  // Configura o formato do e-mail
  $mail->isHTML(true);       // Define que o e-mail será enviado como HTML
  $mail->Subject = $title;   // Assunto do e-mail
  $mail->Body = $body;       // Corpo do e-mail

  // Tenta enviar o e-mail
  $mail->send();
  
  // Se o envio for bem sucedido:
  http_response_code(200);   // Retorna código HTTP 200 (OK)
  echo "Mensagem enviada com sucesso!";

} catch (Exception $e) {
  // Se ocorrer algum erro no envio:
  http_response_code(500);   // Retorna código HTTP 500 (Internal Server Error)
  echo "Erro ao enviar mensagem. Por favor, tente novamente mais tarde.";
  // Para debug, você pode descomentar a linha abaixo:
  // echo "Mailer Error: " . $mail->ErrorInfo;
}