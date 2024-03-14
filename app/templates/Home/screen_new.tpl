<section class="grid-container">
    <div class="grid-x">
        <div class="cell large-6">
            <h1>Neuer Screen erstellen</h1>
        </div>
        <div class="cell large-6">
            <a href="/"><button class="button50 right">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-12">
            <div class="content">
                <form method="POST">
                    <input type="text" name="screen_name" placeholder="Screenname">
                    <select name="mode">
                        <option value=''> - Bitte Mode waehlen - </option>
                        <?php
                            foreach(\app\config\Settings::SCREEN_MODE_TYPES as $mode_name) {
                                echo "<option value='$mode_name'>".$mode_name."</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" name="submit_new" class="submit-button">
                </form>
            </div>
        </div>
    </div>
</section>