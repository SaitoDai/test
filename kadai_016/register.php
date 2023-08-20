<?php
$dsn = 'mysql:dbname=ju77gc3juk2vmicb;host=ao9moanwus0rjiex.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306;charset=utf8mb4';
$user = 'qbrs2xf1erynr15v';
$password = 'u4fk7ldeijqon15p';



//POST後の処理
if (isset($_POST['submit'])) {
  try{
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'INSERT INTO books (book_code, book_name, price, stock_quantity, genre_code, updated_at) 
            VALUES (:book_code, :book_name, :price, :stock_quantity, :genre_code, :updated_at)';

    
    $stmt = $pdo->prepare($sql);

    $stmt->bindvalue(':book_code', $_POST['book_code'], PDO::PARAM_STR);
    $stmt->bindvalue(':book_name', $_POST['book_name'], PDO::PARAM_STR);
    $stmt->bindvalue(':price', $_POST['price'], PDO::PARAM_INT);
    $stmt->bindvalue(':stock_quantity', $_POST['stock_quantity'], PDO::PARAM_INT);
    $stmt->bindvalue(':genre_code', $_POST['genre_code'], PDO::PARAM_INT);
    $stmt->bindvalue(':updated_at', $_POST['updated_at'], PDO::PARAM_INT);

    $stmt->execute();

    $count = $stmt->rowCount();

    $message = "商品を{$count}件<span style='color:green'>登録</span>しました。";

    header ("Location: read.php?message={$message}");

  } catch (PDOException $e){
    exit($e->getMessage());
  }
} else {
  NULL;
}








//DB接続

try{
$pdo = new PDO($dsn, $user, $password);

$sql = 'SELECT genre_code FROM genres';

$stmt = $pdo->query($sql);

$books = $stmt->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
  exit($e->getMessage());
}


?>





<!DOCTYPE html>
<html>
  <title>書籍管理アプリ</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">
  <body>
    <header>
      <nav class="nav"><a href="php_book_app" class="navtext">書籍管理アプリ</a></nav>
    </header>
    <article class="main">
<h1>商品登録</h1>

  <div>
    <p><a href='read.php' class='return-btn'>戻る</a></p>
  </div>



 

 <form acrion="register.php" method="post" class='form'>
  <label>書籍コード</label><br>
  <input type="text" name="book_code" required><br>
  <label>書籍名</label><br>
  <input type="text" name="book_name" required><br>
  <label>単価</label><br>
  <input type="number" name="price" min="0" max="999999" required><br>
  <label>在庫数</label><br>
  <input type="number" name="stock_quantity" required><br>
  <lavel>ジャンルコード</label><br>
  <select name="genre_code">
   <option disableselect value>選択してください</option>  
   <?php foreach ($books as $book) {
   echo "<option value='{$book}'>{$book}</option>";
   }
   ?>
  </select><br>
  <label>更新日</label><br>
  <input type="date" name="updated_at" required><br>
  <button type="submit" name="submit" value="登録">登録</button>
 </form>

 


</table>


</article>
    <footer>
      <p class="copyright">&copy;書籍管理アプリ All right reserved.</p>
    </footer>

  </body>
</html>