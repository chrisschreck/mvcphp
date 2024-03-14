<?php
$modeGerman = array('four_divided' => 'geviertelt',
'one_screen' => 'vollbild');  
?>
<section class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell">
            <h4>Erstellung eines neuen Bildschirms</h4>
            <hr>
        </div>
        <div class="cell large-4">
            <a href="/screen"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message'] : ''); ?>
    <div class="grid-x">
        <div class="cell large-12">
            <div class="content">
                <form method="POST">
                    <label class="form-label required">Name des Bildschrims:</label>
                    <input type="text" name="screen_name" placeholder="Bildschrimname" required>
                    <label class="form-label required">Bitte wählen Sie nun eine Aufteilung:</label>
                    <select name="mode">
                        <option value='0'> - Bitte eine Einteilung wählen - </option>
                        <?php
                            foreach(\app\config\Settings::SCREEN_MODE_TYPES as $mode_name) {
                                echo "<option value='$mode_name'>".(isset($modeGerman[$mode_name]) ? $modeGerman[$mode_name] : $mode_name)."</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" name="submit_new" class="submit-button" value="Anlegen">
                </form>
            </div>
        </div>
    </div>
</section>