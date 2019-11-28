<?php
// １　1回だけしか呼び出さないからこの書き方
// 自分以外のファイルを読み込む時に使う組み込み関数
// config/dbconnect.phpを読み込んでくださいと言っている
require_once('config/dbconnect.php');

// 2class Todoを作る
class Todo 
{
    // ３　データベースの中の値をこのclassの中で使えるように宣言
    // class DbManagerを実体化したものをここに書いている
    private $table = 'tasks';
    private $db_manager;

    // ４　データベースを繋がるようにした
    // これが誕生した瞬間にデータベースに接続してくださいっていう命令を書いているのがconstruct
    // 上記の命令が初期値
    public function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }
    // ７　これをかく prepare excuteが関わってくるよ
    // Todo用のデータを作成するために（レコードの中にデータを入れるために）以下を書いています
    public function create($name)
    {
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO '.$this->table.' (name) VALUES (?)');
        $stmt->execute([$name]);
    }

    public function all()
    {
        // $stmt = $this->db_manager->dbh->prepare(ここにsql文);
        // SELECT * FROM テーブル名

        //１２ 登録したデータを取得しに行くためのコード
        // prepareとexecuteはセットだからこの２行はかく　もしどちらかを書かなくてもかく
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        // １２　一覧が欲しい時には　->fetchAll();メソッドを使う　取ってきたデータを使いやすくしてくれている
        // 使いやすくしたものを$tasksに入れている
        $tasks = $stmt->fetchAll();
        // １２　この取得したデータを他のところへ持っていけるようにするコードがreturn
        return $tasks;

       }

    //２６　新しいメソッドをこのclassの中に追加
    //editするためのデータを取得 editがgetに変わっている？？よくわからない
    // stmtにidの情報を取得している
    // executeとgetのidは繋がっているから入る
    public function get($id)
    {
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
    $stmt->execute([$id]);
    // ２６　fetchは一個だけ単体で取れるfetchallは全ての情報を取得する
    // 今回だとidごとの情報を取っている
    $task = $stmt->fetch();
    // ２６　この後どこかで使うからこのreturnを使っている
    return $task;
    }
    // ３４　どんなメソッドを作れば更新できる設計図を書くのかを考える
    // 以下のupdateって書かれているところはメソッドの名前だから他の人がみても
    // 何をするメソッドなのかがわかるようにしておく
    public function update($name,$id)
    {
    $stmt = $this->db_manager->dbh->prepare('UPDATE '.$this->table.' SET name = ?  WHERE id = ?');
    $stmt->execute([$name, $id]);
    }

    // ４２　削除機能ができる設計図をかく
    // 削除するに必要なのはidだけだからdeleteの横のかっこに入っている
    // 変数は$idのみ
    public function delete($id)
    {
    // ４２　合致するデータを探してそれを削除している
    $stmt = $this->db_manager->dbh->prepare('DELETE FROM '.$this->table.' WHERE id = ?');
    $stmt->execute([$id]);  
    }
}




?>