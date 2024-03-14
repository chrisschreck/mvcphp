<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h1>Autor anlegen</h1>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-4">
            <a href="/author"><button class="button maxwidth">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message'] : ''); ?>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST" enctype="multipart/form-data">
                <label class="form-label required">Vorname</label>
                <input type="text" name="author_firstname" placeholder="Vorname*" required>
                <label class="form-label required">Nachname</label>
                <input type="text" name="author_name" placeholder="Nachname*" required>
                <label class="form-label required">E-Mail</label>
                <input type="text" name="author_email" placeholder="E-Mail*" required>
                <label class="form-label required">Zeitung</label>
                <input type="text" name="author_newspaper" placeholder="Zeitung*" required>
                <label class="form-label required">Ressort</label>
                <input type="text" name="author_ressort" placeholder="Ressort*" required>
                <label class="form-label required">Bild des Autors</label>
                <input type="file" name="author_image" required>         
                <br><br>       
                <input type="submit" name="author_submit" class="submit-button" value="Anlegen">
            </form>
        </div>
    </div>
</section>