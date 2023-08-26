<?php
include_once './include/connection.php';
include_once './config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
// Create a new PHPMailer instance
$mail = new PHPMailer(true);

if ($_POST) {
  $newId = decryptID($_POST['id'], $secretKey);
  $redirect_url = $_POST['redirect_url'];
  $base_url = $_POST['base_url'];


  $sql = "SELECT * FROM users WHERE id = $newId";
  $userResult = $conn->query($sql);
  if ($userResult->num_rows > 0) {
    $row = $userResult->fetch_assoc();
    $tid = $row['tid'];
    $to = $row['email'];
    $membership_no = $row['membership_no'];
    $name = $row['first_name'] . " " . $row['last_name'];

    try {
      $mail->isSMTP();
      $mail->SMTPDebug = 2;
      $mail->Host = 'smtp.hostinger.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = 'info@dermazonesouth2023.com';
      $mail->Password = 'Crution@123';
      $mail->Subject = "Dermazone South 2023 Payment Confirmation";
      $mail->Body = '<html>
                <head>
                    <title>Welcome to Dermazone South 2023</title>
                </head>
             
                <body style="background-color:grey">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="550" bgcolor="white"
                        style="border:2px solid black">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="col-550" width="550">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="background-color: #FF5E14;height: 50px;">

                                                    <a href="#" style="text-decoration: none;">
                                                        <p style="color:white;font-weight:bold;">
                                                            Dermazone South 2023
                                                        </p>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="height: 150px;">
                                <td align="center"
                                    style="border: none;border-bottom: 2px solid #FF5E14;padding-right: 10px;padding-left:10px">

                                    <p style="font-weight: bolder;font-size: 25px;letter-spacing: 1px;color:black; line-height: 50px;">
                                        Hello ' . $name . '!                                      
                                    </p>
                                    <p style="font-weight: bolder;font-size: 20px;">
                                    Abstract Submited Successfully!
                                    </p>
                                </td>
                            </tr>

                            <tr style="display: inline-block;">
                                <td style="padding: 30px;border: none;border-bottom: 2px solid #361B0E;background-color: white;">

                                    <table cellpadding="5" cellspacing="5" style=" width: 100%; text-align: left; font-size: 18px;">
                                        <tr>
                                            <th>IADVL Number :</th>
                                            <td>' . $membership_no . '</td>
                                        </tr>
                                        <tr>
                                            <th>Name:</th>
                                            <td>' . $name . '</td>
                                        </tr>
                                        <tr>
                                            <th>Membership Type:</th>
                                            <td>' . $row["member_type"] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Food Type:</th>
                                            <td>' . $row["food"] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status:</th>
                                            <td>' . $row['payment_status'] . '</td>
                                        </tr>
                                                                      
                                        <tr>
                                            <th>Amount Paid:</th>
                                            <td>' . $row['amount'] . '</td>
                                        </tr>


                                    </table>
                                    <p style="margin-top:30px; text-align: center; width: 100%;">
                                        <a href="https://dermazonesouth2023.com"
                                            style="text-decoration: none;color:black;border: 2px solid #FF5E14;padding: 10px 30px;font-weight: bold;">
                                            Read More
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            <tr
                                style="border: none;background-color: #FF5E14;height: 40px;color:white;padding-bottom: 20px;text-align: center;">

                                <td height="40px" align="center">
                                    <p style="color:white;line-height: 20px;">
                                        DermazoneSouth2023
                                    </p>
                                    <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                        <img height="30"
                                            src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-twitter_20190610074030.png"
                                            width="30" />
                                    </a>

                                    <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                        <img height="30"
                                            src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/icon-linkedin_20190610074015.png"
                                            width="30" />
                                    </a>

                                    <a href="#" style="border:none;text-decoration: none;padding: 5px;">
                                        <img height="20"
                                            src="https://extraaedgeresources.blob.core.windows.net/demo/salesdemo/EmailAttachments/facebook-letter-logo_20190610100050.png"
                                            width="24" style="position: relative;padding-bottom: 5px;" />
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:"Open Sans", Arial, sans-serif;font-size:11px; line-height:18px;color:#999999;"
                                    valign="top" align="center">
                                    <a href="' . $base_url . 'privacy-policy.php" target="_blank" style="color:#999999;text-decoration:underline;">PRIVACY STATEMENT</a>
                                    | <a href="' . $base_url . 'terms-and-conditions.php" target="_blank" style="color:#999999; text-decoration:underline;">TERMS OF SERVICE</a>
                                    | <a href="' . $base_url . 'cancellation-refund-policy.php" target="_blank" style="color:#999999; text-decoration:underline;">RETURNS</a><br>
                                    &copy; 2023 DermazoneSouth. All Rights Reserved.<br>
                                    If you do not wish to receive any further
                                    emails from us, please <a href="#" target="_blank"
                                        style="text-decoration:none;color:#999999;">unsubscribe</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    </tr>
                    <tr>
                        <td class="em_hide" style="line-height:1px;min-width:700px;background-color:#ffffff;">
                            <img alt="" src="images/spacer.gif"
                                style="max-height:1px;min-height:1px;display:block;width:700px;min-width:700px;" width="700" border="0"
                                height="1">
                        </td>
                    </tr>
                    </tbody>
                    </table>
                </body>
          </html>';
      // Sender and recipient
      $mail->setFrom('info@dermazonesouth2023.com', 'Dermazone South 2023');
      $mail->addAddress($to, $name);
      $mail->AddCC("info@dermazonesouth2023.com", $name);
      // Email content
      $mail->isHTML(true);
      // echo $mail->Body;

      if ($mail->send()) {
        echo "Success";
      } else {
        echo "Failed";
      }
    } catch (Exception $e) {
      echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
  }
}
