<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    </head>
    <body>

        <section class="top"></section>

        <main class="main">

            <table>
                <th>ID wypożyczenia</th><th>Książka</th><th>Wypożyczający</th><th>Data wypożyczenia</th><th>Data oddania</th>

                <?php
                    $conn = new mysqli('172.16.131.125','z_dfg','ytr','z_dfg');
                    $sql = "SELECT * FROM bibl_wyp,bibl_user,bibl_tytul WHERE bibl_wyp.id_book=bibl_tytul.id_tytul AND bibl_wyp.id_user=bibl_user.id_user";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo('<tr>');
                        echo('<td>' .$row['id_wyp']. '</td><td>' .$row['tytul']. '</td><td>' .$row['login']. '</td><td>' .$row['date_wyp']. '</td><td>' .$row['date_odd']. '</td>');
                        echo('</tr>');
                    }
                ?>
            </table>

            <table>
                <th>Oddane książki</th><th>ID wypożyczenia</th>
                <?php
                    $curdate = '2019-05-30';
                    $conn = new mysqli('172.16.131.125','z_dfg','ytr','z_dfg');
                    $sql = "SELECT * FROM bibl_wyp, bibl_tytul WHERE bibl_wyp.id_book=bibl_tytul.id_tytul";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        if($row['date_odd'] < $curdate){
                            echo('<tr>');
                            echo('<td>' .$row['tytul']. '</td><td>' .$row['id_wyp']. '</td>');
                            echo('</tr>');
                        }
                    }
                ?>
            </table>

            <table>
                <th>Nieoddane książki</th><th>ID wypożyczenia</th>
                <?php
                    $curdate = date('Y-m-d');
                    $conn = new mysqli('172.16.131.125','z_dfg','ytr','z_dfg');
                    $sql = "SELECT * FROM bibl_wyp, bibl_tytul WHERE bibl_wyp.id_book=bibl_tytul.id_tytul";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        if($row['date_odd'] > $curdate){
                            echo('<tr>');
                            echo('<td>' .$row['tytul']. '</td><td>' .$row['id_wyp']. '</td>');
                            echo('</tr>');
                        }
                    }
                ?>
            </table>

            <table>
                <th>ID książki</th><th>Tytuł</th><th>Autor</th><th>Status</th>
                <?php
                    $conn = new mysqli('172.16.131.125','z_dfg','ytr','z_dfg');
                    $sql = "SELECT * FROM bibl_book,bibl_autor,bibl_tytul WHERE bibl_book.id_autor=bibl_autor.id_autor AND bibl_book.id_tytul=bibl_tytul.id_tytul";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        if($row['wypoz'] == 1){
                            $status = 'Jest dostępna';
                        }else{
                            $status = 'Nie jest dostępna';
                        }
                        echo('<tr>');
                        echo('<td>' .$row['id_book']. '</td><td>' .$row['tytul']. '</td><td>' .$row['autor']. '</td><td>' .$status.'</td>');
                        echo('</tr>');
                    }
                ?>
            </table>

        </main>

        <section class="bottom"></section>
        
    </body>
</html>