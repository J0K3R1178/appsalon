<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }   // Here End Construct

    public function enviarConfirmacion()
    {
        // Create Object of Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a70bfa20bba5e0';
        $mail->Password = 'f08e203867eef1';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Confirma Tu Cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '<strong> Has Creado Tu Cuenta en AppSalon, Solo Debes Confirmar Presionando el Siguiente Enlace.</p>';
        $contenido .= "<p><a href='http://localhost:3000/confirmAccount?token=". $this->token. "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si No Solicitaste Este Cambio Puedes Ignorar El Mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();
    }   // Here End Enviar Confirmacion

}   // Here End Class Email

?>