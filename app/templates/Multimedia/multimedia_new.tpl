<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h1>Multimedia</h1>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-4">
            <a href="/multimedia"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <form enctype="multipart/form-data" method="POST">
        <label class="form-label required" for="files">Select file:</label>
        <input type="file" id="files" name="files[]"><br><br>
        <label class="form-label required">Start Datum</label>
        <input type="date" name="start_date">
        <label class="form-label required">End Datum</label>
        <input type="date" name="end_date">
        <input type="submit" name="submit-newpic" class="submit-button">
    </form>
</section>