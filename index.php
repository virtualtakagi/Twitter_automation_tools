<?php

require_once(__DIR__ . '/config.php');

// twitter object
$twitterLogin = new MyApp\TwitterLogin();

if ($twitterLogin->isLoggedIn()) {
  $me = $_SESSION['me'];
}
//create openssl_random_pseudo_bytes
MyApp\Token::create();

 ?>
 <!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>Twitterアカウントツール色々</title>

   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Read Bootstrap Lib -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <style>
   h1 {
     font-size: 18px;
     border-bottom: 1px solid #ccc;
     padding: 3px 0;
   }
   #login {
     text-align: center;
     margin: 70px auto;
   }
   #logout {
     float: right;
   }
   #form {
     margin-bottom: 30px;
   }
  ul, ol {
  background: #fcfcfc;/*背景色*/
  padding: 0.5em 0.5em 0.5em 2em;/*ボックス内の余白*/
  font-size: 12px;
  }

  ul li, ol li {
  line-height: 0.5; /*文の行高*/
  padding: 0.5em 0; /*前後の文との余白*/
  }
   </style>
   <script src="js/form.js"></script>
</head>
<body>
  <div class="container">
    <!-- logged in procedure -->
    <?php if ($twitterLogin->isLoggedIn()) : ?>

      <form action="logout.php" method="post" id="logout">
        <input type="submit" value="Log Out">
        <input class="btn btn-primary" type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

          <h1>Twitterアカウント周辺調査ツール(仮)</h1>
          -> 本ツールの説明
        <ul class="list-group" class="border border-0">
          <li class="list-group-item border-0">「あの人がよく会話している人たちをリストで管理」をコンセプトに本ツールを制作しました。</li>
          <li class="list-group-item border-0">あの人がここ１週間でよく絡む人をリストに自動で追加します。</li>
          <li class="list-group-item border-0">リストに追加することで普段の会話を集中的に見ることができるようになります。</li>
          <li class="list-group-item border-0">普段の会話の他に、どのような人があの人と絡んでいるかが見えるようになります。</li>
        </ul>
        -> 使い方
        <ul class="list-group" class="border border-0">
          <li class="list-group-item list-group-item-info border-0">1. あの人のTwitterIDを「＠」を抜いて入力します。</li>
          <li class="list-group-item list-group-item-info border-0">2. 新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li class="list-group-item list-group-item-info border-0">3. TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>

      <!-- リスト追加に必要なTwitterアカウントを入力させる -->
      <div id="form" class="col-xs-3">
      -> あの人のTwitterIDを入力してください
      <form action="main_procedure.php" name="form1" method=“get” onSubmit="return check1()">
        <input class="form-control" placeholder="ツイッターID" type="text" name="user1" size="15">

    <!-- 作成するリストの名称を入力させる -->
      -> 作成するリストの名前を入力してください<br>
        <input class="form-control" placeholder="作成するリスト名" type="text" name="list_name1" size="25">
        <input class="btn btn-primary" type="submit" value="実行">
      </form>
    </div>

        <h1>リスト追加自動化ツール（仮）</h1>
        -> 本ツールの説明
        <ul class="list-group">
          <li class="list-group-item border-0">「あの人のタイムラインをリストで再現」をコンセプトに本ツールを作成しました。</li>
          <li class="list-group-item border-0">あの人がフォローしている人を一括で自分のリストに追加します。</li>
          <li class="list-group-item border-0">リストに追加することで、あの人とほぼ同じタイムラインを眺めることができます。</li>
          <li class="list-group-item border-0">※ただし、非公開アカウントを除き最大500人までしかリストへ追加することができません。</li>
        </ul>
        <ul>
        -> 使い方
          <li class="list-group-item list-group-item-info border-0">1. あの人のTwitterIDを「＠」を抜いて入力します。</li>
          <li class="list-group-item list-group-item-info border-0">2. 新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li class="list-group-item list-group-item-info border-0">3. TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>

      <!-- リスト追加に必要なTwitterアカウントを入力させる -->
      <div class="col-xs-3">
      -> あの人のTwitterIDを入力してください
      <form action="list.php" name="form2" method=“get” onSubmit="return check2()">
        <input class="form-control" placeholder="ツイッターID" type="text" name="user2" size="15">
      <!-- 作成するリストの名称を入力させる -->
      -> 作成するリストの名前を入力してください
        <input class="form-control" placeholder="作成するリスト名"　type="text" name="list_name2" size="25">
        <input class="btn btn-primary" type="submit" value="実行">
      </form>
    </div>
  </div>

    <!-- not logged in procedure -->
    <?php else : ?>
      <h1>Twitterアカウント周辺調査ツール(仮)</h1>

      <div id="form" id="discription">
        <ul class="list-group">
          <li class="list-group-item border-0">「あの人がよく会話している人たちをリストで管理」をコンセプトに本ツールを制作しました。</li>
          <li class="list-group-item border-0">あの人がここ１週間でよく絡む人をリストに自動で追加します。</li>
          <li class="list-group-item border-0">リストに追加することで普段の会話を集中的に見ることができるようになります。</li>
          <li class="list-group-item border-0">普段の会話の他に、どのような人があの人と絡んでいるかが見えるようになります。</li>
          <li class="list-group-item list-group-item-info border-0">1. あの人のTwitterIDを「＠」を抜いて入力します。</li>
          <li class="list-group-item list-group-item-info border-0">2. 新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li class="list-group-item list-group-item-info border-0">3. TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>
      </div>

      <p>もう一つのツールをご用意しました。</p>

      <h1>リスト追加自動化ツール（仮）</h1>

      <div id="discription">
        このツールの趣旨と使い方について説明します。
        <ul class="list-group">
          <li class="list-group-item">「あの人のタイムラインをリストで再現」をコンセプトに本ツールを作成しました。</li>
          <li class="list-group-item">あの人がフォローしている人を一括で自分のリストに追加します。</li>
          <li class="list-group-item">リストに追加することで、あの人とほぼ同じタイムラインを眺めることができます。</li>
          <li class="list-group-item">※ただし、非公開アカウントを除き最大500人までしかリストへ追加することができません。</li>
          <li class="list-group-item list-group-item-info">1. あの人のTwitterIDを「＠」を抜いて入力します。</li>
          <li class="list-group-item list-group-item-info">2. 新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li class="list-group-item list-group-item-info">3. TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>
      </div>


      ではTwitterへログインし、これらのツールを使ってみましょう
      <div id="login">
        <a href="login.php"><img src="signin_button.png"></a>
      </div>

    <?php endif; ?>
  </div>
</body>
</html>
