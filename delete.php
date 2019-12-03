<?php
// <!-- ４１　削除機能を作るためにこのファイルを作った -->
// ４３ 'Models/Todo.php'ファイルをリクワイヤーする
// なぜならclassTodoの中に使いたいメソッドがあるから
require_once ('Models/Todo.php');

// ４４　ediat.phpで入力された情報を以下で受け取れるようにしている
// （var_dump(この中は変数);何か値を取得できているかどうかを確認したい時に使う）
$id =$_GET['id'];

// ４５　ここでclassTodoが使えるぜって感じ
// つかここで使うためにclassTodoのなかに４２を書いた
$todo = new Todo();

// ４６　classTodoのupdateっていうメソッドを実行 更新したいから
$todo->delete($id);

// ４７　登録した後にトップのページに戻るためだけに以下を書いた
// ７７　下記を削除画面遷移しないので
// header('Location: index.php');

// ７８　classTodoのcreateメソッドを実行
$res = $todo->delete($id);

// ７９　上記で値を取ってきてその値を取得している
// ここでphpを抜けたい　jsに戻りたいから
echo json_encode($res);
exit();


?>