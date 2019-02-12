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
   <style>
   #container {
     width: 500px;
     margin: 0 auto;
   }
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
   #discription {
     font-size: 12px;
     border-bottom: 1px solid #ccc;
     padding: 3px 0;
   }
   #input_form {
     padding-top: 10px;
     padding-bottom: 30px;
   }
   ul {
     list-style-type: disc;
   }
   </style>

   <script type="text/javascript">
   function check1(){
   	var flag_id1 = 0;
    var flag_name1 = 0;
    var flag_input1 = 0;
    var regex = /^\d/;

   	if(document.form1.user1.value == ""){ // Check Twitter ID
   		flag_id1 = 1;
   	} else if(document.form1.list_name1.value == ""){ // Check List_Name
   		flag_name1 = 1;
    } else if(regex.test(document.form1.list_name1.value)){ // Check List Lead Numeric
   		flag_input1 = 1;
   	}

   	// 設定終了
   	if(flag_id1){
   		window.alert('入力漏れがあります。TwitterIDを入力してください。'); // 入力漏れがあれば警告ダイアログを表示
   		return false; // 送信を中止
    } else if(flag_name1) {
      window.alert('入力漏れがあります。作成するリスト名を入力してください。'); // 入力漏れがあれば警告ダイアログを表示
      return false; // 送信を中止
    } else if(flag_input1) {
        window.alert('リスト名の先頭には数字は使用できません。'); // 入力漏れがあれば警告ダイアログを表示
        return false; // 送信を中止
    } else {
   		return true; // 送信を実行
   	}
   }

   function check2(){
    var flag_id2 = 0;
    var flag_name2 = 0;
    var flag_input2 = 0;
    var regex = /^\d/;

    if(document.form2.user2.value == ""){ // Check Twitter ID
       flag_id2 = 1;
     } else if(document.form2.list_name2.value == ""){ // Check List_Name
       flag_name2 = 1;
    } else if(regex.test(document.form2.list_name2.value)){ // Check List Lead Numeric
       flag_input2 = 1;
     }

     // 設定終了
    if(flag_id2){
      window.alert('入力漏れがあります。TwitterIDを入力してください。'); // 入力漏れがあれば警告ダイアログを表示
      return false; // 送信を中止
    } else if(flag_name2) {
      window.alert('入力漏れがあります。作成するリスト名を入力してください。'); // 入力漏れがあれば警告ダイアログを表示
      return false; // 送信を中止
    } else if(flag_input2) {
        window.alert('リスト名の先頭には数字は使用できません。'); // 入力漏れがあれば警告ダイアログを表示
        return false; // 送信を中止
    } else {
      return true; // 送信を実行
    }
   }

 </script>
</head>
<body>
  <div id="container">
    <!-logged in procedure->
    <?php if ($twitterLogin->isLoggedIn()) : ?>

      <form action="logout.php" method="post" id="logout">
        <input type="submit" value="Log Out">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

      <h1>Twitterアカウント周辺調査ツール(仮)</h1>
      <div id="discription">
        このツールの趣旨と使い方について説明します。
        <ul id="point">
          <li>「あの人がよく会話している人たちをリストで管理」をコンセプトに制作しました。</li>
          <li>誰かが最近よく絡む人をリストに自動で追加します。</li>
          <li>リストに追加することで普段の会話を集中的に見ることができるようになります。</li>
          <li>対象とする人のTwitterIDを「＠」を抜いて入力します。</li>
          <li>新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li>TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>
      </div>
      <! リスト追加に必要なTwitterアカウントを入力させる>
      <div id="input_form">
      対象のTwitterIDを入力してください
      <form action="main_procedure.php" name="form1" method=“get” onSubmit="return check1()">
        <input type="text" name="user1" size="15">
<br>
 <! 作成するリストの名称を入力させる>
      作成するリストの名前を入力してください<br>
        <input type="text" name="list_name1" size="25">
        <input type="submit" value="実行">
      </form>
    </div>

      <h1>リスト追加自動化ツール（仮）</h1>
      <div id="discription">
        このツールの趣旨と使い方について説明します。
        <ul id="point">
          <li>「あの人のタイムラインをリストで再現」をコンセプトに本ツールを作成しました。</li>
          <li>誰かがフォローしている人を一括で自分のリストに追加します。</li>
          <li>※ただし、最大500人までしかリストへ追加することができません。</li>
          <li>対象とする人のTwitterIDを「＠」を抜いて入力します。</li>
          <li>新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li>TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>
      </div>
      <! リスト追加に必要なTwitterアカウントを入力させる>
      <div id="input_form">
      対象のTwitterIDを入力してください
      <form action="list.php" name="form2" method=“get” onSubmit="return check2()">
        <input type="text" name="user2" size="15">
<br>
      <! 作成するリストの名称を入力させる>
      作成するリストの名前を入力してください
        <input type="text" name="list_name2" size="25">
        <input type="submit" value="実行">
      </form>
    </div>
    <!- not logged in procedure ->
    <?php else : ?>
      <h1>Twitterアカウント周辺調査ツール(仮)</h1>

      <div id="discription">
        このツールの趣旨と使い方について説明します。
        <ul id="point">
          <li>「あの人がよく会話している人たちをリストで管理」をコンセプトに制作しました。</li>
          <li>誰かが最近よく絡む人をリストに自動で追加します。</li>
          <li>リストに追加することで普段の会話を集中的に見ることができるようになります。</li>
          <li>対象とする人のTwitterIDを「＠」を抜いて入力します。</li>
          <li>新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li>TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
        </ul>
      </div>

      <p>もう一つのツールをご用意しました。</p>

      <h1>リスト追加自動化ツール（仮）</h1>

      <div id="discription">
        このツールの趣旨と使い方について説明します。
        <ul id="point">
          <li>「あの人のタイムラインをリストで再現」をコンセプトに本ツールを作成しました。</li>
          <li>誰かがフォローしている人を一括で自分のリストに追加します。</li>
          <li>※ただし、最大500人までしかリストへ追加することができません。</li>
          <li>対象とする人のTwitterIDを「＠」を抜いて入力します。</li>
          <li>新規に作成し、Twitterアカウントを追加するリストの名称を入力します。</li>
          <li>TwitterIDとリスト名を入力したら「実行」をクリックまたはタップします</li>
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
