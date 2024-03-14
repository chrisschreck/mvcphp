<section class="grid-container">
    <div class="grid-x">
        <div class="cell large-12">
            <h3><?php echo $dataset->getName();?> bearbeiten</h3>
        </div>
    </div>
    <hr>
    <div class="grid-x grid-margin-x"">
        <div class="cell large-4">
            <a href="/multimedia"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <div class="grid-x">
        <div class="cell large-12">
            <form enctype="multipart/form-data" method="POST">
                <p><b>Name: </b><?php echo $dataset->getName();?></p>
                <img class="preview-picture" src="<?php echo app\config\Settings::UPLOAD_PIC_PATH.$dataset->getName();?>">
                <label class="form-label">Start Datum</label>
                <input type="date" name="multi_startdate" value="<?php echo $dataset->getStartDate();?>">
                <label class="form-label">End Datum</label>
                <input type="date" name="multi_enddate" value="<?php echo $dataset->getEndDate();?>">
                <input type="submit" name="submit" class="submit-button">
            </form>
        </div>
    </div>
</section>