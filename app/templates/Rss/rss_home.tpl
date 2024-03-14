<section class="grid-container">
    <div class="grid-x">
        <div class="cell large-12">
            <h1>RSS-Feeds</h1>
        </div>
    </div>
    <hr>
    <div class="grid-x grid-margin-x grid-margin-y">
        <div class="cell large-4">
            <a href="/rss/new"><button class="button">Neuer RSS</button></a>
        </div>
        <div class="cell large-4">
            <a href="/"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <div class="grid-x">
        <div class="cell large-12">
            <form method="POST">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Type</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Bearbeiten</td>
                            <td>Löschen</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($rss)) {
                                foreach($rss as $objects) {
                                    echo "<tr>";
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".ucfirst($objects->getType())."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getStartDate()))."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getEndDate()))."</td>";
                                    echo "<td><a href='/rss/edit/".$objects->getId()."'><img class='icons' src='".\app\config\Settings::ICON_PATH."edit.svg'></a></td>";
                                    echo "<td><button name='delete-rss' onclick=\"return confirm('VORSICHT! - Datei wirklich löschen?');\" value='".$objects->getId()."' type='submit'><img class='icons' src='".\app\config\Settings::ICON_PATH."delete.svg'></button></td>";
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