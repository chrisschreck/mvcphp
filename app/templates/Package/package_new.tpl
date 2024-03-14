<section class="grid-container">
    <div class="grid-x">
        <div class="cell">
            <h1>Erstellung eines Package</h1>
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
        <label class="form-label required">Name</label>
        <input type="text" name="name" placeholder="Name">
        <div class="separator">Media</div>
        <div class="accordion_container">
            <div class="info-accordion-head"><span>Bilder und Videos</span><span class="plusminus">+</span></div>
            <div class="info-accordion-body" style="display: none;">
                <table class="selecttable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Startdatum</td>
                            <td>Enddatum</td>
                            <td>Auswahl</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($pictures)) {
                                foreach($pictures as $objects) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='multimedia[".$objects->getId()."]'></td>";
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".$objects->getStartDate()."</td>";
                                    echo "<td>".$objects->getEndDate()."</td>";
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
                            <td>Vorname</td>
                            <td>Nachname</td>
                            <td>Zeitungstitel</td>
                            <td>Ressort</td>
                            <td>Auswahl</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($authors)) {
                                foreach($authors as $author) {
                                    echo "<tr>";
                                        echo "<td><input type='checkbox' name='authors[".$author->getId()."]'></td>";
                                        echo "<td>".$author->getName()."</td>";
                                        echo "<td>".$author->getLastname()."</td>";
                                        echo "<td>".$author->getNewspaper()."</td>";
                                        echo "<td>".$author->getRessort()."</td>";
                                    echo "</tr>";
                                }
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
                            <td>Name</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Auswahl</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($rss)) {
                                foreach($rss as $objects) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='rss[".$objects->getId()."]'></td>";
                                    echo "<td>".$objects->getName()."</td>";
                                    echo "<td>".$objects->getStartDate()."</td>";
                                    echo "<td>".$objects->getEndDate()."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <hr style="border-bottom: 1px solid black;">
        <input type="submit" name="submit_package" class="submit-button" value="Speichern">
    </form>
</section>
