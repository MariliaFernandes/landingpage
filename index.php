<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once './connection.php';
require './lib/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="css/style.css">
<meta charset=" UTF-8">
<title>OvoChocoChocolate</title>


<head>

<body>
    <header>
        <div class="logo"> <img src='imagens/lg1.png.png'> </div>
        <ul class="menui">

            <li><a href="#">+55(81)9000-0000</a></li>
        </ul>
        <!--menu-->
    </header>

    <body>
        </head>
        <br>

        <body> <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendAddMsg'])) {
            //var_dump($data);
            $query_msg = "INSERT INTO contacts_msgs (name, email, subject, content, created) VALUES (:name, :email, :subject, :content, NOW())";
            $add_msg = $conn->prepare($query_msg);

            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $add_msg->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
            $add_msg->bindParam(':content', $data['content'], PDO::PARAM_STR);

            $add_msg->execute();

            if ($add_msg->rowCount()) {
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = '4d6d5ae1ac19ac';
                    $mail->Password = 'ca9860ede1f84f';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 2525;

                    //Enviar e-mail para o cliente
                    $mail->setFrom('chocolateovochoco@gmail.com', 'Atendimento');
                    $mail->addAddress($data['email'], $data['name']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Recebi a mensagem de Pedido';
                    $mail->Body = "Prezado(a) " . $data['name'] . "<br><br>Recebi o seu e-mail.<br>Será lido o mais rápido possível.<br>Em breve será respondido.<br><br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                    $mail->AltBody = "Prezado(a) " . $data['name'] . "\n\nRecebi o seu e-mail.\nSerá lido o mais rápido possível.\nEm breve será respondido.\n\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    
                    $mail->clearAddresses();

                    //Enviar e-mail para o ovochoco
                    $mail->setFrom('chocolateovochoco@gmail.com', 'Atendimento');
                    $mail->addAddress('xizlil482@gmail.com', 'Lil');

                    $mail->isHTML(true);
                    $mail->Subject = $data['subject'];
                    $mail->Body = "Nome: " . $data['name'] . "<br>E-mail: " . $data['email'] . "<br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                    $mail->AltBody = "Nome: " . $data['name'] . "\nE-mail: " . $data['email'] . "\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    unset($data);
                    echo "Mensagem de Pedido  enviada com sucesso!<br>";                    
                } catch (Exception $e) {
                    echo "Erro: Mensagem de Pedido não enviada com sucesso!<br>";
                }
            } else {
                echo "Erro: Mensagem de Pedido não enviada com sucesso!<br>";
            }
        }
        ?> <div class=" container">
                <div class="form_img">
                    <img src="imagens/inici.png.jpg">
                </div>



                <div class="form">
                    <div class="form_header">

                        <h1>Fazer Pedido 🐰</h1><br><br>
                    </div>
                    <form name=" add_msg" action="" method="POST">
                        <label>Nome :</label>
                        <input class="ip1" type="text" name="name" id="name" placeholder="Nome e sobrenome" value="<?php
            if (isset($data['name'])) {
                echo $data['name'];
            }
            ?>" autofocus required><br>
                        <label>E-mail: </label>
                        <input class="ip1" type="email" name="email" id="name" placeholder="O melhor e-mail" value="<?php
            if (isset($data['email'])) {
                echo $data['email'];
            }
            ?>" required><br>
                        <label>Pedido: </label>
                        <input class="ip1" type="text" name="subject" id="subject" placeholder="Sua escolha" value="<?php
            if (isset($data['subject'])) {
                echo $data['subject'];
            }
            ?>" required><br>

                        <label>Desejo: </label>
                        <input class="ip2" type="text" name="content" id="content" placeholder="Detalhe seu Pedido"
                            value="<?php
                   if (isset($data['content'])) {
                       echo $data['content'];
                   }
                   ?>" required><br>

                        <input type="submit" value="Enviar" name="SendAddMsg" class="bt">

                    </form>
                </div>
            </div>
            <br>
            <div class="about">
                <div class="ig">
                    <img src="imagens/lg2.php.png">
                </div>
                <div class="text">
                    <h1>Sobre</h1>
                    <br>
                    <h2>
                        ChocoChocolate é uma empresa de chocolate
                        caseiro feito por Mulheres que amam o que fazem.
                        Temos deliciosos ovos de Páscoa recheados, cheio
                        de alegria e Sabores que só a ChocoChocolate tem!
                    </h2>
                </div>
            </div>

            <br> <br>
            <section id="menu" class="menu section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Menu</h2>

                    </div>
                    <div class="ig">
                        <img src="imagens/bunny.png">
                    </div>
                    <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-6 menu-item filter-starters">
                            <img src="imagens/ovo1.png" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#">OvoChoco</a><span>$18.95</span>
                            </div>
                            <div class="menu-ingredients">
                                chocolate, creme de leite.
                            </div>
                        </div>

                        <div class="col-lg-6 menu-item filter-specialty">
                            <img src="imagens/ovo4.png" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#">OvoChoco Limolicia</a><span>$43.95</span>
                            </div>
                            <div class="menu-ingredients">
                                Raspas de casca de limão e creme de leite.
                            </div>
                        </div>

                        <div class="col-lg-6 menu-item filter-starters">
                            <img src="imagens/ovo-de-pascoa.png" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#"> OvoChoco Cake</a><span>$11.95</span>
                            </div>
                            <div class="menu-ingredients">
                                leite condensado e cacau em pó.
                            </div>
                        </div>

                        <div class="col-lg-6 menu-item filter-salads">
                            <img src="imagens/ovo7.png" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#">OvoChoco Casadinho</a><span>$14.95</span>
                            </div>
                            <div class="menu-ingredients">
                                Leite condensado, chocolate em pó e creme de leite.
                            </div>
                        </div>

                        <div class="col-lg-6 menu-item filter-specialty">
                            <img src="imagens/ovo22.png" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#">OvoChoco Bebê</a><span>$9.95</span>
                            </div>
                            <div class="menu-ingredients">
                                Brigadeiro de Nutella, casquinha de chocolate ao leite.
                            </div>

                        </div>






                    </div>

                </div>
            </section>
            <br> <br>
            <div class="endc">
                <center><strong><span>ChocoChocolate</span></strong>. All Rights Reserved</center>
            </div>
        </body>

</html>