<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h4><b>Alle Packages im Überblick</b></h4>
            <p>Hier finden Sie eine Übersicht aller erstellen Packages. Unter den jeweiligen Packages können die zuvor erstellen Inhalte, den Packages zugeordnet werden.</p>
        </div>
    </div>
    <hr>
    <div class="grid-x grid-margin-x">
        <div class="cell large-4">
            <a href="/package/new"><button class="button right">Neues Package</button></a>
        </div>
        <div class="cell large-4">
            <a href="/"><button class="button right">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>

    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <form method="POST">
        <div class="grid-x">
            <div class="cell large-12">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Bearbeiten</td>
                            <td>Löschen</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($packages)) {
                                foreach($packages as $package) {
                                    echo "<tr>";
                                    echo "<td>".$package->getName()."</td>";
                                    echo "<td><a href='/package/edit/".$package->getId()."'><img class='icons' src='".\app\config\Settings::ICON_PATH."edit.svg'></a></td>";
                                    echo "<td><div onclick=\"return confirm('VORSICHT! - Package wirklich löschen?');\"><button name=\"delete-package\" value=\"".$package->getId()."\" type=\"submit\"><img class='icons' src='".\app\config\Settings::ICON_PATH."delete.svg'></button></div></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>            
            </div>
        </div>
    </form>
</section>
