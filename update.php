<!-- ３３　情報を更新できるようにするためにこのupdate.phpファイルを作る -->
<?php
// 35 'Models/Todo.php'ファイルをリクワイヤーする
// なぜならclassTodoの中に使いたいメソッドがあるから
require_once ('Models/Todo.php');

// ３６　ediat.phpで入力された情報を以下で受け取れるようにしている
// （var_dump(この中は変数);何か値を取得できているかどうかを確認したい時に使う）
$id =$_POST['id'];
$task =$_POST['task'];

// 37　ここでclassTodoが使えるぜって感じ
$todo = new Todo();

// ３８　classTodoのupdateっていうメソッドを実行 更新したいから
// スッキリしないなんでここがこうなるか
$todo->update($task,$id);

// ３９　登録した後にトップのページに戻るためだけに以下を書いた
header('Location: index.php');

// ４０　ここのページはcreate.phpのファイルと同じことをやっている
?>

