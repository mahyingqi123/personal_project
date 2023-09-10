 
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
     <div style="text-align:center">
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-ek+4x+au-hc-43"
     data-ad-client="ca-pub-5660555499134222"
     data-ad-slot="5672338041"></ins></div>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <div id="downthere">
        <h1 class="mostreviewedschoolshead">Browse Schools By State</h1> 
        <div class="flex-containerstate">
            <?php 
			$sql = "SELECT * FROM states ORDER BY states_name";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
                echo"<div class='states'>
                <a href='states.php?states=".$row['states_id']."' class='states1'>".$row['states_name']."</a>
                </div>";
            }}?>
          </div>
    </div>