<?php

namespace Classes;

use Model\Usuario;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;


    public $contenido;
    
    public function __construct($email, $nombre, $token=null)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }


    

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
     
         $mail->setFrom("matcre01@gmail.com", "VIDAETC.");
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en DevWebCamp; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
        $mail->setFrom("matcre01@gmail.com", "VIDAETC.");
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

     

        //Enviar el mail
        $mail->send();
    }

    public function enviarContacto($contacto) {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
        $mail->setFrom("matcre01@gmail.com", "VIDAETC.");
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = $contacto["asunto"];

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Tienes un mensaje de contacto .</p>";
        $contenido .= "<p> Soy " . $contacto["nombre"] .  " </strong> y mi mensaje es "  . $contacto["mensaje"]  . ".</p>";
        $contenido .= "<p><strong>Mi numero es " . $contacto["telefono"] .  " y mi email es " . $contacto["email"]  ." </strong> .</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

     

        //Enviar el mail
        $mail->send();
    }

    public function enviarInvoice($invoice){
          // create a new object
          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->Host = $_ENV['EMAIL_HOST'];
          $mail->SMTPAuth = true;
          $mail->Port = $_ENV['EMAIL_PORT'];
          $mail->Username = $_ENV['EMAIL_USER'];
          $mail->Password = $_ENV['EMAIL_PASS'];
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      
          $mail->setFrom("matcre01@gmail.com", "VIDAETC.");
          $mail->addAddress($this->email, $this->nombre);
          $mail->Subject = 'Invoice de Compra';
  
          // Set HTML
          $mail->isHTML(TRUE);
          $mail->CharSet = 'UTF-8';
  
          $contenido = '<html>';
          $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Gracias por tu compra en VIDA ETC.</p>";     
          $contenido .= "<p>Adjuntamos el invoice de compra.</p>";
          $contenido .= '</html>';
          $mail->Body = $contenido;

          $mail->AddStringAttachment($invoice, 'factura.pdf');

  
          //Enviar el mail
          $mail->send();
    }


    public function enviarMensajesMasivos() {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
        $mail->setFrom("matcre01@gmail.com", "DevWebCamp");
    
        $usuarios = Usuario::whereArray(['admin' => 0, 'estado' => 1, 'confirmado' => 1])->get();
    
        $mail->Subject = 'Ofertas';
        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
    
        foreach ($usuarios as $usuario) {
            // Generar contenido del mensaje para cada usuario
            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $usuario->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $usuario->token . "'>Reestablecer Password</a>";        
            $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
            $contenido .= '</html>';
    
            // Configurar el destinatario y el cuerpo del mensaje
            $mail->addAddress($usuario->email, $usuario->nombre);
            $mail->Body = $contenido;
    
            // Enviar el correo
            $mail->send();
    
            // Limpiar los destinatarios para el próximo bucle
            $mail->clearAddresses();
        }
    }
    
}

