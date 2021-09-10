<?php
    require_once "./vendor/autoload.php";

    class User
    {
        private string $login;
        private string $password;
        private string $name;

        public function __construct(string $login, string $password, string $name)
        {
            $this->login = $login;
            $this->password = $password;
            $this->name = $name;
        }

        public function getLogin() : string
        {
            return $this->login;
        }

        public function getPassword() : string
        {
            return $this->password;
        }

        public function getName() : string
        {
            return $this->name;
        }
    }

    class Mail
    {
        private Swift_SmtpTransport $transport;
        private Swift_Mailer $mailer;
        private Swift_Message $message;
        private User $user;

        public function __construct(string $host, int $port, User $user)
        {
            $this->user = $user;
            $this->transport = (new Swift_SmtpTransport($host, $port, 'ssl'))
                ->setUsername($this->user->getLogin())
                ->setPassword($this->user->getPassword());
        }

        public function setMailer() : self
        {
            $this->mailer = new Swift_Mailer($this->transport);
            return $this;
        }

        public function setMessage(string $subject, string $to, string $message) : self
        {
            $this->message = (new Swift_Message($subject))
                ->setFrom([$this->user->getLogin() => $this->user->getName()])
                ->setTo([$to])
                ->setBody($message);

            return $this;
        }

        public function send() : string
        {
            return $this->mailer->send($this->message);
        }
    }

    $user = new User('kokanazar@yandex.ru', '210EvazuSqwertY', 'Nikolay Nazarov');

    $mail = new Mail("smtp.yandex.ru", 465, $user);

    try {
        $result = $mail->setMailer()
            ->setMessage('Тест', 'empiks18@gmail.com', 'Hello world!')
            ->send();

        if ($result) {
            echo 'Сообщение отправленно!';
        }
    }catch(Exception $e){
        echo 'Возникла ошибка отправки сообщения!';
    }