<?php
    include("./includes/header.php");
?>
<main>
    <form action="search.php" method="get" class="searchform">
        <input class="search-inp" type="text" placeholder="جستجو" name="search" id="">
        <button type="submit" name="submit">جستجو</button>
    </form>
    <div class="searchshowuser">
    <?php
    if (isset($_GET['submit'])) {
        $searchfor = $_GET['search'];
        $query = "SELECT * FROM user WHERE username LIKE '%$searchfor%'";
        $result = mysqli_query($db, $query);
        if ($result->num_rows > 0) {
            foreach ($result as $row) {
            ?>
            <div class="searchsingleuser">
                <a class="Theposthead" href="usershow.php?user=<?php echo $row['username'];?>">
                <img class="userheaderimage" src="./assets/profiles/<?php echo isset($row['image'])? $row['image']: "default.jpeg";?>" alt="">
                <?php echo $row['username'];?>
                </a>
            </div>
            <?php
            }
        } else {
            ?>
            <p class="error">هیچ نتیجه ای یافت نشد!!!</p>
            <?php
        }
    }
    ?>
    </div>
</main>
<?php
    include("./includes/footer.php");
?>