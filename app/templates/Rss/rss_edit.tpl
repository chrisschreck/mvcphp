<section class="grid-container">
    <div class="grid-x">
        <div class="cell large-12">
            <h1><?php echo $edit_dataset->getName();?> bearbeiten</h1>
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
            <form enctype="multipart/form-data" method="POST">
                <label class="form-label required">Name</label>
                <input type="text" name="rss_name" value="<?php echo $edit_dataset->getName();?>">
                <label class="form-label required">Link</label>
                <input type="text" name="rss_link" placeholder="Link" value="<?php echo $edit_dataset->getLink();?>">
                <label class="form-label required">Typ</label>
                <select name="rss_type">
                    <option value="">- Bitte Typ wählen -</option>
                    <option <?php echo ($edit_dataset->getType() == "news") ? "selected": "" ?> value="news">News</option>
                    <option <?php echo ($edit_dataset->getType() == "weather") ? "selected": "" ?> value="weather">Weather</option>
                </select>
                <label class="form-label required">Start Datum</label>
                <input type="date" name="rss_startdate" value="<?php echo $edit_dataset->getStartDate();?>">
                <label class="form-label required">End Datum</label>
                <input type="date" name="rss_enddate" value="<?php echo $edit_dataset->getEndDate();?>">
                <input type="submit" name="submit_rss" class="submit-button">
            </form>
        </div>
    </div>
</section>,