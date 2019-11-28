<?php
// １３ 自分以外のファイルを読み込む時に使う組み込み関数
// config/config/dbconnect.phpを読み込んでくださいと言っている
require_once ('Models/Todo.php');
// ２０　以下をすることで１９で行った処理がこのファイルで効力を持つようになる
require_once ('function.php');

// １４　ここでclassTodoが使えるぜって感じ
$todo = new Todo();


// １５　何したかわかりません
require_once('Models/Todo.php');
//Todoクラスのインスタンス化
$todo = new Todo();
//DBからデータを全件取得
$tasks = $todo->all();
//
// echo '<pre>';
// var_dump($tasks);
// １５　exitは処理を中断するということexitより下のものは処理をやめさせる魔法の言葉
// これをやらないと見えずらいことがあるからexitを使う
// 値を確認するときにexitを使う
// exit();


?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- ５　なんか知らんけどこれをコピペした -->
<header class="px-5 bg-primary">
    <nav class="navbar navbar-dark">
        <a href="index.php" class="navbar-brand">TODO APP</a>
        <div class="justify-content-end">
            <span class="text-light">
                SeedKun
            </span>
        </div>
    </nav>
</header>
<main class="container py-5">
<section>
        <form class="form-row justify-content-center" action="create.php" method="POST">
            <div class="col-10 col-md-6 py-2">
                <input type="text" class="form-control" placeholder="ADD TODO" name="task">
            </div>
            <div class="py-2 col-md-3 col-10">
                <button type="submit" class="col-12 btn btn-primary">ADD</button>
            </div>
        </form>
</section>
  <table class="table table-hover">
      <thead>
        <tr class="bg-primary text-light">
            <th class=>TODO</th>
            <th>DUE DATE</th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody>
      <!-- １６　tasksにはデータベースの情報が全て入っている（index.php１４行目）のでその情報を1個ずつ取り出したいから
      foreachをしている -->
      <?php foreach($tasks as $task):?>

        <!--ここ以下後ほど繰り返し処理する-->
        <tr>
        <!-- １７　タスクに入っているname（名前）due-dateと（日づけ）を1個ずつ出力しようとしている
        これをすると名前と日付を取得できるので一覧の表示ができるようになる -->
        <!-- ５０　日付を日本人が見えやすいように月何日というように変更 -->
            <td><?php echo $task['name']; ?></td>
            <td><?php echo date('F.d,Y', strtotime($task['due_date']))?></td>
            <td>
            <!-- ４８　以下の<i class="fas fa-edit"></i>はフォントアンセムからパクってきたものでパクってくると文字だったところが -->
            <!-- フォントアンセムのアイコンに変わる -->
            <a class="text-success" href="edit.php?id=<?php echo h($task['id']); ?>"><i class="fas fa-edit"></i></a>
            </td>
            <td>
            <!-- ２３　EDITをクリックするとedit.phpファイルにリンクすることができるようにする
            aタグを使うとGETが使える -->
            <!-- href以降のところをかくとクリックしたidをそれぞれ取得することができる -->
            <!-- ４９　以下も４８と同様 -->
            <a class="text-info" href="delete.php?id=<?php echo h($task['id']); ?>"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <!--/ ここ以上後ほど繰り返し処理する-->
        <!-- １６　 -->
        <?php endforeach;?>
      </tbody>
  </table>
</section>
    </section>

</main>
</body>
</html>