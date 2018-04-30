<?php
    class email {
        private $_from = ''; //sender
        private $_to = ''; //sending to
        private $_subject = ''; //subject of email
        private $_message = ''; //email body
        
        public function __construct(){ //default constructor
            $this->from = '';
            $this->to = '';
            $this->subject = '';
            $this->message = '';
        }
        
        public function setSender($_from){ 
            $this->from = $_from;
        }
        
        public function getSender(){
            return $this->from;
        }
        
        public function setSendTo($_to){
            $this->to = $_to;
        }
        
        public function getSendTo(){
            return $this->to;
        }
        
        public function setMessage($_message){
            $this->message = $_message;
        }
        
        public function getMessage(){
            return $this->message;
        }
        
        public function setSubject($_subject){
            $this->subject = $_subject;
        }
        
        public function getSubject(){
            return $this->subject;
        }
        
        public function sendEmail(){
           $success = mail($this->getSendTo(), $this->getSubject(), $this->getMessage(), 'From: '. $this->getSender());
            
            if(!$success){ //if email not sent notify user
                echo('Email not sent');
            }
            else { // if email sent confirm
                echo('<h1>Confirmation Email Sent!</h1>');
            }
        }
    }
?>