<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h1>RSS-Feeds</h1>
            <p>Hier können RSS-Feeds mit den Typen Wetter und News angelegt werden, hierzu können Sie auch ein Start/End Datum festlegen. Solte es keines geben, lassen sie beides einfach leer. </p>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-4">
            <a href="/rss"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST">
                <label class="form-label required">Name</label>
                <input type="text" name="rss_name" placeholder="Name">
                <label class="form-label required">Typ</label>
                <select name="type">
                    <option value="">- Bitte Typ wählen -</option>
                    <option value="news">News</option>
                    <option value="weather">Weather</option>
                </select>
                <label class="form-label required">RSS-Link</label>
                <input type="text" name="rss_link" placeholder="Link">
                <label class="form-label">Start Datum</label>
                <input type="date" name="rss_startdate">
                <label class="form-label">End Datum</label>
                <input type="date" name="rss_enddate">
                <input type="submit" name="rss_submit" class="submit-button">
            </form>
        </div>
    </div>
</section>