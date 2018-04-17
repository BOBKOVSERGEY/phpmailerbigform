<?php

require_once __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$message = '';
if (isset($_POST["submit"])) {
  $programmingLanguage = '';

  if (!empty($_POST['language'])) {
    foreach ($_POST['language'] as $row) {
      $programmingLanguage .= $row . ', ';
    }

    // убираем у последнего элемента запятую
    $programmingLanguage = substr($programmingLanguage, 0, -2);
  }


  $path = 'upload/' . $_FILES['resume']['name'];

  // перемещаем загруженный файл
  move_uploaded_file($_FILES['resume']['tmp_name'], $path);

  // формируем шаблон
  $message = '<h3 align="center">Programmer Details</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
		<tr>
				<td width="30%">Имя</td>
				<td width="70%">'. $_POST["name"] .'</td>
			</tr>
			<tr>
				<td width="30%">Адрес</td>
				<td width="70%">'. $_POST["address"] .'</td>
			</tr>
			<tr>
				<td width="30%">Email</td>
				<td width="70%">'. $_POST["email"] .'</td>
			</tr>
			<tr>
				<td width="30%">Знания языков</td>
				<td width="70%">'. $programmingLanguage .'</td>
			</tr>
			<tr>
				<td width="30%">Опыт</td>
				<td width="70%">'. $_POST["experience"]. '</td>
			</tr>
			<tr>
				<td width="30%">Номер телефона</td>
				<td width="70%">'.$_POST["mobile"].'</td>
			</tr>
			<tr>
				<td width="30%">Дополнительная информация</td>
				<td width="70%">'.$_POST["additional_information"].'</td>
			</tr>
		</table>';


  $mail = new PHPMailer();

  $mail->isSMTP();

  $mail->Host = 'smtp.gmail.com';

  $mail->SMTPAuth = true;

  $mail->Username = "********";
  $mail->Password = "********";

  $mail->SMTPSecure = 'ssl';

  $mail->Port = '465';

// от кого отправляем
  $mail->From = $_POST['email'];
// имя кто отправляет
  $mail->FromName  = $_POST['name'];

// кому отправляем
  $mail->addAddress('sergey_bobkov@inbox.ru', 'Сергей');
  //$mail->addAddress('mister-shcustrik@yandex.ru');

// копия
  //$mail->addCC('info@sitesdevelopment.ru');

// скрытая копия
  //$mail->addBCC('info@sitesdevelopment.ru');

// письмо в формате html
  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';

// тема письма
  $mail->Subject = 'Регистрация программистов';


  // прикрепленный файл
  $mail->addAttachment($path);

  // тело письма
  $mail->Body = $message;

  // если сообщение отправлено
  if ($mail->send()) {
    $message = '<div class="alert alert-success">Сообщение успешно отправлено</div>';

    if (!empty($_FILES['resume']['name'])) {
      unlink($path);
    }
    // удаляем файл

  } else {
    $message = '<div class="alert alert-danger">Что то пошло не так</div>';
  }

}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h1>Send Email with Attachment in PHP using PHPMailer</h1>
      <h2>Programmer Register Here</h2>
      <?php echo $message; ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstName">Введите имя</label>
              <input type="text" name="name" class="form-control" id="firstName" placeholder="Введите имя" required>
            </div>
            <div class="form-group">
              <label for="address">Введите адрес</label>
              <textarea class="form-control" name="address" id="address" rows="3" placeholder="Введите адрес" required></textarea>
            </div>
            <div class="form-group">
              <label for="email">Введите email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Введите email" required>
            </div>
            <div class="form-group">
              <label for="language">Выберите язык программирования</label>
              <select multiple class="form-control" id="language" name="language[]" required>
                <option value=".NET">.NET</option>
                <option value="Android">Android</option>
                <option value="ASP">ASP</option>
                <option value="Blackberry">Blackberry</option>
                <option value="C">C</option>
                <option value="C++">C++</option>
                <option value="COCOA">COCOA</option>
                <option value="CSS">CSS</option>
                <option value="DHTML">DHTML</option>
                <option value="Drupal">Drupal</option>
                <option value="Flash">Flash</option>
                <option value="HTML">HTML</option>
                <option value="HTML 5">HTML 5</option>
                <option value="IPAD">IPAD</option>
                <option value="IPHONE">IPHONE</option>
                <option value="Java">Java</option>
                <option value="Java Script">Java Script</option>
                <option value="Joomla">Joomla</option>
                <option value="LAMP">LAMP</option>
                <option value="Linux">Linux</option>
                <option value="MAC OS">MAC OS</option>
                <option value="Magento">Magento</option>
                <option value="MySQL">MySQL</option>
                <option value="Oracle">Oracle</option>
                <option value="PayPal">PayPal</option>
                <option value="Perl">Perl</option>
                <option value="PHP">PHP</option>
                <option value="Ruby on Rails">Ruby on Rails</option>
                <option value="Salesforce.com">Salesforce.com</option>
                <option value="SEO">SEO</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="experience">Сколько лет опыта</label>
              <select class="form-control" name="experience" id="experience" required>
                <option value="">Сколько лет</option>
                <option value="0-1 years">0-1 years</option>
                <option value="2-3 years">2-3 years</option>
                <option value="4-5 years">4-5 years</option>
                <option value="6-7 years">6-7 years</option>
                <option value="8-9 years">8-9 years</option>
                <option value="10 or more years">10 or more years</option>
              </select>
            </div>
            <div class="form-group">
              <label for="mobile">Введите телефон</label>
              <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Введите телефон" pattern="\d*" required>
            </div>
            <div class="form-group">
              <label for="resume">Добавьте ваше резюме</label>
              <input type="file" name="resume" class="form-control-file" id="resume" accept=".doc, .docx, .pdf" required>
            </div>
            <div class="form-group">
              <label for="additional_information">Введите дополнительную информацию</label>
              <textarea class="form-control" name="additional_information" id="additional_information" rows="6" placeholder="Введите дополнительную информацию"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group text-center">
          <button class="btn btn-primary" name="submit" type="submit">Отправить</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>