<?php
$modeGerman = array(
    'four_divided' => 'geviertelt',
    'one_screen' => 'vollbild');  
?>
<section class="grid-container" id="screen-overview">
    <div class="grid-x">
        <div class="cell">
            <h4><b>Alle Bildschirme im Überblick</b></h4>
            <p>Hier finden Sie eine Übersicht aller erstellen Bildschirme. Unter den jeweiligen Bildschirm-Einstellungen können die zuvor erstellen Pakete, den Bildschrimen zugeordnet werden.</p>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="large-4 cell">
            <a href="/screen/new"><button class="button maxwidth">Neuen Bildschirm erstellen</button></a>
        </div>
        <div class="cell large-4">
            <a href="/"><button class="button">Zurück zur Übersicht</button></a>
        </div>
        <div class="cell large-4">
           &nbsp;
        </div>
        <div class="cell">
            <hr>
            <?php echo (isset($data['message']) ? $data['message'] : ''); ?>
        </div>
    </div>
        <div class="cell">
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Modus</th>
                            <th class="center">Bearbeiten</th>
                            <th class="center">Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($screens)) {
                                foreach($screens as $screen) {
                                    echo "<tr>";
                                    echo "<td>".($screen->getOnline() == 1 ? '<div class="screen-status online">&nbsp</div>' : '<div class="screen-status offline">&nbsp</div>')."</td>";
                                    echo "<td>".($screen->getOnline() == 1 ? '<a href="/screen/show/'.$screen->getToken().'" target="_blank">'.$screen->getName().'</a>' : $screen->getName())."</td>";
                                    echo "<td>".(isset($modeGerman[$screen->getMode()]) ? $modeGerman[$screen->getMode()] : $screen->getMode())."</td>";
                                    echo "<td class=\"center\"><a href='/screen/edit/".$screen->getId()."'><img class='icons' src='".\app\config\Settings::ICON_PATH."edit.svg'></a></td>";
                                    echo "<td class=\"center\"><div onclick=\"return confirm('VORSICHT! - Bildschirm wirklich löschen?');\"><button name=\"delete-screen\" value=\"".$screen->getId()."\" type=\"submit\"><img class='icons' src='".\app\config\Settings::ICON_PATH."delete.svg'></button></div></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                    
                </table>
            </form>
        </div>
        
    </div>
    <!-- <hr>
    <div class="grid-x">
        
        
    </div> -->
</section>