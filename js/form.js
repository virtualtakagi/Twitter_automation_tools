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
