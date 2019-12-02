<!-- ６　create.phpを作った -->
<?php
// ７.５　他のファイルを呼び出すための組み込み関数　一回しか実行されない
require_once('Models/Todo.php');
// ８　index.phpのinput要素に入力された言葉をここに受け取るようにしている
$task = $_POST['task'];

// ９　ここでclassTodoが使えるぜって感じ
$todo = new Todo();
// １０　classTodoのcreateっていうメソッドを実行
// ６２　下のメソッドは一旦$createdTaskIdに入れる
// $todo->create($task);　今は使わないからコメントアウト
$createdTaskId = $todo->create($task);
$task = $todo->get($createdTaskId);
// 以下のコードはJavaScriptの配列からphpの配列に変更できる
echo json_encode($task);
exit();


// １１　登録した後にトップのページに戻るためだけに以下を書いた
// ６１　以下は画面遷移をしないから不必要　コメントアウト
// header('Location: index.php');
?>
