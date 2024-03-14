<section class="grid-container">

    <div class="grid-x grid-margin-x">
        <div class="cell">
            <h1>Autor bearbeiten</h1>
            <hr>
        </div>
        <div class="cell large-4">
            <a href="/author"><button class="button maxwidth">Zurück zur Übersicht</button></a>
        </div>

    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message'] : ''); ?>
    <?php #if(!isset($data['error'])) : ?> 
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST" enctype="multipart/form-data">
                <label class="form-label required">Vorname</label>
                <input type="text" name="author_firstname" placeholder="Vorname*" required value="<?php echo (isset($_POST['author_edit_submit']) ? htmlspecialchars($_POST['author_firstname']) : $author->getName()); ?>">
                <label class="form-label required">Nachname</label>
                <input type="text" name="author_name" placeholder="Nachname*" required value="<?php echo (isset($_POST['author_edit_submit']) ? htmlspecialchars($_POST['author_name']) : $author->getLastname()); ?>">
                <label class="form-label required">E-Mail</label>
                <input type="text" name="author_email" placeholder="E-Mail*" required value="<?php echo (isset($_POST['author_edit_submit']) ? htmlspecialchars($_POST['author_email']) : $author->getEmail()); ?>">
                <label class="form-label required">Zeitung</label>
                <input type="text" name="author_newspaper" placeholder="Zeitung*" required value="<?php echo (isset($_POST['author_edit_submit']) ? htmlspecialchars($_POST['author_newspaper']) : $author->getNewspaper()); ?>">
                <label class="form-label required">Ressort</label>
                <input type="text" name="author_ressort" placeholder="Ressort*" required value="<?php echo (isset($_POST['author_edit_submit']) ? htmlspecialchars($_POST['author_ressort']) : $author->getRessort()); ?>">
                <label class="form-label required">Bild des Autors</label>
                <br>
                <img class="author-current-image" src="<?php echo \app\config\Settings::UPLOAD_PIC_PATH.$data['picPath'].$author->getPicPath(); ?>" width="250">
                <br><br>
                <input type="file" name="author_image" >         
                <br><br>                       
                <input type="submit" name="author_edit_submit" class="submit-button" value="Speichern">
                <input type="hidden" name="author_edit_old_image" value="<?php echo $author->getPicPath(); ?>">
            </form>
        </div>
    </div>
    <?php #endif ?> 
</section>