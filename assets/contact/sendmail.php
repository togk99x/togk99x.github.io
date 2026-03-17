<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit("不正なアクセスです。");
}

$username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
$email    = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$tel      = isset($_POST["tel"]) ? trim($_POST["tel"]) : "";
$message  = isset($_POST["message"]) ? trim($_POST["message"]) : "";

// validation
$errors = [];

if ($username === "") {
  $errors[] = "お名前を入力してください。";
}

if ($email === "") {
  $errors[] = "メールアドレスを入力してください。";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "メールアドレスの形式が正しくありません。";
}

if ($message === "") {
  $errors[] = "お問い合わせ内容を入力してください。";
}

// エラーがある場合
if (!empty($errors)) {
  foreach ($errors as $error) {
    echo "<p>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</p>";
  }
  echo '<p><a href="javascript:history.back()">戻る</a></p>';
  exit;
}

// 送信先メールアドレス
$to = "togk99x@gmail.com";

// 件名
$subject = "お問い合わせがありました";

// 本文
$body = "";
$body .= "ホームページからお問い合わせがありました。\n\n";
$body .= "お名前: " . $username . "\n";
$body .= "メールアドレス: " . $email . "\n";
$body .= "電話番号: " . $tel . "\n";
$body .= "お問い合わせ内容:\n" . $message . "\n";

// 送信元ヘッダー
$headers = "From: togk99x@gmail.com\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

// メール送信
$result = mb_send_mail($to, $subject, $body, $headers);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お問い合わせ送信完了</title>
</head>
<body>
<?php if ($result): ?>
  <h1>送信完了</h1>
  <p>お問い合わせありがとうございました。</p>
<?php else: ?>
  <h1>送信失敗</h1>
  <p>送信に失敗しました。設定をご確認ください。</p>
<?php endif; ?>

<p><a href="index.html">トップへ戻る</a></p>
</body>
</html>
