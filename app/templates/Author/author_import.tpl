<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h2>Autoren importieren</h2>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-6">
            <a href="/author"><button class="button maxwidth">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <p>Als Formatbeispiel können Sie diese initiale <a href="/layout/assets/autoren_beispiel.csv" target="_blank">CSV-Datei</a> benutzen</a>.</p>
    <hr>
    <?php 

        if(isset($data['message'])){
            if(is_array($data['message'])){
                foreach($data['message'] as $message){
                    echo $message."<br>";
                }
            }else{
                echo $data['message']."<hr>";
            }
        }
        
        ?>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST" enctype="multipart/form-data">
                <label class="form-label required">Bitte wählen Sie eine Autoren-CSV-Liste aus</label>
                <input type="file" name="author_csv" required>         
                <br><br>       
                <input type="submit" name="author_submit" class="submit-button" value="Importieren">
            </form>
        </div>
    </div>
</section>