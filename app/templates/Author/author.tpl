<section class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell">
            <h4>Übersicht aller Autoren</h4>
            <hr>
        </div>
        <div class="cell large-4">
            <a href="/author/new"><button class="button">Autor manuell anlegen</button></a><br>
        </div>
        <div class="cell large-4">
            <a href="/author/import"><button class="button">Autoren CSV Import</button></a><br>
        </div>
        <div class="cell large-4">
            <a href="/"><button class="button">Zurück zur Übersicht</button></a>
        </div>
       
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <!-- <td>ID</td> -->
                            <th>Vorname</th>
                            <th>Name</th>
                            <th>Zeitung</th>
                            <th>Ressort</th>
                            <th>E-Mail</th>
                            <th>Bild</th>
                            <th class="center">Bearbeiten</th>
                            <th class="center">Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($authors)) {                            
                            foreach($authors as $author) { 
                                echo "<tr>";
                                    #echo "<td>".$author->getId()."</td>";
                                    echo "<td>".$author->getName()."</td>";
                                    echo "<td>".$author->getLastname()."</td>";
                                    echo "<td>".$author->getNewspaper()."</td>";
                                    echo "<td>".$author->getRessort()."</td>";
                                    echo "<td>".$author->getEmail()."</td>";
                                    echo "<td><a href=".(isset($data['picPath']) && ($data['picPath'] != '') ? $data['picPath'].$author->getPicPath() : '')." target=\"_blank\">Zum Bild</a></td>";
                                    echo "<td class=\"center\"><a href='/author/edit/".$author->getId()."'><img class='icons' src='".\app\config\Settings::ICON_PATH."edit.svg'></a></td>";
                                    echo "<td class=\"center\"><div onclick=\"return confirm('VORSICHT! - Datei wirklich löschen?');\"><button name=\"delete-file\" value=\"".$author->getId()."\" type=\"submit\"><img class='icons' src='".\app\config\Settings::ICON_PATH."delete.svg'></button></div></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <hr>
        </div>
    </div>
</section>

<?