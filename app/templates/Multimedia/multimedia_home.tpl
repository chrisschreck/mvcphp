<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h4><b>Alle Multimedia im Überblick</b></h4>
            <p>Hier finden Sie eine Übersicht aller erstellen Packages. Unter den jeweiligen Packages können die zuvor erstellen Inhalte, den Packages zugeordnet werden.</p>
        </div>
    </div>
    <hr>
    <div class="grid-x grid-margin-x">
        <div class="cell large-4">
            <a href="/multimedia/new"><button class="button">Neues Bild/Video</button></a>
        </div>
        <div class="cell large-4">
            <a href="/"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST">
                <table>
                    <thead>
                        <tr>

                            <td>Name</td>
                            <td>Start Datum</td>
                            <td>End Datum</td>
                            <td>Type</td>
                            <td>Bearbeiten</td>
                            <td>Löschen</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($multimedia)) {
                                foreach($multimedia as $objects) {
                                    echo "<tr>";
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getStartDate()))."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getEndDate()))."</td>";
                                    echo "<td>".$objects->getType()."</td>";
                                    echo "<td><a href='/multimedia/edit/".$objects->getId()."'><img class='icons' src='".\app\config\Settings::ICON_PATH."edit.svg'></a></td>";
                                    echo "<td><button name='delete-multi' onclick=\"return confirm('VORSICHT! - Datei wirklich löschen?');\" value='".$objects->getId()."' type='submit'><img class='icons' src='".\app\config\Settings::ICON_PATH."delete.svg'></button></td>";

                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>