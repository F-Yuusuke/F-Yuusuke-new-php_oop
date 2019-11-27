<?php
// １　1回だけしか呼び出さないからこの書き方
// 自分以外のファイルを読み込む時に使う組み込み関数
// config/dbconnect.phpを読み込んでくださいと言っている
require_once ('config/dbconnect.php');

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
}




?>