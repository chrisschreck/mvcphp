<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h1>Bearbeiten eines Packages</h1>
        </div>
    </div>
    <hr>
    <div class="grid-x">
        <div class="cell large-4">
            <a href="/package"><button class="button">Zurück zur Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message']."<hr>" : ''); ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" value="<?php echo $edit_package->getName(); ?>">
        <div class="accordion_container">
            <div class="info-accordion-head"><span>Bilder und Videos</span><span class="plusminus">+</span></div>
            <div class="info-accordion-body" style="display: none;">
                <table class="selecttable" style="cursor: pointer;">
                    <thead>
                        <tr>
                            <td>Auswahl</td>
                            <td>Name</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($pictures)) {
                                foreach($pictures as $objects) {
                                    echo "<tr>";
                                    if(in_array($objects->getId(),$edit_package->getMultimediaIds())) {
                                        echo "<td><input type='checkbox' name='multimedia[".$objects->getId()."]' checked></td>";
                                    } else {
                                        echo "<td><input type='checkbox' name='multimedia[".$objects->getId()."]'></td>";
                                    }
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getStartDate()))."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getEndDate()))."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="info-accordion-head"><span>Autoren</span><span class="plusminus">+</span></div>
            <div class="info-accordion-body" style="display: none;">
                <table class="selecttable">
                    <thead>
                        <tr>
                            <td>Auswahl</td>
                            <td>Vorname</td>
                            <td>Nachname</td>
                            <td>Zeitungstitel</td>
                            <td>Ressort</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($authors as $author) {
                                echo "<tr>";
                                if(in_array($author->getId(),$edit_package->getAuthorIds())) {
                                    echo "<td><input type='checkbox' name='authors[".$author->getId()."]' checked></td>";
                                } else {
                                    echo "<td><input type='checkbox' name='authors[".$author->getId()."]'></td>";
                                }
                                    echo "<td>".$author->getName()."</td>";
                                    echo "<td>".$author->getLastname()."</td>";
                                    echo "<td>".$author->getNewspaper()."</td>";
                                    echo "<td>".$author->getRessort()."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="info-accordion-head"><span>RSS</span><span class="plusminus">+</span></div>
            <div class="info-accordion-body" style="display: none;">
                <table class="selecttable">
                    <thead>
                        <tr>
                            <td>Auswahl</td>
                            <td>Name</td>
                            <td>Start Datum</td>
                            <td>End Datum</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            if(isset($rss)) {
                                foreach($rss as $objects) {
                                    echo "<tr>";
                                    if(in_array($objects->getId(),$edit_package->getRssIds())) {
                                        echo "<td><input type='checkbox' name='rss[".$objects->getId()."]' checked></td>";
                                    } else {
                                        echo "<td><input type='checkbox' name='rss[".$objects->getId()."]'></td>";
                                    }
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getStartDate()))."</td>";
                                    echo "<td>".date("d.m.Y",strtotime($objects->getEndDate()))."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <br><br>
        <input type="submit" name="submit_package" class="submit-button" value="Speichern">
    </form>
</section>
