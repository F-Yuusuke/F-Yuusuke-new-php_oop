// ４８　初めにブランチを切ってajaxをブランチに作る
// ４９　このapp.jsを作る
// ５１JavaScriptが動いているか確認している　できていたら画面にぽんと
// 表示される
// alert()
// ５３　HTML とCSSを先に読んでもらってからjQueryを読んでもらうようにする
// jQueryはとても長いコードが書かれているからこれを書かないとじゃばスクリプトが追い越してしまう
// 可能性がある
$(function(){
// ５８　index.phpの最初の画面でADDがクリックされたら
    $(document).on('click', '#js-add-task', function (e) {
        // ５８　以下でGETで情報を取得するのをやめさせている
        // GETで取得したら見えちゃうから
        // valはjQueryで元から決まっている
        e.preventDefault();
        let task = $('#js-task')
        // ５８　ここで何の情報が取れているか確認している
        // console.log(task.val());
        // val() = value
        createTask(task.val())
    });

        // ５９　ここではCDNのなかにある$.ajaxを呼び出してきている
        // そもそもこのファイルでやろうとしていることはグーグルマップのようにページを
        // 遷移しなくてもできるようになりたい
        // 繊維してしまうと固まった時に何もできなくなる（真っ白になるから）
        // だけどこの技術を使えば固まっても他のところを操作できる
    function createTask(task) {
           $.ajax({
            url: 'create.php',//ファイル名
            type: 'POST',//レスポンスの種類
            dataType: 'json',//これを使ったら配列で情報が返ってくるので扱いやすい
            data: {
                task: task//格納される場所
            }
        })
        .then(
            //成功した時の処理
            function (task) {
                // ６３　ここは６０で書いたものを表示させている
                // console.log(task);
                renderTask(task)
            },
            //失敗したら
            function () {
            }
        )
    }
    // ６０　まずはここに追加　画面に追加したtaskを表示する
    function renderTask(task) {
        // appendは後ろに追加　prependは前に追加
        // tbodyに追加するよってこと
        // JavaScriptでは``を使うと変数をなかに入れることができる
        $('tbody').append(
            // ６４　日付も表示できるようにしている
            `<tr><td>${task.name}</td>
               <td>${task.due_date}</td>
               <td></td>
               <td></td>
            </tr>`
        )
    }      
});