<?php
    // バリデーション
    // 入力値が正しく設定されている確認し、不正な場合はユーザーに再入力
    // 再選択を促す機能

    //何か不備があった時に内容を格納する配列
    $errors = [];

    // POST送信時
    if (!empty($_POST)) {
        // $_POST
        // スーパーグローバル変数
        // 連想配列で値を保持している
        // keyはinputタグに設定されたname属性

        // フォーム送信された値の取得
        $name = $_POST['input_name'];
        $email = $_POST['input_email'];
        $password = $_POST['input_password'];

        // 空かどうかのチェック
        if ($name == '') {
            // echo '空です';
            $errors['name'] = 'blank';
        }

        if ($email == '') {
            $errors['email'] = 'blank';
        }
        // passwordの文字数取得
        // strlen(文字列)
        // 文字数を算出する
        $count = strlen($password);
        if ($password == '') {
            $errors['password'] = 'blank';
        } elseif ($count < 4 || 16 < $count) {
            // 空じゃないとき
            // 4文字未満、または、17文字以上
            $errors['password'] = 'length';
        }

        // 画像のチェック
        // input type="file"で送られるもの
        // ファイルに関しては$_FILESというスーパーグローバル変数を使用
        // $_FILESを利用するための決まりごと
        //  1. formタグにenctype="multipart/form-data"が指定されている
        //  2. formタグにmethod="POST"が指定されている
        // $_FILESの利用方法
        //  $_FILES[キー]['name'] ファイル名
        //  $_FILES[キー]['tmp_name'] データそのもの

        // 画像名の取得
        $file_name = $_FILES['input_img_name']['name'];
        // 画像名が空かどうかチェック
        if ($file_name != '') {
            // 画像が選択されたとき
        } else {
            // 画像が未選択のとき
            $errors['img_name'] = 'blank';
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body style="margin-top: 60px">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 thumbnail">
                <h2 class="text-center content_header">アカウント作成</h2>
                <!-- 
                    method 送信方法
                    action 送信先
                    どこにどんな方法で値を送るのかを見る
                 -->
                 <!-- 
                     signup.phpで値に不備がないか確認したのちに、OKだったらcheck.phpに遷移する
                     = 値の送信先はsignup.php
                  -->
                <form method="POST" action="signup.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input type="text" name="input_name" class="form-control" id="name" placeholder="山田 太郎" value="">
                        <!-- ユーザー名に関するバリデーションメッセージ -->
                        <!-- 
                            $errorsにnameというキーが存在する且つその値がblankである
                         -->
                         <!-- 
                             isset(連想配列[key])
                             メモリ上に連想配列[key]が存在するか
                             存在する場合true, しない場合false
                          -->
                        <?php if (isset($errors['name']) && $errors['name'] == 'blank'): ?>
                        <p class="text-danger">ユーザー名を入力してください</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com" value="">

                        <?php if (isset($errors['email']) && $errors['email'] == 'blank'): ?>
                        <p class="text-danger">メールアドレスを入力してください</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="input_password" class="form-control" id="password" placeholder="4 ~ 16文字のパスワード">

                        <?php if (isset($errors['password']) && $errors['password'] == 'blank'): ?>
                        <p class="text-danger">パスワードを入力してください</p>
                        <?php endif; ?>

                        <?php if (isset($errors['password']) && $errors['password'] == 'length'): ?>
                        <p class="text-danger">パスワードは4 ~ 16文字で入力してください</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="img_name">プロフィール画像</label>
                        <!-- 
                            accept="image/*"
                            画像ファイルのみ選択可能
                         -->
                        <input type="file" name="input_img_name" id="img_name" accept="image/*">
                        <?php if (isset($errors['img_name']) && $errors['img_name'] == 'blank'): ?>
                        <p class="text-danger">画像を選択してください</p>
                        <?php endif; ?>
                    </div>
                    <input type="submit" class="btn btn-default" value="確認">
                    <span style="float: right; padding-top: 6px;">ログインは
                        <a href="../signin.php">こちら</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/jquery-3.1.1.js"></script>
<script src="../assets/js/jquery-migrate-1.4.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</html>