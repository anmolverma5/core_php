<?php

     
     
     
    if(isset($_POST['send']))
    {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        // $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        
         
        $to = "marketing@bpssecurity.in"; // You can change here your Email
        $from = "pksitsolutions15@gmail.com";
        //$from = "no-reply@pksitsolution.com"; // You can change here your Email
        // $subject = "$name has sent you a mail"; // This is your subject
         
        // HTML Message Starts here
        $body =" 
        Hi,
        
        You've received a new mail from BPS SECURITY Contact Page.
        
        The details are given below.
        
        
          Name: $name 
          
          email: $email 
                
          Subject: $subject 
                
          Message: $message     
              
              
                ";
        // HTML Message Ends here
         
        // Always set content-type when sending HTML email
        $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
 
        // More headers
        $headers = 'From: '.$from."\r\n" .
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        if(mail($to,$subject,$body,$headers)){
            // Message if mail has been sent
            echo "<script>
                    alert('Thank you $name. Your message has been sent successfully.');
                    window.location = 'https://bpssecurity.in/contact.php';
                </script>";
        }
 
        else{
            // Message if mail has been not sent
            echo "<script>
                    alert('EMAIL FAILED');
                    window.location = 'https://bpssecurity.in/contact.php';
                </script>";
        }
    }
?>

